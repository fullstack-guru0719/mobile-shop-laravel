<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class SettingsStatus extends Model
{
    protected $table = "settings_status";
    protected $guarded = [];
    protected $appends = ['hashedid'];

    public function sms_template()
    {
        return $this->hasOne(TemplateSms::class, 'id', 'template__sms_id');
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
