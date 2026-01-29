<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            margin-top: 50px;
        }
        .welcome-title {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <h1 class="welcome-title text-center mb-4">Xin Chào, {{ auth()->user()->ten_tai_khoan }}!</h1>
            
            <div class="text-center">
                <p class="lead">Chào mừng bạn đến với hệ thống quản lý khách sạn</p>
                <p>Vai trò: <span class="badge bg-info">Khách Hàng</span></p>
                <p>Số điện thoại: {{ auth()->user()->so_dien_thoai }}</p>
                
                <hr class="my-4">
                
                <h4>Tính năng dành cho khách hàng:</h4>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">🏨 Đặt Phòng</h5>
                                <p class="card-text">Xem và đặt phòng khách sạn</p>
                                <a href="#" class="btn btn-primary">Đặt Phòng</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">📋 Lịch Sử</h5>
                                <p class="card-text">Xem lịch sử đặt phòng</p>
                                <a href="#" class="btn btn-primary">Xem Lịch Sử</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">👤 Tài Khoản</h5>
                                <p class="card-text">Quản lý thông tin cá nhân</p>
                                <a href="#" class="btn btn-primary">Cập Nhật</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-5">
                    @csrf
                    <button type="submit" class="btn btn-danger">Đăng Xuất</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
