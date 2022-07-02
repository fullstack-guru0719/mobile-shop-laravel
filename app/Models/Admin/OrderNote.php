<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;
use Carbon\Carbon;

class OrderNote extends Model
{
    protected $table = "order_notes";
    protected $guarded = [];
    protected $appends = ['hashedid', 'display_created_at'];

    public function order()
    {
        return $this->belongsTo(\App\Models\Admin\Order::class, 'order_id');
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }


    public function getDisplaycreatedatAttribute()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }
}
