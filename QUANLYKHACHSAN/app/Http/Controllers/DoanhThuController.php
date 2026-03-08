<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DoanhThuController extends Controller
{
    /**
     * Trang thống kê doanh thu
     */
    public function index(Request $request)
    {
        // Lọc theo loại: ngay, thang, nam
        $loai = $request->get('loai', 'ngay');
        $tuNgay = $request->get('tu_ngay');
        $denNgay = $request->get('den_ngay');
        $thang = $request->get('thang', Carbon::now()->month);
        $nam = $request->get('nam', Carbon::now()->year);

        // Danh sách năm có hóa đơn
        $danhSachNam = HoaDon::selectRaw('YEAR(ngay_lap_hoa_don) as nam')
            ->distinct()
            ->orderBy('nam', 'desc')
            ->pluck('nam');

        if ($danhSachNam->isEmpty()) {
            $danhSachNam = collect([Carbon::now()->year]);
        }

        $doanhThu = collect();
        $tongDoanhThu = 0;
        $tongTienPhong = 0;
        $tongTienDichVu = 0;

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

        } elseif ($loai === 'nam') {
            $doanhThu = HoaDon::selectRaw('YEAR(ngay_lap_hoa_don) as nam,
                    COUNT(*) as so_hoa_don,
                    SUM(tong_tien_phong) as tien_phong,
                    SUM(tong_tien_dich_vu) as tien_dich_vu,
                    SUM(tong_tien_thanh_toan) as tong_tien')
                ->groupByRaw('YEAR(ngay_lap_hoa_don)')
                ->orderByRaw('YEAR(ngay_lap_hoa_don) DESC')
                ->get();
        }

        $tongTienPhong = $doanhThu->sum('tien_phong');
        $tongTienDichVu = $doanhThu->sum('tien_dich_vu');
        $tongDoanhThu = $doanhThu->sum('tong_tien');

        return view('admin.doanhthu.index', compact(
            'doanhThu', 'loai', 'tuNgay', 'denNgay', 'thang', 'nam',
            'danhSachNam', 'tongDoanhThu', 'tongTienPhong', 'tongTienDichVu'
        ));
    }
}
