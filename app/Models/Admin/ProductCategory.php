<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class ProductCategory extends Model
{
    protected $table = "product_categories";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function categories()
    {
        return $this->belongsTo(\App\Models\Admin\SettingsCategory::class, 'category_id');
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}