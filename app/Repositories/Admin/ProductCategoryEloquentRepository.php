<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductCategory;

class ProductCategoryEloquentRepository extends AbstractRepository implements ProductCategoryRepository
{
	protected $query;

	function __construct(ProductCategory $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}