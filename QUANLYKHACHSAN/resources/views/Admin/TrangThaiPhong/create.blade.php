@extends('Admin.layouts.Interface')
@section('title','Quản Lý Trạng Thái Phòng')
@section('content')
<div class="container">
    <h1 class="text-center">Thêm Trạng Thái Phòng Mới</h1>
        <form action="{{ route('admin.trangthaiphong.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ten_trang_thai">Tên Trạng Thái Phòng:</label>
                <input type="text" class="form-control" id="ten_trang_thai" name="ten_trang_thai" placeholder="Nhập tên trạng thái phòng...">
                @error('ten_trang_thai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Trạng Thái Phòng</button>
        </form>
    </div>
@endsection