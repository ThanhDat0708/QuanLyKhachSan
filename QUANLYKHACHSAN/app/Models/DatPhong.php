<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatPhong extends Model
{
    use HasFactory;

    protected $table = 'dat_phongs';
    protected $primaryKey = 'ma_dat_phong';

    protected $fillable = [
        'ma_khach_hang',
        'ma_phong',
        'ma_trang_thai_dat_phong',
        'ngay_dat_phong',
        'ngay_nhan_phong',
        'ngay_tra_phong',
    ];
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'ma_khach_hang', 'ma_khach_hang');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'ma_phong', 'ma_phong');
    }
    public function trangThaiDatPhong()
    {
        return $this->belongsTo(TrangThaiDatPhong::class, 'ma_trang_thai_dat_phong', 'ma_trang_thai_dat_phong');
    }
}
