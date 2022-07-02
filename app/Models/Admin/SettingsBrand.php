<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SettingsBrand extends Model
{
    protected $table = "settings_brands";
    protected $guarded = [];
    protected $appends = ['updated_at_display','photo_display','hashedid'];

    public function getUpdatedAtDisplayAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y M d - h:i A');
    }

    public function getPhotoDisplayAttribute()
    {
        if($this->attributes['photo']){
            return basename($this->attributes['photo']);
        }
        return '';
    }

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
