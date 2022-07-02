<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageMetaTag;

class PageMetaTagRepositoryEloquent extends AbstractRepository implements PageMetaTagRepository
{
	protected $query;

	function __construct(PageMetaTag $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}