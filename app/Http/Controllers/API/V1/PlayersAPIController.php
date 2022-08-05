<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Players\Player;
use App\Entities\PlayerPositions\PlayerPosition;
use App\Entities\Players\PlayersRepository;
use App\Entities\Teams\Team;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

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
                                (new Param('position_id'))->dataType(Param::TYPE_INT)
                                ->setDescription('Position ID.')->optional(),
                        ])
                        ->setSuccessPaginatedObject(Player::class);
                });

        $this->validate($request, [
            'team_id' => 'required',
        ]);

        $filter = $this->repo->newSearchFilter();

        $items = $filter->where('owner_id', $request->user()->id);
        $items = $filter->where('team_id', $request->team_id);
        
        if(!empty($request->position_id))
        {
            $items = $filter->whereRaw("find_in_set('".$request->team_id."',positions)");
        }
        $items = $filter->orderBy('name');

		//$items = $this->repo->search($filter);

		//return response()->apiSuccess($items);
        return response()->apiSuccessPaginated($items->paginate());
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function store(Request $request)
    // {
    //     document(function () {
    //         return (new APICall())
    //             ->setName('Create Player')
    //             ->setParams([
    //                 'name|String|Player name',
    //                 'email|String|optional',
    //                 'positions|String|List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field',
    //                 'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
    //                 'team_id|Team ID|optional',
    //             ])
    //             ->setSuccessObject(Player::class);
    //     });


    //     $this->validate($request, $this->repo->getModel()->getCreateRules());

    //     try {
    //         $image = $this->getImageFromRequest($request);
    //     } catch (FileNotFoundException $e) {
    //         return response()->apiError('Invalid file UUID. Try uploading the file again.');
    //     }

    //     $model = $this->repo->create($request->all());
    //     $model->owner()->associate($request->user());
    //     if ($image) $model->image()->associate($image);
    //     $model->save();

    //     return response()->apiSuccess($model);
    // }

    protected function validEmail($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }

    // Store multiple players
    public function store(Request $request)
    {
        document(function () {
            return (new APICall())
                ->setName('Create Team and Players')
                ->setParams([
                    (new Param('team_name'))->dataType(Param::TYPE_STRING)
                                ->setDescription('Team Name'),
                    (new Param('team_number'))->dataType(Param::TYPE_STRING)
                                ->setDescription('Team Number')->optional(),
                    (new Param('player_count'))->dataType(Param::TYPE_INT)
                                ->setDescription('Team Player Count')->optional(),
                    (new Param('team_image_uuid'))->dataType(Param::TYPE_STRING)
                                ->setDescription('Team Image')->optional(),
                    (new Param('players'))->setDescription('List of Players. Example 

                               [
                                    {
                                        "name":"wije", //player name required
                                        "positions":"1,2", //player positions as comma separated string - optional
                                        "image_uuid":"e41b5ecc-ca36-4648-abc2-eee71ba06275", //uuid of the image - optional
                                        "email":"abc.emedia@gmail.com", //email address - optional
                                    },
                                    {
                                        "name":"arjun",
                                        "positions":"1"
                                    }
                                ] '
                    ),
                ])
                ->setSuccessObject(Team::class);
        });
        
        $this->validate($request, $this->repo->getModel()->getCreateRules(),$this->repo->getModel()->getCreateValidationMessages());
        $data = json_decode($request->players);
        //$this->validate($data, $this->repo->getModel()->getPlayerRules(),$this->repo->getModel()->getPlayerValidationMessages());
        foreach( $data as $key => $alldata)
        {
            if(empty($alldata -> name))
            {
                return response()->apiError('Player name required');
            }
            if(!empty($alldata -> email))
            {
                if(!self::validEmail($alldata -> email)){
                    return response()->apiError('Players email must be a valid email');
                }
            }
        }

        $playersdata=[];
        $team=[];
        $items=null;
        $team_uuid = Str::uuid();
        $team_name=$request->team_name;
        $team_number=$request->team_number ?? null;
        $team_player_count=$request->player_count ?? null;
        $team_image_uuid=$request->team_image_uuid ?? null;
        $datetimenow=now();

        $team['uuid'] = $team_uuid;
        $team['owner_id'] = $request->user()->id;
        $team['image_uuid'] = $team_image_uuid;
        $team['player_count'] = $team_player_count;
        $team['name'] = $team_name;
        $team['team_number'] = $team_number;
        $team['created_at'] = $datetimenow;
        $team['updated_at'] = $datetimenow;

        //$res_team = Team::insert($team);
        $res_team_id = DB::table('teams')->insertGetId($team);
        
        if(!($res_team_id>0))
        {
            return response()->apiError();
        }
        
       
        foreach( $data as $key => $alldata)
        {
            
            $player=[];
            $uuid = Str::uuid();
            
            $player['uuid'] = $uuid;
            $player['owner_id'] = $request->user()->id;
            $player['image_uuid'] = $alldata -> image_uuid ?? null;
            $player['name'] = $alldata -> name;
            $player['email'] = $alldata ->email ?? null;
            $player['positions'] = $alldata ->positions ?? null;
            $player['team_id'] = $res_team_id;
            $player['created_at'] = $datetimenow;
            $player['updated_at'] = $datetimenow;

            $playersdata[]=$player;
            
        }
        $res = Player::insert($playersdata);
        if($res)
        {            
            $items = Team::find($res_team_id);                         
        }
        else
        {
            return response()->apiError();
        }
        
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
                ->setName('Update Player')
                ->setParams([
                    (new Param('uuid'))->setDescription('uuid of the Player to update')->setLocation(Param::LOCATION_PATH),
                    'name|String|Player name',
                    'email|String|optional',
                    'positions|String|List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field',
                    'image_uuid|UUID for the team profile picture. Get a UUID from file upload endpoint|optional',
                ])
                ->setSuccessObject(Player::class);
        });

        
        $this->validate($request, $this->repo->getModel()->getUpdateRules());

        $model = $this->repo->findByUuid($uuid);
        if (!$model) {
            return response()->apiError();
        }

        try {
            $image = $this->getImageFromRequest($request);
        } catch (FileNotFoundException $e) {
            return response()->apiError('Invalid file UUID. Try uploading the file again.');
        }

        $model = $this->repo->update($model,$request->all());

        $items = Player::where('uuid', $uuid)->first();

        return response()->apiSuccess($items);
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

    protected function ppositions(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setName('List Players Positions')
                	    ->setParams([
                	        // 'q|Search query',
                	        'page|Page number',
                        ])
                        ->setSuccessPaginatedObject(PlayerPosition::class);
                });

        return response()->apiSuccessPaginated(PlayerPosition::paginate());
	}
}
