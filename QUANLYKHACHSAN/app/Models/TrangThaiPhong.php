<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrangThaiPhong extends Model
{
    use HasFactory;
    protected $table = 'trang_thai_phongs';
    protected $primaryKey = 'ma_trang_thai';
    protected $fillable = [
        'ten_trang_thai'
    ];
}
