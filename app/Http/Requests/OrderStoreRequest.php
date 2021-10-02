<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'name' => 'required|min:2|max:35',
            'surname' => 'required|min:2|max:50',
            'phone' => 'required',
            'email' => 'required|email',
            'country' => 'required|min:2',
            'city' => 'required|min:2',
            'address' => 'required|min:2',
        ];
    }
}
