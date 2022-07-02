<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PageMetaTag extends Model
{
    protected $table = "pagebuilder__meta_tags";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function page()
    {
        return $this->belongsTo(\App\Models\Admin\PageBuilder::class, 'page_id');
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}

