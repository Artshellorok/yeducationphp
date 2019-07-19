<?php

namespace App\Http\Controllers;

use App\User;
use App\Sms;

use Illuminate\Http\Request;
use App\Rules\TicketValid;

use App\Http\Controllers\Controller;


class UserController extends Controller {
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'ticket' => ['required', new TicketValid],
            'name' => ['required'],
            'flat' => ['required', 'numeric'],
            'address_id' => ['required', 'numeric', 'exists:mysql.addresses,id'],
            'mail' => 'email',
            'avatar' => 'image'
        ]);
        $noavatar = "htgtps://yeducation.ru/misc/noavatar.png";
        $sms = Sms::where('ticket', '=', $request->ticket);
        $phone = $sms->first()->phone;
        $user = User::create([
            "name" => $request->name,
            "mail" => $request->mail,
            "avatar" => $noavatar,
            "phone" => $phone,
        ]);
        $user->addresses()->attach([
            $request->address_id => ["flat" => $request->flat]
        ]);
        $sms->forceDelete();
    }
}