@extends('NguoiDung.layouts.app')

@section('title', ' Danh Sách Phòng')
@section('page-heading', ' Danh Sách Phòng')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1" style="color:#1e293b;">Danh Sách Phòng</h5>
        <p class="text-muted mb-0" style="font-size:.88rem;">Xem cả phòng đã đặt và phòng chưa đặt trước khi chọn</p>
    </div>
</div>

<div class="card-modern p-3 p-lg-4 mb-4">
    <form action="{{ route('nguoidung.datphong.danhsach') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="ma_loai_phong" class="form-label fw-semibold" style="color:#1e293b;">Loại phòng</label>
                <select name="ma_loai_phong" id="ma_loai_phong" class="form-select">
                    <option value="">Tất cả loại phòng</option>
                    @foreach($loaiPhongs as $loaiPhong)
                        <option value="{{ $loaiPhong->ma_loai_phong }}" {{ request('ma_loai_phong') == $loaiPhong->ma_loai_phong ? 'selected' : '' }}>
                            {{ $loaiPhong->ten_loai_phong }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="muc_gia" class="form-label fw-semibold" style="color:#1e293b;">Giá tiền</label>
                <select name="muc_gia" id="muc_gia" class="form-select">
                    <option value="">Tất cả mức giá</option>
                    <option value="duoi_500000" {{ request('muc_gia') === 'duoi_500000' ? 'selected' : '' }}>Dưới 500.000đ</option>
                    <option value="500000_1000000" {{ request('muc_gia') === '500000_1000000' ? 'selected' : '' }}>500.000đ - 1.000.000đ</option>
                    <option value="1000000_2000000" {{ request('muc_gia') === '1000000_2000000' ? 'selected' : '' }}>1.000.000đ - 2.000.000đ</option>
                    <option value="tren_2000000" {{ request('muc_gia') === 'tren_2000000' ? 'selected' : '' }}>Trên 2.000.000đ</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary-gradient w-100">
                    <i class="fas fa-search me-1"></i> Lọc
                </button>
                <a href="{{ route('nguoidung.datphong.danhsach') }}" class="btn btn-light border w-100">Bỏ lọc</a>
            </div>
        </div>
    </form>
</div>

@if($phongs->count() > 0)
    <div class="row g-4">
        @foreach($phongs as $phong)
        @php
            $coTheDat = !empty($maTrangThaiTrong) && (int) $phong->ma_trang_thai === (int) $maTrangThaiTrong;
        @endphp
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
                        <span>
                            <i class="fas {{ $coTheDat ? 'fa-check-circle' : 'fa-calendar-times' }} me-1" style="color:{{ $coTheDat ? '#10b981' : '#ef4444' }};"></i>
                            {{ $phong->trangThaiPhong->ten_trang_thai ?? 'Không xác định' }}
                        </span>
                    </div>
                    @if($phong->mo_ta)
                        <p class="text-muted mb-3" style="font-size:.82rem; line-height:1.5;">{{ Str::limit($phong->mo_ta, 80) }}</p>
                    @endif
                    @if($coTheDat)
                        <a href="{{ route('nguoidung.datphong.datphong', $phong->ma_phong) }}" class="btn btn-primary-gradient w-100" style="font-size:.88rem;">
                            <i class="fas fa-calendar-plus me-1"></i> Đặt phòng
                        </a>
                    @else
                        <button type="button" class="btn w-100" style="font-size:.88rem; background:#e2e8f0; color:#64748b; cursor:not-allowed;" disabled>
                            <i class="fas fa-ban me-1"></i> Phòng đã được đặt
                        </button>
                    @endif
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
        <h6 class="fw-bold" style="color:#1e293b;">Không tìm thấy phòng phù hợp</h6>
        <p class="text-muted mb-0" style="font-size:.88rem;">Hãy thử đổi bộ lọc giá tiền hoặc loại phòng.</p>
    </div>
@endif
@endsection
