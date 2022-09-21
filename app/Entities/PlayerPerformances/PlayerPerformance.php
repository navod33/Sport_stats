<?php

namespace App\Entities\PlayerPerformances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use EMedia\Formation\Entities\GeneratesFields;
use Illuminate\Database\Eloquent\Model;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;

class PlayerPerformancemodel extends Model
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

	protected $fillable = [
		'name'
	];

	protected $searchable = [
		'name'
	];

	protected $editable = [
    	'name',
    ];

    public function getExtraApiFields()
    {
        return [
            'conversion' => 'integer',
            'goal_in' => 'integer',
            'goal_missed' => 'integer',
            'error_record' => 'integer',
            'contract' => 'integer',
            'center_pass' => 'integer',
            'intercept' => 'integer',
            'tip' => 'integer',
            'rebound' => 'integer',
            'team_id' => 'integer',
            'player_id' => 'integer',
            'comment' => 'string',
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

}
