@extends('NguoiDung.layouts.app')

@section('title', 'Đặt phòng thành công')
@section('page-heading', 'Đặt phòng thành công')

@section('content')
<div style="min-height:calc(100vh - 200px); display:flex; align-items:center; justify-content:center; padding:40px 0;">
    <div style="width:100%; max-width:700px;">
        {{-- Success Icon --}}
        <div style="text-align:center; margin-bottom:40px;">
            <div style="width:120px; height:120px; border-radius:50%; background:linear-gradient(135deg, rgba(16,185,129,.15), rgba(6,182,212,.15)); display:flex; align-items:center; justify-content:center; margin:0 auto 24px; animation:scaleIn .6s ease-out;">
                <i class="fas fa-check" style="font-size:3rem; color:#059669;"></i>
            </div>
            <h2 class="fw-bold mb-2" style="color:#1e293b; font-size:2rem;">Đặt phòng thành công!</h2>
            <p class="text-muted mb-0" style="font-size:1rem;">Cảm ơn bạn đã đặt phòng tại khách sạn DNC</p>
        </div>

        {{-- Booking Info Card --}}
        <div class="card-modern mb-4">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important; background:linear-gradient(135deg, rgba(79,70,229,.03), rgba(6,182,212,.03));">
                <h6 class="fw-bold mb-1" style="color:#1e293b;"><i class="fas fa-receipt text-primary me-2"></i>Mã đặt phòng của bạn</h6>
                <p class="text-muted mb-0" style="font-size:.88rem;">Lưu mã này để theo dõi đơn đặt phòng của bạn</p>
            </div>
            <div class="p-4 text-center" style="background:#f8fafc;">
                <p style="font-size:.9rem; color:#64748b; margin-bottom:8px;">Mã đặt phòng</p>
                <p class="fw-bold" style="font-size:1.8rem; color:#4f46e5; font-family:monospace; letter-spacing:2px;">#{{ str_pad($datPhong->ma_dat_phong, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        {{-- Booking Details --}}
        <div class="card-modern mb-4">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
                <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-door-open text-primary me-2"></i>Thông tin phòng</h6>
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p style="font-size:.85rem; color:#64748b; margin-bottom:4px;">Tên phòng</p>
                        <p class="fw-semibold" style="color:#1e293b; font-size:1.05rem;">{{ $datPhong->phong->ten_phong ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:.85rem; color:#64748b; margin-bottom:4px;">Loại phòng</p>
                        <span class="badge-status" style="background:rgba(79,70,229,.1); color:#4f46e5;">
                            {{ $datPhong->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Booking Dates --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card-modern h-100">
                    <div class="p-4" style="background:rgba(16,185,129,.03); border-bottom:2px solid rgba(16,185,129,.1);">
                        <p style="font-size:.85rem; color:#64748b; margin-bottom:4px;"><i class="fas fa-calendar-check text-success me-1"></i> Ngày nhận phòng</p>
                        <p class="fw-bold" style="color:#1e293b; font-size:1.2rem;">{{ \Carbon\Carbon::parse($datPhong->ngay_nhan_phong)->format('d/m/Y') }}</p>
                        <p style="font-size:.8rem; color:#64748b;">{{ \Carbon\Carbon::parse($datPhong->ngay_nhan_phong)->format('l') }}</p>
                    </div>
                    <div class="p-3" style="background:#fafbfc; text-align:center;">
                        <p style="font-size:.8rem; color:#94a3b8; margin:0;">Từ 14:00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-modern h-100">
                    <div class="p-4" style="background:rgba(239,68,68,.03); border-bottom:2px solid rgba(239,68,68,.1);">
                        <p style="font-size:.85rem; color:#64748b; margin-bottom:4px;"><i class="fas fa-calendar-xmark text-danger me-1"></i> Ngày trả phòng</p>
                        <p class="fw-bold" style="color:#1e293b; font-size:1.2rem;">{{ \Carbon\Carbon::parse($datPhong->ngay_tra_phong)->format('d/m/Y') }}</p>
                        <p style="font-size:.8rem; color:#64748b;">{{ \Carbon\Carbon::parse($datPhong->ngay_tra_phong)->format('l') }}</p>
                    </div>
                    <div class="p-3" style="background:#fafbfc; text-align:center;">
                        <p style="font-size:.8rem; color:#94a3b8; margin:0;">Trước 12:00</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cost Summary --}}
        <div class="card-modern mb-4">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
                <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-calculator text-primary me-2"></i>Chi tiết chi phí</h6>
            </div>
            <div class="p-4">
                @php
                    $ngay_nhan = \Carbon\Carbon::parse($datPhong->ngay_nhan_phong);
                    $ngay_tra = \Carbon\Carbon::parse($datPhong->ngay_tra_phong);
                    $so_dem = $ngay_tra->diffInDays($ngay_nhan);
                    $gia_phong = $datPhong->phong->gia_phong ?? 0;
                    $tong_tien = $so_dem * $gia_phong;
                @endphp
                
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #e2e8f0;">
                    <span style="color:#64748b;">{{ $so_dem }} đêm × {{ number_format($gia_phong, 0, ',', '.') }}đ</span>
                    <span class="fw-semibold" style="color:#1e293b;">{{ number_format($tong_tien, 0, ',', '.') }}đ</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid #e2e8f0;">
                    <span style="color:#64748b;">Phí dịch vụ</span>
                    <span class="fw-semibold" style="color:#1e293b;">0đ</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center pt-3" style="background:#f8fafc; padding:16px; border-radius:10px;">
                    <span class="fw-semibold" style="color:#1e293b; font-size:1.1rem;">Tổng cộng</span>
                    <span class="fw-bold" style="color:#4f46e5; font-size:1.3rem;">{{ number_format($tong_tien, 0, ',', '.') }}đ</span>
                </div>
                
                <p style="font-size:.8rem; color:#94a3b8; margin-top:12px; margin-bottom:0; text-align:center;">
                    <i class="fas fa-info-circle me-1"></i> Chưa bao gồm các dịch vụ bổ sung
                </p>
            </div>
        </div>

        {{-- Status & Next Steps --}}
        <div class="card-modern mb-4" style="background:linear-gradient(135deg, rgba(245,158,11,.03), rgba(79,70,229,.03)); border:1px solid rgba(245,158,11,.1);">
            <div class="p-4">
                <div class="d-flex align-items-start gap-3">
                    <div style="width:40px; height:40px; border-radius:10px; background:rgba(245,158,11,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fas fa-hourglass-half" style="color:#f59e0b;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-2" style="color:#1e293b;">Đơn đặt phòng của bạn đang chờ xác nhận</h6>
                        <p style="font-size:.88rem; color:#64748b; margin-bottom:2px;">
                            Cứ yên tâm! Chúng tôi sẽ kiểm tra và xác nhận đơn đặt phòng của bạn trong vòng 24 giờ.
                        </p>
                        <p style="font-size:.88rem; color:#94a3b8; margin:0;">
                            Bạn sẽ nhận được email thông báo khi đơn được xác nhận.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Info --}}
        <div class="card-modern mb-4">
            <div class="p-4">
                <h6 class="fw-bold mb-3" style="color:#1e293b;"><i class="fas fa-lightbulb text-warning me-2"></i>Thông tin bổ sung</h6>
                
                <div style="display:flex; gap:16px; margin-bottom:16px; font-size:.88rem;">
                    <div style="flex:1; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                        <i class="fas fa-lock text-primary me-2"></i>
                        <span style="color:#475569;">Hủy miễn phí trước 48h</span>
                    </div>
                    <div style="flex:1; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span style="color:#475569;">Thanh toán tại phòng</span>
                    </div>
                </div>
                
                <div style="display:flex; gap:16px; font-size:.88rem;">
                    <div style="flex:1; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                        <i class="fas fa-phone text-info me-2"></i>
                        <span style="color:#475569;">Hỗ trợ 24/7:0939257838 - 02923798168</span>
                    </div>
                    <div style="flex:1; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                        <i class="fas fa-envelope text-danger me-2"></i>
                        <span style="color:#475569;">NamCanThoDNC@dnchotel.vn</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <a href="{{ route('nguoidung.datphong.lichsu') }}" class="btn-hero btn-hero-outline-primary" style="width:100%; padding:14px;">
                    <i class="fas fa-history me-2"></i> Xem lịch sử đặt phòng
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('nguoidung.datphong.danhsach') }}" class="btn-hero btn-hero-primary" style="width:100%; padding:14px; position:relative; overflow:hidden;">
                    <i class="fas fa-plus me-2"></i> Đặt phòng khác
                </a>
            </div>
        </div>

        <div text-center>
            <a href="{{ route('nguoidung.home') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none" style="color:#64748b; font-size:.88rem;">
                <i class="fas fa-arrow-left"></i> Quay lại trang chủ
            </a>
        </div>
    </div>
</div>

<style>
@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.badge-status {
    display:inline-block;
    padding:6px 12px;
    border-radius:8px;
    font-size:.85rem;
    font-weight:500;
}

.card-modern {
    border:1px solid #e2e8f0;
    border-radius:16px;
    box-shadow:0 1px 3px rgba(0,0,0,.05);
    overflow:hidden;
    transition:all .3s ease;
}

.btn-hero {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    border:none;
    font-weight:600;
    font-size:.9rem;
    transition:all .35s ease;
    text-decoration:none;
}

.btn-hero-primary {
    background:linear-gradient(135deg, #4f46e5, #818cf8);
    color:#fff;
}

.btn-hero-primary:hover {
    background:linear-gradient(135deg, #4338ca, #6366f1);
    transform:translateY(-2px);
    box-shadow:0 8px 16px rgba(79,70,229,.3);
    color:#fff;
    text-decoration:none;
}

.btn-hero-outline-primary {
    background:#fff;
    color:#4f46e5;
    border:2px solid #4f46e5;
}

.btn-hero-outline-primary:hover {
    background:#4f46e5;
    color:#fff;
    text-decoration:none;
}
</style>
@endsection
