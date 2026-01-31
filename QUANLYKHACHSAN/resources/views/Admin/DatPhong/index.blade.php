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
                            </tbody>
                        </table>
                        {{ $datphongs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection