<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\HashidsManager;

class PageBuilderUploads extends Model
{
    protected $table = "pagebuilder_uploads";
    protected $guarded = [];

    protected $fillable = [
        'id', 'public_id', 'original_file', 'mime_type', 'server_file', 'updated_at', 'created_at',
    ];

    protected $appends = ['hashedid'];

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
