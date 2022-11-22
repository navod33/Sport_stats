<?php

namespace App\Http\Controllers\Manage;

use App\Entities\Posts\PostsRepository;
use App\Http\Controllers\Controller;
use EMedia\Formation\Builder\Formation;
use ElegantMedia\OxygenFoundation\Http\Traits\Web\CanCRUD;
use ElegantMedia\OxygenFoundation\Http\Traits\Web\CanRead;
use ElegantMedia\OxygenFoundation\Http\Traits\Web\FollowsConventions;

class PostsController extends Controller
{

	use FollowsConventions;

	// Uncomment this line if you're going to use Oxygen's Default Controller Methods
	 use CanCRUD;
	 use CanRead;

	protected $repo;

	public function __construct(PostsRepository $repo)
	{
		$this->repo = $repo;

		$this->resourceEntityName = 'Post';
        $this->isDestroyAllowed = false;
	}

    protected function getResourcePrefix()
    {
        return 'manage.posts';
    }

	protected function getIndexRouteName($suffix = 'index'): string
	{
		return 'manage.posts.index';
	}

    /**
     *
     * This is the form shown when creating a new record.
     *
     * @param null $entity
     *
     * @return Formation
     */
    protected function getCreateForm($entity = null)
    {
        return new Formation($entity);
    }

    /**
     *
     * This is the form shown when editing an existing record.
     *
     * @param null $entity
     *
     * @return Formation
     */
    protected function getEditForm($entity = null)
    {
        return new Formation($entity);
    }

}
