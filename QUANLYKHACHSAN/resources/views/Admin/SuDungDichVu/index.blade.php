@extends('Admin.layouts.Interface')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Quản Lý Dịch Vụ</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <a href="{{ route('admin.sudungdichvu.create') }}" class="btn btn-primary mb-3">Thêm Sử Dụng Dịch Vụ Mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Sử Dụng Dịch Vụ</th>
                    <th>Phòng</th>
                    <th>Tên Dịch Vụ</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Ngày Sử Dụng</th>
                    <th>Hành Động</th>  
                </tr>
            </thead>
            <tbody>
                @foreach ($sudungdichvus as $sudungdichvu)
                    <tr>
                        <td>{{ $sudungdichvu->ma_sd_dich_vu }}</td>
                        <td>{{ $sudungdichvu->datPhong->phong->ten_phong }}</td>
                        <td>{{ $sudungdichvu->dichVu->ten_dich_vu }}</td>
                        <td>{{ $sudungdichvu->so_luong }}</td>
                        <td>{{ number_format($sudungdichvu->don_gia, 0, ',', '.') }} VND</td>
                        <td>{{ $sudungdichvu->ngay_su_dung->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.sudungdichvu.edit', $sudungdichvu->ma_sd_dich_vu) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.sudungdichvu.destroy', $sudungdichvu->ma_sd_dich_vu) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi sử dụng dịch vụ này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $sudungdichvus->links() }}   
@endsection