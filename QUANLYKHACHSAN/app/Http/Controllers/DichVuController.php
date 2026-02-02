<?php

namespace App\Http\Controllers;
use App\Models\DichVu;
use Illuminate\Http\Request;

class DichVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dichvus = DichVu::orderBy('ma_dich_vu', 'desc')->paginate(6);
        return view('admin.dichvu.index')
        ->with('dichvus', $dichvus);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dichvus = DichVu::all();
        return view('admin.dichvu.create')
        ->with('dichvus', $dichvus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ten_dich_vu' => 'required|string|max:100',
            'don_gia' => 'required|numeric|min:0',
            'so_luong' => 'nullable|integer|min:0',
            'mo_ta' => 'nullable|string',
        ];
        $rules_messages = [
            'ten_dich_vu.required' => 'Tên dịch vụ không được để trống.',
            'ten_dich_vu.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
            'ten_dich_vu.max' => 'Tên dịch vụ không được vượt quá 100 ký tự.',
            'don_gia.required' => 'Đơn giá không được để trống.',
            'don_gia.numeric' => 'Đơn giá phải là số.',
            'don_gia.min' => 'Đơn giá phải lớn hơn hoặc bằng 0.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ];
        $request->validate($rules, $rules_messages);

        $dichvu = new DichVu();
        $dichvu->ten_dich_vu = $request->ten_dich_vu;
        $dichvu->don_gia = $request->don_gia;
        $dichvu->so_luong = $request->so_luong;
        $dichvu->mo_ta = $request->mo_ta;
        $dichvu->save();

        return redirect()->route('admin.dichvu.index')
        ->with('success', 'Thêm dịch vụ thành công.');
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
        $dichvu = DichVu::findOrFail($id);
        return view('admin.dichvu.edit')
        ->with('dichvu', $dichvu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ten_dich_vu' => 'required|string|max:100',
            'don_gia' => 'required|numeric|min:0',
            'so_luong' => 'nullable|integer|min:0',
            'mo_ta' => 'nullable|string',
        ];
        $rules_messages = [
            'ten_dich_vu.required' => 'Tên dịch vụ không được để trống.',
            'ten_dich_vu.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
            'ten_dich_vu.max' => 'Tên dịch vụ không được vượt quá 100 ký tự.',
            'don_gia.required' => 'Đơn giá không được để trống.',
            'don_gia.numeric' => 'Đơn giá phải là số.',
            'don_gia.min' => 'Đơn giá phải lớn hơn hoặc bằng 0.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ];
        $request->validate($rules, $rules_messages);

        $dichvu = DichVu::findOrFail($id);
        $dichvu->ten_dich_vu = $request->ten_dich_vu;
        $dichvu->don_gia = $request->don_gia;
        $dichvu->so_luong = $request->so_luong;
        $dichvu->mo_ta = $request->mo_ta;
        $dichvu->save();

        return redirect()->route('admin.dichvu.index')
        ->with('success', 'Cập nhật dịch vụ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dichvu = DichVu::findOrFail($id);
        $dichvu->delete();

        return redirect()->route('admin.dichvu.index')
        ->with('success', 'Xóa dịch vụ thành công.');
    }
}
