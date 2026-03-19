@extends('Admin.layouts.Interface')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Sách Đặt Phòng</h3>
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
                                <h5 class="card-title">Tìm Kiếm Đặt Phòng</h5>
                                <form method="GET" action="{{ route('admin.datphong.index') }}" class="row g-3">
                                    <div class="col-md-5">
                                        <input type="text" name="tim_kiem" class="form-control"
                                            placeholder="Nhập mã đặt phòng hoặc tên khách hàng..."
                                            value="{{ $tim_kiem ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="ngay_dat_tu" class="form-control" value="{{ $ngay_dat_tu ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="ngay_dat_den" class="form-control" value="{{ $ngay_dat_den ?? '' }}">
                                    </div>
                                    <div class="col-md-1 d-flex gap-2">
                                        <button type="submit" class="btn btn-info">Tìm</button>
                                        <a href="{{ route('admin.datphong.index') }}" class="btn btn-secondary">Hủy</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <a href="{{ route('admin.datphong.create') }}" class="btn btn-primary mb-3">Thêm Đặt Phòng Mới</a>  
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã Đặt Phòng</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Tên Phòng</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Đặt Phòng</th>
                                    <th>Ngày Nhận Phòng</th>
                                    <th>Ngày Trả Phòng</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($datphongs->count() > 0)
                                    @foreach ($datphongs as $datphong)
                                        <tr>
                                            <td>{{ $datphong->ma_dat_phong }}</td>
                                            <td>{{ $datphong->khachHang->ho_ten ?? 'N/A' }}</td>
                                            <td>{{ $datphong->phong->ten_phong ?? 'N/A' }}</td>
                                            <td>{{ $datphong->trangThaiDatPhong->ten_trang_thai_dat_phong ?? 'N/A' }}</td>
                                            <td>{{ $datphong->ngay_dat_phong }}</td>
                                            <td>{{ $datphong->ngay_nhan_phong }}</td>
                                            <td>{{ $datphong->ngay_tra_phong }}</td>
                                            <td>
                                                <a href="{{ route('admin.datphong.edit', $datphong->ma_dat_phong) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form
                                                    action="{{ route('admin.datphong.destroy', $datphong->ma_dat_phong) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đặt phòng này không?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Không tìm thấy đặt phòng phù hợp.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $datphongs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection