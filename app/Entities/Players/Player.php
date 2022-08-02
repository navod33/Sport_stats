<?php

namespace App\Entities\Players;

use App\Entities\Files\File;
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
            'data' => 'present|array',
            // 'data.team_name' => 'required | string',
            // 'data.team_number' => 'string',
            // 'data.player_count' => 'integer',
            // 'data.team_image_uuid' => 'string',
            'data.players' => 'present|array',
            'data.players.*.name' => 'required | string',
            'data.players.*.positions' => 'string',
            'data.players.*.image_uuid' => 'string',
            'data.players.*.email' => 'email',
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
            'data.players.required' => 'Playes array required',
            'data.players.*.name.required' => 'Name of the players required',
            'data.players.*.positions.string' => 'Players positions must be a comma separated string',
            'data.players.*.email.email' => 'Players email must be a correct email',
            'data.players.*.image_uuid.string' => 'Players Image uuid must be a string',
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
        ];
        
    }

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
    
}
