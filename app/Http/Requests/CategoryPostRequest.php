<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'desc' => 'required|string',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute là ký tự',
            'max' => ':attribute không quá :max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên danh mục bài viết',
            'slug' => 'Slug danh mục bài viết',
            'desc' => 'Mô tả danh mục bài viết',
            'status' => 'Trạng thái bài viết',
        ];
    }
}
