<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $table = "page_sections";
    protected $guarded = [];

    public function row()
    {
        return $this->hasMany(\App\Models\Admin\PageRow::class, 'section_id');
    }
}
