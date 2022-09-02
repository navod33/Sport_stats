<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Api\Domain\Postman\PostmanVar;
use EMedia\Devices\Auth\DeviceAuthenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends \EMedia\Oxygen\Http\Controllers\API\V1\Auth\ProfileController
{

	public function update(Request $request)
	{
		document(function () {
			return (new APICall)
				->setName('Update My Profile')
				->setParams([
					(new Param('first_name'))->setVariable(PostmanVar::FIRST_NAME),
					(new Param('last_name'))->optional(),
					(new Param('email'))->setVariable('{{test_user_email}}'),
					(new Param('phone'))->optional(),
					// (new Param('_method'))->description("Must be set to `PUT`")->setDefaultValue('put'),
				])
				->setSuccessObject(app('oxygen')::getUserClass());
		});

		$user = DeviceAuthenticator::getUserByAccessToken();

		$this->validate($request, [
			'first_name' => 'required',
			'email' => 'required|email|unique:users,email,' . $user->id,
		]);

		$user = $this->usersRepo->update($user, $request->only('first_name', 'last_name', 'email', 'phone'));
		$user = User::first();
		$user = $user->fresh();
		return response()->apiSuccess($user);
	}

}
