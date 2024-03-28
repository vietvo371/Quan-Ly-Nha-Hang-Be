<?php

namespace App\Http\Requests\HoaDon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietHoaDonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'               =>  'required|exists:chi_tiet_hoa_don_ban_hangs,id',
            'so_luong'         =>  'required|numeric|min:1',
            'don_gia'          =>  'nullable|numeric',
            'phan_tram_giam'   =>  'numeric',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                  =>  'Chi tiết bán hàng không tồn tại!',
            'so_luong.*'            =>  'Số lượng Nhập ít nhất là 1',
            'don_gia.*'             =>  'Đơn giá phải là số!',
            'phan_tram_giam.*'      =>  'Phân trăm giảm phải là số!',

        ];
    }
}
