<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Games\Game;
use App\Entities\Players\Player;
use App\Entities\Scores\Score;
use App\Entities\Scores\ScoresRepository;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Http\Request;

class ScoresAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(ScoresRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request, $gameUuid)
	{
		document(function () {
                	return (new APICall())
                	    ->setName('List Scores per Game')
                	    ->setDescription('Get a list of scores for a game. Pagination is supported.')
                	    ->setParams([
                            (new Param('gameUuid'))
                        ->setLocation(Param::LOCATION_PATH)
                        ->setDescription('Game UUID'),
                	        'page|Page number',
                            (new Param('time_segment'))
                        ->dataType(Param::TYPE_INT)
                        ->setDescription('Time segment. if quater 1, then send 1.')
                        ->optional()
                        ])
                        ->setSuccessPaginatedObject(Score::class);
                });

        //$filter = $this->repo->newSearchFilter(false);
        $items = Score::whereHas('game', function ($q) use ($gameUuid) {
        	$q->where('uuid', $gameUuid);
        })->with([
            'player',
        	'position_obj',
        ])->when(request('time_segment'), function ($query) {
            
                $query->where('time_segment', 'like', '%' . request('time_segment'));
            
        })->when(!request('time_segment'), function ($query) {
            
            $query->where('time_segment', 'Quarter 1');
        
    });
		 
		return response()->apiSuccessPaginated($items->paginate());
	}


    /**
     * @param Request $request
     * @param $gameUuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(Request $request, $gameUuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Create Score')
                ->setDescription('Create a new score for a player. Each record will be unique by `gameUuid`, `player_id`, `position` and `time_segment`. If the record already exists, it will be updated. ')
                ->setParams([
                    (new Param('gameUuid'))
                        ->setLocation(Param::LOCATION_PATH)
                        ->setDescription('Game UUID'),
                    'player_id|Integer|required|Player ID',
                    'position|String|required|Position of the player in the game',
                    'time_segment|String|required|Time segment on game. Examples `Quarter 1`, `Quarter 2`, `Quarter 3`, `Quarter 4`, `Overtime`, `Shootout`',
                    'score_type|String|required| `goal_in`,`goal_missed`, `error_record`,
                    `contract`,
                    `center_pass`,
                    `intercept`,
                    `tip`,
                    `rebound`,
                    `goal_in_reverse`,
                    `goal_missed_reverse`,
                    `error_record_reverse`,
                    `contract_reverse`,
                    `center_pass_reverse`,
                    `intercept_reverse`,
                    `tip_reverse`,
                    `rebound_reverse`'
                ])
                ->setSuccessObject(Score::class);
        });

        $game = Game::where('uuid', $gameUuid)->first();
        if (!$game) {
            return response()->apiError('Game not found.', 404);
        }

        $player = Player::where('id', $request->input('player_id'))
                        ->where('owner_id', $request->user()->id)
                        ->first();

        if (!$player) {
            return response()->apiError('Player not found.', 404);
        }

        $scoreValue = $request->input('score_type');

        // find and existing score or create a new one
        $score = Score::where('game_id', $game->id)
            ->where('player_id', $request->input('player_id'))
            ->where('position', $request->input('position'))
            ->where('time_segment', $request->input('time_segment'))
            ->first();

        if ($scoreValue == 'goal_in') {
            $score->score = $score->score+1;
            $score->save();
        } 
        else if ($scoreValue == 'goal_missed')
        {
            // create or update score
            // if (!$score) {
            //     $score = new Score();
            //     $score->game_id = $game->id;
            //     $score->player_id = $player->id;
            //     $score->position = $request->input('position');
            //     $score->time_segment = $request->input('time_segment');
            // }
            $score->goal_missed = $score->goal_missed+1;
            $score->save();
        }
        else if ($scoreValue == 'error_record')
        {
            $score->error_record = $score->error_record+1;
            $score->save();
        }

        else if ($scoreValue == 'contract')
        {
            $score->contract = $score->contract+1;
            $score->save();
        }

        else if ($scoreValue == 'center_pass')
        {
            $score->center_pass = $score->center_pass+1;
            $score->score = $score->score+1;
            $score->save();
        }

        else if ($scoreValue == 'intercept')
        {
            $score->intercept = $score->intercept+1;
            $score->save();
        }

        else if ($scoreValue == 'tip')
        {
            $score->tip = $score->tip+1;
            $score->save();
        }

        else if ($scoreValue == 'rebound')
        {
            $score->rebound = $score->rebound+1;
            $score->save();
        }

        else if ($scoreValue == 'goal_missed_reverse')
        {
            if($score->goal_missed >0)
            {
                $score->goal_missed = $score->goal_missed-1;
                $score->save();
            }
            
        }
        else if ($scoreValue == 'error_record_reverse')
        {
            if($score->error_record >0)
            {
            $score->error_record = $score->error_record-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'contract_reverse')
        {
            if($score->contract >0)
            {
            $score->contract = $score->contract-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'center_pass_reverse')
        {
            if($score->center_pass >0)
            {
            $score->center_pass = $score->center_pass-1;
            $score->score = $score->score-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'intercept_reverse')
        {
            if($score->intercept >0)
            {
            $score->intercept = $score->intercept-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'tip_reverse')
        {
            if($score->tip >0)
            {
            $score->tip = $score->tip-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'rebound_reverse')
        {
            if($score->rebound >0)
            {
            $score->rebound = $score->rebound-1;
            $score->save();
            }
        }

        else if ($scoreValue == 'goal_in_reverse')
        {
            if($score->score >0)
            {
            $score->score = $score->score-1;
            $score->save();
            }
        }

        return response()->apiSuccess($score);
    }

    /**
     * @param Request $request
     * @param $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $gameUuid, $uuid)
    {
        document(function () {
            return (new APICall())
                ->setName('Delete Score')
                ->setDescription('Delete a score record.')
                ->setParams([
                    (new Param('uuid'))
                        ->setLocation(Param::LOCATION_PATH)
                        ->setDescription('Score UUID'),
                        (new Param('gameUuid'))
                        ->setLocation(Param::LOCATION_PATH)
                        ->setDescription('Game UUID'),
                ]);
        });

        $score = Score::where('uuid', $uuid)->first();
        if (!$score) {
            return response()->apiError('Score not found.', 404);
        }

        // only allow score's game owner to delete it
        if ($score->game->owner_id !== (int)$request->user()->id) {
            return response()->apiError('You are not allowed to delete this score.', 403);
        }

        $score->delete();

        return response()->apiSuccess();
    }

    protected function teambscore(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setName('Create Team B Score')
                ->setDescription('Create a new score for team B.')
                ->setParams([
                    (new Param('gameUuid'))
                        ->setDescription('Game UUID')->required(),
                    'score_type|String|required| `goal_in`,`goal_missed`,`goal_in_reverse`,`goal_missed_reverse`'
                ])
                ->setSuccessObject(Game::class);
        });

        $game = Game::where('uuid', $request->gameUuid)->first();
        if (!$game) {
            return response()->apiError('Game not found.', 404);
        }

        $scoreValue = $request->input('score_type');

        if ($scoreValue == 'goal_in') {
            $game->team_b_score = $game->team_b_score+1;
            $game->save();
        }

        else if ($scoreValue == 'goal_missed') {
            $game->team_b_goal_missed = $game->team_b_goal_missed+1;
            $game->save();
        }

        else if ($scoreValue == 'goal_in_reverse') {
            if($game->team_b_score >0)
            {
            $game->team_b_score = $game->team_b_score-1;
            $game->save();
            }
        }

        else if ($scoreValue == 'goal_missed_reverse') {
            if($game->team_b_goal_missed >0)
            {
            $game->team_b_goal_missed = $game->team_b_goal_missed-1;
            $game->save();
            }
        }

        return response()->apiSuccess($game);
    }
   
}
