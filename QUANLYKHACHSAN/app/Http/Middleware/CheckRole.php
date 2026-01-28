<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles - Các vai trò được phép truy cập
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }
        
        // Kiểm tra vai trò
        if (!in_array(auth()->user()->vai_tro, $roles)) {
            abort(403, 'Bạn không có quyền truy cập trang này!');
        }
        
        return $next($request);
    }
}
