<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiPhong extends Model
{
    use HasFactory;
    protected $table = 'loai_phongs';
    protected $primaryKey = 'ma_loai_phong';
    protected $fillable = [
        'ten_loai_phong'
    ];
}
