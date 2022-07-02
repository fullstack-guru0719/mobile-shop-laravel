<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "devices";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }
}
