@extends('Admin.layouts.Interface')
@section('content')
    <div class="container">
        <h1 class="text-center">Chỉnh Sửa Đặt Phòng</h1>
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="{{ route('admin.datphong.update', $datphong->ma_dat_phong) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ma_khach_hang">Khách Hàng:</label>
                <select class="form-control" id="ma_khach_hang" name="ma_khach_hang">
                    @foreach ($khachhangs as $khachhang)
                        <option value="{{ old('ma_khach_hang', $khachhang->ma_khach_hang) }}" {{ $datphong->ma_khach_hang == $khachhang->ma_khach_hang ? 'selected' : '' }}>{{ $khachhang->ho_ten }}</option>
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
                        <option value="{{ old('ma_phong', $phong->ma_phong) }}" {{ $datphong->ma_phong == $phong->ma_phong ? 'selected' : '' }}>{{ $phong->ten_phong }}</option>
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
                        <option value="{{ old('ma_trang_thai_dat_phong', $trangthaidatphong->ma_trang_thai_dat_phong) }}" {{ $datphong->ma_trang_thai_dat_phong == $trangthaidatphong->ma_trang_thai_dat_phong ? 'selected' : '' }}>{{ $trangthaidatphong->ten_trang_thai_dat_phong }}</option>
                    @endforeach
                </select>
                @error('ma_trang_thai_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_dat_phong">Ngày Đặt Phòng:</label>
                <input type="date" class="form-control" id="ngay_dat_phong" name="ngay_dat_phong" value="{{ old('ngay_dat_phong', $datphong->ngay_dat_phong ? \Carbon\Carbon::parse($datphong->ngay_dat_phong)->format('Y-m-d') : '') }}">
                @error('ngay_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_nhan_phong">Ngày Nhận Phòng:</label>
                <input type="date" class="form-control" id="ngay_nhan_phong" name="ngay_nhan_phong" value="{{ old('ngay_nhan_phong', $datphong->ngay_nhan_phong ? \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->format('Y-m-d') : '') }}">
                @error('ngay_nhan_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_tra_phong">Ngày Trả Phòng:</label>
                <input type="date" class="form-control" id="ngay_tra_phong" name="ngay_tra_phong" value="{{ old('ngay_tra_phong', $datphong->ngay_tra_phong ? \Carbon\Carbon::parse($datphong->ngay_tra_phong)->format('Y-m-d') : '') }}">
                @error('ngay_tra_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Đặt Phòng</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Hủy</button>
        </form> 
    </div>
@endsection