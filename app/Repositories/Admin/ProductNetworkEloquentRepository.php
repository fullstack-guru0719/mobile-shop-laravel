<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductNetwork;

class ProductNetworkEloquentRepository extends AbstractRepository implements ProductNetworkRepository
{
	protected $query;

	function __construct(ProductNetwork $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}