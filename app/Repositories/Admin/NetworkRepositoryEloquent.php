<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Network;

class NetworkRepositoryEloquent extends AbstractRepository implements NetworkRepository
{
	protected $query;

	function __construct(Network $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}