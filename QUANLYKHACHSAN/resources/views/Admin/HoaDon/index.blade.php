@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Quản Lý Hóa Đơn</h2>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> 
            Hóa đơn được tạo tự động khi <strong>Trả phòng</strong> từ module Đặt phòng.
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã HĐ</th>
                    <th>Mã ĐP</th>
                    <th>Khách Hàng</th>
                    <th>Phòng</th>
                    <th>Tiền Phòng</th>
                    <th>Tiền DV</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Lập</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hoadons as $hoadon)
                    <tr>
                        <td>{{ $hoadon->ma_hoa_don }}</td>
                        <td>{{ $hoadon->ma_dat_phong }}</td>
                        <td>{{ $hoadon->datPhong->khachHang->ho_ten ?? 'N/A' }}</td>
                        <td>{{ $hoadon->datPhong->phong->ten_phong ?? 'N/A' }}</td>
                        <td>{{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</td>
                        <td>{{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</td>
                        <td><strong class="text-danger">{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</strong></td>
                        <td>{{ \Carbon\Carbon::parse($hoadon->ngay_lap_hoa_don)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($hoadon->daThanhToan())
                                <span class="badge bg-success">Đã thanh toán</span>
                            @else
                                <span class="badge bg-warning text-dark">Chưa thanh toán</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.hoadon.show', $hoadon->ma_hoa_don) }}"
                                class="btn btn-sm btn-info text-white" title="Xem chi tiết">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            
                            @if($hoadon->coTheHuy())
                                <form action="{{ route('admin.hoadon.cancel', $hoadon->ma_hoa_don) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hủy hóa đơn"
                                        onclick="return confirm('Bạn có chắc chắn muốn hủy hóa đơn này?\nLưu ý: Chỉ có thể hủy hóa đơn chưa thanh toán.')">
                                        <i class="fas fa-times"></i> Hủy
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled title="Không thể hủy hóa đơn đã thanh toán">
                                    <i class="fas fa-lock"></i> Đã thanh toán
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">
                            <i class="fas fa-inbox"></i> Chưa có hóa đơn nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $hoadons->links() }}
        </div>
    </div>
@endsection
