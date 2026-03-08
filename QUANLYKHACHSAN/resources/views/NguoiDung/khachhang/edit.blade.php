@extends('NguoiDung.layouts.app')

@section('title', 'Cập nhật thông tin')
@section('page-heading', 'Cập nhật thông tin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-modern overflow-hidden">
            {{-- Header --}}
            <div class="p-4 d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#4f46e5,#818cf8);">
                <div style="width:48px; height:48px; border-radius:14px; background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center; backdrop-filter:blur(8px);">
                    <i class="fas fa-user-pen" style="color:#fff; font-size:1.15rem;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0" style="color:#fff;">Thông tin cá nhân</h5>
                    <small style="color:rgba(255,255,255,.7);">Cập nhật hồ sơ của bạn</small>
                </div>
            </div>

            {{-- Form --}}
            <div class="p-4">
                <form method="POST" action="{{ route('nguoidung.thongtin.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        {{-- Họ tên --}}
                        <div class="col-12">
                            <label for="ho_ten" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-user me-1 text-muted"></i> Họ và tên <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                                   id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $khachhang->ho_ten ?? '') }}" required
                                   placeholder="Nhập họ và tên"
                                   style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                            @error('ho_ten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ngày sinh --}}
                        <div class="col-md-6">
                            <label for="ngay_sinh" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-calendar me-1 text-muted"></i> Ngày sinh <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror"
                                   id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $khachhang->ngay_sinh ?? '') }}" required
                                   style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                            @error('ngay_sinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Giới tính --}}
                        <div class="col-md-6">
                            <label for="gioi_tinh" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-venus-mars me-1 text-muted"></i> Giới tính <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('gioi_tinh') is-invalid @enderror"
                                    id="gioi_tinh" name="gioi_tinh" required
                                    style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                                <option value="">Chọn giới tính</option>
                                <option value="Nam" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gioi_tinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CCCD --}}
                        <div class="col-md-6">
                            <label for="cccd" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-id-card me-1 text-muted"></i> CMND/CCCD <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('cccd') is-invalid @enderror"
                                   id="cccd" name="cccd" value="{{ old('cccd', $khachhang->cccd ?? '') }}" required
                                   placeholder="Nhập số CMND/CCCD"
                                   style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                            @error('cccd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="col-md-6">
                            <label for="so_dien_thoai" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-phone me-1 text-muted"></i> Số điện thoại <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                                   id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai', $khachhang->so_dien_thoai ?? '') }}" required
                                   placeholder="Nhập số điện thoại"
                                   style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                            @error('so_dien_thoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-envelope me-1 text-muted"></i> Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $khachhang->email ?? '') }}" required
                                   placeholder="Nhập địa chỉ email"
                                   style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="col-12">
                            <label for="diachi" class="form-label fw-semibold" style="font-size:.85rem; color:#475569;">
                                <i class="fas fa-location-dot me-1 text-muted"></i> Địa chỉ
                            </label>
                            <textarea class="form-control @error('diachi') is-invalid @enderror"
                                      id="diachi" name="diachi" rows="3"
                                      placeholder="Nhập địa chỉ hiện tại"
                                      style="border-radius:10px; border-color:#e2e8f0; padding:10px 14px; resize:none;">{{ old('diachi', $khachhang->diachi ?? '') }}</textarea>
                            @error('diachi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex align-items-center justify-content-between mt-4 pt-3" style="border-top:1px solid #f1f5f9;">
                        <a href="{{ route('nguoidung.thongtin.show') }}" style="color:#64748b; text-decoration:none; font-size:.88rem; transition:color .2s;">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary-gradient" style="font-size:.88rem;">
                            <i class="fas fa-check me-1"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
