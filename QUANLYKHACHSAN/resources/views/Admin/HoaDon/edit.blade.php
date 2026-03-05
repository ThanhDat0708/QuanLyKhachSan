@extends('Admin.layouts.Interface')
@section('title', 'Sửa Hóa Đơn')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Sửa Hóa Đơn #{{ $hoadon->ma_hoa_don }}</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hoadon.update', $hoadon->ma_hoa_don) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="ma_dat_phong">Chọn Đặt Phòng <span class="text-danger">*</span></label>
                <select class="form-control" id="ma_dat_phong" name="ma_dat_phong" required>
                    <option value="">-- Chọn đặt phòng --</option>
                    @foreach ($datphongs as $datphong)
                        <option value="{{ $datphong->ma_dat_phong }}" {{ $hoadon->ma_dat_phong == $datphong->ma_dat_phong ? 'selected' : '' }}>
                            #{{ $datphong->ma_dat_phong }} - 
                            {{ $datphong->khachHang->ho_ten ?? 'N/A' }} - 
                            Phòng: {{ $datphong->phong->ten_phong ?? 'N/A' }} - 
                            ({{ \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($datphong->ngay_tra_phong)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hiển thị thông tin hiện tại -->
            <div class="card mt-3" style="background: #f8f9fa;">
                <div class="card-header">
                    <strong>Thông tin hóa đơn hiện tại</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Tiền phòng:</strong> {{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Tiền dịch vụ:</strong> {{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Tổng thanh toán:</strong> <span class="text-success">{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</span></p>
                        </div>
                    </div>
                    <p class="text-muted mb-0"><em>* Khi cập nhật, hệ thống sẽ tự động tính lại tổng tiền.</em></p>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    ✅ Cập Nhật Hóa Đơn
                </button>
                <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">
                    ← Quay lại
                </a>
            </div>
        </form>
    </div>
</div>
@endsection