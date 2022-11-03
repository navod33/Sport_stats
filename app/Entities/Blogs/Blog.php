<?php

namespace App\Entities\Blogs;

use App\Entities\Files\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EMedia\Formation\Entities\GeneratesFields;
use Illuminate\Database\Eloquent\Model;
use ElegantMedia\SimpleRepository\Search\Eloquent\SearchableLike;

class Blog extends Model
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
    protected $table = 'blog';
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
            'image' => ['type' => 'object', 'items' => 'File'],
            'id' => 'integer',
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
    public function image()
    {
        return $this->belongsTo(File::class, 'id', 'blog_id');
    }
}
