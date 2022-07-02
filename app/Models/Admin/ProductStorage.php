<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class ProductStorage extends Model
{
    protected $table = "product_storages";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }

    public function network()
    {
        return $this->hasOne(Network::class,'id','network_id');
    }
}