<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PPDB SDNU Pemanahan - Penerimaan Peserta Didik Baru' ?></title>
    <meta name="description" content="Penerimaan Peserta Didik Baru (PPDB) SD Nahdlatul Ulama Pemanahan - Santri Aswaja, Mandiri, Unggul, Berwawasan Global, Berkarakter Lokal">
    <meta name="keywords" content="PPDB, SD Nahdlatul Ulama, Pemanahan, Pleret, Bantul, Pendaftaran Online">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
        
        .scrolling {
            transition: all 0.3s ease;
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .loading-dots::after {
            content: '';
            animation: loadingDots 1.5s infinite;
        }
        
        @keyframes loadingDots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }
    </style>
    
</head>
<body class="font-inter gradient-bg min-h-screen">
    <div id="loading" class="fixed inset-0 bg-gradient-to-br from-nu-cream via-white to-nu-light z-50 flex items-center justify-center">
        <div class="flex flex-col items-center justify-center h-full text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-4 border-nu-light border-t-nu-green"></div>
            <p class="text-nu-dark font-semibold mt-4 animate-pulse">Memuat PPDB SDNU...</p>
        </div>
    </div>

    <?= view('components/navbar') ?>
    
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <?= view('components/footer') ?>
    
    <button id="scrollTop" 
            class="fixed bottom-20 right-6 bg-gradient-to-r from-nu-green to-nu-dark text-white p-3 rounded-full shadow-2xl hover:from-nu-dark hover:to-nu-green transition-all duration-300 z-40 opacity-0 transform translate-y-4 group">
        <i class="fas fa-arrow-up group-hover:scale-110 transition-transform duration-300"></i>
        <span class="absolute -top-12 right-0 bg-gray-800 text-white text-xs rounded-lg px-3 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Kembali ke atas
        </span>
    </button>
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        });
        
        const scrollTopBtn = document.getElementById('scrollTop');
        let scrollTimeout;
        
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'translate-y-4');
                scrollTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }
            
            document.body.classList.add('scrolling');
            scrollTimeout = setTimeout(() => {
                document.body.classList.remove('scrolling');
            }, 150);
        });
        
        scrollTopBtn.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
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
        
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.card, .feature-item, .pricing-card');
            animateElements.forEach(el => observer.observe(el));
        });
    </script>
    
    <?= $this->include('components/toast') ?>
    
</body>
</html>
