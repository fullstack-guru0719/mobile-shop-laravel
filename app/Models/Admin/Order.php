<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = [];
    protected $appends = ['hashedid', 'display_transaction_date', 'display_delivery_due'];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function status_details()
    {
        return $this->belongsTo(\App\Models\Admin\SettingsStatus::class, 'status_id');
    }

    public function order_item()
    {
        return $this->hasMany(\App\Models\Admin\OrderItem::class, 'order_id');
    }

    public function order_note()
    {
        return $this->hasMany(\App\Models\Admin\OrderNote::class, 'order_id');
    }

    // public function customersells()
    // {
    //     return $this->hasMany(\App\Models\Customer\CustomerSell::class, 'customer_transaction_id');
    // }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
    
    public function getFormattransactiondateAttribute()
    {
        return Carbon::parse($this->transaction_date)->format('d/m/Y');
    }


    public function getDisplaytransactiondateAttribute()
    {
        return Carbon::parse($this->transaction_date)->format('d M Y');
    }
    
    public function getFormatdeliverydueAttribute()
    {
        return Carbon::parse($this->delivery_due)->format('d/m/Y');
    }


    public function getDisplaydeliverydueAttribute()
    {
        return Carbon::parse($this->delivery_due)->format('d M Y');
    }
}


// <?php

// namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Model;

// class Order extends Model
// {
//     protected $table = "orders";
//     protected $guarded = [];

//     public function item()
//     {
//         return $this->hasMany(\App\Models\Admin\OrderItem::class, 'order_id');
//     }

//     public function customer()
//     {
//         return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
//     }

//     public function shipment()
//     {
//         return $this->hasOne(\App\Models\Admin\Shipment::class, 'order_id');
//     }
// }