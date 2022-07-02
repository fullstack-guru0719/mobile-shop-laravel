<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerSell;

class CustomerSellRepositoryEloquent extends AbstractRepository implements CustomerSellRepository
{
	protected $query;

	function __construct(CustomerSell $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}