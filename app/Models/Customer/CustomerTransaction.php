<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;
use Carbon\Carbon;

class CustomerTransaction extends Model
{
    protected $table = "customer_transactions";
    protected $guarded = [];
    protected $appends = ['hashedid', 'display_transaction_date', 'display_delivery_due'];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function customersells()
    {
        return $this->hasMany(\App\Models\Customer\CustomerSell::class, 'customer_transaction_id');
    }

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