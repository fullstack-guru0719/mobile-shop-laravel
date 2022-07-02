<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class CustomerSell extends Model
{
    protected $table = "customer_sells";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }

    // public function product_network()
    // {
    //     return $this->belongsTo(\App\Models\Admin\ProductNetwork::class, 'network_id');
    // }

    public function network()
    {
        return $this->belongsTo(\App\Models\Admin\Network::class, 'network_id');
    }

    public function product_storage()
    {
        return $this->belongsTo(\App\Models\Admin\ProductStorage::class, 'product_storage_id');
    }
    
    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }

}