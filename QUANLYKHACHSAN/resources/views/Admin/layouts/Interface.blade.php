<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Quản Lý Khách Sạn')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a5f;
            --primary-light: #2c5282;
            --accent: #3182ce;
            --accent-hover: #2b6cb0;
            --success: #38a169;
            --warning: #d69e2e;
            --danger: #e53e3e;
            --light: #f7fafc;
            --dark: #1a202c;
            --gray: #718096;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--light);
            min-height: 100vh;
            color: var(--dark);
        }

        /* ========== NAVBAR ========== */
        .admin-navbar {
            background: linear-gradient(135deg, var(--primary), var(--primary-light)) !important;
            padding: 0 20px;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .admin-navbar .navbar-brand {
            padding: 5px 0;
        }

        .admin-navbar .navbar-brand img {
            filter: brightness(1.1);
            transition: transform 0.3s;
        }

        .admin-navbar .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .admin-navbar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            padding: 12px 16px !important;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease;
            margin: 2px;
        }

        .admin-navbar .nav-link:hover,
        .admin-navbar .nav-link:focus {
            color: #fff !important;
            background: rgba(255,255,255,0.15);
        }

        .admin-navbar .nav-link i {
            margin-right: 5px;
            font-size: 0.85rem;
        }

        .admin-navbar .dropdown-toggle::after {
            margin-left: 6px;
            vertical-align: middle;
        }

        .admin-navbar .navbar-toggler {
            border-color: rgba(255,255,255,0.3);
            padding: 6px 10px;
        }

        .admin-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Dropdown */
        .admin-navbar .dropdown-menu {
            background: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px;
            box-shadow: var(--shadow-lg);
            margin-top: 8px;
            min-width: 200px;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .admin-navbar .dropdown-menu .dropdown-item {
            color: var(--dark);
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.15s;
        }

        .admin-navbar .dropdown-menu .dropdown-item:hover {
            background: #edf2f7;
            color: var(--accent);
            padding-left: 20px;
        }

        .admin-navbar .dropdown-menu .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
            color: var(--gray);
        }

        .admin-navbar .dropdown-menu .dropdown-item:hover i {
            color: var(--accent);
        }

        /* User badge in navbar */
        .user-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255,255,255,0.15);
            padding: 4px 12px;
            border-radius: 20px;
            color: #fff;
            font-size: 0.85rem;
            margin-right: 5px;
        }

        .user-badge i { margin-right: 6px; }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            padding: 25px;
            min-height: calc(100vh - 70px);
        }

        /* ========== CARDS ========== */
        .card {
            background: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            border-bottom: 2px solid var(--border);
            padding: 15px 20px;
        }

        .card-body { padding: 20px; }

        /* ========== BUTTONS ========== */
        .btn {
            padding: 8px 18px;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow); }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-hover); }
        .btn-success { background: var(--success); color: #fff; }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-warning { background: var(--warning); color: #fff; }
        .btn-secondary { background: var(--gray); color: #fff; }
        .btn-info { background: #4299e1; color: #fff; }

        /* ========== FORMS ========== */
        .form-group { margin-bottom: 15px; }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(49,130,206,0.15);
        }

        /* ========== TABLE ========== */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .table th {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table tbody tr { transition: background 0.15s; }
        .table tbody tr:hover { background: #f7fafc; }

        /* ========== ALERTS ========== */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        /* ========== BADGES ========== */
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ========== PAGINATION ========== */
        .pagination { margin-top: 15px; }
        .page-link { color: var(--accent); border-color: var(--border); }
        .page-item.active .page-link { background: var(--accent); border-color: var(--accent); }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991px) {
            .admin-navbar .navbar-collapse {
                background: var(--primary);
                padding: 10px;
                border-radius: 0 0 8px 8px;
                margin: 0 -20px;
            }
            .admin-navbar .dropdown-menu {
                background: rgba(255,255,255,0.1);
                box-shadow: none;
            }
            .admin-navbar .dropdown-menu .dropdown-item {
                color: rgba(255,255,255,0.85);
            }
            .admin-navbar .dropdown-menu .dropdown-item:hover {
                background: rgba(255,255,255,0.15);
                color: #fff;
            }
            .main-content { padding: 15px; }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100" height="70"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                    @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'le_tan')
                    {{-- Admin & Lễ tân: Quản Lý Phòng dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-hotel"></i> Quản Lý Phòng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.phong.index') }}"><i class="fas fa-door-open"></i> Phòng</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.loaiphong.index') }}"><i class="fas fa-layer-group"></i> Loại Phòng</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.trangthaiphong.index') }}"><i class="fas fa-toggle-on"></i> Trạng Thái Phòng</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'le_tan')
                    {{-- Admin & Lễ tân: Quản Lý Đặt Phòng dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-check"></i> Đặt Phòng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.datphong.index') }}"><i class="fas fa-calendar-plus"></i> Đặt Phòng</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.trangthaiDP.index') }}"><i class="fas fa-list-check"></i> Trạng Thái Đặt Phòng</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.khachhang.index') }}"><i class="fas fa-users"></i> Khách Hàng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dichvu.index') }}"><i class="fas fa-concierge-bell"></i> Dịch Vụ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.sudungdichvu.index') }}"><i class="fas fa-clipboard-list"></i> SD Dịch Vụ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hoadon.index') }}"><i class="fas fa-file-invoice-dollar"></i> Hóa Đơn</a>
                    </li>

                    @if(auth()->user()->vai_tro === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.doanhthu.index') }}"><i class="fas fa-chart-line"></i> Doanh Thu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.taikhoan.index') }}"><i class="fas fa-user-shield"></i>  Quản Lý Tài Khoản</a>
                    </li>
                    @endif
                </ul>

                {{-- Tài khoản bên phải --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="user-badge">
                                <i class="fas fa-user-circle"></i>
                                {{ auth()->user()->ten_tai_khoan }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text text-muted" style="font-size: 0.8rem;">
                                    <i class="fas fa-shield-alt"></i>
                                    {{ auth()->user()->vai_tro === 'admin' ? 'Quản trị viên' : 'Lễ tân' }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
