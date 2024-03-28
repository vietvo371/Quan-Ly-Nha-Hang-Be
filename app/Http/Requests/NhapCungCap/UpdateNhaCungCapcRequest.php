<?php

namespace App\Http\Requests\NhapCungCap;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNhaCungCapcRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    =>  'required|exists:nha_cung_caps,id',
            'ma_so_thue'            =>  'nullable|unique:nha_cung_caps,ma_so_thue,' . $this->id,
            'ten_cong_ty'           =>  'required',
            'ten_nguoi_dai_dien'    =>  'required',
            'so_dien_thoai'         =>  'required|digits:10',
            'email'                 =>  'required|email|unique:nha_cung_caps,email,' . $this->id,
            'dia_chi'               =>  'nullable',
            'ten_goi_nho'           =>  'nullable',
            'tinh_trang'            =>  'boolean',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                          => 'Nhà cung cấp không tồn tại!',
            'ma_so_thue.*'                  => 'Mã số thuế đã tồn tại trong hệ thống!',
            'ten_cong_ty.required'          => 'Tên công ty không được để trống!',
            'ten_nguoi_dai_dien.required'   => 'Tên người đại điện không được để trống!',
            'so_dien_thoai.required'        => 'Số điện thoại không được để trống!',
            'so_dien_thoai.digits'          => 'Số điện thoại phải là 10 số!',
            'email.required'                => 'Email không được để trống!',
            'email.email'                   => 'Email phải đúng định dạng!',
            'email.unique'                  => 'Email đã tồn tại!',
        ];
    }


}
