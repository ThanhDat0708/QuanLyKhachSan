@extends('Admin.layouts.Interface')
@section('content')
    <div class="container">
        <h1 class="text-center">Thêm Đặt Phòng Mới</h1>
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="{{ route('admin.datphong.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ma_khach_hang">Khách Hàng:</label>
                <select class="form-control" id="ma_khach_hang" name="ma_khach_hang">
                    @foreach ($khachhangs as $khachhang)
                        <option value="{{ $khachhang->ma_khach_hang }}">{{ $khachhang->ho_ten }}</option>
                    @endforeach
                </select>
                @error('ma_khach_hang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_phong">Phòng:</label>
                <select class="form-control" id="ma_phong" name="ma_phong">
                    @foreach ($phongs as $phong)
                        <option value="{{ $phong->ma_phong }}">{{ $phong->ten_phong }}</option>
                    @endforeach
                </select>
                @error('ma_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_trang_thai_dat_phong">Trạng Thái Đặt Phòng:</label>
                <select class="form-control" id="ma_trang_thai_dat_phong" name="ma_trang_thai_dat_phong">
                    @foreach ($trangthaidatphongs as $trangthaidatphong)
                        <option value="{{ $trangthaidatphong->ma_trang_thai_dat_phong }}">{{ $trangthaidatphong->ten_trang_thai_dat_phong }}</option>
                    @endforeach
                </select>
                @error('ma_trang_thai_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_dat_phong">Ngày Đặt Phòng:</label>
                <input type="date" class="form-control" id="ngay_dat_phong" name="ngay_dat_phong" value="{{ old('ngay_dat_phong') }}">
                @error('ngay_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_nhan_phong">Ngày Nhận Phòng:</label>
                <input type="date" class="form-control" id="ngay_nhan_phong" name="ngay_nhan_phong" value="{{ old('ngay_nhan_phong') }}">
                @error('ngay_nhan_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_tra_phong">Ngày Trả Phòng:</label>
                <input type="date" class="form-control" id="ngay_tra_phong" name="ngay_tra_phong" value="{{ old('ngay_tra_phong') }}">
                @error('ngay_tra_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Đặt Phòng</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Hủy</button>
        </form>
    </div>
@endsection
