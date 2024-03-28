<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonAn extends Model
{
    use HasFactory;
    protected $table = 'mon_ans';

    protected $fillable = [
        'ten_mon',
        'slug_mon',
        'hinh_anh',
        'gia_ban',
        'tinh_trang',
        'id_danh_muc',
    ];
}
