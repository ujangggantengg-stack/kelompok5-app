<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Toko Roti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="/" class="text-orange-600 hover:text-orange-700">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Profile Saya</h1>
            </div>
            <form method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-700">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="text-center mb-6">
                        <img src="{{ $customer->avatar_url }}" 
                             alt="{{ $customer->name }}" 
                             class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-orange-100">
                        <h2 class="text-xl font-bold text-gray-800">{{ $customer->name }}</h2>
                        <p class="text-gray-600">{{ $customer->email }}</p>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('customer.profile') }}" 
                           class="flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-600 rounded-lg font-medium">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('customer.addresses') }}" 
                           class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Alamat</span>
                        </a>
                        <a href="{{ route('customer.orders') }}" 
                           class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Pesanan</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <!-- Profile Info -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Profile</h3>
                    
                    <form method="POST" action="{{ route('customer.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $customer->name }}" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ $customer->email }}" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                                <input type="tel" name="phone" value="{{ $customer->phone }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                <input type="text" name="city" value="{{ $customer->city }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="address" rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">{{ $customer->address }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Ubah Password</h3>
                    
                    <form method="POST" action="{{ route('customer.profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" name="password" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                                <i class="fas fa-key mr-2"></i>Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
