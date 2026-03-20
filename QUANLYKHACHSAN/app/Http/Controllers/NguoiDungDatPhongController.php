<?php

namespace App\Http\Controllers;

use App\Models\DatPhong;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiPhong;
use App\Models\Phong;
use App\Models\TrangThaiDatPhong;
use App\Models\TrangThaiPhong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NguoiDungDatPhongController extends Controller
{
    /**
     * Danh sách phòng để đặt
     */
    public function danhSachPhong(Request $request)
    {
        $query = Phong::with(['loaiPhong', 'trangThaiPhong']);

        if ($request->filled('ma_loai_phong')) {
            $query->where('ma_loai_phong', $request->ma_loai_phong);
        }

        if ($request->filled('muc_gia')) {
            switch ($request->muc_gia) {
                case 'duoi_500000':
                    $query->where('gia_phong', '<', 500000);
                    break;
                case '500000_1000000':
                    $query->whereBetween('gia_phong', [500000, 1000000]);
                    break;
                case '1000000_2000000':
                    $query->whereBetween('gia_phong', [1000000, 2000000]);
                    break;
                case 'tren_2000000':
                    $query->where('gia_phong', '>', 2000000);
                    break;
            }
        }

        $phongs = $query->orderBy('ma_trang_thai')->orderBy('gia_phong')->get();
        $loaiPhongs = LoaiPhong::orderBy('ten_loai_phong')->get();
        $trangThaiTrong = TrangThaiPhong::where('ten_trang_thai', 'like', '%trống%')
            ->orWhere('ten_trang_thai', 'like', '%trong%')
            ->first();
        $maTrangThaiTrong = $trangThaiTrong?->ma_trang_thai;

        $soPhongTrong = $maTrangThaiTrong
            ? $phongs->where('ma_trang_thai', $maTrangThaiTrong)->count()
            : 0;
        $soPhongDaDat = $phongs->count() - $soPhongTrong;

        return view('NguoiDung.datphong.danhsachphong', compact('phongs', 'loaiPhongs', 'soPhongTrong', 'soPhongDaDat', 'maTrangThaiTrong'));
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

        // Lấy trạng thái "Chưa Xác Nhận"
        $trangThai = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%chưa%')->first();

        if (!$trangThai) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy trạng thái "Chưa Xác Nhận" trong hệ thống. Vui lòng liên hệ quản trị viên.');
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

        return redirect()->route('nguoidung.datphong.thanhcong', ['id' => $datPhong->ma_dat_phong]);
    }

    public function thanhCong($id)
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;

        if (!$khachhang) {
            return redirect()->route('nguoidung.thongtin.edit')
                ->with('error', 'Vui lòng cập nhật thông tin cá nhân.');
        }

        $datPhong = DatPhong::with(['phong.loaiPhong', 'trangThaiDatPhong'])
            ->where('ma_dat_phong', $id)
            ->where('ma_khach_hang', $khachhang->ma_khach_hang)
            ->firstOrFail();

        return view('NguoiDung.datphong.thanhcong', compact('datPhong'));
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

    /**
     * Hủy đặt phòng
     */
    public function huyDatPhong($id)
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;

        if (!$khachhang) {
            return redirect()->route('nguoidung.datphong.lichsu')
                ->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $datphong = DatPhong::where('ma_khach_hang', $khachhang->ma_khach_hang)
            ->findOrFail($id);

        // Chỉ cho phép hủy khi trạng thái là "Chưa Xác Nhận"
        $trangThaiHienTai = mb_strtolower($datphong->trangThaiDatPhong->ten_trang_thai_dat_phong ?? '');
        if (!str_contains($trangThaiHienTai, 'chưa')) {
            return redirect()->route('nguoidung.datphong.lichsu')
                ->with('error', 'Chỉ có thể hủy đặt phòng khi đang ở trạng thái Chưa Xác Nhận.');
        }

        // Lấy trạng thái "Hủy"
        $trangThaiHuy = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%hủy%')
            ->orWhere('ten_trang_thai_dat_phong', 'like', '%Hủy%')
            ->first();

        if (!$trangThaiHuy) {
            return redirect()->route('nguoidung.datphong.lichsu')
                ->with('error', 'Không tìm thấy trạng thái hủy trong hệ thống.');
        }

        // Cập nhật trạng thái đặt phòng sang "Hủy"
        $datphong->ma_trang_thai_dat_phong = $trangThaiHuy->ma_trang_thai_dat_phong;
        $datphong->save();

        // Khi khách hủy thành công, chuyển phòng về trạng thái "Trống"
        $trangThaiTrong = \App\Models\TrangThaiPhong::where('ten_trang_thai', 'like', '%trống%')
            ->orWhere('ten_trang_thai', 'like', '%Trống%')
            ->first();

        if ($trangThaiTrong) {
            $phong = Phong::find($datphong->ma_phong);

            if ($phong) {
                $phong->ma_trang_thai = $trangThaiTrong->ma_trang_thai;
                $phong->save();
            }
        }

        return redirect()->route('nguoidung.datphong.lichsu')
            ->with('success', 'Hủy đặt phòng thành công!');
    }
}
