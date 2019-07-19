<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model {
    protected $fillable = ["ticket", "code","phone"];
    protected $guarded = ["confirmed"];
}