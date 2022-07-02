<?php

namespace App\Repositories\Admin;

use App\Models\Admin\SettingsStatus;

class SettingsStatusEloquentRepository extends AbstractRepository implements SettingsStatusRepository
{
	protected $query;

	function __construct(SettingsStatus $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}