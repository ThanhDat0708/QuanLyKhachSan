@extends('NguoiDung.layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Chào mừng, {{ auth()->user()->ten_tai_khoan }}! 👋</h2>
        
        <div class="row g-4">
            <!-- Card Thông tin cá nhân -->
            <div class="col-md-6">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white p-3 me-3">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Thông tin cá nhân</h5>
                                <small class="text-muted">Quản lý thông tin của bạn</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Xem và cập nhật thông tin cá nhân, CMND, địa chỉ, số điện thoại...
                        </p>
                        <a href="{{ route('nguoidung.thongtin.show') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i> Xem thông tin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Đặt phòng (Coming soon) -->
            <div class="col-md-6">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-success text-white p-3 me-3">
                                <i class="fas fa-bed fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Đặt phòng</h5>
                                <small class="text-muted">Đang phát triển</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Tính năng đặt phòng trực tuyến đang được phát triển...
                        </p>
                        <button class="btn btn-secondary" disabled>
                            <i class="fas fa-clock"></i> Sắp ra mắt
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Lịch sử đặt phòng -->
            <div class="col-md-6">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-warning text-white p-3 me-3">
                                <i class="fas fa-history fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Lịch sử đặt phòng</h5>
                                <small class="text-muted">Đang phát triển</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Xem lại các phòng bạn đã đặt và trạng thái thanh toán...
                        </p>
                        <button class="btn btn-secondary" disabled>
                            <i class="fas fa-clock"></i> Sắp ra mắt
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Liên hệ -->
            <div class="col-md-6">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-info text-white p-3 me-3">
                                <i class="fas fa-phone fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Liên hệ hỗ trợ</h5>
                                <small class="text-muted">Chúng tôi luôn sẵn sàng</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Hotline: <strong>1900-xxxx</strong><br>
                            Email: support@khachsan.com
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-info text-white">
                            <i class="fas fa-home"></i> Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông báo -->
        <div class="card mt-4 border-0 shadow-sm">
            <div class="card-body bg-light">
                <h5><i class="fas fa-info-circle text-primary"></i> Hướng dẫn sử dụng</h5>
                <ul class="mb-0">
                    <li>Nhấn vào <strong>"Thông tin cá nhân"</strong> để cập nhật thông tin của bạn</li>
                    <li>Các tính năng đặt phòng đang được phát triển và sẽ sớm ra mắt</li>
                    <li>Nếu cần hỗ trợ, vui lòng liên hệ hotline hoặc email</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
