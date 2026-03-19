@extends('Admin.layouts.Interface')
@section('title', 'Thống Kê Doanh Thu')
@section('content')
    <style>
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            color: #fff;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card h3 { font-size: 1.6rem; margin-bottom: 5px; }
        .stat-card p { margin: 0; opacity: 0.9; font-size: 0.9rem; }
        .bg-room { background: linear-gradient(135deg, #3498db, #2980b9); }
        .bg-service { background: linear-gradient(135deg, #e67e22, #d35400); }
        .bg-total { background: linear-gradient(135deg, #27ae60, #219a52); }
        .bg-booking { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
        .bg-booked-room { background: linear-gradient(135deg, #1abc9c, #16a085); }
        .bg-customer { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .bg-customer-all { background: linear-gradient(135deg, #34495e, #2c3e50); }
        .filter-card { background: #f8f9fa; border-radius: 10px; padding: 20px; margin-bottom: 20px; }
        .btn-filter { min-width: 100px; }
        .btn-filter.active { background-color: var(--accent); border-color: var(--accent); color: #fff; }
        @media print {
            .navbar, .no-print { display: none !important; }
            .main-content { margin: 0 !important; padding: 0 !important; }
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Thống Kê Doanh Thu</h3>
                        <button onclick="window.print()" class="btn btn-outline-primary btn-sm no-print">🖨️ In báo cáo</button>
                    </div>
                    <div class="card-body">

                        {{-- Bộ lọc --}}
                        <div class="filter-card no-print">
                            <form method="GET" action="{{ route('admin.doanhthu.index') }}">
                                <div class="row align-items-end">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label fw-bold">Thống kê theo:</label>
                                        <div class="btn-group w-100" role="group">
                                            <button type="submit" name="loai" value="ngay"
                                                class="btn btn-outline-primary btn-filter {{ $loai === 'ngay' ? 'active' : '' }}">Ngày</button>
                                            <button type="submit" name="loai" value="thang"
                                                class="btn btn-outline-primary btn-filter {{ $loai === 'thang' ? 'active' : '' }}">Tháng</button>
                                            <button type="submit" name="loai" value="nam"
                                                class="btn btn-outline-primary btn-filter {{ $loai === 'nam' ? 'active' : '' }}">Năm</button>
                                        </div>
                                    </div>

                                    @if ($loai === 'ngay')
                                        <div class="col-md-3 mb-2">
                                            <label for="tu_ngay" class="form-label fw-bold">Từ ngày:</label>
                                            <input type="date" class="form-control" name="tu_ngay" id="tu_ngay"
                                                value="{{ $tuNgay }}">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label for="den_ngay" class="form-label fw-bold">Đến ngày:</label>
                                            <input type="date" class="form-control" name="den_ngay" id="den_ngay"
                                                value="{{ $denNgay }}">
                                        </div>
                                        <input type="hidden" name="loai" value="ngay">
                                    @elseif ($loai === 'thang')
                                        <div class="col-md-3 mb-2">
                                            <label for="nam" class="form-label fw-bold">Năm:</label>
                                            <select class="form-select" name="nam" id="nam">
                                                @foreach ($danhSachNam as $n)
                                                    <option value="{{ $n }}" {{ $nam == $n ? 'selected' : '' }}>{{ $n }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="loai" value="thang">
                                    @endif

                                    <div class="col-md-2 mb-2">
                                        <button type="submit" class="btn btn-primary w-100">
                                            🔍 Tra cứu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Card tổng --}}
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="stat-card bg-room">
                                    <p>Tổng Tiền Phòng</p>
                                    <h3>{{ number_format($tongTienPhong, 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="stat-card bg-service">
                                    <p>Tổng Tiền Dịch Vụ</p>
                                    <h3>{{ number_format($tongTienDichVu, 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="stat-card bg-total">
                                    <p>Tổng Doanh Thu</p>
                                    <h3>{{ number_format($tongDoanhThu, 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="stat-card bg-customer-all">
                                    <p>Tổng Khách Hàng Hệ Thống</p>
                                    <h3>{{ number_format($tongKhachHangHeThong, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="stat-card bg-booking">
                                    <p>Số Lượt Đặt Phòng</p>
                                    <h3>{{ number_format($tongSoLuotDatPhong, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="stat-card bg-booked-room">
                                    <p>Số Phòng Được Đặt</p>
                                    <h3>{{ number_format($tongSoPhongDuocDat, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 mb-3">
                                <div class="stat-card bg-customer">
                                    <p>Số Khách Hàng Đặt Phòng</p>
                                    <h3>{{ number_format($tongSoKhachHangDatPhong, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>

                        {{-- Bảng chi tiết --}}
                        <h5 class="mb-3" style="color: var(--primary);">
                            Chi tiết doanh thu
                            @if ($loai === 'ngay')
                                theo ngày ({{ \Carbon\Carbon::parse($tuNgay)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($denNgay)->format('d/m/Y') }})
                            @elseif ($loai === 'thang')
                                theo tháng năm {{ $nam }}
                            @else
                                theo năm
                            @endif
                        </h5>

                        @if ($doanhThu->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            @if ($loai === 'ngay')
                                                <th>Ngày</th>
                                            @elseif ($loai === 'thang')
                                                <th>Tháng</th>
                                            @else
                                                <th>Năm</th>
                                            @endif
                                            <th>Số Hóa Đơn</th>
                                            <th>Tiền Phòng</th>
                                            <th>Tiền Dịch Vụ</th>
                                            <th>Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doanhThu as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                @if ($loai === 'ngay')
                                                    <td>{{ \Carbon\Carbon::parse($item->ngay)->format('d/m/Y') }}</td>
                                                @elseif ($loai === 'thang')
                                                    <td>Tháng {{ $item->thang }}/{{ $item->nam }}</td>
                                                @else
                                                    <td>Năm {{ $item->nam }}</td>
                                                @endif
                                                <td>{{ $item->so_hoa_don }}</td>
                                                <td>{{ number_format($item->tien_phong, 0, ',', '.') }} đ</td>
                                                <td>{{ number_format($item->tien_dich_vu, 0, ',', '.') }} đ</td>
                                                <td><strong>{{ number_format($item->tong_tien, 0, ',', '.') }} đ</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <td colspan="{{ $loai === 'ngay' ? 3 : 3 }}"><strong>TỔNG CỘNG</strong></td>
                                            <td><strong>{{ number_format($tongTienPhong, 0, ',', '.') }} đ</strong></td>
                                            <td><strong>{{ number_format($tongTienDichVu, 0, ',', '.') }} đ</strong></td>
                                            <td><strong style="color: #27ae60; font-size: 1.1rem;">{{ number_format($tongDoanhThu, 0, ',', '.') }} đ</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <p class="mb-0">Không có dữ liệu doanh thu trong khoảng thời gian này.</p>
                            </div>
                        @endif

                        <h5 class="mb-3 mt-4" style="color: var(--primary);">Chi tiết số lượng phòng đặt và khách hàng</h5>

                        @if ($baoCaoSoLuong->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            @if ($loai === 'ngay')
                                                <th>Ngày</th>
                                            @elseif ($loai === 'thang')
                                                <th>Tháng</th>
                                            @else
                                                <th>Năm</th>
                                            @endif
                                            <th>Số Lượt Đặt Phòng</th>
                                            <th>Số Phòng Được Đặt</th>
                                            <th>Số Khách Hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($baoCaoSoLuong as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                @if ($loai === 'ngay')
                                                    <td>{{ \Carbon\Carbon::parse($item->ngay)->format('d/m/Y') }}</td>
                                                @elseif ($loai === 'thang')
                                                    <td>Tháng {{ $item->thang }}/{{ $item->nam }}</td>
                                                @else
                                                    <td>Năm {{ $item->nam }}</td>
                                                @endif
                                                <td>{{ number_format($item->so_luot_dat_phong, 0, ',', '.') }}</td>
                                                <td>{{ number_format($item->so_phong_duoc_dat, 0, ',', '.') }}</td>
                                                <td>{{ number_format($item->so_khach_hang, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <td colspan="{{ $loai === 'ngay' ? 2 : 2 }}"><strong>TỔNG CỘNG</strong></td>
                                            <td><strong>{{ number_format($baoCaoSoLuong->sum('so_luot_dat_phong'), 0, ',', '.') }}</strong></td>
                                            <td><strong>{{ number_format($tongSoPhongDuocDat, 0, ',', '.') }}</strong></td>
                                            <td><strong>{{ number_format($tongSoKhachHangDatPhong, 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <p class="mb-0">Không có dữ liệu đặt phòng trong khoảng thời gian này.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
