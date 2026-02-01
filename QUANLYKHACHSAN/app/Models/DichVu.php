<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;

    protected $table = 'dich_vus';
    protected $primaryKey = 'ma_dich_vu';
    protected $fillable = [
        'ten_dich_vu',
        'don_gia',
        'so_luong',
        'mo_ta',
    ];
}
