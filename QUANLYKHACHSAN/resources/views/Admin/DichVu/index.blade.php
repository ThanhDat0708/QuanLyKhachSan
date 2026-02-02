@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Quản Lý Dịch Vụ</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('admin.dichvu.create') }}" class="btn btn-primary mb-3">Thêm Dịch Vụ Mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Dịch Vụ</th>
                    <th>Tên Dịch Vụ</th>
                    <th>Đơn Giá</th>
                    <th>Số Lượng</th>
                    <th>Mô Tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dichvus as $dichvu)
                    <tr>
                        <td>{{ $dichvu->ma_dich_vu }}</td>
                        <td>{{ $dichvu->ten_dich_vu }}</td>
                        <td>{{ number_format($dichvu->don_gia, 0, ',', '.') }} VND</td>
                        <td>{{ $dichvu->so_luong }}</td>
                        <td>{{ $dichvu->mo_ta }}</td>
                        <td>
                            <a href="{{ route('admin.dichvu.edit', $dichvu->ma_dich_vu) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.dichvu.destroy', $dichvu->ma_dich_vu) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dichvus->links() }}
    </div>
@endsection
