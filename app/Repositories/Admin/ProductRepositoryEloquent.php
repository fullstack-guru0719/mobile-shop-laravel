<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Product;

class ProductRepositoryEloquent extends AbstractRepository implements ProductRepository
{
	protected $query;

	function __construct(Product $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}