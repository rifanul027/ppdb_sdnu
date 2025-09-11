<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - PPDB SD NU</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #059669 0%, #065f46 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .sidebar-header p {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            border-left-color: #10b981;
            color: white;
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            border-left-color: #10b981;
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            background-color: #f8fafc;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 100%;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #059669;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .mobile-menu-btn:hover {
            background-color: #f1f5f9;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            text-align: right;
            margin-right: 1rem;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
        }

        .user-time {
            font-size: 0.75rem;
            color: #64748b;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #059669, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .content-area {
            padding: 2rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 4px solid #059669;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #059669, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-change {
            font-size: 0.875rem;
            color: #059669;
            font-weight: 500;
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #047857, #059669);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 260px;
            }
            
            .main-content {
                margin-left: 260px;
            }
            
            .topbar {
                padding: 1rem 1.5rem;
            }
            
            .content-area {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .topbar {
                padding: 1rem;
            }

            .topbar-content {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .user-info {
                display: none;
            }

            .user-menu {
                gap: 0.5rem;
            }

            .content-area {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .card-header,
            .card-body {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
            }

            .topbar {
                padding: 0.75rem;
            }

            .page-title {
                font-size: 1.125rem;
            }

            .content-area {
                padding: 0.75rem;
            }

            .stat-card {
                padding: 0.75rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.813rem;
            }

            .table-container {
                font-size: 0.875rem;
            }

            .table th,
            .table td {
                padding: 0.5rem;
            }
        }

        /* Touch devices */
        @media (hover: none) and (pointer: coarse) {
            .nav-link:hover {
                background-color: transparent;
            }
            
            .nav-link:active {
                background-color: rgba(255,255,255,0.1);
            }
            
            .stat-card:hover {
                transform: none;
            }
            
            .btn-primary:hover {
                transform: none;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>
        
        <?= $this->include('components/admin/sidebar') ?>
        
        <main class="main-content">
            <?= $this->include('components/admin/topbar') ?>
            
            <div class="content-area">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile menu toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when sidebar is open on mobile
            if (window.innerWidth <= 768) {
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            }
        }

        function closeSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sidebar');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth <= 768 && 
                sidebar.classList.contains('active') &&
                !sidebar.contains(e.target) && 
                !menuBtn.contains(e.target)) {
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Handle escape key to close sidebar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && window.innerWidth <= 768) {
                closeSidebar();
            }
        });

        // Set active nav link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath || 
                    (currentPath.includes(link.getAttribute('href')) && link.getAttribute('href') !== '/admin')) {
                    link.classList.add('active');
                }
            });

            // Smooth scrolling for sidebar on mobile
            const sidebar = document.querySelector('.sidebar');
            if (sidebar && window.innerWidth <= 768) {
                sidebar.style.scrollBehavior = 'smooth';
            }
        });

        // Touch swipe to open/close sidebar on mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (window.innerWidth <= 768) {
                const swipeDistance = touchEndX - touchStartX;
                const sidebar = document.querySelector('.sidebar');
                
                // Swipe right to open sidebar (from left edge)
                if (swipeDistance > 50 && touchStartX < 50 && !sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
                // Swipe left to close sidebar
                else if (swipeDistance < -50 && sidebar.classList.contains('active')) {
                    closeSidebar();
                }
            }
        }
    </script>
</body>
</html>
