<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerAddress;

class CustomerAddressRepositoryEloquent extends AbstractRepository implements CustomerAddressRepository
{
	protected $query;

	function __construct(CustomerAddress $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}