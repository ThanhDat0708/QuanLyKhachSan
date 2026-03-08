@extends('NguoiDung.layouts.app')

@section('title', 'Tổng quan')
@section('page-heading', 'Tổng quan')

@section('content')
{{-- Welcome --}}
<div class="mb-4">
    <h4 class="fw-bold" style="color: #1e293b;">Xin chào, {{ auth()->user()->ten_tai_khoan }}!</h4>
    <p class="text-muted mb-0">Chào mừng bạn quay trở lại Grand Hotel. Chúc bạn có trải nghiệm tuyệt vời.</p>
</div>

{{-- Quick Actions --}}
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('nguoidung.thongtin.show') }}" class="text-decoration-none">
            <div class="card-modern p-4 h-100" style="border-left: 4px solid #4f46e5;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px; height:48px; border-radius:12px; background:rgba(79,70,229,.08); display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-user" style="color:#4f46e5; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold" style="color:#1e293b;">Thông tin cá nhân</div>
                        <small class="text-muted">Xem & cập nhật hồ sơ</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('nguoidung.datphong.danhsach') }}" class="text-decoration-none">
            <div class="card-modern p-4 h-100" style="border-left: 4px solid #10b981;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px; height:48px; border-radius:12px; background:rgba(16,185,129,.08); display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-door-open" style="color:#10b981; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold" style="color:#1e293b;">Đặt phòng</div>
                        <small class="text-muted">Tìm phòng trống ngay</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('nguoidung.datphong.lichsu') }}" class="text-decoration-none">
            <div class="card-modern p-4 h-100" style="border-left: 4px solid #f59e0b;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px; height:48px; border-radius:12px; background:rgba(245,158,11,.08); display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-clock-rotate-left" style="color:#f59e0b; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold" style="color:#1e293b;">Lịch sử</div>
                        <small class="text-muted">Xem lại đặt phòng</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <div class="card-modern p-4 h-100" style="border-left: 4px solid #06b6d4;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px; height:48px; border-radius:12px; background:rgba(6,182,212,.08); display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-globe" style="color:#06b6d4; font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold" style="color:#1e293b;">Trang chủ</div>
                        <small class="text-muted">Về website chính</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Info Cards Row --}}
<div class="row g-4">
    {{-- Thông tin cá nhân --}}
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="p-4 border-bottom" style="border-color: #f1f5f9 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-user-circle text-primary me-2"></i>Hồ sơ của bạn</h6>
                    <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px; font-size:.8rem;">
                        <i class="fas fa-pen"></i> Sửa
                    </a>
                </div>
            </div>
            <div class="p-4">
                @php $kh = auth()->user()->khachHang; @endphp
                @if($kh)
                    <div class="d-flex gap-3 mb-3">
                        <div style="width:56px; height:56px; border-radius:14px; background:linear-gradient(135deg,#4f46e5,#818cf8); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; font-weight:700; flex-shrink:0;">
                            {{ strtoupper(mb_substr($kh->ho_ten ?? auth()->user()->ten_tai_khoan, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold" style="color:#1e293b; font-size:1.05rem;">{{ $kh->ho_ten ?? 'Chưa cập nhật' }}</div>
                            <small class="text-muted">{{ $kh->email ?? auth()->user()->so_dien_thoai }}</small>
                        </div>
                    </div>
                    <div class="row g-2" style="font-size:.88rem;">
                        <div class="col-6"><span class="text-muted">Giới tính:</span> <strong>{{ $kh->gioi_tinh ?? '—' }}</strong></div>
                        <div class="col-6"><span class="text-muted">SĐT:</span> <strong>{{ $kh->so_dien_thoai ?? '—' }}</strong></div>
                        <div class="col-6"><span class="text-muted">CCCD:</span> <strong>{{ $kh->cccd ?? '—' }}</strong></div>
                        <div class="col-6"><span class="text-muted">Ngày sinh:</span> <strong>{{ $kh->ngay_sinh ? date('d/m/Y', strtotime($kh->ngay_sinh)) : '—' }}</strong></div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <div style="width:64px; height:64px; border-radius:16px; background:rgba(245,158,11,.08); display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                            <i class="fas fa-user-pen" style="color:#f59e0b; font-size:1.5rem;"></i>
                        </div>
                        <p class="text-muted mb-2">Bạn chưa cập nhật thông tin cá nhân</p>
                        <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-primary-gradient btn-sm">
                            <i class="fas fa-plus me-1"></i> Cập nhật ngay
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Hướng dẫn nhanh --}}
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="p-4 border-bottom" style="border-color: #f1f5f9 !important;">
                <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-lightbulb text-warning me-2"></i>Hướng dẫn nhanh</h6>
            </div>
            <div class="p-4">
                <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                    <div style="width:36px; height:36px; border-radius:10px; background:rgba(79,70,229,.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="color:var(--primary); font-weight:700; font-size:.85rem;">1</span>
                    </div>
                    <div>
                        <div class="fw-semibold" style="color:#1e293b; font-size:.9rem;">Cập nhật thông tin cá nhân</div>
                        <small class="text-muted">Vào mục "Thông tin cá nhân" để điền đầy đủ họ tên, CCCD, số điện thoại.</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                    <div style="width:36px; height:36px; border-radius:10px; background:rgba(16,185,129,.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="color:#10b981; font-weight:700; font-size:.85rem;">2</span>
                    </div>
                    <div>
                        <div class="fw-semibold" style="color:#1e293b; font-size:.9rem;">Chọn phòng & đặt lịch</div>
                        <small class="text-muted">Xem danh sách phòng trống, chọn ngày nhận — trả phòng và xác nhận.</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                    <div style="width:36px; height:36px; border-radius:10px; background:rgba(245,158,11,.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="color:#f59e0b; font-weight:700; font-size:.85rem;">3</span>
                    </div>
                    <div>
                        <div class="fw-semibold" style="color:#1e293b; font-size:.9rem;">Theo dõi lịch sử</div>
                        <small class="text-muted">Xem trạng thái đặt phòng, dịch vụ đã sử dụng và hóa đơn chi tiết.</small>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div style="width:36px; height:36px; border-radius:10px; background:rgba(6,182,212,.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="color:#06b6d4; font-weight:700; font-size:.85rem;">4</span>
                    </div>
                    <div>
                        <div class="fw-semibold" style="color:#1e293b; font-size:.9rem;">Liên hệ hỗ trợ</div>
                        <small class="text-muted">Hotline: <strong>1900-1234</strong> | Email: contact@grandhotel.vn</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
