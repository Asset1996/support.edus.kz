<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:1|max:50',
            'surname' => 'min:1|max:50',
            'phone' => new \App\Rules\PhoneNumber(),
            'iin' => new \App\Rules\ValidateIIN(),
        ];
    }
}
