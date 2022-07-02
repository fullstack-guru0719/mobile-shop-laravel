<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class Network extends Model
{
    protected $table = "networks";
    protected $guarded = [];
    protected $appends = ['hashedid'];
    // protected $appedns = ['dimension'];

      public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
