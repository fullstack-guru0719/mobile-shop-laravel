<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = "customer_addresses";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }
}
