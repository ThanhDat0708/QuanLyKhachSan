@extends('Admin.layouts.Interface')
@section('content')
    <div class="container">
        <h1 class="text-center">Thêm Trạng Thái Đặt Phòng Mới</h1>
        <form action="{{ route('admin.trangthaiDP.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ten_trang_thai_dat_phong">Tên Trạng Thái Đặt Phòng:</label>
                <input type="text" class="form-control" id="ten_trang_thai_dat_phong" name="ten_trang_thai_dat_phong" placeholder="Nhập tên trạng thái đặt phòng...">
                @error('ten_trang_thai_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Trạng Thái Đặt Phòng</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Hủy</button>
        </form>
    </div>
@endsection