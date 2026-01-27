<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phong;
class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phongs = Phong::orderBy('ma_phong', 'desc')->paginate(6);
        return view('admin.phong.index')
        ->with('phongs', $phongs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phongs = Phong::all();
        return view('admin.phong.create')
        ->with('phongs', $phongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ten_phong' => 'required|string|max:200',
            'anh_phong' => 'nullable|string|max:200',
            'so_luong_giuong' => 'nullable|integer',
            'gia_phong' => 'nullable|numeric',
            'mo_ta' => 'nullable|string|max:200',
            'ma_loai_phong' => 'nullable|exists:loai_phongs,ma_loai_phong',
            'ma_trang_thai' => 'nullable|exists:trang_thai_phongs,ma_trang_thai',
        ];
        $rules_messages = [
            'ten_phong.required' => 'Tên phòng không được để trống.',
            'ten_phong.string' => 'Tên phòng phải là chuỗi ký tự.',
            'ten_phong.max' => 'Tên phòng không được vượt quá 200 ký tự.',
            'anh_phong.string' => 'Ảnh phòng phải là chuỗi ký tự.',
            'anh_phong.max' => 'Ảnh phòng không được vượt quá 200 ký tự.',
            'so_luong_giuong.integer' => 'Số lượng giường phải là số nguyên.',
            'gia_phong.numeric' => 'Giá phòng phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
            'mo_ta.max' => 'Mô tả không được vượt quá 200 ký tự.',
        ];
        $request->validate($rules, $rules_messages);
        $data = $request->only([
            'ten_phong',
            'anh_phong',
            'so_luong_giuong',
            'gia_phong',
            'mo_ta',
            'ma_loai_phong',
            'ma_trang_thai',
        ]);
        $phong = Phong::create($data);
        if(!$phong) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm phòng!');
        }
        else {
            return redirect()->route('admin.phong.index')->with('success', 'Thêm phòng thành công!');
        }   
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
        $phong = Phong::find($id);
        return view('admin.phong.edit')
        ->with('phong', $phong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ten_phong' => 'required|string|max:200',
            'anh_phong' => 'nullable|string|max:200',
            'so_luong_giuong' => 'nullable|integer',
            'gia_phong' => 'nullable|numeric',
            'mo_ta' => 'nullable|string|max:200',
            'ma_loai_phong' => 'nullable|exists:loai_phongs,ma_loai_phong',
            'ma_trang_thai' => 'nullable|exists:trang_thai_phongs,ma_trang_thai',
        ];
        $rules_messages = [
            'ten_phong.required' => 'Tên phòng không được để trống.',
            'ten_phong.string' => 'Tên phòng phải là chuỗi ký tự.',
            'ten_phong.max' => 'Tên phòng không được vượt quá 200 ký tự.',
            'anh_phong.string' => 'Ảnh phòng phải là chuỗi ký tự.',
            'anh_phong.max' => 'Ảnh phòng không được vượt quá 200 ký tự.',
            'so_luong_giuong.integer' => 'Số lượng giường phải là số nguyên.',
            'gia_phong.numeric' => 'Giá phòng phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
            'mo_ta.max' => 'Mô tả không được vượt quá 200 ký tự.',
        ];
        $request->validate($rules, $rules_messages);
        $data = $request->only([
            'ten_phong',
            'anh_phong',
            'so_luong_giuong',
            'gia_phong',
            'mo_ta',
            'ma_loai_phong',
            'ma_trang_thai',
        ]);
        $phong = Phong::find($id);
        $phong->update($data);
        if(!$phong) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật phòng!');
        }
        else {
            return redirect()->route('admin.phong.index')->with('success', 'Cập nhật phòng thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Phong::destroy($id);
        return redirect()->route('admin.phong.index')->with('success', 'Xóa phòng thành công!');
    }
}
