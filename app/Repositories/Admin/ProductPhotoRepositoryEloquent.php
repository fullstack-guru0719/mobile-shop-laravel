<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProductPhoto;

class ProductPhotoRepositoryEloquent extends AbstractRepository implements ProductPhotoRepository
{
	protected $query;

	function __construct(ProductPhoto $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}