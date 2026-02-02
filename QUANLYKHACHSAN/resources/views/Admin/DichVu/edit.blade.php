@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
            <h2 class="mb-4">Sửa Dịch Vụ</h2>
            <form action="{{ route('admin.dichvu.update', $dichvu->ma_dich_vu) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="ten_dich_vu">Tên Dịch Vụ:</label>
                    <input type="text" class="form-control" id="ten_dich_vu" name="ten_dich_vu" value="{{ old('ten_dich_vu', $dichvu->ten_dich_vu) }}" placeholder="Nhập tên dịch vụ...">
                    @error('ten_dich_vu')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="don_gia">Đơn Giá:</label>
                    <input type="text" class="form-control" id="don_gia" name="don_gia" value="{{ old('don_gia', $dichvu->don_gia) }}" placeholder="Nhập đơn giá...">
                    @error('don_gia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="so_luong">Số Lượng:</label>
                    <input type="text" class="form-control" id="so_luong" name="so_luong" value="{{ old('so_luong', $dichvu->so_luong) }}" placeholder="Nhập số lượng...">
                    @error('so_luong')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mo_ta">Mô Tả:</label>
                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" placeholder="Nhập mô tả dịch vụ...">{{ old('mo_ta', $dichvu->mo_ta) }}</textarea>
                    @error('mo_ta')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cập Nhật Dịch Vụ</button>
                <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Trở Lại</button>
            </form>
    </div>
@endsection