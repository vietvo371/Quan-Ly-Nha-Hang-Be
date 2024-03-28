<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDon\TaoHoaDonRequest;
use App\Http\Requests\HoaDon\UpdateChiTietHoaDonRequest;
use App\Models\Ban;
use App\Models\ChiTietHoaDonBanHang;
use App\Models\HoaDonBanHang;
use App\Models\MonAn;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DichVuController extends Controller
{
    public function getDataTheoKhuVuc(Request $request)
    {
        $id_chuc_nang = 61;

        $data = Ban::where('tinh_trang', 1)
                   ->where('id_khu_vuc', $request->id)
                   ->get();

        if($data){
            return response()->json([
                'data'    => $data,
            ]);
        }

    }

    public function getDataMonAn()
    {
        $id_chuc_nang = 62;

        $data = MonAn::where('tinh_trang', 1)->get();

        return response()->json([
            'data'    => $data,
        ]);
    }

    public function moBan(Request $request)
    {
        $id_chuc_nang = 38;

        $ban = Ban::where('id', $request->id)->first();

        if($ban){
            $hoaDon = HoaDonBanHang::where('is_done', 0)
                                   ->where('id_ban', $ban->id)
                                   ->first();
            if($hoaDon){
                $chiTiet = ChiTietHoaDonBanHang::where('id_hoa_don', $hoaDon->id)->get();
                $tong_tien = 0;
                foreach ($chiTiet as $key => $value) {
                    $tong_tien = $tong_tien + $value->thanh_tien;
                }
                return response()->json([
                    'status'               => 2,
                    'id_hoa_don_ban_hang'  => $hoaDon->id,
                    'tong_tien'            => $tong_tien
                ]);
            }else{
                $user = Auth::guard('sanctum')->user();
                $hoaDon = HoaDonBanHang::create([
                    'id_ban' => $request->id,
                    'id_nhan_vien' => $user->currentAccessToken()->tokenable_id,
                ]);

                if($hoaDon){
                    $ban->is_mo_ban = 1;
                    $ban->save();
                    return response()->json([
                        'status'                => 1,
                        'message'               => 'Đã mở bàn thành công!',
                        'id_hoa_don_ban_hang'   => $hoaDon->id,
                    ]);
                }
            }
        }
    }

    public function themMonAn(Request $request)
    {
        $id_chuc_nang = 39;

        $timMonAn = ChiTietHoaDonBanHang::where('is_done', 0)
                                        ->where('id_mon_an', $request->id_mon_an)
                                        ->where('id_hoa_don', $request->id_hoa_don)
                                        ->first();
        if($timMonAn){
            $timMonAn->so_luong = $timMonAn->so_luong + 1;
            $tienGiam = $timMonAn->so_luong * $timMonAn->don_gia / 100 * $timMonAn->phan_tram_giam;

            $timMonAn->thanh_tien = ($timMonAn->don_gia * $timMonAn->so_luong) - $tienGiam;
            $timMonAn->save();
            $chiTiet = ChiTietHoaDonBanHang::where('id_hoa_don', $request->id_hoa_don)->get();
            $tong_tien = 0;
            foreach ($chiTiet as $key => $value) {
                $tong_tien = $tong_tien + $value->thanh_tien;
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập nhật món thành công!',
                'tong_tien' => $tong_tien
            ]);
        }else{
            $chiTiet = ChiTietHoaDonBanHang::create([
                'id_hoa_don'   => $request->id_hoa_don,
                'id_mon_an'    => $request->id_mon_an,
                'so_luong'     => 1 ,
                'don_gia'      => $request->don_gia,
                'thanh_tien'   => $request->don_gia,
            ]);
            $chiTiet = ChiTietHoaDonBanHang::where('id_hoa_don', $request->id_hoa_don)->get();
            $tong_tien = 0;
            foreach ($chiTiet as $key => $value) {
                $tong_tien = $tong_tien + $value->thanh_tien;
            }
            if($chiTiet){
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Thêm món thành công!',
                    'tong_tien' => $tong_tien
                ]);
            }
        }
    }

    public function getChiTietBanHang(Request $request)
    {
        $id_chuc_nang = 65;

        $chiTiet = ChiTietHoaDonBanHang::join('mon_ans', 'mon_ans.id', 'chi_tiet_hoa_don_ban_hangs.id_mon_an')
                                       ->where('chi_tiet_hoa_don_ban_hangs.id_hoa_don', $request->id_hoa_don)
                                       ->where('chi_tiet_hoa_don_ban_hangs.is_done', 0)
                                       ->select('chi_tiet_hoa_don_ban_hangs.*', 'mon_ans.ten_mon')
                                       ->get();
        return response()->json([
            'data'    => $chiTiet,
        ]);
    }

    public function updateChiTietBanHang(UpdateChiTietHoaDonRequest $request)
    {
        $id_chuc_nang = 63;

        $chiTiet = ChiTietHoaDonBanHang::where('id', $request->id)->first();

        if($chiTiet){
            $tienGiam = $request->so_luong * $request->don_gia / 100 * $request->phan_tram_giam;
            $chiTiet->so_luong =  $request->so_luong;
            $chiTiet->don_gia =  $request->don_gia;
            $chiTiet->phan_tram_giam =  $request->phan_tram_giam;
            $chiTiet->thanh_tien =  ($request->so_luong * $request->don_gia) - $tienGiam;
            $chiTiet->ghi_chu =  $request->ghi_chu;
            $chiTiet->update();
            $data = ChiTietHoaDonBanHang::where('id_hoa_don', $chiTiet->id_hoa_don)->get();
            $tong_tien = 0;
            foreach ($data as $key => $value) {
                $tong_tien = $tong_tien + $value->thanh_tien;
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập nhật thành công!',
                'tong_tien' => $tong_tien
            ]);
        }
    }

    public function deleteChiTietBanHang(Request $request)
    {
        $id_chuc_nang = 64;

        $chiTiet = ChiTietHoaDonBanHang::where('id', $request->id)->first();
        if($chiTiet){
            $chiTiet->delete();
            $data = ChiTietHoaDonBanHang::where('id_hoa_don', $chiTiet->id_hoa_don)->get();
            $tong_tien = 0;
            foreach ($data as $key => $value) {
                $tong_tien = $tong_tien + $value->thanh_tien;
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Xóa thành công!',
                'tong_tien' => $tong_tien
            ]);
        }
    }


    public function thanhToan(TaoHoaDonRequest $request)
    {
        $id_chuc_nang = 40;

        try {
            $data = $request->all();

            $hoaDon = HoaDonBanHang::where('id', $data['id'])->first();

            if($hoaDon){
                $chiTiet = ChiTietHoaDonBanHang::where('id_hoa_don', $hoaDon->id)
                                               ->first();
                if($chiTiet){
                    $hoaDon->tong_tien_truoc_giam = $data['tong_tien_truoc_giam'];
                    $hoaDon->phan_tram_giam = $data['phan_tram_giam'];
                    $hoaDon->tien_thuc_nhan = $data['tien_thuc_nhan'];
                    $hoaDon->ghi_chu = $data['ghi_chu'];
                    $hoaDon->is_done = 1;
                    $hoaDon->save();
                    $chiTiet = ChiTietHoaDonBanHang:: where('id_hoa_don', $hoaDon->id)->get();
                    foreach ($chiTiet as $key => $value) {
                        $value->is_done = 1;
                        $value->save();
                    }
                    $ban = Ban::where('id', $hoaDon->id_ban)->first();
                    $ban->is_mo_ban = 0;
                    $ban->save();

                    return response()->json([
                        'status'            =>   true,
                        'message'           =>   'Đã thanh toán thành công!',
                    ]);
                }else{
                    $ban = Ban::where('id', $hoaDon->id_ban)->first();
                    $ban->is_mo_ban = 0;
                    $ban->save();
                    $hoaDon->delete();
                    return response()->json([
                        'status'            =>   false,
                        'message'           =>   'Đã đóng bàn, không có món ăn!',
                    ]);
                }
            }
        } catch (Exception $e) {
            Log::info("Lỗi",$e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }

    }

}
