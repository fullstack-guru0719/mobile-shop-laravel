<?php

namespace App\Repositories\Customer;

use App\Models\Admin\Device;

class DeviceRepositoryEloquent extends AbstractRepository implements DeviceRepository
{
	protected $query;

	function __construct(Device $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}