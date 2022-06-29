<?php

namespace App\Entities\Scores;

use App\Entities\BaseRepository;

class ScoresRepository extends BaseRepository
{

	public function __construct(Score $model)
	{
		parent::__construct($model);
	}

}
