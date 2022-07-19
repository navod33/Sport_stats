<?php

namespace App\Entities\Teams;

use App\Entities\Files\File;
use App\Entities\Players\Player;
use App\Models\User;
use ElegantMedia\OxygenFoundation\Database\Eloquent\Traits\AssignsUuid;
use EMedia\Formation\Entities\GeneratesFields;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
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
		'team_number',
		'player_count',
		'performance_notes',
		// 'image_id',
		'metadata',
	];

	// protected $appends = [
	//     'image',
    // ];

    protected $appends = [
		// uncomment permalink if you want it to be available with the response
		'permalink',
	];
    
	protected $searchable = [
		'name'
	];

	protected $editable = [
    	'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [ 'owner_id' => 'integer' , 'player_count' => 'integer' ];
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
            'player_count' => 'numeric',
            'metadata' => 'array',
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
            'player_count' => 'numeric',
            'metadata' => 'array',
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

    public function getPermalinkAttribute()
	{
		return route('files.show', [
			'uuid' => $this->uuid,
			'fileName' => $this->original_filename,
		]);
	}

    public function getPublicUrlAttribute()
	{
		if ($this->file_disk) {
			if ($this->file_disk === 'public') {
				return Storage::disk('public')->url($this->file_path);
			}
            // if ($this->file_disk === 'user_uploads') {
            //     return Storage::disk('user_uploads')->url($this->file_path);
            // }
		}

		return null;
	}

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id','id');
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_uuid', 'uuid');
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

}
