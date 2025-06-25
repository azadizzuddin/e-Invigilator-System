<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem e-Invigilator UiTM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, 'Helvetica Neue', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        /* Top Header Bar */
        .header-top {
            background-color: #4B0082;
            color: white;
            padding: 8px 0;
            font-size: 13px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1001;
        }
        
        .header-top-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Main Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 0.8rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 32px;
            z-index: 1000;
            border-bottom: 3px solid #FFD700;
        }
        
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .toggle-btn {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 20px;
            width: 26px;
            transition: all 0.3s ease;
        }
        
        .toggle-btn span {
            height: 2px;
            width: 100%;
            background-color: #4B0082;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .navbar-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: #4B0082;
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        /* Profile Icon */
        .profile-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #4B0082;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s;
        }
        
        .profile-icon:hover {
            background-color: #3A006F;
        }
        
        /* Layout Structure */
        .container {
            display: flex;
            margin-top: 92px;
            min-height: calc(100vh - 92px);
            width: 100%;
            position: relative;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: white;
            padding: 1.5rem 0;
            box-shadow: 2px 0 4px rgba(0,0,0,0.05);
            position: fixed;
            height: calc(100vh - 92px);
            top: 92px;
            left: 0;
            transition: all 0.3s ease;
            z-index: 90;
            overflow-y: auto;
            border-right: 1px solid #e5e5e5;
        }
        
        .sidebar.collapsed {
            width: 60px;
            overflow: hidden;
        }
        
        .sidebar ul {
            list-style-type: none;
        }
        
        .sidebar li {
            margin-bottom: 0.25rem;
            white-space: nowrap;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #555;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 14px;
        }
        
        .sidebar.collapsed a {
            padding: 0.8rem;
            justify-content: center;
        }
        
        .sidebar a:hover {
            background-color: #f8f8f8;
            color: #4B0082;
            border-left-color: #4B0082;
        }
        
        .sidebar a.active {
            background-color: #f0ebff;
            color: #4B0082;
            border-left-color: #4B0082;
            font-weight: 600;
        }
        
        .sidebar .menu-text {
            transition: opacity 0.2s ease;
        }
        
        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        
        /* Sidebar Icons */
        .sidebar a span:first-child {
            font-size: 18px;
            min-width: 24px;
            text-align: center;
        }
        
        /* Profile Dropdown */
        .profile-dropdown {
            position: absolute;
            top: 45px;
            right: 0;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            width: 250px;
            padding: 0.5rem 0;
            display: none;
            z-index: 110;
            border: 1px solid #e5e5e5;
        }
        
        .profile-dropdown.show {
            display: block;
        }
        
        .profile-dropdown ul {
            list-style-type: none;
        }
        
        .profile-dropdown li {
            padding: 0;
        }
        
        .profile-dropdown a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 0.7rem 1.5rem;
            transition: all 0.2s ease;
            font-size: 14px;
        }
        
        .profile-dropdown a:hover {
            background-color: #f8f8f8;
            color: #4B0082;
        }
        
        .profile-dropdown .divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 0.5rem 0;
        }
        
        .profile-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e5e5;
        }
        
        .profile-name {
            font-weight: 600;
            font-size: 16px;
            color: #4B0082;
            margin-bottom: 4px;
        }
        
        .profile-email {
            font-size: 13px;
            color: #666;
        }
        
        /* Main Content Area */
        .main {
            margin-left: 250px;
            padding: 2rem;
            transition: all 0.3s ease;
            width: calc(100% - 250px);
            background-color: #f5f5f5;
            min-height: calc(100vh - 92px);
        }
        
        .sidebar.collapsed ~ .main {
            margin-left: 60px;
            width: calc(100% - 60px);
        }
        
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e5e5;
        }
        
        .main-title {
            font-size: 24px;
            font-weight: 600;
            color: #4B0082;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.8rem;
            align-items: center;
        }
        
        /* Button Styles */
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            border: none;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: #4B0082;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3A006F;
            transform: translateY(-1px);
        }
        
        .btn-success {
            background-color: #198754;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #157347;
            transform: translateY(-1px);
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #bb2d3b;
            transform: translateY(-1px);
        }
        
        .btn-warning {
            background-color: #FFD700;
            color: #4B0082;
        }
        
        .btn-warning:hover {
            background-color: #FFC500;
            transform: translateY(-1px);
        }
        
        /* Card Style */
        .card {
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e5e5e5;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 200px;
            }
            .main {
                margin-left: 200px;
                width: calc(100% - 200px);
            }
            .sidebar.collapsed ~ .main {
                margin-left: 60px;
                width: calc(100% - 60px);
            }
        }
        
        @media (max-width: 768px) {
            .header-top {
                display: none;
            }
            
            .navbar {
                top: 0;
                padding: 0.8rem 1rem;
            }
            
            .container {
                margin-top: 60px;
            }
            
            .sidebar {
                top: 60px;
                height: calc(100vh - 60px);
                width: 250px;
                transform: translateX(-100%);
                box-shadow: none;
            }
            
            .sidebar.show {
                transform: translateX(0);
                box-shadow: 2px 0 8px rgba(0,0,0,0.15);
            }
            
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
                min-height: calc(100vh - 60px);
            }
            
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
        
        /* Utility Classes */
        .text-muted {
            color: #666;
        }
        
        .text-primary {
            color: #4B0082;
        }
        
        .bg-light {
            background-color: #f8f8f8;
        }
        
        .border-primary {
            border-color: #4B0082;
        }
    </style>
    
    @yield('page_styles')
</head>
<body>
    <!-- Top Header Bar -->
    <div class="header-top">
        <div class="header-top-content">
            <span>📧 einvigilator@uitm.edu.my | 📞 03-5544 2000</span>
            <span>Universiti Teknologi MARA (UiTM)</span>
        </div>
    </div>

    {{-- Include the navbar and sidebar --}}
    @include('admin.partials.navbar')
    @include('admin.partials.sidebar')

    {{-- Page Content Container --}}
    <div class="container">
        {{-- Content will be inserted here from child templates --}}
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get sidebar and main content elements
            const sidebar = document.getElementById('sidebar');
            const mainContents = document.querySelectorAll('.main');
            
            // Function to apply sidebar state
            function applySidebarState(isCollapsed) {
                if (sidebar) {
                    if (isCollapsed === 'true') {
                        sidebar.classList.add('collapsed');
                        
                        // Update main content area
                        if (window.innerWidth > 768) {
                            mainContents.forEach(function(main) {
                                main.style.marginLeft = '60px';
                                main.style.width = 'calc(100% - 60px)';
                            });
                        }
                    } else {
                        sidebar.classList.remove('collapsed');
                        
                        // Update main content area
                        if (window.innerWidth > 768) {
                            mainContents.forEach(function(main) {
                                const sidebarWidth = window.innerWidth <= 1024 ? '200px' : '250px';
                                main.style.marginLeft = sidebarWidth;
                                main.style.width = `calc(100% - ${sidebarWidth})`;
                            });
                        }
                    }
                }
            }
            
            // Check localStorage for saved sidebar state when page loads
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
            if (sidebarCollapsed !== null) {
                applySidebarState(sidebarCollapsed);
            }
            
            // Toggle sidebar
            const toggleBtn = document.getElementById('toggleSidebar');
            
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    const isCurrentlyCollapsed = sidebar.classList.contains('collapsed');
                    
                    // Toggle sidebar class
                    sidebar.classList.toggle('collapsed');
                    
                    // For mobile view
                    if (window.innerWidth <= 768) {
                        sidebar.classList.toggle('show');
                    }
                    
                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', !isCurrentlyCollapsed);
                    
                    // Update main content area
                    if (window.innerWidth > 768) {
                        if (!isCurrentlyCollapsed) {
                            mainContents.forEach(function(main) {
                                main.style.marginLeft = '60px';
                                main.style.width = 'calc(100% - 60px)';
                            });
                        } else {
                            mainContents.forEach(function(main) {
                                const sidebarWidth = window.innerWidth <= 1024 ? '200px' : '250px';
                                main.style.marginLeft = sidebarWidth;
                                main.style.width = `calc(100% - ${sidebarWidth})`;
                            });
                        }
                    }
                });
            }
            
            // Toggle profile dropdown
            const profileBtn = document.getElementById('profileDropdownBtn');
            const profileDropdown = document.getElementById('profileDropdown');
            
            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (profileBtn && !profileBtn.contains(e.target)) {
                        profileDropdown.classList.remove('show');
                    }
                });
            }
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 768) {
                    if (sidebar && !sidebar.classList.contains('show')) {
                        mainContents.forEach(function(main) {
                            main.style.marginLeft = '0';
                            main.style.width = '100%';
                        });
                    }
                } else {
                    // Apply current sidebar state when resizing back to desktop
                    applySidebarState(localStorage.getItem('sidebarCollapsed'));
                }
            });

            // Set active menu item based on current URL path
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar a');
            
            menuItems.forEach(item => {
                // Get the href attribute value
                const itemPath = item.getAttribute('href');
                
                // Check if current path includes the href path (excluding the root '/')
                if (itemPath !== '/' && currentPath.includes(itemPath)) {
                    // Add active class and remove from others
                    menuItems.forEach(mi => mi.classList.remove('active'));
                    item.classList.add('active');
                }
            });
        });
    </script>
    
    @yield('page_scripts')
</body>
</html>