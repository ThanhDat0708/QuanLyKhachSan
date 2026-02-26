@extends('Admin.layouts.Interface')
@section('title', 'Thêm Hóa Đơn Mới')
@section('content')
<div class="container">
    <h1 class="text-center">Thêm Hóa Đơn Mới</h1>
    <form action="{{ route('admin.hoadon.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_dat_phong">Mã Đặt Phòng:</label>
            <select class="form-control" id="ma_dat_phong" name="ma_dat_phong">
                <option value="">Chọn đặt phòng</option>
                @foreach($datphongs as $dp)
                    <option value="{{ $dp->ma_dat_phong }}" {{ old('ma_dat_phong') == $dp->ma_dat_phong ? 'selected' : '' }}>
                        Mã ĐP: {{ $dp->ma_dat_phong }} - KH: {{ $dp->khachHang->ho_ten ?? 'N/A' }} - Phòng: {{ $dp->phong->ten_phong ?? 'N/A' }} - Từ {{ \Carbon\Carbon::parse($dp->ngay_nhan_phong)->format('d/m/Y') }} đến {{ \Carbon\Carbon::parse($dp->ngay_tra_phong)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
            @error('ma_dat_phong')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Thêm Hóa Đơn</button>
        <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Trở Lại</button>
    </form>
</div>
@endsection
