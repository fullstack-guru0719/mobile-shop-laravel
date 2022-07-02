<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageBuilder;

class PageBuilderRepositoryEloquent extends AbstractRepository implements PageBuilderRepository
{
	protected $query;

	function __construct(PageBuilder $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}