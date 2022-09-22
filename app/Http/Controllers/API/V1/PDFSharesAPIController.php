<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Files\File;
use App\Entities\Games\Game;
use App\Http\Controllers\API\V1\APIBaseController;
use App\Entities\PDFShares\PDFShare;
use App\Entities\Players\Player;
use App\Entities\Scores\Score;
use App\Entities\Teams\Team;
use App\Lib\PlayerPerformance;
use App\Lib\TeamPerformance;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PDFSharesAPIController extends APIBaseController
{

	protected function teamperformance(Request $request)
	{
		document(function () {
                	return (new APICall())
						->setGroup('Performance')
                	    ->setName('Team Performance PDF')
                	    ->setDescription('Get the team porformance PDF link from permalink param of the response')
                	    ->setParams([
                	        (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                        ])
                        ->setSuccessObject(File::class);
                });

				$this->validate($request, [
					'team_id' => 'required | integer',
				]);

				$errors =null;
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
				$team_name=null;
		
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
					$team_name = $teamvalue->name;
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
				$team_performance->team_name = $team_name;
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
				
					
					$docid = str_replace(' ', '', $team_name).'-'.time().'-'.mt_rand();
					
					$key = 'file_key_' . ((string) Str::uuid());
					$file = new File([
						'name' => 'team-performance',
						'key' => $key,
						'allow_public_access' => true,
						'original_filename' => $docid.'.pdf',
						'file_path' => 'pdf/team_performance/'.$docid.'.pdf',
						'file_disk' => 'local',
						'file_url'  => url('pdf/team_performance/'.$docid.'.pdf'),
						'file_size_bytes' => null,
						'uploaded_by_user_id' => 0,
					]);
					$file->category = 'system_generate';
					$file->save();
		
					$pdf = App::make('dompdf.wrapper');
					$pdf->loadView('team_performance_pdf',['errors'=>$errors,'performance'=>$team_performance]);
					Storage::put('pdf/team_performance/'.$docid.'.pdf', $pdf->output());
					//->save('pdf/team_performance/'.$docid.'.pdf');
					// $pdf->loadView('team_performance_pdf',['errors'=>$errors,'performance'=>$team_performance]);
					// return $pdf->stream();		

		$items = File::where('key',$key)->first();

		return response()->apiSuccess($items);
	}

	protected function playerperformance(Request $request)
	{
		document(function () {
                	return (new APICall())
						->setGroup('Performance')
                	    ->setName('Player Performance PDF')
                	    ->setDescription('Get the Player porformance PDF link from permalink param of the response')
                	    ->setParams([
                	        (new Param('team_id'))->dataType(Param::TYPE_INT)->setDescription('Team ID'),
                            (new Param('player_id'))->dataType(Param::TYPE_INT)->setDescription('Player ID'),
                        ])
                        ->setSuccessObject(File::class);
                });

				$this->validate($request, [
					'team_id' => 'required | integer',
                    'player_id' => 'required | integer',
				]);

				$errors =null;
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
			$player_name = $playervalue->name;
        }

		$player_performance->player_name =$player_name;
        $player_performance->comment = $comment;

        $docid = str_replace(' ', '', $player_name).'-'.time().'-'.mt_rand();
            
            $key = 'file_key_' . ((string) Str::uuid());
            $file = new File([
                'name' => 'player-performance',
                'key' => $key,
                'allow_public_access' => true,
                'original_filename' => $docid.'.pdf',
                'file_path' => 'pdf/player_performance/'.$docid.'.pdf',
                'file_disk' => 'local',
                'file_url'  => url('pdf/player_performance/'.$docid.'.pdf'),
                'file_size_bytes' => null,
                'uploaded_by_user_id' => 0,
            ]);
            $file->category = 'system_generate';
            $file->save();
		
					$pdf = App::make('dompdf.wrapper');
					$pdf->loadView('player_performance_pdf',['errors'=>$errors,'performance'=>$player_performance]);
					Storage::put('pdf/player_performance/'.$docid.'.pdf', $pdf->output());
							

		$items = File::where('key',$key)->first();

		return response()->apiSuccess($items);
	}

}
