<?php

namespace App\Http\Controllers;
use App\Models\HoaDon;
use App\Models\DatPhong;
use App\Models\DichVu;
use App\Models\KhachHang;
use App\Models\Phong;
use App\Models\SuDungDichVu;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoadons = HoaDon::with(['datPhong.khachHang', 'datPhong.phong'])
            ->orderBy('ma_hoa_don', 'desc')
            ->paginate(6);
        return view('admin.hoadon.index')
            ->with('hoadons', $hoadons);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Chỉ lấy đặt phòng chưa có hóa đơn
        $datphongs = DatPhong::with(['khachHang', 'phong'])
            ->doesntHave('hoaDon')
            ->get();
        return view('admin.hoadon.create')
            ->with('datphongs', $datphongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ma_dat_phong' => 'required|exists:dat_phongs,ma_dat_phong',
        ];
        $rules_messages = [
            'ma_dat_phong.required' => 'Mã đặt phòng không được để trống.',
            'ma_dat_phong.exists' => 'Mã đặt phòng không tồn tại.',
        ];
        $request->validate($rules, $rules_messages);

        // Kiểm tra đặt phòng đã có hóa đơn chưa
        $daCoHoaDon = HoaDon::where('ma_dat_phong', $request->ma_dat_phong)->exists();
        if ($daCoHoaDon) {
            return redirect()->back()
                ->with('error', 'Đặt phòng này đã có hóa đơn.');
        }

        // Lấy thông tin đặt phòng với quan hệ cần thiết
        $datPhong = DatPhong::with(['phong', 'suDungDichVus'])
            ->find($request->ma_dat_phong);

        if (!$datPhong) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy thông tin đặt phòng.');
        }

        $hoadon = new HoaDon();
        $hoadon->ma_dat_phong = $request->ma_dat_phong;
        $hoadon->ma_phong = $datPhong->ma_phong;

        // Tính toán tổng tiền phòng, tổng tiền dịch vụ và tổng tiền thanh toán
        $hoadon->tong_tien_phong = $datPhong->tinhTongTienPhong();
        $hoadon->tong_tien_dich_vu = $datPhong->tinhTongTienDichVu();
        $hoadon->tong_tien_thanh_toan = $hoadon->tong_tien_phong + $hoadon->tong_tien_dich_vu;

        $hoadon->ngay_lap_hoa_don = now();
        $hoadon->save();

        return redirect()->route('admin.hoadon.index')
            ->with('success', 'Hóa đơn đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hoadon = HoaDon::with([
            'datPhong.khachHang',
            'datPhong.phong.loaiPhong',
            'datPhong.trangThaiDatPhong',
            'datPhong.suDungDichVus.dichVu'
        ])->findOrFail($id);

        return view('admin.hoadon.show')
            ->with('hoadon', $hoadon);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hoadon = HoaDon::with([
            'datPhong.khachHang',
            'datPhong.phong',
            'datPhong.suDungDichVus.dichVu',
        ])->findOrFail($id);
        $datphongs = DatPhong::with(['khachHang', 'phong'])->get();
        $dichvus = DichVu::orderBy('ten_dich_vu')->get();
        return view('admin.hoadon.edit')
            ->with('hoadon', $hoadon)
            ->with('datphongs', $datphongs)
            ->with('dichvus', $dichvus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ma_dat_phong' => 'required|exists:dat_phongs,ma_dat_phong',
            'existing_services.*.so_luong' => 'nullable|integer|min:1',
            'new_services.*.ma_dich_vu' => 'nullable|exists:dich_vus,ma_dich_vu',
            'new_services.*.so_luong' => 'nullable|integer|min:1',
        ], [
            'ma_dat_phong.required' => 'Mã đặt phòng không được để trống.',
            'ma_dat_phong.exists' => 'Mã đặt phòng không tồn tại.',
            'existing_services.*.so_luong.min' => 'Số lượng dịch vụ phải ít nhất là 1.',
            'new_services.*.so_luong.min' => 'Số lượng dịch vụ mới phải ít nhất là 1.',
        ]);

        $hoadon = HoaDon::findOrFail($id);
        $hoadon->ma_dat_phong = $request->ma_dat_phong;

        // Cập nhật / xóa dịch vụ hiện có
        if ($request->has('existing_services')) {
            foreach ($request->existing_services as $maSdDichVu => $data) {
                $suDungDichVu = SuDungDichVu::find($maSdDichVu);
                if ($suDungDichVu) {
                    if (isset($data['delete']) && $data['delete'] == '1') {
                        $suDungDichVu->delete();
                    } elseif (!empty($data['so_luong'])) {
                        $suDungDichVu->so_luong = (int) $data['so_luong'];
                        $suDungDichVu->save();
                    }
                }
            }
        }

        // Thêm dịch vụ mới
        if ($request->has('new_services')) {
            foreach ($request->new_services as $newService) {
                if (!empty($newService['ma_dich_vu']) && !empty($newService['so_luong'])) {
                    $dichVu = DichVu::find($newService['ma_dich_vu']);
                    if ($dichVu) {
                        SuDungDichVu::create([
                            'ma_dat_phong' => $hoadon->ma_dat_phong,
                            'ma_dich_vu'   => $newService['ma_dich_vu'],
                            'so_luong'     => (int) $newService['so_luong'],
                            'don_gia'      => $dichVu->don_gia,
                            'ngay_su_dung' => now(),
                        ]);
                    }
                }
            }
        }

        // Tính lại tổng tiền
        $datPhong = DatPhong::with(['phong', 'suDungDichVus'])->find($hoadon->ma_dat_phong);
        if (!$datPhong) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin đặt phòng.');
        }

        $hoadon->ma_phong             = $datPhong->ma_phong;
        $hoadon->tong_tien_phong      = $datPhong->tinhTongTienPhong();
        $hoadon->tong_tien_dich_vu    = $datPhong->tinhTongTienDichVu();
        $hoadon->tong_tien_thanh_toan = $hoadon->tong_tien_phong + $hoadon->tong_tien_dich_vu;
        $hoadon->save();

        return redirect()->route('admin.hoadon.index')
            ->with('success', 'Cập nhật hóa đơn thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hoadon = HoaDon::findOrFail($id);
        $hoadon->delete();

        return redirect()->route('admin.hoadon.index')
            ->with('success', 'Xóa hóa đơn thành công.');
    }
}
