@extends('Admin.layouts.Interface')

@section('title', 'Thêm Tài Khoản')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Thêm Tài Khoản Mới</h1>

    <form action="{{ route('admin.taikhoan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="ten_tai_khoan">Tên người dùng:</label>
            <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" value="{{ old('ten_tai_khoan') }}" placeholder="Nhập tên người dùng...">
            @error('ten_tai_khoan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="so_dien_thoai">Số điện thoại:</label>
            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" placeholder="Nhập số điện thoại...">
            @error('so_dien_thoai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vai_tro">Vai trò:</label>
            <select class="form-control" id="vai_tro" name="vai_tro">
                <option value="">Chọn vai trò</option>
                <option value="admin" {{ old('vai_tro') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="le_tan" {{ old('vai_tro') === 'le_tan' ? 'selected' : '' }}>Lễ tân</option>
                <option value="nguoi_dung" {{ old('vai_tro') === 'nguoi_dung' ? 'selected' : '' }}>Người dùng</option>
            </select>
            @error('vai_tro')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu...">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Thêm Tài Khoản</button>
        <a href="{{ route('admin.taikhoan.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
    </form>
</div>
@endsection