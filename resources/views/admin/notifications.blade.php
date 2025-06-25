@extends('layouts.adminLayout')

@section('title', 'Notification Management')

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
        --success-green-light: #d4edda;
        --danger-red: #dc3545;
        --danger-red-light: #f8d7da;
        --warning-orange: #ffc107;
        --warning-orange-light: #fff3cd;
        --info-blue: #17a2b8;
        --info-blue-light: #d1ecf1;
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

    /* ===== Main Container ===== */
    .notifications-container {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
        background-color: var(--background-gray);
        min-height: 100vh;
    }

    /* ===== Page Header (matching landing page hero style) ===== */
    .page-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: white;
        padding: 40px 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-medium);
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header > div {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: white;
        margin: 0;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin: 10px 0 0 0;
        font-weight: 400;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: var(--accent-gold);
        color: var(--primary-purple);
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-gold);
        position: relative;
        z-index: 2;
        overflow: hidden;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        background: var(--accent-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    /* ===== Alert Styles (matching landing page) ===== */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
        position: relative;
        border: none;
        border-left: 4px solid;
    }

    .alert-success {
        background: var(--success-green-light);
        color: #155724;
        border-left-color: var(--success-green);
    }

    .alert-success::before {
        content: '✓';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--success-green);
        font-weight: bold;
        font-size: 16px;
    }

    .alert-success {
        padding-left: 45px;
    }

    .alert-danger {
        background: var(--danger-red-light);
        color: #721c24;
        border-left-color: var(--danger-red);
    }

    /* ===== Info Card (matching landing page features) ===== */
    .info-card {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 2px solid rgba(75, 0, 130, 0.2);
        border-radius: 8px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-purple);
    }

    .info-card h4 {
        margin: 0 0 15px 0;
        color: var(--primary-purple);
        font-size: 1.4rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-card p {
        margin: 0 0 20px 0;
        color: var(--text-dark);
        line-height: 1.6;
        font-size: 14px;
    }

    .info-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .feature-item {
        background: rgba(255, 255, 255, 0.8);
        padding: 15px;
        border-radius: 6px;
        border: 1px solid rgba(75, 0, 130, 0.1);
    }

    .feature-item strong {
        color: var(--primary-purple);
        font-weight: 600;
    }

    /* ===== Action Cards (matching landing page feature cards) ===== */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .action-card {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-heavy);
    }

    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .action-icon {
        width: 70px;
        height: 70px;
        background: var(--primary-purple);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .action-card:hover .action-icon {
        transform: scale(1.1);
        background: var(--primary-purple-dark);
    }

    .action-card.bulk .action-icon {
        background: var(--warning-orange);
    }

    .action-card.bulk:hover .action-icon {
        background: #e0a800;
    }

    .action-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .action-description {
        color: var(--text-gray);
        font-size: 14px;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--accent-gold);
        color: var(--primary-purple);
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid var(--accent-gold);
        font-size: 14px;
        position: relative;
        overflow: hidden;
    }

    .action-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .action-button:hover::before {
        left: 100%;
    }

    .action-button:hover {
        background: var(--accent-gold-dark);
        transform: translateY(-2px);
    }

    .action-button.bulk {
        background: var(--warning-orange);
        border-color: var(--warning-orange);
        color: white;
    }

    .action-button.bulk:hover {
        background: #e0a800;
    }

    /* ===== Statistics Section ===== */
    .stats-section {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-light);
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-purple);
        margin: 0 0 25px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat-card {
        background: #f8f8f8;
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 25px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
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

    .stat-card.success::before {
        background: var(--success-green);
    }

    .stat-card.danger::before {
        background: var(--danger-red);
    }

    .stat-card.warning::before {
        background: var(--warning-orange);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--text-dark);
        margin-bottom: 8px;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== Notifications Section ===== */
    .notifications-section {
        background: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        position: relative;
    }

    .notifications-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .section-header {
        background: #f8f8f8;
        border-bottom: 1px solid var(--border-light);
        padding: 25px 30px;
    }

    .notifications-table {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .table th,
    .table td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    .table th {
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--primary-purple-dark) 100%);
        font-weight: 600;
        color: white;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .table th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--accent-gold);
    }

    .table tbody tr {
        background: white;
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8f4ff;
    }

    .recipient-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .recipient-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .recipient-id {
        font-size: 12px;
        color: var(--text-gray);
        font-family: monospace;
    }

    .message-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .message-title {
        font-weight: 500;
        color: var(--text-dark);
    }

    .message-preview {
        font-size: 12px;
        color: var(--text-gray);
        line-height: 1.4;
    }

    .date-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 12px;
    }

    .created-date {
        color: var(--text-dark);
        font-weight: 500;
    }

    .sent-date {
        color: var(--text-gray);
    }

    /* ===== Badges ===== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-primary {
        background: rgba(75, 0, 130, 0.1);
        color: var(--primary-purple);
    }

    .badge-secondary {
        background: var(--border-light);
        color: var(--text-gray);
    }

    .badge-success {
        background: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    .badge-danger {
        background: rgba(220, 53, 69, 0.1);
        color: var(--danger-red);
    }

    .badge-warning {
        background: rgba(255, 193, 7, 0.1);
        color: #b07b00;
    }

    /* ===== Empty State ===== */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
        color: var(--text-gray);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
        color: var(--primary-purple);
    }

    .empty-state h4 {
        font-size: 1.3rem;
        color: var(--primary-purple);
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-gray);
        margin-bottom: 0;
    }

    /* ===== Pagination ===== */
    .pagination-container {
        padding: 25px 30px;
        border-top: 1px solid var(--border-light);
        background: #f8f8f8;
    }

    /* ===== Delete Button ===== */
    .btn-delete {
        background: var(--danger-red);
        color: white;
        border: 2px solid var(--danger-red);
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .notifications-container {
            padding: 15px;
        }

        .page-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
            padding: 30px 20px;
        }

        .page-title {
            font-size: 2rem;
        }

        .action-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .info-features {
            grid-template-columns: 1fr;
        }

        .table th,
        .table td {
            padding: 12px 10px;
            font-size: 12px;
        }

        .section-header {
            padding: 20px;
        }

        .pagination-container {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .btn-back,
        .action-button {
            width: 100%;
            text-align: center;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .btn-back:focus,
    .action-button:focus,
    .btn-delete:focus {
        outline: 2px solid var(--primary-purple);
        outline-offset: 2px;
    }

    /* ===== Animation Enhancements ===== */
    .action-card,
    .stat-card,
    .stats-section,
    .notifications-section {
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
</style>

<div class="notifications-container">
    <!-- Page Header (matching landing page hero style) -->
    <div class="page-header">
        <div>
            <h1 class="page-title">📬 Pengurusan Notifikasi</h1>
            <p class="page-subtitle">Menguruskan dan memantau notifikasi Telegram kepada pengawas peperiksaan</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            ❌ 
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Info Card (matching landing page features) -->
    <div class="info-card">
        <h4>
            📱 Sistem Notifikasi Telegram
        </h4>
        <p>Memperkemas komunikasi pengawas peperiksaan melalui sistem notifikasi Telegram. Hantar mesej notifikasi secara manual dan komunikasi berkelompok untuk peringatan penting.</p>
        
        <div class="info-features">
            <div class="feature-item">
                <strong>Mesej Manual:</strong> Hantar pemberitahuan diperibadikan kepada pengawas tertentu dengan kandungan dan masa yang bersesuaian.
            </div>
            <div class="feature-item">
                <strong>Mesej Berkelompok:</strong> Siarkan pengumuman penting kepada ramai pengawas secara serentak dengan efisien.
            </div>
        </div>
    </div>

    <!-- Action Cards (matching landing page feature cards) -->
    <div class="action-grid">
        <div class="action-card">
            <div class="action-icon">
                👤
            </div>
            <h3 class="action-title">Notifikasi Manual</h3>
            <p class="action-description">Hantar mesej notifikasi yang diperibadikan kepada pengawas khusus dengan kandungan tersuai dan "Template Variable" tersedia.</p>
            <a href="{{ route('admin.notifications.manual') }}" class="action-button">
                📤 Hantar secara Manual
            </a>
        </div>

        <div class="action-card bulk">
            <div class="action-icon">
                👥
            </div>
            <h3 class="action-title">Notifikasi Berkelompok</h3>
            <p class="action-description">Siarkan mesej notifikasi kepada ramai pengawas secara serentak dengan "Template Variable" tersedia.</p>
            <a href="{{ route('admin.notifications.bulk') }}" class="action-button bulk">
                📢 Hantar secara Berkelompok
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-section">
        <h2 class="section-title">
            📊 Statistik Notifikasi
        </h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $notifications->total() }}</div>
                <div class="stat-label">Jumlah Notifikasi</div>
            </div>
            <div class="stat-card success">
                <div class="stat-number">{{ $notifications->where('status', 'sent')->count() }}</div>
                <div class="stat-label">Berjaya</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-number">{{ $notifications->where('status', 'failed')->count() }}</div>
                <div class="stat-label">Gagal</div>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="notifications-section">
        <div class="section-header">
            <h2 class="section-title">
                🕒 Notifikasi Terkini
            </h2>
        </div>

        @if($notifications->count() > 0)
            <div class="notifications-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Penerima</th>
                            <th>Jenis</th>
                            <th>Mesej</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td>
                                    <div class="recipient-info">
                                        <div class="recipient-name">{{ $notification->userName }}</div>
                                        <div class="recipient-id">ID: {{ $notification->userID }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $notification->type === 'manual' ? 'primary' : 'secondary' }}">
                                        {{ ucfirst($notification->type) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="message-info">
                                        <div class="message-title">{{ $notification->title }}</div>
                                        <div class="message-preview">{{ Str::limit($notification->message, 60) }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if($notification->status === 'sent')
                                        <span class="badge badge-success">
                                            ✅ Sent
                                        </span>
                                    @elseif($notification->status === 'failed')
                                        <span class="badge badge-danger" title="{{ $notification->error_message }}">
                                            ❌ Failed
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div class="created-date">{{ $notification->created_at->format('M d, Y H:i') }}</div>
                                        @if($notification->sent_at)
                                            <div class="sent-date">Sent: {{ $notification->sent_at->format('M d, H:i') }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.notifications.delete', $notification->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this notification?');">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-container">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-bell-slash">🔕</i>
                <h4>No notifications sent yet</h4>
                <p>Start communicating with invigilators by sending your first Telegram notification.</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced hover effects for action cards
        const actionCards = document.querySelectorAll('.action-card');
        actionCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Enhanced hover effects for stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Enhanced button interactions
        const buttons = document.querySelectorAll('.action-button, .btn-back, .btn-delete');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            button.addEventListener('mouseleave', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });

        // Table row hover effects
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });

        // Enhanced delete confirmation
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                if (confirm('Are you sure you want to delete this notification? This action cannot be undone.')) {
                    // Add loading state
                    this.disabled = true;
                    this.innerHTML = '⏳ Deleting...';
                    form.submit();
                }
            });
        });

        // Smooth scrolling for better UX
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.page-header');
            if (header) {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3;
                header.style.transform = `translateY(${rate}px)`;
            }
        });

        // Badge hover effects
        const badges = document.querySelectorAll('.badge');
        badges.forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            badge.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Loading states for action buttons
        const actionButtons = document.querySelectorAll('.action-button');
        actionButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.style.opacity = '0.8';
                this.innerHTML = '⏳ Loading...';
            });
        });
    });
</script>
@endsection