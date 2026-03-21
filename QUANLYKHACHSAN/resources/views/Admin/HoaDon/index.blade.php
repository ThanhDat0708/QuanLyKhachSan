@extends('Admin.layouts.Interface')
@section('title', 'Danh Sách Hóa Đơn')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Sách Hóa Đơn</h3>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Tổng số hóa đơn</p>
                                        <h4 class="mb-0 fw-bold text-primary">{{ $tongSoHoaDon }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Số hóa đơn trong tháng</p>
                                        <h4 class="mb-0 fw-bold text-success">{{ $soHoaDonTrongThang }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tìm Kiếm Hóa Đơn</h5>
                                <form method="GET" action="{{ route('admin.hoadon.index') }}" class="row g-3">
                                    <div class="col-md-4">
                                        <input
                                            type="text"
                                            name="tim_kiem"
                                            class="form-control"
                                            placeholder="Tên khách hàng hoặc tên phòng..."
                                            value="{{ $tim_kiem ?? '' }}"
                                        >
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="ngay_lap_tu" class="form-control" value="{{ $ngay_lap_tu ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="ngay_lap_den" class="form-control" value="{{ $ngay_lap_den ?? '' }}">
                                    </div>
                                    <div class="col-md-2 d-flex gap-2">
                                        <button type="submit" class="btn btn-info">Tìm</button>
                                        <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">Đặt lại</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <a href="{{ route('admin.hoadon.create') }}" class="btn btn-primary mb-3">Tạo Hóa Đơn Mới</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã HĐ</th>
                                    <th>Khách Hàng</th>
                                    <th>Phòng</th>
                                    <th>Ngày Lập</th>
                                    <th>Tiền Phòng</th>
                                    <th>Tiền Dịch Vụ</th>
                                    <th>Tổng Tiền</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hoadons as $hoadon)
                                    <tr>
                                        <td>{{ $hoadon->ma_hoa_don }}</td>
                                        <td>{{ $hoadon->datPhong->khachHang->ho_ten ?? 'N/A' }}</td>
                                        <td>{{ $hoadon->datPhong->phong->ten_phong ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($hoadon->ngay_lap_hoa_don)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</td>
                                        <td>{{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</td>
                                        <td><strong>{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</strong></td>
                                        <td>
                                            <a href="{{ route('admin.hoadon.show', $hoadon->ma_hoa_don) }}"
                                                class="btn btn-info btn-sm">Xem</a>
                                            <a href="{{ route('admin.hoadon.edit', $hoadon->ma_hoa_don) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('admin.hoadon.destroy', $hoadon->ma_hoa_don) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này không?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Không tìm thấy hóa đơn phù hợp.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $hoadons->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection