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
                                @foreach ($hoadons as $hoadon)
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
                                @endforeach
                            </tbody>
                        </table>
                        {{ $hoadons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection