@extends('layouts.invigilatorLayout')

@section('title', 'Invigilator Dashboard')

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
        --uitm-info: #17a2b8;
        --uitm-warning: #ffc107;
        --uitm-danger: #dc3545;
        
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

    /* Main Layout Container - FIXED */
    .dashboard-container {
        padding: 20px;
        background-color: var(--uitm-gray);
        min-height: calc(100vh - 70px);
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* UiTM Welcome Banner */
    .welcome-banner {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: var(--uitm-white);
        padding: 25px 30px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-medium);
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 215, 0, 0.3);
        flex-shrink: 0;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--uitm-gold) 0%, transparent 100%);
    }

    .welcome-banner h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--uitm-white);
        position: relative;
        z-index: 2;
    }

    .welcome-banner p {
        margin: 8px 0 0 0;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 2;
    }

    /* Main Grid Layout - FIXED */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 280px 1fr 300px;
        gap: 20px;
        flex: 1;
        min-height: 0;
        height: calc(100vh - 200px);
    }

    /* Stats Column */
    .stats-column {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .stats-grid {
        display: grid;
        grid-template-rows: 1fr 1fr;
        gap: 15px;
        height: 200px;
    }

    .stat-card {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        padding: 15px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--uitm-purple);
    }

    .stat-card:nth-child(1)::before {
        background: linear-gradient(135deg, var(--uitm-success) 0%, #1e7e34 100%);
    }

    .stat-card:nth-child(2)::before {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
    }

    .stat-card .icon {
        font-size: 18px;
        color: var(--uitm-white);
        height: 50px;
        width: 50px;
        border-radius: var(--uitm-border-radius);
        display: grid;
        place-items: center;
        box-shadow: var(--uitm-shadow-light);
        transition: var(--uitm-transition);
        flex-shrink: 0;
    }

    .stat-card:nth-child(1) .icon {
        background: linear-gradient(135deg, var(--uitm-success) 0%, #1e7e34 100%);
    }

    .stat-card:nth-child(2) .icon {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
    }

    .stat-card:hover .icon {
        transform: scale(1.1);
    }

    .stat-card .info h3 {
        margin: 0;
        font-size: 11px;
        color: var(--uitm-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .stat-card .info p {
        margin: 5px 0 0 0;
        font-size: 1.3rem;
        font-weight: bold;
        color: var(--uitm-text-primary);
    }

    .stat-card .info p.small-text {
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Profile Card - FIXED HEIGHT */
    .profile-card {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        padding: 20px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        position: relative;
        overflow: hidden;
        height: calc(100% - 215px);
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .profile-card h2 {
        margin: 0 0 15px 0;
        font-size: 1.1rem;
        color: var(--uitm-purple);
        font-weight: bold;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .profile-card h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--uitm-gold);
        border-radius: 1px;
    }

    .profile-content {
        height: calc(100% - 50px);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .profile-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: var(--uitm-gray-light);
        border-radius: var(--uitm-border-radius-sm);
        transition: var(--uitm-transition);
        border: 1px solid var(--uitm-border);
        position: relative;
        overflow: hidden;
    }

    .profile-item::before {
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

    .profile-item:hover {
        background: var(--uitm-white);
        box-shadow: var(--uitm-shadow-light);
        transform: translateY(-2px);
    }

    .profile-item:hover::before {
        transform: scaleY(1);
    }
    
    .profile-item .icon {
        color: var(--uitm-white);
        font-size: 12px;
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        border-radius: var(--uitm-border-radius-sm);
        display: grid;
        place-items: center;
        box-shadow: var(--uitm-shadow-light);
        transition: var(--uitm-transition);
        flex-shrink: 0;
    }

    .profile-item:hover .icon {
        transform: scale(1.1);
    }

    .profile-item .details .label {
        font-size: 10px;
        color: var(--uitm-text-muted);
        text-transform: uppercase;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .profile-item .details .value {
        font-size: 12px;
        font-weight: 600;
        margin: 2px 0 0 0;
        color: var(--uitm-text-primary);
    }

    /* Schedule Column - FIXED */
    .schedule-column {
        display: flex;
        flex-direction: column;
        gap: 15px;
        min-height: 0;
    }

    .schedule-section {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        padding: 20px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        flex: 1;
        min-height: 0;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .schedule-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .schedule-section h2 {
        margin: 0 0 15px 0;
        font-size: 1.2rem;
        color: var(--uitm-purple);
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .schedule-section h2 i {
        color: var(--uitm-gold);
    }

    .schedule-list {
        flex: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        scrollbar-width: thin;
        scrollbar-color: var(--uitm-purple) transparent;
        min-height: 0;
    }

    .schedule-list::-webkit-scrollbar {
        width: 6px;
    }

    .schedule-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .schedule-list::-webkit-scrollbar-thumb {
        background: var(--uitm-purple);
        border-radius: 3px;
    }

    .schedule-item {
        background: var(--uitm-gray-light);
        border-radius: var(--uitm-border-radius);
        padding: 12px;
        border: 1px solid var(--uitm-border);
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 12px;
        align-items: center;
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .schedule-item::before {
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

    .schedule-item:hover {
        background: var(--uitm-white);
        box-shadow: var(--uitm-shadow-light);
        transform: translateY(-2px);
    }

    .schedule-item:hover::before {
        transform: scaleY(1);
    }

    .schedule-date {
        text-align: center;
        min-width: 60px;
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%);
        color: var(--uitm-white);
        border-radius: var(--uitm-border-radius-sm);
        padding: 6px;
    }

    .schedule-date .day { 
        font-size: 0.9rem; 
        font-weight: bold; 
        margin: 0;
    }
    
    .schedule-date .full-date { 
        font-size: 9px; 
        margin: 2px 0 0 0;
        text-transform: uppercase;
        font-weight: 500;
        opacity: 0.9;
    }

    .schedule-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .schedule-info-item { 
        display: flex; 
        align-items: center; 
        gap: 6px; 
        color: var(--uitm-text-secondary);
        font-size: 11px;
        font-weight: 500;
    }
    
    .schedule-info-item i { 
        color: var(--uitm-purple);
        width: 10px;
        font-size: 10px;
    }

    .schedule-time {
        text-align: right;
    }

    .time-badge {
        background: linear-gradient(135deg, var(--uitm-gold) 0%, var(--uitm-gold-dark) 100%);
        color: var(--uitm-purple);
        padding: 6px 8px;
        border-radius: var(--uitm-border-radius-sm);
        font-size: 9px;
        font-weight: bold;
        white-space: nowrap;
        box-shadow: var(--uitm-shadow-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .no-schedule {
        text-align: center;
        padding: 30px 15px;
        background: var(--uitm-gray-light);
        border-radius: var(--uitm-border-radius);
        border: 2px dashed var(--uitm-border);
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .no-schedule i {
        font-size: 2.5rem;
        color: var(--uitm-text-muted);
        margin-bottom: 10px;
    }

    .no-schedule p {
        margin: 0;
        font-size: 12px;
        color: var(--uitm-text-secondary);
        font-weight: 500;
    }

    .print-pdf-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
        padding: 8px 15px;
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        text-decoration: none;
        border-radius: var(--uitm-border-radius-sm);
        transition: var(--uitm-transition);
        box-shadow: var(--uitm-shadow-light);
        font-weight: 600;
        font-size: 12px;
        border: 2px solid var(--uitm-gold);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .print-pdf-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .print-pdf-link:hover::before {
        left: 100%;
    }

    .print-pdf-link:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    /* Calendar Container - FIXED */
    .calendar-container {
        background: var(--uitm-white);
        border: 1px solid var(--uitm-border);
        padding: 20px;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-light);
        min-height: 0;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .calendar-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .calendar-container h2 {
        margin: 0 0 15px 0;
        font-size: 1.2rem;
        color: var(--uitm-purple);
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .calendar-container h2 i {
        color: var(--uitm-gold);
    }

    #calendar {
        flex: 1;
        min-height: 0;
    }

    /* UiTM FullCalendar Styling */
    .fc {
        height: 100% !important;
    }

    .fc-theme-standard .fc-scrollgrid {
        border: 1px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius-sm);
        overflow: hidden;
    }

    .fc-theme-standard td, .fc-theme-standard th {
        border-color: var(--uitm-border);
    }

    .fc-col-header-cell {
        background: linear-gradient(135deg, var(--uitm-purple) 0%, var(--uitm-purple-dark) 100%) !important;
        color: var(--uitm-white) !important;
        font-weight: bold;
        font-size: 10px;
    }

    .fc-daygrid-day {
        background: var(--uitm-white) !important;
    }

    .fc-daygrid-day:hover {
        background: var(--uitm-gray-light) !important;
    }

    .fc-daygrid-day-number {
        color: var(--uitm-text-primary) !important;
        font-size: 10px;
        padding: 4px;
        font-weight: 500;
    }

    .fc-event {
        background: var(--uitm-purple) !important;
        border: none !important;
        border-radius: var(--uitm-border-radius-sm) !important;
        font-size: 8px !important;
        padding: 1px 4px !important;
        font-weight: 600;
        color: var(--uitm-white) !important;
    }

    .fc-toolbar {
        margin-bottom: 10px !important;
    }

    .fc-toolbar-title {
        color: var(--uitm-purple) !important;
        font-size: 0.9rem !important;
        font-weight: bold;
    }

    .fc-button-primary {
        background: var(--uitm-gold) !important;
        border: 1px solid var(--uitm-gold) !important;
        color: var(--uitm-purple) !important;
        font-size: 10px !important;
        padding: 4px 8px !important;
        border-radius: var(--uitm-border-radius-sm) !important;
        font-weight: 600;
    }

    .fc-button-primary:hover {
        background: var(--uitm-gold-dark) !important;
        border-color: var(--uitm-gold-dark) !important;
        color: var(--uitm-purple) !important;
    }

    .fc-button-primary:disabled {
        background: var(--uitm-gray) !important;
        opacity: 0.6;
    }

    /* UiTM Responsive Design */
    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto 1fr;
            height: auto;
            min-height: calc(100vh - 200px);
        }
        
        .stats-column {
            grid-column: 1 / -1;
            flex-direction: row;
            gap: 20px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
            height: 120px;
        }
        
        .profile-card {
            height: auto;
            max-height: 300px;
        }
        
        .schedule-section,
        .calendar-container {
            height: auto;
            min-height: 400px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }
        
        .dashboard-grid {
            grid-template-columns: 1fr;
            grid-template-rows: auto auto auto auto;
            gap: 15px;
        }
        
        .stats-column {
            flex-direction: column;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 1fr;
            height: 200px;
        }
        
        .schedule-item {
            grid-template-columns: 1fr;
            gap: 8px;
            text-align: center;
        }
        
        .welcome-banner h1 {
            font-size: 1.3rem;
        }
        
        .welcome-banner {
            padding: 20px 25px;
        }
        
        .profile-content {
            max-height: none;
            overflow-y: visible;
        }
        
        .schedule-section,
        .calendar-container {
            min-height: 300px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 10px;
        }
        
        .welcome-banner {
            padding: 15px 20px;
        }
        
        .welcome-banner h1 {
            font-size: 1.1rem;
        }
        
        .schedule-section,
        .calendar-container,
        .profile-card {
            padding: 15px;
        }
    }

    /* UiTM Animation Enhancements */
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

    .stat-card,
    .schedule-section,
    .profile-card,
    .calendar-container {
        animation: slideInUp 0.5s ease-out;
    }

    .schedule-item {
        opacity: 0;
        animation: slideInUp 0.5s ease-out forwards;
    }

    /* UiTM Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<div class="dashboard-container">
    <!-- UiTM Welcome Banner -->
    <div class="welcome-banner">
        <h1>Selamat Datang, {{ $invigilator->userName }}</h1>
        <p>Papan Pemuka Pengawas - {{ date('l, j F Y') }}</p>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Profile & Stats Column -->
        <div class="stats-column">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-list-alt"></i></div>
                    <div class="info">
                        <h3>Jumlah Tugasan</h3>
                        <p>{{ $assignmentCount }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="info">
                        <h3>Pengawasan Seterusnya</h3>
                        @if($nextSession)
                            <p class="small-text">{{ $nextSession }}</p>
                        @else
                            <p class="small-text">Tiada tugasan akan datang</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- UiTM Profile Card -->
            <div class="profile-card">
                <h2>📋 Maklumat Peribadi</h2>
                <div class="profile-content">
                    <div class="profile-item">
                        <div class="icon"><i class="fas fa-id-card"></i></div>
                        <div class="details">
                            <p class="label">ID Pengguna</p>
                            <p class="value">{{ $invigilator->userID }}</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="icon"><i class="fas fa-briefcase"></i></div>
                        <div class="details">
                            <p class="label">Jawatan</p>
                            <p class="value">{{ $invigilator->position }}</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="icon"><i class="fas fa-building"></i></div>
                        <div class="details">
                            <p class="label">Fakulti</p>
                            <p class="value">{{ $invigilator->faculty }}</p>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div class="icon"><i class="fas fa-phone"></i></div>
                        <div class="details">
                            <p class="label">No. Telefon</p>
                            <p class="value">{{ $invigilator->contact}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
        
        <!-- Calendar Column -->
        <div class="stats-column">
            <!-- UiTM Calendar Section -->
            <div class="calendar-container">
                <h2><i class="fas fa-calendar"></i> Kalendar Saya</h2>
                <div id='calendar' data-events="{{ $calendarEvents->toJson() }}"></div>
            </div>
        </div>
        
        <!-- Schedule Column -->
        <div class="schedule-column">
            <!-- UiTM Schedule Section -->
            <div class="schedule-section">
                <h2><i class="fas fa-calendar-alt"></i> Jadual Peperiksaan</h2>
                @if($schedules->isEmpty())
                    <div class="no-schedule">
                        <i class="fas fa-calendar-times"></i>
                        <p>Tiada Peperiksaan Dijadualkan</p>
                    </div>
                @else
                    <div class="schedule-list">
                        @foreach($schedules as $s)
                        <div class="schedule-item">
                            <div class="schedule-date">
                                <p class="day">{{ \Carbon\Carbon::parse($s->examDate)->format('M d') }}</p>
                                <p class="full-date">{{ \Carbon\Carbon::parse($s->examDate)->format('l, Y') }}</p>
                            </div>
                            <div class="schedule-info">
                                <div class="schedule-info-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>{{ $s->courseCode }}</span>
                                </div>
                                <div class="schedule-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $s->venue }}</span>
                                </div>
                            </div>
                            <div class="schedule-time">
                                <span class="time-badge">
                                    <i class="fas fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($s->startTime)->format('g:i A') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                <a href="{{ route('invigilator.schedule.print-pdf') }}" class="print-pdf-link" target="_blank">
                    <i class="fas fa-print"></i> Cetak Jadual Pengawasan
                </a>
            </div>
        </div>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = JSON.parse(calendarEl.getAttribute('data-events'));

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            events: events,
            height: '100%',
            eventColor: '#4B0082',
            eventBackgroundColor: '#4B0082',
            eventBorderColor: '#3A006F',
            dayMaxEvents: 2,
            moreLinkClick: 'popover',
            eventDisplay: 'block',
            displayEventTime: false
        });
        calendar.render();

        // Add UiTM smooth entrance animation for schedule items
        const scheduleItems = document.querySelectorAll('.schedule-item');
        scheduleItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });

        // Enhanced UiTM hover effects for stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 8px 16px rgba(0,0,0,0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
            });
        });

        // Enhanced UiTM hover effects for profile items
        const profileItems = document.querySelectorAll('.profile-item');
        profileItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Enhanced UiTM button effects
        const printButton = document.querySelector('.print-pdf-link');
        if (printButton) {
            printButton.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px)';
                }, 100);
            });
        }
    });
</script>

@endsection

@section('footer')
<footer style="background: linear-gradient(135deg, #4B0082, #3A006F); 
               color: #FFD700; text-align: center; padding: 20px; margin-top: 20px; 
               border-radius: 8px 8px 0 0; box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
               border-top: 3px solid #FFD700;">
    <p style="margin: 0; font-weight: 600; color: #ffffff;">
        &copy; {{ date('Y') }} Universiti Teknologi MARA. Hak Cipta Terpelihara.
    </p>
    <p style="margin: 5px 0 0 0; font-size: 12px; color: rgba(255, 255, 255, 0.8);">
        Sistem e-Invigilator UiTM
    </p>
</footer>
@endsection