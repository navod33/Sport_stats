<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Teams\Team;
use App\Entities\Teams\TeamsRepository;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Api\ModifyValidationFailedApiResponse;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class TeamsAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(TeamsRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setName('List Teams')
                	    ->setDescription('Get a list of teams created by user')
                	    ->setParams([
                	        'q|Search query to filter by a name',
                	        'page|Page number',
                        ])
                        ->setSuccessPaginatedObject(Team::class);
                });

        $filter = $this->repo->newSearchFilter();

        // limit results to logged in user
        $filter->where('owner_id', $request->user()->id);
        $items= $filter->orderBy('name');

        if($request->filled('q')){
            $items = $filter->where('name', 'like', ''.$request->q.'%');
        }


		return response()->apiSuccessPaginated($items->paginate());
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setName('Create Team')
                ->setParams([
                    'name|String|Team name',
                    'team_number|String|A number for the team. Can be any value|optional',
                    'player_count|Integer|Number of players for the team|optional',
                    'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
                ])
                ->setSuccessObject(Team::class);
        });

        $this->validate($request, $this->repo->getModel()->getCreateRules());

        try {
            $image = $this->getImageFromRequest($request);
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        $model = $this->repo->create($request->all());
        $model->owner()->associate($request->user());
        if ($image) $model->image()->associate($image);

        $model->save();
        return response()->apiSuccess($model);
	}

    /**
     * @param Request $request
     * @param $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $uuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Update Team')
                ->setParams([
                    (new Param('uuid'))->setDescription('uuid of the Team to update')->setLocation(Param::LOCATION_PATH),
                    'name|String|Team name',
                    'team_number|String|A number for the team. Can be any value|optional',
                    'player_count|Integer|Number of players for the team|optional',
                    'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
                    'performance_notes|String|Team performance notes|optional',
                    (new Param('metadata'))->setDescription('An array of key value pairs to store any metadata')
                ])
                ->setSuccessObject(Team::class);
        });

        $this->validate($request, $this->repo->getModel()->getUpdateRules());
        // $request->validate($this->repo->getModel()->getUpdateRules());

        $model = $this->repo->findByUuid($uuid);

        if (!$model) {
            return response()->apiError();
        }

        if ($model->owner_id !== (int)$request->user()->id) {
            return response()->apiErrorUnauthorized("You're not authorised to update this.");
        }

        try {
            $image = $this->getImageFromRequest($request);
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        $this->repo->update($model, $request->all());
        if ($image) $model->image()->associate($image);
        $model->fresh();

        return response()->apiSuccess($model);
    }

    /**
     * @param Request $request
     * @param $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $uuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Delete Team')
                ->setParams([
                    (new Param('uuid'))->setDescription('uuid of the Team to delete')->setLocation(Param::LOCATION_PATH),
                ]);
        });

        $model = $this->repo->findByUuid($uuid);

        if (!$model) {
            return response()->apiError();
        }

        if ($model->owner_id !== (int)$request->user()->id) {
            return response()->apiErrorUnauthorized("You're not authorised to update this.");
        }

        $model->delete();

        return response()->apiSuccess();
    }

}
