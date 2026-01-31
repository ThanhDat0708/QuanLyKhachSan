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
        Schema::create('dat_phongs', function (Blueprint $table) {
            $table->id('ma_dat_phong')->unique();
            $table->foreignId('ma_khach_hang')->constrained('khach_hangs', 'ma_khach_hang')->onDelete('cascade');
            $table->foreignId('ma_phong')->constrained('phongs', 'ma_phong')->onDelete('cascade');
            $table->foreignId('ma_trang_thai_dat_phong')->constrained('trang_thai_dat_phongs', 'ma_trang_thai_dat_phong')->onDelete('cascade');
            $table->date('ngay_dat_phong')->default(now());
            $table->date('ngay_nhan_phong')->nullable();
            $table->date('ngay_tra_phong')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_phongs');
    }
};
