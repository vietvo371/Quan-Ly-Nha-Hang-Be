<?php

namespace App\Http\Requests\BaiViet;

use Illuminate\Foundation\Http\FormRequest;

class CreateBaiVietRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tieu_de_tin_tuc'           => 'required|min:5',
            'slug_tin_tuc'              => 'required|unique:tin_tucs,slug_tin_tuc',
            'hinh_anh_tin_tuc'          => 'required',
            'mo_ta_ngan_tin_tuc'        => 'required|min:10',
            'mo_ta_chi_tiet_tin_tuc'    => 'required|min:20',
            'tinh_trang'                => 'required|numeric|between:0,1',
            'id_chuyen_muc_tin_tuc'     => 'required|exists:chuyen_muc_tin_tucs,id'
        ];
    }
    public function messages()
    {
        return [
            'tieu_de_tin_tuc.*'                  => 'Tiêu đề phải nhiều hơn 5 ký tự',
            'slug_tin_tuc.required'              => 'Slug tin tức không được bỏ trống',
            'slug_tin_tuc.unique'                => 'Bài viết đã tồn tại',
            'hinh_anh_tin_tuc.*'                 => 'Hình ảnh không được bỏ trống',
            'mo_ta_ngan_tin_tuc.*'               => 'Mô tả ngắn phải nhiều hơn 10 ký tự',
            'mo_ta_chi_tiet_tin_tuc.*'           => 'Mô tả chi tiết phải nhiều hơn 20 ký tự',
            'tinh_trang.*'                       => 'Tình trạng phải chọn đúng yêu cầu',
            'id_chuyen_muc_tin_tuc.required'     => 'Vui lòng chọn chuyên mục!',
            'id_chuyen_muc_tin_tuc.exists'       => 'Chuyên mục không tồn tại!',

        ];
    }

}
