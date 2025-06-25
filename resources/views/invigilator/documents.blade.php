@extends('layouts.invigilatorLayout')

@section('title', 'Dokumen - Sistem e-Invigilator UiTM')

@section('content')
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
        --uitm-success: #28a745;
        --uitm-danger: #dc3545;
        --uitm-warning: #ffc107;
        
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
        margin: 0;
        padding: 0;
    }

    /* Main Layout Container - FIXED */
    .documents-container {
        padding: 20px;
        background-color: var(--uitm-gray);
        min-height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 20px;
        box-sizing: border-box;
    }

    /* Content Wrapper */
    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
    }

    /* UiTM Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        padding: 30px 40px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-medium);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 215, 0, 0.3);
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

    .page-header .content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: var(--uitm-white);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        font-size: 2.2rem;
        color: var(--uitm-gold);
        filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin: 10px 0 0 0;
        font-size: 1rem;
        font-weight: 400;
    }

    .header-stats {
        text-align: right;
        color: rgba(255, 255, 255, 0.9);
    }

    .header-stats .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: var(--uitm-gold);
        display: block;
        line-height: 1;
    }

    .header-stats .stat-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 5px;
    }

    /* UiTM Content Card */
    .content-card {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        overflow: hidden;
        position: relative;
    }

    .content-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .content-header {
        padding: 25px 30px;
        background: var(--uitm-gray-light);
        border-bottom: 1px solid var(--uitm-border);
        position: relative;
    }

    .content-title {
        color: var(--uitm-purple);
        font-weight: bold;
        font-size: 1.3rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .content-title i {
        color: var(--uitm-gold);
        font-size: 1.4rem;
    }

    .content-body {
        padding: 0;
    }

    /* UiTM Alert Styling */
    .alert {
        margin: 20px 30px;
        padding: 16px 20px;
        border-radius: var(--uitm-border-radius);
        border: none;
        position: relative;
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

    .alert .btn-close {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s;
        margin-left: auto;
    }

    .alert .btn-close:hover {
        opacity: 1;
    }

    /* UiTM Table Styling - FIXED */
    .table-container {
        margin: 0;
        background: var(--uitm-white);
        overflow: hidden;
    }

    .table-responsive {
        border-radius: 0;
        box-shadow: none;
        margin: 0;
        overflow-x: auto;
    }

    .table {
        margin: 0;
        font-size: 14px;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        min-width: 700px;
    }

    .table thead th {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
        padding: 18px 20px;
        position: relative;
        white-space: nowrap;
        text-align: left;
    }

    .table thead th:first-child {
        width: 80px;
        text-align: center;
    }

    .table thead th:nth-child(2) {
        width: auto;
        min-width: 300px;
    }

    .table thead th:nth-child(3) {
        width: 180px;
        text-align: center;
    }

    .table thead th:last-child {
        width: 150px;
        text-align: center;
    }

    .table thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--uitm-gold);
    }

    .table tbody td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f1f1;
        background: var(--uitm-white);
        vertical-align: middle;
        transition: var(--uitm-transition);
    }

    .table tbody td:first-child {
        text-align: center;
    }

    .table tbody td:nth-child(3) {
        text-align: center;
    }

    .table tbody td:last-child {
        text-align: center;
    }

    .table tbody tr:nth-child(odd) td {
        background-color: #f8f4ff;
    }

    .table tbody tr:hover td {
        background-color: #f0f8ff;
        transform: scale(1.002);
        box-shadow: 0 2px 8px rgba(75, 0, 130, 0.1);
    }

    /* Document Row Styling */
    .doc-number {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        padding: 6px 12px;
        border-radius: var(--uitm-border-radius-sm);
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        min-width: 40px;
        display: inline-block;
    }

    .doc-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        color: var(--uitm-text-primary);
    }

    .doc-icon {
        font-size: 20px;
        color: var(--uitm-danger);
        flex-shrink: 0;
    }

    .doc-date {
        color: var(--uitm-text-secondary);
        font-size: 13px;
        line-height: 1.4;
    }

    .doc-time {
        color: var(--uitm-text-muted);
        font-weight: 500;
    }

    /* UiTM Button Styling */
    .btn {
        border-radius: var(--uitm-border-radius-sm);
        padding: 10px 20px;
        font-weight: 600;
        font-size: 13px;
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

    .btn-download {
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-gold);
        font-weight: 600;
    }

    .btn-download:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
        color: var(--uitm-purple);
        text-decoration: none;
    }

    .btn-download i {
        font-size: 14px;
    }

    /* Empty State Styling */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
        color: var(--uitm-text-secondary);
        background: var(--uitm-white);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: var(--uitm-purple);
        opacity: 0.3;
        margin-bottom: 20px;
        display: block;
    }

    .empty-state h4 {
        color: var(--uitm-purple);
        margin: 15px 0 10px;
        font-size: 1.3rem;
        font-weight: 600;
    }

    .empty-state p {
        color: var(--uitm-text-secondary);
        margin: 0;
        font-size: 15px;
    }

    /* Responsive Design - IMPROVED */
    @media (max-width: 1024px) {
        .documents-container {
            padding: 15px;
        }
        
        .page-header .content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        
        .header-stats {
            text-align: center;
        }
        
        .table {
            min-width: 600px;
        }
    }

    @media (max-width: 768px) {
        .documents-container {
            padding: 10px;
        }
        
        .page-header {
            padding: 25px 20px;
        }
        
        .page-title {
            font-size: 1.6rem;
        }
        
        .content-header {
            padding: 20px 20px;
        }
        
        .content-title {
            font-size: 1.1rem;
        }
        
        .alert {
            margin: 15px 20px;
        }
        
        .table {
            min-width: 500px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 12px 10px;
            font-size: 12px;
        }
        
        .table thead th:first-child,
        .table tbody td:first-child {
            width: 50px;
        }
        
        .table thead th:nth-child(3),
        .table tbody td:nth-child(3) {
            width: 120px;
        }
        
        .table thead th:last-child,
        .table tbody td:last-child {
            width: 100px;
        }
        
        .btn-download {
            padding: 8px 12px;
            font-size: 11px;
        }
        
        .doc-title {
            font-size: 12px;
        }
        
        .doc-icon {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.3rem;
            flex-direction: column;
            gap: 10px;
        }
        
        .table {
            min-width: 400px;
        }
        
        .doc-title {
            flex-direction: column;
            align-items: center;
            gap: 5px;
            text-align: center;
        }
        
        .empty-state {
            padding: 40px 20px;
        }
        
        .empty-state-icon {
            font-size: 3rem;
        }
        
        .btn-download {
            width: auto;
            min-width: 80px;
        }
    }

    /* Animation Enhancements */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .content-card {
        animation: slideInUp 0.5s ease-out;
    }

    .table tbody tr {
        opacity: 0;
        animation: slideInUp 0.5s ease-out forwards;
    }

    /* Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Focus States for Accessibility */
    .btn:focus {
        outline: 2px solid var(--uitm-gold);
        outline-offset: 2px;
    }
</style>

<div class="documents-container">
    <div class="content-wrapper">
        <!-- UiTM Page Header -->
        <div class="page-header">
            <div class="content">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-file-download"></i>
                        Dokumen
                    </h1>
                    <p class="page-subtitle">Senarai dokumen yang boleh dimuat turun untuk prosedur peperiksaan</p>
                </div>
                <div class="header-stats">
                    <span class="stat-number">{{ $documents->count() }}</span>
                    <div class="stat-label">Jumlah Dokumen</div>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <!-- Documents Content Card -->
        <div class="content-card">
            <div class="content-header">
                <h2 class="content-title">
                    <i class="fas fa-list-alt"></i>
                    Senarai Dokumen Tersedia
                </h2>
            </div>
            
            <div class="content-body">
                @if($documents->count() > 0)
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tajuk Dokumen</th>
                                        <th>Tarikh Dimuat Naik</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $doc)
                                        <tr style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                            <td>
                                                <span class="doc-number">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <div class="doc-title">
                                                    <i class="fas fa-file-pdf doc-icon"></i>
                                                    <span>{{ $doc->title }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="doc-date">
                                                    {{ $doc->created_at->format('d M Y') }}<br>
                                                    <span class="doc-time">{{ $doc->created_at->format('H:i') }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('documents.download', $doc->id) }}" 
                                                   class="btn btn-download"
                                                   title="Muat Turun {{ $doc->title }}">
                                                    <i class="fas fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pagination if needed -->
                    @if($documents instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div style="padding: 20px 30px; border-top: 1px solid var(--uitm-border); display: flex; justify-content: center;">
                            {{ $documents->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-file-pdf empty-state-icon"></i>
                        <h4>Tiada Dokumen Tersedia</h4>
                        <p>Belum ada dokumen yang dimuat naik oleh pentadbir sistem. Sila hubungi pentadbir untuk maklumat lanjut.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced button interactions
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                if (!this.classList.contains('loading')) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            button.addEventListener('mouseleave', function() {
                if (!this.classList.contains('loading')) {
                    this.style.transform = 'translateY(0)';
                }
            });
            
            // Add loading state on download
            if (button.classList.contains('btn-download')) {
                button.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.classList.add('loading');
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat Turun...';
                    
                    // Reset after 3 seconds (adjust as needed)
                    setTimeout(() => {
                        this.classList.remove('loading');
                        this.innerHTML = originalText;
                    }, 3000);
                });
            }
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transform = 'translateX(100%)';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentElement) {
                        alert.remove();
                    }
                }, 300);
            }, 5000);
        });

        // Enhanced table row animations
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.1}s`;
            
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.002) translateY(-1px)';
                this.style.zIndex = '1';
                this.style.boxShadow = '0 4px 12px rgba(75, 0, 130, 0.15)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) translateY(0)';
                this.style.zIndex = 'auto';
                this.style.boxShadow = 'none';
            });
        });

        // Smooth scrolling for any anchor links
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
    });
</script>
@endsection