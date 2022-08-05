<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\BaseRequest;

class AskQuestionRequest extends BaseRequest
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
            'email' => 'required|email|max:255',
            'title' => 'required|min:10|max:150',
            'initial_message' => 'required|min:10',
            'service_types_id' => 'required',
        ];
    }
}
