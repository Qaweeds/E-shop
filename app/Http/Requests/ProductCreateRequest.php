<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth() && auth()->user()->is_admin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|max:255|unique:products',
            'description' => 'required|string|min:50',
            'short_description' => 'required|string|min:5|max:150',
            'SKU' => 'required|string|min:1|max:35|unique:products',
            'price' => 'required|numeric|min:1',
            'discount' => 'required|numeric|digits_between:0,100',
            'in_stock' => 'required|numeric|min:1',
            'thumbnail' => 'required|image',
            'images.*' => 'sometimes|image',
        ];
    }
}
