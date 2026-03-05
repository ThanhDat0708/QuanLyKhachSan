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
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id('ma_hoa_don')->unique();
            $table->foreignId('ma_phong')->constrained('phongs','ma_phong')->onDelete('cascade');
            $table->foreignId('ma_dat_phong')->constrained('dat_phongs','ma_dat_phong')->onDelete('cascade');
            $table->dateTime('ngay_lap_hoa_don')->default(now());
            $table->decimal('tong_tien_dich_vu', 15, 2)->default(0);
            $table->decimal('tong_tien_phong', 15, 2)->default(0);
            $table->decimal('tong_tien_thanh_toan', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
