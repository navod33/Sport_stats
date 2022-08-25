<?php

namespace App\Entities\Contactuses;

use App\Entities\BaseRepository;

class ContactusesRepository extends BaseRepository
{

	public function __construct(Contactus $model)
	{
		parent::__construct($model);
	}

}
