<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách Sạn - DNC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --gold: #d4a853;
            --dark: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            padding: 16px 0;
            transition: all .35s ease;
        }

        .top-navbar.scrolled {
            background: rgba(255, 255, 255, .97);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
            padding: 10px 0;
        }

        .top-navbar .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-navbar .navbar-brand img {
            height: 52px;
            width: auto;
            filter: brightness(1.1);
            transition: all .35s ease;
        }

        .top-navbar .navbar-brand .brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            transition: color .35s ease;
        }

        .top-navbar .navbar-brand .brand-sub {
            font-family: 'Inter', sans-serif;
            font-size: .65rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .55);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            transition: color .35s ease;
        }

        .top-navbar.scrolled .navbar-brand img {
            filter: brightness(0.15);
        }

        .top-navbar.scrolled .navbar-brand .brand-text {
            color: var(--dark);
        }

        .top-navbar.scrolled .navbar-brand .brand-sub {
            color: #94a3b8;
        }

        .top-navbar.scrolled .navbar-brand {
            color: var(--dark);
        }

        .top-navbar .nav-link {
            color: rgba(255, 255, 255, .85);
            font-weight: 500;
            font-size: .9rem;
            padding: 8px 16px !important;
            transition: color .2s;
        }

        .top-navbar.scrolled .nav-link {
            color: #475569;
        }

        .top-navbar .nav-link:hover {
            color: #fff;
        }

        .top-navbar.scrolled .nav-link:hover {
            color: var(--primary);
        }

        .btn-nav-login {
            padding: 8px 22px;
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 50px;
            color: #fff;
            font-weight: 600;
            font-size: .85rem;
            text-decoration: none;
            transition: all .25s;
        }

        .btn-nav-login:hover {
            background: #fff;
            color: var(--dark);
        }

        .top-navbar.scrolled .btn-nav-login {
            border-color: var(--primary);
            color: var(--primary);
        }

        .top-navbar.scrolled .btn-nav-login:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-nav-register {
            padding: 8px 22px;
            border: none;
            border-radius: 50px;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            font-size: .85rem;
            text-decoration: none;
            transition: all .25s;
            box-shadow: 0 2px 8px rgba(79, 70, 229, .3);
        }

        .btn-nav-register:hover {
            background: var(--primary-light);
            color: #fff;
            transform: translateY(-1px);
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, .5);
        }

        .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        .top-navbar.scrolled .navbar-toggler {
            border-color: #cbd5e1;
        }

        .top-navbar.scrolled .navbar-toggler-icon {
            filter: none;
        }

        /* ===== HERO ===== */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: #0f172a;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/dnc.jpg') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            opacity: .55;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, .7) 0%, rgba(30, 41, 59, .45) 50%, rgba(51, 65, 85, .3) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero p.lead {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, .65);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .btn-hero {
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: .95rem;
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            box-shadow: 0 4px 20px rgba(79, 70, 229, .35);
        }

        .btn-hero-primary:hover {
            background: var(--primary-light);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, .4);
        }

        .btn-hero-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .3);
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border-color: rgba(255, 255, 255, .6);
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-top: 56px;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .hero-stats .stat-item h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #fff;
            font-weight: 700;
        }

        .hero-stats .stat-item p {
            color: rgba(255, 255, 255, .5);
            font-size: .82rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        /* ===== SECTIONS ===== */
        .section {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header .section-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 50px;
            background: rgba(79, 70, 229, .08);
            color: var(--primary);
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 14px;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .section-header p {
            color: #64748b;
            font-size: 1.05rem;
            max-width: 540px;
            margin: 12px auto 0;
        }

        /* Room Cards */
        .room-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
            transition: all .35s ease;
            border: 1px solid #f1f5f9;
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .1);
        }

        .room-card .room-img {
            height: 220px;
            position: relative;
            overflow: hidden;
            background-color: #667eea;
            background-size: cover;
            background-position: center;
        }

        .room-card .room-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-card .room-price {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0, 0, 0, .65);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: .85rem;
        }

        .room-card .room-body {
            padding: 22px;
        }

        .room-card .room-body h5 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .room-card .room-features {
            display: flex;
            gap: 16px;
            color: #64748b;
            font-size: .82rem;
            margin-top: 12px;
        }

        .room-card .room-features span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .room-book-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 14px;
            padding: 10px 14px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            font-size: .9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .25s ease;
        }

        .room-book-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(79, 70, 229, .25);
            color: #fff;
        }

        .room-book-btn.disabled {
            background: #e2e8f0;
            color: #64748b;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Service Cards */
        .service-card {
            text-align: center;
            padding: 36px 24px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid #f1f5f9;
            transition: all .3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
            border-color: transparent;
        }

        .service-card .service-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 1.4rem;
            color: #fff;
        }

        .service-card h5 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .service-card p {
            color: #64748b;
            font-size: .88rem;
            margin-bottom: 0;
        }

        /* Contact Section */
        .contact-section {
            background: var(--dark);
            color: #fff;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .contact-item .contact-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-light);
            flex-shrink: 0;
        }

        .contact-item p {
            margin: 0;
            font-size: .95rem;
        }

        .contact-item .label {
            color: #94a3b8;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        /* Footer */
        .site-footer {
            background: #0f172a;
            padding: 32px 0;
            text-align: center;
            color: #64748b;
            font-size: .85rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-up {
            animation: fadeInUp .8s ease forwards;
        }

        .animate-up.d1 {
            animation-delay: .1s;
        }

        .animate-up.d2 {
            animation-delay: .2s;
        }

        .animate-up.d3 {
            animation-delay: .3s;
        }

        .animate-up.d4 {
            animation-delay: .4s;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-stats {
                gap: 24px;
                flex-wrap: wrap;
            }

            .section {
                padding: 60px 0;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="top-navbar" id="topNavbar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="DNC Hotel">
                    <div>
                        <div class="brand-text">DNC Hotel</div>
                        <div class="brand-sub">Hotel Luxury</div>
                    </div>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                    <ul class="navbar-nav align-items-center gap-1 ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#rooms">Phòng</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Dịch vụ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Liên hệ</a></li>
                        @auth
                            @if (auth()->user()->vai_tro == 'admin' || auth()->user()->vai_tro == 'le_tan')
                                <li class="nav-item ms-2">
                                    <a class="btn-nav-register" href="{{ route('dashboard') }}">
                                        <i class="fas fa-gauge-high"></i> Quản lý
                                    </a>
                                </li>
                            @else
                                <li class="nav-item ms-2">
                                    <a class="btn-nav-register" href="{{ route('nguoidung.index') }}">
                                        <i class="fas fa-user"></i> {{ auth()->user()->ten_tai_khoan }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ms-2">
                                <a class="btn-nav-login" href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li class="nav-item ms-1">
                                <a class="btn-nav-register" href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="animate-up d1">Nơi Nghỉ Dưỡng<br>Đẳng Cấp & Sang Trọng</h1>
                <p class="lead animate-up d2">
                    Tận hưởng không gian yên bình, tiện nghi hiện đại và dịch vụ tận tâm
                    cho kỳ nghỉ hoàn hảo của bạn.
                </p>
                <div class="d-flex gap-3 flex-wrap animate-up d3">
                    @auth
                        <a href="{{ auth()->user()->vai_tro == 'nguoi_dung' ? route('nguoidung.datphong.danhsach') : route('dashboard') }}"
                            class="btn-hero btn-hero-primary">
                            Đặt phòng ngay <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-primary">
                            Đặt phòng ngay <i class="fas fa-arrow-right"></i>
                        </a>
                    @endauth
                    <a href="#rooms" class="btn-hero btn-hero-outline">
                        <i class="fas fa-play-circle"></i> Khám phá
                    </a>
                </div>
                <div class="hero-stats animate-up d4">
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Phòng nghỉ</p>
                    </div>
                    <div class="stat-item">
                        <h3>1000+</h3>
                        <p>Khách hàng</p>
                    </div>
                    <div class="stat-item">
                        <h3>4.9</h3>
                        <p>Đánh giá</p>
                    </div>
                    <div class="stat-item">
                        <h3>24/7</h3>
                        <p>Hỗ trợ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms -->
    <section id="rooms" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Phòng nghỉ</span>
                <h2>Các Loại Phòng Nổi Bật</h2>
                <p>Lựa chọn không gian phù hợp cho nhu cầu nghỉ dưỡng của bạn</p>
            </div>
            <div class="row g-4">
                @forelse(($phongsNoiBat ?? collect()) as $phong)
                    @php
                        $coTheDat =
                            !empty($maTrangThaiTrong) && (int) $phong->ma_trang_thai === (int) $maTrangThaiTrong;
                    @endphp
                    <div class="col-md-6 col-xl-4">
                        <div class="room-card h-100">
                            <div class="room-img">
                                @if ($phong->anh_phong)
                                    <img src="{{ asset('images/' . $phong->anh_phong) }}"
                                        alt="{{ $phong->ten_phong }}">
                                @else
                                    <div
                                        style="height:100%; background:linear-gradient(135deg, #667eea, #764ba2); display:flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-bed fa-3x" style="color:rgba(255,255,255,.35);"></i>
                                    </div>
                                @endif
                                <span class="room-price">{{ number_format($phong->gia_phong, 0, ',', '.') }}đ /
                                    đêm</span>
                            </div>
                            <div class="room-body">
                                <h5>{{ $phong->ten_phong }}</h5>
                                <p class="text-muted mb-2" style="font-size:.88rem;">
                                    {{ \Illuminate\Support\Str::limit($phong->mo_ta ?: 'Không gian nghỉ dưỡng tiện nghi, phù hợp cho kỳ nghỉ của bạn.', 95) }}
                                </p>
                                <div class="room-features">
                                    <span><i class="fas fa-layer-group"></i>
                                        {{ $phong->loaiPhong->ten_loai_phong ?? 'N/A' }}</span>
                                    <span><i class="fas fa-bed"></i> {{ $phong->so_luong_giuong ?? 0 }} giường</span>
                                </div>

                                @if ($coTheDat)
                                    @auth
                                        @if (auth()->user()->vai_tro === 'nguoi_dung')
                                            <a href="{{ route('nguoidung.datphong.datphong', $phong->ma_phong) }}"
                                                class="room-book-btn">
                                                <i class="fas fa-calendar-check"></i> Đặt phòng ngay
                                            </a>
                                        @else
                                            <span class="room-book-btn disabled">
                                                <i class="fas fa-user-lock"></i> Chỉ khách hàng mới được đặt
                                            </span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="room-book-btn">
                                            <i class="fas fa-right-to-bracket"></i> Đặt phòng ngay
                                        </a>
                                    @endauth
                                @else
                                    <span class="room-book-btn disabled">
                                        <i class="fas fa-ban"></i> Phòng hiện không trống
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="room-card">
                            <div class="room-body text-center">
                                <h5>Chưa có phòng để hiển thị</h5>
                                <p class="text-muted mb-0" style="font-size:.9rem;">Vui lòng thêm dữ liệu phòng trong
                                    hệ thống để hiển thị tại đây.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Contact -->
    <section id="contact" class="section contact-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <span class="section-badge"
                        style="background: rgba(129,140,248,.15); color: var(--primary-light);">Thông Tin Liên
                        Hệ</span>
                    <p class="text-secondary mb-0" style="color: #94a3b8 !important;">Đội ngũ nhân viên luôn sẵn sàng
                        hỗ trợ bạn 24/7</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                                <div>
                                    <p class="label">Hotline</p>
                                    <p class="fw-semibold">0939257838 - 02923798168</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <p class="label">Email</p>
                                    <p class="fw-semibold">NamCanThoDNC@dnchotel.vn</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                                <div>
                                    <p class="label">Địa chỉ</p>
                                    <p class="fw-semibold">Số 168, đường Nguyễn Văn Cừ nối dài, Phường Anh Bình,Quận
                                        Ninh Kiều, TP Cần Thơ.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                <div>
                                    <p class="label">Giờ làm việc</p>
                                    <p class="fw-semibold">24/7 — Cả tuần</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <p class="mb-0">&copy;DNC Hotel Luxury Resort</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        // khi người dùng cuộn trang xuống, navbar sẽ thay đổi giao diện để tăng khả năng đọc và tạo cảm giác hiện đại hơn
        // khi cuộn xuống hơn 60px, navbar sẽ có nền trắng mờ, đổ bóng nhẹ và giảm padding để tạo hiệu ứng "dính" vào đầu trang
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('topNavbar');
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Smooth scroll
        // tạo hiệu ứng cuộn mượt mà khi nhấp vào các liên kết điều hướng trong navbar
        // đảm bảo rằng khi người dùng nhấp vào một liên kết như "Phòng", trang sẽ cuộn mượt mà đến phần tương ứng thay vì nhảy đột ngột
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>
</body>

</html>
