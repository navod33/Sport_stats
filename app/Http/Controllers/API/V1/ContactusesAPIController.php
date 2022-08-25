<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\APIBaseController;
use App\Entities\Contactuses\ContactusesRepository;
use App\Entities\Contactuses\Contactus;
use EMedia\Api\Docs\APICall;
use Illuminate\Http\Request;
use EMedia\Api\Docs\Param;
use EMedia\Devices\Auth\DeviceAuthenticator;

class ContactusesAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(ContactusesRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setParams([
                	        'q|Search query',
                	        'page|Page number',
                        ])
                        ->setSuccessPaginatedObject(Contactus::class);
                });

		$items = $this->repo->search();

		return response()->apiSuccess($items);
	}


	protected function store(Request $request)
	{
		document(function () {
                	return (new APICall())
					->setGroup('contact-us')
					->setName('contact-us')
                	    ->setParams([
                	        (new Param('message'))->dataType('string')->setDescription('Description'),
						])
                        ->setSuccessObject(ContactUs::class);
                });

		$this->validate($request, [
			'message' => 'required | string',
		]);

		$data = $request->only(
            'message',
         );

        $user = DeviceAuthenticator::getUserByAccessToken();
        $data['message_by'] = $user->id;
        $result= ContactUs::create($data);

		if (!$result) {
			return response()->apiError();
		}

		$result=$result->fresh();

		return response()->apiSuccess($result);
	}
}
