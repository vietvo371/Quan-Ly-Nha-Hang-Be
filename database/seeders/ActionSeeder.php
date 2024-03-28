<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actions')->delete();
        DB::table('actions')->truncate();

        DB::table('actions')->insert([
            [ 'id' => 9999, 'ten_action'   => 'Tạo Mới Tài Khoản'],
            [ 'id' => 2, 'ten_action'   => 'Xem Danh Sách Tài Khoản'],
            [ 'id' => 3, 'ten_action'   => 'Đổi Mật Khẩu Tài Khoản'],
            [ 'id' => 4, 'ten_action'   => 'Cập Nhật Thông Tin Tài Khoản'],
            [ 'id' => 5, 'ten_action'   => 'Xóa Tài Khoản'],
            [ 'id' => 6, 'ten_action'   => 'View Tài Khoản'],
            [ 'id' => 7, 'ten_action'   => 'View Quyền'],
            [ 'id' => 8, 'ten_action'   => 'Xem Danh Sách Quyền'],
            [ 'id' => 9, 'ten_action'   => 'Tạo Mới Quyền'],
            [ 'id' => 10, 'ten_action'  => 'Xóa Quyền'],
            [ 'id' => 11, 'ten_action'  => 'Cập Nhật Quyền'],
            [ 'id' => 12, 'ten_action'  => 'View Nhà Cung Cấp'],
            [ 'id' => 13, 'ten_action'  => 'Tạo Mới Nhà Cung Cấp'],
            [ 'id' => 14, 'ten_action'  => 'Xem Danh Sách Nhà Cung Cấp'],
            [ 'id' => 15, 'ten_action'  => 'Xóa Nhà Cung Cấp'],
            [ 'id' => 16, 'ten_action'  => 'Cập Nhật Nhà Cung Cấp'],
            [ 'id' => 17, 'ten_action'  => 'Đổi Trạng Thái Nhà Cung Cấp'],
            [ 'id' => 18, 'ten_action'  => 'Thêm Mới Nguyên Liệu'],
            [ 'id' => 19, 'ten_action'  => 'Cập Nhật Nguyên Liệu'],
            [ 'id' => 20, 'ten_action'  => 'Xóa Nguyên Liệu'],
            [ 'id' => 21, 'ten_action'  => 'Danh Sách Nguyên Liệu'],
            [ 'id' => 22, 'ten_action'  => 'Thêm Mới Món Ăn'],
            [ 'id' => 23, 'ten_action'  => 'Tạo Mới Món Ăn'],
            [ 'id' => 24, 'ten_action'  => 'Cập Nhật Món Ăn'],
            [ 'id' => 25, 'ten_action'  => 'Xóa Món Ăn'],
            [ 'id' => 26, 'ten_action'  => 'Danh Sách Món Ăn'],
            [ 'id' => 27, 'ten_action'  => 'Danh Sách Danh Mục Món Ăn'],
            [ 'id' => 28, 'ten_action'  => 'Thêm Mới Danh Mục Món Ăn'],
            [ 'id' => 29, 'ten_action'  => 'Cập Nhật Danh Mục Món Ăn'],
            [ 'id' => 30, 'ten_action'  => 'Xóa Danh Mục Món Ăn'],
            [ 'id' => 31, 'ten_action'  => 'Quản Lý Nhập Kho'],
            [ 'id' => 32, 'ten_action'  => 'Cập Nhật Nhập Kho'],
            [ 'id' => 33, 'ten_action'  => 'Nhập Kho'],
            [ 'id' => 34, 'ten_action'  => 'Quản Lý Hóa Đơn Nhập Kho'],
            [ 'id' => 35, 'ten_action'  => 'Thống Kê Hóa Đơn Nhập Kho'],
            [ 'id' => 38, 'ten_action'  => 'Mở Bàn Dịch Vụ'],
            [ 'id' => 39, 'ten_action'  => 'Thêm Món Dịch Vụ'],
            [ 'id' => 40, 'ten_action'  => 'Thanh Toán Dịch Vụ'],
            [ 'id' => 41, 'ten_action'  => 'Quản Lý Hóa Đơn Bán Hàng'],
            [ 'id' => 42, 'ten_action'  => 'Thống Kê Hóa Đơn Bán Hàng'],
            [ 'id' => 43, 'ten_action'  => 'Quản Lý Bàn'],
            [ 'id' => 44, 'ten_action'  => 'Thêm Mới Bàn'],
            [ 'id' => 45, 'ten_action'  => 'Cập Nhật Bàn'],
            [ 'id' => 46, 'ten_action'  => 'Xóa Bàn'],
            [ 'id' => 47, 'ten_action'  => 'Quản Lý Khu Vực'],
            [ 'id' => 48, 'ten_action'  => 'Thêm Mới Khu Vực'],
            [ 'id' => 49, 'ten_action'  => 'Cập Nhật Khu Vực'],
            [ 'id' => 50, 'ten_action'  => 'Xóa Khu Vực'],
            [ 'id' => 51, 'ten_action'  => 'Quản Lý Chuyên Mục Bài Viết'],
            [ 'id' => 52, 'ten_action'  => 'Thêm Mới Chuyên Mục Bài Viết'],
            [ 'id' => 53, 'ten_action'  => 'Cập Nhật Chuyên Mục Bài Viết'],
            [ 'id' => 54, 'ten_action'  => 'Xóa Chuyên Mục Bài Viết'],
            [ 'id' => 55, 'ten_action'  => 'Quản Lý Bài Viết'],
            [ 'id' => 56, 'ten_action'  => 'Thêm Mới Bài Viết'],
            [ 'id' => 57, 'ten_action'  => 'Cập Nhật Bài Viết'],
            [ 'id' => 58, 'ten_action'  => 'Xóa Bài Viết'],
            [ 'id' => 59, 'ten_action'  => 'Thêm Nguyên Liệu Nhập Kho'],
            [ 'id' => 60, 'ten_action'  => 'Xóa Nguyên Liệu Nhập Kho'],
            [ 'id' => 61, 'ten_action'  => 'Lấy Dữ Liệu Bàn Theo Khu Vực'],
            [ 'id' => 62, 'ten_action'  => 'Lấy Dữ Liệu Món Ăn Dịch Vụ'],
            [ 'id' => 63, 'ten_action'  => 'Cập Nhật Món Ăn Dịch Vụ'],
            [ 'id' => 64, 'ten_action'  => 'Xóa Món Ăn Dịch Vụ'],
            [ 'id' => 65, 'ten_action'  => 'Chi Tiết Bán Hàng Dịch Vụ'],
            [ 'id' => 66, 'ten_action'  => 'Chi Tiết Hóa Đơn Bán Hàng'],
            [ 'id' => 67, 'ten_action'  => 'Tìm Bàn'],
            [ 'id' => 68, 'ten_action'  => 'Tìm Khu Vực'],
            [ 'id' => 69, 'ten_action'  => 'Tìm Nguyên Liệu'],
            [ 'id' => 70, 'ten_action'  => 'Tìm Nhà Cung Cấp'],
            [ 'id' => 71, 'ten_action'  => 'Tìm Món'],
            [ 'id' => 72, 'ten_action'  => 'Tìm Chuyên Mục'],
            [ 'id' => 73, 'ten_action'  => 'Tìm Bài Viết'],
        ]);

    }
}
