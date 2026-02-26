<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\TrangThaiPhongController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\UserKhachHangController;
use App\Http\Controllers\TrangThaiDatPhongController;
use App\Http\Controllers\DatPhongController;
use App\Http\Controllers\DichVuController;
use App\Http\Controllers\SuDungDichVuController;
use App\Http\Controllers\HoaDonController;

Route::get('/', function () {
    return view('NguoiDung.layouts.gdnguoidung');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Admin - Chỉ admin và lễ tân
    Route::middleware(['role:admin,le_tan'])->group(function () {
        Route::get('/dashboard', function () {
            return view('Admin.layouts.Interface');
        })->name('dashboard');
    });
    
    // Dashboard Người dùng
    Route::middleware(['role:nguoi_dung'])->group(function () {
        Route::get('/nguoidung/home', function () {
            return view('NguoiDung.layouts.gdnguoidung');
        })->name('nguoidung.home');
    }); 
// ROUTES CHO ADMIN & LỄ TÂN (Quản lý hệ thống)
Route::middleware(['role:admin,le_tan'])->prefix('/admin')->name('admin.')->group(function () {
    
    //LoaiPhong
    Route::prefix('loaiphong')->name('loaiphong.')->group(function(){
        Route::get('/', [LoaiPhongController::class, 'index'])->name('index');
        Route::get('/create', [LoaiPhongController::class, 'create'])->name('create');
        Route::post('/store', [LoaiPhongController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LoaiPhongController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [LoaiPhongController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [LoaiPhongController::class, 'destroy'])->name('destroy');
    });
    
    //TrangThaiPhong
    Route::prefix('trangthaiphong')->name('trangthaiphong.')->group(function(){
        Route::get('/', [TrangThaiPhongController::class, 'index'])->name('index');
        Route::get('/create', [TrangThaiPhongController::class, 'create'])->name('create');
        Route::post('/store', [TrangThaiPhongController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TrangThaiPhongController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [TrangThaiPhongController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [TrangThaiPhongController::class, 'destroy'])->name('destroy');
    });
    
    //Phong
    Route::prefix('phong')->name('phong.')->group(function(){
        Route::get('/', [PhongController::class, 'index'])->name('index');
        Route::get('/create', [PhongController::class, 'create'])->name('create');
        Route::post('/store', [PhongController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PhongController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PhongController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PhongController::class, 'destroy'])->name('destroy');
    });
    
    //KhachHang - Quản lý tất cả khách hàng
    Route::prefix('khachhang')->name('khachhang.')->group(function(){
        Route::get('/', [KhachHangController::class, 'index'])->name('index');
        Route::get('/create', [KhachHangController::class, 'create'])->name('create');
        Route::post('/store', [KhachHangController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KhachHangController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [KhachHangController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [KhachHangController::class, 'destroy'])->name('destroy');
    });
    //TrangThaiDatPhong
    Route::prefix('trangthaiDP')->name('trangthaiDP.')->group(function(){
        Route::get('/', [TrangThaiDatPhongController::class, 'index'])->name('index');
        Route::get('/create', [TrangThaiDatPhongController::class, 'create'])->name('create');
        Route::post('/store', [TrangThaiDatPhongController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TrangThaiDatPhongController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [TrangThaiDatPhongController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [TrangThaiDatPhongController::class, 'destroy'])->name('destroy');
    });
    //DatPhong
    Route::prefix('datphong')->name('datphong.')->group(function(){
        Route::get('/', [DatPhongController::class, 'index'])->name('index');
        Route::get('/create', [DatPhongController::class, 'create'])->name('create');
        Route::post('/store', [DatPhongController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DatPhongController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [DatPhongController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [DatPhongController::class, 'destroy'])->name('destroy');
    });
    //DichVu
    Route::prefix('dichvu')->name('dichvu.')->group(function(){
        Route::get('/', [DichVuController::class, 'index'])->name('index');
        Route::get('/create', [DichVuController::class, 'create'])->name('create');
        Route::post('/store', [DichVuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DichVuController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [DichVuController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [DichVuController::class, 'destroy'])->name('destroy');
});
    //SuDungDichVu
    Route::prefix('sudungdichvu')->name('sudungdichvu.')->group(function(){
        Route::get('/', [SuDungDichVuController::class, 'index'])->name('index');
        Route::get('/create', [SuDungDichVuController::class, 'create'])->name('create');
        Route::post('/store', [SuDungDichVuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SuDungDichVuController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [SuDungDichVuController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [SuDungDichVuController::class, 'destroy'])->name('destroy');
    });
    //HoaDon
    Route::prefix('hoadon')->name('hoadon.')->group(function(){
        Route::get('/', [HoaDonController::class, 'index'])->name('index');
        Route::get('/create', [HoaDonController::class, 'create'])->name('create');
        Route::post('/store', [HoaDonController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [HoaDonController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [HoaDonController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [HoaDonController::class, 'destroy'])->name('destroy');
    });
});
// ROUTES CHO NGƯỜI DÙNG (Khách hàng)
Route::middleware(['role:nguoi_dung'])->prefix('/nguoidung')->name('nguoidung.')->group(function () {
    
    // Trang chủ người dùng
    Route::get('/', function () {
        return view('NguoiDung.khachhang.index');
    })->name('index');
    
    // Quản lý thông tin cá nhân
    Route::prefix('thongtin')->name('thongtin.')->group(function(){
        Route::get('/', [UserKhachHangController::class, 'show'])->name('show');
        Route::get('/edit', [UserKhachHangController::class, 'edit'])->name('edit');
        Route::put('/update', [UserKhachHangController::class, 'update'])->name('update');
    });
});
}); // Đóng middleware auth