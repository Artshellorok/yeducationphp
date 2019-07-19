<?php

namespace App\Rules;

use App\Sms;

use Illuminate\Contracts\Validation\Rule;

class TicketValid implements Rule
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
        return Sms::where('ticket', '=', $value)->where('confirmed', '=', 1)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Истек срок регистрации аккаунта';
    }
}