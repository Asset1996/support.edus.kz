<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'min:7', 'max:50', new \App\Rules\PasswordValidate(), new \App\Rules\OldPasswordValidate()],
            'password' => ['required', 'confirmed', 'min:7', 'max:50', new \App\Rules\PasswordValidate()],
        ];
    }
}
