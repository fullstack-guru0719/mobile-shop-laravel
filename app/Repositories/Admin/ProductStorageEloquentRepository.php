<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductStorage;

class ProductStorageEloquentRepository extends AbstractRepository implements ProductStorageRepository
{
	protected $query;

	function __construct(ProductStorage $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}