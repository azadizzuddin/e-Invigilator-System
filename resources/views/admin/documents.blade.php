@extends('layouts.adminLayout')

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
        --danger-red: #dc3545;
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

    /* ===== Content Wrapper - FIXED CENTERING (Screen-based) ===== */
    .content-wrapper {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
        min-height: calc(100vh - 60px);
        transition: all 0.3s ease;
        position: relative;
    }

    /* Center content based on full screen width, not sidebar */
    .container-fluid {
        max-width: 900px;
        margin: 0 auto;
        width: 100%;
    }

    @media (max-width: 767.98px) {
        .content-wrapper {
            padding: 20px;
            max-width: 100%;
        }
        
        .container-fluid {
            max-width: 100%;
            padding: 0;
        }
    }

    /* ===== Page Header (matching landing page hero style) ===== */
    .page-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: white;
        padding: 40px 30px;
        margin-bottom: 30px;
        border-radius: 8px;
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

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold) 0%, transparent 100%);
    }

    .page-header .row {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: bold;
        color: white;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        font-size: 2.4rem;
        color: var(--accent-gold);
        filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0;
        font-size: 1.1rem;
    }

    /* ===== Card Styling (matching landing page) ===== */
    .card {
        background-color: var(--card-white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        box-shadow: var(--shadow-light);
        margin-bottom: 25px;
        overflow: hidden;
        animation: fadeInUp 0.5s ease-out;
    }

    .card-header {
        background: linear-gradient(135deg, #f8f8f8 0%, #f0f0f0 100%);
        border-bottom: 1px solid var(--border-light);
        padding: 20px 25px;
        position: relative;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-purple) 0%, var(--accent-gold) 100%);
    }

    .card-title {
        color: var(--primary-purple);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title i {
        color: var(--accent-gold);
        font-size: 1.3rem;
    }

    .card-body {
        padding: 25px;
    }

    /* ===== Form Styling ===== */
    .form-label {
        font-weight: 600;
        color: var(--primary-purple);
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-control {
        border: 2px solid var(--border-light);
        border-radius: 4px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: white;
        color: var(--text-dark);
    }

    .form-control:focus {
        border-color: var(--primary-purple);
        outline: none;
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
        transform: translateY(-1px);
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* ===== Button Styling (matching landing page) ===== */
    .btn {
        border-radius: 4px;
        padding: 12px 24px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background-color: var(--accent-gold);
        color: var(--primary-purple);
        border: 2px solid var(--accent-gold);
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: var(--accent-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        color: var(--primary-purple);
        text-decoration: none;
    }

    .btn-outline-primary {
        background-color: transparent;
        color: var(--primary-purple);
        border: 2px solid var(--primary-purple);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-purple);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-outline-danger {
        background-color: transparent;
        color: var(--danger-red);
        border: 2px solid var(--danger-red);
    }

    .btn-outline-danger:hover {
        background-color: var(--danger-red);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 12px;
    }

    .btn-group {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    /* ===== Table Styling (matching landing page aesthetic) ===== */
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .table {
        margin-bottom: 0;
        font-size: 14px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-dark {
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--primary-purple-dark) 100%);
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        color: white;
        border: none;
        padding: 15px 12px;
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

    .table td {
        vertical-align: middle;
        padding: 12px;
        border-bottom: 1px solid #f1f1f1;
        background: white;
        transition: background-color 0.2s ease;
    }

    .table-striped > tbody > tr:nth-of-type(odd) > td {
        background-color: #f8f4ff;
    }

    .table-hover > tbody > tr:hover > td {
        background-color: #f0f8ff;
        transform: scale(1.005);
        box-shadow: 0 2px 8px rgba(75, 0, 130, 0.1);
    }

    /* ===== Alert Styling ===== */
    .alert {
        border: none;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 20px;
        position: relative;
        border-left: 4px solid var(--success-green);
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
        font-size: 14px;
    }

    .alert-success {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: #065F46;
    }

    .alert-success::before {
        content: '✓';
        color: var(--success-green);
        font-weight: bold;
        font-size: 16px;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s;
        margin-left: auto;
    }

    .btn-close:hover {
        opacity: 1;
    }

    /* ===== Badge Styling ===== */
    .badge {
        font-size: 11px;
        padding: 6px 10px;
        border-radius: 4px;
        font-weight: 600;
    }

    .bg-secondary {
        background-color: var(--primary-purple) !important;
        color: white;
    }

    /* ===== Empty State Styling ===== */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: var(--text-gray);
    }

    .empty-state i {
        opacity: 0.3;
        color: var(--primary-purple);
        font-size: 4rem;
        margin-bottom: 20px;
        display: block;
    }

    .empty-state h4 {
        color: var(--primary-purple);
        margin: 15px 0 8px;
        font-size: 18px;
    }

    .empty-state p {
        color: var(--text-gray);
        margin-bottom: 0;
    }

    /* ===== Icon Styling ===== */
    .fas.fa-file-pdf {
        color: var(--danger-red);
    }

    .text-muted {
        color: var(--text-gray) !important;
    }

    .fw-medium {
        font-weight: 500 !important;
    }

    /* ===== Upload Section Enhancement ===== */
    .upload-section {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 2px dashed var(--primary-purple);
        border-radius: 8px;
        padding: 25px;
        position: relative;
    }

    .upload-section::before {
        content: '📁';
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 24px;
        opacity: 0.3;
    }

    /* ===== Document Row Enhancement ===== */
    .doc-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .doc-icon {
        font-size: 16px;
        color: var(--danger-red);
        flex-shrink: 0;
    }

    .doc-title {
        font-weight: 500;
        color: var(--text-dark);
    }

    .doc-date {
        color: var(--text-gray);
        font-size: 12px;
        line-height: 1.4;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 767.98px) {
        .content-wrapper {
            padding: 15px;
            margin: 0;
        }
        
        .container-fluid {
            max-width: 100%;
            padding: 0;
        }
        
        .page-header {
            padding: 30px 20px;
        }
        
        .page-title {
            font-size: 1.8rem;
            flex-direction: column;
            gap: 10px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .card-header {
            padding: 15px 20px;
        }
        
        .btn-group {
            flex-direction: column;
        }

        .btn-group .btn {
            margin-bottom: 5px;
        }
        
        .upload-section {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.5rem;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
        
        .doc-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .btn:focus,
    .form-control:focus {
        outline: 2px solid var(--primary-purple);
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
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Page Header (matching landing page hero style) -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">
                        <i class="fas fa-file-upload"></i>
                        Urus Dokumen
                    </h1>
                    <p class="page-subtitle">Muat naik dan urus dokumen tambahan untuk tugas-tugas pengawasan peperiksaan</p>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <!-- Upload Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-cloud-upload-alt"></i>
                    Muat Naik Dokumen Baru
                </h5>
            </div>
            <div class="card-body">
                <div class="upload-section">
                    <form action="{{ route('admin.documents.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Nama Dokumen</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="title" 
                                           name="title" 
                                           placeholder="Masukkan nama dokumen" 
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file" class="form-label">Fail PDF</label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="file" 
                                           name="file" 
                                           accept="application/pdf" 
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i>
                                Muat Naik Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Documents List -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-list-alt"></i>
                    Dokumen yang Dimuat Naik ({{ $documents->count() }} dokumen)
                </h5>
            </div>
            <div class="card-body">
                @if($documents->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 60px;">No.</th>
                                    <th>Nama Dokumen</th>
                                    <th style="width: 180px;">Masa Dimuat Naik</th>
                                    <th style="width: 140px;">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $doc)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <div class="doc-info">
                                                <i class="fas fa-file-pdf doc-icon"></i>
                                                <span class="doc-title">{{ $doc->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="doc-date">
                                                {{ $doc->created_at->format('d M Y') }}<br>
                                                <span style="color: var(--text-muted);">{{ $doc->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('documents.download', $doc->id) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Muat Turun">
                                                    Download
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Padam"
                                                        data-document-id="{{ $doc->id }}"
                                                        onclick="confirmDelete(this.getAttribute('data-document-id'))">
                                                         Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination if needed -->
                    @if($documents instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-center mt-3">
                            {{ $documents->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-file-pdf"></i>
                        <h4>Tiada Dokumen Dimuat Naik</h4>
                        <p>Muat naik dokumen PDF pertanda anda menggunakan borang di atas.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(documentId) {
        // Ensure documentId is valid
        if (!documentId || isNaN(documentId)) {
            console.error('Invalid document ID');
            return;
        }
        
        if (confirm('Adakah anda pasti untuk memadamkan dokumen ini? Tindakan ini tidak boleh dibatalkan.')) {
            // Create and submit a delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/documents/${encodeURIComponent(documentId)}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Enhanced JavaScript for better UX
    document.addEventListener('DOMContentLoaded', function() {
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
        const buttons = document.querySelectorAll('.btn');
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

        // Form submission loading states
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat naik...';
                    
                    // Reset after 5 seconds to prevent permanent lock
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 5000);
                }
            });
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

        // File input enhancement
        const fileInput = document.getElementById('file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'Tiada fail dipilih';
                console.log('Fail dipilih:', fileName);
            });
        }

        // Table row hover effects
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.005)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endsection