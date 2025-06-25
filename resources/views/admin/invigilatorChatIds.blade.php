@extends('layouts.adminLayout')

@section('title', 'Telegram Chat IDs - Sistem e-Invigilator UiTM')

@section('content')
<style>
    :root {
        --uitm-purple: #4B0082;
        --uitm-purple-dark: #3A006F;
        --uitm-gold: #FFD700;
        --uitm-gold-dark: #FFC500;
        --uitm-white: #ffffff;
        --uitm-gray: #f5f5f5;
        --uitm-border: #ddd;
        --uitm-text-primary: #333;
        --uitm-text-secondary: #666;
        --uitm-shadow-light: 0 2px 4px rgba(0,0,0,0.1);
        --uitm-shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
        --uitm-border-radius: 8px;
        --uitm-transition: all 0.3s ease;
    }

    .chat-ids-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        padding: 30px 40px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-medium);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
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
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        color: var(--uitm-gold);
        font-size: 2rem;
    }

    .filter-card {
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        padding: 25px;
        margin-bottom: 25px;
        border: 1px solid var(--uitm-border);
    }

    .filter-form {
        display: flex;
        gap: 1.5rem;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-group label {
        display: block;
        font-weight: 600;
        color: var(--uitm-purple);
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        padding: 10px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 14px;
        transition: var(--uitm-transition);
        background-color: var(--uitm-white);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--uitm-purple);
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
    }

    .btn-show {
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-gold);
        padding: 12px 24px;
        border-radius: var(--uitm-border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--uitm-transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .btn-show:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-uitm-primary {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        border: 2px solid var(--uitm-purple);
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--uitm-transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-uitm-primary:hover {
        background: var(--uitm-purple-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-uitm-secondary {
        background: var(--uitm-white);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-purple);
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--uitm-transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-uitm-secondary:hover {
        background: var(--uitm-purple);
        color: var(--uitm-white);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .table-card {
        background: var(--uitm-white);
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        overflow: hidden;
        border: 1px solid var(--uitm-border);
        position: relative;
    }

    .table-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .table {
        margin: 0;
        font-size: 14px;
        width: 100%;
        border-collapse: collapse;
    }

    .table thead th {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border: none;
        text-align: left;
    }

    .table tbody td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
        transition: var(--uitm-transition);
    }

    .table tbody tr:nth-child(odd) td {
        background-color: #f8f4ff;
    }

    .table tbody tr:hover td {
        background-color: #f0f8ff;
        transform: scale(1.005);
    }

    .chat-id {
        font-family: monospace;
        background: var(--uitm-gray);
        padding: 6px 10px;
        border-radius: 4px;
        font-weight: 600;
        color: var(--uitm-purple);
    }

    .no-chat-id {
        color: var(--uitm-text-secondary);
        font-style: italic;
    }

    .user-info strong {
        color: var(--uitm-purple);
        font-size: 15px;
    }

    .user-info small {
        color: var(--uitm-text-secondary);
        font-size: 13px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e5e7eb;
        margin-bottom: 20px;
        display: block;
    }

    .empty-state span {
        font-size: 1.2rem;
        color: var(--uitm-text-secondary);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .chat-ids-container {
            padding: 20px;
        }
        .page-header {
            padding: 25px 20px;
        }
        .page-title {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 10px;
        }
        .filter-form {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
    }
</style>

<div class="chat-ids-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fab fa-telegram-plane"></i>
            Telegram Chat ID Pengawas
        </h1>
    </div>

    <!-- Filter Form -->
    <div class="filter-card">
        <form method="GET" action="" class="filter-form">
            <div class="filter-group" style="flex: 1; min-width: 200px;">
                <label for="search">Cari Nama / ID Pengawas</label>
                <input type="text" name="search" id="search" value="{{ request('search', $search ?? '') }}" 
                       class="form-control" placeholder="Contoh: Azad / 111111" style="width: 100%;">
            </div>
            <div class="filter-group" style="min-width: 180px;">
                <label for="chat_id_status">Status Chat ID</label>
                <select name="chat_id_status" id="chat_id_status" class="form-control" style="width: 100%;">
                    <option value="">Semua</option>
                    <option value="has" {{ (request('chat_id_status', $chatIdStatus ?? '') == 'has') ? 'selected' : '' }}>Ada Chat ID</option>
                    <option value="none" {{ (request('chat_id_status', $chatIdStatus ?? '') == 'none') ? 'selected' : '' }}>Tiada Chat ID</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-uitm-primary">
                    <i class="fas fa-filter"></i> Tapis
                </button>
                <a href="{{ route('admin.invigilatorChatIds') }}" class="btn-uitm-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <button class="btn-show" onclick="showChatIds(this)">
        <i class="fas fa-eye"></i>
        Tunjukkan Chat IDs
    </button>

    <div class="table-card" id="chatIdsTable" style="display:none;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60%;">Nama Pengawas</th>
                    <th style="width: 40%;">Telegram Chat ID</th>
                </tr>
            </thead>
            <tbody>
                @if($invigilators->count() > 0)
                    @foreach($invigilators as $invigilator)
                        <tr>
                            <td class="user-info">
                                <strong>{{ $invigilator->userName }}</strong><br>
                                <small>{{ $invigilator->userID }}</small>
                            </td>
                            <td>
                                @if($invigilator->chat_id)
                                    <span class="chat-id">{{ $invigilator->chat_id }}</span>
                                @else
                                    <span class="no-chat-id">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="empty-state">
                            <i class="fas fa-search"></i>
                            <span>Maaf, tiada rekod untuk carian</span>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
function showChatIds(button) {
    document.getElementById('chatIdsTable').style.display = 'block';
    button.style.display = 'none';
    
    // Add animation to table rows
    const rows = document.querySelectorAll('#chatIdsTable tbody tr');
    if (rows.length > 0) {
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }
}
</script>
@endsection