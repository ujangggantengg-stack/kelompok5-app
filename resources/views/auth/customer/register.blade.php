<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun Premium - Dapoer Budess</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-brown: #3D1F00;
            --cream: #FFF9F0;
            --gold: #D4AF37;
            --soft-brown: #6B4E3D;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--cream);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .premium-shadow {
            box-shadow: 0 20px 50px rgba(61, 31, 0, 0.1);
        }
        .btn-premium {
            background: linear-gradient(135deg, var(--dark-brown) 0%, #5D3A1A 100%);
            color: var(--cream);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(61, 31, 0, 0.2);
            color: var(--gold);
        }
        .input-premium:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }
        .google-btn {
            border: 2px solid #e5e7eb;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .google-btn:hover {
            border-color: var(--gold);
            background-color: #fff;
            transform: translateY(-1px);
        }
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .btn-loading .loading-spinner {
            display: block;
        }
        .btn-loading .btn-text {
            display: none;
        }
        .password-toggle {
            cursor: pointer;
            color: #9ca3af;
            transition: color 0.3s;
        }
        .password-toggle:hover {
            color: var(--dark-brown);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-lg">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center text-soft-brown hover:text-dark-brown mb-8 transition-colors font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Beranda
        </a>

        <div class="bg-white rounded-3xl premium-shadow overflow-hidden border border-orange-100">
            <!-- Header Section -->
            <div class="bg-dark-brown p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 transform rotate-12">
                    <i class="fas fa-bread-slice text-8xl text-cream"></i>
                </div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-playfair text-gold mb-2">Bergabung Bersama Kami</h1>
                    <p class="text-cream opacity-80 font-light">Daftar sekarang untuk pengalaman belanja roti premium</p>
                </div>
            </div>

            <div class="p-8">
                <a href="{{ route('customer.google.redirect') }}" id="google-login-btn"
                   class="google-btn w-full flex items-center justify-center gap-3 bg-white text-gray-700 font-bold py-3 px-4 rounded-xl mb-6 shadow-sm hover:shadow-md transition-all">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5" alt="Google">
                    <span class="btn-text">Daftar Cepat dengan Google</span>
                    <div class="loading-spinner" style="border-top-color: var(--dark-brown);"></div>
                </a>

                <div class="relative mb-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase tracking-widest">
                        <span class="px-4 bg-white text-gray-400 font-bold">Atau gunakan email</span>
                    </div>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('customer.register.post') }}" class="space-y-5" id="register-form">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="input-premium w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none transition-all"
                                   placeholder="Contoh: Budi Santoso">
                        </div>
                        @error('name') <p class="mt-1.5 text-xs text-red-500 font-semibold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2 ml-1">Email Anda</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="input-premium w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none transition-all"
                                   placeholder="nama@email.com">
                        </div>
                        @error('email') <p class="mt-1.5 text-xs text-red-500 font-semibold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2 ml-1">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" id="password" name="password" required
                                       class="input-premium w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none transition-all"
                                       placeholder="••••••••">
                                <span class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                </span>
                            </div>
                            @error('password') <p class="mt-1.5 text-xs text-red-500 font-semibold ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-dark-brown uppercase tracking-wider mb-2 ml-1">Konfirmasi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                    <i class="fas fa-shield-alt"></i>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="input-premium w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none transition-all"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn-premium w-full py-3.5 rounded-xl font-bold text-lg shadow-lg mt-4 flex items-center justify-center">
                        <span class="btn-text">Daftar Sekarang</span>
                        <div class="loading-spinner"></div>
                    </button>
                </form>

                <p class="mt-8 text-center text-gray-500 text-sm">
                    Sudah memiliki akun? 
                    <a href="{{ route('customer.login') }}" class="text-dark-brown font-bold hover:text-gold transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>

        <p class="mt-8 text-center text-gray-400 text-xs leading-relaxed">
            Dengan mendaftar, Anda menyetujui <a href="#" class="underline hover:text-soft-brown">Syarat & Ketentuan</a> 
            serta <a href="#" class="underline hover:text-soft-brown">Kebijakan Privasi</a> kami.
        </p>
    </div>

    <script>
        // Show/Hide Password
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Loading States
        const registerForm = document.querySelector('#register-form');
        const submitBtn = document.querySelector('#submit-btn');
        const googleBtn = document.querySelector('#google-login-btn');

        registerForm.addEventListener('submit', function() {
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
        });

        googleBtn.addEventListener('click', function() {
            this.classList.add('btn-loading');
            this.style.pointerEvents = 'none';
        });
    </script>
</body>
</html>
