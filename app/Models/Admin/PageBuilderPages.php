<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class PageBuilderPages extends Model
{
    protected $table = "pagebuilder__pages";
    protected $guarded = [];

    protected $fillable = [
        'id', 'name', 'layout', 'data', 'updated_at', 'created_at',
    ];

    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
