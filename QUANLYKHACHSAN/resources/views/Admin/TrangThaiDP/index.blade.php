@extends('Admin.layouts.Interface')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Sách Trạng Thái Đặt Phòng</h3>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <a href="{{ route('admin.trangthaidatphong.create') }}" class="btn btn-primary mb-3">Thêm Trạng Thái Đặt Phòng Mới</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã Trạng Thái Đặt Phòng</th>
                                    <th>Tên Trạng Thái Đặt Phòng</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trangthaidatphongs as $trangthaidatphong)
                                    <tr>
                                        <td>{{ $trangthaidatphong->ma_trang_thai_dat_phong }}</td>
                                        <td>{{ $trangthaidatphong->ten_trang_thai_dat_phong }}</td>
                                        <td>
                                            <a href="{{ route('admin.trangthaidatphong.edit', $trangthaidatphong->ma_trang_thai_dat_phong) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form
                                                action="{{ route('admin.trangthaidatphong.destroy', $trangthaidatphong->ma_trang_thai_dat_phong) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa trạng thái đặt phòng này không?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trangthaidatphongs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection