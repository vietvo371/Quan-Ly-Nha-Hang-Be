<?php

namespace App\Http\Requests\NhapKho;

use Illuminate\Foundation\Http\FormRequest;

class ThemNguyenLieuVaoKhoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:nguyen_lieus,id'
        ];

    }
    public function messages()
    {
        return [
            'id.*'                =>  'Nguyên Liệu không tồn tại!',
        ];
    }

}
