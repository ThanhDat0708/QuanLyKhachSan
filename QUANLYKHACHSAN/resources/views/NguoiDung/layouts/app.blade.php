<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Grand Hotel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --navbar-height: 64px;
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #4f46e5;
            --body-bg: #f1f5f9;
            --card-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            --card-shadow-hover: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -2px rgba(0,0,0,.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--body-bg);
            color: #334155;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .app-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-brand a {
            color: #fff;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .sidebar-nav .nav-label {
            font-size: .68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            padding: 12px 14px 6px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #94a3b8;
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all .2s ease;
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: .95rem;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: #e2e8f0;
        }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
            box-shadow: 0 4px 12px rgba(79,70,229,.35);
        }

        .sidebar-nav .nav-divider {
            height: 1px;
            background: rgba(255,255,255,.06);
            margin: 12px 14px;
        }

        .sidebar-user {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-user .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255,255,255,.05);
        }

        .sidebar-user .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #06b6d4, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: .85rem;
        }

        .sidebar-user .user-name {
            color: #e2e8f0;
            font-size: .85rem;
            font-weight: 600;
        }

        .sidebar-user .user-role {
            color: #64748b;
            font-size: .72rem;
        }

        /* ===== TOPBAR ===== */
        .app-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--navbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 1030;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-left .page-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-right .btn-topbar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all .2s;
            cursor: pointer;
            text-decoration: none;
        }

        .topbar-right .btn-topbar:hover {
            background: #f8fafc;
            color: var(--primary);
            border-color: var(--primary-light);
        }

        .btn-sidebar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
        }

        /* ===== MAIN CONTENT ===== */
        .app-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 28px;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* ===== RESPONSIVE ===== */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            z-index: 1039;
        }

        @media (max-width: 991.98px) {
            .app-sidebar {
                transform: translateX(-100%);
            }
            .app-sidebar.show {
                transform: translateX(0);
            }
            .sidebar-backdrop.show {
                display: block;
            }
            .app-topbar {
                left: 0;
            }
            .app-content {
                margin-left: 0;
            }
            .btn-sidebar-toggle {
                display: flex;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .card-modern {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: var(--card-shadow);
            transition: box-shadow .25s ease, transform .25s ease;
        }

        .card-modern:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: .75rem;
        }

        .btn-primary-gradient {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 24px;
            transition: all .25s ease;
            box-shadow: 0 2px 8px rgba(79,70,229,.25);
        }

        .btn-primary-gradient:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,.35);
            color: #fff;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
        }

        .table {
            font-size: .875rem;
        }

        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: .72rem;
            letter-spacing: .5px;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 16px;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
        }

        /* Scrollbar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #475569; border-radius: 4px; }

        @yield('page-styles')
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar Backdrop (mobile) -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="app-sidebar" id="appSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">
                <span class="brand-icon"><i class="fas fa-hotel"></i></span>
                Grand Hotel
            </a>
        </div>

        <div class="sidebar-nav">
            <div class="nav-label">Menu chính</div>
            <a class="nav-link {{ request()->routeIs('nguoidung.index') ? 'active' : '' }}" href="{{ route('nguoidung.index') }}">
                <i class="fas fa-th-large"></i> Tổng quan
            </a>
            <a class="nav-link {{ request()->routeIs('nguoidung.thongtin.*') ? 'active' : '' }}" href="{{ route('nguoidung.thongtin.show') }}">
                <i class="fas fa-user"></i> Thông tin cá nhân
            </a>

            <div class="nav-label">Đặt phòng</div>
            <a class="nav-link {{ request()->routeIs('nguoidung.datphong.danhsach') || request()->routeIs('nguoidung.datphong.datphong') ? 'active' : '' }}" href="{{ route('nguoidung.datphong.danhsach') }}">
                <i class="fas fa-door-open"></i> Phòng trống
            </a>
            <a class="nav-link {{ request()->routeIs('nguoidung.datphong.lichsu') || request()->routeIs('nguoidung.datphong.chitiet') ? 'active' : '' }}" href="{{ route('nguoidung.datphong.lichsu') }}">
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
            <a href="{{ route('home') }}" class="btn-topbar" title="Trang chủ website">
                <i class="fas fa-globe"></i>
            </a>
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-circle-check me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
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
