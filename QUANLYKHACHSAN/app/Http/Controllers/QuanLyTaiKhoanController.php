<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class QuanLyTaiKhoanController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('tu_khoa')) {
            $tuKhoa = $request->tu_khoa;
            $query->where(function ($subQuery) use ($tuKhoa) {
                $subQuery->where('ten_tai_khoan', 'like', '%' . $tuKhoa . '%')
                    ->orWhere('so_dien_thoai', 'like', '%' . $tuKhoa . '%');
            });
        }

        if ($request->filled('vai_tro')) {
            $query->where('vai_tro', $request->vai_tro);
        }

        $taikhoans = $query->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends($request->query());

        return view('Admin.QuanLyTaiKhoan.index')
            ->with('taikhoans', $taikhoans);
    }

    public function create()
    {
        return view('Admin.QuanLyTaiKhoan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_tai_khoan' => 'required|string|max:255|unique:users,ten_tai_khoan',
            'so_dien_thoai' => 'required|string|max:15|unique:users,so_dien_thoai',
            'vai_tro' => 'required|in:admin,le_tan,nguoi_dung',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'ten_tai_khoan.required' => 'Tên tài khoản không được để trống.',
            'ten_tai_khoan.unique' => 'Tên tài khoản đã tồn tại.',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
            'vai_tro.required' => 'Vai trò không được để trống.',
            'vai_tro.in' => 'Vai trò không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        User::create($validated);

        return redirect()->route('admin.taikhoan.index')
            ->with('success', 'Thêm tài khoản thành công!');
    }

    public function edit(string $id)
    {
        $taikhoan = User::findOrFail($id);

        return view('Admin.QuanLyTaiKhoan.edit')
            ->with('taikhoan', $taikhoan);
    }

    public function update(Request $request, string $id)
    {
        $taikhoan = User::findOrFail($id);

        $validated = $request->validate([
            'ten_tai_khoan' => 'required|string|max:255|unique:users,ten_tai_khoan,' . $id . ',ma_tai_khoan',
            'so_dien_thoai' => 'required|string|max:15|unique:users,so_dien_thoai,' . $id . ',ma_tai_khoan',
            'vai_tro' => 'required|in:admin,le_tan,nguoi_dung',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'ten_tai_khoan.required' => 'Tên tài khoản không được để trống.',
            'ten_tai_khoan.unique' => 'Tên tài khoản đã tồn tại.',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
            'vai_tro.required' => 'Vai trò không được để trống.',
            'vai_tro.in' => 'Vai trò không hợp lệ.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $taikhoan->update($validated);

        return redirect()->route('admin.taikhoan.index')
            ->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function destroy(string $id)
    {
        $taikhoan = User::findOrFail($id);

        if ((int) auth()->id() === (int) $taikhoan->ma_tai_khoan) {
            return redirect()->route('admin.taikhoan.index')
                ->with('error', 'Không thể xóa tài khoản đang đăng nhập.');
        }

        $taikhoan->delete();

        return redirect()->route('admin.taikhoan.index')
            ->with('success', 'Xóa tài khoản thành công!');
    }
}