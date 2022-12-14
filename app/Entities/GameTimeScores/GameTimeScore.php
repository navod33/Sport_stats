<?php

namespace App\Entities\GameTimeScores;

use App\Entities\PlayerPositions\PlayerPosition;
use App\Entities\Scores\Score;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EMedia\Formation\Entities\GeneratesFields;
use Illuminate\Database\Eloquent\Model;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;

class GameTimeScore extends Model
{

    use HasFactory;
	use SearchableLike;
	use GeneratesFields;

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
    protected $table = 'scores';
	protected $fillable = [
		'game_id',
        'team_id',
	];

	protected $searchable = [
		'game_id',
        'team_id',
	];

	protected $editable = [
    	'name',
    ];

    protected $visible = [
        'time_segment',
        'position_obj',
        'game_id',
        'team_id',
        'played_positions',
    ];
    protected $with =[
        'position_obj',
    ];
    public $appends = [ 'played_positions'];
    public function getExtraApiFields()
    {
        return [
            'position_obj' => ['type' => 'object', 'items' => 'PlayerPosition'],  
            'played_positions' => 'string',  
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
            'name' => 'required',
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
            'name' => 'required',
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
    public function position_obj()
    {
        return $this->belongsTo(PlayerPosition::class,'position');
    }

    public function getPlayedPositionsAttribute()
    {
        $game_id = $this->game_id;
        $team_id = $this->team_id;
        $player_id = $this->player_id;
        $positions=null;
        $positions_arr = Score::where('game_id',$game_id)
                        ->where('team_id',$team_id)
                        ->where('player_id',$player_id)->pluck('position')->unique();
                        
        $res= PlayerPosition::select('short_name')->whereIn('id',$positions_arr)->get();

        foreach ($res as $key => $value) {
            $positions = $value->short_name.'/'.$positions;
        }

        return $positions = rtrim($positions, "/");

    }
}
