<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'so_dien_thoai' => 'required|string',
            'password' => 'required|string',
        ], [
            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);
        
        // Tìm user theo số điện thoại
        $user = User::where('so_dien_thoai', $request->so_dien_thoai)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            
            // Phân quyền chuyển hướng theo vai trò
            if ($user->vai_tro == 'admin' || $user->vai_tro == 'le_tan') {
                // Admin và Lễ tân vào trang quản lý
                return redirect()->intended('/dashboard')->with('success', 'Đăng nhập thành công!');
            } else {
                // Khách hàng vào trang khách
                return redirect()->intended('/khachhang/dashboard')->with('success', 'Đăng nhập thành công!');
            }
        }
        
        return back()->withErrors([
            'so_dien_thoai' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }
    
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'ten_tai_khoan' => 'required|string|max:255|unique:users,ten_tai_khoan',
            'so_dien_thoai' => 'required|string|max:15|unique:users,so_dien_thoai',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'ten_tai_khoan.required' => 'Tên tài khoản không được để trống.',
            'ten_tai_khoan.unique' => 'Tên tài khoản đã tồn tại.',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'so_dien_thoai.unique' => 'Số điện thoại đã được đăng ký.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
        
        $user = User::create([
            'ten_tai_khoan' => $request->ten_tai_khoan,
            'so_dien_thoai' => $request->so_dien_thoai,
            'password' => $request->password, // Tự động hash
            'vai_tro' => 'nguoi_dung', // Mặc định là người dùng
        ]);
        
        // Tự động đăng nhập sau khi đăng ký
        Auth::login($user);
        
        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
    
    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Đã đăng xuất thành công!');
    }
}
