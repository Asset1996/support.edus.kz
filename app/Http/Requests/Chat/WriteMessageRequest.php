<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\BaseRequest;

class WriteMessageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message_body' => ['required', 'min:10']
        ];
    }
}
