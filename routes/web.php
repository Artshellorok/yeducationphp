<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/sms','SmsController@create');

$router->get('/sms/confirm','SmsController@confirm');

$router->get('/reg', 'UserController@create');

$router->get('/cities', function () {
    return \App\City::all()->toArray();
});

$router->get('/address/{city}', 'AddressesController@index');