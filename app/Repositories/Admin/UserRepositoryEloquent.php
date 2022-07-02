<?php

namespace App\Repositories\Admin;

use App\Models\User;

class UserRepositoryEloquent extends AbstractRepository implements UserRepository
{
	protected $query;

	function __construct(User $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}