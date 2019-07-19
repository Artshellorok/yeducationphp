<?php

namespace App\Rules;

use App\Sms;
use App\User;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class SmsTicketExpired implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Sms::where('ticket', '=', $value)->exists()) {
            $sms = Sms::where('ticket','=', $value)->first();
            $now = Carbon::now();
            $difference = $sms->created_at->diffInSeconds($now);

            if ($difference > 600) {
                $sms->forceDelete();
                return false;
            } else { 
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Истекло время подтверждения!';
    }
}