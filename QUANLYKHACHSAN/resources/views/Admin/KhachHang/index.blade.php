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
                                    <th>Tài Khoản</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($khachhangs as $khachhang)
                                    <tr>
                                        <td>{{ $khachhang->ma_khach_hang }}</td>
                                        <td>{{ $khachhang->ten_khach_hang }}</td>
                                        <td>{{ $khachhang->so_dien_thoai }}</td>
                                        <td>{{ $khachhang->email }}</td>
                                        <td>{{ $khachhang->dia_chi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Mã Khách Hàng</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Email</th>
                                    <th>Địa Chỉ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
