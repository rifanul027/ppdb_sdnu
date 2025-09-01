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
                    <p class="text-xs text-gray-600 hidden sm:block">PPDB 2025/2026</p>
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
                <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                    <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                </a>
                <a href="/login" class="nav-link text-gray-700 hover:text-nu-green font-medium transition-colors duration-300 relative">
                    <i class="fas fa-user mr-2"></i>
                </a>
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
                <a href="/daftar" class="bg-gradient-to-r from-nu-green to-nu-dark text-white py-2 px-4 rounded-lg font-medium text-center">
                    <i class="fas fa-edit mr-2"></i>Daftar Sekarang
                </a>
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
