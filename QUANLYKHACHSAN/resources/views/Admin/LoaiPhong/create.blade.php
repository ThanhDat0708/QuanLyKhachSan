@extends('Admin.layouts.Interface')
@section('title', 'Thêm Loại Phòng Mới')
@section('content')
    <div class="container">
        <h1 class="text-center">Thêm Loại Phòng Mới</h1>
        <form action="{{ route('admin.loaiphong.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ten_loai_phong">Tên Loại Phòng:</label>
                <input type="text" class="form-control" id="ten_loai_phong" name="ten_loai_phong" placeholder="Nhập tên loại phòng...">
                @error('ten_loai_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Loại Phòng</button>
        </form>
    </div>
@endsection
