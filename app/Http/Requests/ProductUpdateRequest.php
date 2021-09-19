<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        ;
        return [
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string|min:50',
            'short_description' => 'required|string|min:5|max:150',
            'price' => 'required|numeric|min:1',
            'discount' => 'required|numeric|digits_between:0,100',
            'in_stock' => 'required|numeric|min:1',
            'title' => 'required|string|max:255|unique:products,title,' . $this->product->id,
            'SKU' => 'required|string|min:1|max:35|unique:products,SKU,' . $this->product->id,
        ];
    }
}
