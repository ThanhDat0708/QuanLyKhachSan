@extends('Admin.layouts.Interface')
@section('title','Quản Lý Phòng')
@section('content')
<div class="container">
        <h1 class="text-center">Danh Sách Quản Lý Phòng</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{route('admin.phong.create')}}" class="btn btn-primary mb-3">Thêm Phòng Mới</a>
    
    {{-- Debug: Kiểm tra số lượng phòng --}}
    <div class="alert alert-info">
        Tổng số phòng: {{ $phongs->total() }} | Trang hiện tại: {{ $phongs->currentPage() }}
    </div>
    
    <table class="table table-bordered mt-3">
        <thead style="background-color: #6366f1; color: white;">
            <tr>
                <th>Mã Phòng</th>
                <th>Tên Phòng</th>
                <th>Hình Ảnh</th>
                <th>Số Lượng Giường</th>
                <th>Giá Phòng</th>
                <th>Mô Tả</th>
                <th>Loại Phòng</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($phongs as $phong)
            <tr>
                <td >{{ $phong->ma_phong }}</td>
                <td style="color: black !important;">{{ $phong->ten_phong }}</td>
                <td><img src="{{ asset('images/' . $phong->anh_phong) }}" alt="{{ $phong->ten_phong }}" width="100"></td>
                <td >{{ $phong->so_luong_giuong }}</td>
                <td >{{ number_format($phong->gia_phong, 0, ',', '.') }} VND</td>
                <td >{{ $phong->mo_ta }}</td>
                <td >{{ $phong->loaiPhong ? $phong->loaiPhong->ten_loai_phong : 'N/A' }}</td>
                <td >{{ $phong->trangThaiPhong ? $phong->trangThaiPhong->ten_trang_thai : 'N/A' }}</td>
            <td>
                <a href="{{ route('admin.phong.edit', $phong->ma_phong) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('admin.phong.destroy', $phong->ma_phong) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng này không?')">Xóa</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $phongs->links() }}
</div>
@endsection
