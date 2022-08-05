<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegistrationPostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:support_user|max:255',
            'password' => ['required', 'confirmed', 'min:7', 'max:50', new \App\Rules\PasswordValidate()],
        ];
    }
}
