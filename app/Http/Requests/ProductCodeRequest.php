<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCodeRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'title' => 'required|string',
            'desc' => 'required|string',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute là ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Mã sản phẩm',
            'title' => 'Tên sản phẩm',
            'desc' => 'Mô tả',
            'status' => 'Trạng thái'
        ];
    }
}
