<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\BaseRequest;

class UpdateTicketRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10|max:150',
            'initial_message' => 'required|min:10',
            'not_robot' => ['required', \Illuminate\Validation\Rule::in(['on'])],
        ];
    }
}
