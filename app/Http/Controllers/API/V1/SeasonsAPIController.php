<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Seasons\Season;
use App\Entities\Seasons\SeasonsRepository;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use Illuminate\Http\Request;

class SeasonsAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(SeasonsRepository $repo)
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
                        ->setName('Seasons')
                        ->setSuccessPaginatedObject(Season::class);
                });

		$items = $this->repo->search();
		return response()->apiSuccessPaginated($items);
	}

}
