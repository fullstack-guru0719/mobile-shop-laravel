<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TemplateSms;

class TemplateSmsEloquentRepository extends AbstractRepository implements TemplateSmsRepository
{
	protected $query;

	function __construct(TemplateSms $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}