@extends('Admin.layouts.Interface')
@section('title', 'Chi Tiết Đặt Phòng')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Chi Tiết Đơn Đặt Phòng #{{ $datphong->ma_dat_phong }}</h3>
                    <a href="{{ route('admin.datphong.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Khách hàng</label>
                            <div class="fw-bold">{{ $datphong->khachHang->ho_ten ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Phòng</label>
                            <div class="fw-bold">{{ $datphong->phong->ten_phong ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Loại phòng</label>
                            <div class="fw-bold">{{ $datphong->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Trạng thái đơn</label>
                            <div class="fw-bold">{{ $datphong->trangThaiDatPhong->ten_trang_thai_dat_phong ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Ngày đặt phòng</label>
                            <div class="fw-bold">{{ optional($datphong->ngay_dat_phong)->format('d/m/Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Ngày nhận phòng</label>
                            <div class="fw-bold">{{ optional($datphong->ngay_nhan_phong)->format('d/m/Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Ngày trả phòng</label>
                            <div class="fw-bold">{{ optional($datphong->ngay_tra_phong)->format('d/m/Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Tổng tiền phòng (ước tính)</label>
                            <div class="fw-bold text-primary">{{ number_format($datphong->tinhTongTienPhong(), 0, ',', '.') }} đ</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Tổng tiền dịch vụ</label>
                            <div class="fw-bold text-success">{{ number_format($datphong->tinhTongTienDichVu(), 0, ',', '.') }} đ</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <form action="{{ route('admin.datphong.xacnhan', $datphong->ma_dat_phong) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success" onclick="return confirm('Xác nhận nhanh đơn đặt phòng này?')">Xác nhận</button>
                    </form>
                    <form action="{{ route('admin.datphong.huydon', $datphong->ma_dat_phong) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary" onclick="return confirm('Hủy đơn đặt phòng này?')">Hủy</button>
                    </form>
                    <a href="{{ route('admin.datphong.edit', $datphong->ma_dat_phong) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.datphong.destroy', $datphong->ma_dat_phong) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đặt phòng này không?')">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
