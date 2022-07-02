<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class ProductNetwork extends Model
{
    protected $table = "product_networks";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function network()
    {
        return $this->belongsTo(\App\Models\Admin\Network::class, 'network_id');
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}