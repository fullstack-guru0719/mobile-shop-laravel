<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerOrders;

class CustomerOrdersRepositoryEloquent extends AbstractRepository implements CustomerOrdersRepository
{
	protected $query;

	function __construct(CustomerOrders $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}