<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Toko Roti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .alert-error {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
        }
    </style>
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
                <h1 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-600 mt-2">Daftar dan nikmati kemudahan berbelanja</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Error Messages -->
                @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif
                <!-- Google Register -->
                @if(config('services.google.client_id'))
                <a href="{{ route('customer.google.redirect') }}" 
                   class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all mb-6">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Daftar dengan Google
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

                <!-- Register Form -->
                <form method="POST" action="{{ route('customer.register.post') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required 
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Nama lengkap Anda">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="nama@email.com">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone (Optional) -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone mr-1"></i>Nomor HP <span class="text-gray-400">(Opsional)</span>
                        </label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                               placeholder="08123456789">
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
                               placeholder="Minimal 8 karakter">
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-1"></i>Konfirmasi Password
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                               placeholder="Ketik ulang password">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('customer.login') }}" class="text-orange-600 hover:text-orange-700 font-semibold">
                            Masuk
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

            <!-- Terms -->
            <div class="mt-6 text-center text-xs text-gray-500">
                Dengan mendaftar, Anda menyetujui 
                <a href="#" class="text-orange-600 hover:underline">Syarat & Ketentuan</a> 
                dan 
                <a href="#" class="text-orange-600 hover:underline">Kebijakan Privasi</a>
            </div>
        </div>
    </div>

    <script>
        // Refresh CSRF token on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log('CSRF Token loaded:', csrfToken);
            
            // Handle form submission
            const form = document.getElementById('registerForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Ensure CSRF token is fresh
                    const csrfInput = form.querySelector('input[name="_token"]');
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    
                    if (csrfInput && csrfMeta) {
                        const freshToken = csrfMeta.getAttribute('content');
                        csrfInput.value = freshToken;
                        console.log('Form submitting with token:', freshToken);
                    } else {
                        console.error('CSRF token not found!');
                        e.preventDefault();
                        alert('Error: CSRF token tidak ditemukan. Silakan refresh halaman.');
                        return false;
                    }
                });
            }
        });
    </script>
</body>
</html>
