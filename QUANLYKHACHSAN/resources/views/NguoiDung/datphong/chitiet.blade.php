@extends('NguoiDung.layouts.app')

@section('title', 'Chi tiết đặt phòng #' . $datphong->ma_dat_phong)
@section('page-heading', 'Chi tiết đặt phòng')

@section('content')
<a href="{{ route('nguoidung.datphong.lichsu') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none mb-4" style="color:#64748b; font-size:.88rem;">
    <i class="fas fa-arrow-left"></i> Quay lại lịch sử
</a>

{{-- Header card --}}
@php
    $trangThai = $datphong->trangThaiDatPhong->ten_trang_thai_dat_phong ?? 'N/A';
    $bg = 'rgba(100,116,139,.08)'; $cl = '#64748b';
    if (str_contains(mb_strtolower($trangThai), 'đã xác nhận')) {
        $bg = 'rgba(16,185,129,.08)'; $cl = '#059669';
    } elseif (str_contains(mb_strtolower($trangThai), 'chưa')) {
        $bg = 'rgba(245,158,11,.08)'; $cl = '#d97706';
    } elseif (str_contains(mb_strtolower($trangThai), 'hủy')) {
        $bg = 'rgba(239,68,68,.08)'; $cl = '#dc2626';
    }
    $soNgay = max(1, \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->diffInDays(\Carbon\Carbon::parse($datphong->ngay_tra_phong)));
@endphp

<div class="card-modern p-4 mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div style="width:50px; height:50px; border-radius:14px; background:rgba(79,70,229,.08); display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-receipt" style="color:#4f46e5; font-size:1.2rem;"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0" style="color:#1e293b;">Đặt phòng #{{ $datphong->ma_dat_phong }}</h5>
                <small class="text-muted">Ngày đặt: {{ \Carbon\Carbon::parse($datphong->ngay_dat_phong)->format('d/m/Y H:i') }}</small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge-status" style="background:{{ $bg }}; color:{{ $cl }}; font-size:.82rem; padding:7px 16px;">
                <i class="fas fa-circle" style="font-size:.4rem; vertical-align:middle; margin-right:5px;"></i>{{ $trangThai }}
            </span>
            @if(str_contains(mb_strtolower($trangThai), 'chưa'))
            <form action="{{ route('nguoidung.datphong.huy', $datphong->ma_dat_phong) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đặt phòng này không?')">
                @csrf
                <button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,.08); color:#dc2626; border:1px solid #fecaca; border-radius:8px; font-size:.82rem; padding:7px 16px; transition:all .2s;"
                    onmouseover="this.style.background='#fef2f2'; this.style.borderColor='#f87171';"
                    onmouseout="this.style.background='rgba(239,68,68,.08)'; this.style.borderColor='#fecaca';">
                    <i class="fas fa-ban me-1"></i> Hủy đặt phòng
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Room info --}}
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
                <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-door-open text-primary me-2"></i>Thông tin phòng</h6>
            </div>
            <div class="p-4">
                <div class="row g-3" style="font-size:.88rem;">
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Tên phòng</div>
                        <div class="fw-semibold" style="color:#1e293b;">{{ $datphong->phong->ten_phong ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Loại phòng</div>
                        <span class="badge-status" style="background:rgba(79,70,229,.08); color:#4f46e5;">{{ $datphong->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</span>
                    </div>
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Giá phòng</div>
                        <div class="fw-bold" style="color:#4f46e5;">{{ number_format($datphong->phong->gia_phong ?? 0, 0, ',', '.') }}đ/đêm</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Số giường</div>
                        <div class="fw-semibold" style="color:#1e293b;">{{ $datphong->phong->so_luong_giuong ?? 0 }} giường</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Time info --}}
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
                <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-calendar-days text-success me-2"></i>Thời gian lưu trú</h6>
            </div>
            <div class="p-4">
                <div class="row g-3" style="font-size:.88rem;">
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Nhận phòng</div>
                        <div class="fw-semibold" style="color:#1e293b;">{{ \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Trả phòng</div>
                        <div class="fw-semibold" style="color:#1e293b;">{{ \Carbon\Carbon::parse($datphong->ngay_tra_phong)->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-12">
                        <div style="padding:14px; background:#f8fafc; border-radius:10px; text-align:center; margin-top:4px;">
                            <span class="text-muted" style="font-size:.82rem;">Tổng thời gian: </span>
                            <span class="fw-bold" style="color:#4f46e5; font-size:1.1rem;">{{ $soNgay }} đêm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Services --}}
<div class="card-modern mb-4">
    <div class="p-4 border-bottom" style="border-color:#f1f5f9 !important;">
        <h6 class="fw-bold mb-0" style="color:#1e293b;"><i class="fas fa-concierge-bell text-warning me-2"></i>Dịch vụ đã sử dụng</h6>
    </div>
    @if($datphong->suDungDichVus->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th>#</th>
                        <th>Dịch vụ</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Ngày SD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datphong->suDungDichVus as $i => $sd)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold" style="color:#1e293b;">{{ $sd->dichVu->ten_dich_vu ?? 'N/A' }}</td>
                        <td>{{ number_format($sd->don_gia, 0, ',', '.') }}đ</td>
                        <td>{{ $sd->so_luong }}</td>
                        <td class="fw-semibold" style="color:#4f46e5;">{{ number_format($sd->thanh_tien, 0, ',', '.') }}đ</td>
                        <td>{{ $sd->ngay_su_dung ? \Carbon\Carbon::parse($sd->ngay_su_dung)->format('d/m/Y') : '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-4 text-center">
            <i class="fas fa-bell-slash text-muted" style="font-size:1.5rem;"></i>
            <p class="text-muted mt-2 mb-0" style="font-size:.88rem;">Chưa sử dụng dịch vụ nào.</p>
        </div>
    @endif
</div>

{{-- Invoice --}}
@if($datphong->hoaDon)
<div class="card-modern overflow-hidden">
    <div class="p-4" style="background:linear-gradient(135deg,#059669,#10b981); color:#fff;">
        <div class="d-flex align-items-center gap-2">
            <i class="fas fa-file-invoice-dollar" style="font-size:1.2rem;"></i>
            <h6 class="fw-bold mb-0">Hóa Đơn #{{ $datphong->hoaDon->ma_hoa_don }}</h6>
        </div>
        <small style="opacity:.75;">Ngày lập: {{ \Carbon\Carbon::parse($datphong->hoaDon->ngay_lap_hoa_don)->format('d/m/Y') }}</small>
    </div>
    <div class="p-4">
        <div class="row justify-content-end">
            <div class="col-md-7 col-lg-5">
                <div class="d-flex justify-content-between mb-2" style="font-size:.88rem;">
                    <span class="text-muted">Tiền phòng ({{ $soNgay }} đêm)</span>
                    <span class="fw-semibold">{{ number_format($datphong->hoaDon->tong_tien_phong, 0, ',', '.') }}đ</span>
                </div>
                <div class="d-flex justify-content-between mb-3" style="font-size:.88rem;">
                    <span class="text-muted">Tiền dịch vụ</span>
                    <span class="fw-semibold">{{ number_format($datphong->hoaDon->tong_tien_dich_vu, 0, ',', '.') }}đ</span>
                </div>
                <hr style="border-color:#e2e8f0;">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold" style="color:#1e293b;">Tổng thanh toán</span>
                    <span class="fw-bold" style="color:#059669; font-size:1.4rem;">{{ number_format($datphong->hoaDon->tong_tien_thanh_toan, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card-modern p-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:42px; height:42px; border-radius:10px; background:rgba(6,182,212,.08); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-file-circle-question" style="color:#0891b2;"></i>
        </div>
        <div>
            <div class="fw-semibold" style="color:#1e293b; font-size:.9rem;">Chưa có hóa đơn</div>
            <small class="text-muted">Hóa đơn sẽ được tạo sau khi hoàn tất quy trình.</small>
        </div>
    </div>
</div>
@endif
@endsection
