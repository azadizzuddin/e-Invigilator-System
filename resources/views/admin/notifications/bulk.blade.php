@extends('layouts.adminLayout')

@section('title', 'Bulk Notification')

@section('content')
<style>
    /* ===== UiTM Official Brand Colors ===== */
    :root {
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
        --uitm-success: #28a745;
        --uitm-danger: #dc3545;
        --uitm-warning: #ffc107;
        --uitm-info: #17a2b8;
        
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

    body {
        font-family: var(--uitm-font-family);
        background-color: var(--uitm-gray);
        color: var(--uitm-text-primary);
        line-height: 1.6;
    }

    /* ===== Content Wrapper ===== */
    .notification-form-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
        min-height: calc(100vh - 60px);
    }

    /* ===== UiTM Page Header ===== */
    .page-header {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        padding: 30px 40px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-medium);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 215, 0, 0.3);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--uitm-gold) 0%, transparent 100%);
    }

    .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: var(--uitm-white);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        z-index: 2;
    }

    .page-title i {
        font-size: 2.2rem;
        color: var(--uitm-gold);
        filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
    }

    /* ===== UiTM Back Button ===== */
    .btn-back {
        padding: 10px 20px;
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        text-decoration: none;
        border-radius: var(--uitm-border-radius-sm);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--uitm-transition);
        font-size: 14px;
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
        color: var(--uitm-purple);
        text-decoration: none;
    }

    /* ===== UiTM Card Styling ===== */
    .form-card {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        padding: 30px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.5s ease-out;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    /* ===== UiTM Form Styling ===== */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label, .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--uitm-purple);
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius-sm);
        font-size: 14px;
        transition: var(--uitm-transition);
        background-color: var(--uitm-white);
        color: var(--uitm-text-primary);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--uitm-purple);
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
        transform: translateY(-1px);
    }

    /* ===== UiTM Button Styling ===== */
    .btn {
        border-radius: var(--uitm-border-radius-sm);
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        transition: var(--uitm-transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        gap: 8px;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-gold);
    }

    .btn-primary:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
        color: var(--uitm-purple);
        text-decoration: none;
    }

    .btn-secondary {
        background: transparent;
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-purple);
    }

    .btn-secondary:hover {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-submit {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        padding: 12px 24px;
        border: 2px solid var(--uitm-purple);
        border-radius: var(--uitm-border-radius-sm);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        background: var(--uitm-purple-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    /* ===== Selection Control Buttons ===== */
    .btn-select {
        padding: 8px 16px;
        border: 2px solid var(--uitm-border);
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius-sm);
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: var(--uitm-transition);
        color: var(--uitm-text-primary);
        position: relative;
        overflow: hidden;
    }

    .btn-select::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-select:hover::before {
        left: 100%;
    }

    .btn-select:hover {
        background: var(--uitm-gray-light);
        border-color: var(--uitm-purple);
        transform: translateY(-1px);
    }

    .btn-select.active {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        border-color: var(--uitm-purple);
        transform: translateY(-1px);
        box-shadow: var(--uitm-shadow-light);
    }

    /* ===== UiTM Alert Styling ===== */
    .alert {
        padding: 16px 20px;
        border-radius: var(--uitm-border-radius);
        margin-bottom: 20px;
        position: relative;
        border-left: 4px solid;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-weight: 500;
        font-size: 14px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: #991B1B;
        border-left-color: var(--uitm-danger);
    }

    .alert-danger::before {
        content: '⚠';
        color: var(--uitm-danger);
        font-weight: bold;
        font-size: 16px;
        flex-shrink: 0;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* ===== Info Sections ===== */
    .telegram-info, .recipients-section, .stats-info {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 1px solid rgba(75, 0, 130, 0.2);
        border-radius: var(--uitm-border-radius);
        padding: 25px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .telegram-info::before, .recipients-section::before, .stats-info::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .telegram-info h4, .recipients-section h4, .stats-info h4 {
        margin: 0 0 15px 0;
        color: var(--uitm-purple);
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .telegram-info h4 i, .recipients-section h4 i, .stats-info h4 i {
        color: var(--uitm-gold);
    }

    .telegram-info p {
        color: var(--uitm-text-secondary);
        line-height: 1.6;
        margin: 0;
    }

    /* ===== Recipients Grid ===== */
    .recipients-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 15px;
        max-height: 400px;
        overflow-y: auto;
        padding: 20px;
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius-sm);
        border: 1px solid var(--uitm-border);
        scrollbar-width: thin;
        scrollbar-color: var(--uitm-purple) transparent;
    }

    .recipients-grid::-webkit-scrollbar {
        width: 8px;
    }

    .recipients-grid::-webkit-scrollbar-track {
        background: var(--uitm-gray-light);
        border-radius: 4px;
    }

    .recipients-grid::-webkit-scrollbar-thumb {
        background: var(--uitm-purple);
        border-radius: 4px;
    }

    .recipient-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        border: 1px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius-sm);
        background: var(--uitm-gray-light);
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
    }

    .recipient-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 3px;
        height: 100%;
        background: var(--uitm-purple);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .recipient-item:hover {
        background: var(--uitm-white);
        box-shadow: var(--uitm-shadow-light);
        transform: translateY(-2px);
    }

    .recipient-item:hover::before {
        transform: scaleY(1);
    }

    .recipient-checkbox {
        width: 18px;
        height: 18px;
        accent-color: var(--uitm-purple);
        flex-shrink: 0;
    }

    .recipient-info {
        flex: 1;
    }

    .recipient-name {
        font-weight: 600;
        color: var(--uitm-purple);
        margin-bottom: 5px;
        font-size: 14px;
    }

    .recipient-details {
        font-size: 12px;
        color: var(--uitm-text-secondary);
        margin-bottom: 5px;
    }

    .recipient-contact {
        font-size: 11px;
        color: var(--uitm-success);
        font-weight: 600;
    }

    /* ===== Selection Controls ===== */
    .selection-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    /* ===== Stats Section ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }

    .stat-item {
        text-align: center;
        background: var(--uitm-white);
        padding: 15px;
        border-radius: var(--uitm-border-radius-sm);
        border: 1px solid var(--uitm-border);
        transition: var(--uitm-transition);
    }

    .stat-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-light);
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--uitm-purple);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 12px;
        color: var(--uitm-text-secondary);
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* ===== Template Variables Section ===== */
    .template-variables-section {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 1px solid rgba(75, 0, 130, 0.2);
        border-radius: var(--uitm-border-radius);
        padding: 25px;
        margin-top: 25px;
        position: relative;
        overflow: hidden;
    }

    .template-variables-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .template-variables-section h4 {
        margin: 0 0 20px 0;
        color: var(--uitm-purple);
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .template-variables-section h4 i {
        color: var(--uitm-gold);
    }

    .variables-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 15px;
    }

    .variable-item {
        background: var(--uitm-white);
        padding: 12px;
        border-radius: var(--uitm-border-radius-sm);
        border: 1px solid var(--uitm-border);
        transition: var(--uitm-transition);
    }

    .variable-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-light);
    }

    .variable-item code {
        font-weight: 600;
        color: var(--uitm-purple);
        background: var(--uitm-gray-light);
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 12px;
        display: block;
        margin-bottom: 5px;
    }

    .variable-item span {
        color: var(--uitm-text-secondary);
        font-size: 12px;
        line-height: 1.4;
    }

    /* ===== Preview Section ===== */
    .preview-section {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 1px solid rgba(75, 0, 130, 0.2);
        border-radius: var(--uitm-border-radius);
        padding: 25px;
        margin-top: 25px;
        position: relative;
        overflow: hidden;
    }

    .preview-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .preview-section h4 {
        margin: 0 0 15px 0;
        color: var(--uitm-purple);
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .preview-content {
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius-sm);
        padding: 20px;
        border: 1px solid var(--uitm-border);
        box-shadow: var(--uitm-shadow-light);
    }

    .preview-title {
        font-weight: 600;
        color: var(--uitm-purple);
        margin-bottom: 10px;
        font-size: 16px;
    }

    .preview-message {
        color: var(--uitm-text-secondary);
        line-height: 1.6;
        font-size: 14px;
    }

    /* ===== Character Count ===== */
    #charCount {
        font-weight: 600;
        color: var(--uitm-purple);
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .notification-form-container {
            padding: 20px;
        }
        
        .page-header {
            padding: 25px 20px;
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.6rem;
            flex-direction: column;
            gap: 10px;
        }
        
        .form-card {
            padding: 20px;
        }
        
        .recipients-grid {
            grid-template-columns: 1fr;
            max-height: 300px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .variables-grid {
            grid-template-columns: 1fr;
        }
        
        .selection-controls {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.3rem;
        }
        
        .template-variables-section,
        .preview-section,
        .telegram-info,
        .recipients-section,
        .stats-info {
            padding: 15px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ===== Animation Enhancements ===== */
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

    /* ===== Focus States ===== */
    .btn:focus,
    .form-control:focus {
        outline: 2px solid var(--uitm-gold);
        outline-offset: 2px;
    }

    /* ===== Loading States ===== */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn:disabled:hover {
        transform: none !important;
    }
</style>

<div class="notification-form-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-broadcast-tower"></i>
            Notifikasi Berkelompok
        </h1>
        <a href="{{ route('admin.notifications') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Notifikasi
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="telegram-info">
        <h4><i class="fab fa-telegram-plane"></i> Notifikasi Telegram Berkelompok</h4>
        <p>Ini akan menghantar mesej Telegram kepada beberapa pengawas sekaligus. Hanya pengawas yang mempunyai Chat ID yang sah akan menerima mesej.</p>
    </div>

    <div class="form-card">
        <form method="GET" action="">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: end;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="userID" class="form-label">Cari ID Pengguna</label>
                    <input type="text" name="userID" id="userID" class="form-control" value="{{ request('userID') }}" placeholder="cth. 111111">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="userName" class="form-label">Cari Nama</label>
                    <input type="text" name="userName" id="userName" class="form-control" value="{{ request('userName') }}" placeholder="cth. AZAD">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="faculty" class="form-label">Fakulti</label>
                    <select name="faculty" id="faculty" class="form-control">
                        <option value="">-- Semua Fakulti --</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty }}" {{ request('faculty') == $faculty ? 'selected' : '' }}>{{ $faculty }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="position" class="form-label">Jawatan</label>
                    <select name="position" id="position" class="form-control">
                        <option value="">-- Semua Jawatan --</option>
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                        Tapis
                    </button>
                    <a href="{{ route('admin.notifications.bulk') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.notifications.send-bulk') }}" method="POST" id="bulkNotificationForm">
            @csrf
            
            <div class="recipients-section">
                <h4><i class="fas fa-users"></i> Pilih Penerima</h4>
                
                <div class="selection-controls">
                    <button type="button" class="btn-select" id="selectAll">
                        <i class="fas fa-check-double"></i> Pilih Semua
                    </button>
                    <button type="button" class="btn-select" id="selectWithChatId">
                        <i class="fab fa-telegram-plane"></i> Pilih dengan Chat ID
                    </button>
                    <button type="button" class="btn-select" id="clearSelection">
                        <i class="fas fa-times"></i> Kosongkan Pilihan
                    </button>
                </div>

                <div class="stats-info">
                    <h4><i class="fas fa-chart-bar"></i> Statistik Pemilihan</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number" id="totalCount">{{ $invigilators->count() }}</div>
                            <div class="stat-label">Jumlah Pengawas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" id="selectedCount">0</div>
                            <div class="stat-label">Dipilih</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" id="withChatIdCount">{{ $invigilators->whereNotNull('chat_id')->count() }}</div>
                            <div class="stat-label">Ada Chat ID</div>
                        </div>
                    </div>
                </div>

                <div class="recipients-grid">
                    @foreach($invigilators as $invigilator)
                        <div class="recipient-item">
                            <input type="checkbox" name="userIDs[]" value="{{ $invigilator->userID }}" 
                                   class="recipient-checkbox" id="recipient_{{ $invigilator->userID }}"
                                   data-chat-id="{{ $invigilator->chat_id }}">
                            <div class="recipient-info">
                                <div class="recipient-name">{{ $invigilator->userName }}</div>
                                <div class="recipient-details">{{ $invigilator->userID }} • {{ $invigilator->position }}</div>
                                <div class="recipient-contact">
                                    @if($invigilator->chat_id)
                                        📱 Telegram: {{ $invigilator->chat_id }}
                                    @else
                                        ❌ Tiada Telegram Chat ID
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="title">Tajuk Mesej *</label>
                <input type="text" name="title" id="title" class="form-control" 
                       placeholder="Masukkan tajuk mesej..." required maxlength="255">
                <small style="color: var(--uitm-text-muted); margin-top: 5px; display: block;">
                    Anda boleh menggunakan template variables seperti {invigilator_name}, {position}, {faculty}, dll.
                </small>
            </div>

            <div class="form-group">
                <label for="message">Kandungan Mesej *</label>
                <textarea name="message" id="message" class="form-control" rows="6" 
                          placeholder="Masukkan kandungan mesej anda..." required maxlength="1000"></textarea>
                <small style="color: var(--uitm-text-muted); margin-top: 5px; display: block;">
                    Maksimum 1000 aksara. Sekarang: <span id="charCount">0</span>
                </small>
            </div>

            <div class="template-variables-section">
                <h4><i class="fas fa-code"></i> Template Variables yang Tersedia</h4>
                <div class="variables-grid">
                    <div class="variable-item">
                        <code>{invigilator_name}</code>
                        <span>Nama Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{invigilator_id}</code>
                        <span>ID Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{position}</code>
                        <span>Jawatan Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{faculty}</code>
                        <span>Fakulti Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{contact}</code>
                        <span>Hubungan Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_date}</code>
                        <span>Tarikh Semasa (dd/mm/yyyy)</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_day}</code>
                        <span>Nama Hari Semasa</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_time}</code>
                        <span>Masa Semasa</span>
                    </div>
                    <div class="variable-item">
                        <code>{chat_id}</code>
                        <span>Telegram Chat ID</span>
                    </div>
                    <div class="variable-item">
                        <code>{created_at}</code>
                        <span>Tarikh Daftar Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{updated_at}</code>
                        <span>Tarikh Kemaskini Pengawas</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_year}</code>
                        <span>Tahun Semasa</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_month}</code>
                        <span>Bulan Semasa</span>
                    </div>
                    <div class="variable-item">
                        <code>{current_datetime}</code>
                        <span>Tarikh & Masa Semasa</span>
                    </div>
                </div>
                <small style="color: var(--uitm-text-muted); margin-top: 15px; display: block;">
                    Variables ini akan digantikan secara automatik dengan data sebenar untuk setiap penerima apabila mesej dihantar.
                </small>
            </div>

            <div class="preview-section">
                <h4><i class="fas fa-eye"></i> Preview Mesej</h4>
                <div class="preview-content">
                    <div class="preview-title" id="previewTitle">Tajuk mesej anda akan tertera di sini...</div>
                    <div class="preview-message" id="previewMessage">Kandungan mesej anda akan tertera di sini...</div>
                </div>
            </div>

            <div style="text-align: right; margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    <i class="fab fa-telegram-plane"></i>
                    Hantar Notifikasi Telegram Berkelompok
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.recipient-checkbox');
        const selectAllBtn = document.getElementById('selectAll');
        const selectWithChatIdBtn = document.getElementById('selectWithChatId');
        const clearSelectionBtn = document.getElementById('clearSelection');
        const selectedCount = document.getElementById('selectedCount');
        const titleInput = document.getElementById('title');
        const messageInput = document.getElementById('message');
        const charCount = document.getElementById('charCount');
        const previewTitle = document.getElementById('previewTitle');
        const previewMessage = document.getElementById('previewMessage');

        // Update selected count
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.recipient-checkbox:checked').length;
            selectedCount.textContent = selected;
        }

        // Select all
        selectAllBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
            this.classList.add('active');
            selectWithChatIdBtn.classList.remove('active');
            clearSelectionBtn.classList.remove('active');
        });

        // Select with chat ID only
        selectWithChatIdBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = checkbox.dataset.chatId && checkbox.dataset.chatId.trim() !== '';
            });
            updateSelectedCount();
            this.classList.add('active');
            selectAllBtn.classList.remove('active');
            clearSelectionBtn.classList.remove('active');
        });

        // Clear selection
        clearSelectionBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
            this.classList.add('active');
            selectAllBtn.classList.remove('active');
            selectWithChatIdBtn.classList.remove('active');
        });

        // Update count when checkboxes change
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedCount();
                // Remove active state from buttons when manually changing
                selectAllBtn.classList.remove('active');
                selectWithChatIdBtn.classList.remove('active');
                clearSelectionBtn.classList.remove('active');
            });
        });

        // Update character count
        messageInput.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            if (count > 900) {
                charCount.style.color = 'var(--uitm-warning)';
            } else if (count > 950) {
                charCount.style.color = 'var(--uitm-danger)';
            } else {
                charCount.style.color = 'var(--uitm-purple)';
            }
        });

        // Update preview in real-time
        titleInput.addEventListener('input', function() {
            previewTitle.textContent = this.value || 'Tajuk mesej anda akan tertera di sini...';
        });

        messageInput.addEventListener('input', function() {
            previewMessage.textContent = this.value || 'Kandungan mesej anda akan tertera di sini...';
        });

        // Form validation
        document.getElementById('bulkNotificationForm').addEventListener('submit', function(e) {
            const selectedRecipients = document.querySelectorAll('.recipient-checkbox:checked');
            const title = titleInput.value.trim();
            const message = messageInput.value.trim();

            if (selectedRecipients.length === 0) {
                e.preventDefault();
                alert('Sila pilih sekurang-kurangnya seorang penerima.');
                return;
            }

            if (!title) {
                e.preventDefault();
                alert('Sila masukkan tajuk mesej.');
                titleInput.focus();
                return;
            }

            if (!message) {
                e.preventDefault();
                alert('Sila masukkan kandungan mesej.');
                messageInput.focus();
                return;
            }

            if (message.length > 1000) {
                e.preventDefault();
                alert('Kandungan mesej tidak boleh melebihi 1000 aksara.');
                messageInput.focus();
                return;
            }

            // Check if any selected recipients don't have chat IDs
            const recipientsWithoutChatId = Array.from(selectedRecipients).filter(checkbox => 
                !checkbox.dataset.chatId || checkbox.dataset.chatId.trim() === ''
            );

            if (recipientsWithoutChatId.length > 0) {
                const confirmMessage = `${recipientsWithoutChatId.length} penerima yang dipilih tidak mempunyai Telegram Chat ID. Mereka akan dilangkau. Teruskan?`;
                if (!confirm(confirmMessage)) {
                    e.preventDefault();
                    return;
                }
            }

            // Show loading state
            const submitBtn = this.querySelector('.btn-submit');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghantar...';
        });

        // Enhanced form interactions
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-1px)';
                this.style.boxShadow = '0 4px 8px rgba(75, 0, 130, 0.15)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });

        // Enhanced button interactions
        const buttons = document.querySelectorAll('.btn, .btn-select');
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

        // Initialize
        updateSelectedCount();
    });
</script>
@endsection