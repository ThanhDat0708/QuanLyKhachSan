<?php

namespace App\Http\Controllers;
use App\Models\DatPhong;
use App\Models\KhachHang;
use App\Models\Phong;
use App\Models\TrangThaiDatPhong;
use Illuminate\Http\Request;

class DatPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datphongs = DatPhong::with(['khachHang', 'phong', 'trangThaiDatPhong'])
            ->orderBy('ma_dat_phong', 'desc')
            ->paginate(6);
        return view('admin.datphong.index')
        ->with('datphongs', $datphongs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khachhangs = KhachHang::all();
        $phongs = Phong::all();
        $trangthaidatphongs = TrangThaiDatPhong::all();
        return view('admin.datphong.create')
        ->with('khachhangs', $khachhangs)
        ->with('phongs', $phongs)
        ->with('trangthaidatphongs', $trangthaidatphongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ma_khach_hang' => 'required|exists:khach_hangs,ma_khach_hang',
            'ma_phong' => 'required|exists:phongs,ma_phong',
            'ma_trang_thai_dat_phong' => 'required|exists:trang_thai_dat_phongs,ma_trang_thai_dat_phong',
            'ngay_dat_phong' => 'required|date',
            'ngay_nhan_phong' => 'required|date|after_or_equal:ngay_dat_phong',
            'ngay_tra_phong' => 'required|date|after_or_equal:ngay_nhan_phong',
        ];
        $rules_messages = [
            'ma_khach_hang.required' => 'Mã khách hàng không được để trống.',
            'ma_khach_hang.exists' => 'Mã khách hàng không tồn tại.',
            'ma_phong.required' => 'Mã phòng không được để trống.',
            'ma_phong.exists' => 'Mã phòng không tồn tại.',
            'ma_trang_thai_dat_phong.required' => 'Mã trạng thái đặt phòng không được để trống.',
            'ma_trang_thai_dat_phong.exists' => 'Mã trạng thái đặt phòng không tồn tại.',
            'ngay_dat_phong.required' => 'Ngày đặt phòng không được để trống.',
            'ngay_dat_phong.date' => 'Ngày đặt phòng không đúng định dạng ngày tháng.',
            'ngay_nhan_phong.required' => 'Ngày nhận phòng không được để trống.',
            'ngay_nhan_phong.date' => 'Ngày nhận phòng không đúng định dạng ngày tháng.',
            'ngay_nhan_phong.after_or_equal' => 'Ngày nhận phòng phải sau hoặc bằng ngày đặt phòng.',
            'ngay_tra_phong.required' => 'Ngày trả phòng không được để trống.',
            'ngay_tra_phong.date' => 'Ngày trả phòng không đúng định dạng ngày tháng.',
            'ngay_tra_phong.after_or_equal' => 'Ngày trả phòng phải sau hoặc bằng ngày nhận phòng.',
        ];
        $request->validate($rules, $rules_messages);
        
        // Kiểm tra phòng có bị trùng lịch không (loại trừ đặt phòng đã hủy/hoàn tiền)
        $trangThaiHuy = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%hủy%')
            ->orWhere('ten_trang_thai_dat_phong', 'like', '%hoàn%')
            ->pluck('ma_trang_thai_dat_phong')
            ->toArray();

        $checkPhong = DatPhong::where('ma_phong', $request->ma_phong)
            ->whereNotIn('ma_trang_thai_dat_phong', $trangThaiHuy)
            ->where(function ($query) use ($request) {
                $query->where('ngay_nhan_phong', '<', $request->ngay_tra_phong)
                      ->where('ngay_tra_phong', '>', $request->ngay_nhan_phong);
            })
            ->exists();
        
        if ($checkPhong) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Phòng này đã có người đặt trong khoảng thời gian này. Vui lòng chọn phòng khác hoặc thời gian khác.');
        }
        
        $data = $request->only([
            'ma_khach_hang',
            'ma_phong',
            'ma_trang_thai_dat_phong',
            'ngay_dat_phong',
            'ngay_nhan_phong',
            'ngay_tra_phong',
        ]);
        
        DatPhong::create($data);
        return redirect()->route('admin.datphong.index')
        ->with('success', 'Đặt phòng đã được tạo thành công.');
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
        $datphong = DatPhong::findOrFail($id);
        $khachhangs = KhachHang::all();
        $phongs = Phong::all();
        $trangthaidatphongs = TrangThaiDatPhong::all();
        return view('admin.datphong.edit')
        ->with('datphong', $datphong)
        ->with('khachhangs', $khachhangs)
        ->with('phongs', $phongs)
        ->with('trangthaidatphongs', $trangthaidatphongs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ma_khach_hang' => 'required|exists:khach_hangs,ma_khach_hang',
            'ma_phong' => 'required|exists:phongs,ma_phong',
            'ma_trang_thai_dat_phong' => 'required|exists:trang_thai_dat_phongs,ma_trang_thai_dat_phong',
            'ngay_dat_phong' => 'required|date',
            'ngay_nhan_phong' => 'required|date|after_or_equal:ngay_dat_phong',
            'ngay_tra_phong' => 'required|date|after_or_equal:ngay_nhan_phong',
        ];
        $rules_messages = [
            'ma_khach_hang.required' => 'Mã khách hàng không được để trống.',
            'ma_khach_hang.exists' => 'Mã khách hàng không tồn tại.',
            'ma_phong.required' => 'Mã phòng không được để trống.',
            'ma_phong.exists' => 'Mã phòng không tồn tại.',
            'ma_trang_thai_dat_phong.required' => 'Mã trạng thái đặt phòng không được để trống.',
            'ma_trang_thai_dat_phong.exists' => 'Mã trạng thái đặt phòng không tồn tại.',
            'ngay_dat_phong.required' => 'Ngày đặt phòng không được để trống.',
            'ngay_dat_phong.date' => 'Ngày đặt phòng không đúng định dạng ngày tháng.',
            'ngay_nhan_phong.required' => 'Ngày nhận phòng không được để trống.',
            'ngay_nhan_phong.date' => 'Ngày nhận phòng không đúng định dạng ngày tháng.',
            'ngay_nhan_phong.after_or_equal' => 'Ngày nhận phòng phải sau hoặc bằng ngày đặt phòng.',
            'ngay_tra_phong.required' => 'Ngày trả phòng không được để trống.',
            'ngay_tra_phong.date' => 'Ngày trả phòng không đúng định dạng ngày tháng.',
            'ngay_tra_phong.after_or_equal' => 'Ngày trả phòng phải sau hoặc bằng ngày nhận phòng.',
        ];
        $request->validate($rules, $rules_messages);
        
        $datphong = DatPhong::findOrFail($id);
        
        // Kiểm tra phòng có bị trùng lịch không (loại trừ đặt phòng hiện tại)
        $checkPhong = DatPhong::where('ma_phong', $request->ma_phong)
        // chổ này viết where là để lọc trong database luôn tránh lấy hết rồi mới lọc ở php
            ->where('ma_dat_phong', '!=', $id)
            //function dùng để gọi tên cho where sữ dụng đièu kiện
            ->where(function($query) use ($request) {
                $query->whereBetween('ngay_nhan_phong', [$request->ngay_nhan_phong, $request->ngay_tra_phong])
                    ->orWhereBetween('ngay_tra_phong', [$request->ngay_nhan_phong, $request->ngay_tra_phong])
                    ->orWhere(function($q) use ($request) {
                        $q->where('ngay_nhan_phong', '<=', $request->ngay_nhan_phong)
                          ->where('ngay_tra_phong', '>=', $request->ngay_tra_phong);
                    });
            })
            //exists đây để kiểm tra true false
            ->exists();
        
        if ($checkPhong) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Phòng này đã có người đặt trong khoảng thời gian này. Vui lòng chọn phòng khác hoặc thời gian khác.');
        }
        
        $data = $request->only([
            'ma_khach_hang',
            'ma_phong',
            'ma_trang_thai_dat_phong',
            'ngay_dat_phong',
            'ngay_nhan_phong',
            'ngay_tra_phong',
        ]);
        $datphong->update($data);
        return redirect()->route('admin.datphong.index')
        ->with('success', 'Đặt phòng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datphong = DatPhong::findOrFail($id);
        $datphong->delete();
        return redirect()->route('admin.datphong.index')
        ->with('success', 'Đặt phòng đã được xóa thành công.');
    }
}
