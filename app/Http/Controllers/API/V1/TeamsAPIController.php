<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Games\Game;
use App\Entities\PlayerPerformances\PlayerPerformancemodel;
use App\Entities\Players\Player;
use App\Entities\Scores\Score;
use App\Entities\TeamPerformances\TeamPerformancemodel;
use App\Entities\Teams\Team;
use App\Entities\Teams\TeamsRepository;
use App\Http\Controllers\API\V1\APIBaseController;
use App\Lib\PlayerPerformance;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\Api\ModifyValidationFailedApiResponse;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use App\Lib\TeamPerformance;

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


    protected function performance(Request $request)
	{
		document(function () {
                	return (new APICall())
                        ->setGroup('Performance')
                	    ->setName('Team Performance')
                	    ->setDescription('Get the team porformance')
                	    ->setParams([
                            (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                        ])
                        ->setSuccessObject(TeamPerformancemodel::class);
                });

                $this->validate($request, [
					'team_id' => 'required | integer',
				]);

        $scores = Score::where('team_id',$request->team_id)->get();
        $game = Game::where('team_a_id',$request->team_id)->get();
        $team = Team::where('id',$request->team_id)->get();

        if (!$scores) {
            return response()->apiError('Data not available.');
        }

        (int)$team_id=$request->team_id;
        $goal_in_total=0;
        $goal_missed_total=0;
        $b_goal_in_total=0;
        $b_goal_missed_total=0;
        $centre_total=0;
        $total_error_record=0;
        $total_contract=0;
        $total_center_pass=0;
        $total_intercept=0;
        $total_tip=0;
        $total_rebound=0;
        $comment=null;

        foreach ($scores as  $value) {
            $goal_in_total += $value->score; 
            $goal_missed_total += $value->goal_missed;
            $centre_total += $value->center_pass;
            $total_error_record += $value->error_record;
            $total_contract += $value->contract;
            $total_intercept += $value->intercept;
            $total_tip += $value->tip;
            $total_rebound += $value->rebound;
        }

        foreach ($game as  $gamevalue) {
            $b_goal_in_total += $gamevalue->team_b_score; 
            $b_goal_missed_total += $gamevalue->team_b_goal_missed;
        }

        foreach ($team as  $teamvalue) {
            $comment = $teamvalue->performance_notes; 
        }

        $team_performance = new TeamPerformance;

        $team_a_total = ($goal_in_total+$goal_missed_total);
        $team_b_total = ($b_goal_in_total+$b_goal_missed_total);
        if ($team_a_total==null || $team_a_total==0) {
            $team_a_total = 1;
        }
        if ($team_b_total==null || $team_b_total==0) {
            $team_b_total = 1;
        }

        $goal_in_total_devident=$goal_in_total;
        if ($goal_in_total==null || $goal_in_total==0) {
            $goal_in_total_devident = 0;
        }
        $team_performance->team_id = (int)$team_id;
        $team_performance->team_conversion = round(($goal_in_total/$team_a_total)*100,2);
        $team_performance->opposition_conversion = round(($b_goal_in_total/$team_b_total)*100,2);
        $team_performance->center_pass_conversion = round(($centre_total/$goal_in_total_devident)*100,2);
        $team_performance->goal_in = $goal_in_total;
        $team_performance->goal_missed = $goal_missed_total;
        $team_performance->error_record = $total_error_record;
        $team_performance->contract = $total_contract;
        $team_performance->center_pass = $centre_total;
        $team_performance->intercept = $total_intercept;
        $team_performance->tip = $total_tip;
        $team_performance->rebound = $total_rebound;
        $team_performance->comment = $comment;
        


		return response()->apiSuccess($team_performance);
	}

    protected function playerperformance(Request $request)
	{
		document(function () {
                	return (new APICall())
                        ->setGroup('Performance')
                	    ->setName('Player Performance')
                	    ->setDescription('Get the player porformance')
                	    ->setParams([
                            (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                            (new Param('player_id'))->dataType(Param::TYPE_INT)->setDescription('Player ID'),
                        ])
                        ->setSuccessObject(PlayerPerformancemodel::class);
                });

                $this->validate($request, [
					'team_id' => 'required | integer',
                    'player_id' => 'required | integer',
				]);

        $scores = Score::where('team_id',$request->team_id)
                        ->where('player_id',$request->player_id)            
                        ->get();

        if (!$scores) {
            return response()->apiError('Data not available.');
        }

        (int)$team_id=$request->team_id;
        (int)$player_id=$request->player_id;
        $goal_in_total=0;
        $goal_missed_total=0;
        $centre_total=0;
        $total_error_record=0;
        $total_contract=0;
        $total_center_pass=0;
        $total_intercept=0;
        $total_tip=0;
        $total_rebound=0;
        $comment=null;

        foreach ($scores as  $value) {
            $goal_in_total += $value->score; 
            $goal_missed_total += $value->goal_missed;
            $centre_total += $value->center_pass;
            $total_error_record += $value->error_record;
            $total_contract += $value->contract;
            $total_intercept += $value->intercept;
            $total_tip += $value->tip;
            $total_rebound += $value->rebound;
        }

        $player_total = ($goal_in_total+$goal_missed_total);

        if ($player_total==null || $player_total==0) {
            $player_total = 1;
        }

        $player_performance = new PlayerPerformance;

        
        $player_performance->team_id = (int)$team_id;
        $player_performance->player_id = (int)$player_id;
        $player_performance->conversion = round(($goal_in_total/$player_total)*100,2);
        $player_performance->goal_in = $goal_in_total;
        $player_performance->goal_missed = $goal_missed_total;
        $player_performance->error_record = $total_error_record;
        $player_performance->contract = $total_contract;
        $player_performance->center_pass = $centre_total;
        $player_performance->intercept = $total_intercept;
        $player_performance->tip = $total_tip;
        $player_performance->rebound = $total_rebound;
        
        $player = Player::where('id',$request->player_id)
                    ->where('team_id',$request->team_id)->get();
        foreach ($player as  $playervalue) {
            $comment = $playervalue->performance_notes;
        }

        $player_performance->comment = $comment;

		return response()->apiSuccess($player_performance);
	}

    protected function playerperformancecomment(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setGroup('Performance')
                ->setName('Player Performance Comment')
                ->setDescription('Store the player porformance comment')
                ->setParams([
                    (new Param('player_id'))->dataType(Param::TYPE_INT)->setDescription('player id'),
                    (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                    (new Param('comment'))->dataType(Param::TYPE_STRING)->setDescription('performance comment'),
                ]);
        });

        $this->validate($request, [
            'player_id' => 'required | integer',
            'team_id' => 'required | integer',
            'comment' => 'required | string',
        ]);

        $player = Player::where('id',$request->player_id)
                    ->where('team_id',$request->team_id)->first();

        if (!$player) {
            return response()->apiError('Player not found.');
        }

        $player->performance_notes = $request->comment;
        $player->save();

        return response()->apiSuccess('success');
    }

    protected function teamperformancecomment(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setGroup('Performance')
                ->setName('Team Performance Comment')
                ->setDescription('Store the tesm porformance comment')
                ->setParams([
                    (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                    (new Param('comment'))->dataType(Param::TYPE_STRING)->setDescription('performance comment'),
                ]);
        });

        $this->validate($request, [
            'team_id' => 'required | integer',
            'comment' => 'required | string',
        ]);

        $team = Team::where('id',$request->team_id)->first();

        if (!$team) {
            return response()->apiError('team not found.');
        }

        $team->performance_notes = $request->comment;
        $team->save();

        return response()->apiSuccess('success');
    }

    protected function gametime(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setGroup('Performance')
                ->setName('Player game time')
                ->setDescription('player game time')
                ->setSuccessPaginatedObject(Score::class)
                ->setSuccessExample('
                {
                    "payload": [
                        {
                            "id": 1,
                            "uuid": "c279f77d-85de-4bfe-b249-73fe96c288dc",
                            "game_id": 1,
                            "time_segment": "Quarter 1",
                            "position": "2",
                            "player_id": 1,
                            "score": 5,
                            "active_player": 1,
                            "error_record": 0,
                            "contract": 0,
                            "center_pass": 0,
                            "intercept": 0,
                            "tip": 0,
                            "rebound": 0,
                            "goal_missed": 2,
                            "positionPreferedPlayers": [
                                {
                                    "id": 2,
                                    "uuid": "20ee2fe7-9a73-401a-be23-795ef8aa5c78",
                                    "team_id": 1,
                                    "image_uuid": null,
                                    "name": "asdcdd",
                                    "email": "nb@gmail.com",
                                    "positions": "1,2,3",
                                    "metadata": null,
                                    "performance_notes": null,
                                    "prefered_positions": [
                                        {
                                            "id": 1,
                                            "name": "Goal Keeper",
                                            "short_name": "GK"
                                        },
                                        {
                                            "id": 2,
                                            "name": "Goal Defence",
                                            "short_name": "GD"
                                        },
                                        {
                                            "id": 3,
                                            "name": "Wing Defence",
                                            "short_name": "WD"
                                        }
                                    ],
                                    "image": null
                                },
                                {
                                    "id": 3,
                                    "uuid": "b0b15d02-4e33-40f3-9bbd-3a9fe647921f",
                                    "team_id": 1,
                                    "image_uuid": null,
                                    "name": "asdcdd",
                                    "email": "nb@gmail.com",
                                    "positions": "1,2,3",
                                    "metadata": null,
                                    "performance_notes": null,
                                    "prefered_positions": [
                                        {
                                            "id": 1,
                                            "name": "Goal Keeper",
                                            "short_name": "GK"
                                        },
                                        {
                                            "id": 2,
                                            "name": "Goal Defence",
                                            "short_name": "GD"
                                        },
                                        {
                                            "id": 3,
                                            "name": "Wing Defence",
                                            "short_name": "WD"
                                        }
                                    ],
                                    "image": null
                                }
                            ],
                            "position_obj": {
                                "id": 2,
                                "name": "Goal Defence",
                                "short_name": "GD"
                            }
                        },
                        {
                            "id": 2,
                            "uuid": "8e96f352-65fc-4f9a-a3dc-08dac6474a61",
                            "game_id": 1,
                            "time_segment": "Quarter 1",
                            "position": "5",
                            "player_id": 1,
                            "score": 2,
                            "active_player": 0,
                            "error_record": 0,
                            "contract": 0,
                            "center_pass": 0,
                            "intercept": 0,
                            "tip": 0,
                            "rebound": 0,
                            "goal_missed": 0,
                            "positionPreferedPlayers": [],
                            "position_obj": {
                                "id": 5,
                                "name": "Goal Attack",
                                "short_name": "GA"
                            }
                        }
                    ],
                    "message": "",
                    "result": true
                }
                ')
                ->setParams([
                    (new Param('game_id'))->dataType(Param::TYPE_INT)->setDescription('Game ID'),
                    (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                    (new Param('player_id'))->dataType(Param::TYPE_INT)->setDescription('Player ID'),
                ]);
        });

        $this->validate($request, [
            'team_id' => 'required | integer',
            'game_id' => 'required | integer',
            'player_id' => 'required | integer',
        ]);

        $team = Score::where('game_id',$request->game_id)
                        ->where('team_id',$request->team_id)
                        ->where('player_id',$request->player_id)
                        ->get();

        if (!$team) {
            return response()->apiError('player not found.');
        }

        return response()->apiSuccess($team);
    }

    protected function team_players(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setGroup('Performance')
                ->setName('Team Players with game time')
                ->setDescription('Team player and game time')
                ->setSuccessPaginatedObject(Player::class)
                ->setSuccessExample('
                {
                    "payload": [
                        {
                            "id": 1,
                            "uuid": "0a0b846c-3811-46f0-b405-def00f9aef16",
                            "team_id": 1,
                            "image_uuid": null,
                            "name": "Nishshanka B",
                            "email": null,
                            "positions": "2",
                            "metadata": null,
                            "performance_notes": "second comment",
                            "prefered_positions": [
                                {
                                    "id": 2,
                                    "name": "Goal Defence",
                                    "short_name": "GD"
                                }
                            ],
                            "image": null,
                            "game_time": [
                                {
                                    "game_id": 1,
                                    "team_id": 1,
                                    "time_segment": "Quarter 1",
                                    "played_positions": "GA/WA",
                                    "position_obj": {
                                        "id": 5,
                                        "name": "Goal Attack",
                                        "short_name": "GA"
                                    }
                                },
                                {
                                    "game_id": 1,
                                    "team_id": 1,
                                    "time_segment": "Quarter 2",
                                    "played_positions": "GA/WA",
                                    "position_obj": {
                                        "id": 4,
                                        "name": "Wing Attack",
                                        "short_name": "WA"
                                    }
                                }
                            ]
                        },
                        {
                            "id": 2,
                            "uuid": "20ee2fe7-9a73-401a-be23-795ef8aa5c78",
                            "team_id": 1,
                            "image_uuid": null,
                            "name": "asdcdd",
                            "email": "nb@gmail.com",
                            "positions": "1,2,3",
                            "metadata": null,
                            "performance_notes": null,
                            "prefered_positions": [
                                {
                                    "id": 1,
                                    "name": "Goal Keeper",
                                    "short_name": "GK"
                                },
                                {
                                    "id": 2,
                                    "name": "Goal Defence",
                                    "short_name": "GD"
                                },
                                {
                                    "id": 3,
                                    "name": "Wing Defence",
                                    "short_name": "WD"
                                }
                            ],
                            "image": null,
                            "game_time": [
                                {
                                    "game_id": 1,
                                    "team_id": 1,
                                    "time_segment": "Quarter 2",
                                    "played_positions": "GA",
                                    "position_obj": {
                                        "id": 5,
                                        "name": "Goal Attack",
                                        "short_name": "GA"
                                    }
                                }
                            ]
                        },
                        {
                            "id": 3,
                            "uuid": "b0b15d02-4e33-40f3-9bbd-3a9fe647921f",
                            "team_id": 1,
                            "image_uuid": null,
                            "name": "asdcdd",
                            "email": "nb@gmail.com",
                            "positions": "1,2,3",
                            "metadata": null,
                            "performance_notes": null,
                            "prefered_positions": [
                                {
                                    "id": 1,
                                    "name": "Goal Keeper",
                                    "short_name": "GK"
                                },
                                {
                                    "id": 2,
                                    "name": "Goal Defence",
                                    "short_name": "GD"
                                },
                                {
                                    "id": 3,
                                    "name": "Wing Defence",
                                    "short_name": "WD"
                                }
                            ],
                            "image": null,
                            "game_time": [
                                {
                                    "game_id": 1,
                                    "team_id": 1,
                                    "time_segment": "Quarter 1",
                                    "played_positions": "GD",
                                    "position_obj": {
                                        "id": 2,
                                        "name": "Goal Defence",
                                        "short_name": "GD"
                                    }
                                }
                            ]
                        }
                    ],
                    "paginator": {
                        "current_page": 1,
                        "first_page_url": "http://127.0.0.1:8000/api/v1/team-players?page=1",
                        "from": 1,
                        "last_page": 1,
                        "last_page_url": "http://127.0.0.1:8000/api/v1/team-players?page=1",
                        "links": [
                            {
                                "url": null,
                                "label": "&laquo; Previous",
                                "active": false
                            },
                            {
                                "url": "http://127.0.0.1:8000/api/v1/team-players?page=1",
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
                        "path": "http://127.0.0.1:8000/api/v1/team-players",
                        "per_page": 15,
                        "prev_page_url": null,
                        "to": 3,
                        "total": 3
                    },
                    "message": "",
                    "result": true
                }
                ')
                ->setParams([
                    'page|Page number',
                    (new Param('game_id'))->dataType(Param::TYPE_INT)->setDescription('Game ID'),
                    (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                ]);
        });

        $this->validate($request, [
            'team_id' => 'required | integer',
            'game_id' => 'required | integer',
        ]);
        
        $team = Player::with(['gameTime' => function($q) use ($request){ 
                            $q->where('team_id','=',$request->team_id)
                            ->where('game_id','=' ,$request->game_id); 
                        }])
                        ->wherehas('gameTime', function ($query) use ($request){
                            $query->where('team_id', '=',$request->team_id)
                            ->where('game_id','=' ,$request->game_id);
                        });

        if (!$team) {
            return response()->apiError('team not found.');
        }

        return response()->apiSuccessPaginated($team->paginate());
    }
}
