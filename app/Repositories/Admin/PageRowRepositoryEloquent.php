<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageRow;

class PageRowRepositoryEloquent extends AbstractRepository implements PageRowRepository
{
	protected $query;

	function __construct(PageRow $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}