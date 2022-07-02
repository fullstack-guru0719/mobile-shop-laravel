<?php

namespace App\Repositories\Customer;

use App\Models\Customer\State;

class StateRepositoryEloquent extends AbstractRepository implements StateRepository
{
	protected $query;

	function __construct(State $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}