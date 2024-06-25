<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'desc' => 'required|string',
            'content' => 'required|string',
            'categoryPost_id' => 'required',
            'status' => 'required'
        ];
    
        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else if ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute là ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên bài viết',
            'image' => 'Ảnh bài viết',
            'slug' => 'Slug bài viết',
            'desc' => 'Mô tả bài viết',
            'content' => 'Nội dụng bài viết',
            'categoryPost_id' => 'Danh mục bài viết',
            'status' => 'Trạng thái bài viết',
        ];
    }
}
