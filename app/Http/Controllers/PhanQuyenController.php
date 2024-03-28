<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhanQuyenRequest;
use App\Models\PhanQuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhanQuyenController extends Controller
{
    public function createPhanQuyen(CreatePhanQuyenRequest $request)
    {
        $check = PhanQuyen::where('id_chuc_nang', $request->id_chuc_nang)
                          ->where('id_chuc_vu', $request->id_chuc_vu)->first();
        if($check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Chức vụ đã có chức năng này!'
            ]);
        } else {
            PhanQuyen::create([
                'id_chuc_nang'  =>  $request->id_chuc_nang,
                'id_chuc_vu'    =>  $request->id_chuc_vu
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã phân quyền thành công'
            ]);
        }
    }

    public function getChucNang(Request $request)
    {
        $data   = DB::table('actions')->join('phan_quyens', 'actions.id', 'phan_quyens.id_chuc_nang')
                                      ->where('id_chuc_vu', $request->id)
                                      ->select('phan_quyens.*', 'actions.ten_action')
                                      ->get();
        // $data   = PhanQuyen::where('id_chuc_vu', $request->id)->get();

        return response()->json([
            'data'   =>  $data
        ]);
    }

    public function xoaPhanQuyen($id)
    {
        $phan_quyen = PhanQuyen::where('id', $id)->first();

        if($phan_quyen) {
            $phan_quyen->delete();

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã xóa phân quyền thành công'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Đã có lỗi xảy ra!'
            ]);
        }
    }
}
