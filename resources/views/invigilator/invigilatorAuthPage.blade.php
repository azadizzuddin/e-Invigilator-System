<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk Pengawas | Sistem e-Invigilator UiTM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header */
        .header-top {
            background-color: #4B0082;
            color: white;
            padding: 8px 0;
            font-size: 13px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header-top-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Main Header */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }
        
        .logo-section img {
            height: 60px;
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 8px;
        }
        
        .logo-text h1 {
            font-size: 20px;
            color: #4B0082;
            font-weight: bold;
            margin-bottom: 2px;
        }
        
        .logo-text p {
            font-size: 12px;
            color: #666;
        }
        
        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4B0082;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .back-link:hover {
            color: #6B23A0;
        }
        
        .back-link svg {
            width: 20px;
            height: 20px;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            font-size: 24px;
            color: #4B0082;
            margin-bottom: 10px;
        }
        
        .login-header p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .role-switch {
            font-size: 13px;
            color: #666;
        }
        
        .role-switch a {
            color: #4B0082;
            text-decoration: none;
            font-weight: 500;
        }
        
        .role-switch a:hover {
            text-decoration: underline;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-size: 14px;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input:focus {
            outline: none;
            border-color: #4B0082;
        }
        
        input::placeholder {
            color: #999;
        }
        
        .error-message {
            background-color: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-btn {
            width: 100%;
            background-color: #4B0082;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #3A006F;
        }
        
        .login-btn:active {
            transform: translateY(1px);
        }
        
        /* Footer */
        footer {
            background-color: #2c2c2c;
            color: #ccc;
            padding: 20px 0;
            text-align: center;
            font-size: 13px;
        }
        
        /* UiTM Badge */
        .uitm-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #FFD700;
            color: #4B0082;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-top {
                display: none;
            }
            
            .logo-text {
                display: none;
            }
            
            .login-container {
                padding: 30px 20px;
            }
            
            .uitm-badge {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <span>📧 einvigilator@uitm.edu.my | 📞 03-5544 2000</span>
                <span>Universiti Teknologi MARA (UiTM)</span>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="nav-container">
                <a href="{{route('invigilator.index')}}" class="logo-section">
                    <img src="{{asset('images/UiTM Logo.png')}}" alt="UiTM Logo">
                    <div class="logo-text">
                        <h1>Sistem e-Invigilator</h1>
                        <p>Pengurusan Pengawasan Peperiksaan UiTM</p>
                    </div>
                </a>
                <a href="{{route('invigilator.index')}}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Laman Utama
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="login-container">
            <div class="uitm-badge">UiTM Official</div>
            
            <div class="login-header">
                <h2>Log Masuk Pengawas</h2>
                <p>Sila masukkan maklumat akaun anda</p>
                <div class="role-switch">
                    Admin? <a href="{{route('admin.adminAuthPage')}}">Log masuk</a>
                </div>
            </div>

            <form action="{{ route('invigilator.login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="userID">ID Pengguna</label>
                    <input type="text" id="userID" name="userID" placeholder="Masukkan ID Pengguna anda" required>
                </div>

                <div class="form-group">
                    <label for="userPassword">Kata Laluan</label>
                    <input type="password" id="userPassword" name="userPassword" placeholder="Masukkan kata laluan anda" required>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <button class="login-btn" type="submit">Log Masuk</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Universiti Teknologi MARA. Hak Cipta Terpelihara. | Dibangunkan oleh: Aza:D</p>
        </div>
    </footer>
</body>
</html>