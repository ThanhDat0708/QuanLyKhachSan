<?php

namespace App\Http\Controllers;
use App\Models\HoaDon;
use App\Models\DatPhong;
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
        $datphongs = DatPhong::with(['khachHang', 'phong'])->get();
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

        // Lấy thông tin đặt phòng với quan hệ cần thiết
        $datPhong = DatPhong::with(['phong', 'suDungDichVus'])
            ->find($request->ma_dat_phong);

        if (!$datPhong) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy thông tin đặt phòng.');
        }

        $hoadon = new HoaDon();
        $hoadon->ma_dat_phong = $request->ma_dat_phong;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hoadon = HoaDon::with(['datPhong'])->findOrFail($id);
        $datphongs = DatPhong::with(['khachHang', 'phong'])->get();
        return view('admin.hoadon.edit')
        ->with('hoadon', $hoadon)
        ->with('datphongs', $datphongs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ma_dat_phong' => 'required|exists:dat_phongs,ma_dat_phong',
        ];
        $rules_messages = [
            'ma_dat_phong.required' => 'Mã đặt phòng không được để trống.',
            'ma_dat_phong.exists' => 'Mã đặt phòng không tồn tại.',
        ];
        $request->validate($rules, $rules_messages);

        // Lấy thông tin đặt phòng với quan hệ cần thiết
        $datPhong = DatPhong::with(['phong', 'suDungDichVus'])
            ->find($request->ma_dat_phong);

        if (!$datPhong) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy thông tin đặt phòng.');
        }

        $hoadon = HoaDon::findOrFail($id);
        $hoadon->ma_dat_phong = $request->ma_dat_phong;

        // Tính toán lại tổng tiền phòng, tổng tiền dịch vụ và tổng tiền thanh toán
        $hoadon->tong_tien_phong = $datPhong->tinhTongTienPhong();
        $hoadon->tong_tien_dich_vu = $datPhong->tinhTongTienDichVu();
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
