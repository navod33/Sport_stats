<?php

namespace App\Entities\Games;

use App\Entities\Files\File;
use App\Entities\Scores\Score;
use App\Entities\Seasons\Season;
use App\Entities\Teams\Team;
use App\Models\User;
use Carbon\Carbon;
use ElegantMedia\OxygenFoundation\Database\Eloquent\Traits\AssignsUuid;
use EMedia\Formation\Entities\GeneratesFields;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
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
    public $team_a_score = 0;
	protected $fillable = [
		'tournament_name',
		'played_at',
		'location',
        'team_a_id',
		'season_id',
		'team_a_image_uuid',
		'team_b_name',
		'team_b_image_uuid',
        'game_finished',
        'game_finished_at',
        'game_started',
        'game_actually_started_at',
	];

	protected $searchable = [
		'tournament_name',
		'location',
	];

	protected $editable = [
    	'tournament_name',
    ];

    protected $dates = [
        'played_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'team_b_id',
    ];

    protected $casts = [ 
        'season_id' => 'integer' , 
        'team_a_id' => 'integer',
        'owner_id'=> 'integer',
        'team_a_score'=> 'integer',
        'team_b_score'=> 'integer',
    ];
    /**
     *
     * Add any update only validation rules for this model
     *
     * @return array
     */
    public function getCreateRules()
    {
        return [
            'team_a_id' => 'required|integer',
            'team_b_name' => 'required',
            'season_id' => 'integer',
            'played_at' => 'required|date|date_format:Y-m-d H:i:s|after_or_equal:today',
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
            'team_a_id' => 'required',
            'team_b_name' => 'required',
            'season_id' => 'number',
            'played_at' => 'date|date_format:'.\DateTimeInterface::ATOM,
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

    public function getExtraApiFields()
    {
        return [
            'team_a_image' => ['type' => 'object', 'items' => 'File'],
            'team_b_image' => ['type' => 'object', 'items' => 'File'],
            'team_a' => ['type' => 'object', 'items' => 'Team'],
            'season' => ['type' => 'object', 'items' => 'Season'],
            'team_a_score' => 'integer',
            'game_status' => 'string',
            'match_results' => 'string',
        ];
        
    }

    public $appends = [ 'team_a_score','game_status','match_results'];
    protected $with = ['team_a_image','team_b_image','team_a','season'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function team_a()
    {
        return $this->belongsTo(Team::class, 'team_a_id','id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class,'season_id','id');
    }

    public function team_a_image()
    {
        return $this->belongsTo(File::class, 'team_a_image_uuid', 'uuid');
    }

    public function team_b_image()
    {
        return $this->belongsTo(File::class, 'team_b_image_uuid', 'uuid');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'game_id','id');
    }

    public function getTeamAScoreAttribute() {
        return (int) $this->scores()->where('team_id',$this->team_a->id ?? null)->sum('score'); 
    }

    public function getGameStatusAttribute() {
        $plan_date =  $this->attributes['played_at'];
        $started =  $this->attributes['game_started'];
        //$started_date =  $this->attributes['game_actually_started_at']; 
        $finished =  $this->attributes['game_finished'];
        $current_date = Carbon::now();
        if ($plan_date>=$current_date) 
        {
            if($started==1 && $finished==0)
            {
                return 'Ongoing';
            } 

            if($started==1 && $finished==1)
            {
                return 'Played';
            }
            
            else 
            {
                return 'Upcoming';
            }
        }
        else
        {
            return 'Played';
        }
    }

    public function getMatchResultsAttribute() {
        $team_a_score = (int) $this->scores()->where('team_id',$this->team_a->id ?? null)->sum('score'); 
        $team_b_score = (int) $this->team_b_score;
        
        if ($team_a_score>$team_b_score) {
            return 'WON';
        }

        if ($team_a_score<$team_b_score) {
            return 'LOST';
        }

        if ($team_a_score==$team_b_score) {
            return 'DRAW';
        }
    }
}
