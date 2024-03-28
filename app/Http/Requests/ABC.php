<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ABC extends FormRequest
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
            'ho_va_ten'     => 'required|unique:table,column,except,id',
            'ho_va_ten'     => 'required|unique:table,column,except,id',

        ];
    }
    public function messages()
    {
        return [
            'ho_va_ten.required'    => 'Họ và tên phải nhập '
        ];
    }
}
