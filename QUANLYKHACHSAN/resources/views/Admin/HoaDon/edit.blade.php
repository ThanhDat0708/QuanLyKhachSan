@extends('Admin.layouts.Interface')
@section('title', 'Sửa Hóa Đơn')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Sửa Hóa Đơn #{{ $hoadon->ma_hoa_don }}</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hoadon.update', $hoadon->ma_hoa_don) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="ma_dat_phong">Chọn Đặt Phòng <span class="text-danger">*</span></label>
                <select class="form-control" id="ma_dat_phong" name="ma_dat_phong" required>
                    <option value="">-- Chọn đặt phòng --</option>
                    @foreach ($datphongs as $datphong)
                        <option value="{{ $datphong->ma_dat_phong }}" {{ $hoadon->ma_dat_phong == $datphong->ma_dat_phong ? 'selected' : '' }}>
                            #{{ $datphong->ma_dat_phong }} -
                            {{ $datphong->khachHang->ho_ten ?? 'N/A' }} -
                            Phòng: {{ $datphong->phong->ten_phong ?? 'N/A' }} -
                            ({{ \Carbon\Carbon::parse($datphong->ngay_nhan_phong)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($datphong->ngay_tra_phong)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ===== DỊCH VỤ ĐANG SỬ DỤNG ===== --}}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Dịch Vụ Sử Dụng</strong>
                    <button type="button" class="btn btn-primary btn-sm" id="btnThemDichVu">
                        + Thêm Dịch Vụ
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="bangDichVu">
                        <thead>
                            <tr>
                                <th>Dịch Vụ</th>
                                <th style="width:130px">Đơn Giá</th>
                                <th style="width:110px">Số Lượng</th>
                                <th style="width:140px">Thành Tiền</th>
                                <th style="width:80px">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="dsDichVu">
                            @forelse ($hoadon->datPhong->suDungDichVus as $sdDv)
                            <tr class="row-existing">
                                <td>{{ $sdDv->dichVu->ten_dich_vu ?? 'N/A' }}</td>
                                <td>{{ number_format($sdDv->don_gia, 0, ',', '.') }} đ</td>
                                <td>
                                    <input type="number"
                                        class="form-control form-control-sm so-luong-existing"
                                        name="existing_services[{{ $sdDv->ma_sd_dich_vu }}][so_luong]"
                                        value="{{ $sdDv->so_luong }}"
                                        min="1"
                                        data-don-gia="{{ $sdDv->don_gia }}">
                                </td>
                                <td class="thanh-tien-cell">{{ number_format($sdDv->thanh_tien, 0, ',', '.') }} đ</td>
                                <td class="text-center">
                                    <input type="hidden" name="existing_services[{{ $sdDv->ma_sd_dich_vu }}][delete]" value="0">
                                    <input type="checkbox"
                                        class="form-check-input delete-checkbox"
                                        name="existing_services[{{ $sdDv->ma_sd_dich_vu }}][delete]"
                                        value="1"
                                        title="Xóa dịch vụ này"
                                        style="width:20px;height:20px;cursor:pointer;">
                                </td>
                            </tr>
                            @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="text-center text-muted py-3">Chưa có dịch vụ nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===== THÔNG TIN TỔNG TIỀN ===== --}}
            <div class="card mt-3" style="background: #f8f9fa;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Tiền phòng:</strong> {{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Tiền dịch vụ:</strong> {{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Tổng thanh toán:</strong> <span class="text-success">{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} đ</span></p>
                        </div>
                    </div>
                    <p class="text-muted mb-0"><em>* Khi cập nhật, hệ thống sẽ tự động tính lại tổng tiền.</em></p>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">✅ Cập Nhật Hóa Đơn</button>
                <a href="{{ route('admin.hoadon.index') }}" class="btn btn-secondary">← Quay lại</a>
            </div>
        </form>
    </div>
</div>

{{-- Template dòng dịch vụ mới (ẩn) --}}
<template id="templateNewRow">
    <tr class="row-new">
        <td>
            <select class="form-control form-control-sm" name="new_services[__IDX__][ma_dich_vu]" required>
                <option value="">-- Chọn dịch vụ --</option>
                @foreach ($dichvus as $dv)
                <option value="{{ $dv->ma_dich_vu }}" data-don-gia="{{ $dv->don_gia }}">
                    {{ $dv->ten_dich_vu }} ({{ number_format($dv->don_gia, 0, ',', '.') }} đ)
                </option>
                @endforeach
            </select>
        </td>
        <td class="don-gia-cell text-muted">—</td>
        <td>
            <input type="number" class="form-control form-control-sm so-luong-new" name="new_services[__IDX__][so_luong]" value="1" min="1">
        </td>
        <td class="thanh-tien-cell text-muted">—</td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm btn-remove-row">✕</button>
        </td>
    </tr>
</template>

<script>
(function () {
    let newRowIndex = 0;

    // Thêm dòng dịch vụ mới
    document.getElementById('btnThemDichVu').addEventListener('click', function () {
        const emptyRow = document.getElementById('emptyRow');
        if (emptyRow) emptyRow.remove();

        const tmpl = document.getElementById('templateNewRow').innerHTML.replaceAll('__IDX__', newRowIndex++);
        const tbody = document.getElementById('dsDichVu');
        tbody.insertAdjacentHTML('beforeend', tmpl);
        bindNewRow(tbody.lastElementChild);
    });

    // Xóa dòng mới
    document.getElementById('dsDichVu').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    // Bind sự kiện cho dòng mới vừa thêm
    function bindNewRow(row) {
        const select = row.querySelector('select');
        const soLuongInput = row.querySelector('.so-luong-new');

        function recalc() {
            const opt = select.options[select.selectedIndex];
            const donGia = opt ? parseFloat(opt.dataset.donGia || 0) : 0;
            const soLuong = parseInt(soLuongInput.value || 0);
            row.querySelector('.don-gia-cell').textContent = donGia ? formatVND(donGia) + ' đ' : '—';
            row.querySelector('.thanh-tien-cell').textContent = (donGia && soLuong) ? formatVND(donGia * soLuong) + ' đ' : '—';
        }

        select.addEventListener('change', recalc);
        soLuongInput.addEventListener('input', recalc);
    }

    // Cập nhật thành tiền cho dịch vụ hiện có khi thay đổi số lượng
    document.getElementById('dsDichVu').addEventListener('input', function (e) {
        if (e.target.classList.contains('so-luong-existing')) {
            const row = e.target.closest('tr');
            const donGia = parseFloat(e.target.dataset.donGia || 0);
            const soLuong = parseInt(e.target.value || 0);
            row.querySelector('.thanh-tien-cell').textContent = (donGia && soLuong) ? formatVND(donGia * soLuong) + ' đ' : '—';
        }
    });

    function formatVND(n) {
        return n.toLocaleString('vi-VN');
    }
})();
</script>
@endsection