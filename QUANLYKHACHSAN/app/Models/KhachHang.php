<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hangs';
    protected $primaryKey = 'ma_khach_hang';

    protected $fillable = [
        'ho_ten',
        'ngay_sinh',
        'gioi_tinh',
        'so_dien_thoai',
        'dia_chi',
        'email',
        'cccd',
    ];

    // Relationship: 1 khách hàng có nhiều đặt phòng
    public function datPhongs()
    {
        return $this->hasMany(DatPhong::class, 'ma_khach_hang', 'ma_khach_hang');
    }
}
