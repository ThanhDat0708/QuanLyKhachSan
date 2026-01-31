@extends('Admin.layouts.Interface')
@section('content')
    <div class="container">
        <h1 class="text-center">Chỉnh Sửa Trạng Thái Đặt Phòng</h1>
        <form action="{{ route('admin.trangthaidatphong.update', $trangthaidatphong->ma_trang_thai_dat_phong) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">    
                <label for="ten_trang_thai_dat_phong">Tên Trạng Thái Đặt Phòng:</label>
                <input type="text" class="form-control" id="ten_trang_thai_dat_phong" name="ten_trang_thai_dat_phong" placeholder="Nhập tên trạng thái đặt phòng..." value="{{ old('ten_trang_thai_dat_phong', $trangthaidatphong->ten_trang_thai_dat_phong) }}">
                @error('ten_trang_thai_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Trạng Thái Đặt Phòng</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Hủy</button>
        </form>
    </div>
@endsection