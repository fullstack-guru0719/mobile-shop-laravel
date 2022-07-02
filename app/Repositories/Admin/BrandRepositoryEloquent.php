<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Brand;

class BrandRepositoryEloquent extends AbstractRepository implements BrandRepository
{
	protected $query;

	function __construct(Brand $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}