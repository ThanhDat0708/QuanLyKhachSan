@extends('Admin.layouts.Interface')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Sách Khách Hàng</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tìm Kiếm Khách Hàng</h5>
                                <form method="GET" action="{{ route('admin.khachhang.index') }}" class="row g-3">
                                    <div class="col-md-8">
                                        <input type="text" name="tim_kiem" class="form-control"
                                            placeholder="Nhập tên khách hàng hoặc số điện thoại..."
                                            value="{{ $tim_kiem ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-info w-100">Tìm Kiếm</button>
                                        <a href="{{ route('admin.khachhang.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <a href="{{ route('admin.khachhang.create') }}" class="btn btn-primary mb-3">Thêm Khách Hàng Mới</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã Khách Hàng</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Ngày Sinh</th>
                                    <th>Giới Tính</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th>Căn Cước Công Dân</th>
                                    <th>Email</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($khachhangs->count() > 0)
                                    @foreach ($khachhangs as $khachhang)
                                        <tr>
                                            <td>{{ $khachhang->ma_khach_hang }}</td>
                                            <td>{{ $khachhang->ho_ten }}</td>
                                            <td>{{ $khachhang->ngay_sinh }}</td>
                                            <td>{{ $khachhang->gioi_tinh }}</td>
                                            <td>{{ $khachhang->so_dien_thoai }}</td>
                                            <td>{{ $khachhang->dia_chi }}</td>
                                            <td>{{ $khachhang->cccd }}</td>
                                            <td>{{ $khachhang->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.khachhang.edit', $khachhang->ma_khach_hang) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form
                                                    action="{{ route('admin.khachhang.destroy', $khachhang->ma_khach_hang) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Không tìm thấy khách hàng phù hợp.</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                        {{ $khachhangs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
