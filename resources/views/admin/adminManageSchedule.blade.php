@extends('layouts.adminLayout')

@section('title', 'Manage Schedule')

@section('page_styles')
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

    /* ===== Header Section (matching landing page hero) ===== */
    .page-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
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

    .header-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: white;
    }

    .header-content p {
        font-size: 1.1rem;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* ===== Card Styling (matching landing page) ===== */
    .main-card {
        background-color: var(--card-white);
        border-radius: 8px;
        box-shadow: var(--shadow-light);
        padding: 30px;
        margin-bottom: 20px;
        border: 1px solid var(--border-light);
    }

    .section-card {
        background-color: #f8f8f8;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 25px;
        border: 1px solid var(--border-light);
    }

    .section-title {
        font-size: 1.4rem;
        color: var(--primary-purple);
        margin-bottom: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== Button Styling (matching landing page) ===== */
    .btn {
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-block;
        border: none;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
    }

    .btn-primary {
        background-color: var(--accent-gold);
        color: var(--primary-purple);
        border: 2px solid var(--accent-gold);
    }

    .btn-primary:hover {
        background-color: var(--accent-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    .btn-secondary {
        background-color: transparent;
        color: var(--primary-purple);
        border: 2px solid var(--primary-purple);
    }

    .btn-secondary:hover {
        background-color: var(--primary-purple);
        color: white;
        transform: translateY(-2px);
    }

    .btn-success {
        background-color: var(--success-green);
        color: white;
        border: 2px solid var(--success-green);
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: var(--danger-red);
        color: white;
        border: 2px solid var(--danger-red);
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ===== Form Styling ===== */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--primary-purple);
        font-weight: 600;
        font-size: 14px;
    }

    .form-control, .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border-light);
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: white;
        color: var(--text-dark);
    }

    .form-control:focus, .form-input:focus {
        border-color: var(--primary-purple);
        outline: none;
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
    }

    /* ===== Import Section Styling ===== */
    .import-section {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 2px dashed var(--primary-purple);
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .import-section::before {
        content: '📁';
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 24px;
        opacity: 0.5;
    }

    .import-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    /* ===== Table Styling - IMPROVED & COMPACT ===== */
    .table-container {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-light);
    }

    .table-responsive {
        overflow-x: auto;
        max-height: 70vh;
        overflow-y: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px; /* Reduced from 14px */
        min-width: 1400px; /* Ensure horizontal scroll on smaller screens */
    }

    thead {
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--primary-purple-dark) 100%);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    th {
        padding: 8px 6px; /* Reduced from 15px 12px */
        text-align: left;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        font-size: 10px; /* Reduced from 12px */
        letter-spacing: 0.3px;
        border: none;
        white-space: nowrap;
        line-height: 1.2;
    }

    /* Column Width Optimization */
    th:nth-child(1) { width: 80px; } /* ID Staf */
    th:nth-child(2) { width: 120px; } /* Nama */
    th:nth-child(3) { width: 80px; } /* Jawatan */
    th:nth-child(4) { width: 100px; } /* Fakulti */
    th:nth-child(5) { width: 60px; } /* Tugas */
    th:nth-child(6) { width: 80px; } /* Tarikh */
    th:nth-child(7) { width: 60px; } /* Hari */
    th:nth-child(8) { width: 65px; } /* Masa Mula */
    th:nth-child(9) { width: 65px; } /* Masa Tamat */
    th:nth-child(10) { width: 70px; } /* Program */
    th:nth-child(11) { width: 70px; } /* Kursus */
    th:nth-child(12) { width: 60px; } /* Kumpulan */
    th:nth-child(13) { width: 50px; } /* Pelajar */
    th:nth-child(14) { width: 100px; } /* Tempat */
    th:nth-child(15) { width: 120px; } /* Tindakan */

    td {
        padding: 6px 6px; /* Reduced from 12px */
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
        background: white;
        transition: background-color 0.2s ease;
        font-size: 11px; /* Consistent small font */
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Column-specific styling */
    td:nth-child(1) { /* ID Staf */
        font-weight: 600;
        color: var(--primary-purple);
        font-family: monospace;
    }

    td:nth-child(2) { /* Nama */
        font-weight: 500;
        max-width: 120px;
    }

    td:nth-child(3) { /* Jawatan */
        font-size: 10px;
        max-width: 80px;
    }

    td:nth-child(4) { /* Fakulti */
        font-size: 9px;
        max-width: 100px;
    }

    td:nth-child(6) { /* Tarikh */
        font-weight: 500;
        font-family: monospace;
    }

    td:nth-child(7) { /* Hari */
        font-size: 10px;
    }

    td:nth-child(8), td:nth-child(9) { /* Masa */
        font-family: monospace;
        font-size: 10px;
        text-align: center;
    }

    td:nth-child(10), td:nth-child(11) { /* Program & Kursus */
        font-family: monospace;
        font-size: 10px;
        font-weight: 500;
    }

    td:nth-child(12) { /* Kumpulan */
        text-align: center;
        font-weight: 500;
    }

    td:nth-child(13) { /* Pelajar */
        text-align: center;
        font-weight: 600;
        color: var(--primary-purple);
    }

    td:nth-child(14) { /* Tempat */
        font-size: 10px;
        max-width: 100px;
    }

    tbody tr:hover td {
        background-color: #f8f4ff;
        transform: scale(1.005);
        box-shadow: 0 2px 8px rgba(75, 0, 130, 0.1);
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .actions-cell {
        display: flex;
        gap: 4px;
        justify-content: center;
        flex-wrap: wrap;
        padding: 4px !important;
    }

    /* ===== Alert Styling ===== */
    .alert {
        padding: 15px 20px;
        margin: 20px 0;
        border-radius: 4px;
        font-size: 14px;
        position: relative;
        border: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid var(--success-green);
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

    /* ===== Pagination Styling ===== */
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        background: white;
    }

    .pagination li a, .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 15px;
        text-decoration: none;
        color: var(--primary-purple);
        border-right: 1px solid var(--border-light);
        font-weight: 500;
        transition: all 0.3s ease;
        min-width: 40px;
    }

    .pagination li:last-child a,
    .pagination li:last-child span {
        border-right: none;
    }

    .pagination li.active span {
        background-color: var(--primary-purple);
        color: white;
    }

    .pagination li a:hover {
        background-color: var(--accent-gold);
        color: var(--primary-purple);
    }

    /* ===== Status Badge ===== */
    .status-badge {
        background-color: var(--accent-gold);
        color: var(--primary-purple);
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
        display: inline-block;
    }

    /* ===== Empty State ===== */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: var(--text-gray);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
        color: var(--primary-purple);
    }

    .empty-state h4 {
        color: var(--primary-purple);
        margin: 15px 0 8px;
        font-size: 18px;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .page-header {
            padding: 30px 20px;
        }

        .header-content h1 {
            font-size: 2rem;
        }

        .header-actions {
            flex-direction: column;
            align-items: center;
        }

        .main-card, .section-card {
            padding: 20px;
            margin-bottom: 15px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            flex-direction: column;
        }

        .actions-cell {
            flex-direction: column;
            gap: 2px;
        }

        th, td {
            padding: 4px 3px;
            font-size: 9px;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 9px;
        }

        .import-content {
            flex-direction: column;
        }

        table {
            min-width: 1200px;
        }
    }

    @media (max-width: 480px) {
        .header-content h1 {
            font-size: 1.5rem;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        table {
            min-width: 1000px;
        }

        th, td {
            padding: 3px 2px;
            font-size: 8px;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .btn:focus,
    .form-control:focus,
    .form-input:focus {
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

    /* ===== Table Scroll Styling ===== */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--primary-purple);
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: var(--primary-purple-dark);
    }

    /* ===== Tooltip for truncated text ===== */
    td[title] {
        cursor: help;
    }

    td[title]:hover {
        position: relative;
        overflow: visible;
    }
</style>
@endsection

@section('content')
    <div class="main">
        <!-- Page Header (matching landing page hero style) -->
        <div class="page-header">
            <div class="header-content">
                <h1>Pengurusan Jadual Pengawasan Peperiksaan</h1>
                <p>Penyeliaan tugasan penyeliaan komprehensif untuk Universiti Teknologi MARA</p>
                <div class="header-actions">
                    <a href="{{ route('admin.addScheduleForm') }}" class="btn btn-success">
                        ➕ Tambah Rekod
                    </a>
                </div>
            </div>
        </div>

        <div class="main-card">
            <!-- Import Section -->
            <div class="section-card">
                <h3 class="section-title">
                    📥 Import Data
                </h3>
                <div class="import-section">
                    <form action="{{route('admin.importSchedule')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="import-content">
                            <label for="excel_file" class="form-label" style="margin-bottom: 0;">Pilih Fail Excel:</label>
                            <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" required class="form-control" style="width: auto; max-width: 300px;">
                            <button type="submit" class="btn btn-primary">
                                📤 Import Excel
                            </button>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="section-card">
                <h3 class="section-title">
                    🔍 Cari & Tapis
                </h3>
                <form method="GET" action="{{ route('admin.adminManageSchedule') }}">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="userID" class="form-label">ID Pengguna:</label>
                            <input type="text" name="userID" id="userID" value="{{ request('userID') }}" class="form-control" placeholder="cth. 111111">
                        </div>

                        <div class="form-group">
                            <label for="userName" class="form-label">Nama:</label>
                            <input type="text" name="userName" id="userName" value="{{ request('userName') }}" class="form-control" placeholder="cth. AZAD IZZUDDIN">
                        </div>

                        <div class="form-group">
                            <label for="examDate" class="form-label">Tarikh Peperiksaan:</label>
                            <input type="date" name="examDate" id="examDate" value="{{ request('examDate') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="faculty" class="form-label">Fakulti:</label>
                            <select name="faculty" id="faculty" class="form-control">
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
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">Tapis</button>
                        <a href="{{ route('admin.adminManageSchedule') }}" class="btn btn-secondary">Set Semula</a>
                    </div>
                </form>
            </div>

            <!-- Schedule Table -->
            <div class="section-card">
                <h3 class="section-title">
                    📋 Rekod Jadual ({{ $schedules->total() ?? $schedules->count() }} rekod)
                </h3>
                <div class="table-container">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Staf</th>
                                    <th>Nama</th>
                                    <th>Jawatan</th>
                                    <th>Fakulti</th>
                                    <th>Tugas</th>
                                    <th>Tarikh</th>
                                    <th>Hari</th>
                                    <th>Mula</th>
                                    <th>Tamat</th>
                                    <th>Program</th>
                                    <th>Kursus</th>
                                    <th>Kumpulan</th>
                                    <th>Pelajar</th>
                                    <th>Tempat</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schedules as $s)
                                <tr>
                                    <td title="{{ $s->userID }}">{{ $s->userID }}</td>
                                    <td title="{{ $s->userName }}">{{ $s->userName }}</td>
                                    <td title="{{ $s->position }}">{{ Str::limit($s->position, 15) }}</td>
                                    <td title="{{ $s->faculty }}">{{ Str::limit($s->faculty, 20) }}</td>
                                    <td>
                                        <span class="status-badge">
                                            {{ $s->role }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($s->examDate)->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit($s->examDay, 8) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($s->startTime)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($s->endTime)->format('H:i') }}</td>
                                    <td title="{{ $s->programCode }}">{{ $s->programCode }}</td>
                                    <td title="{{ $s->courseCode }}">{{ $s->courseCode }}</td>
                                    <td>{{ $s->group }}</td>
                                    <td>{{ $s->totalStudent }}</td>
                                    <td title="{{ $s->venue }}">{{ Str::limit($s->venue, 15) }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('admin.editScheduleForm', $s->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                            ✏️
                                        </a>
                                        <form action="{{ route('admin.deleteSchedule', $s->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk memadamkan jadual ini?');" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h4>Tiada Jadual Dijumpai</h4>
                                        <p>Tiada jadual peperiksaan yang sepadan dengan kriteria carian anda.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    @if ($schedules->hasPages())
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($schedules->onFirstPage())
                                <li class="disabled">
                                    <span>‹ Sebelum</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $schedules->previousPageUrl() }}" rel="prev">‹ Sebelum</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($schedules->getUrlRange(1, $schedules->lastPage()) as $page => $url)
                                @if ($page == $schedules->currentPage())
                                    <li class="active">
                                        <span>{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($schedules->hasMorePages())
                                <li>
                                    <a href="{{ $schedules->nextPageUrl() }}" rel="next">Seterus ›</a>
                                </li>
                            @else
                                <li class="disabled">
                                    <span>Seterus ›</span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced form interactions
        const formInputs = document.querySelectorAll('.form-control, .form-input');
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

        // Table row click enhancement for better UX
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.005)';
                this.style.boxShadow = '0 4px 12px rgba(75, 0, 130, 0.15)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
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
                    submitBtn.innerHTML = '⏳ Processing...';
                    
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
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    if (alert.parentElement) {
                        alert.remove();
                    }
                }, 300);
            }, 5000);
        });

        // Add tooltip functionality for truncated text
        const truncatedCells = document.querySelectorAll('td[title]');
        truncatedCells.forEach(cell => {
            if (cell.scrollWidth > cell.clientWidth) {
                cell.style.cursor = 'help';
            }
        });

        // Smooth table scrolling
        const tableContainer = document.querySelector('.table-responsive');
        if (tableContainer) {
            tableContainer.addEventListener('wheel', function(e) {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    this.scrollLeft += e.deltaY;
                }
            });
        }
    });
</script>
@endsection