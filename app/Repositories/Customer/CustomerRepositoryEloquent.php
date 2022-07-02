<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepositoryEloquent extends AbstractRepository implements CustomerRepository
{
	protected $query;

	function __construct(Customer $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}