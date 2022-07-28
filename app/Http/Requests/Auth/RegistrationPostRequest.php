<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Session\Session;

class RegistrationPostRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
            'password' => 'required|confirmed|max:50',
        ];
    }
}
