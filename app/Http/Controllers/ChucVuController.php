<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChucVu\CreateChucVuRequest;
use App\Http\Requests\ChucVu\UpdateChucVuRequest;
use App\Models\ChucVu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChucVuController extends Controller
{
    public function getDataPhanQuyen()
    {
        $listChucVu     = ChucVu::get();
        $listChucNang   = DB::table('actions')->get();

        return response()->json([
            'listChucVu'    =>  $listChucVu,
            'listChucNang'  =>  $listChucNang,
        ]);
    }

    public function index()
    {
        return view('chuc_vu');
    }

    public function getData()
    {
        $data   = ChucVu::get(); // get là ra 1 danh sách

        return response()->json([
            'chuc_vu'  =>  $data,
        ]);
    }

    public function searchChucVu(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = ChucVu::where('ten_chuc_vu', 'like', $key)
                        ->get(); // get là ra 1 danh sách

        return response()->json([
            'chuc_vu'  =>  $data,
        ]);
    }

    public function createChucVu(CreateChucVuRequest $request)
    {
        ChucVu::create([
            'ten_chuc_vu'      => $request->ten_chuc_vu,
            'tinh_trang'       => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới chức vụ thành công!',
        ]);
    }
    public function xoaChucVu($id){
        try {
            ChucVu::where('id',$id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa chức vụ thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi",$e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatChucVu(UpdateChucVuRequest $request){
        try {
            ChucVu::where('id', $request->id)
                ->update([
                    'ten_chuc_vu'       => $request->ten_chuc_vu,
                    'tinh_trang'         => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công chúc vụ ' . $request->ten_chuc_vu,
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
