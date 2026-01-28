<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $table = 'phongs';
    protected $primaryKey = 'ma_phong';
    protected $fillable = [
        'ten_phong',
        'anh_phong',
        'so_luong_giuong',
        'gia_phong',
        'mo_ta',
        'ma_loai_phong',
        'ma_trang_thai',
    ];

    public function loaiPhong()
    {
        return $this->belongsTo(LoaiPhong::class, 'ma_loai_phong', 'ma_loai_phong');
    }

    public function trangThaiPhong()
    {
        return $this->belongsTo(TrangThaiPhong::class, 'ma_trang_thai', 'ma_trang_thai');
    }
}
