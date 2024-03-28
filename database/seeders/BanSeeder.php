<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bans')->delete();
        DB::table('bans')->truncate();

        DB::table('bans')->insert([
            [
                'ten_ban'       => 'A01',
                'slug_ban'      => 'a01',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A02',
                'slug_ban'      => 'a02',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A03',
                'slug_ban'      => 'a03',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A04',
                'slug_ban'      => 'a04',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A05',
                'slug_ban'      => 'a05',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A06',
                'slug_ban'      => 'a06',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'A07',
                'slug_ban'      => 'a07',
                'id_khu_vuc'    =>  1,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'B02',
                'slug_ban'      => 'b02',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'B03',
                'slug_ban'      => 'b03',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'B04',
                'slug_ban'      => 'b04',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'B05',
                'slug_ban'      => 'b05',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'B06',
                'slug_ban'      => 'b07',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C01',
                'slug_ban'      => 'c01',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C02',
                'slug_ban'      => 'c02',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C03',
                'slug_ban'      => 'c03',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C04',
                'slug_ban'      => 'c04',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C05',
                'slug_ban'      => 'c05',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C06',
                'slug_ban'      => 'c06',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'C07',
                'slug_ban'      => 'c07',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D01',
                'slug_ban'      => 'd01',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D02',
                'slug_ban'      => 'd02',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D03',
                'slug_ban'      => 'd03',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D04',
                'slug_ban'      => 'd04',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D05',
                'slug_ban'      => 'd05',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D06',
                'slug_ban'      => 'd06',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'D07',
                'slug_ban'      => 'd07',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E01',
                'slug_ban'      => 'e01',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E02',
                'slug_ban'      => 'e02',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E03',
                'slug_ban'      => 'e03',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E04',
                'slug_ban'      => 'e04',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E05',
                'slug_ban'      => 'e05',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E06',
                'slug_ban'      => 'e06',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'E07',
                'slug_ban'      => 'e07',
                'id_khu_vuc'    =>  3,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F01',
                'slug_ban'      => 'f01',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F02',
                'slug_ban'      => 'f02',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F03',
                'slug_ban'      => 'f03',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F04',
                'slug_ban'      => 'f04',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F05',
                'slug_ban'      => 'f05',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F06',
                'slug_ban'      => 'f06',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_ban'       => 'F07',
                'slug_ban'      => 'f07',
                'id_khu_vuc'    =>  4,
                'tinh_trang'    => random_int(0, 1),
            ],
        ]);
    }
}
