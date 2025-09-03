<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PPDB SDNU Pemanahan - Penerimaan Peserta Didik Baru' ?></title>
    <meta name="description" content="Penerimaan Peserta Didik Baru (PPDB) SD Nahdlatul Ulama Pemanahan - Santri Aswaja, Mandiri, Unggul, Berwawasan Global, Berkarakter Lokal">
    <meta name="keywords" content="PPDB, SD Nahdlatul Ulama, Pemanahan, Pleret, Bantul, Pendaftaran Online">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'nu-green': '#16a34a',
                        'nu-dark': '#15803d',
                        'nu-light': '#f0fdf4',
                        'nu-cream': '#fefce8',
                        'nu-gold': '#ca8a04'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 6s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    </script>
    
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #fef7ed 0%, #dcfce7 50%, #f0fdf4 100%);
        }
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(34, 197, 94, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75px 75px, rgba(245, 158, 11, 0.08) 2px, transparent 2px);
            background-size: 100px 100px;
        }
        
        .hexagon-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='0.03'%3E%3Cpolygon fill='%2322c55e' points='50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40'/%3E%3C/g%3E%3C/svg%3E");
        }
        
        .dots-pattern {
            background-image: radial-gradient(circle, rgba(34, 197, 94, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        /* Custom Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        /* Scrolling indicator */
        .scrolling {
            transition: all 0.3s ease;
        }
        
        /* Enhanced hover effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Loading animation enhancement */
        .loading-dots::after {
            content: '';
            animation: loadingDots 1.5s infinite;
        }
        
        @keyframes loadingDots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }
    </style>>
    
</head>
<body class="font-inter gradient-bg min-h-screen">
    <!-- Loading Spinner -->
    <div id="loading" class="fixed inset-0 bg-gradient-to-br from-nu-cream via-white to-nu-light z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="relative">
                <div class="animate-spin rounded-full h-16 w-16 border-4 border-nu-light border-t-nu-green"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-nu-green text-xl"></i>
                </div>
            </div>
            <p class="text-nu-dark font-semibold mt-4 animate-pulse">Memuat PPDB SDNU...</p>
        </div>
    </div>

    <!-- Navbar -->
    <?= view('components/navbar') ?>
    
    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <?= view('components/footer') ?>
    
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6282223008689?text=Assalamu'alaikum, saya ingin bertanya tentang PPDB SDNU Pemanahan" 
       target="_blank" 
       class="fixed bottom-6 right-6 bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-full shadow-2xl hover:from-green-600 hover:to-green-700 transition-all duration-300 z-40 animate-float group">
        <i class="fab fa-whatsapp text-2xl group-hover:scale-110 transition-transform duration-300"></i>
        <span class="absolute -top-12 right-0 bg-gray-800 text-white text-xs rounded-lg px-3 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Chat WhatsApp
        </span>
    </a>
    
    <!-- Scroll to Top Button -->
    <button id="scrollTop" 
            class="fixed bottom-20 right-6 bg-gradient-to-r from-nu-green to-nu-dark text-white p-3 rounded-full shadow-2xl hover:from-nu-dark hover:to-nu-green transition-all duration-300 z-40 opacity-0 transform translate-y-4 group">
        <i class="fas fa-arrow-up group-hover:scale-110 transition-transform duration-300"></i>
        <span class="absolute -top-12 right-0 bg-gray-800 text-white text-xs rounded-lg px-3 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Kembali ke atas
        </span>
    </button>

    <!-- Preline UI JS -->
    <script src="https://preline.co/assets/js/hs-ui.bundle.js"></script>

    <script>
        // Hide loading spinner with smooth transition
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        });
        
        // Scroll to top functionality with enhanced UX
        const scrollTopBtn = document.getElementById('scrollTop');
        let scrollTimeout;
        
        window.addEventListener('scroll', function() {
            // Clear previous timeout
            clearTimeout(scrollTimeout);
            
            // Show/hide scroll button with smooth animation
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }
            
            // Add scrolling indicator
            document.body.classList.add('scrolling');
            scrollTimeout = setTimeout(() => {
                document.body.classList.remove('scrolling');
            }, 150);
        });
        
        scrollTopBtn.addEventListener('click', function() {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
        
        // Enhanced smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                
                if (target) {
                    const headerOffset = 80; // Account for fixed header
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Add loading states for forms and buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers for buttons with loading states
            const buttons = document.querySelectorAll('button[type="submit"], .btn-submit');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.disabled) {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                        this.disabled = true;
                        
                        // Re-enable after form submission or timeout
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }, 3000);
                    }
                });
            });
            
            // Enhance form validation feedback
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.checkValidity()) {
                        this.classList.add('border-nu-green', 'focus:border-nu-green');
                        this.classList.remove('border-red-500', 'focus:border-red-500');
                    } else {
                        this.classList.add('border-red-500', 'focus:border-red-500');
                        this.classList.remove('border-nu-green', 'focus:border-nu-green');
                    }
                });
            });
        });
        
        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.card, .feature-item, .pricing-card');
            animateElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
