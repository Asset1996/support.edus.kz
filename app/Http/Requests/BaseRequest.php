<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
     * Error messages.
     *
     * @return bool
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required',
            'unique' => 'The :attribute is already used',
            'min' => 'The :attribute must be minimum :min symbols',
            'max' => 'The :attribute must be maximum :max symbols',
            'email' => 'The :attribute must be email type',
            'required_without' => 'The :attribute or :values required',
            'required_without_all' => 'The :attribute or :values required',
            'confirmed' => 'The :attribute does not match',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error_message', trans($validator->messages()->first()) );
        }
    }
}
