@extends('NguoiDung.layouts.app')

@section('title', 'Phòng trống')
@section('page-heading', 'Phòng trống')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1" style="color:#1e293b;">Danh Sách Phòng Trống</h5>
        <p class="text-muted mb-0" style="font-size:.88rem;">Chọn phòng bạn muốn đặt</p>
    </div>
    <span class="badge-status" style="background:rgba(16,185,129,.1); color:#059669;">
        <i class="fas fa-circle" style="font-size:.45rem; vertical-align:middle;"></i> {{ $phongs->count() }} phòng trống
    </span>
</div>

@if($phongs->count() > 0)
    <div class="row g-4">
        @foreach($phongs as $phong)
        <div class="col-md-6 col-xl-4">
            <div class="card-modern overflow-hidden h-100">
                {{-- Image --}}
                <div style="height:200px; position:relative; overflow:hidden;">
                    @if($phong->anh_phong)
                        <img src="{{ asset('images/' . $phong->anh_phong) }}" alt="{{ $phong->ten_phong }}" 
                            style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="width:100%; height:100%; background:linear-gradient(135deg,#4f46e5,#818cf8); display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-bed fa-3x" style="color:rgba(255,255,255,.3);"></i>
                        </div>
                    @endif
                    {{-- Price tag --}}
                    <div style="position:absolute; bottom:12px; right:12px; background:rgba(0,0,0,.65); backdrop-filter:blur(8px); color:#fff; padding:5px 14px; border-radius:50px; font-size:.82rem; font-weight:700;">
                        {{ number_format($phong->gia_phong, 0, ',', '.') }}đ / đêm
                    </div>
                    {{-- Type badge --}}
                    <div style="position:absolute; top:12px; left:12px;">
                        <span class="badge-status" style="background:rgba(255,255,255,.9); color:#4f46e5; font-size:.72rem;">
                            {{ $phong->loaiPhong->ten_loai_phong ?? 'N/A' }}
                        </span>
                    </div>
                </div>
                {{-- Body --}}
                <div class="p-3">
                    <h6 class="fw-bold mb-2" style="color:#1e293b;">{{ $phong->ten_phong }}</h6>
                    <div class="d-flex gap-3 mb-2" style="font-size:.8rem; color:#64748b;">
                        <span><i class="fas fa-bed me-1"></i>{{ $phong->so_luong_giuong ?? 0 }} giường</span>
                        <span><i class="fas fa-check-circle me-1" style="color:#10b981;"></i>{{ $phong->trangThaiPhong->ten_trang_thai ?? 'Trống' }}</span>
                    </div>
                    @if($phong->mo_ta)
                        <p class="text-muted mb-3" style="font-size:.82rem; line-height:1.5;">{{ Str::limit($phong->mo_ta, 80) }}</p>
                    @endif
                    <a href="{{ route('nguoidung.datphong.datphong', $phong->ma_phong) }}" class="btn btn-primary-gradient w-100" style="font-size:.88rem;">
                        <i class="fas fa-calendar-plus me-1"></i> Đặt phòng
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="card-modern p-5 text-center">
        <div style="width:72px; height:72px; border-radius:18px; background:rgba(6,182,212,.08); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="fas fa-door-closed" style="color:#06b6d4; font-size:1.8rem;"></i>
        </div>
        <h6 class="fw-bold" style="color:#1e293b;">Hiện không có phòng trống</h6>
        <p class="text-muted mb-0" style="font-size:.88rem;">Vui lòng quay lại sau hoặc liên hệ lễ tân để được hỗ trợ.</p>
    </div>
@endif
@endsection
