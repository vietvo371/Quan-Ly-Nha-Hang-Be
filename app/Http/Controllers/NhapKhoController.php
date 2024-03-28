<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhapKho\CraeteNhapKhoRequest;
use App\Http\Requests\NhapKho\ThemNguyenLieuVaoKhoRequest;
use App\Http\Requests\NhapKho\ThongKeNhapKhoRequest;
use App\Http\Requests\NhapKho\UpdateChiTietHoaDonNhapKhoRequest;
use App\Models\HoaDonNhapKho;
use App\Models\NhaCungCap;
use App\Models\NhapKho;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NhapKhoController extends Controller
{
    public function index()
    {
        return view('nhap_kho');
    }

    public function getData()
    {
        $id_chuc_nang = 31;

        $data   = NhapKho::join('nguyen_lieus', 'id_nguyen_lieu', 'nguyen_lieus.id')
                         ->select('nhap_khos.*', 'nguyen_lieus.ten_nguyen_lieu')
                         ->where('id_hoa_don_nhap_kho', 0)
                         ->get(); // get là ra 1 danh sách


        $tong_tien = $data->sum('thanh_tien');

        return response()->json([
            'nhap_kho'  => $data,
            'tong_tien' => $tong_tien
        ]);
    }
    public function addNguyenLieu(ThemNguyenLieuVaoKhoRequest $request)
    {
        $id_chuc_nang = 59;

        $user = Auth::guard('sanctum')->user();
        $nhap_kho = NhapKho::where('id_nguyen_lieu', $request->id)
                           ->where('id_hoa_don_nhap_kho', 0)
                           ->first();

        if($nhap_kho) {
            $nhap_kho->so_luong     = $nhap_kho->so_luong + 1;
            $nhap_kho->thanh_tien   = $nhap_kho->so_luong * $nhap_kho->don_gia;
            $nhap_kho->save();
        } else {
            NhapKho::create([
                'id_nguyen_lieu'=> $request->id,
                'id_nhan_vien'  => $user->id
            ]);
        }

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Thêm nguyên liệu thành công!',
        ]);
    }
    public function xoaNguyenLieu($id)
    {
        $id_chuc_nang = 60;

        try {
            NhapKho::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nguyên liệu nhập kho thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateNhapKho(UpdateChiTietHoaDonNhapKhoRequest $request)
    {
        $id_chuc_nang = 32;

        $nhap_kho = NhapKho::where('id', $request->id)->first();

        if($nhap_kho) {
            $nhap_kho->update([
                'so_luong'      => $request->so_luong,
                'don_gia'       => $request->don_gia,
                'thanh_tien'    => $request->so_luong * $request->don_gia,
            ]);

            return response()->json([
                'status'            =>   true,
                'message'           =>   'Cập Nhật Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi của hệ thống!',
            ]);
        }
    }

    public function createHoaDonNhapKho(CraeteNhapKhoRequest $request)
    {
        $id_chuc_nang = 33;

        $user          = Auth::guard('sanctum')->user();

        $nhap_cung_cap = NhaCungCap::find($request->id_nha_cung_cap);
        if(!$nhap_cung_cap) {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng chọn nhà cung cấp!"
            ]);
        }

        $list_nhap_kho = NhapKho::where('id_hoa_don_nhap_kho', 0)
                                ->where('id_nhan_vien', $user->id)
                                ->get();
        if($list_nhap_kho->count() > 0) {
            $tong_tien = $list_nhap_kho->sum('thanh_tien');

            $hoa_don = HoaDonNhapKho::create([
                'tong_tien'         => $tong_tien,
                'id_nhan_vien'      => $user->id,
                'id_nha_cung_cap'   => $request->id_nha_cung_cap,
                'ghi_chu'           => $request->ghi_chu
            ]);

            $prefix = 'NK';
            $ma_hoa_don = $prefix . str_pad($hoa_don->id, 5, '0', STR_PAD_LEFT);

            $hoa_don->ma_hoa_don = $ma_hoa_don;
            $hoa_don->save();

            NhapKho::where('id_hoa_don_nhap_kho', 0)
                    ->where('id_nhan_vien', $user->id)
                    ->update([
                        'id_hoa_don_nhap_kho' => $hoa_don->id
                    ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Bạn đã nhập kho thành công!"
        ]);
    }

    public function getDataHoaDonNhapKho(ThongKeNhapKhoRequest $request)
    {
        $id_chuc_nang = 34;

        $data = HoaDonNhapKho::join('nhan_viens', 'nhan_viens.id', 'hoa_don_nhap_khos.id_nhan_vien')
                             ->join('nha_cung_caps', 'nha_cung_caps.id', 'hoa_don_nhap_khos.id_nha_cung_cap')
                             ->whereDate('hoa_don_nhap_khos.created_at', '>=', $request->begin)
                             ->whereDate('hoa_don_nhap_khos.created_at', '<=', $request->end)
                             ->select(
                                'hoa_don_nhap_khos.id',
                                'hoa_don_nhap_khos.ma_hoa_don',
                                'hoa_don_nhap_khos.tong_tien',
                                'hoa_don_nhap_khos.ghi_chu',
                                'nha_cung_caps.ten_cong_ty',
                                'nhan_viens.ho_va_ten',
                             )
                             ->get();

        return response()->json([
            'data' => $data,
            'tong_tien' => $data->sum('tong_tien')
        ]);
    }

    public function getDataChiTietHoaDonNhapKho(Request $request)
    {
        $data = NhapKho::join('hoa_don_nhap_khos', 'hoa_don_nhap_khos.id', 'nhap_khos.id_hoa_don_nhap_kho')
                       ->join('nguyen_lieus', 'nguyen_lieus.id', 'nhap_khos.id_nguyen_lieu')
                       ->where('hoa_don_nhap_khos.id', $request->id)
                       ->select('nhap_khos.*', 'nguyen_lieus.ten_nguyen_lieu')
                       ->get();
        return response()->json([
            'data' => $data
        ]);
    }

}
