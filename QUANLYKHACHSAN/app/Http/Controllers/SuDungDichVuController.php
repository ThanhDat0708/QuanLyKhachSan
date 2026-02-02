<?php

namespace App\Http\Controllers;
use App\Models\SuDungDichVu;
use App\Models\DichVu;
use App\Models\DatPhong;
use Illuminate\Http\Request;

class SuDungDichVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sudungdichvus = SuDungDichVu::with(['dichVu', 'datPhong'])
            ->orderBy('ma_sd_dich_vu', 'desc')
            ->paginate(6);
        return view('admin.sudungdichvu.index')
        ->with('sudungdichvus', $sudungdichvus);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sudungdichvus = SuDungDichVu::all();
        $dichvus = DichVu::all();
        $datphongs = DatPhong::all();
        return view('admin.sudungdichvu.create')
        ->with('dichvus', $dichvus)
        ->with('datphongs', $datphongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ma_dat_phong' => 'required|exists:dat_phongs,ma_dat_phong',
            'ma_dich_vu' => 'required|exists:dich_vus,ma_dich_vu',
            'so_luong' => 'required|integer|min:1',
            'don_gia' => 'required|numeric|min:0',
            'ngay_su_dung' => 'required|date',
        ];
        $rules_messages = [
            'ma_dat_phong.required' => 'Mã đặt phòng không được để trống.',
            'ma_dat_phong.exists' => 'Mã đặt phòng không tồn tại.',
            'ma_dich_vu.required' => 'Mã dịch vụ không được để trống.',
            'ma_dich_vu.exists' => 'Mã dịch vụ không tồn tại.',
            'so_luong.required' => 'Số lượng không được để trống.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'don_gia.required' => 'Đơn giá không được để trống.',
            'don_gia.numeric' => 'Đơn giá phải là số.',
            'don_gia.min' => 'Đơn giá phải lớn hơn hoặc bằng 0.',
            'ngay_su_dung.required' => 'Ngày sử dụng không được để trống.',
            'ngay_su_dung.date' => 'Ngày sử dụng không đúng định dạng ngày tháng.',
        ];
        $request->validate($rules, $rules_messages);
        $sudungdichvu = new SuDungDichVu();
        $sudungdichvu->ma_dat_phong = $request->ma_dat_phong;
        $sudungdichvu->ma_dich_vu = $request->ma_dich_vu;
        $sudungdichvu->so_luong = $request->so_luong;
        $sudungdichvu->don_gia = $request->don_gia;
        $sudungdichvu->ngay_su_dung = $request->ngay_su_dung;
        $sudungdichvu->save();

        return redirect()->route('admin.sudungdichvu.index')
        ->with('success', 'Thêm sử dụng dịch vụ thành công.');

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
        $sudungdichvu = SuDungDichVu::findOrFail($id);
        $dichvus = DichVu::all();
        $datphongs = DatPhong::all();
        return view('admin.sudungdichvu.edit')
        ->with('sudungdichvu', $sudungdichvu)
        ->with('dichvus', $dichvus)
        ->with('datphongs', $datphongs);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ma_dat_phong' => 'required|exists:dat_phongs,ma_dat_phong',
            'ma_dich_vu' => 'required|exists:dich_vus,ma_dich_vu',
            'so_luong' => 'required|integer|min:1',
            'don_gia' => 'required|numeric|min:0',
            'ngay_su_dung' => 'required|date',
        ];
        $rules_messages = [
            'ma_dat_phong.required' => 'Mã đặt phòng không được để trống.',
            'ma_dat_phong.exists' => 'Mã đặt phòng không tồn tại.',
            'ma_dich_vu.required' => 'Mã dịch vụ không được để trống.',
            'ma_dich_vu.exists' => 'Mã dịch vụ không tồn tại.',
            'so_luong.required' => 'Số lượng không được để trống.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'don_gia.required' => 'Đơn giá không được để trống.',
            'don_gia.numeric' => 'Đơn giá phải là số.',
            'don_gia.min' => 'Đơn giá phải lớn hơn hoặc bằng 0.',
            'ngay_su_dung.required' => 'Ngày sử dụng không được để trống.',
            'ngay_su_dung.date' => 'Ngày sử dụng không đúng định dạng ngày tháng.',
        ];
        $request->validate($rules, $rules_messages);
        $sudungdichvu = SuDungDichVu::findOrFail($id);
        $sudungdichvu->ma_dat_phong = $request->ma_dat_phong;
        $sudungdichvu->ma_dich_vu = $request->ma_dich_vu;
        $sudungdichvu->so_luong = $request->so_luong;
        $sudungdichvu->don_gia = $request->don_gia;
        $sudungdichvu->ngay_su_dung = $request->ngay_su_dung;
        $sudungdichvu->save();

        return redirect()->route('admin.sudungdichvu.index')
        ->with('success', 'Cập nhật sử dụng dịch vụ thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sudungdichvu = SuDungDichVu::findOrFail($id);
        $sudungdichvu->delete();

        return redirect()->route('admin.sudungdichvu.index')
        ->with('success', 'Xóa sử dụng dịch vụ thành công.');
    }
}
