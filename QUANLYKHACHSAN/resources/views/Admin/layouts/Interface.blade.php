<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Quản Lý Khách Sạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>
<style>
:root {
  --primary: #2c3e50;
  --secondary: #34495e;
  --accent: #3498db;
  --success: #27ae60;
  --warning: #f39c12;
  --danger: #e74c3c;
  --light: #ecf0f1;
  --dark: #1a252f;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background: #f5f6fa;
  min-height: 100vh;
  color: var(--dark);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Cards */
.card {
  background: #fff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  margin-bottom: 20px;
}

.card-header {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 15px;
  color: var(--primary);
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
}

/* Buttons */
.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: 500;
  cursor: pointer;
  transition: opacity 0.2s;
}

.btn:hover { opacity: 0.9; }
.btn-primary { background: var(--accent); color: #fff; }
.btn-success { background: var(--success); color: #fff; }
.btn-danger { background: var(--danger); color: #fff; }
.btn-secondary { background: var(--secondary); color: #fff; }

/* Form */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: var(--secondary);
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: border-color 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--accent);
}

/* Table */
.table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
}

.table th, .table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.table th {
  background: var(--primary);
  color: #fff;
  font-weight: 600;
}

.table tr:hover { background: #f8f9fa; }

/* Badges */
.badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: 500;
}

.badge-success { background: #d4edda; color: #155724; }
.badge-warning { background: #fff3cd; color: #856404; }
.badge-danger { background: #f8d7da; color: #721c24; }
.badge-info { background: #d1ecf1; color: #0c5460; }

/* Navbar */
.navbar {
  background: var(--primary) !important;
  padding: 10px 20px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.navbar .navbar-brand {
  color: #fff !important;
  font-weight: 600;
}

.navbar .nav-link {
  color: rgba(255,255,255,0.85) !important;
  padding: 8px 15px;
  border-radius: 4px;
  transition: background 0.2s;
}

/* Dropdown */
.dropdown-menu {
  background: #fff;
  border: 1px solid #eee;
  border-radius: 6px;
  padding: 5px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  margin-top: 5px;
}

.dropdown-menu .nav-link,
.dropdown-menu .dropdown-item {
  color: var(--dark) !important;
  padding: 8px 15px;
  border-radius: 4px;
}

.dropdown-menu .nav-link:hover,
.dropdown-menu .dropdown-item:hover {
  background: #f5f6fa;
  color: var(--accent) !important;
}

/* Main content */
.main-content {
  padding: 20px;
}

/* Stats */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
}

.stat-card {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.stat-card .stat-number {
  font-size: 2rem;
  font-weight: 700;
  color: var(--accent);
}

.stat-card .stat-label {
  color: var(--secondary);
  font-size: 0.9rem;
}

</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                   <img src="{{ asset('images/logo.png') }}" alt="Logo" width="120" height="90"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown"role="button" data-bs-toggle="dropdown"aria-expanded="false">
                            Quản Lý Phòng
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('admin.phong.index') }}">Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.loaiphong.index') }}">Loại Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.trangthaiphong.index') }}">Trạng Thái Phòng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown"role="button" data-bs-toggle="dropdown"aria-expanded="false">
                            Quản Lý Đặt Phòng
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.datphong.index') }}">Đặt Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.trangthaiDP.index') }}">Trạng Thái Đặt Phòng</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.khachhang.index') }}">Khách Hàng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dichvu.index') }}">Dịch Vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.sudungdichvu.index') }}">Dịch Vụ Sử Dụng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hoadon.index') }}">Hóa Đơn</a>
                    </li>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown"role="button" data-bs-toggle="dropdown"aria-expanded="false">
                            Tài Khoản
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Đăng Nhập</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0; text-align: left; width: 100%;">
                                        Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul> 
                    </div>
                </ul>   
        </div>
    </nav>

    <!-- Nội dung trang sẽ hiển thị ở đây -->
    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>
