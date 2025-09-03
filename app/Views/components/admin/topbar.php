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
                <div style="font-weight: 600; font-size: 0.875rem;">
                    <?= session()->get('username') ?? 'Admin' ?>
                </div>
                <div style="font-size: 0.75rem; color: #64748b;">
                    <?= date('d M Y, H:i') ?>
                </div>
            </div>
            <div class="user-avatar" style="position: relative;">
                <?php if (session()->get('avatar')): ?>
                    <img src="/uploads/avatars/<?= session()->get('avatar') ?>" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu" id="admin-dropdown" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 0.5rem; background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); min-width: 200px; z-index: 50;">
                    <div style="padding: 0.5rem 0;">
                        <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e5e7eb;">
                            <div style="font-weight: 600; font-size: 0.875rem; color: #111827;">
                                <?= session()->get('username') ?? 'Admin' ?>
                            </div>
                            <div style="font-size: 0.75rem; color: #6b7280;">
                                <?= session()->get('email') ?? '' ?>
                            </div>
                        </div>
                        <a href="/admin/profile" style="display: block; padding: 0.75rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; transition: background-color 0.15s;">
                            <i class="fas fa-user" style="margin-right: 0.5rem; width: 16px;"></i>
                            Profile
                        </a>
                        <a href="/logout" onclick="return confirm('Yakin ingin logout?')" style="display: block; padding: 0.75rem 1rem; color: #dc2626; text-decoration: none; font-size: 0.875rem; transition: background-color 0.15s;">
                            <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem; width: 16px;"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
// Toggle admin dropdown
document.addEventListener('DOMContentLoaded', function() {
    const userAvatar = document.querySelector('.user-avatar');
    const dropdown = document.getElementById('admin-dropdown');
    
    if (userAvatar && dropdown) {
        userAvatar.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdown.style.display = 'none';
        });

        // Prevent dropdown from closing when clicking inside
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});

// Hover effects for dropdown items
document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('.dropdown-menu a');
    dropdownItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f3f4f6';
        });
        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });
});
</script>

<style>
.user-avatar {
    cursor: pointer;
    transition: transform 0.15s ease;
}

.user-avatar:hover {
    transform: scale(1.05);
}

.dropdown-menu {
    animation: fadeIn 0.15s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
