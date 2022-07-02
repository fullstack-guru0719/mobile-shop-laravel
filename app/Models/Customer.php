<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Vinkla\Hashids\HashidsManager;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';
    protected $guarded = [];
    protected $appends = ['fullname', 'hashedid', 'authtoken'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'authpw',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullnameAttribute()
    {
        return $this->attributes['fname'].' '.$this->attributes['lname'];
    }

    public function bill()
    {
        return $this->hasOne(\App\Models\Customer\CustomerAddress::class, 'customer_id');
    }

    public function sells()
    {
        return $this->hasMany(\App\Models\Customer\CustomerSell::class, 'customer_id');
    }

    public function addresses()
    {
        return $this->hasMany(\App\Models\Customer\CustomerAddress::class, 'customer_id');
    }

    public function getAuthtokenAttribute()
    {
        // $test = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $this->attributes['password'] ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        // return $test;
        return app('App\Http\Controllers\GlobalFunctionController')->encrypt($this->attributes['authpw']);
        return $this->attributes['authpw'];
    }

    

    public function getHashedidAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
