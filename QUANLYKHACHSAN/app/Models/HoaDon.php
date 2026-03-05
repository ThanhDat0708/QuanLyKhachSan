<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'hoa_dons';
    protected $primaryKey = 'ma_hoa_don';
    protected $fillable = [
        'ma_phong',
        'ma_dat_phong',
        'tong_tien_phong',
        'tong_tien_dich_vu',
        'tong_tien_thanh_toan',
        'ngay_lap_hoa_don',
    ];
    protected $casts = [
        'ngay_lap_hoa_don' => 'datetime',
    ];
    public function datPhong()
    {
        return $this->belongsTo(DatPhong::class, 'ma_dat_phong', 'ma_dat_phong');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'ma_phong', 'ma_phong');
    }
}
