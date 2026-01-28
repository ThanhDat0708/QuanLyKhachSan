@extends('Admin.layouts.Interface')
@section('title','Quản Lý Phòng')
@section('content')
<div class="container">
        <h1 class="text-center">Thêm Phòng Mới</h1>
        <form action="{{ route('admin.phong.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ten_phong">Tên Phòng:</label>
                <input type="text" class="form-control" id="ten_phong" name="ten_phong" placeholder="Nhập tên phòng...">
                @error('ten_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="anh_phong">Hình Ảnh Phòng:</label>
                <input type="file" class="form-control" id="anh_phong" name="anh_phong">
                @error('anh_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="so_luong_giuong">Số Lượng Giường:</label>
                <input type="number" class="form-control" id="so_luong_giuong" name="so_luong_giuong" placeholder="Nhập số lượng giường...">
                @error('so_luong_giuong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gia_phong">Giá Phòng:</label>
                <input type="number" class="form-control" id="gia_phong" name="gia_phong" placeholder="Nhập giá phòng...">
                @error('gia_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" placeholder="Nhập mô tả phòng..."></textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_loai_phong">Loại Phòng:</label>
                <select class="form-control" id="ma_loai_phong" name="ma_loai_phong">
                    <option value="">Chọn loại phòng</option>
                    @foreach($loaiPhongs as $loaiPhong)
                        <option value="{{ $loaiPhong->ma_loai_phong }}">{{ $loaiPhong->ten_loai_phong }}</option>
                    @endforeach
                </select>
                @error('ma_loai_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_trang_thai">Trạng Thái:</label>
                <select class="form-control" id="ma_trang_thai" name="ma_trang_thai">
                    <option value="">Chọn trạng thái phòng</option>
                    @foreach($trangThaiPhongs as $trangThaiPhong)
                        <option value="{{ $trangThaiPhong->ma_trang_thai }}">{{ $trangThaiPhong->ten_trang_thai }}</option>
                    @endforeach
                </select>
                @error('ma_trang_thai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm Phòng</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Hủy</button>
        </form>
    </div>
@endsection