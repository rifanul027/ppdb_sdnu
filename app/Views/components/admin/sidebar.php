<aside class="sidebar">
    <div class="sidebar-header flex flex-col items-center py-6">
        <img src="/logo_sdnuputih.png" alt="Logo" class="mb-2 w-16 h-16 object-contain mx-auto">
        <h2 class="text-lg font-bold text-white text-center">PPDB SD NU</h2>
        <p class="text-sm text-gray-300 text-center">Admin Dashboard</p>
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="/admin/dashboard" class="nav-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </div>
        
        <div class="nav-item parent-menu">
            <div class="nav-parent">
                <i class="fas fa-graduation-cap"></i>
                <span>PPDB</span>
            </div>
            <div class="nav-child">
                <a href="/admin/pendaftar" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Pendaftar</span>
                </a>
            </div>
            <div class="nav-child">
                <a href="/admin/daftar-ulang" class="nav-link">
                    <i class="fas fa-redo-alt"></i>
                    <span>Daftar Ulang</span>
                </a>
            </div>
            <div class="nav-child">
                <a href="/admin/rekap-siswa" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Rekap Siswa</span>
                </a>
            </div>
        </div>
        
        <div class="nav-item">
            <a href="/admin/pengumuman" class="nav-link">
                <i class="fas fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>
        </div>
        
        <div class="nav-item">
            <a href="/admin/pengaturan" class="nav-link">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </div>
        
        <div class="nav-item">
            <a href="/admin/profile" class="nav-link">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </div>
        
        <div class="nav-item" style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
            <a href="/logout" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>
</aside>

<style>
.parent-menu {
    margin-bottom: 10px;
}

.nav-parent {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    background-color: rgba(255,255,255,0.1);
    border-radius: 5px;
    margin-bottom: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.nav-parent:hover {
    background-color: rgba(255,255,255,0.15);
}

.nav-parent i {
    margin-right: 12px;
    width: 20px;
    font-size: 16px;
}

.nav-child {
    margin-left: 20px;
    margin-bottom: 2px;
}

.nav-child .nav-link {
    padding: 10px 20px;
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    border-left: 2px solid rgba(255,255,255,0.2);
    margin-left: 10px;
    transition: all 0.2s ease;
}

.nav-child .nav-link:hover {
    background-color: rgba(255,255,255,0.1);
    border-left-color: #4CAF50;
    color: white;
    transform: translateX(3px);
}

.nav-child .nav-link i {
    font-size: 14px;
    width: 16px;
}

/* Mobile optimizations */
@media (max-width: 768px) {
    .sidebar-header {
        padding: 1.5rem 1rem;
    }
    
    .sidebar-header h2 {
        font-size: 1.125rem;
    }
    
    .nav-link {
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
    }
    
    .nav-parent {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .nav-child .nav-link {
        padding: 8px 15px;
        font-size: 13px;
        margin-left: 8px;
    }
}

@media (max-width: 480px) {
    .sidebar-header {
        padding: 1rem 0.75rem;
    }
    
    .sidebar-header img {
        max-width: 50px !important;
    }
    
    .nav-link {
        padding: 0.75rem 0.75rem;
    }
    
    .nav-parent {
        padding: 10px 12px;
    }
    
    .nav-child .nav-link {
        padding: 6px 12px;
        margin-left: 6px;
    }
}

/* Touch devices */
@media (hover: none) and (pointer: coarse) {
    .nav-link:hover {
        background-color: transparent;
        transform: none;
    }
    
    .nav-child .nav-link:hover {
        background-color: transparent;
        transform: none;
    }
    
    .nav-parent:hover {
        background-color: rgba(255,255,255,0.1);
    }
    
    /* Active states for touch */
    .nav-link:active {
        background-color: rgba(255,255,255,0.1);
    }
    
    .nav-child .nav-link:active {
        background-color: rgba(255,255,255,0.1);
    }
}
</style>
