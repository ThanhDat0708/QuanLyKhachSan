@extends('NguoiDung.layouts.app')

@section('title', 'Lịch sử đặt phòng')
@section('page-heading', 'Lịch sử đặt phòng')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1" style="color:#1e293b;">Lịch Sử Đặt Phòng</h5>
        <p class="text-muted mb-0" style="font-size:.88rem;">Theo dõi tất cả đặt phòng của bạn</p>
    </div>
    <a href="{{ route('nguoidung.datphong.danhsach') }}" class="btn btn-primary-gradient" style="font-size:.85rem;">
        <i class="fas fa-plus me-1"></i> Đặt phòng mới
    </a>
</div>

@if(!$khachhang)
    <div class="card-modern p-5 text-center">
        <div style="width:72px; height:72px; border-radius:18px; background:rgba(245,158,11,.08); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="fas fa-user-pen" style="color:#f59e0b; font-size:1.8rem;"></i>
        </div>
        <h6 class="fw-bold" style="color:#1e293b;">Chưa có thông tin cá nhân</h6>
        <p class="text-muted mb-3" style="font-size:.88rem;">Vui lòng cập nhật thông tin cá nhân trước khi đặt phòng.</p>
        <a href="{{ route('nguoidung.thongtin.edit') }}" class="btn btn-primary-gradient">
            <i class="fas fa-user-edit me-1"></i> Cập nhật ngay
        </a>
    </div>
@elseif($datphongs->count() > 0)
    <div class="card-modern overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th>Mã</th>
                        <th>Phòng</th>
                        <th>Loại</th>
                        <th>Ngày đặt</th>
                        <th>Nhận phòng</th>
                        <th>Trả phòng</th>
                        <th>Trạng thái</th>
                        <th>Hóa đơn</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datphongs as $dp)
                    <tr>
                        <td class="fw-semibold">#{{ $dp->ma_dat_phong }}</td>
                        <td class="fw-semibold" style="color:#1e293b;">{{ $dp->phong->ten_phong ?? 'N/A' }}</td>
                        <td>
                            <span class="badge-status" style="background:rgba(79,70,229,.08); color:#4f46e5;">
                                {{ $dp->phong->loaiPhong->ten_loai_phong ?? 'N/A' }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($dp->ngay_dat_phong)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dp->ngay_nhan_phong)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dp->ngay_tra_phong)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $trangThai = $dp->trangThaiDatPhong->ten_trang_thai_dat_phong ?? 'N/A';
                                $bg = 'rgba(100,116,139,.08)'; $cl = '#64748b';
                                if (str_contains(mb_strtolower($trangThai), 'xác nhận') || str_contains(mb_strtolower($trangThai), 'nhận')) {
                                    $bg = 'rgba(16,185,129,.08)'; $cl = '#059669';
                                } elseif (str_contains(mb_strtolower($trangThai), 'chờ')) {
                                    $bg = 'rgba(245,158,11,.08)'; $cl = '#d97706';
                                } elseif (str_contains(mb_strtolower($trangThai), 'hủy')) {
                                    $bg = 'rgba(239,68,68,.08)'; $cl = '#dc2626';
                                } elseif (str_contains(mb_strtolower($trangThai), 'hoàn')) {
                                    $bg = 'rgba(6,182,212,.08)'; $cl = '#0891b2';
                                }
                            @endphp
                            <span class="badge-status" style="background:{{ $bg }}; color:{{ $cl }};">
                                <i class="fas fa-circle" style="font-size:.35rem; vertical-align:middle; margin-right:4px;"></i>{{ $trangThai }}
                            </span>
                        </td>
                        <td>
                            @if($dp->hoaDon)
                                <span class="badge-status" style="background:rgba(16,185,129,.08); color:#059669;">
                                    <i class="fas fa-check"></i> Có
                                </span>
                            @else
                                <span class="badge-status" style="background:rgba(100,116,139,.06); color:#94a3b8;">Chưa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('nguoidung.datphong.chitiet', $dp->ma_dat_phong) }}" 
                                style="width:34px; height:34px; border-radius:8px; border:1px solid #e2e8f0; display:inline-flex; align-items:center; justify-content:center; color:#64748b; text-decoration:none; transition:all .2s;"
                                onmouseover="this.style.borderColor='#818cf8'; this.style.color='#4f46e5';"
                                onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#64748b';">
                                <i class="fas fa-eye" style="font-size:.8rem;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $datphongs->links() }}</div>
@else
    <div class="card-modern p-5 text-center">
        <div style="width:72px; height:72px; border-radius:18px; background:rgba(79,70,229,.06); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="fas fa-inbox" style="color:#818cf8; font-size:1.8rem;"></i>
        </div>
        <h6 class="fw-bold" style="color:#1e293b;">Chưa có lần đặt phòng nào</h6>
        <p class="text-muted mb-3" style="font-size:.88rem;">Hãy đặt phòng đầu tiên của bạn ngay bây giờ!</p>
        <a href="{{ route('nguoidung.datphong.danhsach') }}" class="btn btn-primary-gradient">
            <i class="fas fa-door-open me-1"></i> Xem phòng trống
        </a>
    </div>
@endif
@endsection
