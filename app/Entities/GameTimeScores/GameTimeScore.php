<?php

namespace App\Entities\GameTimeScores;

use App\Entities\PlayerPositions\PlayerPosition;
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
    ];
    protected $with =[
        'position_obj',
    ];
    public function getExtraApiFields()
    {
        return [
            'position_obj' => ['type' => 'object', 'items' => 'PlayerPosition'],    
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
}
