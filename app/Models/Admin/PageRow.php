<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PageRow extends Model
{
    protected $table = "page_rows";
    protected $guarded = [];

    public function column()
    {
        return $this->hasMany(\App\Models\Admin\PageColumn::class, 'row_id');
    }
}
