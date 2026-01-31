@extends('NguoiDung.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thông tin khách hàng</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nguoidung.thongtin.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="ho_ten">Họ và tên</label>
                            <input type="text" class="form-control @error('ho_ten') is-invalid @enderror" 
                                   id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $khachhang->ho_ten ?? '') }}" required>
                            @error('ho_ten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="ngay_sinh">Ngày sinh</label>
                            <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" 
                                   id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $khachhang->ngay_sinh ?? '') }}" required>
                            @error('ngay_sinh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                                <label for="gioi_tinh">Giới tính</label>
                                <select class="form-control @error('gioi_tinh') is-invalid @enderror" 
                                        id="gioi_tinh" name="gioi_tinh" required>
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                    <option value="Khác" {{ old('gioi_tinh', $khachhang->gioi_tinh ?? '') == 'Khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('gioi_tinh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="cccd">CMND/CCCD</label>
                            <input type="text" class="form-control @error('cccd') is-invalid @enderror" 
                                   id="cccd" name="cccd" value="{{ old('cccd', $khachhang->cccd ?? '') }}" required>
                            @error('cccd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="so_dien_thoai">Số điện thoại</label>
                            <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" 
                                   id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai', $khachhang->so_dien_thoai ?? '') }}" required>
                            @error('so_dien_thoai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $khachhang->email ?? '') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="diachi">Địa chỉ</label>
                            <textarea class="form-control @error('diachi') is-invalid @enderror" 
                                      id="diachi" name="diachi" rows="3">{{ old('diachi', $khachhang->diachi ?? '') }}</textarea>
                            @error('diachi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
