<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerOrders extends Model
{
    protected $table = "customer_orders";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }

    public function network()
    {
        return $this->belongsTo(\App\Models\Admin\Network::class, 'network_id');
    }

    public function product_storage()
    {
        return $this->belongsTo(\App\Models\Admin\ProductStorage::class, 'product_storage_id');
    }
}