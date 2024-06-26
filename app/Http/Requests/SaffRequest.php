<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaffRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'group_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
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
            'min' => ':attribute có độ dài từ :min ký tự',
            'confirmed' => ':attribute nhập lại chưa đúng',
            'string' => ':attribute là ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên nhân viên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu',
            'group_id' => 'Chức vụ',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'image' => 'Ảnh đại diện',
        ];
    }
}
