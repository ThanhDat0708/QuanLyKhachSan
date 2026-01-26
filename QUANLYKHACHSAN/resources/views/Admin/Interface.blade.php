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
    <link rel="stylesheet" href="../resources/css/interface.css">
</head>
<style>
    /* ===== CSS VARIABLES ===== */
:root {
  --primary-color: #6c63ff;
  --secondary-color: #ff6b6b;
  --accent-color: #4ecdc4;
  --success-color: #2ecc71;
  --warning-color: #f39c12;
  --danger-color: #e74c3c;
  --light-color: #f8f9fa;
  --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  --gradient-secondary: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
  --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

/* ===== RESET & BASE ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
  min-height: 100vh;
  color: var(--light-color);
}

/* ===== CONTAINER ===== */
.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px;
}

/* ===== HEADER ===== */
.header {
  background: var(--gradient-primary);
  padding: 20px 40px;
  box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
  border-radius: 0 0 20px 20px;
}

.header h1 {
  font-size: 2rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

/* ===== NAVIGATION ===== */
.nav {
  display: flex;
  gap: 15px;
  margin-top: 15px;
}

.nav-item {
  padding: 12px 25px;
  background: rgba(255, 255, 255, 0.15);
  border: none;
  border-radius: 30px;
  color: white;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.nav-item:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.nav-item.active {
  background: var(--secondary-color);
  box-shadow: 0 5px 20px rgba(255, 107, 107, 0.5);
}

/* ===== CARDS ===== */
.card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border-radius: 20px;
  padding: 25px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  transition: all 0.4s ease;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 50px rgba(108, 99, 255, 0.4);
  border-color: var(--primary-color);
}

.card-header {
  font-size: 1.4rem;
  font-weight: 700;
  margin-bottom: 15px;
  color: var(--accent-color);
}

.card-body {
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.6;
}

/* ===== BUTTONS ===== */
.btn {
  padding: 14px 35px;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.btn-primary {
  background: var(--gradient-primary);
  color: white;
  box-shadow: 0 5px 20px rgba(102, 126, 234, 0.5);
}

.btn-primary:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 10px 30px rgba(102, 126, 234, 0.6);
}

.btn-secondary {
  background: var(--gradient-secondary);
  color: white;
  box-shadow: 0 5px 20px rgba(245, 87, 108, 0.5);
}

.btn-secondary:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 10px 30px rgba(245, 87, 108, 0.6);
}

.btn-success {
  background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
  color: white;
  box-shadow: 0 5px 20px rgba(56, 239, 125, 0.4);
}

.btn-success:hover {
  transform: translateY(-3px) scale(1.02);
}

.btn-outline {
  background: transparent;
  border: 2px solid var(--primary-color);
  color: var(--primary-color);
}

.btn-outline:hover {
  background: var(--primary-color);
  color: white;
  transform: scale(1.05);
}

/* ===== FORM INPUTS ===== */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: var(--accent-color);
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 15px 20px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 15px;
  color: white;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-group input::placeholder,
.form-group select::placeholder,
.form-group textarea::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--primary-color);
  background: rgba(255, 255, 255, 0.15);
  box-shadow: 0 0 20px rgba(108, 99, 255, 0.3);
}

/* ===== TABLE ===== */
.table {
  width: 100%;
  border-collapse: collapse;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 15px;
  overflow: hidden;
}

.table th,
.table td {
  padding: 18px 20px;
  text-align: left;
}

.table th {
  background: var(--gradient-primary);
  color: white;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.table tr {
  transition: background 0.3s ease;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.table tr:hover {
  background: rgba(108, 99, 255, 0.2);
}

.table td {
  color: rgba(255, 255, 255, 0.9);
}

/* ===== SIDEBAR ===== */
.sidebar {
  width: 280px;
  background: rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(20px);
  padding: 30px 20px;
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar-menu {
  list-style: none;
}

.sidebar-menu li {
  margin-bottom: 10px;
}

.sidebar-menu li a {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 15px 20px;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.sidebar-menu li a:hover,
.sidebar-menu li a.active {
  background: var(--gradient-primary);
  color: white;
  transform: translateX(10px);
  box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
}

/* ===== STATS CARDS ===== */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.stat-card {
  padding: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  transition: all 0.4s ease;
}

.stat-card.purple {
  background: var(--gradient-primary);
}

.stat-card.pink {
  background: var(--gradient-secondary);
}

.stat-card.blue {
  background: var(--gradient-accent);
}

.stat-card.green {
  background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stat-card:hover {
  transform: scale(1.05) rotate(2deg);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.stat-card .stat-number {
  font-size: 3rem;
  font-weight: 800;
  margin-bottom: 10px;
}

.stat-card .stat-label {
  font-size: 1.1rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  opacity: 0.9;
}

/* ===== MODAL ===== */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(10px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: linear-gradient(145deg, #1e1e2e, #2d2d44);
  padding: 40px;
  border-radius: 25px;
  max-width: 500px;
  width: 90%;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
  animation: modalSlide 0.4s ease;
}

@keyframes modalSlide {
  from {
    opacity: 0;
    transform: translateY(-50px) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* ===== BADGES ===== */
.badge {
  display: inline-block;
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
}

.badge-success {
  background: rgba(46, 204, 113, 0.2);
  color: var(--success-color);
  border: 1px solid var(--success-color);
}

.badge-warning {
  background: rgba(243, 156, 18, 0.2);
  color: var(--warning-color);
  border: 1px solid var(--warning-color);
}

.badge-danger {
  background: rgba(231, 76, 60, 0.2);
  color: var(--danger-color);
  border: 1px solid var(--danger-color);
}

.badge-info {
  background: rgba(78, 205, 196, 0.2);
  color: var(--accent-color);
  border: 1px solid var(--accent-color);
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.animate-fadeIn { animation: fadeIn 0.5s ease; }
.animate-slideUp { animation: slideUp 0.6s ease; }
.animate-pulse { animation: pulse 2s infinite; }

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
  background: var(--gradient-primary);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--secondary-color);
}

/* ===== NAVBAR BOOTSTRAP CUSTOM ===== */
.navbar {
  background: var(--gradient-primary) !important;
  padding: 15px 30px;
  box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
}

.navbar .navbar-brand {
  color: white !important;
  font-size: 1.5rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.navbar .navbar-brand:hover {
  color: var(--accent-color) !important;
}

.navbar .navbar-toggler {
  border-color: rgba(255, 255, 255, 0.5);
}

.navbar .navbar-toggler .navbar-toggler-icon {
  filter: brightness(0) invert(1);
}

.navbar .navbar-nav {
  gap: 10px;
}

.navbar .navbar-nav .nav-item {
  position: relative;
}

.navbar .navbar-nav .nav-item .nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 25px;
  transition: all 0.3s ease;
}

.navbar .navbar-nav .nav-item .nav-link:hover,
.navbar .navbar-nav .nav-item .nav-link.active {
  background: rgba(255, 255, 255, 0.2);
  color: white !important;
  transform: translateY(-2px);
}

.navbar .navbar-nav .nav-item.dropdown .dropdown-menu {
  background: rgba(30, 30, 46, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  padding: 10px;
  margin-top: 10px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

.navbar .navbar-nav .nav-item.dropdown .dropdown-menu .nav-item .nav-link {
  color: rgba(255, 255, 255, 0.8) !important;
  padding: 12px 20px;
  border-radius: 10px;
}

.navbar .navbar-nav .nav-item.dropdown .dropdown-menu .nav-item .nav-link:hover,
.navbar .navbar-nav .nav-item.dropdown .dropdown-menu .nav-item .nav-link.active {
  background: var(--gradient-primary);
  color: white !important;
}

/* Override Bootstrap dropdown */
.dropdown-menu {
  background: rgba(30, 30, 46, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  padding: 10px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

.dropdown-menu li {
  margin-bottom: 5px;
}

.dropdown-menu li:last-child {
  margin-bottom: 0;
}

.dropdown-menu li .nav-link,
.dropdown-menu li .dropdown-item {
  color: rgba(255, 255, 255, 0.8) !important;
  padding: 12px 20px;
  border-radius: 10px;
  transition: all 0.3s ease;
}

.dropdown-menu li .nav-link:hover,
.dropdown-menu li .nav-link.active,
.dropdown-menu li .dropdown-item:hover,
.dropdown-menu li .dropdown-item.active {
  background: var(--gradient-primary);
  color: white !important;
}

</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                   <img src="{{ asset('img/logo.png') }}" alt="Logo" width="120" height="90"
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
                                <a class="nav-link active" aria-current="page" href="#">Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Loại Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Trạng Thái Phòng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown"role="button" data-bs-toggle="dropdown"aria-expanded="false">
                            Quản Lý Đặt Phòng
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Đặt Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Trạng Thái Đặt Phòng</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Khách Hàng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Hóa Đơn</a>
                    </li>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown"role="button" data-bs-toggle="dropdown"aria-expanded="false">
                            Tài Khoản
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Đăng Nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Đăng Ký</a>
                            </li>
                        </ul> 
                    </div>
                </ul>   
        </div>
    </nav>
</body>

</html>
