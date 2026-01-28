@extends('Admin.layouts.Interface')
@section('title','Quản Lý Trạng Thái Phòng')
@section('content')
<div class="container">
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
    
    <a href="{{route('admin.trangthaiphong.create')}}" class="btn btn-primary mb-3">Thêm Trạng Thái Phòng Mới</a>
    <table class="table table-bordered mt-3" style="color: white;">
        <thead>
            <tr>
                <th>Mã Trạng Thái Phòng</th>
                <th>Tên Trạng Thái Phòng</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trangthaiphongs as $trangthaiphong)
            <tr>
                <td>{{ $trangthaiphong->ma_trang_thai }}</td>
                <td>{{ $trangthaiphong->ten_trang_thai }}</td>   
                <td>
                    <a href="{{ route('admin.trangthaiphong.edit', $trangthaiphong->ma_trang_thai) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.trangthaiphong.destroy', $trangthaiphong->ma_trang_thai) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa loại phòng này không?')">Xóa</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
 {{ $trangthaiphongs->links() }}
</div>
@endsection