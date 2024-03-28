<?php

namespace App\Http\Requests\HoaDon;

use Illuminate\Foundation\Http\FormRequest;

class TaoHoaDonRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id'                => 'required|exists:hoa_don_ban_hangs,id',
            'phan_tram_giam'    => 'numeric',
        ];
    }
    public function messages()
    {
        return [
            'id.*'                  =>  'Hóa đơn phải tồn tại!',
            'phan_tram_giam.*'      =>  'Phân trăm giảm phải là số!',
        ];
    }
}
