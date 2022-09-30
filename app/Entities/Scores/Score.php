<?php

namespace App\Entities\Scores;

use App\Entities\Games\Game;
use App\Entities\PlayerPositions\PlayerPosition;
use App\Entities\Players\Player;
use ElegantMedia\OxygenFoundation\Database\Eloquent\Traits\AssignsUuid;
use EMedia\Formation\Entities\GeneratesFields;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    use HasFactory;
	use SearchableLike;
	use GeneratesFields;
	use AssignsUuid;

	// use \Cviebrock\EloquentSluggable\Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    /*
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    */

	protected $fillable = [
		'game_id',
        'team_id',
		'player_id',
		'position',
		'score',
		'time_segment',
        'active_player',
        'uuid',
        'error_record',
        'contract',
        'center_pass',
        'intercept',
        'tip',
        'rebound',
        'goal_missed',
	];

	protected $searchable = [
		'position'
	];

	protected $editable = [
    	'name',
    ];

    protected $hidden = [
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with =[
        'position_obj',
    ];
    public function getExtraApiFields()
    {
        return [
            'player' => ['type' => 'object', 'items' => 'Player'],
            'position_obj' => ['type' => 'object', 'items' => 'PlayerPosition'],
            'positionPreferedPlayers' => ['type' => 'array', 'items' => 'Player'],    
        ];
        
    }

    /**
     *
     * Add any update only validation rules for this model
     *
     * @return array
     */
    public function getCreateRules()
    {
        return [
            'game_id' => 'required',
            'position' => 'required',
            'player_id' => 'required',
            'time_segment' => 'required',
        ];
    }

    /**
     *
     * Add any update only validation rules for this model
     *
     * @return array
     */
    public function getUpdateRules()
    {
        return [
            'game_id' => 'required',
            'position' => 'required',
            'player_id' => 'required',
            'time_segment' => 'required',
        ];
    }

    /**
     *
     * Add any update only validation messations
     *
     * @return array
     */
    public function getCreateValidationMessages()
    {
        return [];
    }

    /**
     *
     * Add any update only validation messations
     *
     * @return array
     */
    public function getUpdateValidationMessages()
    {
        return [];
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function position_obj()
    {
        return $this->belongsTo(PlayerPosition::class,'position');
    }

    public $appends = [ 'positionPreferedPlayers'];

    public function getPositionPreferedPlayersAttribute()
    {   
        return $res = Player::where('positions','like','%'. $this->position .'%')
                        ->where('team_id',$this->team_id)
                        ->where('id','!=',$this->player_id)
                        ->get();
                        
    }   
}
