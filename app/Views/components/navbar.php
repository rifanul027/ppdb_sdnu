<nav class="bg-white shadow-lg border-b-2 border-nu-green fixed w-full top-0 z-40 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo Section -->
            <a href="/" class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-full flex items-center justify-center">
                    <img src="/logo_sdnu.png" alt="SDNU Pemanahan Logo" class="object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-nu-green">SDNU Pemanahan</h1>
                    <p class="text-xs text-gray-600 hidden sm:block">
                        PPDB <?= date('Y') ?>/<?= date('Y') + 1 ?>
                    </p>
                </div>
            </a>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="nav-link text-gray-700 hover:text-nu-green font-medium transition-colors duration-300 relative">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="/ppdb" class="nav-link text-gray-700 hover:text-nu-green font-medium transition-colors duration-300 relative">
                    <i class="fas fa-user-plus mr-2"></i>Info PPDB
                </a>
                <a href="/pengumuman" class="nav-link text-gray-700 hover:text-nu-green font-medium transition-colors duration-300 relative">
                    <i class="fas fa-bullhorn mr-2"></i>Pengumuman
                </a>
                
                    <!-- CTA Button -->
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('student_id')): ?>
                            <a href="/student-profile" class="bg-gradient-to-r from-nu-green to-nu-dark text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                                <i class="fas fa-user mr-2"></i>Profile Siswa
                            </a>
                        <?php else: ?>
                            <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                                <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                            <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                        </a>
                    <?php endif; ?>
                
                <?php if (session()->get('logged_in')): ?>
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="user-menu-btn" class="flex items-center space-x-2 text-gray-700 hover:text-nu-green font-medium transition-colors duration-300">
                            <div class="w-8 h-8 bg-nu-green rounded-full flex items-center justify-center">
                                <?php if (session()->get('avatar')): ?>
                                    <img src="/uploads/avatars/<?= session()->get('avatar') ?>" alt="Avatar" class="w-full h-full rounded-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-user text-white text-sm"></i>
                                <?php endif; ?>
                            </div>
                            <span><?= session()->get('username') ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border hidden">
                            <div class="py-1">
                                <div class="px-4 py-2 border-b">
                                    <div class="text-sm font-medium text-gray-900"><?= session()->get('username') ?></div>
                                    <div class="text-sm text-gray-500"><?= session()->get('email') ?></div>
                                </div>
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                                    </a>
                                <?php endif; ?>
                                <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="return confirm('Yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="nav-link text-gray-700 hover:text-nu-green font-medium transition-colors duration-300 relative">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-gray-700 hover:text-nu-green focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="/" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300">
                    <i class="fas fa-home mr-3"></i>Beranda
                </a>
                <a href="/ppdb" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300">
                    <i class="fas fa-user-plus mr-3"></i>Info PPDB
                </a>
                <a href="/pengumuman" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300">
                    <i class="fas fa-bullhorn mr-3"></i>Pengumuman
                </a>
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('student_id')): ?>
                            <a href="/student-profile" class="bg-gradient-to-r from-nu-green to-nu-dark text-white py-2 px-4 rounded-lg font-medium text-center">
                                <i class="fas fa-user mr-2"></i>Profile Siswa
                            </a>
                        <?php else: ?>
                            <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white py-2 px-4 rounded-lg font-medium text-center">
                                <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white py-2 px-4 rounded-lg font-medium text-center">
                            <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                        </a>
                    <?php endif; ?>
                
                <?php if (session()->get('logged_in')): ?>
                    <div class="border-t pt-3 mt-3">
                        <div class="px-4 py-2">
                            <div class="text-sm font-medium text-gray-900"><?= session()->get('username') ?></div>
                            <div class="text-sm text-gray-500"><?= session()->get('email') ?></div>
                        </div>
                        <a href="/profile" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300 block">
                            <i class="fas fa-user mr-3"></i>Profile
                        </a>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <a href="/admin/dashboard" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300 block">
                                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard Admin
                            </a>
                        <?php endif; ?>
                        <a href="/logout" class="text-red-600 hover:text-red-700 font-medium py-2 px-4 rounded-lg hover:bg-red-50 transition-all duration-300 block" onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt mr-3"></i>Logout
                        </a>
                    </div>
                <?php else: ?>
                    <a href="/login" class="text-gray-700 hover:text-nu-green font-medium py-2 px-4 rounded-lg hover:bg-nu-cream transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-3"></i>Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="h-20"></div>

<style>
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 50%;
        background-color: #1B5E20;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .nav-link:hover::after {
        width: 100%;
    }
    
    #navbar {
        backdrop-filter: blur(10px);
    }
</style>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        const icon = mobileMenuBtn.querySelector('i');
        if (mobileMenu.classList.contains('hidden')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        }
    });
    
    // User dropdown menu toggle
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenu = document.getElementById('user-menu');
    
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
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-xl');
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
        } else {
            navbar.classList.remove('shadow-xl');
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 1)';
        }
    });
</script>
