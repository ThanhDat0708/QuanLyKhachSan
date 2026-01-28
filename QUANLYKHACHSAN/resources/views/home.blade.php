<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách Sạn - Trang Chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
            font-size: 1.5rem;
        }
        .feature-card {
            padding: 30px;
            border-radius: 10px;
            transition: transform 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-custom {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            margin: 0 10px;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 50px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">🏨 KHÁCH SẠN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#rooms">Phòng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Dịch Vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Liên Hệ</a>
                    </li>
                    @auth
                        @if(auth()->user()->vai_tro == 'admin' || auth()->user()->vai_tro == 'le_tan')
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white" href="{{ route('dashboard') }}">Quản Lý</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-info text-white" href="{{ route('khachhang.dashboard') }}">Tài Khoản</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary" href="{{ route('login') }}">Đăng Nhập</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('register') }}">Đăng Ký</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Chào Mừng Đến Với Khách Sạn</h1>
            <p>Trải nghiệm dịch vụ lưu trú đẳng cấp 5 sao</p>
            <div>
                <a href="#rooms" class="btn btn-light btn-custom">Xem Phòng</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">Đăng Ký Ngay</a>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-5">
        <div class="container">
            <h2 class="section-title">Các Loại Phòng</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Phòng Standard">
                        <div class="card-body">
                            <h5 class="card-title">Phòng Standard</h5>
                            <p class="card-text">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản</p>
                            <p class="text-primary fw-bold">Từ 500.000 VNĐ/đêm</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Đặt Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Phòng Deluxe">
                        <div class="card-body">
                            <h5 class="card-title">Phòng Deluxe</h5>
                            <p class="card-text">Phòng cao cấp với view đẹp và không gian rộng rãi</p>
                            <p class="text-primary fw-bold">Từ 800.000 VNĐ/đêm</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Đặt Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Phòng Suite">
                        <div class="card-body">
                            <h5 class="card-title">Phòng Suite</h5>
                            <p class="card-text">Phòng sang trọng nhất với đầy đủ tiện nghi 5 sao</p>
                            <p class="text-primary fw-bold">Từ 1.500.000 VNĐ/đêm</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Đặt Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Dịch Vụ Của Chúng Tôi</h2>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="feature-card bg-white">
                        <div class="display-4 mb-3">🍽️</div>
                        <h5>Nhà Hàng</h5>
                        <p>Ẩm thực đa dạng</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-card bg-white">
                        <div class="display-4 mb-3">🏊</div>
                        <h5>Bể Bơi</h5>
                        <p>Hồ bơi ngoài trời</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-card bg-white">
                        <div class="display-4 mb-3">💆</div>
                        <h5>Spa</h5>
                        <p>Massage & Thư giãn</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="feature-card bg-white">
                        <div class="display-4 mb-3">🅿️</div>
                        <h5>Bãi Đỗ Xe</h5>
                        <p>Miễn phí 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="section-title">Liên Hệ Với Chúng Tôi</h2>
            <p class="lead">📞 Hotline: 1900-xxxx</p>
            <p class="lead">📧 Email: contact@hotel.com</p>
            <p class="lead">📍 Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2026 Khách Sạn. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
