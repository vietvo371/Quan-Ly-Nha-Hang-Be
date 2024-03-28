<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNhanVienRequest;
use App\Mail\mailQuenMatKhau;
use App\Models\NhanVien;
use App\Models\PhanQuyen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NhanVienController extends Controller
{
    public function index()
    {
        return view('nhan_vien');
    }

    public function getData()
    {
        $id_chuc_nang = 2;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        // Người đang login có id_chuc_vu = 1 và chức năng đang sử dụng có id = 2
        // Thằng này sẽ được sử dụng chức năng khi và chỉ khi trong table id_chuc_vu và id_chuc_nang nằm cùng 1 dòng
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }

        $data   = NhanVien::leftjoin('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
                            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
                            ->get(); // get là ra 1 danh sách

        return response()->json([
            'nhan_vien'  =>  $data,
        ]);
    }

    public function searchNhanVien(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = NhanVien::join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
            ->where('nhan_viens.ho_va_ten', 'like', $key)
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
            ->get();

        return response()->json([
            'nhan_vien'  =>  $data,
        ]);
    }

    public function createNhanVien(CreateNhanVienRequest $request)
    {
        $id_chuc_nang = 9999;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        NhanVien::create([
            'ho_va_ten'         => $request->ho_va_ten,
            'email'             => $request->email,
            'password'          => $request->password,
            'so_dien_thoai'     => $request->so_dien_thoai,
            'dia_chi'           => $request->dia_chi,
            'id_chuc_vu'        => $request->id_chuc_vu,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới nhân viên thành công!',
        ]);
    }
    public function xoaNhanVien($id)
    {
        $id_chuc_nang = 5;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        try {
            NhanVien::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nhân viên thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatNhanVien(Request $request)
    {
        $id_chuc_nang = 4;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        try {
            NhanVien::where('id', $request->id)
                ->update([
                    'ho_va_ten'         => $request->ho_va_ten,
                    'email'             => $request->email,
                    'password'          => $request->password,
                    'so_dien_thoai'     => $request->so_dien_thoai,
                    'dia_chi'           => $request->dia_chi,
                    'id_chuc_vu'        => $request->id_chuc_vu,
                    'tinh_trang'        => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công nhân viên ' . $request->ho_va_ten,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiNhanVien(Request $request)
    {
        $id_chuc_nang = 4;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            NhanVien::where('id', $request->id)
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

    public function kiemTraQuenMK(Request $request)
    {
        $check  = NhanVien::where('hash_quen_mat_khau', $request->hash_quen_mat_khau)->first();
        if($check) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Bạn hãy tạo mật khẩu mới đi nhé!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Bạn không được phép ở đây!',
            ]);
        }
    }

    public function doiMatKhau(Request $request)
    {

        $nhanVien  = NhanVien::where('hash_quen_mat_khau', $request->hash_quen_mat_khau)->first();
        if($nhanVien) {
            $nhanVien->password             =   bcrypt($request->password);
            $nhanVien->hash_quen_mat_khau   =   null;
            $nhanVien->save();

            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi mật khẩu thành công!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Bạn không được phép ở đây!',
            ]);
        }
    }

    public function quenMatKhau(Request $request)
    {
        // Gửi lên 1 thằng duy nhất $request->email
        $nhanVien   = NhanVien::where('email', $request->email)->first();
        if($nhanVien) {
            // Tạo 1 mã hash_quen_mat_khau (gì cũng được, đừng dễ đoán và không trùng)
            $ma_random                      =   Str::uuid();
            $nhanVien->hash_quen_mat_khau   =   $ma_random;
            $nhanVien->save();
            // Gửi Email
            $info['name']  =    $nhanVien->ho_va_ten;
            $info['link']  =    'http://localhost:5173/dat-lai-mat-khau/' . $ma_random;
            Mail::to($request->email)->send(new mailQuenMatKhau('mail.quen_mat_khau', 'Khôi Phục Tài Khoản Của Bạn', $info));
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Vui lòng kiểm tra email của bạn!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tài khoản của bạn không tồn tại!',
            ]);
        }
    }
}
