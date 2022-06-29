<?php

namespace App\Entities\Games;

use App\Entities\Files\File;
use App\Entities\Scores\Score;
use App\Entities\Seasons\Season;
use App\Entities\Teams\Team;
use App\Models\User;
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

	protected $fillable = [
		'tournament_name',
		'played_at',
		'location',
		'season_id',
		'team_a_image_uuid',
		'team_b_name',
		'team_b_image_uuid',
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
            'played_at' => 'required|date|date_format:'.\DateTimeInterface::ATOM,
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function team_a()
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
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
        return $this->hasMany(Score::class);
    }
}
