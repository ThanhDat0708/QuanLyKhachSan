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

    protected $casts = [
        'ngay_dat_phong' => 'datetime',
        'ngay_nhan_phong' => 'datetime',
        'ngay_tra_phong' => 'datetime',
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

    public function suDungDichVus()
    {
        return $this->hasMany(SuDungDichVu::class, 'ma_dat_phong', 'ma_dat_phong');
    }

    public function hoaDon()
    {
        return $this->hasOne(HoaDon::class, 'ma_dat_phong', 'ma_dat_phong');
    }

    /**
     * Tính tổng tiền phòng dựa trên số ngày ở và giá phòng
     */
    public function tinhTongTienPhong()
    {
        if (!$this->ngay_nhan_phong || !$this->ngay_tra_phong || !$this->phong) {
            return 0;
        }

        $ngayNhan = \Carbon\Carbon::parse($this->ngay_nhan_phong);
        $ngayTra = \Carbon\Carbon::parse($this->ngay_tra_phong);
        $soNgay = $ngayNhan->diffInDays($ngayTra);
        
        // Nếu cùng ngày thì tính 1 ngày
        if ($soNgay == 0) {
            $soNgay = 1;
        }

        return $soNgay * $this->phong->gia_phong;
    }

    /**
     * Tính tổng tiền dịch vụ đã sử dụng
     */
    public function tinhTongTienDichVu()
    {
        return $this->suDungDichVus()->sum('thanh_tien');
    }
}
