<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OriginRequest extends FormRequest
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
            'slug' => 'required|string',
            'desc' => 'required|string',
        ];
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
            'name' => 'Tên xuất xứ',
            'slug' => 'Slug xuất xứ',
            'desc' => 'Mô tả xuất xứ',
        ];
    }
}
