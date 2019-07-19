<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
    
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name'];
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}