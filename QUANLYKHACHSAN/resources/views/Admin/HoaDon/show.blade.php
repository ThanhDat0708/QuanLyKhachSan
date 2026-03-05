@extends('Admin.layouts.Interface')
@section('title', 'Chi Tiết Hóa Đơn')
@section('content')
    <style>
        @media print {
            .navbar, .sidebar, .no-print, .main-content { 
                margin: 0 !important; padding: 0 !important; 
            }
            .navbar, .sidebar, .no-print { display: none !important; }
            .card { border: none !important; box-shadow: none !important; }
        }
        .invoice-header { background: linear-gradient(135deg, var(--primary), var(--accent)); color: #fff; padding: 25px; border-radius: 8px 8px 0 0; }
        .invoice-header h2 { margin: 0; }
        .info-label { font-weight: 600; color: #555; }
        .total-row { background-color: #f8f9fa; font-weight: bold; }
        .grand-total { font-size: 1.3rem; color: var(--accent); font-weight: 700; }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- Header --}}
                    <div class="invoice-header text-center">
                        <h2>HÓA ĐƠN THANH TOÁN</h2>
                        <p class="mb-0">Mã hóa đơn: <strong>#{{ $hoadon->ma_hoa_don }}</strong> &mdash; Ngày lập: {{ \Carbon\Carbon::parse($hoadon->ngay_lap_hoa_don)->format('d/m/Y') }}</p>
                    </div>

                    <div class="card-body">
                        {{-- Thông tin khách hàng & phòng --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="mb-3" style="color: var(--primary);"><i class="fas fa-user"></i> Thông Tin Khách Hàng</h5>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="info-label" style="width:40%;">Họ tên:</td>
                                        <td>{{ $hoadon->datPhong->khachHang->ho_ten ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Số điện thoại:</td>
                                        <td>{{ $hoadon->datPhong->khachHang->so_dien_thoai ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Email:</td>
                                        <td>{{ $hoadon->datPhong->khachHang->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">CCCD:</td>
                                        <td>{{ $hoadon->datPhong->khachHang->cccd ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Địa chỉ:</td>
                                        <td>{{ $hoadon->datPhong->khachHang->dia_chi ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3" style="color: var(--primary);"><i class="fas fa-bed"></i> Thông Tin Phòng</h5>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="info-label" style="width:40%;">Tên phòng:</td>
                                        <td>{{ $hoadon->datPhong->phong->ten_phong ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Loại phòng:</td>
                                        <td>{{ $hoadon->datPhong->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Giá phòng/ngày:</td>
                                        <td>{{ number_format($hoadon->datPhong->phong->gia_phong ?? 0, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Ngày nhận phòng:</td>
                                        <td>{{ \Carbon\Carbon::parse($hoadon->datPhong->ngay_nhan_phong)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Ngày trả phòng:</td>
                                        <td>{{ \Carbon\Carbon::parse($hoadon->datPhong->ngay_tra_phong)->format('d/m/Y') }}</td>
                                    </tr>
                                    @php
                                        $soNgay = max(1, \Carbon\Carbon::parse($hoadon->datPhong->ngay_nhan_phong)->diffInDays(\Carbon\Carbon::parse($hoadon->datPhong->ngay_tra_phong)));
                                    @endphp
                                    <tr>
                                        <td class="info-label">Số ngày ở:</td>
                                        <td><strong>{{ $soNgay }} ngày</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        {{-- Bảng dịch vụ đã sử dụng --}}
                        <h5 class="mb-3" style="color: var(--primary);"><i class="fas fa-concierge-bell"></i> Dịch Vụ Đã Sử Dụng</h5>
                        @if ($hoadon->datPhong->suDungDichVus && $hoadon->datPhong->suDungDichVus->count() > 0)
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên Dịch Vụ</th>
                                        <th>Đơn Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Thành Tiền</th>
                                        <th>Ngày Sử Dụng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hoadon->datPhong->suDungDichVus as $index => $sudung)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $sudung->dichVu->ten_dich_vu ?? 'N/A' }}</td>
                                            <td>{{ number_format($sudung->don_gia, 0, ',', '.') }} đ</td>
                                            <td>{{ $sudung->so_luong }}</td>
                                            <td>{{ number_format($sudung->thanh_tien, 0, ',', '.') }} đ</td>
                                            <td>{{ $sudung->ngay_su_dung ? \Carbon\Carbon::parse($sudung->ngay_su_dung)->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted"><em>Không có dịch vụ nào được sử dụng.</em></p>
                        @endif

                        <hr>

                        {{-- Tổng tiền --}}
                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-sm">
                                    <tr>
                                        <td class="info-label">Tiền phòng ({{ $soNgay }} ngày x {{ number_format($hoadon->datPhong->phong->gia_phong ?? 0, 0, ',', '.') }} đ):</td>
                                        <td class="text-end">{{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Tiền dịch vụ:</td>
                                        <td class="text-end">{{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr class="total-row">
                                        <td class="info-label" style="font-size: 1.1rem;">TỔNG THANH TOÁN:</td>
                                        <td class="text-end grand-total">{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        {{-- Chữ ký --}}
                        <div class="row mt-4 text-center">
                            <div class="col-6">
                                <p><strong>Khách hàng</strong></p>
                                <p class="text-muted"><em>(Ký, ghi rõ họ tên)</em></p>
                                <br><br><br>
                            </div>
                            <div class="col-6">
                                <p><strong>Nhân viên lập hóa đơn</strong></p>
                                <p class="text-muted"><em>(Ký, ghi rõ họ tên)</em></p>
                                <br><br><br>
                            </div>
                        </div>

                        {{-- Nút hành động --}}
                        <div class="no-print mt-3">
                            <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">← Quay lại</a>
                            <a href="{{ route('admin.hoadon.edit', $hoadon->ma_hoa_don) }}" class="btn btn-warning">Sửa</a>
                            <button onclick="window.print()" class="btn btn-primary">🖨️ In Hóa Đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
