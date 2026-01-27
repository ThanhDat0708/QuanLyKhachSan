<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrangThaiPhong;
class TrangThaiPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trangthaiphongs = TrangThaiPhong::orderBy('ma_trang_thai', 'desc')->paginate(2);
        return view('Admin.TrangThaiPhong.index')
        ->with('trangthaiphongs', $trangthaiphongs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trangthaiphongs = TrangThaiPhong::all();
        return view('Admin.TrangThaiPhong.create')
        ->with('trangthaiphongs',$trangthaiphongs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ten_trang_thai' => 'required|string|max:200|unique:trang_thai_phongs,ten_trang_thai',
        ];
        $rules_messages = [
            'ten_trang_thai.required' => 'Tên trạng thái phòng không được để trống',
            'ten_trang_thai.string' => 'Tên trạng thái phòng phải là chuỗi ký tự',
            'ten_trang_thai.max' => 'Tên trạng thái phòng không được vượt quá 200 ký tự',
            'ten_trang_thai.unique' => 'Tên trạng thái phòng đã tồn tại'
        ];
        //kiểm tra đối tượng hiện tại đã hợp lệ hay chưa nếu chưa sẽ trả về thông báo lỗi
        // validate(xác thực dữ liệu)
        $request->validate($rules, $rules_messages);
        $data = $request->only('ten_trang_thai');
        $trangthaiphong = TrangThaiPhong::create($data);
        
        if($trangthaiphong) {
            return redirect()->route('admin.trangthaiphong.index')->with('success', 'Thêm trạng thái phòng thành công!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm trạng thái phòng!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trangthaiphong = TrangThaiPhong::find($id);
        return view('Admin.TrangThaiPhong.edit')
        ->with('trangthaiphong',$trangthaiphong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ten_trang_thai' => 'required|string|max:200|unique:trang_thai_phongs,ten_trang_thai,'.$id.',ma_trang_thai',
        ];
        $rules_messages = [
            'ten_trang_thai.required' => 'Tên trạng thái phòng không được để trống',
            'ten_trang_thai.string' => 'Tên trạng thái phòng phải là chuỗi ký tự',
            'ten_trang_thai.max' => 'Tên trạng thái phòng không được vượt quá 200 ký tự',
            'ten_trang_thai.unique' => 'Tên trạng thái phòng đã tồn tại'
        ];
        //kiểm tra đối tượng hiện tại đã hợp lệ hay chưa nếu chưa sẽ trả về thông báo lỗi
        // validate(xác thực dữ liệu)
        $request->validate($rules, $rules_messages);
        $trangthaiphong = TrangThaiPhong::find($id);
        $trangthaiphong->ten_trang_thai = $request->input('ten_trang_thai');
        $updated = $trangthaiphong->save();
        
        if($updated) {
            return redirect()->route('admin.trangthaiphong.index')->with('success', 'Cập nhật trạng thái phòng thành công!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật trạng thái phòng!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TrangThaiPhong::destroy($id);
        return redirect()->route('admin.trangthaiphong.index')->with('success', 'Xóa trạng thái phòng thành công!');
    }
}
