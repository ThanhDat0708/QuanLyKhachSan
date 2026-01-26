@extends('Admin.layouts.Interface')
@section('title', 'Sửa Loại Phòng')
@section('content')
    <div class="container">
        <h1 class="text-center">Sửa Loại Phòng</h1>
        <form action="{{ route('admin.loaiphong.update', $loaiphong->ma_loai_phong) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group
">
                <label for="ten_loai_phong">Tên Loại Phòng:</label>
                <input type="text" class="form-control" id="ten_loai_phong" name="ten_loai_phong" value="{{ old('ten_loai_phong', $loaiphong->ten_loai_phong) }}" placeholder="Nhập tên loại phòng...">
                @error('ten_loai_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Loại Phòng</button>
            <button type="button" class="btn btn-secondary mt-3">Quay Lại</button>
        </form>
    </div>
@endsection