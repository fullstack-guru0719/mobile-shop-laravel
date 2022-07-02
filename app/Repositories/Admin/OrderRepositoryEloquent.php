<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Order;

class OrderRepositoryEloquent extends AbstractRepository implements OrderRepository
{
	protected $query;

	function __construct(Order $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}