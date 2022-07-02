<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageStatic;

class PageStaticRepositoryEloquent extends AbstractRepository implements PageStaticRepository
{
	protected $query;

	function __construct(PageStatic $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}