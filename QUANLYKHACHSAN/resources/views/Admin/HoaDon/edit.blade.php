@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Sửa Hóa Đơn</h2>
        <form action="{{ route('admin.hoadon.update', $hoadon->ma_hoa_don) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ma_dat_phong">Mã Đặt Phòng:</label>
                <select class="form-control" id="ma_dat_phong" name="ma_dat_phong">
                    <option value="">Chọn đặt phòng</option>
                    @foreach($datphongs as $dp)
                        <option value="{{ $dp->ma_dat_phong }}" {{ old('ma_dat_phong', $hoadon->ma_dat_phong) == $dp->ma_dat_phong ? 'selected' : '' }}>
                            Mã ĐP: {{ $dp->ma_dat_phong }} - KH: {{ $dp->khachHang->ho_ten ?? 'N/A' }} - Phòng: {{ $dp->phong->ten_phong ?? 'N/A' }} - Từ {{ \Carbon\Carbon::parse($dp->ngay_nhan_phong)->format('d/m/Y') }} đến {{ \Carbon\Carbon::parse($dp->ngay_tra_phong)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
                @error('ma_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="alert alert-info mt-3">
                <strong>Thông tin hiện tại:</strong><br>
                - Tiền phòng: {{ number_format($hoadon->tong_tien_phong, 0, ',', '.') }} VND<br>
                - Tiền dịch vụ: {{ number_format($hoadon->tong_tien_dich_vu, 0, ',', '.') }} VND<br>
                - Tổng thanh toán: <strong>{{ number_format($hoadon->tong_tien_thanh_toan, 0, ',', '.') }} VND</strong><br>
                - Ngày lập: {{ \Carbon\Carbon::parse($hoadon->ngay_lap_hoa_don)->format('d/m/Y H:i') }}<br>
                <small class="text-muted">* Các giá trị sẽ được tự động tính lại khi thay đổi đặt phòng</small>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập Nhật Hóa Đơn</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Trở Lại</button>
        </form>
    </div>
@endsection
