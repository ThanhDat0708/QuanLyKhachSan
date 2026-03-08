<?php

namespace App\Http\Controllers;

use App\Models\DatPhong;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\Phong;
use App\Models\TrangThaiDatPhong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NguoiDungDatPhongController extends Controller
{
    /**
     * Danh sách phòng trống để đặt
     */
    public function danhSachPhong()
    {
        $phongs = Phong::with(['loaiPhong', 'trangThaiPhong'])
            ->whereHas('trangThaiPhong', function ($q) {
                $q->where('ten_trang_thai', 'like', '%trống%')
                  ->orWhere('ten_trang_thai', 'like', '%Trống%')
                  ->orWhere('ten_trang_thai', 'like', '%trong%');
            })
            ->get();

        return view('NguoiDung.datphong.danhsachphong', compact('phongs'));
    }

    /**
     * Form đặt phòng cho 1 phòng cụ thể
     */
    public function datPhong($id)
    {
        $phong = Phong::with(['loaiPhong', 'trangThaiPhong'])->findOrFail($id);
        return view('NguoiDung.datphong.datphong', compact('phong'));
    }

    /**
     * Lưu đặt phòng
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_phong' => 'required|exists:phongs,ma_phong',
            'ngay_nhan_phong' => 'required|date|after_or_equal:today',
            'ngay_tra_phong' => 'required|date|after:ngay_nhan_phong',
        ], [
            'ma_phong.required' => 'Vui lòng chọn phòng.',
            'ngay_nhan_phong.required' => 'Vui lòng chọn ngày nhận phòng.',
            'ngay_nhan_phong.after_or_equal' => 'Ngày nhận phòng phải từ hôm nay trở đi.',
            'ngay_tra_phong.required' => 'Vui lòng chọn ngày trả phòng.',
            'ngay_tra_phong.after' => 'Ngày trả phòng phải sau ngày nhận phòng.',
        ]);

        $user = Auth::user();
        $khachhang = $user->khachHang;

        if (!$khachhang) {
            return redirect()->route('nguoidung.thongtin.edit')
                ->with('error', 'Vui lòng cập nhật thông tin cá nhân trước khi đặt phòng.');
        }

        // Lấy trạng thái "Chờ xác nhận" (hoặc trạng thái đầu tiên)
        $trangThai = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%chờ%')
            ->orWhere('ten_trang_thai_dat_phong', 'like', '%Chờ%')
            ->first();

        if (!$trangThai) {
            $trangThai = TrangThaiDatPhong::first();
        }

        // Kiểm tra phòng có bị trùng lịch không (loại trừ đặt phòng đã hủy/hoàn tiền)
        $trangThaiHuy = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%hủy%')
            ->orWhere('ten_trang_thai_dat_phong', 'like', '%hoàn%')
            ->pluck('ma_trang_thai_dat_phong')
            ->toArray();

        $trungLich = DatPhong::where('ma_phong', $request->ma_phong)
            ->whereNotIn('ma_trang_thai_dat_phong', $trangThaiHuy)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Ngày nhận mới nằm trong khoảng đặt phòng cũ
                    $q->where('ngay_nhan_phong', '<', $request->ngay_tra_phong)
                      ->where('ngay_tra_phong', '>', $request->ngay_nhan_phong);
                });
            })
            ->exists();

        if ($trungLich) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Phòng này đã có người đặt trong khoảng thời gian bạn chọn. Vui lòng chọn ngày khác hoặc phòng khác.');
        }

        $datPhong = DatPhong::create([
            'ma_khach_hang' => $khachhang->ma_khach_hang,
            'ma_phong' => $request->ma_phong,
            'ma_trang_thai_dat_phong' => $trangThai ? $trangThai->ma_trang_thai_dat_phong : 1,
            'ngay_dat_phong' => now(),
            'ngay_nhan_phong' => $request->ngay_nhan_phong,
            'ngay_tra_phong' => $request->ngay_tra_phong,
        ]);

        // Cập nhật trạng thái phòng sang "Hết Phòng"
        $trangThaiHetPhong = \App\Models\TrangThaiPhong::where('ten_trang_thai', 'like', '%hết%')
            ->orWhere('ten_trang_thai', 'like', '%Hết%')
            ->first();

        if ($trangThaiHetPhong) {
            $phong = Phong::find($request->ma_phong);
            $phong->ma_trang_thai = $trangThaiHetPhong->ma_trang_thai;
            $phong->save();
        }

        return redirect()->route('nguoidung.datphong.lichsu')
            ->with('success', 'Đặt phòng thành công! Vui lòng chờ xác nhận từ khách sạn.');
    }

    /**
     * Lịch sử đặt phòng của người dùng
     */
    public function lichSu()
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;

        $datphongs = collect();

        if ($khachhang) {
            $datphongs = DatPhong::with(['phong.loaiPhong', 'trangThaiDatPhong', 'hoaDon'])
                ->where('ma_khach_hang', $khachhang->ma_khach_hang)
                ->orderBy('ma_dat_phong', 'desc')
                ->paginate(10);
        }

        return view('NguoiDung.datphong.lichsu', compact('datphongs', 'khachhang'));
    }

    /**
     * Chi tiết đặt phòng
     */
    public function chiTiet($id)
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;

        if (!$khachhang) {
            return redirect()->route('nguoidung.datphong.lichsu')
                ->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $datphong = DatPhong::with([
            'phong.loaiPhong',
            'trangThaiDatPhong',
            'suDungDichVus.dichVu',
            'hoaDon'
        ])
        ->where('ma_khach_hang', $khachhang->ma_khach_hang)
        ->findOrFail($id);

        return view('NguoiDung.datphong.chitiet', compact('datphong'));
    }
}
