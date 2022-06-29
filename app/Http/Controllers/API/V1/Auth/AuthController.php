<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Api\Domain\Postman\PostmanVar;
use EMedia\Devices\Auth\DeviceAuthenticator;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends \EMedia\Oxygen\Http\Controllers\API\V1\Auth\AuthController
{

	/**
	 *
	 * Fillable parameters when registering a new user
	 * Only add fields that must be auto-filled
	 *
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
	];

	/**
	 *
	 * Validation rules to be enforced when registering.
	 *
	 * @return array
	 */
	protected function getRegistrationValidationRules(): array
	{
		return [
			// 'first_name' => 'required',
			// 'last_name'  => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed|min:8',
			// 'date_of_birth' => 'required|date',
			// 'phone'       => 'required',
			'device_id' => 'required',
			'device_type' => 'required',
		];
	}

	/**
	 *
	 * These are the parameters for APIDoc
	 *
	 * @return array
	 */
	protected function getRegistrationApiDocParams(): array
	{
		return [
			'device_id|Unique ID of the device|{{$guid}}',
			'device_type|Type of the device `APPLE` or `ANDROID`|example:apple',
			'device_push_token|optional|Unique push token for the device',


			'email|Email address of user|{{$randomExampleEmail}}',
			'password|Password. Must be at least 8 characters.|{{login_user_pass}}',
			'password_confirmation|Confirm password. Must be at least 8 characters.|{{login_user_pass}}',

			// add other fields as required
			// (new Param(
			//	'phone',
			//	'string',
			//	'Phone number in international format'))
			//	->setExample('+61123456789')
			//	->setVariable(PostmanVar::PHONE),

			// (new Param('date_of_birth', 'string', 'Date of birth in YYYY/MM/DD format'))
			// 	->setExample('1990/10/24'),
		];
	}

	// Add your logic here
/**
	 * @return \Closure
	 */
	protected function getRegisterApiDocumentFunction(): callable
	{
		return function () {
			return (new APICall)
				->setName('Register')
				->setDescription('This endpoint registers a user.' .
				 'If you need to update a profile image, upload the profile image in the' .
				 'background using `/avatar` endpoint.')
				->setParams($this->getRegistrationApiDocParams())
				->setApiKeyHeader()
				->setSuccessObject(app('oxygen')->getUserClass())
				->setErrorExample('{
					"message": "The email must be a valid email address.",
					"payload": {
						"errors": {
							"email": [
								"The email must be a valid email address."
							]
						}
					},
					"result": false
				}', 422);
		};
	}

	/**
	 *
	 * Register a user.
	 *
	 * You probably don't need to duplicate this function.
	 * See the other functions and parameters which can be extended as required.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	// Add your logic here
    public function register(Request $request)
	{
		document($this->getRegisterApiDocumentFunction());

        DB::beginTransaction();

        try {

            $this->validate($request, $this->getRegistrationValidationRules());

            $data = $request->only($this->fillable);
            $data['password'] = bcrypt($request->password);
            $data['confirmation_code'] = mt_rand(1000, 9999);
            $user = $this->usersRepository->create($data);

            $responseData = $user->toArray();
            $deviceData = $request->only($this->fillableDeviceParams);
            $device = $this->devicesRepo->createOrUpdateByIDAndType($deviceData, $user->id);
            $responseData['access_token'] = $device->access_token;

            DB::commit();

            // Send Email verification code
            event(new Registered($user));
            return response()->apiSuccess($responseData);

        } catch (Exception $ex) {

            DB::rollBack();
            return response()->apiError($ex->getMessage());
        }

    }
    public function verityEmail($code)
    {
        document(function () {
            return (new APICall)
                ->setGroup('Auth')
                ->setName('Email Verification')
                ->setParams([
                    (new Param('code', 'integer', 'Verification Code', Param::LOCATION_PATH))->setVariable('1234'),
                ])
                ->setSuccessObject(User::class);
        });

        $user = DeviceAuthenticator::getUserByAccessToken();

        if ($user->confirmation_code == $code) {
            $user->update(['email_verified_at' => now()->toDateTimeString()]);
        } else {
            return response()->apiError('Invalid verification code, Resend and try again');
        }

        return response()->apiSuccess($user);
    }

    public function resendCode()
    {
        document(function () {
            return (new APICall)
                ->setGroup('Auth')
                ->setName('Resend Verification Code');
        });

        $user = DeviceAuthenticator::getUserByAccessToken();
        $user->confirmation_code = mt_rand(1000, 9999);
        $responseMessage = 'A verification code has been sent to your email.';

        if (!app()->environment('production')) {
            $user->confirmation_code = 0000;
            $responseMessage .= ' Test environment code is always ' . $user->confirmation_code;
        }

        $user->save();

        // Send Email verification code
        event(new Registered($user));

        return response()->apiSuccess(null, $responseMessage);
    }
}
