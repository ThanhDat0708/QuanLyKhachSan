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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id('ma_khach_hang')->unique();
            $table->string('ho_ten', 200)->nullable();
            $table->string('gioi_tinh', 3)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('so_dien_thoai', 10)->nullable();
            $table->string('dia_chi', 200)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('cccd', 12)->nullable();
            $table->foreignId('ma_tai_khoan')->constrained('users', 'ma_tai_khoan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
