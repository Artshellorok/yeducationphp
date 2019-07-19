<?php

namespace App\Rules;

use App\Sms;
use App\User;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class PhoneOccupied implements Rule
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
        $same_model = Sms::where('phone','=', $value);
        $same = $same_model->get()->first();
        $now = Carbon::now();
        $difference = $same->created_at->diffInSeconds($now);
        if ($difference > 300) {
            $same_model->forceDelete();
        }
        return !User::where('phone', '=', $value)->exists() && !$same->where('confirmed', '=', 1)->exists() && $difference > 600;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Номер телефона занят';
    }
}