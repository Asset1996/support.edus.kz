<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $number = preg_match('@[0-9]@', $value);
        $character = preg_match('@[a-zA-Z]@', $value);
        
        
        if (!$number || !$character) {
            return False;
        }
        return True;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('messages.error.Password must contain minimum 1 character and 1 digit');
    }
}
