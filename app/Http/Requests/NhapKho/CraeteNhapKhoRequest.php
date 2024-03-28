<?php

namespace App\Http\Requests\NhapKho;

use Illuminate\Foundation\Http\FormRequest;

class CraeteNhapKhoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id_nha_cung_cap'      => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'id_nha_cung_cap.*'         => 'Vui lòng chọn Nhà Cung Cấp',
        ];
    }
}
