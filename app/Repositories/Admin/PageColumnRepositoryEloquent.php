<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageColumn;

class PageColumnRepositoryEloquent extends AbstractRepository implements PageColumnRepository
{
	protected $query;

	function __construct(PageColumn $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}