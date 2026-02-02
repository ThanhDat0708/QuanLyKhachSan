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
        Schema::create('su_dung_dich_vus', function (Blueprint $table) {
            $table->id('ma_sd_dich_vu')->unique();
            $table->foreignId('ma_dat_phong')->constrained('dat_phongs','ma_dat_phong')->onDelete('cascade');
            $table->foreignId('ma_dich_vu')->constrained('dich_vus','ma_dich_vu')->onDelete('cascade');
            $table->integer('so_luong')->default(1);
            $table->decimal('don_gia', 15, 2);
            $table->dateTime('ngay_su_dung')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('su_dung_dich_vus');
    }
};
