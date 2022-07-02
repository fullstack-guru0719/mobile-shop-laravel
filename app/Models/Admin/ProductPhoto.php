<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = "product_photos";
    protected $guarded = [];
    protected $appends = ['photo_display','size'];

    public function getPhotoDisplayAttribute()
    {
        if($this->attributes['photo']){
            return basename($this->attributes['photo']);
        }
        return '';
    }

    public function getSizeAttribute()
    {
        if($this->attributes['photo']){
            return filesize($this->attributes['photo']);
        }
        return '0';
    }
}
