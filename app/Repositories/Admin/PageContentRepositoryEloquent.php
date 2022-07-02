<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageContent;

class PageContentRepositoryEloquent extends AbstractRepository implements PageContentRepository
{
	protected $query;

	function __construct(PageContent $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}