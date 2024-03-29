<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    public $timestamps = false;

    protected $fillable = ["name", "mail", "avatar","phone"];
    
    protected $hidden = [
        'password', 'address'
    ];

    public function addresses()
    {
        return $this->belongsToMany('App\Address');
    }
}
