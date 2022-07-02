<?php

namespace App\Repositories\Admin;

use App\Models\Admin\OrderNote;

class OrderNoteRepositoryEloquent extends AbstractRepository implements OrderNoteRepository
{
	protected $query;

	function __construct(OrderNote $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}