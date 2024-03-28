<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDonBanHang;
use App\Models\HoaDonBanHang;
use App\Models\NhapKho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function getDataThongke1(Request $request) // Thống kê số tiền bán ra theo ngày
    {
        $data = HoaDonBanHang::where('is_done', 1)
                             ->whereDate('created_at', ">=", $request->begin)
                             ->whereDate('created_at', "<=", $request->end)
                             ->select(
                                DB::raw("SUM(tien_thuc_nhan) as total"),
                                DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as lable"),
                             )
                             ->groupBy('lable')
                             ->get();

        $list_lable = [];
        $list_data  = [];

        foreach ($data as $key => $value) {
            array_push($list_data, $value->total);
            array_push($list_lable, $value->lable);
        }

        return response()->json([
            'list_lable' => $list_lable,
            'list_data'  => $list_data,
        ]);
    }

    public function getDataThongke2(Request $request) // Thống kê 7 Nguyên Liệu được nhập kho nhiều nhất từ ngày đến ngày
    {
        $data = NhapKho::join('hoa_don_nhap_khos', 'hoa_don_nhap_khos.id', 'nhap_khos.id_hoa_don_nhap_kho')
                        ->join('nguyen_lieus', 'nguyen_lieus.id', 'nhap_khos.id_nguyen_lieu')
                        ->whereDate('hoa_don_nhap_khos.created_at', ">=", $request->begin)
                        ->whereDate('hoa_don_nhap_khos.created_at', "<=", $request->end)
                        ->select(
                            DB::raw("SUM(nhap_khos.so_luong) as total"),
                            'nguyen_lieus.ten_nguyen_lieu'
                        )
                        ->groupBy('nguyen_lieus.ten_nguyen_lieu')
                        ->get();

        $list_lable = [];
        $list_data  = [];

        foreach ($data as $key => $value) {
            array_push($list_data, $value->total);
            array_push($list_lable, $value->ten_nguyen_lieu);
        }

        return response()->json([
            'list_lable' => $list_lable,
            'list_data'  => $list_data,
        ]);
    }

    public function getDataThongke3(Request $request) // Thống kê 7 món ăn được order nhiều nhất từ ngày đến ngày
    {
        $data = ChiTietHoaDonBanHang::join('hoa_don_ban_hangs', 'hoa_don_ban_hangs.id', 'chi_tiet_hoa_don_ban_hangs.id_hoa_don')
                                    ->join('mon_ans', 'mon_ans.id', 'chi_tiet_hoa_don_ban_hangs.id_mon_an')
                                    ->whereDate('hoa_don_ban_hangs.created_at', ">=", $request->begin)
                                    ->whereDate('hoa_don_ban_hangs.created_at', "<=", $request->end)
                                    ->select(
                                        DB::raw("SUM(chi_tiet_hoa_don_ban_hangs.so_luong) as total"),
                                        'mon_ans.ten_mon'
                                    )
                                    ->groupBy('mon_ans.ten_mon')
                                    ->get();
            $list_lable = [];
            $list_data  = [];

            foreach ($data as $key => $value) {
                array_push($list_data, $value->total);
                array_push($list_lable, $value->ten_mon);
            }
        return response()->json([
            'list_lable' => $list_lable,
            'list_data'  => $list_data,
        ]);
    }
}
