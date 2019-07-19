<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {
    
    protected $fillable=["address"];
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}