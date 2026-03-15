<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Grand Hotel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nguoidung-app.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Sidebar Backdrop (mobile) -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="app-sidebar" id="appSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">
               <span><img src="{{ asset('images/logo.png') }}" alt="DNC Hotel" class="brand-logo" style="width:36px; height:36px; object-fit:contain; border-radius:8px;"></span>
                <span class="brand-name">DNC Hotel</span>
            </a>
        </div>
        <div class="sidebar-nav">
            <div class="nav-label">Menu chính</div>
            <a class="nav-link {{ request()->routeIs('nguoidung.index') ? 'active' : '' }}"
                href="{{ route('nguoidung.index') }}">
                <i class="fas fa-th-large"></i> Tổng quan
            </a>
            <a class="nav-link {{ request()->routeIs('nguoidung.thongtin.*') ? 'active' : '' }}"
                href="{{ route('nguoidung.thongtin.show') }}">
                <i class="fas fa-user"></i> Thông tin cá nhân
            </a>

            <div class="nav-label">Đặt phòng</div>
            <a class="nav-link {{ request()->routeIs('nguoidung.datphong.danhsach') || request()->routeIs('nguoidung.datphong.datphong') ? 'active' : '' }}"
                href="{{ route('nguoidung.datphong.danhsach') }}">
                <i class="fas fa-door-open"></i> Phòng trống
            </a>
            <a class="nav-link {{ request()->routeIs('nguoidung.datphong.lichsu') || request()->routeIs('nguoidung.datphong.chitiet') ? 'active' : '' }}"
                href="{{ route('nguoidung.datphong.lichsu') }}">
                <i class="fas fa-clock-rotate-left"></i> Lịch sử đặt phòng
            </a>

            <div class="nav-divider"></div>
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-arrow-left"></i> Về trang chủ
            </a>
        </div>

        <div class="sidebar-user">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(mb_substr(auth()->user()->ten_tai_khoan, 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">{{ auth()->user()->ten_tai_khoan }}</div>
                    <div class="user-role">Khách hàng</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Topbar -->
    <header class="app-topbar">
        <div class="topbar-left">
            <button class="btn-sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <span class="page-title">@yield('page-heading', 'Trang chủ')</span>
        </div>
        <div class="topbar-right">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-topbar" title="Đăng xuất">
                    <i class="fas fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="app-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-circle-check me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-circle-xmark me-2 fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('appSidebar').classList.toggle('show');
            document.getElementById('sidebarBackdrop').classList.toggle('show');
        }
    </script>
    @yield('scripts')
</body>
</html>
