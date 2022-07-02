<?php

namespace App\Repositories\Admin;

use App\Models\Admin\SettingsStorage;

class SettingsStorageEloquentRepository extends AbstractRepository implements SettingsStorageRepository
{
	protected $query;

	function __construct(SettingsStorage $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}