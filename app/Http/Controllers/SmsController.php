<?php 

namespace App\Http\Controllers;

use App\Sms;
use App\User;

use App\Cryptography\Random;
use Illuminate\Http\Request;

use App\Rules\PhoneOccupied;
use App\Rules\SmsTicketExpired;

use App\Http\Controllers\Controller;

class SmsController extends Controller {

    public function create(Random $random, Request $request)
    {
        $this->validate($request,[
            'phone' => ['required', 'regex:/(8)[0-9]{10}/', new PhoneOccupied]
        ]);
        Sms::create([
            "ticket" => $ticket = $random->gen_rand()->secure_hash()->get(),
            "phone" => $request->phone,
            "code" => $random->gen('100000', '999999')->get()
        ]);
        return $ticket;
    }
    public function confirm(Request $request)
    {
        $this->validate($request,[
            'ticket' => ['required', new SmsTicketExpired],
            'code' => ['required', 'numeric']
        ]);
        $sms = Sms::where('ticket', '=', $request->ticket)->first();

        if ($sms->code == $request->code) {
            $sms->confirmed = true;
            $sms->save();
            return 1;
        } else {
            return 0;
        }
    }
}