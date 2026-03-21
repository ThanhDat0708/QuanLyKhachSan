@extends('Admin.layouts.Interface')
@section('title','Chi Tiết Trạng Thái Phòng')
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Chi Tiết Trạng Thái Phòng</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label text-muted">Mã trạng thái phòng</label>
                    <div class="fw-bold">{{ $trangthaiphong->ma_trang_thai }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted">Tên trạng thái phòng</label>
                    <div class="fw-bold">{{ $trangthaiphong->ten_trang_thai }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted">Số phòng thuộc trạng thái</label>
                    <div class="fw-bold">{{ $trangthaiphong->phongs_count }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Ngày tạo</label>
                    <div class="fw-bold">{{ optional($trangthaiphong->created_at)->format('d/m/Y H:i') ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted">Ngày cập nhật</label>
                    <div class="fw-bold">{{ optional($trangthaiphong->updated_at)->format('d/m/Y H:i') ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('admin.trangthaiphong.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.trangthaiphong.edit', $trangthaiphong->ma_trang_thai) }}" class="btn btn-warning">Sửa trạng thái</a>
    </div>
</div>
@endsection
