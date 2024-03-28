<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ban\CreateBanuRequest;
use App\Http\Requests\Ban\UpdateBanRequest;
use App\Models\Ban;
use App\Models\PhanQuyen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BanController extends Controller
{
    public function index()
    {
        return view('ban');
    }

    public function getData()
    {
        $id_chuc_nang = 43;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        $data   = Ban::join('khu_vucs', 'khu_vucs.id', 'bans.id_khu_vuc')
            ->select('bans.*', 'khu_vucs.ten_khu')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'ban'  =>  $data,
        ]);
    }

    public function searchBan(Request $request)
    {
        $id_chuc_nang = 67;

        $key = "%" . $request->abc . "%";

        $data   = Ban::join('khu_vucs', 'khu_vucs.id', 'bans.id_khu_vuc')
            ->where('bans.ten_ban', 'like', $key)
            ->select('bans.*', 'khu_vucs.ten_khu')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'ban'  =>  $data,
        ]);
    }

    public function createBan(CreateBanuRequest $request)
    {
        $id_chuc_nang = 44;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        $ban = Ban::where('slug_ban', $request->slug_ban)
                  ->where('id_khu_vuc', $request->id_khu_vuc)
                  ->first();

        if($ban) {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn này đã tồn tại trong khu vực!'
            ]);
        }

        Ban::create([
            'ten_ban'      => $request->ten_ban,
            'slug_ban'     => $request->slug_ban,
            'id_khu_vuc'   => $request->id_khu_vuc,
            'tinh_trang'   => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới bàn thành công!',
        ]);
    }
    public function xoaBan($id)
    {
        $id_chuc_nang = 46;

        try {
            Ban::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa bàn thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function capNhatBan(UpdateBanRequest $request)
    {
        $id_chuc_nang = 45;

        try {
            $ban = Ban::where('slug_ban', $request->slug_ban)
                        ->where('id_khu_vuc', $request->id_khu_vuc)
                        ->where('id', "<>", $request->id)
                        ->first();

            if($ban) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Bàn này đã tồn tại trong khu vực!'
                ]);
            }

            Ban::where('id', $request->id)
                ->update([
                    'ten_ban'           => $request->ten_ban,
                    'slug_ban'          => $request->slug_ban,
                    'id_khu_vuc'        => $request->id_khu_vuc,
                    'tinh_trang'        => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công ' . $request->ten_ban,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiBan(Request $request)
    {
        $id_chuc_nang = 45;

        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            Ban::where('id', $request->id)
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
}
