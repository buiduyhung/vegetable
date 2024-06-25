<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'name' => 'required|min:2',
            'code' => 'required|min:2',
            'status' => 'required',
            'quantity' => 'required|min:2',
            'value' => 'required|min:2',
            'condition' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn tính năng mã giảm giá');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute có độ dài từ :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên mã giảm giá',
            'code' => 'Mã giảm giá',
            'quantity' => 'Số lượng mã giảm giá',
            'value' => 'Giá trị mã giảm giá',
            'condition' => 'Tính năng mã giảm giá',
            'status' => 'Trạng thái mã giảm giá',
        ];
    }
}
