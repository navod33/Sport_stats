<?php


namespace App\Http\Controllers\API\V1;

use App\Entities\Files\FilesRepository;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\AppSettings\Facades\Setting;

class GuestController extends APIBaseController
{

	/**
	 *
	 * Guest settings
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		document(function () {
			return (new APICall())
				->setName('Guest Settings')
				->setDescription('Guest settings and parameters')
				->noDefaultHeaders()->setHeaders([
					(new Param('Accept', 'String', '`application/json`'))->setDefaultValue('application/json'),
					(new Param('x-api-key', 'String', 'API Key'))->setDefaultValue('123123123123'),
				]);
				
		});

		$data = [];

		// get files
		/** @var FilesRepository $filesRepo */
		$filesRepo = app(FilesRepository::class);

		$fileKeys = [
			'privacy-policy',
			'terms-conditions',
			'about-us',
		];

		foreach ($fileKeys as $fileKey) {
			$file = $filesRepo->findByKey($fileKey);
			$variableName = str_replace('-', '_', $fileKey);
			$data[$variableName . '_url'] = ($file)? $file->permalink: null;
		}

		// get settings
		$settingKeys = [
			'ABOUT_US',
			'PRIVACY_POLICY',
			'TERMS_AND_CONDITIONS',
			'WEBSITE_URL',
			'FACEBOOK_URL',
			'TWITTER_URL',
			'LINKEDIN_URL',
			'INSTAGRAM_URL',
			'CALL_US_NUMBER',
		];

		foreach ($settingKeys as $settingKey) {
			$value = Setting::get($settingKey);
			$settingKey = strtolower($settingKey);
			$data[$settingKey] = $value;
		}

		return response()->apiSuccess($data);
	}


}
