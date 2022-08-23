<?php

namespace App\Entities\Players;

use App\Entities\Files\File;
use App\Entities\PlayerPositions\PlayerPosition;
use App\Entities\Teams\Team;
use App\Models\User;
use ElegantMedia\OxygenFoundation\Database\Eloquent\Traits\AssignsUuid;
use EMedia\Formation\Entities\GeneratesFields;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
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
		'name',
		'email',
		'positions',
		'metadata',
		'team_id',
        'image_uuid',
        'metadata',
	];

	protected $searchable = [
		'uuid'
	];

	protected $editable = [
    	'name',
    ];

    protected $hidden = [
        'owner_id',
        // 'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [ 
        'id' => 'integer' ,
        'team_id' => 'integer' , 
    ];
    /**
     *
     * Add any update only validation rules for this model
     *
     * @return array
     */
    // public function getCreateRules()
    // {
    //     return [
    //         'name' => 'required',
    //         'email' => 'email',
    //         'team_id' => 'required',
            
    //     ];
    // }

    public function getCreateRules()
    {
        return [
            'team_name' => 'required|string',
            'team_number' => 'string',
            'player_count' => 'integer',
            'team_image_uuid' => 'string',
            //'data' => 'present|array',
            // 'data.team_name' => 'required | string',
            // 'data.team_number' => 'string',
            // 'data.player_count' => 'integer',
            // 'data.team_image_uuid' => 'string',
            'players' => 'required | string',
            'players.*.name' => 'required | string',
            'players.*.positions' => 'string',
            'players.*.image_uuid' => 'string',
            'players.*.email' => 'email',
        ];
    }
    public function getPlayerRules()
    {
        return [
            'data' => 'present|array',
            'name' => 'required | string',
            'positions' => 'string',
            'image_uuid' => 'string',
            'email' => 'email',
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
            'email' => 'email',
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
        return [
            // 'data.team_name.required' => 'Team Name is required',
            // 'data.team_number.string' => 'Team number must be a string',
            // 'data.player_count.integer' => 'Player count must be an integer',
            // 'data.team_image_uuid.string' => 'Team Image uuid must be a string',
            'team_name' => 'Team Name is required',
            'team_number.string' => 'Team number must be a string',
            'player_count.integer' => 'Player count must be an integer',
            'team_image_uuid.string' => 'Team Image uuid must be a string',
            'players.required' => 'Players array required',
            'players.*.name.required' => 'Name of the players required',
            'players.*.positions.string' => 'Players positions must be a comma separated string',
            'players.*.email.email' => 'Players email must be a correct email',
            'players.*.image_uuid.string' => 'Players Image uuid must be a string',
        ];
    }

    public function getPlayerValidationMessages()
    {
        return [
            'name.required' => 'Name of the players required',
            'positions.string' => 'Players positions must be a comma separated string',
            'email.email' => 'Players email must be a correct email',
            'image_uuid.string' => 'Players Image uuid must be a string',
        ];
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
            'image' => ['type' => 'object', 'items' => 'File'],
            'prefered_positions' => ['type' => 'object', 'items' => 'PlayerPosition'],
            'id' => 'integer',
            'team_id' => 'integer',
        ];
        
    }
    public $appends = [ 'prefered_positions'];
    protected $with = ['image'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id' , 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_uuid', 'uuid');
    }
    
    public function getPreferedPositionsAttribute()
    {
        $string_positions = $this->positions;
        $positions_arr = explode (",", $string_positions);
        return PlayerPosition::whereIn('id',$positions_arr)->get();
    }
}
