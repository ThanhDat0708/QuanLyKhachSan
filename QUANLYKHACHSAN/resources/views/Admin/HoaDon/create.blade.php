@extends('Admin.layouts.Interface')
@section('title', 'Tạo Hóa Đơn Mới')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Tạo Hóa Đơn Mới</h4>
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

        <form action="{{ route('admin.hoadon.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="ma_dat_phong">Chọn Đặt Phòng <span class="text-danger">*</span></label>
                <select class="form-control" id="ma_dat_phong" name="ma_dat_phong" required>
                    <option value="">-- Chọn đặt phòng --</option>
                    @foreach ($datphongs as $datphong)
                        <option value="{{ $datphong->ma_dat_phong }}" {{ old('ma_dat_phong') == $datphong->ma_dat_phong ? 'selected' : '' }}>
                            #{{ $datphong->ma_dat_phong }} - 
                            {{ $datphong->khachHang->ho_ten ?? 'N/A' }} - 
                            Phòng: {{ $datphong->phong->ten_phong ?? 'N/A' }} - 
                            ({{ \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($datphong->ngay_tra_phong)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hiển thị thông tin chi tiết khi chọn đặt phòng -->
            <div id="booking-details" class="card mt-3" style="display: none; background: #f8f9fa;">
                <div class="card-header">
                    <strong>Thông tin đặt phòng</strong>
                </div>
                <div class="card-body" id="booking-info">
                    <!-- Thông tin sẽ được load bằng JavaScript -->
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    ✅ Tạo Hóa Đơn
                </button>
                <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">
                    ← Quay lại
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('ma_dat_phong').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var detailsDiv = document.getElementById('booking-details');
    
    if (this.value) {
        detailsDiv.style.display = 'block';
        document.getElementById('booking-info').innerHTML = '<p>Đã chọn: <strong>' + selectedOption.text + '</strong></p><p class="text-muted">Hệ thống sẽ tự động tính toán tiền phòng và dịch vụ khi tạo hóa đơn.</p>';
    } else {
        detailsDiv.style.display = 'none';
    }
});
</script>
@endsection