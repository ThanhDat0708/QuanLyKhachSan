<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrangThaiDatPhong extends Model
{
    use HasFactory;

    protected $table = 'trang_thai_dat_phongs';
    protected $primaryKey = 'ma_trang_thai_dat_phong';

    protected $fillable = [
        'ten_trang_thai_dat_phong',
    ];
}
