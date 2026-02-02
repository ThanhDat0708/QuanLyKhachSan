@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Sửa Sử Dụng Dịch Vụ</h2>
        <form action="{{ route('admin.sudungdichvu.update', $sudungdichvu->ma_sd_dich_vu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ma_dat_phong">Mã Đặt Phòng:</label>
                <select class="form-control" id="ma_dat_phong" name="ma_dat_phong">
                    <option value="">-- Chọn đặt phòng --</option>
                    @foreach($datphongs as $datphong)
                        <option value="{{ $datphong->ma_dat_phong }}" 
                            {{ old('ma_dat_phong', $sudungdichvu->ma_dat_phong) == $datphong->ma_dat_phong ? 'selected' : '' }}>
                            Phòng {{ $datphong->phong->ma_phong }} - {{ $datphong->khachHang->ho_ten ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('ma_dat_phong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ma_dich_vu">Dịch Vụ:</label>
                <select class="form-control" id="ma_dich_vu" name="ma_dich_vu">
                    <option value="">-- Chọn dịch vụ --</option>
                    @foreach($dichvus as $dichvu)
                        <option value="{{ $dichvu->ma_dich_vu }}" data-price="{{ $dichvu->don_gia }}" 
                            {{ old('ma_dich_vu', $sudungdichvu->ma_dich_vu) == $dichvu->ma_dich_vu ? 'selected' : '' }}>
                            {{ $dichvu->ten_dich_vu }} - {{ number_format($dichvu->don_gia, 0, ',', '.') }} VNĐ
                        </option>
                    @endforeach
                </select>
                @error('ma_dich_vu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="so_luong">Số Lượng:</label>
                <input type="number" class="form-control" id="so_luong" name="so_luong" 
                    value="{{ old('so_luong', $sudungdichvu->so_luong) }}" min="1" placeholder="Nhập số lượng...">
                @error('so_luong')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="don_gia">Đơn Giá:</label>
                <input type="number" class="form-control" id="don_gia" name="don_gia" 
                    value="{{ old('don_gia', $sudungdichvu->don_gia) }}" step="0.01" placeholder="Nhập đơn giá...">
                @error('don_gia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ngay_su_dung">Ngày Sử Dụng:</label>
                <input type="datetime-local" class="form-control" id="ngay_su_dung" name="ngay_su_dung" 
                    value="{{ old('ngay_su_dung', $sudungdichvu->ngay_su_dung ? $sudungdichvu->ngay_su_dung->format('Y-m-d\TH:i') : '') }}">
                @error('ngay_su_dung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập Nhật</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Trở Lại</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-fill price when service is selected
            document.getElementById('ma_dich_vu').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var price = selectedOption.getAttribute('data-price');
                if (price) {
                    document.getElementById('don_gia').value = price;
                }
            });
        });
    </script>
@endsection
