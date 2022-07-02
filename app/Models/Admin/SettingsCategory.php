<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class SettingsCategory extends Model
{
    protected $table = "settings_categories";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
