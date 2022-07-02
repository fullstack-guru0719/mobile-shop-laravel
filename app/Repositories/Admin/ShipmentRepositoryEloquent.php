<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Shipment;

class ShipmentRepositoryEloquent extends AbstractRepository implements ShipmentRepository
{
	protected $query;

	function __construct(Shipment $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}