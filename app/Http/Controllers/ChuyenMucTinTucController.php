<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChuyenMuc\CreateChuyenMuccRequest;
use App\Http\Requests\ChuyenMuc\UpdateChuyenMuccRequest;
use App\Models\ChuyenMucTinTuc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChuyenMucTinTucController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 51;

        $data   = ChuyenMucTinTuc::select('id', 'ten_chuyen_muc', 'slug_chuyen_muc', 'tinh_trang')
            ->get();

        return response()->json([
            'chuyen_muc'  =>  $data,
        ]);
    }
    public function searchChuyenMuc(Request $request)
    {
        $id_chuc_nang = 72;

        $key = "%" . $request->abc . "%";

        $data   = ChuyenMucTinTuc::select('id', 'ten_chuyen_muc', 'slug_chuyen_muc', 'tinh_trang')
            ->where('ten_chuyen_muc', 'like', $key)
            ->get();

        return response()->json([
            'chuyen_muc'  =>  $data,
        ]);
    }
    public function createChuyenMuc(CreateChuyenMuccRequest $request)
    {
        $id_chuc_nang = 52;

        ChuyenMucTinTuc::create([
            'ten_chuyen_muc'      => $request->ten_chuyen_muc,
            'slug_chuyen_muc'     => $request->slug_chuyen_muc,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới chuyên mục thành công!',
        ]);
    }
    public function xoaChuyenMuc($id)
    {
        $id_chuc_nang = 54;

        try {
            ChuyenMucTinTuc::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa chuyên mục thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatChuyenMuc(UpdateChuyenMuccRequest $request)
    {
        $id_chuc_nang = 53;

        try {
            ChuyenMucTinTuc::where('id', $request->id)
                ->update([
                    'ten_chuyen_muc'       => $request->ten_chuyen_muc,
                    'slug_chuyen_muc'      => $request->slug_chuyen_muc,
                    'tinh_trang'           => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công chuyên mục ' . $request->ten_chuyen_muc,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiChuyenMuc(Request $request)
    {
        $id_chuc_nang = 53;

        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            ChuyenMucTinTuc::where('id', $request->id)
                ->update([
                    'tinh_trang'  => $tinh_trang_moi,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi trạng thái thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function kiemTraSlugChuyenMuc(Request $request)
    {
        $chuyen_muc = ChuyenMucTinTuc::where('slug_chuyen_muc', $request->slug)->first();

        if(!$chuyen_muc) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Chuyên Mục phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Chuyên Mục Đã Tồn Tại!',
            ]);
        }
    }

    public function kiemTraSlugChuyenMucUpdate(Request $request)
    {
        $chuyen_muc = ChuyenMucTinTuc::where('slug_chuyen_muc', $request->slug)
                                     ->where('id', '<>' , $request->id)
                                     ->first();

        if(!$chuyen_muc) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Chuyên Mục phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Chuyên Mục Đã Tồn Tại!',
            ]);
        }
    }
}
