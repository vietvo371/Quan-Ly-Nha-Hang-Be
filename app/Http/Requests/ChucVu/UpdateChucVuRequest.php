<?php

namespace App\Http\Requests\ChucVu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChucVuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'id'                =>  'required|exists:chuc_vus,id',
            'ten_chuc_vu'       => 'required|between:5,50|unique:chuc_vus,ten_chuc_vu,' .$this->id,
            'tinh_trang'        => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'id.*'                         => 'Tên Chức Vụ không tồn tại!',
            'ten_chuc_vu.required'         =>  'Tên Chức Vụ yêu cầu phải nhập',
            'ten_chuc_vu.between'          =>  'Tên Chức Vụ phải từ 5 đến 50 ký tự',
            'ten_chuc_vu.unique'           =>  'Tên Chức Vụ đã tồn tại hệ thống',
            'tinh_trang.*'                 =>  'Vui lòng chọn tình trạng theo yêu cầu!',
        ];
    }
}
