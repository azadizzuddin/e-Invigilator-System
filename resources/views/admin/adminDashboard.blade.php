@extends('layouts.adminLayout')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    /* ===== Landing Page Theme Colors ===== */
    :root {
        --primary-purple: #4B0082;
        --primary-purple-dark: #3A006F;
        --primary-purple-light: #5B1A8B;
        --accent-gold: #FFD700;
        --accent-gold-dark: #FFC500;
        --background-gray: #f5f5f5;
        --card-white: #ffffff;
        --text-dark: #333;
        --text-gray: #666;
        --border-light: #ddd;
        --success-green: #28a745;
        --info-blue: #17a2b8;
        --warning-orange: #ffc107;
        --shadow-light: 0 2px 4px rgba(0,0,0,0.1);
        --shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
        --shadow-heavy: 0 8px 16px rgba(0,0,0,0.2);
    }

    body {
        font-family: Arial, 'Helvetica Neue', sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background-color: var(--background-gray);
    }

    /* ===== Dashboard Container ===== */
    .dashboard-container {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
        background-color: var(--background-gray);
        min-height: 100vh;
    }

    /* ===== Page Header (matching landing page hero style) ===== */
    .dashboard-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: white;
        padding: 40px 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-medium);
        text-align: center;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold) 0%, transparent 100%);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: white;
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .welcome-message {
        background: rgba(255, 215, 0, 0.1);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 6px;
        padding: 15px 20px;
        margin-top: 20px;
        color: rgba(255, 255, 255, 0.95);
        font-size: 14px;
    }

    /* ===== Quick Stats Section ===== */
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 25px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary-purple);
    }

    .stat-card.schedules::before {
        background: var(--primary-purple);
    }

    .stat-card.invigilators::before {
        background: var(--success-green);
    }

    .stat-card.notifications::before {
        background: var(--info-blue);
    }

    .stat-card.documents::before {
        background: var(--warning-orange);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 24px;
        color: white;
        background: var(--primary-purple);
    }

    .stat-card.schedules .stat-icon {
        background: var(--primary-purple);
    }

    .stat-card.invigilators .stat-icon {
        background: var(--success-green);
    }

    .stat-card.notifications .stat-icon {
        background: var(--info-blue);
    }

    .stat-card.documents .stat-icon {
        background: var(--warning-orange);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: var(--text-dark);
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-change {
        font-size: 12px;
        margin-top: 8px;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .stat-change.positive {
        background: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    .stat-change.neutral {
        background: rgba(108, 117, 125, 0.1);
        color: var(--text-gray);
    }

    /* ===== Quick Actions Section ===== */
    .quick-actions {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-light);
        position: relative;
        overflow: hidden;
    }

    .quick-actions::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-purple);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        background: var(--accent-gold);
        color: var(--primary-purple);
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-gold);
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .action-btn:hover {
        background: var(--accent-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    .action-btn.secondary {
        background: transparent;
        color: var(--primary-purple);
        border-color: var(--primary-purple);
    }

    .action-btn.secondary:hover {
        background: var(--primary-purple);
        color: white;
    }

    /* ===== PowerBI Section ===== */
    .powerbi-section {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 25px;
        box-shadow: var(--shadow-light);
        position: relative;
        overflow: hidden;
    }

    .powerbi-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .powerbi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-light);
    }

    .powerbi-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-purple);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .refresh-btn {
        background: var(--primary-purple);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .refresh-btn:hover {
        background: var(--primary-purple-dark);
        transform: translateY(-1px);
    }

    .iframe-container {
        position: relative;
        width: 100%;
        height: 600px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        background: #f8f9fa;
        border: 1px solid var(--border-light);
    }

    .iframe-container iframe {
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 6px;
    }

    .iframe-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--text-gray);
        font-size: 14px;
        display: none;
    }

    .iframe-error {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: var(--text-gray);
        display: none;
    }

    .iframe-error i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.5;
        color: var(--primary-purple);
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }

        .dashboard-header {
            padding: 30px 20px;
            text-align: center;
        }

        .dashboard-title {
            font-size: 2rem;
        }

        .quick-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }

        .powerbi-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .iframe-container {
            height: 400px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-title {
            font-size: 1.5rem;
        }

        .quick-stats {
            grid-template-columns: 1fr;
        }

        .iframe-container {
            height: 300px;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .action-btn:focus,
    .refresh-btn:focus {
        outline: 2px solid var(--primary-purple);
        outline-offset: 2px;
    }

    /* ===== Animation Enhancements ===== */
    .stat-card,
    .quick-actions,
    .powerbi-section {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    /* ===== Loading States ===== */
    .refresh-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .refresh-btn.loading {
        pointer-events: none;
    }
</style>

<div class="dashboard-container">
    <!-- Dashboard Header (matching landing page hero style) -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">📊 Admin Dashboard</h1>
            <p class="dashboard-subtitle">Gambaran keseluruhan tentang pengurusan pengawas dan jadual peperiksaan melalui sistem e-Invigilator</p>
            <div class="welcome-message">
                🎯 <strong>Selamat kembali!</strong> Pantau jadual peperiksaan, urus pengawas, dan jadual pengawasan dari sistem ini.
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="quick-stats">
        <div class="stat-card schedules">
            <div class="stat-icon">📅</div>
            <div class="stat-number">1346</div>
            <div class="stat-label">Jadual Pengawasan</div>
            <div class="stat-change positive">+12% minggu ini</div>
        </div>
        <div class="stat-card invigilators">
            <div class="stat-icon">👥</div>
            <div class="stat-number">543</div>
            <div class="stat-label">Pengawas Berdaftar</div>
            <div class="stat-change positive">+8 new</div>
        </div>
        <div class="stat-card notifications">
            <div class="stat-icon">📬</div>
            <div class="stat-number">36</div>
            <div class="stat-label">Notifikasi</div>
            <div class="stat-change neutral">Hari ini</div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="quick-actions">
        <h2 class="section-title">⚡ Fungsi Pantas</h2>
        <div class="actions-grid">
            <a href="{{ route('admin.adminManageSchedule') }}" class="action-btn">
                📋 Urus Jadual
            </a>
            <a href="{{ route('admin.notifications') }}" class="action-btn">
                📬 Hantar Notifikasi
            </a>
            <a href="{{ route('admin.documents') }}" class="action-btn secondary">
                📄 Urus Dokumen
            </a>
        </div>
    </div>

    <!-- PowerBI Analytics Section -->
    <div class="powerbi-section">
        <div class="powerbi-header">
            <h2 class="powerbi-title">📈 Analitik Peperiksaan</h2>
            <button class="refresh-btn" onclick="refreshDashboard()">
                🔄 Refresh Data
            </button>
        </div>
        <div class="iframe-container">
            <div class="iframe-loading">
                ⏳ Memuat dashboard analitik...
            </div>
            <div class="iframe-error">
                <i>📊</i>
                <h4>Analitik Tidak dapat Ditontonkan</h4>
                <p>Unable to load PowerBI dashboard. Please check your connection and try again.</p>
            </div>
            <iframe 
                id="powerbi-frame"
                title="e-Invigilator System Analytics" 
                src="https://app.powerbi.com/reportEmbed?reportId=2d03bba6-b5c0-4fd8-b768-b42ac362795e&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" 
                allowFullScreen="true"
                onload="handleIframeLoad()"
                onerror="handleIframeError()">
            </iframe>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced hover effects for stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.querySelector('.stat-icon').style.transform = 'scale(1.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.querySelector('.stat-icon').style.transform = 'scale(1)';
            });
        });

        // Enhanced button interactions
        const actionButtons = document.querySelectorAll('.action-btn');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Parallax effect for header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.dashboard-header');
            if (header) {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3;
                header.style.transform = `translateY(${rate}px)`;
            }
        });

        // Animate numbers on page load
        animateNumbers();

        // Check iframe load status
        checkIframeStatus();
    });

    function refreshDashboard() {
        const refreshBtn = document.querySelector('.refresh-btn');
        const iframe = document.getElementById('powerbi-frame');
        
        // Add loading state
        refreshBtn.disabled = true;
        refreshBtn.classList.add('loading');
        refreshBtn.innerHTML = '⏳ Refreshing...';
        
        // Reload iframe
        iframe.src = iframe.src;
        
        // Reset button after 3 seconds
        setTimeout(() => {
            refreshBtn.disabled = false;
            refreshBtn.classList.remove('loading');
            refreshBtn.innerHTML = '🔄 Refresh Data';
        }, 3000);
    }

    function handleIframeLoad() {
        const loading = document.querySelector('.iframe-loading');
        const error = document.querySelector('.iframe-error');
        
        loading.style.display = 'none';
        error.style.display = 'none';
    }

    function handleIframeError() {
        const loading = document.querySelector('.iframe-loading');
        const error = document.querySelector('.iframe-error');
        
        loading.style.display = 'none';
        error.style.display = 'block';
    }

    function checkIframeStatus() {
        const iframe = document.getElementById('powerbi-frame');
        const loading = document.querySelector('.iframe-loading');
        
        loading.style.display = 'flex';
        
        // Hide loading after 5 seconds if iframe hasn't loaded
        setTimeout(() => {
            if (loading.style.display !== 'none') {
                loading.style.display = 'none';
            }
        }, 5000);
    }

    function animateNumbers() {
        const numbers = document.querySelectorAll('.stat-number');
        
        numbers.forEach(numberElement => {
            const finalNumber = parseInt(numberElement.textContent.replace(/,/g, ''));
            const duration = 2000; // 2 seconds
            const increment = finalNumber / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalNumber) {
                    current = finalNumber;
                    clearInterval(timer);
                }
                numberElement.textContent = Math.floor(current).toLocaleString();
            }, 16);
        });
    }

    // Update real-time data (placeholder for future implementation)
    function updateRealTimeData() {
        // This function can be expanded to fetch real-time data
        // and update the dashboard statistics
        console.log('Updating real-time data...');
    }

    // Set up periodic updates (every 5 minutes)
    setInterval(updateRealTimeData, 300000);
</script>
@endsection