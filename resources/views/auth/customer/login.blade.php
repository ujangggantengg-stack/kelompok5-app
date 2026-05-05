<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Toko Roti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-orange-50 to-amber-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center text-orange-600 hover:text-orange-700 mb-6">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Beranda
        </a>

        <div class="max-w-md mx-auto">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="inline-block bg-orange-500 text-white rounded-full p-4 mb-4">
                    <i class="fas fa-bread-slice text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Masuk ke Akun</h1>
                <p class="text-gray-600 mt-2">Belanja lebih cepat dengan akun Anda</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
                @endif

                <!-- Google Login -->
                @if(config('services.google.client_id'))
                <a href="{{ route('customer.google.redirect') }}" 
                   class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all mb-6">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Masuk dengan Google
                </a>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">atau</span>
                    </div>
                </div>
                @endif

                <!-- Email Login Form -->
                <form method="POST" action="{{ route('customer.login.post') }}" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-1"></i>Email
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required 
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="nama@email.com">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-1"></i>Password
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Masukkan password">
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Lupa password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>
                </form>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('customer.register') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>

                <!-- Guest Checkout -->
                <div class="mt-4 text-center">
                    <a href="/" class="text-sm text-gray-500 hover:text-gray-700">
                        Atau lanjutkan sebagai tamu
                    </a>
                </div>
            </div>

            <!-- Benefits -->
            <div class="mt-8 bg-white rounded-xl p-6 shadow-md">
                <h3 class="font-semibold text-gray-800 mb-4">Keuntungan Punya Akun:</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Checkout lebih cepat dengan alamat tersimpan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Lihat riwayat pesanan dan status pengiriman</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Chat admin tanpa input nomor HP lagi</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Reorder dengan 1 klik</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Refresh CSRF token on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission
            const form = document.querySelector('form[action*="login"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Ensure CSRF token is present
                    const csrfInput = form.querySelector('input[name="_token"]');
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    
                    if (csrfInput && csrfMeta) {
                        csrfInput.value = csrfMeta.getAttribute('content');
                    }
                });
            }
        });
    </script>
</body>
</html>
