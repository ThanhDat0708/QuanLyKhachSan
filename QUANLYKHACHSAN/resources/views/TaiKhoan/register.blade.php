<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký | DNC Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #14213d;
            --brand: #1d4ed8;
            --brand-2: #0ea5e9;
            --paper: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            background:
                linear-gradient(120deg, rgba(20, 33, 61, 0.82), rgba(29, 78, 216, 0.6)),
                url('{{ asset('images/dnc.jpg') }}') center/cover no-repeat;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(4px);
            border-radius: 24px;
            padding: 34px;
            box-shadow: 0 28px 50px rgba(2, 6, 23, 0.35);
            max-width: 460px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.7);
            animation: riseIn .55s ease both;
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: "";
            position: absolute;
            inset: -100px -80px auto auto;
            width: 240px;
            height: 240px;
            pointer-events: none;
        }

        .register-title {
            color: var(--ink);
            font-weight: 800;
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: 0.3px;
        }

        .register-subtitle {
            color: #64748b;
            text-align: center;
            font-size: 0.92rem;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 700;
            color: #334155;
            font-size: 0.88rem;
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            border-color: #dbe3ef;
            background: #f8fafc;
            color: #64748b;
        }

        .form-control {
            border-color: #dbe3ef;
            border-radius: 0 12px 12px 0;
            min-height: 46px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(29, 78, 216, 0.15);
            border-color: #93c5fd;
        }

        .password-toggle {
            border: 1px solid #dbe3ef;
            border-left: none;
            background: #fff;
            color: #64748b;
            border-radius: 0 12px 12px 0;
            min-width: 46px;
        }

        .password-toggle:hover {
            background: #f8fafc;
            color: #334155;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            border: none;
            color: white;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            letter-spacing: 0.2px;
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.35);
            filter: brightness(1.04);
            color: white;
        }

        .helper-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 4px;
            margin-bottom: 16px;
            font-size: 0.84rem;
            color: #64748b;
        }

        .login-link {
            color: var(--brand);
            text-decoration: none;
            font-weight: 700;
        }

        .login-link:hover {
            color: #1e3a8a;
            text-decoration: underline;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 14px;
            }

            .register-container {
                padding: 24px 18px;
                border-radius: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Đăng Ký</h2>
        <p class="register-subtitle">Tạo tài khoản mới để đặt phòng nhanh hơn</p>
        
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
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" 
                           value="{{ old('ten_tai_khoan') }}" placeholder="Nhập tên tài khoản..." required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" 
                           value="{{ old('so_dien_thoai') }}" placeholder="Nhập số điện thoại..." required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)..." required>
                    <button class="password-toggle" type="button" id="togglePassword" aria-label="Hiện mật khẩu">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="mb-2">
                <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                           placeholder="Nhập lại mật khẩu..." required>
                    <button class="password-toggle" type="button" id="togglePasswordConfirm" aria-label="Hiện mật khẩu xác nhận">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="helper-row">
                <span>Mật khẩu nên có ít nhất 6 ký tự</span>
                <span><i class="fa-solid fa-shield-halved"></i></span>
            </div>
            
            <button type="submit" class="btn btn-register w-100 mb-3">Đăng Ký</button>
            
            <div class="text-center">
                <p class="mb-0">Đã có tài khoản? <a class="login-link" href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const toggleConfirmBtn = document.getElementById('togglePasswordConfirm');

        togglePasswordBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            this.innerHTML = isPassword
                ? '<i class="fa-regular fa-eye-slash"></i>'
                : '<i class="fa-regular fa-eye"></i>';
        });

        toggleConfirmBtn.addEventListener('click', function () {
            const isPassword = confirmInput.type === 'password';
            confirmInput.type = isPassword ? 'text' : 'password';
            this.innerHTML = isPassword
                ? '<i class="fa-regular fa-eye-slash"></i>'
                : '<i class="fa-regular fa-eye"></i>';
        });
    </script>
</body>
</html>
