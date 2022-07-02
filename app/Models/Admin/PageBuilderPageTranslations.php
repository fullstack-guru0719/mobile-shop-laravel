<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class PageBuilderPageTranslations extends Model
{
    protected $table = "pagebuilder__page_translations";
    protected $guarded = [];

    protected $fillable = [
        'id', 'page_id', 'locale', 'title', 'route', 'updated_at', 'created_at',
    ];

    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
