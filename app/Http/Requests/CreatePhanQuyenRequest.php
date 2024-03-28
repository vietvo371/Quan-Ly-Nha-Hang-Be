<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhanQuyenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_chuc_nang'  =>  'required|exists:actions,id',
            'id_chuc_vu'    =>  'required|exists:chuc_vus,id',
        ];
    }
    public function messages()
    {
        return [
            'id_chuc_nang.*'  =>  'Chức năng không tồn tại',
            'id_chuc_vu.*'    =>  'Chức vụ không tồn tại',
        ];
    }
}
