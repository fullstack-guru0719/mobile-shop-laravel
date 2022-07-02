<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TemplateEmail;

class TemplateEmailEloquentRepository extends AbstractRepository implements TemplateEmailRepository
{
	protected $query;

	function __construct(TemplateEmail $query)
	{
		$this->query = $query;
	}

    public function datatablesIndex()
    {
        return $this->query->whereRaw("1=?", [1]);
    }
}