<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class PageBuilderSettings extends Model
{
    protected $table = "pagebuilder_settings";
    protected $guarded = [];

    protected $fillable = [
        'id', 'settings', 'value', 'is_array', 'updated_at', 'created_at',
    ];

    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
