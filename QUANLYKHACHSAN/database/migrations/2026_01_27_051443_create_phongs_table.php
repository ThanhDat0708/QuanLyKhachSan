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
        Schema::create('phongs', function (Blueprint $table) {
            $table->id('ma_phong')->unique();
            $table->string('ten_phong', 200)->nullable();
            $table->string('anh_phong', 200)->nullable();    
            $table->integer('so_luong_giuong')->nullable();
            $table->decimal('gia_phong', 15, 2)->nullable();
            $table->string('mo_ta', 200)->nullable();  
            $table->foreignId('ma_loai_phong')->nullable()->constrained('loai_phongs', 'ma_loai_phong');
            $table->foreignId('ma_trang_thai')->nullable()->constrained('trang_thai_phongs', 'ma_trang_thai');
            $table->timestamps();
        });
    }
    //  * Reverse the migrations.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('phongs');
    }
};
