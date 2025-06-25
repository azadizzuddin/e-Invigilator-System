<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem e-Invigilator | Universiti Teknologi MARA</title>
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
        
        .contact-info {
            display: flex;
            gap: 20px;
        }
        
        /* Main Navigation */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
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
        }
        
        .logo-section img {
            height: 60px;
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
        
        .main-nav {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }
        
        .main-nav a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .main-nav a:hover {
            color: #4B0082;
        }
        
        .login-button {
            background-color: #4B0082;
            color: white !important;
            padding: 8px 20px;
            border-radius: 4px;
        }
        
        .login-button:hover {
            background-color: #3A006F;
        }
        
        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(rgba(75, 0, 130, 0.8), rgba(75, 0, 130, 0.8)), url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .hero-content h2 {
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: #FFD700;
            color: #4B0082;
        }
        
        .btn-primary:hover {
            background-color: #FFC500;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-secondary:hover {
            background-color: white;
            color: #4B0082;
        }
        
        /* Info Section */
        .info-section {
            background-color: #f8f8f8;
            padding: 40px 0;
            border-bottom: 1px solid #ddd;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            text-align: center;
        }
        
        .info-item {
            padding: 20px;
        }
        
        .info-item .icon {
            font-size: 48px;
            color: #4B0082;
            margin-bottom: 15px;
        }
        
        .info-item h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .info-item p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }
        
        /* Features Section */
        .features {
            padding: 60px 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .section-title h2 {
            font-size: 32px;
            color: #4B0082;
            margin-bottom: 10px;
        }
        
        .section-title p {
            font-size: 16px;
            color: #666;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .feature-card {
            background-color: #f8f8f8;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            transition: box-shadow 0.3s;
        }
        
        .feature-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background-color: #4B0082;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
            color: white;
        }
        
        .feature-card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }
        
        .feature-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }
        
        /* Screenshot Gallery */
        .screenshot-section {
            padding: 60px 0;
            background-color: #f5f5f5;
        }
        
        .screenshot-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 40px;
        }
        
        .screenshot-item {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .screenshot-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        
        .screenshot-info {
            padding: 20px;
        }
        
        .screenshot-info h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .screenshot-info p {
            font-size: 14px;
            color: #666;
        }
        
        /* Footer */
        footer {
            background-color: #2c2c2c;
            color: white;
            padding: 40px 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 30px;
        }
        
        .footer-column h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #FFD700;
        }
        
        .footer-column p,
        .footer-column a {
            font-size: 14px;
            color: #ccc;
            text-decoration: none;
            line-height: 1.8;
        }
        
        .footer-column a:hover {
            color: #FFD700;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 8px;
        }
        
        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #999;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #4B0082;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-top {
                display: none;
            }
            
            .main-nav {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .screenshot-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .hero-content h2 {
                font-size: 28px;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <div class="contact-info">
                    <span>📧 einvigilator@uitm.edu.my</span>
                    <span>📞 03-5544 2000</span>
                </div>
                <div>
                    <span>Universiti Teknologi MARA (UiTM)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="nav-container">
                <div class="logo-section">
                    <img src="{{asset('images/UiTM Logo.png')}}" alt="UiTM Logo">
                    <div class="logo-text">
                        <h1>Sistem e-Invigilator</h1>
                        <p>Pengurusan Pengawasan Peperiksaan UiTM</p>
                    </div>
                </div>
                <nav>
                    <ul class="main-nav">
                        <li><a href="#home">Laman Utama</a></li>
                        <li><a href="#features">Kemudahan</a></li>
                        <li><a href="#screenshots">Paparan Sistem</a></li>
                        <li><a href="#contact">Hubungi Kami</a></li>
                        <li><a href="{{route('invigilator.invigilatorAuthPage')}}" class="login-button">Log Masuk</a></li>
                    </ul>
                </nav>
                <button class="mobile-menu-toggle">☰</button>
            </div>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="hero-banner" id="home">
        <div class="container">
            <div class="hero-content">
                <h2>Sistem Pengurusan Pengawasan Peperiksaan Digital</h2>
                <p>Platform bersepadu untuk pengurusan jadual pengawasan, pertukaran slot, dan pelaporan masalah peperiksaan di UiTM</p>
                <div class="cta-buttons">
                    <a href="{{route('invigilator.invigilatorAuthPage')}}" class="btn btn-primary">Akses Sistem</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="container">
            <div class="info-grid">
                <div class="info-item">
                    <div class="icon">👥</div>
                    <h3>500+ Pengawas</h3>
                    <p>Pengawas berdaftar dalam sistem</p>
                </div>
                <div class="info-item">
                    <div class="icon">📅</div>
                    <h3>1,200+ Sesi</h3>
                    <p>Sesi peperiksaan diuruskan</p>
                </div>
                <div class="info-item">
                    <div class="icon">🏢</div>
                    <h3>50+ Lokasi</h3>
                    <p>Dewan peperiksaan seluruh UiTM</p>
                </div>
                <div class="info-item">
                    <div class="icon">📊</div>
                    <h3>98% Kepuasan</h3>
                    <p>Maklum balas positif pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Kemudahan Sistem</h2>
                <p>Pelbagai fungsi untuk memudahkan pengurusan pengawasan peperiksaan</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>Jadual Digital</h3>
                    <p>Akses jadual pengawasan secara dalam talian dengan kemaskini automatik dan masa nyata</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Notifikasi Telegram</h3>
                    <p>Peringatan untuk jadual pengawasan melalui aplikasi Telegram</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Laporan PowerBI</h3>
                    <p>Analisis data dan laporan terperinci menggunakan teknologi PowerBI</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshot Section -->
    <section class="screenshot-section" id="screenshots">
        <div class="container">
            <div class="section-title">
                <h2>Paparan Sistem</h2>
                <p>Lihat antara muka dan fungsi sistem e-Invigilator</p>
            </div>
            <div class="screenshot-grid">
                <div class="screenshot-item">
                    <img src="{{asset('images/Ehuh.png')}}" alt="Dashboard">
                    <div class="screenshot-info">
                        <h3>Papan Pemuka Utama</h3>
                        <p>Antara muka utama dengan ringkasan maklumat pengawasan dan akses pantas ke semua fungsi</p>
                    </div>
                </div>
                <div class="screenshot-item">
                    <img src="{{asset('images/Dashboard.png')}}" alt="Schedule">
                    <div class="screenshot-info">
                        <h3>Jadual Pengawasan</h3>
                        <p>Paparan jadual yang jelas dengan maklumat terperinci setiap sesi pengawasan</p>
                    </div>
                </div>
                <div class="screenshot-item">
                    <img src="{{asset('images/Telegram.png')}}" alt="Exchange">
                    <div class="screenshot-info">
                        <h3>Sistem Notifikasi Telegram</h3>
                        <p>Pemakluman notifikasi pengawasan melalui Telegram</p>
                    </div>
                </div>
                <div class="screenshot-item">
                    <img src="{{asset('images/PowerBI Test.png')}}" alt="Analytics">
                    <div class="screenshot-info">
                        <h3>Laporan Analitik</h3>
                        <p>Dashboard PowerBI dengan visualisasi data untuk analisis prestasi pengawasan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h4>Tentang Sistem</h4>
                    <p>Sistem e-Invigilator merupakan platform digital untuk pengurusan pengawasan peperiksaan di Universiti Teknologi MARA yang dibangunkan untuk meningkatkan kecekapan pengurusan.</p>
                </div>
                <div class="footer-column">
                    <h4>Pautan Pantas</h4>
                    <ul>
                        <li><a href="#home">Laman Utama</a></li>
                        <li><a href="#features">Kemudahan Sistem</a></li>
                        <li><a href="#screenshots">Paparan Sistem</a></li>
                        <li><a href="{{route('invigilator.invigilatorAuthPage')}}">Log Masuk</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Hubungi Kami</h4>
                    <p>Bahagian Peperiksaan<br>
                    Universiti Teknologi MARA<br>
                    40450 Shah Alam, Selangor<br>
                    📧 einvigilator@uitm.edu.my<br>
                    📞 03-5544 2000</p>
                </div>
                <div class="footer-column">
                    <h4>Waktu Operasi</h4>
                    <p>Isnin - Jumaat<br>
                    8:00 AM - 5:00 PM<br><br>
                    Sokongan Teknikal:<br>
                    helpdesk@uitm.edu.my</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Universiti Teknologi MARA. Hak Cipta Terpelihara. | Dibangunkan oleh: Aza:D</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mobile menu placeholder
        document.querySelector('.mobile-menu-toggle').addEventListener('click', function() {
            alert('Mobile menu would be implemented here');
        });
    </script>
</body>
</html>