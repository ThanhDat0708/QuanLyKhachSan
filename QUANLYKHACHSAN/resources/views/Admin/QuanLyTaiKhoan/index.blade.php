@extends('Admin.layouts.Interface')

@section('title', 'Quản Lý Tài Khoản')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Quản Lý Tài Khoản</h1>

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

    <a href="{{ route('admin.taikhoan.create') }}" class="btn btn-primary mb-3">Thêm Tài Khoản Mới</a>

    <form action="{{ route('admin.taikhoan.index') }}" method="GET" class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="tu_khoa" class="form-label">Tìm kiếm</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tu_khoa"
                        name="tu_khoa"
                        value="{{ request('tu_khoa') }}"
                        placeholder="Nhập tên người dùng hoặc số điện thoại..."
                    >
                </div>
                <div class="col-md-4">
                    <label for="vai_tro" class="form-label">Lọc theo vai trò</label>
                    <select class="form-control" id="vai_tro" name="vai_tro">
                        <option value="">Tất cả vai trò</option>
                        <option value="admin" {{ request('vai_tro') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="le_tan" {{ request('vai_tro') === 'le_tan' ? 'selected' : '' }}>Lễ tân</option>
                        <option value="nguoi_dung" {{ request('vai_tro') === 'nguoi_dung' ? 'selected' : '' }}>Người dùng</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Tìm kiếm
                    </button>
                    <a href="{{ route('admin.taikhoan.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left me-1"></i> Trở lại
                    </a>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Mã Tài Khoản</th>
                    <th>Tên Người Dùng</th>
                    <th>Số Điện Thoại</th>
                    <th>Vai Trò</th>
                    <th>Ngày Tạo</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($taikhoans as $taikhoan)
                    <tr>
                        <td>{{ $taikhoan->ma_tai_khoan }}</td>
                        <td>{{ $taikhoan->ten_tai_khoan }}</td>
                        <td>{{ $taikhoan->so_dien_thoai }}</td>
                        <td>
                            @if($taikhoan->vai_tro === 'admin')
                                <span class="badge text-bg-danger">Admin</span>
                            @elseif($taikhoan->vai_tro === 'le_tan')
                                <span class="badge text-bg-warning">Lễ tân</span>
                            @else
                                <span class="badge text-bg-primary">Người dùng</span>
                            @endif
                        </td>
                        <td>{{ optional($taikhoan->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.taikhoan.edit', $taikhoan->ma_tai_khoan) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.taikhoan.destroy', $taikhoan->ma_tai_khoan) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có tài khoản nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $taikhoans->links() }}
</div>
@endsection