<?php

namespace App\Providers;

use App\Models\DatPhong;
use App\Models\Phong;
use App\Models\TrangThaiDatPhong;
use App\Models\TrangThaiPhong;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tự động cập nhật trạng thái phòng về "Còn Trống" khi hết hạn đặt phòng (mỗi 10 phút)
        if (!app()->runningInConsole()) {
            $lastRun = Cache::get('cap_nhat_trang_thai_phong', 0);
            if (time() - $lastRun > 600) {
                Cache::put('cap_nhat_trang_thai_phong', time());

                $trangThaiTrong = TrangThaiPhong::where('ten_trang_thai', 'like', '%trống%')
                    ->orWhere('ten_trang_thai', 'like', '%Trống%')
                    ->first();

                if ($trangThaiTrong) {
                    $trangThaiHuyIds = TrangThaiDatPhong::where('ten_trang_thai_dat_phong', 'like', '%hủy%')
                        ->orWhere('ten_trang_thai_dat_phong', 'like', '%hoàn%')
                        ->pluck('ma_trang_thai_dat_phong')->toArray();

                    $phongHetPhong = Phong::where('ma_trang_thai', '!=', $trangThaiTrong->ma_trang_thai)->get();

                    foreach ($phongHetPhong as $phong) {
                        $conDatPhong = DatPhong::where('ma_phong', $phong->ma_phong)
                            ->whereNotIn('ma_trang_thai_dat_phong', $trangThaiHuyIds)
                            ->where('ngay_tra_phong', '>', Carbon::now())
                            ->exists();

                        if (!$conDatPhong) {
                            $phong->ma_trang_thai = $trangThaiTrong->ma_trang_thai;
                            $phong->save();
                        }
                    }
                }
            }
        }
    }
}
