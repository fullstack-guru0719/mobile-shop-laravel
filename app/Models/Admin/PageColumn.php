<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PageColumn extends Model
{
    protected $table = "page_columns";
    protected $guarded = [];

    public function content()
    {
        return $this->hasMany(\App\Models\Admin\PageContent::class, 'column_id');
    }
}
