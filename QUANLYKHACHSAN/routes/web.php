<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\TrangThaiPhongController;
use App\Http\Controllers\PhongController;
Route::get('/', function () {
    return view('Admin.layouts.Interface');
});
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