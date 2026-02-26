@extends('Admin.layouts.Interface')
@section('title', 'Chi Tiết Hóa Đơn')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi Tiết Hóa Đơn #{{ $hoadon->ma_hoa_don }}</h2>
        <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <!-- Thông tin trạng thái -->
    <div class="alert {{ $hoadon->daThanhToan() ? 'alert-success' : 'alert-warning' }}">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas {{ $hoadon->daThanhToan() ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                <strong>Trạng thái: </strong>
                @if($hoadon->daThanhToan())
                    <span class="badge bg-success">ĐÃ THANH TOÁN</span>
                @else
                    <span class="badge bg-warning text-dark">CHƯA THANH TOÁN</span>
                @endif
            </div>
            <div>
                <strong>Ngày lập:</strong> {{ \Carbon\Carbon::parse($hoadon->ngay_lap_hoa_don)->format('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Thông tin khách hàng -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Thông Tin Khách Hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td width="40%"><strong>Họ tên:</strong></td>
                            <td>{{ $hoadon->datPhong->khachHang->ho_ten ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại:</strong></td>
                            <td>{{ $hoadon->datPhong->khachHang->so_dien_thoai ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $hoadon->datPhong->khachHang->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>CCCD:</strong></td>
                            <td>{{ $hoadon->datPhong->khachHang->cccd ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ:</strong></td>
                            <td>{{ $hoadon->datPhong->khachHang->dia_chi ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Thông tin đặt phòng -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-bed"></i> Thông Tin Đặt Phòng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td width="40%"><strong>Mã đặt phòng:</strong></td>
                            <td>{{ $hoadon->ma_dat_phong }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên phòng:</strong></td>
                            <td>{{ $hoadon->datPhong->phong->ten_phong ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Loại phòng:</strong></td>
                            <td>{{ $hoadon->datPhong->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Giá phòng/ngày:</strong></td>
                            <td>{{ number_format($hoadon->datPhong->phong->gia_phong ?? 0, 0, ',', '.') }} đ</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày nhận:</strong></td>
                            <td>{{ \Carbon\Carbon::parse($hoadon->datPhong->ngay_nhan_phong)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày trả:</strong></td>
                            <td>{{ \Carbon\Carbon::parse($hoadon->datPhong->ngay_tra_phong)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số ngày ở:</strong></td>
                            <td>
                                {{ \Carbon\Carbon::parse($hoadon->datPhong->ngay_nhan_phong)->diffInDays(\Carbon\Carbon::parse($hoadon->datPhong->ngay_tra_phong)) ?: 1 }} ngày
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chi tiết dịch vụ đã sử dụng -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-concierge-bell"></i> Dịch Vụ Đã Sử Dụng</h5>
        </div>
        <div class="card-body">
            @if($hoadon->datPhong->suDungDichVus->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên Dịch Vụ</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hoadon->datPhong->suDungDichVus as $index => $sdDV)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sdDV->dichVu->ten_dich_vu ?? 'N/A' }}</td>
                                <td>{{ number_format($sdDV->don_gia, 0, ',', '.') }} đ</td>
                                <td>{{ $sdDV->so_luong }}</td>
                                <td class="text-end">{{ number_format($sdDV->thanh_tien, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle"></i> Khách hàng không sử dụng dịch vụ nào.
                </div>
            @endif
        </div>
    </div>

    <!-- Tổng kết thanh toán -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-calculator"></i> Tổng Kết Thanh Toán</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <td width="70%" class="h5">Tiền phòng:</td>
                    <td class="text-end h5">{{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</td>
                </tr>
                <tr>
                    <td width="70%" class="h5">Tiền dịch vụ:</td>
                    <td class="text-end h5">{{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</td>
                </tr>
                <tr class="border-top border-2">
                    <td width="70%" class="h4"><strong>TỔNG THANH TOÁN:</strong></td>
                    <td class="text-end h4">
                        <strong class="text-danger">{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Các hành động -->
    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        
        <div>
            @if($hoadon->coTheHuy())
                <form action="{{ route('admin.hoadon.cancel', $hoadon->ma_hoa_don) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Bạn có chắc chắn muốn hủy hóa đơn này?\nLưu ý: Chỉ có thể hủy hóa đơn chưa thanh toán.')">
                        <i class="fas fa-times"></i> Hủy Hóa Đơn
                    </button>
                </form>
            @endif
            
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> In Hóa Đơn
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn, .alert, .card-header {
            display: none !important;
        }
    }
</style>
@endsection
