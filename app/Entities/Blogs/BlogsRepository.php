<?php

namespace App\Entities\Blogs;

use App\Entities\BaseRepository;

class BlogsRepository extends BaseRepository
{

	public function __construct(Blog $model)
	{
		parent::__construct($model);
	}

}
