<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\DatPhong;
use App\Models\KhachHang;
use Carbon\Carbon;

class DoanhThuController extends Controller
{
    /**
     * Trang thống kê doanh thu
     */
    public function index(Request $request)
    {
        // Danh sách năm có hóa đơn
        $danhSachNam = HoaDon::selectRaw('YEAR(ngay_lap_hoa_don) as nam')
            ->distinct()
            ->orderBy('nam', 'desc')
            ->pluck('nam');

        if ($danhSachNam->isEmpty()) {
            $danhSachNam = collect([Carbon::now()->year]);
        }

        // Lọc theo loại: ngay, thang, nam
        $loai = $request->get('loai', 'ngay');
        $tuNgay = $request->get('tu_ngay');
        $denNgay = $request->get('den_ngay');
        $thang = (int) $request->get('thang', Carbon::now()->month);
        // Mặc định lấy năm mới nhất có dữ liệu để tránh rỗng khi năm hiện tại chưa có hóa đơn
        $namMacDinh = (int) $danhSachNam->first();
        $nam = (int) $request->get('nam', $namMacDinh);

        $doanhThu = collect();
        $tongDoanhThu = 0;
        $tongTienPhong = 0;
        $tongTienDichVu = 0;
        $baoCaoSoLuong = collect();
        $tongSoLuotDatPhong = 0;
        $tongSoPhongDuocDat = 0;
        $tongSoKhachHangDatPhong = 0;
        $tongKhachHangHeThong = KhachHang::count();

        $datPhongBaseQuery = DatPhong::query();

        if ($loai === 'ngay') {
            // Mặc định: tháng hiện tại
            if (!$tuNgay || !$denNgay) {
                $tuNgay = Carbon::create($nam, $thang, 1)->startOfMonth()->format('Y-m-d');
                $denNgay = Carbon::create($nam, $thang, 1)->endOfMonth()->format('Y-m-d');
            }

            $doanhThu = HoaDon::selectRaw('DATE(ngay_lap_hoa_don) as ngay,
                    COUNT(*) as so_hoa_don,
                    SUM(tong_tien_phong) as tien_phong,
                    SUM(tong_tien_dich_vu) as tien_dich_vu,
                    SUM(tong_tien_thanh_toan) as tong_tien')
                ->whereBetween('ngay_lap_hoa_don', [$tuNgay . ' 00:00:00', $denNgay . ' 23:59:59'])
                ->groupByRaw('DATE(ngay_lap_hoa_don)')
                ->orderByRaw('DATE(ngay_lap_hoa_don) DESC')
                ->get();

            $datPhongBaseQuery->whereBetween('ngay_dat_phong', [$tuNgay . ' 00:00:00', $denNgay . ' 23:59:59']);

            $baoCaoSoLuong = (clone $datPhongBaseQuery)
                ->selectRaw('DATE(ngay_dat_phong) as ngay,
                    COUNT(*) as so_luot_dat_phong,
                    COUNT(DISTINCT ma_phong) as so_phong_duoc_dat,
                    COUNT(DISTINCT ma_khach_hang) as so_khach_hang')
                ->groupByRaw('DATE(ngay_dat_phong)')
                ->orderByRaw('DATE(ngay_dat_phong) DESC')
                ->get();

        } elseif ($loai === 'thang') {
            $doanhThu = HoaDon::selectRaw('MONTH(ngay_lap_hoa_don) as thang,
                    YEAR(ngay_lap_hoa_don) as nam,
                    COUNT(*) as so_hoa_don,
                    SUM(tong_tien_phong) as tien_phong,
                    SUM(tong_tien_dich_vu) as tien_dich_vu,
                    SUM(tong_tien_thanh_toan) as tong_tien')
                ->whereYear('ngay_lap_hoa_don', $nam)
                ->groupByRaw('YEAR(ngay_lap_hoa_don), MONTH(ngay_lap_hoa_don)')
                ->orderByRaw('MONTH(ngay_lap_hoa_don) DESC')
                ->get();

            $datPhongBaseQuery->whereYear('ngay_dat_phong', $nam);

            $baoCaoSoLuong = (clone $datPhongBaseQuery)
                ->selectRaw('MONTH(ngay_dat_phong) as thang,
                    YEAR(ngay_dat_phong) as nam,
                    COUNT(*) as so_luot_dat_phong,
                    COUNT(DISTINCT ma_phong) as so_phong_duoc_dat,
                    COUNT(DISTINCT ma_khach_hang) as so_khach_hang')
                ->groupByRaw('YEAR(ngay_dat_phong), MONTH(ngay_dat_phong)')
                ->orderByRaw('MONTH(ngay_dat_phong) DESC')
                ->get();

        } elseif ($loai === 'nam') {
            $doanhThu = HoaDon::selectRaw('YEAR(ngay_lap_hoa_don) as nam,
                    COUNT(*) as so_hoa_don,
                    SUM(tong_tien_phong) as tien_phong,
                    SUM(tong_tien_dich_vu) as tien_dich_vu,
                    SUM(tong_tien_thanh_toan) as tong_tien')
                ->groupByRaw('YEAR(ngay_lap_hoa_don)')
                ->orderByRaw('YEAR(ngay_lap_hoa_don) DESC')
                ->get();

            $baoCaoSoLuong = (clone $datPhongBaseQuery)
                ->selectRaw('YEAR(ngay_dat_phong) as nam,
                    COUNT(*) as so_luot_dat_phong,
                    COUNT(DISTINCT ma_phong) as so_phong_duoc_dat,
                    COUNT(DISTINCT ma_khach_hang) as so_khach_hang')
                ->groupByRaw('YEAR(ngay_dat_phong)')
                ->orderByRaw('YEAR(ngay_dat_phong) DESC')
                ->get();
        }

        $tongTienPhong = $doanhThu->sum('tien_phong');
        $tongTienDichVu = $doanhThu->sum('tien_dich_vu');
        $tongDoanhThu = $doanhThu->sum('tong_tien');
        $tongSoLuotDatPhong = (clone $datPhongBaseQuery)->count();
        $tongSoPhongDuocDat = (clone $datPhongBaseQuery)->distinct('ma_phong')->count('ma_phong');
        $tongSoKhachHangDatPhong = (clone $datPhongBaseQuery)->distinct('ma_khach_hang')->count('ma_khach_hang');

        return view('Admin.DoanhThu.index', compact(
            'doanhThu', 'loai', 'tuNgay', 'denNgay', 'thang', 'nam',
            'danhSachNam', 'tongDoanhThu', 'tongTienPhong', 'tongTienDichVu',
            'baoCaoSoLuong', 'tongSoLuotDatPhong', 'tongSoPhongDuocDat',
            'tongSoKhachHangDatPhong', 'tongKhachHangHeThong'
        ));
    }
}
