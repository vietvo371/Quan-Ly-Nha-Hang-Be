<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chi_tiet_hoa_don_ban_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_hoa_don');
            $table->integer('id_mon_an');
            $table->integer('so_luong');
            $table->integer('don_gia');
            $table->integer('thanh_tien');
            $table->integer('phan_tram_giam')->default(0);
            $table->integer('is_done')->default(0);
            $table->string('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hoa_don_ban_hangs');
    }
};
