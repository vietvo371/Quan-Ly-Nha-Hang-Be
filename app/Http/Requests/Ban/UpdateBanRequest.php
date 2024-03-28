<?php

namespace App\Http\Requests\Ban;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                =>  'required|exists:bans,id',
            'slug_ban'          =>  'required|min:2|unique:bans,slug_ban,' .$this->id,
            'tinh_trang'        =>  'required|boolean',
            'id_khu_vuc'        =>  'required|exists:khu_vucs,id',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                  => 'Tên Bàn không tồn tại!',
            'ten_ban.required'      =>  'Yêu cầu phải nhập tên bàn!',
            'ten_ban.min'           =>  'Tên bàn phải từ 2 ký tự!',
            'ten_ban.max'           =>  'Tên bàn tối đa được 30 ký tự!',
            'slug_ban.*'            =>  'Slug bàn đã tồn tại!',
            'tinh_trang.*'          =>  'Vui lòng chọn tình trạng theo yêu cầu!',
            'id_khu_vuc.*'          =>  'Vui lòng chọn khu vực!',
            'id_khu_vuc.exists'     =>  'Khu vực không tồn tại!'
        ];
    }
}
