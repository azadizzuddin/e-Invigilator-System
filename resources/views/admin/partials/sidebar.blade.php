<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.adminManageInvigilator') }}" class="{{ request()->routeIs('admin.adminManageInvigilator', 'admin.addInvigilatorForm', 'admin.editInvigilatorForm') ? 'active' : '' }}">
                <span>👥</span>
                <span class="menu-text">Urus Pengawas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.adminManageSchedule') }}" class="{{ request()->routeIs('admin.adminManageSchedule*') ? 'active' : '' }}">
                <span>📅</span>
                <span class="menu-text">Urus Jadual</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.notifications') }}" class="{{ request()->routeIs('admin.notifications*') ? 'active' : '' }}">
                <span>🔔</span>
                <span class="menu-text">Urus Notifikasi</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.documents') }}" class="{{ request()->routeIs('admin.documents*') ? 'active' : '' }}">
                <span>📤</span>
                <span class="menu-text">Muat Naik Dokumen</span>
            </a>
        </li>
    </ul>
</div>