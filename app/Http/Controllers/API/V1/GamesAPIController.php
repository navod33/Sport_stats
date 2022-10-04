<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Games\Game;
use App\Entities\Games\GamesRepository;
use App\Entities\Teams\Team;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class GamesAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(GamesRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setName('List Games')
                	    ->setDescription('Get a list of games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.')
                	    ->setParams([
                	        // 'q|Search query',
                	        'page|Page number',
                            'period|String|optional|Period can be `past`, `future` future games except today, `from_today` future games with today. The default is all games desc by game id.',
                            'order|String|optional|Order can be `asc`, `desc`.',
                        ])
                        ->setSuccessPaginatedObject(Game::class);
                });

		// return a list of my games
		$filter = $this->repo->newSearchFilter(false);
		$items = $filter->where('owner_id', $request->user()->id);

		$period = $request->input('period');
		if ($period == 'past') {
            $filter->where('played_at', '<', now()->subDay());
            $items = $filter->orderBy('played_at', 'desc');
        } else if ($period == 'future') {
            $filter->where('played_at', '>', now());
            $items = $filter->orderBy('played_at', 'asc');
        } else if ($period == 'from_today'){
            // everything from today
            $filter->where('played_at', '>=', now()->subDay());
            $items = $filter->orderBy('played_at', 'asc');
        }
        else{
            $items = $filter->orderBy('id', 'desc');
        }

        // filter by order
        if ($request->input('order') == 'desc') {
            $items = $filter->orderBy('played_at', 'desc');
        } else {
            $items = $filter->orderBy('played_at', 'asc');
        }

		$items = $filter->with([
		    'team_a.image',
            // 'team_b',
            'season',
            'team_a_image',
        ]);

		//$items = $this->repo->search($filter);

        return response()->apiSuccessPaginated($items->paginate());
		//return response()->apiSuccess($items);
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
                ->setName('Create Game')
                ->setParams([
                    'tournament_name|String|Tournament name',
                    (new Param('played_at'))->setDescription('Date and time of the game Ex "2023-01-31 23:00:00"'),
                    'location|String|Location of the game Ex "The Palace"|optional',
                    'season_id|Integer|Season ID|optional',
                    'team_a_id|Integer|Team A ID|required',
                    'team_a_image_uuid|UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.|optional',
                    'team_b_image_uuid|UUID for the team B profile picture. Get a UUID from file upload endpoint.|optional',
                    'team_b_name|String|required',
                ])
                ->setSuccessObject(Game::class);
        });

        $this->validate($request, $this->repo->getModel()->getCreateRules());

        try {
            $imageA = $this->getImageFromRequest($request, 'team_a_image_uuid');
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        try {
            $imageB = $this->getImageFromRequest($request, 'team_b_image_uuid');
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        $model = $this->repo->create($request->all());
        $model->owner()->associate($request->user());
        if ($imageA) $model->team_a_image()->associate($imageA);
        if ($imageB) $model->team_b_image()->associate($imageB);

        $model->save();

        $filter = $this->repo->newSearchFilter(false);
		$items = $filter->where('owner_id', $request->user()->id)
        ->where('id',$model->id);
        $items = $filter->with([
		    'team_a.image',
            // 'team_b',
            'season',
            'team_a_image',
        ])->first();

        return response()->apiSuccess($items);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $uuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Update Game')
                ->setParams([
                    (new Param('uuid'))
                        ->setDescription('Game UUID')
                        ->setLocation(Param::LOCATION_PATH),
                    'tournament_name|String|Tournament name',
                    'played_at|String|Date and time of the game in ATOM format. Example: 2022-07-01T13:20:26.000000Z|required',
                    'location|String|Location of the game. Example: "The Palace"|optional',
                    'season_id|Integer|Season ID|optional',
                    'team_a_id|Integer|Team A ID|required',
                    'team_a_image_uuid|UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.|optional',
                    'team_b_image_uuid|UUID for the team B profile picture. Get a UUID from file upload endpoint.|optional',
                    'team_b_name|String|required',
                ])
                ->setSuccessObject(Game::class);
        });

        $this->validate($request, $this->repo->getModel()->getCreateRules());

        $model = $this->repo->findByUuid($uuid);

        if (!$model) {
            return response()->apiError();
        }

        if ($model->owner_id !== (int)$request->user()->id) {
            return response()->apiErrorUnauthorized("You're not authorised to update this.");
        }

        try {
            $imageA = $this->getImageFromRequest($request, 'team_a_image_uuid');
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        try {
            $imageB = $this->getImageFromRequest($request, 'team_b_image_uuid');
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        $model = $this->repo->update($model,$request->all());
        // if ($imageA) $model->team_a_image()->associate($imageA);
        // if ($imageB) $model->team_b_image()->associate($imageB);

        $filter = $this->repo->newSearchFilter();

        $items = $filter->where('uuid', $uuid);

        return response()->apiSuccessPaginated($items->paginate());
        // $model->save();
        // return response()->apiSuccess($model);
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
                ->setName('Delete Game')
                ->setParams([
                    (new Param('uuid'))->setDescription('uuid of the Game to delete')->setLocation(Param::LOCATION_PATH),
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

    protected function finished_games(Request $request)
	{
		document(function () {
                	return (new APICall())
                        ->setGroup('Performance')
                	    ->setName('List Finished Games')
                	    ->setDescription('Get a list of finished games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.')
                	    ->setParams([
                	        (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                	        'page|Page number',
                            (new Param('q'))->dataType(Param::TYPE_STRING)->setDescription('search by season or tournament name')->optional(),
                            
                        ])
                        ->setSuccessPaginatedObject(Game::class);
                });

                $this->validate($request, [
                    'team_id' => 'required | integer',
                ]);
		// return a list of my games
		$filter = $this->repo->newSearchFilter(false);
		$items = $filter->where('owner_id', $request->user()->id)
                        ->where('team_a_id', $request->team_id)
                        ->where('game_started', true)
                        ->where('game_finished', true)
                        ->when(request('q') , function ($query) {
                            $query->where(function ($query) {
                            $query->whereHas('season', function ($query1) {
                                        $query1->where('name', 'like','%'. request('q') .'%');
                                    });
                            $query->orWhere('tournament_name', 'like','%'. request('q') .'%');
                                });
                        })
                        ->orderBy('id', 'desc');


		$items = $filter->with([
		    'team_a.image',
            // 'team_b',
            'season',
            'team_a_image',
        ]);

		//$items = $this->repo->search($filter);

        return response()->apiSuccessPaginated($items->paginate());
		//return response()->apiSuccess($items);
	}

    protected function match_result(Request $request)
	{
		document(function () {
                	return (new APICall())
                        ->setGroup('Result')
                	    ->setName('List Match Results')
                	    ->setDescription('Get a list of finished games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.')
                	    ->setParams([
                	        'page|Page number',
                        ])
                        ->setSuccessExample('{
                            "payload": [
                                {
                                    "id": 2,
                                    "uuid": "4df61869-e384-4df8-a043-e990f793399d",
                                    "owner_id": 4,
                                    "season_id": 9,
                                    "team_a_id": 1,
                                    "team_b_name": null,
                                    "tournament_name": "Tournament 1",
                                    "played_at": "2022-10-04T18:33:39.000000Z",
                                    "location": null,
                                    "team_a_image_uuid": null,
                                    "team_b_image_uuid": null,
                                    "team_b_score": 0,
                                    "team_b_goal_missed": 0,
                                    "game_finished": 1,
                                    "game_finished_at": null,
                                    "game_started": 1,
                                    "game_actually_started_at": null,
                                    "team_a_score": 0,
                                    "game_status": "Upcoming",
                                    "match_results": "DRAW",
                                    "team_a_image": null,
                                    "team_b_image": null,
                                    "team_a": {
                                        "id": 1,
                                        "uuid": "5d50cafa-4e05-463c-9376-f212852c1166",
                                        "owner_id": 4,
                                        "image_uuid": null,
                                        "player_count": null,
                                        "name": "test team 01",
                                        "team_number": null,
                                        "metadata": null,
                                        "performance_notes": "first",
                                        "image": null
                                    },
                                    "season": {
                                        "id": 9,
                                        "uuid": "b5d75130-7eee-4826-a315-fe9434e445e5",
                                        "name": "Summer 2021"
                                    }
                                },
                                {
                                    "id": 1,
                                    "uuid": "cdee14f3-ea7c-4d03-80b3-81e7c6018089",
                                    "owner_id": 4,
                                    "season_id": 8,
                                    "team_a_id": 1,
                                    "team_b_name": null,
                                    "tournament_name": "Tournament 0",
                                    "played_at": "2022-09-01T18:33:39.000000Z",
                                    "location": null,
                                    "team_a_image_uuid": null,
                                    "team_b_image_uuid": null,
                                    "team_b_score": 0,
                                    "team_b_goal_missed": 0,
                                    "game_finished": 1,
                                    "game_finished_at": "2022-09-01 08:21:29",
                                    "game_started": 1,
                                    "game_actually_started_at": "2022-09-01 07:46:37",
                                    "team_a_score": 9,
                                    "game_status": "Played",
                                    "match_results": "WON",
                                    "team_a_image": null,
                                    "team_b_image": null,
                                    "team_a": {
                                        "id": 1,
                                        "uuid": "5d50cafa-4e05-463c-9376-f212852c1166",
                                        "owner_id": 4,
                                        "image_uuid": null,
                                        "player_count": null,
                                        "name": "test team 01",
                                        "team_number": null,
                                        "metadata": null,
                                        "performance_notes": "first",
                                        "image": null
                                    },
                                    "season": {
                                        "id": 8,
                                        "uuid": "c39bfc56-d85a-47b3-94cd-97d3711123d0",
                                        "name": "Summer 2023"
                                    }
                                }
                            ],
                            "paginator": {
                                "current_page": 1,
                                "first_page_url": "http://127.0.0.1:8000/api/v1/match-result?page=1",
                                "from": 1,
                                "last_page": 1,
                                "last_page_url": "http://127.0.0.1:8000/api/v1/match-result?page=1",
                                "links": [
                                    {
                                        "url": null,
                                        "label": "&laquo; Previous",
                                        "active": false
                                    },
                                    {
                                        "url": "http://127.0.0.1:8000/api/v1/match-result?page=1",
                                        "label": "1",
                                        "active": true
                                    },
                                    {
                                        "url": null,
                                        "label": "Next &raquo;",
                                        "active": false
                                    }
                                ],
                                "next_page_url": null,
                                "path": "http://127.0.0.1:8000/api/v1/match-result",
                                "per_page": 15,
                                "prev_page_url": null,
                                "to": 2,
                                "total": 2
                            },
                            "message": "",
                            "result": true
                        }')
                        ->setSuccessPaginatedObject(Game::class);
                });

		// return a list of my games
		$filter = $this->repo->newSearchFilter(false);
		$items = $filter->where('owner_id', $request->user()->id)
                        ->where('game_started', true)
                        ->where('game_finished', true)
                        ->orderBy('id', 'desc');


		$items = $filter->with([
		    'team_a.image',
            // 'team_b',
            'season',
            'team_a_image',
        ]);

		//$items = $this->repo->search($filter);

        return response()->apiSuccessPaginated($items->paginate());
		//return response()->apiSuccess($items);
	}
}
