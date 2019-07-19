<?php

namespace App\Http\Controllers;

use App\City;
use App\Address;

use App\Http\Controllers\Controller;

class AddressesController extends Controller {
    
    public function index(City $city)
    {
        return $city->addresses()->get();
    }
}