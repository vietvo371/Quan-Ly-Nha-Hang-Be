<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDon\ThongKeHoaDonRequest;
use App\Models\ChiTietHoaDonBanHang;
use App\Models\HoaDonBanHang;
use Illuminate\Http\Request;

class HoaDonBanHangController extends Controller
{
    public function getData(ThongKeHoaDonRequest $request)
    {
        $id_chuc_nang = 41;

        $data   =   HoaDonBanHang::join('bans', 'hoa_don_ban_hangs.id_ban', 'bans.id')
                                 ->join('nhan_viens', 'hoa_don_ban_hangs.id_nhan_vien', 'nhan_viens.id')
                                 ->select('hoa_don_ban_hangs.*', 'bans.ten_ban', 'nhan_viens.ho_va_ten as ten_nhan_vien')
                                 ->whereDate('hoa_don_ban_hangs.created_at', '>=', $request->begin)
                                 ->whereDate('hoa_don_ban_hangs.created_at', '<=', $request->end)
                                 ->where('hoa_don_ban_hangs.is_done', 1)
                                 ->get();

        return response()->json([
            'data'          =>  $data,
            'tong_tien'     =>  $data->sum('tien_thuc_nhan')
        ]);
    }

    public function chiTietHoaDon(Request $request)
    {
        $id_chuc_nang = 66;

        $data   = ChiTietHoaDonBanHang::where('id_hoa_don', $request->id)
                                      ->join('mon_ans', 'chi_tiet_hoa_don_ban_hangs.id_mon_an', 'mon_ans.id')
                                      ->select('chi_tiet_hoa_don_ban_hangs.*', 'mon_ans.ten_mon')
                                      ->get();

        return response()->json([
            'data'  =>  $data,
        ]);
    }

    public function dataBill(Request $request)
    {
        $data = ChiTietHoaDonBanHang::where('id_hoa_don', $request->id_hoa_don_ban_hang)
                                    ->join('mon_ans', 'mon_ans.id', 'chi_tiet_hoa_don_ban_hangs.id_mon_an')
                                    ->select('chi_tiet_hoa_don_ban_hangs.*', 'mon_ans.ten_mon')
                                    ->get();
        $hoa_don  = HoaDonBanHang::where('hoa_don_ban_hangs.id', $request->id_hoa_don_ban_hang)
                             ->join('bans', 'bans.id', 'hoa_don_ban_hangs.id_ban')
                             ->select('bans.ten_ban', 'hoa_don_ban_hangs.tong_tien_truoc_giam', 'hoa_don_ban_hangs.phan_tram_giam', 'hoa_don_ban_hangs.tien_thuc_nhan', 'hoa_don_ban_hangs.ghi_chu', 'hoa_don_ban_hangs.is_done')
                             ->first();
        if($hoa_don->is_done == 0 ) {
            $hoa_don->phan_tram_giam = $hoa_don->phan_tram_giam == null ? 0 : $hoa_don->phan_tram_giam;
            $hoa_don->tien_thuc_nhan = $data->sum('thanh_tien') * (1 - ($hoa_don->phan_tram_giam / 100));
            $hoa_don->tong_tien_truoc_giam = $data->sum('thanh_tien');
        }
        return response()->json([
            'data'      => $data,
            'hoa_don'   => $hoa_don
        ]);
    }
}
