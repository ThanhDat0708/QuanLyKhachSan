@extends('Admin.layouts.Interface')
@section('title', 'Thêm Khach Hàng Mới')
@section('content')
    <div class="container">
        <h1 class="text-center">Thêm Khach Hàng Mới</h1>
        <form action="{{ route('admin.khachhang.update', $khachhang->ma_khach_hang) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ho_ten">Họ và Tên:</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nhập họ và tên..." value="{{ old('ho_ten', $khachhang->ho_ten) }}">
                @error('ho_ten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới Tính:</label>
                <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                    <option value="">Chọn giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
                @error('gioi_tinh')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày Sinh:</label>
                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $khachhang->ngay_sinh) }}">
                @error('ngay_sinh')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số Điện Thoại:</label>
                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại..." value="{{ old('so_dien_thoai', $khachhang->so_dien_thoai) }}">
                @error('so_dien_thoai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="dia_chi">Địa Chỉ:</label>
                <input type="text" class="form-control" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ..." value="{{ old('dia_chi', $khachhang->dia_chi) }}">
                @error('dia_chi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email..." value="{{ old('email', $khachhang->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cccd">CCCD:</label>
                <input type="text" class="form-control" id="cccd" name="cccd" placeholder="Nhập CCCD..." value="{{ old('cccd', $khachhang->cccd) }}">
                @error('cccd')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Khách Hàng</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Hủy</button>
        </form>
    </div>
@endsection
