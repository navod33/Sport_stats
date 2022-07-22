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
    public function getCreateRules()
    {
        return [
            'name' => 'required',
            'email' => 'email',
            'team_id' => 'required',
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
