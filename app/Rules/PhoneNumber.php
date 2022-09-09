<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
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
        $regex = "/^\d{11}+$/";
        if(preg_match($regex, $value)){
            return True;
        }
        return False;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('Icorrect format of phone number.');
    }
}
