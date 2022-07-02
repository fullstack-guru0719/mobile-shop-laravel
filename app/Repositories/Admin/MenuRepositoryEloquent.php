<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Menu;

class MenuRepositoryEloquent extends AbstractRepository implements MenuRepository
{
	protected $query;

	function __construct(Menu $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}