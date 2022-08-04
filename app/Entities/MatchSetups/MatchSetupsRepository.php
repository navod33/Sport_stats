<?php

namespace App\Entities\MatchSetups;

use App\Entities\BaseRepository;

class MatchSetupsRepository extends BaseRepository
{

	public function __construct(MatchSetup $model)
	{
		parent::__construct($model);
	}

}
