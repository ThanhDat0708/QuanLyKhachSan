<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng
     */
    public function index()
    {
        $khachhangs = KhachHang::with('user')->orderBy('created_at', 'desc')->paginate(6);
        return view('Admin.khachhang.index')
        ->with('khachhangs', $khachhangs);
    }

    /**
     * Hiển thị form tạo khách hàng mới
     */
    public function create()
    {
        $khachhangs = KhachHang::all();
        return view('Admin.khachhang.create')
        ->with('khachhangs', $khachhangs);
    }

    /**
     * Lưu khách hàng mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_tai_khoan' => 'required|string|max:255|unique:users,ten_tai_khoan',
            'so_dien_thoai' => 'required|string|max:15|unique:users,so_dien_thoai',
            'password' => 'required|string|min:6',
            'ho_ten' => 'required|string|max:255',
            'gioi_tinh' => 'nullable|string',
            'ngay_sinh' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'dia_chi' => 'nullable|string|max:500',
            'cccd' => 'nullable|string|max:20',
        ]);

        // Tạo tài khoản user trước
        $user = User::create([
            'ten_tai_khoan' => $validated['ten_tai_khoan'],
            'so_dien_thoai' => $validated['so_dien_thoai'],
            'password' => Hash::make($validated['password']),
            'vai_tro' => 'nguoi_dung',
        ]);

        // Tạo thông tin khách hàng
        KhachHang::create([
            'ma_tai_khoan' => $user->ma_tai_khoan,
            'ho_ten' => $validated['ho_ten'],
            'gioi_tinh' => $validated['gioi_tinh'] ?? null,
            'ngay_sinh' => $validated['ngay_sinh'] ?? null,
            'so_dien_thoai' => $validated['so_dien_thoai'],
            'email' => $validated['email'] ?? null,
            'dia_chi' => $validated['dia_chi'] ?? null,
            'cccd' => $validated['cccd'] ?? null,
        ]);

        return redirect()->route('admin.khachhang.index')
        ->with('success', 'Thêm khách hàng thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit($id)
    {
        $khachhang = KhachHang::with('user')->findOrFail($id);
        return view('Admin.khachhang.edit')
        ->with('khachhang', $khachhang);
    }

    /**
     * Cập nhật thông tin khách hàng
     */
    public function update(Request $request, $id)
    {
        $khachhang = KhachHang::findOrFail($id);

        $validated = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'gioi_tinh' => 'nullable|string',
            'ngay_sinh' => 'nullable|date',
            'so_dien_thoai' => 'required|string|max:15|unique:khach_hangs,so_dien_thoai,' . $id . ',ma_khach_hang',
            'email' => 'nullable|email|max:255',
            'dia_chi' => 'nullable|string|max:500',
            'cccd' => 'nullable|string|max:20',
        ]);

        $khachhang->update($validated);

        return redirect()->route('admin.khachhang.index')
        ->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    /**
     * Xóa khách hàng
     */
    public function destroy($id)
    {
        $khachhang = KhachHang::findOrFail($id);
        
        // Xóa tài khoản user liên kết
        if ($khachhang->user) {
            $khachhang->user->delete();
        }
        
        $khachhang->delete();

        return redirect()->route('admin.khachhang.index')
        ->with('success', 'Xóa khách hàng thành công!');
    }
}
