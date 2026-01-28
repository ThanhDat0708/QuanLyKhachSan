@extends('Admin.layouts.Interface')
@section('title','Quản Lý Phòng')
@section('content')
<h1 class="text-center">Chỉnh Sửa Phòng</h1>
        <form action="{{ route('admin.phong.update', $phong->ma_phong) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ten_phong">Tên Phòng:</label>
                <input type="text" class="form-control" id="ten_phong" name="ten_phong" value="{{ old('ten_phong', $phong->ten_phong) }}" placeholder="Nhập tên phòng...">
                @error('ten_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="anh_phong">Hình Ảnh Phòng:</label>
                @if($phong->anh_phong)
                    <div class="mb-2">
                        <img src="{{ asset('images/' . $phong->anh_phong) }}" alt="{{ $phong->ten_phong }}" width="100">
                        <input type="hidden" name="anh_phong" value="{{ $phong->anh_phong }}">
                    </div>
                @endif
                <input type="file" class="form-control" id="anh_phong" name="anh_phong">
                <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh</small>
                @error('anh_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="so_luong_giuong">Số Lượng Giường:</label>
                <input type="text" class="form-control" id="so_luong_giuong" name="so_luong_giuong" value="{{ old('so_luong_giuong', $phong->so_luong_giuong) }}" placeholder="Nhập số lượng giường...">
                @error('so_luong_giuong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gia_phong">Giá Phòng:</label>
                <input type="text" class="form-control" id="gia_phong" name="gia_phong" value="{{ old('gia_phong', $phong->gia_phong) }}" placeholder="Nhập giá phòng...">
                @error('gia_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" placeholder="Nhập mô tả phòng...">{{ old('mo_ta', $phong->mo_ta) }}</textarea>
                @error('mo_ta')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_loai_phong">Loại Phòng:</label>
                <select class="form-control" id="ma_loai_phong" name="ma_loai_phong">
                    <option value="">Chọn loại phòng</option>
                    @foreach($loaiPhongs as $loaiPhong)
                        <option value="{{ $loaiPhong->ma_loai_phong }}" {{ old('ma_loai_phong', $phong->ma_loai_phong) == $loaiPhong->ma_loai_phong ? 'selected' : '' }}>
                            {{ $loaiPhong->ten_loai_phong }}
                        </option>
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
                        <option value="{{ $trangThaiPhong->ma_trang_thai }}" {{ old('ma_trang_thai', $phong->ma_trang_thai) == $trangThaiPhong->ma_trang_thai ? 'selected' : '' }}>
                            {{ $trangThaiPhong->ten_trang_thai }}
                        </option>
                    @endforeach
                </select>
                @error('ma_trang_thai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Phòng</button>
            <a href="{{ route('admin.phong.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
        </form> 
@endsection
