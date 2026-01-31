@extends('NguoiDung.layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    @if($khachhang)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Họ và tên</th>
                                        <td>{{ $khachhang->ho_ten ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                
                                    <tr>
                                        <th>Giới tính</th>
                                        <td>{{ $khachhang->gioi_tinh ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày sinh</th>
                                        <td>
                                            @if($khachhang->ngay_sinh)
                                                {{ date('d/m/Y', strtotime($khachhang->ngay_sinh)) }}
                                            @else
                                                Chưa cập nhật
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{ $khachhang->so_dien_thoai ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $khachhang->email ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td>{{ $khachhang->dia_chi ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <th>CMND/CCCD</th>
                                        <td>{{ $khachhang->cccd ?? 'Chưa cập nhật' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ date('d/m/Y H:i', strtotime($khachhang->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cập nhật lần cuối</th>
                                        <td>{{ date('d/m/Y H:i', strtotime($khachhang->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Cập nhật thông tin
                            </a>
                            <a href="{{ route('nguoidung.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            Bạn chưa cập nhật thông tin cá nhân. Vui lòng cập nhật để sử dụng đầy đủ các tính năng.
                        </div>
                        <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm thông tin cá nhân
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
