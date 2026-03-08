@extends('NguoiDung.layouts.app')

@section('title', 'Đặt phòng — ' . $phong->ten_phong)
@section('page-heading', 'Đặt phòng')

@section('content')
<a href="{{ route('nguoidung.datphong.danhsach') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none mb-4" style="color:#64748b; font-size:.88rem;">
    <i class="fas fa-arrow-left"></i> Quay lại danh sách
</a>

<div class="row g-4">
    {{-- Room Info --}}
    <div class="col-lg-5">
        <div class="card-modern overflow-hidden h-100">
            @if($phong->anh_phong)
                <img src="{{ asset('images/' . $phong->anh_phong) }}" alt="{{ $phong->ten_phong }}" style="width:100%; height:240px; object-fit:cover;">
            @else
                <div style="width:100%; height:240px; background:linear-gradient(135deg,#4f46e5,#818cf8); display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-bed fa-4x" style="color:rgba(255,255,255,.25);"></i>
                </div>
            @endif
            <div class="p-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge-status" style="background:rgba(79,70,229,.1); color:#4f46e5;">{{ $phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</span>
                </div>
                <h5 class="fw-bold mb-3" style="color:#1e293b;">{{ $phong->ten_phong }}</h5>
                
                <div class="d-flex flex-wrap gap-3 mb-3" style="font-size:.84rem; color:#64748b;">
                    <span><i class="fas fa-bed me-1"></i> {{ $phong->so_luong_giuong ?? 0 }} giường</span>
                    <span><i class="fas fa-wifi me-1"></i> Wifi miễn phí</span>
                    <span><i class="fas fa-snowflake me-1"></i> Máy lạnh</span>
                </div>
                
                @if($phong->mo_ta)
                    <p class="text-muted mb-3" style="font-size:.88rem; line-height:1.6;">{{ $phong->mo_ta }}</p>
                @endif
                
                <div style="padding:14px 18px; background:rgba(79,70,229,.04); border-radius:12px; border:1px solid rgba(79,70,229,.1);">
                    <div class="d-flex align-items-center justify-content-between">
                        <span style="color:#64748b; font-size:.85rem;">Giá phòng</span>
                        <span style="color:#4f46e5; font-size:1.3rem; font-weight:700;">{{ number_format($phong->gia_phong, 0, ',', '.') }}đ<small style="font-size:.7rem; font-weight:400; color:#94a3b8;"> / đêm</small></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Form --}}
    <div class="col-lg-7">
        <div class="card-modern h-100">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
                <h6 class="fw-bold mb-1" style="color:#1e293b;"><i class="fas fa-calendar-plus text-primary me-2"></i>Thông tin đặt phòng</h6>
                <small class="text-muted">Chọn ngày nhận và trả phòng</small>
            </div>
            <div class="p-4">
                @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" style="border-radius:10px; border:none; background:rgba(239,68,68,.08); color:#dc2626;">
                        <i class="fas fa-triangle-exclamation mt-1"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-start gap-2 mb-4">
                        <i class="fas fa-circle-xmark mt-1"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('nguoidung.datphong.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ma_phong" value="{{ $phong->ma_phong }}">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-calendar-check text-success me-1"></i> Ngày nhận phòng
                            </label>
                            <input type="date" class="form-control" id="ngay_nhan_phong"
                                name="ngay_nhan_phong" value="{{ old('ngay_nhan_phong', date('Y-m-d')) }}"
                                min="{{ date('Y-m-d') }}" required
                                style="border-radius:10px; padding:10px 14px; border-color:#e2e8f0;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-calendar-xmark text-danger me-1"></i> Ngày trả phòng
                            </label>
                            <input type="date" class="form-control" id="ngay_tra_phong"
                                name="ngay_tra_phong" value="{{ old('ngay_tra_phong') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                style="border-radius:10px; padding:10px 14px; border-color:#e2e8f0;">
                        </div>
                    </div>

                    {{-- Cost Preview --}}
                    <div id="preview-cost" style="display:none; padding:20px; background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0; margin-bottom:20px;">
                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.88rem;">
                            <span class="text-muted">Số đêm lưu trú</span>
                            <span class="fw-bold" style="color:#1e293b;" id="so-dem">0 đêm</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.88rem;">
                            <span class="text-muted">Đơn giá</span>
                            <span>{{ number_format($phong->gia_phong, 0, ',', '.') }}đ / đêm</span>
                        </div>
                        <hr style="border-color:#e2e8f0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color:#1e293b;">Tạm tính</span>
                            <span class="fw-bold" style="color:#4f46e5; font-size:1.2rem;" id="tam-tinh">0đ</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary-gradient w-100" style="padding:12px;">
                        <i class="fas fa-check-circle me-1"></i> Xác nhận đặt phòng
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const giaPhong = {{ $phong->gia_phong }};
    const ngayNhan = document.getElementById('ngay_nhan_phong');
    const ngayTra = document.getElementById('ngay_tra_phong');
    const preview = document.getElementById('preview-cost');
    const soDem = document.getElementById('so-dem');
    const tamTinh = document.getElementById('tam-tinh');

    function tinhTien() {
        if (ngayNhan.value && ngayTra.value) {
            const d1 = new Date(ngayNhan.value);
            const d2 = new Date(ngayTra.value);
            const diff = Math.ceil((d2 - d1) / (1000 * 60 * 60 * 24));
            if (diff > 0) {
                preview.style.display = 'block';
                soDem.textContent = diff + ' đêm';
                tamTinh.textContent = (diff * giaPhong).toLocaleString('vi-VN') + 'đ';
            } else {
                preview.style.display = 'none';
            }
        }
    }

    ngayNhan.addEventListener('change', function() {
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        ngayTra.min = nextDay.toISOString().split('T')[0];
        if (ngayTra.value && ngayTra.value <= this.value) {
            ngayTra.value = nextDay.toISOString().split('T')[0];
        }
        tinhTien();
    });

    ngayTra.addEventListener('change', tinhTien);
    tinhTien();
</script>
@endsection
