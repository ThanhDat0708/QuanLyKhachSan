@extends('Admin.layouts.Interface')
@section('title','Quản Lý Trạng Thái Phòng')
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Danh Sách Trạng Thái Phòng</h1>

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

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Tổng số trạng thái phòng</p>
                    <h3 class="mb-0 fw-bold text-primary">{{ $tongTrangThaiPhong }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Tổng số phòng hiện có</p>
                    <h3 class="mb-0 fw-bold text-success">{{ $tongSoPhong }}</h3>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.trangthaiphong.index') }}" class="row g-2 align-items-center mb-3">
        <div class="col-md-8">
            <input
                type="text"
                name="q"
                class="form-control"
                value="{{ $tuKhoa }}"
                placeholder="Tìm theo tên trạng thái phòng..."
            >
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-outline-primary w-100">Tìm kiếm</button>
            <a href="{{ route('admin.trangthaiphong.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
        </div>
    </form>
    
    <a href="{{route('admin.trangthaiphong.create')}}" class="btn btn-primary mb-3">Thêm Trạng Thái Phòng Mới</a>
    <table class="table table-bordered mt-3 table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Mã Trạng Thái Phòng</th>
                <th>Tên Trạng Thái Phòng</th>
                <th>Số Phòng Thuộc Trạng Thái</th>
                <th>Ngày Tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($trangthaiphongs as $trangthaiphong)
            <tr>
                <td>{{ $trangthaiphong->ma_trang_thai }}</td>
                <td>{{ $trangthaiphong->ten_trang_thai }}</td>
                <td>{{ $trangthaiphong->phongs_count }}</td>
                <td>{{ optional($trangthaiphong->created_at)->format('d/m/Y H:i') ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.trangthaiphong.show', $trangthaiphong->ma_trang_thai) }}" class="btn btn-info text-white">Xem</a>
                    <a href="{{ route('admin.trangthaiphong.edit', $trangthaiphong->ma_trang_thai) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.trangthaiphong.destroy', $trangthaiphong->ma_trang_thai) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa trạng thái phòng này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Không tìm thấy trạng thái phòng phù hợp.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
 {{ $trangthaiphongs->links() }}
</div>
@endsection