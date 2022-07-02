<?php

namespace App\Repositories\Admin;

use App\Models\Admin\SettingsCategory;

class SettingsCategoryEloquentRepository extends AbstractRepository implements SettingsCategoryRepository
{
	protected $query;

	function __construct(SettingsCategory $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}