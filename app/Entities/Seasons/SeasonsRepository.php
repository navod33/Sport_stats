<?php

namespace App\Entities\Seasons;

use App\Entities\BaseRepository;

class SeasonsRepository extends BaseRepository
{

	public function __construct(Season $model)
	{
		parent::__construct($model);
	}

}
