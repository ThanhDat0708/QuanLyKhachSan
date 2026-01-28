@extends('Admin.layouts.Interface')
@section('title','Quản Lý Loại Phòng')
@section('content')
<div class="container">
    <h1 class="text-center">Danh Sách Loại Phòng</h1>
    
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
    
    <a href="{{route('admin.loaiphong.create')}}" class="btn btn-primary mb-3">Thêm Loại Phòng Mới</a>
    <table class="table table-bordered mt-3" style="color: white;">
        <thead>
            <tr>
                <th>Mã Loại Phòng</th>
                <th>Tên Loại Phòng</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loaiphongs as $loaiphong)
            <tr>
                <td>{{ $loaiphong->ma_loai_phong }}</td>
                <td>{{ $loaiphong->ten_loai_phong }}</td>   
                <td>
                    <a href="{{ route('admin.loaiphong.edit', $loaiphong->ma_loai_phong) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.loaiphong.destroy', $loaiphong->ma_loai_phong) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa loại phòng này không?')">Xóa</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
 {{ $loaiphongs->links() }}
</div>
@endsection