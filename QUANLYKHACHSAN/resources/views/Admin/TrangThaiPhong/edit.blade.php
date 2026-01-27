@extends('Admin.layouts.Interface')
@section('title','Quản Lý Trạng Thái Phòng')
@section('content')
<div class="container">
    <h1 class="text-center">Sửa Trạng Thái Phòng</h1>
        <form action="{{ route('admin.trangthaiphong.update', $trangthaiphong->ma_trang_thai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group
">
                <label for="ten_trang_thai">Tên Trạng Thái Phòng:</label>
                <input type="text" class="form-control" id="ten_trang_thai" name="ten_trang_thai" value="{{ old('ten_trang_thai', $trangthaiphong->ten_trang_thai) }}" placeholder="Nhập tên trạng thái phòng...">
                @error('ten_trang_thai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Trạng Thái Phòng</button>
            <button type="button" class="btn btn-secondary mt-3">Quay Lại</button>
        </form>
    </div>
@endsection