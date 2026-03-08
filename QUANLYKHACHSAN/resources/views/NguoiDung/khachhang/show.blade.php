@extends('NguoiDung.layouts.app')

@section('title', 'Thông tin cá nhân')
@section('page-heading', 'Thông tin cá nhân')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if($khachhang)
            <div class="card-modern overflow-hidden">
                {{-- Header --}}
                <div class="p-4 text-center" style="background:linear-gradient(135deg,#4f46e5,#818cf8);">
                    <div style="width:72px; height:72px; border-radius:18px; background:rgba(255,255,255,.2); display:flex; align-items:center; justify-content:center; margin:0 auto 12px; font-size:1.8rem; font-weight:700; color:#fff; backdrop-filter:blur(8px);">
                        {{ strtoupper(mb_substr($khachhang->ho_ten ?? auth()->user()->ten_tai_khoan, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold mb-1" style="color:#fff;">{{ $khachhang->ho_ten ?? 'Chưa cập nhật' }}</h5>
                    <small style="color:rgba(255,255,255,.7);">{{ $khachhang->email ?? 'Chưa cập nhật email' }}</small>
                </div>

                {{-- Info Grid --}}
                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div style="padding:14px 16px; background:#f8fafc; border-radius:10px;">
                                <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.5px;">Giới tính</div>
                                <div class="fw-semibold" style="color:#1e293b;">{{ $khachhang->gioi_tinh ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding:14px 16px; background:#f8fafc; border-radius:10px;">
                                <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.5px;">Ngày sinh</div>
                                <div class="fw-semibold" style="color:#1e293b;">{{ $khachhang->ngay_sinh ? date('d/m/Y', strtotime($khachhang->ngay_sinh)) : 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding:14px 16px; background:#f8fafc; border-radius:10px;">
                                <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.5px;">Số điện thoại</div>
                                <div class="fw-semibold" style="color:#1e293b;">{{ $khachhang->so_dien_thoai ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding:14px 16px; background:#f8fafc; border-radius:10px;">
                                <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.5px;">CMND/CCCD</div>
                                <div class="fw-semibold" style="color:#1e293b;">{{ $khachhang->cccd ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="padding:14px 16px; background:#f8fafc; border-radius:10px;">
                                <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.5px;">Địa chỉ</div>
                                <div class="fw-semibold" style="color:#1e293b;">{{ $khachhang->dia_chi ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 pt-3" style="border-top:1px solid #f1f5f9;">
                        <small class="text-muted">Cập nhật lần cuối: {{ date('d/m/Y H:i', strtotime($khachhang->updated_at)) }}</small>
                        <div class="d-flex gap-2">
                            <a href="{{ route('nguoidung.index') }}" style="width:38px; height:38px; border-radius:10px; border:1px solid #e2e8f0; display:inline-flex; align-items:center; justify-content:center; color:#64748b; text-decoration:none; transition:all .2s;"
                                title="Quay lại">
                                <i class="fas fa-arrow-left" style="font-size:.85rem;"></i>
                            </a>
                            <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-primary-gradient" style="font-size:.85rem;">
                                <i class="fas fa-pen me-1"></i> Chỉnh sửa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card-modern p-5 text-center">
                <div style="width:80px; height:80px; border-radius:20px; background:rgba(245,158,11,.08); display:flex; align-items:center; justify-content:center; margin:0 auto 18px;">
                    <i class="fas fa-user-pen" style="color:#f59e0b; font-size:2rem;"></i>
                </div>
                <h5 class="fw-bold" style="color:#1e293b;">Chưa có thông tin cá nhân</h5>
                <p class="text-muted mb-4" style="max-width:400px; margin:0 auto;">Vui lòng cập nhật thông tin cá nhân để sử dụng đầy đủ các tính năng đặt phòng.</p>
                <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-primary-gradient">
                    <i class="fas fa-plus me-1"></i> Thêm thông tin
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
