<?php

namespace App\Http\Requests\NhapKho;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietHoaDonNhapKhoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'               =>  'required|exists:nhap_khos,id',
            'so_luong'         =>  'required|numeric|min:1',
            'don_gia'          =>  'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                  =>  'Chi tiết bán hàng không tồn tại!',
            'so_luong.*'            =>  'Số lượng Nhập ít nhất là 1',
            'don_gia.*'             =>  'Đơn giá phải là số!',
        ];
    }

}
