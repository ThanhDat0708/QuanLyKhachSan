<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('trang_thai_dat_phongs')->insert([
            'ten_trang_thai_dat_phong' => 'Đã Hủy',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('trang_thai_dat_phongs')
            ->where('ten_trang_thai_dat_phong', 'Đã Hủy')
            ->delete();
    }
};
