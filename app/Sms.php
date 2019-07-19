<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model {
    protected $primaryKey = 'ticket';
    protected $fillable = ["ticket", "code","phone"];
    protected $guarded = ["confirmed"];
    public $incrementing = false;
}