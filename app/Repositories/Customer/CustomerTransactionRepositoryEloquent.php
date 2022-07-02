<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerTransaction;

class CustomerTransactionRepositoryEloquent extends AbstractRepository implements CustomerTransactionRepository
{
	protected $query;

	function __construct(CustomerTransaction $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}