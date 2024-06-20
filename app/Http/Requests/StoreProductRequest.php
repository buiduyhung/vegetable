<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueColor;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    { 
        return [
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|string|unique:products,name',
            'product_code' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'weight' => 'required|string',
            'description' =>'required|string',
            'images' => 'array|required',
            'images.*' => 'required|mimes:jpg,bmp,png,webp'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute có độ dài từ :min ký tự',
            'numeric' => ':attribute phải là số',
            'string' => ':attribute là ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'Thương hiệu sản phẩm',
            'category_id' => 'Danh mục sản phẩm',
            'product_code' => 'Mã sản phẩm',
            'price' => 'Giá sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'weight' => 'Trọng lượng sản phẩm',
            'images' => 'Hình ảnh sản phẩm',
            'description' => 'Trọng lượng sản phẩm',
        ];
    }
}
