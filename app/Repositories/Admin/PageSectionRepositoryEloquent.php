<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PageSection;

class PageSectionRepositoryEloquent extends AbstractRepository implements PageSectionRepository
{
	protected $query;

	function __construct(PageSection $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}