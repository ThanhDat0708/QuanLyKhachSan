<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKhachHangController extends Controller
{
    /**
     * Hiển thị thông tin khách hàng của người dùng đang đăng nhập
     */
    public function show()
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;
        
        return view('NguoiDung.khachhang.show', compact('khachhang'));
    }

    /**
     * Hiển thị form tạo/cập nhật thông tin khách hàng
     */
    public function edit()
    {
        $user = Auth::user();
        $khachhang = $user->khachHang;
        
        return view('NguoiDung.khachhang.edit', compact('khachhang'));
    }

    /**
     * Cập nhật hoặc tạo mới thông tin khách hàng
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'ho_ten' => 'required|string|max:200',
            'ngay_sinh' => 'nullable|date',
            'so_dien_thoai' => 'nullable|string|max:10',
            'dia_chi' => 'nullable|string|max:200',
            'email' => 'nullable|string|email|max:100',
            'cmnd' => 'nullable|string|max:12',
        ];
        
        $rules_messages = [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
            'ho_ten.max' => 'Họ tên không được vượt quá 200 ký tự.',
            'ngay_sinh.date' => 'Ngày sinh không đúng định dạng ngày tháng.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 10 ký tự.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 100 ký tự.',
            'cmnd.max' => 'CMND không được vượt quá 12 ký tự.',
        ];
        
        $request->validate($rules, $rules_messages);
        
        $data = $request->only([
            'ho_ten',
            'ngay_sinh',
            'so_dien_thoai',
            'dia_chi',
            'email',
            'cmnd',
        ]);
        
        $data['ma_tai_khoan'] = $user->ma_tai_khoan;
        
        // Nếu đã có thông tin thì update, chưa có thì tạo mới
        if ($user->khachHang) {
            $user->khachHang->update($data);
            $message = 'Cập nhật thông tin thành công!';
        } else {
            KhachHang::create($data);
            $message = 'Thêm thông tin thành công!';
        }
        
        return redirect()->route('nguoidung.thongtin.show')
            ->with('success', $message);
    }
}
