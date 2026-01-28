<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo tài khoản Admin
        User::create([
            'ten_tai_khoan' => 'admin',
            'so_dien_thoai' => '0123456789',
            'password' => Hash::make('123456'),
            'vai_tro' => 'admin',
        ]);

        // Tạo tài khoản Lễ tân
        User::create([
            'ten_tai_khoan' => 'letan',
            'so_dien_thoai' => '0987654321',
            'password' => Hash::make('123456'),
            'vai_tro' => 'le_tan',
        ]);

        echo "✅ Đã tạo tài khoản admin và lễ tân\n";
        echo "Admin - SĐT: 0123456789 | Mật khẩu: 123456\n";
        echo "Lễ tân - SĐT: 0987654321 | Mật khẩu: 123456\n";
    }
}
