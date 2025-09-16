<header class="topbar">
    <div class="topbar-content">
        <div class="topbar-left">
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <!-- <h1 class="page-title"><?= $pageTitle ?? 'Dashboard' ?></h1> -->
        </div>
        
        <div class="user-menu">
            <div class="user-info">
                <div class="user-name">
                    <?= session()->get('username') ?? 'Admin' ?>
                </div>
                <div class="user-time">
                    <?= date('d M Y, H:i') ?>
                </div>
            </div>
            <!-- User Dropdown -->
            <div class="relative">
                <button id="user-menu-btn" class="flex items-center space-x-2 text-gray-700 hover:text-green-600 font-medium transition-colors duration-300">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                        <?php if (session()->get('avatar')): ?>
                            <img src="/uploads/avatars/<?= session()->get('avatar') ?>" alt="Avatar" class="w-full h-full rounded-full object-cover">
                        <?php else: ?>
                            <i class="fas fa-user text-white text-sm"></i>
                        <?php endif; ?>
                    </div>
                    <span class="hidden sm:block"><?= session()->get('username') ?? 'Admin' ?></span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>

                <div id="admin-dropdown" class="absolute right-4 mt-2 w-48 bg-white rounded-lg shadow-lg border hidden z-50">
                    <div class="py-1">
                        <div class="px-4 py-2 border-b">
                            <div class="text-sm font-medium text-gray-900"><?= session()->get('username') ?? 'Admin' ?></div>
                            <div class="text-sm text-gray-500"><?= session()->get('email') ?? '' ?></div>
                        </div>
                        <a href="/admin/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-user mr-2"></i>Profile
                        </a>
                        <a href="/logout" onclick="return confirm('Yakin ingin logout?')" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
// User dropdown menu toggle (similar to navbar.php)
const userMenuBtn = document.getElementById('user-menu-btn');
const userMenu = document.getElementById('admin-dropdown');

if (userMenuBtn && userMenu) {
    userMenuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        userMenu.classList.add('hidden');
    });

    userMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
}
</script>


