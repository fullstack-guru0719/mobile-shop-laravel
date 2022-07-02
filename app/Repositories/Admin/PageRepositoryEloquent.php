<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Page;

class PageRepositoryEloquent extends AbstractRepository implements PageRepository
{
	protected $query;

	function __construct(Page $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}