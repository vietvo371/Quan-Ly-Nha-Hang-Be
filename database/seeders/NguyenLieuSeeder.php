<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NguyenLieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nguyen_lieus')->delete();
        DB::table('nguyen_lieus')->truncate();
        DB::table('nguyen_lieus')->insert([
            [
                'ten_nguyen_lieu' => 'Muốii ăn',
                'slug_nguyen_lieu' => 'muoi-an',
                'so_luong' => '10',
                'gia' => '20000',
                'dvt' => 'kg',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Bột Ngọt',
                'slug_nguyen_lieu' => 'bot-ngot',
                'so_luong' => '10',
                'gia' => '15000',
                'dvt' => 'kg',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Dầu Ăn',
                'slug_nguyen_lieu' => 'dau-an',
                'so_luong' => '20',
                'gia' => '200000',
                'dvt' => 'lit',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Hạt Nêm',
                'slug_nguyen_lieu' => 'hat-nem',
                'so_luong' => '20',
                'gia' => '12000',
                'dvt' => 'kg',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Ớt',
                'slug_nguyen_lieu' => 'ot',
                'so_luong' => '20',
                'gia' => '20000',
                'dvt' => 'kg',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Sting',
                'slug_nguyen_lieu' => 'sting',
                'so_luong' => '10',
                'gia' => '200000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Bia Sai Gon',
                'slug_nguyen_lieu' => 'bia-sai-gon',
                'so_luong' => '50',
                'gia' => '450000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Bia Tiger',
                'slug_nguyen_lieu' => 'bia-tiger',
                'so_luong' => '50',
                'gia' => '500000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Bia Huda',
                'slug_nguyen_lieu' => 'bia-huda',
                'so_luong' => '50',
                'gia' => '400000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Pessi',
                'slug_nguyen_lieu' => 'pessi',
                'so_luong' => '20',
                'gia' => '300000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => '7 Up',
                'slug_nguyen_lieu' => '7-up',
                'so_luong' => '30',
                'gia' => '300000',
                'dvt' => 'thung',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Giấy Ăn',
                'slug_nguyen_lieu' => 'giay-an',
                'so_luong' => '100',
                'gia' => '10000',
                'dvt' => 'cuộn',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Đũa',
                'slug_nguyen_lieu' => 'dua',
                'so_luong' => '200',
                'gia' => '12000',
                'dvt' => 'chiec',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Muỗng',
                'slug_nguyen_lieu' => 'muong',
                'so_luong' => '100',
                'gia' => '20000',
                'dvt' => 'chiec',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Vá',
                'slug_nguyen_lieu' => 'va',
                'so_luong' => '50',
                'gia' => '30000',
                'dvt' => 'chiec',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Màng Bọc Thực Phẩm',
                'slug_nguyen_lieu' => 'mang-boc-thuc-pham',
                'so_luong' => '100',
                'gia' => '300000',
                'dvt' => 'cuộn',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Chảo',
                'slug_nguyen_lieu' => 'chao',
                'so_luong' => '20',
                'gia' => '100000',
                'dvt' => 'chiếc',
                'tinh_trang' => '1'
            ],
            [
                'ten_nguyen_lieu' => 'Nước Rửa Chén',
                'slug_nguyen_lieu' => 'nuoc-rua-chen',
                'so_luong' => '100',
                'gia' => '600000',
                'dvt' => 'lit',
                'tinh_trang' => '1'
            ],

        ]);;
    }
}
