<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Invigilator Dashboard - UiTM e-Invigilator System')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
        :root {
            /* UiTM Official Brand Colors */
            --uitm-purple: #4B0082;
            --uitm-purple-dark: #3A006F;
            --uitm-purple-light: #5B1A8B;
            --uitm-gold: #FFD700;
            --uitm-gold-dark: #FFC500;
            --uitm-gold-light: #FFEB3B;
            --uitm-white: #ffffff;
            --uitm-gray: #f5f5f5;
            --uitm-gray-light: #fafafa;
            --uitm-gray-dark: #333333;
            --uitm-border: #ddd;
            --uitm-text-primary: #333;
            --uitm-text-secondary: #666;
            --uitm-text-muted: #999;
            
            /* UiTM Shadows and Effects */
            --uitm-shadow-light: 0 2px 4px rgba(0,0,0,0.1);
            --uitm-shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
            --uitm-shadow-heavy: 0 8px 16px rgba(0,0,0,0.2);
            --uitm-shadow-purple: 0 4px 12px rgba(75, 0, 130, 0.15);
            
            /* UiTM Typography */
            --uitm-font-family: Arial, 'Helvetica Neue', sans-serif;
            --uitm-border-radius: 8px;
            --uitm-border-radius-sm: 4px;
            --uitm-transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--uitm-font-family);
            background-color: var(--uitm-gray);
            min-height: 100vh;
            color: var(--uitm-text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* UiTM Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(75, 0, 130, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Header - UiTM Style */
        .header {
            background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
            color: var(--uitm-white);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--uitm-shadow-medium);
            border-bottom: 3px solid var(--uitm-gold);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            height: 70px;
        }

        /* UiTM Logo Section */
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--uitm-white);
            text-decoration: none;
            transition: var(--uitm-transition);
        }

        .logo:hover {
            transform: scale(1.02);
            color: var(--uitm-gold);
        }

        .logo i {
            font-size: 1.8rem;
            color: var(--uitm-gold);
            filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .logo-main {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .logo-sub {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        /* UiTM Navigation */
        .navbar {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            color: var(--uitm-white);
            text-decoration: none;
            border-radius: var(--uitm-border-radius-sm);
            transition: var(--uitm-transition);
            font-weight: 500;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 215, 0, 0.2);
            color: var(--uitm-gold);
            transform: translateY(-1px);
            box-shadow: var(--uitm-shadow-light);
        }

        .nav-link i {
            font-size: 14px;
        }

        /* UiTM Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--uitm-white);
            min-width: 220px;
            box-shadow: var(--uitm-shadow-heavy);
            border-radius: var(--uitm-border-radius);
            padding: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid var(--uitm-border);
            margin-top: 10px;
            z-index: 1001;
        }

        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -5px;
            right: 20px;
            width: 10px;
            height: 10px;
            background: var(--uitm-white);
            border-left: 1px solid var(--uitm-border);
            border-top: 1px solid var(--uitm-border);
            transform: rotate(45deg);
        }

        .dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--uitm-text-secondary);
            text-decoration: none;
            border-radius: var(--uitm-border-radius-sm);
            transition: var(--uitm-transition);
            font-weight: 500;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
            color: var(--uitm-purple);
            transform: translateX(3px);
        }

        .dropdown-item i {
            width: 16px;
            font-size: 14px;
            color: var(--uitm-purple);
        }

        /* UiTM Logout Button */
        .logout-btn {
            background: var(--uitm-gold);
            color: var(--uitm-purple);
            border: none;
            padding: 10px 20px;
            border-radius: var(--uitm-border-radius-sm);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--uitm-transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--uitm-shadow-light);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            background: var(--uitm-gold-dark);
            transform: translateY(-2px);
            box-shadow: var(--uitm-shadow-medium);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* UiTM Alert Messages */
        .alert {
            position: fixed;
            top: 90px;
            right: 30px;
            padding: 16px 20px;
            border-radius: var(--uitm-border-radius);
            box-shadow: var(--uitm-shadow-heavy);
            z-index: 2000;
            animation: slideInAlert 0.3s ease;
            min-width: 320px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 14px;
            border-left: 4px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #065F46;
            border-left-color: #10B981;
        }

        .alert-success::before {
            content: '✓';
            color: #10B981;
            font-weight: bold;
            font-size: 16px;
        }

        .alert-error {
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: #991B1B;
            border-left-color: #EF4444;
        }

        .alert-error::before {
            content: '✕';
            color: #EF4444;
            font-weight: bold;
            font-size: 16px;
        }

        .alert-warning {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            color: #92400E;
            border-left-color: #F59E0B;
        }

        .alert-warning::before {
            content: '⚠';
            color: #F59E0B;
            font-weight: bold;
            font-size: 16px;
        }

        @keyframes slideInAlert {
            from {
                transform: translateX(100%) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* UiTM Mobile Responsive */
        @media (max-width: 1024px) {
            .header-content {
                padding: 0 20px;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                padding: 0 15px;
                height: 80px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .navbar {
                width: 100%;
                justify-content: flex-end;
                gap: 8px;
            }

            .logo {
                font-size: 1.2rem;
            }

            .logo-main {
                font-size: 1.2rem;
            }

            .logo-sub {
                font-size: 0.7rem;
            }

            .nav-link, .logout-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .dropdown-content {
                min-width: 200px;
                right: -10px;
            }

            .alert {
                right: 15px;
                left: 15px;
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .header-content {
                flex-direction: column;
                height: auto;
                padding: 15px;
            }

            .navbar {
                justify-content: center;
            }

            .nav-link span,
            .logout-btn span {
                display: none;
            }

            .nav-link, .logout-btn {
                padding: 10px;
                min-width: 40px;
                justify-content: center;
            }

            .logo-text {
                display: none;
            }
        }

        /* UiTM Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--uitm-gray-light);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--uitm-purple);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--uitm-purple-dark);
        }

        /* Focus States - UiTM Accessibility */
        .nav-link:focus,
        .logout-btn:focus,
        .dropdown-item:focus {
            outline: 2px solid var(--uitm-gold);
            outline-offset: 2px;
        }

        /* Loading States */
        .logout-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Smooth transitions */
        html {
            scroll-behavior: smooth;
        }

        /* UiTM Badge/Chip styles */
        .uitm-badge {
            background: var(--uitm-gold);
            color: var(--uitm-purple);
            padding: 4px 8px;
            border-radius: var(--uitm-border-radius-sm);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <!-- UiTM Header -->
    <div class="header">
        <div class="header-content">
            <a href="{{ route('invigilator.dashboard') }}" class="logo">
                <i class="fas fa-user-shield"></i>
                <div class="logo-text">
                    <span class="logo-main">Sistem e-Invigilator</span>
                    <span class="logo-sub">Universiti Teknologi MARA</span>
                </div>
            </a>
            
            <nav class="navbar">
                <div class="dropdown nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-circle"></i>
                        <span>Akaun</span>
                        <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 4px;"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('invigilator.profile') }}" class="dropdown-item">
                            <i class="fas fa-user-edit"></i>
                            <span>Edit Profil</span>
                        </a>
                        <a href="{{ route('invigilator.documents') }}" class="dropdown-item">
                            <i class="fas fa-download"></i>
                            <span>Dokumen</span>
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('invigilator.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log Keluar</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- UiTM Alert Messages -->
    @if(session('message'))
        <div class="alert alert-success">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            <span>{{ session('warning') }}</span>
        </div>
    @endif

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    @yield('footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced alert handling with UiTM style
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.cursor = 'pointer';
                
                // Click to dismiss
                alert.addEventListener('click', function() {
                    dismissAlert(this);
                });

                // Auto-dismiss after 5 seconds
                setTimeout(() => {
                    if (alert.parentNode) {
                        dismissAlert(alert);
                    }
                }, 5000);
            });

            function dismissAlert(alertElement) {
                alertElement.style.transform = 'translateX(100%) scale(0.95)';
                alertElement.style.opacity = '0';
                setTimeout(() => {
                    if (alertElement.parentNode) {
                        alertElement.remove();
                    }
                }, 300);
            }

            // Enhanced dropdown interaction
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const content = dropdown.querySelector('.dropdown-content');
                let timeout;

                dropdown.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                });

                dropdown.addEventListener('mouseleave', () => {
                    timeout = setTimeout(() => {
                        // Additional cleanup if needed
                    }, 100);
                });
            });

            // Add loading state to logout button with UiTM styling
            const logoutForm = document.querySelector('form[action*="logout"]');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function() {
                    const button = this.querySelector('.logout-btn');
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Mengelog keluar...</span>';
                });
            }

            // UiTM hover effects enhancement
            const navLinks = document.querySelectorAll('.nav-link, .logout-btn');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>