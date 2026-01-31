<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrangThaiDatPhong;
class TrangThaiDatPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trangthaidatphongs = TrangThaiDatPhong::orderBy('ma_trang_thai_dat_phong', 'desc')->paginate(6);
        return view('admin.trangthaiDP.index')
        ->with('trangthaidatphongs', $trangthaidatphongs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trangthaidatphongs = TrangThaiDatPhong::all();
        return view('admin.trangthaiDP.create')
        ->with('trangthaidatphongs', $trangthaidatphongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ten_trang_thai_dat_phong' => 'required|string|max:100',
        ];
        $rules_messages = [
            'ten_trang_thai_dat_phong.required' => 'Tên trạng thái đặt phòng không được để trống.',
            'ten_trang_thai_dat_phong.string' => 'Tên trạng thái đặt phòng phải là chuỗi ký tự.',
            'ten_trang_thai_dat_phong.max' => 'Tên trạng thái đặt phòng không được vượt quá 100 ký tự.',
        ];
        $request->validate($rules, $rules_messages);
        
        $data = $request->only([
            'ten_trang_thai_dat_phong',
        ]);
        
        TrangThaiDatPhong::create($data);
        
        return redirect()->route('admin.trangthaiDP.index')
                         ->with('success', 'Thêm trạng thái đặt phòng thành công.');
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
        $trangthaidatphong = TrangThaiDatPhong::findOrFail($id);
        return view('admin.trangthaiDP.edit')
        ->with('trangthaidatphong', $trangthaidatphong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ten_trang_thai_dat_phong' => 'required|string|max:100',
        ];
        $rules_messages = [
            'ten_trang_thai_dat_phong.required' => 'Tên trạng thái đặt phòng không được để trống.',
            'ten_trang_thai_dat_phong.string' => 'Tên trạng thái đặt phòng phải là chuỗi ký tự.',
            'ten_trang_thai_dat_phong.max' => 'Tên trạng thái đặt phòng không được vượt quá 100 ký tự.',
        ];
        $request->validate($rules, $rules_messages);
        
        $trangthaidatphong = TrangThaiDatPhong::findOrFail($id);
        
        $data = $request->only([
            'ten_trang_thai_dat_phong',
        ]);
        
        $trangthaidatphong->update($data);
        
        return redirect()->route('admin.trangthaiDP.index')
                         ->with('success', 'Cập nhật trạng thái đặt phòng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trangthaidatphong = TrangThaiDatPhong::findOrFail($id);
        $trangthaidatphong->delete();
        
        return redirect()->route('admin.trangthaiDP.index')
                         ->with('success', 'Xóa trạng thái đặt phòng thành công.');
    }
}
