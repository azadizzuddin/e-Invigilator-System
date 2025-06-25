@extends('layouts.adminLayout')

@section('title', 'Urus Pengawas - Sistem e-Invigilator UiTM')

@section('page_styles')
<style>
    /* ===== UiTM Brand Colors ===== */
    :root {
        --uitm-purple: #4B0082;
        --uitm-purple-dark: #3A006F;
        --uitm-purple-light: #5B1A8B;
        --uitm-gold: #FFD700;
        --uitm-gold-dark: #FFC500;
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
        
        --uitm-shadow-light: 0 2px 4px rgba(0,0,0,0.1);
        --uitm-shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
        --uitm-shadow-heavy: 0 8px 16px rgba(0,0,0,0.2);
        --uitm-border-radius: 8px;
        --uitm-border-radius-sm: 4px;
        --uitm-transition: all 0.3s ease;
    }

    body {
        font-family: Arial, 'Helvetica Neue', sans-serif;
        background-color: var(--uitm-gray);
        color: var(--uitm-text-primary);
    }

    /* ===== Main Container ===== */
    .main {
        padding: 20px;
        background-color: var(--uitm-gray);
    }

    /* ===== Page Header (UiTM Style) ===== */
    .main-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: var(--uitm-white);
        padding: 30px 40px;
        border-radius: var(--uitm-border-radius);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: var(--uitm-shadow-medium);
    }

    .main-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .main-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--uitm-gold) 0%, transparent 100%);
    }

    .main-title {
        font-size: 2rem;
        font-weight: bold;
        margin: 0;
        position: relative;
        z-index: 2;
        color: var(--uitm-white) !important;
    }

    .action-buttons {
        position: relative;
        z-index: 2;
    }

    /* ===== UiTM Buttons ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: none;
        border-radius: var(--uitm-border-radius-sm);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
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

    .btn-success {
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-gold);
    }

    .btn-success:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-primary {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        border: 2px solid var(--uitm-purple);
    }

    .btn-primary:hover {
        background: var(--uitm-purple-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-danger {
        background: var(--uitm-danger);
        color: var(--uitm-white);
        border: 2px solid var(--uitm-danger);
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 12px;
    }

    /* ===== UiTM Alert Messages ===== */
    .alert {
        padding: 16px 20px;
        margin-bottom: 20px;
        border-radius: var(--uitm-border-radius);
        font-size: 14px;
        font-weight: 500;
        position: relative;
        border-left: 4px solid;
        animation: slideInAlert 0.3s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: #065F46;
        border-left-color: var(--uitm-success);
    }

    .alert-success::before {
        content: '✓';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--uitm-success);
        font-weight: bold;
        font-size: 16px;
    }

    .alert-success {
        padding-left: 45px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: #991B1B;
        border-left-color: var(--uitm-danger);
    }

    @keyframes slideInAlert {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* ===== UiTM Statistics Cards ===== */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--uitm-white);
        padding: 25px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        border: 1px solid var(--uitm-border);
        position: relative;
        overflow: hidden;
        transition: var(--uitm-transition);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--uitm-purple);
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--uitm-text-secondary);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== UiTM Card Styling ===== */
    .card {
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        margin-bottom: 30px;
        border: 1px solid var(--uitm-border);
        overflow: hidden;
        position: relative;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    /* ===== Import & Filter Sections ===== */
    .import-section {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        padding: 25px;
        border-bottom: 1px solid var(--uitm-border);
        position: relative;
    }

    .filter-section {
        background: var(--uitm-gray-light);
        padding: 25px;
        border-bottom: 1px solid var(--uitm-border);
        position: relative;
    }

    .import-form {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    /* ===== UiTM Form Styling ===== */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
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
        background-color: var(--uitm-white);
        font-size: 14px;
        transition: var(--uitm-transition);
        color: var(--uitm-text-primary);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--uitm-purple);
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
        transform: translateY(-1px);
    }

    select.form-control {
        width: auto;
        min-width: 300px;
    }

    input[type="file"].form-control {
        width: auto;
        padding: 8px 12px;
    }

    /* ===== UiTM Table Styling ===== */
    .table-responsive {
        overflow-x: auto;
        margin-bottom: 30px;
        width: 100%;
        background-color: var(--uitm-white);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        border: 1px solid var(--uitm-border);
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: var(--uitm-gray-light);
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--uitm-purple);
        border-radius: 4px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    table th {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        font-weight: bold;
        text-align: left;
        padding: 15px 16px;
        border: none;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    table th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--uitm-gold);
    }

    table td {
        padding: 15px 16px;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
        background: var(--uitm-white);
        transition: background-color 0.2s ease;
    }

    table tr:hover td {
        background: linear-gradient(135deg, #FEF7F0 0%, #FDF2F8 100%);
    }

    table tr:last-child td {
        border-bottom: none;
    }

    /* ===== UiTM Badge Styling ===== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        font-size: 11px;
        font-weight: 600;
        border-radius: var(--uitm-border-radius-sm);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-success {
        background: rgba(40, 167, 69, 0.1);
        color: var(--uitm-success);
        border: 1px solid rgba(40, 167, 69, 0.2);
    }

    .badge-warning {
        background: rgba(255, 193, 7, 0.1);
        color: #b07b00;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }

    /* ===== Table Actions ===== */
    .table-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    /* ===== Empty State ===== */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
        color: var(--uitm-text-secondary);
    }

    .empty-state::before {
        content: '👥';
        font-size: 4rem;
        display: block;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .main {
            padding: 15px;
        }

        .main-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
            padding: 25px 30px;
        }

        .main-title {
            font-size: 1.5rem;
        }

        .import-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .import-form > * {
            width: 100%;
        }
        
        select.form-control {
            width: 100%;
            min-width: auto;
        }
        
        .table-actions {
            flex-direction: column;
        }
        
        table {
            font-size: 12px;
        }
        
        table th, table td {
            padding: 10px 8px;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .main-title {
            font-size: 1.25rem;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .btn:focus,
    .form-control:focus {
        outline: 2px solid var(--uitm-gold);
        outline-offset: 2px;
    }

    /* ===== Animation Enhancements ===== */
    .stat-card,
    .card {
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

    /* ===== Loading States ===== */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }
</style>
@endsection

@section('content')
    <div class="main">
        <!-- UiTM Header -->
        <div class="main-header">
            <h1 class="main-title">📋 Pengurusan Pengawas</h1>
            <div class="action-buttons">
                <a href="{{ route('admin.addInvigilatorForm') }}" class="btn btn-success">
                    ➕ Tambah Pengawas
                </a>
            </div>
        </div>
            
        <!-- Alert Messages -->
        @if (session('success'))
            <div id="successMessage" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div id="errorMessage" class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- UiTM Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $invigilators->count() }}</div>
                <div class="stat-label">Jumlah Pengawas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $invigilators->where('chat_id', '!=', null)->count() }}</div>
                <div class="stat-label">Telegram Disambung</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">8</div>
                <div class="stat-label">Fakulti Terlibat</div>
            </div>
        </div>
            
        <div class="card">
            <!-- UiTM Import Form -->
            <div class="import-section">
                <form action="{{ route('admin.invigilators.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
                    @csrf
                    <label for="excel_file" class="form-label mb-0">📥 Import Pengawas:</label>
                    <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" required class="form-control">
                    <button type="submit" class="btn btn-primary">
                        📤 Import Excel
                    </button>
                </form>
            </div>
              
            <!-- UiTM Filter Form -->
            <div class="filter-section">
                <form method="GET" action="{{ route('admin.adminManageInvigilator') }}">
                    <div class="import-form">
                        <label for="faculty" class="form-label mb-0">🔍 Tapis mengikut Fakulti:</label>
                        <select name="faculty" id="faculty" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Fakulti --</option>
                            <option value="FAKULTI SAINS GUNAAN" {{ request('faculty') == 'FAKULTI SAINS GUNAAN' ? 'selected' : '' }}>FAKULTI SAINS GUNAAN</option>
                            <option value="FAKULTI SAINS KOMPUTER & MATEMATIK" {{ request('faculty') == 'FAKULTI SAINS KOMPUTER & MATEMATIK' ? 'selected' : '' }}>FAKULTI SAINS KOMPUTER & MATEMATIK</option>
                            <option value="FAKULTI PENGURUSAN & PERNIAGAAN" {{ request('faculty') == 'FAKULTI PENGURUSAN & PERNIAGAAN' ? 'selected' : '' }}>FAKULTI PENGURUSAN & PERNIAGAAN</option>
                            <option value="FAKULTI PERAKAUNAN" {{ request('faculty') == 'FAKULTI PERAKAUNAN' ? 'selected' : '' }}>FAKULTI PERAKAUNAN</option>
                            <option value="FAKULTI SAINS SUKAN & REKREASI" {{ request('faculty') == 'FAKULTI SAINS SUKAN & REKREASI' ? 'selected' : '' }}>FAKULTI SAINS SUKAN & REKREASI</option>
                            <option value="FAKULTI PERTANIAN & AGROTEKNOLOGI" {{ request('faculty') == 'FAKULTI PERTANIAN & AGROTEKNOLOGI' ? 'selected' : '' }}>FAKULTI PERTANIAN & AGROTEKNOLOGI</option>
                            <option value="KOLEJ ALAM BINA" {{ request('faculty') == 'KOLEJ ALAM BINA' ? 'selected' : '' }}>KOLEJ ALAM BINA</option>
                            <option value="BAHAGIAN HAL EHWAL AKADEMIK" {{ request('faculty') == 'BAHAGIAN HAL EHWAL AKADEMIK' ? 'selected' : '' }}>BAHAGIAN HAL EHWAL AKADEMIK</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
            
        <!-- UiTM Invigilator Table -->
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Pengguna</th>
                        <th>Kata Laluan</th>
                        <th>Nama</th>
                        <th>Jawatan</th>
                        <th>Fakulti</th>
                        <th>No. Telefon</th>
                        <th>Telegram</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invigilators as $invigilator)
                    <tr>
                        <td style="font-weight: 600; color: var(--uitm-purple);">{{ $invigilator->userID }}</td>
                        <td style="font-family: monospace; color: var(--uitm-text-secondary);">{{ $invigilator->userPassword }}</td>
                        <td style="font-weight: 500;">{{ $invigilator->userName }}</td>
                        <td>{{ $invigilator->position }}</td>
                        <td>{{ ucwords(strtolower($invigilator->faculty)) }}</td>
                        <td style="font-family: monospace;">{{ $invigilator->contact }}</td>
                        <td>
                            @if($invigilator->chat_id)
                                <span class="badge badge-success">
                                    ✓ Disambung
                                </span>
                            @else
                                <span class="badge badge-warning">
                                    ⚠ Belum Disambung
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.editInvigilatorForm', $invigilator->id) }}" class="btn btn-primary btn-sm">
                                    ✏️ Kemaskini
                                </a>
                                <form action="{{ route('admin.deleteInvigilator', $invigilator->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk memadamkan pengawas ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Padam</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <h4 style="color: var(--uitm-purple); margin: 15px 0 8px;">Tiada Rekod Pengawas</h4>
                            <p>Tiada rekod pengawas dijumpai untuk kriteria yang dipilih.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- UiTM Pagination -->
        @if(method_exists($invigilators, 'links'))
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $invigilators->links() }}
        </div>
        @endif
    </div>
@endsection

@section('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success/error messages after 5 seconds
        setTimeout(() => {
            const success = document.getElementById('successMessage');
            const error = document.getElementById('errorMessage');
            if (success) {
                success.style.transition = 'opacity 0.5s, transform 0.5s';
                success.style.opacity = '0';
                success.style.transform = 'translateY(-20px)';
                setTimeout(() => success.style.display = 'none', 500);
            }
            if (error) {
                error.style.transition = 'opacity 0.5s, transform 0.5s';
                error.style.opacity = '0';
                error.style.transform = 'translateY(-20px)';
                setTimeout(() => error.style.display = 'none', 500);
            }
        }, 5000);
        
        // Enhanced hover effects for stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 16px rgba(0,0,0,0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
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
                    submitBtn.innerHTML = '⏳ Memproses...';
                }
            });
        });

        // Enhanced table row interactions
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            if (!row.querySelector('.empty-state')) {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                    this.style.transition = 'transform 0.2s ease';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
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
        
        // Function to adjust the main content based on sidebar state
        function adjustMainContent() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main');
            
            if (!sidebar || !mainContent) return;
            
            // Check if sidebar is collapsed or hidden
            const isSidebarCollapsed = sidebar.classList.contains('collapsed');
            const isMobile = window.innerWidth <= 768;
            
            if (isMobile) {
                // Mobile view - full width regardless of sidebar state
                mainContent.style.marginLeft = '0';
                mainContent.style.width = '100%';
            } else {
                // Desktop view - adjust based on sidebar state
                if (isSidebarCollapsed) {
                    mainContent.style.marginLeft = '60px';
                    mainContent.style.width = 'calc(100% - 60px)';
                } else {
                    const sidebarWidth = window.innerWidth <= 1024 ? '200px' : '250px';
                    mainContent.style.marginLeft = sidebarWidth;
                    mainContent.style.width = `calc(100% - ${sidebarWidth})`;
                }
            }
        }
        
        // Initial adjustment
        adjustMainContent();
        
        // Listen for sidebar toggle events
        const toggleBtn = document.getElementById('toggleSidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                // Slight delay to ensure sidebar state has changed
                setTimeout(adjustMainContent, 50);
            });
        }
        
        // Watch for window resize
        window.addEventListener('resize', adjustMainContent);
        
        // Watch for sidebar class changes
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        adjustMainContent();
                    }
                });
            });
            
            observer.observe(sidebar, { attributes: true });
        }

        // Animate numbers in stat cards
        animateNumbers();

        // Form validation enhancement
        const fileInput = document.getElementById('excel_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : '';
                if (fileName) {
                    console.log('File selected:', fileName);
                    // You could add visual feedback here
                }
            });
        }

        // Enhanced faculty filter
        const facultySelect = document.getElementById('faculty');
        if (facultySelect) {
            facultySelect.addEventListener('change', function() {
                // Add loading state to the select
                this.style.opacity = '0.6';
                this.disabled = true;
                // Form will submit automatically, so no need to re-enable
            });
        }
    });

    // Animate numbers function
    function animateNumbers() {
        const numbers = document.querySelectorAll('.stat-number');
        
        numbers.forEach(numberElement => {
            const finalNumber = parseInt(numberElement.textContent.replace(/,/g, ''));
            if (isNaN(finalNumber)) return;
            
            const duration = 1500; // 1.5 seconds
            const increment = finalNumber / (duration / 16); // 60fps
            let current = 0;
            
            numberElement.textContent = '0';
            
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

    // Enhanced delete confirmation
    function confirmDelete(invigilatorName) {
        return confirm(`Adakah anda pasti untuk memadamkan pengawas "${invigilatorName}"? Tindakan ini tidak boleh dibatalkan.`);
    }

    // Smooth scroll to alerts
    function scrollToAlert() {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Call scroll to alert if there are messages
    if (document.querySelector('.alert')) {
        setTimeout(scrollToAlert, 100);
    }
</script>
@endsection