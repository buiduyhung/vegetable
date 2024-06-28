<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'origin_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|string',
            'code_id' => 'required',
            'quantity' => 'required|numeric',
            'weight' => 'required|string',
            'description' =>'required|string',
        ];


        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|array|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else if ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|array|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
    
        return $rules;
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
            'origin_id' => 'Xuất xứ sản phẩm',
            'category_id' => 'Danh mục sản phẩm',
            'code_id' => 'Mã sản phẩm',
            'price' => 'Giá sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'weight' => 'Khối lượng sản phẩm',
            'images' => 'Hình ảnh sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'name' => 'Tên sản phẩm',
            'status' => 'Trạng thái sản phẩm',
        ];
    }
}
