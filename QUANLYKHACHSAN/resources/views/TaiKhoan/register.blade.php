<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 450px;
            width: 100%;
        }
        .register-title {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px;
            font-weight: bold;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">ĐĂNG KÝ TÀI KHOẢN</h2>
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="ten_tai_khoan" class="form-label">Tên Tài Khoản</label>
                <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" 
                       value="{{ old('ten_tai_khoan') }}" placeholder="Nhập tên tài khoản..." required>
            </div>
            
            <div class="mb-3">
                <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" 
                       value="{{ old('so_dien_thoai') }}" placeholder="Nhập số điện thoại..." required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)..." required>
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                       placeholder="Nhập lại mật khẩu..." required>
            </div>
            
            <button type="submit" class="btn btn-register w-100 mb-3">Đăng Ký</button>
            
            <div class="text-center">
                <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
