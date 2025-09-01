<header class="topbar">
    <div class="topbar-content">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="mobile-menu-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="page-title"><?= $pageTitle ?? 'Dashboard' ?></h1>
        </div>
        
        <div class="user-menu">
            <div style="text-align: right; margin-right: 1rem;">
                <div style="font-weight: 600; font-size: 0.875rem;">Admin</div>
                <div style="font-size: 0.75rem; color: #64748b;">
                    <?= date('d M Y, H:i') ?>
                </div>
            </div>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>
</header>
