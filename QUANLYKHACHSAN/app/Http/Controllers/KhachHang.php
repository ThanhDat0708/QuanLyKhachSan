<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khachhangs = KhachHang::orderBy('ma_khach_hang', 'desc')->paginate(6);
        return view('admin.khachhang.index')
        ->with('khachhangs', $khachhangs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khachhangs = KhachHang::all();
        $mataikhoans = User::all();
        return view('admin.khachhang.create')
        ->with('khachhangs', $khachhangs)
        ->with('mataikhoans', $mataikhoans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'ho_ten' => 'required|string|max:200',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'nullable|string|max:3',
            'so_dien_thoai' => 'nullable|string|max:10',
            'dia_chi' => 'nullable|string|max:200',
            'email' => 'nullable|string|email|max:100',
            'cmnd' => 'nullable|string|max:12',
            'ma_tai_khoan' => 'required|exists:users,ma_tai_khoan',
        ];
        $rules_messages = [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
            'ho_ten.max' => 'Họ tên không được vượt quá 200 ký tự.',
            'ngay_sinh.date' => 'Ngày sinh không đúng định dạng ngày tháng.',
            'gioi_tinh.max' => 'Giới tính không được vượt quá 3 ký tự.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 10 ký tự.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 100 ký tự.',
            'cmnd.max' => 'CMND không được vượt quá 12 ký tự.',
            'ma_tai_khoan.required' => 'Mã tài khoản không được để trống.',
            'ma_tai_khoan.exists' => 'Mã tài khoản không tồn tại.',
        ];
        $request->validate($rules, $rules_messages);
        
        $data = $request->only([
            'ho_ten',
            'ngay_sinh',
            'gioi_tinh',
            'so_dien_thoai',
            'dia_chi',
            'email',
            'cmnd',
            'ma_tai_khoan',
        ]);
        
        KhachHang::create($data);
        
        return redirect()->route('khachhang.index')
        ->with('success', 'Thêm khách hàng thành công!');
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
        $khachhangs = KhachHang::findOrFail($id);
        $mataikhoans = User::all();
        return view('admin.khachhang.edit')
        ->with('khachhangs', $khachhangs)
        ->with('mataikhoans', $mataikhoans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'ho_ten' => 'required|string|max:200',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'nullable|string|max:3',
            'so_dien_thoai' => 'nullable|string|max:10',
            'dia_chi' => 'nullable|string|max:200',
            'email' => 'nullable|string|email|max:100',
            'cmnd' => 'nullable|string|max:12',
            'ma_tai_khoan' => 'required|exists:users,ma_tai_khoan',
        ];
        $rules_messages = [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
            'ho_ten.max' => 'Họ tên không được vượt quá 200 ký tự.',
            'ngay_sinh.date' => 'Ngày sinh không đúng định dạng ngày tháng.',
            'gioi_tinh.max' => 'Giới tính không được vượt quá 3 ký tự.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 10 ký tự.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 100 ký tự.',
            'cmnd.max' => 'CMND không được vượt quá 12 ký tự.',
            'ma_tai_khoan.required' => 'Mã tài khoản không được để trống.',
            'ma_tai_khoan.exists' => 'Mã tài khoản không tồn tại.',
        ];
        $request->validate($rules, $rules_messages);
        
        $data = $request->only([
            'ho_ten',
            'ngay_sinh',
            'gioi_tinh',
            'so_dien_thoai',
            'dia_chi',
            'email',
            'cmnd',
            'ma_tai_khoan',
        ]);
        
        $khachhang = KhachHang::findOrFail($id);
        $khachhang->update($data);
        
        return redirect()->route('khachhang.index')
        ->with('success', 'Cập nhật khách hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       KhachHang::destroy($id);
       return redirect()->route('khachhang.index')
       ->with('success', 'Xóa khách hàng thành công!');
        

    }
}
