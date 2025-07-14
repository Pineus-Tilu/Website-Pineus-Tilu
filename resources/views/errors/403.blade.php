<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | Pineus Tilu </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Roboto+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        .font-heading { font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; font-weight: 700; }
        .font-body { font-family: 'Roboto Mono', 'Consolas', monospace; }
        
        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .bounce-animation {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }
        
        .shake-animation:hover {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
            20%, 40%, 60%, 80% { transform: translateX(10px); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 flex items-center justify-center px-4">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-32 h-32 bg-red-200/30 rounded-full floating-animation"></div>
        <div class="absolute top-20 right-20 w-24 h-24 bg-orange-200/30 rounded-full floating-animation" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-20 w-28 h-28 bg-yellow-200/30 rounded-full floating-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-10 right-10 w-20 h-20 bg-red-300/30 rounded-full floating-animation" style="animation-delay: 0.5s;"></div>
    </div>

    <div class="max-w-2xl mx-auto text-center relative z-10">
        <!-- Error Icon -->
        <div class="mb-8 relative">
            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center shadow-2xl bounce-animation">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <!-- Decorative rings -->
            <div class="absolute inset-0 w-32 h-32 mx-auto border-4 border-red-300/50 rounded-full animate-ping"></div>
            <div class="absolute inset-0 w-40 h-40 mx-auto border-2 border-red-200/30 rounded-full animate-pulse" style="top: -16px; left: 50%; transform: translateX(-50%);"></div>
        </div>

        <!-- Error Code -->
        <div class="mb-6">
            <h1 class="font-dancing text-8xl md:text-9xl font-bold text-transparent bg-gradient-to-r from-red-500 via-orange-500 to-red-600 bg-clip-text drop-shadow-lg">
                403
            </h1>
        </div>

        <!-- Error Message -->
        <div class="mb-8 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 font-dancing">
                🚫 Akses Ditolak
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed max-w-lg mx-auto font-body">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda yakin ini adalah kesalahan.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-[#006C43] via-[#00844D] to-[#005A36] hover:from-[#005A36] hover:via-[#006C43] hover:to-[#00844D] text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl shake-animation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                🏠 Kembali ke Beranda
            </a>
            
            <button onclick="history.back()" 
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl shake-animation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                ⬅️ Kembali
            </button>
        </div>

        <!-- Additional Info -->
        <div class="mt-12 p-6 bg-white/60 backdrop-blur-sm rounded-2xl border border-red-100 shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 mb-3 font-dancing">
                🤔 Mengapa ini terjadi?
            </h3>
            <div class="text-sm text-gray-600 space-y-2 text-left max-w-md mx-auto font-body">
                <p>• Anda tidak memiliki hak akses yang diperlukan</p>
                <p>• Halaman ini dibatasi untuk pengguna tertentu</p>
                <p>• Session Anda mungkin telah berakhir</p>
                <p>• Terjadi kesalahan dalam sistem otorisasi</p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 font-body">
                Butuh bantuan? Hubungi tim support kami di 
                <a href="mailto:support@getyourtrip.com" class="text-[#006C43] hover:text-[#00844D] font-semibold transition-colors">
                    pineustilu@gmail.com
                </a>
            </p>
        </div>
    </div>

    <!-- JavaScript untuk efek tambahan -->
    <script>
        // Tambah efek partikel saat mouse move
        document.addEventListener('mousemove', function(e) {
            const particle = document.createElement('div');
            particle.className = 'absolute w-2 h-2 bg-red-400 rounded-full pointer-events-none animate-ping';
            particle.style.left = e.clientX + 'px';
            particle.style.top = e.clientY + 'px';
            particle.style.zIndex = '1';
            document.body.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 1000);
        });

        // Console message
        console.log('🚫 403 Forbidden - GetYourTrip Security System');
    </script>
</body>
</html>
