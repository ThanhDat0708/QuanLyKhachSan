<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuDungDichVu extends Model
{
    use HasFactory;

    protected $table = 'su_dung_dich_vus';
    protected $primaryKey = 'ma_sd_dich_vu';
    protected $fillable = [
        'ma_dat_phong',
        'ma_dich_vu',
        'so_luong',
        'don_gia',
        'ngay_su_dung',
    ];

    protected $casts = [
        'ngay_su_dung' => 'datetime',
    ];

    public function dichVu()
    {
        return $this->belongsTo(DichVu::class, 'ma_dich_vu', 'ma_dich_vu');
    }
    public function datPhong()
    {
        return $this->belongsTo(DatPhong::class, 'ma_dat_phong', 'ma_dat_phong');
    }
}
