<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Players\Player;
use App\Entities\Players\PlayersRepository;
use App\Entities\Teams\Team;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class PlayersAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(PlayersRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setName('List Players')
                	    ->setParams([
                	        // 'q|Search query',
                	        'page|Page number',
                            (new Param('team_id'))->dataType(Param::TYPE_INT)
                                ->setDescription('Team ID. Send with the request URL as `team_id=xxx`')
                                ->setLocation(Param::LOCATION_QUERY),
                        ])
                        ->setSuccessPaginatedObject(Player::class);
                });

        $this->validate($request, [
            'team_id' => 'required',
        ]);

        $filter = $this->repo->newSearchFilter();

        $filter->where('owner_id', $request->user()->id);
        $filter->where('team_id', $request->team_id);
        $filter->orderBy('name');

		$items = $this->repo->search($filter);

		return response()->apiSuccess($items);
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
                ->setName('Create Player')
                ->setParams([
                    'name|String|Player name',
                    'email|String|optional',
                    'positions|String|List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field',
                    'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
                    'team_id|Team ID|optional',
                ])
                ->setSuccessObject(Player::class);
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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setName('Update Player')
                ->setParams([
                    'name|String|Player name',
                    'email|String|optional',
                    'positions|String|List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field',
                    'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
                ])
                ->setSuccessObject(Player::class);
        });


        $this->validate($request, $this->repo->getModel()->getUpdateRules());

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
    public function destroy(Request $request, $uuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Delete Player')
                ->setParams([
                    (new Param('uuid'))->setDescription('uuid of the player to delete')->setLocation(Param::LOCATION_PATH),
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
