<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - PPDB SDNU Pemanahan</title>
    <meta name="description" content="Akses ditolak - Anda tidak memiliki izin untuk mengakses halaman ini">
    
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
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'nu-green': '#1B5E20',
                        'nu-gold': '#FFB300',
                        'nu-cream': '#FFF8E1',
                        'nu-dark': '#2E7D32',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'shake': 'shake 0.5s ease-in-out',
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 50%, #388E3C 100%);
        }
    </style>
</head>
<body class="font-inter bg-gradient-to-br from-gray-50 to-nu-cream min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center">
            <!-- Logo -->
            <div class="animate-fade-in">
                <img src="<?= base_url('logo_sdnu.png') ?>" alt="Logo SDNU" class="mx-auto h-20 w-auto mb-8 animate-float">
            </div>
            
            <!-- Error Content -->
            <div class="animate-slide-up">
                <!-- Error Icon -->
                <div class="mb-8">
                    <div class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-6 animate-shake">
                        <i class="fas fa-lock text-4xl text-red-600"></i>
                    </div>
                    <h1 class="text-6xl font-bold text-red-600">403</h1>
                    <div class="w-24 h-1 bg-red-500 mx-auto mt-4 rounded-full"></div>
                </div>
                
                <!-- Error Message -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Akses Ditolak</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. 
                        Silakan login dengan akun yang memiliki hak akses yang sesuai.
                    </p>
                    
                    <?php if (ENVIRONMENT !== 'production' && isset($message)) : ?>
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-600 font-mono">
                                <?= nl2br(esc($message)) ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                    <a href="<?= base_url('auth/login') ?>" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-nu-green hover:bg-nu-dark transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                    
                    <a href="<?= base_url() ?>" 
                       class="inline-flex items-center px-6 py-3 border border-nu-green text-base font-medium rounded-lg text-nu-green bg-transparent hover:bg-nu-green hover:text-white transition-all duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
                
                <!-- Additional Info -->
                <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        <p class="text-sm font-medium text-blue-800">Informasi</p>
                    </div>
                    <p class="text-sm text-blue-700">
                        Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator 
                        atau login dengan akun yang memiliki akses yang sesuai.
                    </p>
                </div>
                
                <!-- Contact Info -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-4">Butuh bantuan? Hubungi kami:</p>
                    <div class="flex justify-center space-x-6">
                        <a href="https://wa.me/6282223008689" target="_blank" 
                           class="text-green-600 hover:text-green-700 transition-colors">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                        <a href="tel:+6282223008689" 
                           class="text-nu-green hover:text-nu-dark transition-colors">
                            <i class="fas fa-phone text-xl"></i>
                        </a>
                        <a href="mailto:info@sdnuperamanahan.com" 
                           class="text-nu-green hover:text-nu-dark transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <div class="absolute top-10 left-10 w-20 h-20 bg-red-300 opacity-10 rounded-full animate-float"></div>
        <div class="absolute top-1/4 right-20 w-16 h-16 bg-nu-green opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/4 w-12 h-12 bg-red-300 opacity-10 rounded-full animate-float" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-nu-green opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
    </div>
</body>
</html>
