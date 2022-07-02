<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Config;

class ConfigRepositoryEloquent extends AbstractRepository implements ConfigRepository
{
	protected $query;

	function __construct(Config $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}