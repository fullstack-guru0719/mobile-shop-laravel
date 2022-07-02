<?php

namespace App\Repositories\Admin;

use App\Models\Admin\SettingsBrand;

class SettingsBrandRepositoryEloquent extends AbstractRepository implements SettingsBrandRepository
{
	protected $query;

	function __construct(SettingsBrand $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}