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
                	        'page|Page number',
                        ])
                        ->setSuccessPaginatedObject(Score::class);
                });

        $filter = $this->repo->newSearchFilter(false);
        $filter->whereHas('game', function ($q) use ($gameUuid) {
        	$q->where('uuid', $gameUuid);
        });
        $filter->with([
            'player',
        	// 'game',
        ]);
		$items = $this->repo->search($filter);

		return response()->apiSuccess($items);
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
                ->setDescription('Create a new score for a player. Each record will be unique by `gameUuid`, `player_id`, `position` and `time_segment`. If the record already exists, it will be updated. If a score record must be deleted, you should send a null score value or use delete endpoint.')
                ->setParams([
                    (new Param('gameUuid'))
                        ->setLocation(Param::LOCATION_PATH)
                        ->setDescription('Game UUID'),
                    'player_id|Integer|required|Player ID',
                    'position|String|required|Position of the player in the game',
                    'time_segment|String|required|Time segment on game. Examples `Quarter 1`, `Quarter 2`, `Quarter 3`, `Quarter 4`, `Overtime`, `Shootout`',
                    'score|Integer|required|To delete a record, send a score of `null`. ',
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

        $scoreValue = $request->input('score');

        // find and existing score or create a new one
        $score = Score::where('game_id', $game->id)
            ->where('player_id', $request->input('player_id'))
            ->where('position', $request->input('position'))
            ->where('time_segment', $request->input('time_segment'))
            ->first();

        if ($scoreValue === null) {
            // delete score
            if ($score) {
                $score->delete();
            }
        } else {
            // create or update score
            if (!$score) {
                $score = new Score();
                $score->game_id = $game->id;
                $score->player_id = $player->id;
                $score->position = $request->input('position');
                $score->time_segment = $request->input('time_segment');
            }
            $score->score = $scoreValue;
            $score->save();
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

}
