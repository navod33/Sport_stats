<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\APIBaseController;
use App\Entities\MatchSetups\MatchSetupsRepository;
use App\Entities\MatchSetups\MatchSetup;
use App\Entities\Scores\Score;
use App\Entities\Scores\ScoresRepository;
use EMedia\Api\Docs\APICall;
use Illuminate\Http\Request;
use EMedia\Api\Docs\Param;
use Illuminate\Support\Str;

class MatchSetupsAPIController extends APIBaseController
{

	protected $repo;

	public function __construct(ScoresRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
						->setName('Current Match')
                	    ->setDescription('Get a match details for a time segment')
                	    ->setParams([
							(new Param('game_id'))->dataType(Param::TYPE_INT)
						->setDescription('Game ID'),
							(new Param('team_id'))->dataType(Param::TYPE_INT)
						->setDescription('Team ID'),
                	        (new Param('time_segment'))->dataType(Param::TYPE_INT)
						->setDescription('If the time segment is Quater 1. then, just send 1.'),
                        ])
						->setSuccessObject(Score::class);
                        ;
                });

				$this->validate($request, [
					'team_id' => 'required | integer',
					'game_id' => 'required | integer',
					'time_segment' => 'integer',
				]);

				$filter = $this->repo->newSearchFilter(false);
				$filter->where('game_id', $request->game_id)
								->where('team_id', $request->team_id);
						if ($request->time_segment !='') {
							$filter->where('time_segment','like', '%'.$request->time_segment);
						}
				$items = $filter->with([
									'player',
									'position_obj',
								])->get();
				
				return response()->apiSuccess($items);
	}

	protected function store(Request $request)
	{
		document(function () {
			return (new APICall())
				->setName('Match Setup')
				->setParams([
					(new Param('game_id'))->dataType(Param::TYPE_INT)
						->setDescription('Game ID'),
					(new Param('team_id'))->dataType(Param::TYPE_INT)
						->setDescription('Team ID'),
					(new Param('players'))
						->setDescription('players array. player id required. position required. 
						(get the position id from the List Players Positions API end point). time_segment required. if the time segment is Quater 1. then, just send 1.


						[
							{
							"player_id" : 1,
							"position" : 2,
							"time_segment" : 1,
							},
							{
							"player_id" : 2,
							"position" : 5,
							"time_segment" : 1,
							},
							{
							"player_id" : 1,
							"position" : 5,
							"time_segment" : 2,
							}
							]
						'),
				]);
				// ->setSuccessPaginatedObject(Player::class);
		});

		$this->validate($request, [
            'team_id' => 'required | integer',
			'game_id' => 'required | integer',
			'players' => 'required | string',
        ]);

		$data = json_decode($request->players);
		$i=0;
		
		// foreach( $data as $key => $alldata)
        // {
		// 	$i++;
			
        //     if(empty($alldata -> player_id))
        //     {
        //         return response()->apiError('Player ID required');
        //     }
        //     if(empty($alldata -> position))
        //     {
        //         return response()->apiError('Player position required'.$i);
        //     }
		// 	if(empty($alldata -> time_segment))
        //     {
        //         return response()->apiError('Time segment required');
        //     }
        // }

		
		$datetimenow=now();
		$team_id=$request->team_id;
		$game_id=$request->game_id;

		$playersdata=[];

		foreach( $data as $key => $alldata)
        {
            
            $player=[];
            $score_uuid = Str::uuid();
            
            $player['uuid'] = $score_uuid;
            $player['game_id'] = $game_id;
            $player['team_id'] = $team_id;
            $player['time_segment'] = 'Quarter '.$alldata ->time_segment;
            $player['position'] = $alldata ->position;
            $player['player_id'] = $alldata ->player_id;
			$player['score'] = 0;
            $player['created_at'] = $datetimenow;
            $player['updated_at'] = $datetimenow;

            $playersdata[]=$player;
            
        }

		$res = Score::insert($playersdata);
        if(!$res)
        {            
            return response()->apiError("match setup error");                         
        }

		return response()->apiSuccess("success");
	}

}
