<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id'=> 'required|exists:categories,id',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'=> 'required|string|max:255',
            'production_date'=> 'required|date',
            'expiry_date'=> 'required|date',
            'price'=> 'required|numeric',
            'barcode_number'=> 'required|string|max:255',
            'unit'=> 'required|string|max:255',
            'is_available'=> 'required|boolean',
            'description'=> 'required|string|max:255',
        ];
    }


    public function messages()
    {
        return [
            'category_id.required' => 'Category is required',
            'image.required' => 'Picture is required',
            'name.required' => 'Name is required',
            'production_date.required' => 'Production date is required',
            'expiry_date.required' => 'Expiry date is required',
            'price.required' => 'Price is required',
            'barcode_number.required' => 'Barcode number is required',
            'unit.required' => 'Unit is required',
            'is_available.required' => 'Is available is required',
            'description.required' => 'Description is required',
        ];
    }
}
