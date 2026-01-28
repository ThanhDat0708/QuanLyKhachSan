<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\TrangThaiPhongController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\AuthController;

// Routes công khai (không cần đăng nhập)
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//* Routes cho Admin - Yêu cầu đăng nhập *//
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin - Chỉ admin và lễ tân
    Route::get('/dashboard', function () {
        if (auth()->user()->vai_tro == 'admin' || auth()->user()->vai_tro == 'le_tan') {
            return view('Admin.layouts.Interface');
        }
        abort(403, 'Bạn không có quyền truy cập!');
    })->name('dashboard');
    
    // Dashboard Khách hàng
    Route::get('/khachhang/dashboard', function () {
        if (auth()->user()->vai_tro == 'nguoi_dung') {
            return view('khachhang.dashboard');
        }
        abort(403, 'Bạn không có quyền truy cập!');
    })->name('khachhang.dashboard');
//LoaiPhong
Route::prefix('/admin/loaiphong')->name('admin.loaiphong.')->group(function(){
    Route::get('/',[LoaiPhongController::class,'index'])->name('index');
    Route::get('/create',[LoaiPhongController::class,'create'])->name('create');
    Route::post('/store',[LoaiPhongController::class,'store'])->name('store');
    Route::get('/{id}/edit',[LoaiPhongController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[LoaiPhongController::class,'update'])->name('update');
    Route::delete('/{id}/destroy',[LoaiPhongController::class,'destroy'])->name('destroy');
});
//TrangThaiPhong
Route::prefix('/admin/trangthaiphong')->name('admin.trangthaiphong.')->group(function(){
    Route::get('/',[TrangThaiPhongController::class,'index'])->name('index');
    Route::get('/create',[TrangThaiPhongController::class,'create'])->name('create');
    Route::post('/store',[TrangThaiPhongController::class,'store'])->name('store');
    Route::get('/{id}/edit',[TrangThaiPhongController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[TrangThaiPhongController::class,'update'])->name('update');
    Route::delete('/{id}/destroy',[TrangThaiPhongController::class,'destroy'])->name('destroy');
});
//Phong
Route::prefix('/admin/phong')->name('admin.phong.')->group(function(){
    Route::get('/',[PhongController::class,'index'])->name('index');
    Route::get('/create',[PhongController::class,'create'])->name('create');
    Route::post('/store',[PhongController::class,'store'])->name('store');
    Route::get('/{id}/edit',[PhongController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[PhongController::class,'update'])->name('update');
    Route::delete('/{id}/destroy',[PhongController::class,'destroy'])->name('destroy');
}); 
//KhachHang
Route::prefix('/admin/khachhang')->name('admin.khachhang.')->group(function(){
    Route::get('/',[App\Http\Controllers\KhachHangController::class,'index'])->name('index');
    Route::get('/create',[App\Http\Controllers\KhachHangController::class,'create'])->name('create');
    Route::post('/store',[App\Http\Controllers\KhachHangController::class,'store'])->name('store');
    Route::get('/{id}/edit',[App\Http\Controllers\KhachHangController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[App\Http\Controllers\KhachHangController::class,'update'])->name('update');
    Route::delete('/{id}/destroy',[App\Http\Controllers\KhachHangController::class,'destroy'])->name('destroy');
});
}); // Đóng middleware auth