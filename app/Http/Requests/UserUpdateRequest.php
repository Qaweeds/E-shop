<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:30',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'surname' => 'required|string|min:3|max:30',
            'password' => 'confirmed|min:5|nullable',
            'birthdate' => 'required|date|before: 18 years ago',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone,' . auth()->user()->id,
//            'balance' => 'required|numeric',
        ];
    }
}
