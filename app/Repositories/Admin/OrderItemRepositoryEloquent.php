<?php

namespace App\Repositories\Admin;

use App\Models\Admin\OrderItem;

class OrderItemRepositoryEloquent extends AbstractRepository implements OrderItemRepository
{
	protected $query;

	function __construct(OrderItem $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}