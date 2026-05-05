<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Roti Hari Ini - Toko Roti</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-orange-50 to-amber-50 min-h-screen">
    
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-4xl">🍞</span>
                    <h1 class="text-2xl font-bold text-gray-800">Toko Roti</h1>
                </div>
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-600 hover:text-orange-500 transition-colors">Home</a>
                    <a href="/products" class="text-gray-600 hover:text-orange-500 transition-colors">Produk</a>
                    <a href="/promo" class="text-orange-500 font-bold">Promo</a>
                    <a href="/cart" class="text-gray-600 hover:text-orange-500 transition-colors">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Hero Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center space-x-3 mb-6">
                <span class="text-6xl animate-bounce">🔥</span>
                <h2 class="text-5xl md:text-6xl font-bold text-gray-800" style="font-family: 'Playfair Display', serif;">
                    Promo Spesial Hari Ini!
                </h2>
            </div>
            
            <p class="text-xl text-gray-600 mb-8">
                Dapatkan diskon hingga <span class="text-orange-500 font-bold">10%</span> untuk produk pilihan
            </p>
            
            <!-- CTA Button -->
            <button 
                onclick="openPromoModal()"
                class="inline-flex items-center space-x-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-full text-xl font-bold hover:from-orange-600 hover:to-orange-700 transition-all shadow-2xl hover:shadow-3xl transform hover:scale-105"
            >
                <span>🛒</span>
                <span>Lihat Promo Sekarang!</span>
                <i class="fas fa-arrow-right"></i>
            </button>
            
            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="text-4xl mb-4">🍞</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Fresh Setiap Hari</h3>
                    <p class="text-gray-600">Roti dibuat fresh setiap pagi untuk kualitas terbaik</p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="text-4xl mb-4">🚚</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gratis Ongkir</h3>
                    <p class="text-gray-600">Untuk pembelian minimal Rp 50.000</p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="text-4xl mb-4">💯</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Kualitas Terjamin</h3>
                    <p class="text-gray-600">100% bahan berkualitas premium</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Promo Grid Preview -->
    <section class="container mx-auto px-4 py-16">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-12">Produk Promo Hari Ini</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Preview Card 1 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden cursor-pointer transform hover:scale-105 transition-all" onclick="openPromoModal()">
                <div class="relative">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold">
                        PROMO
                    </div>
                    <img src="https://via.placeholder.com/400x400/8B4513/FFFFFF?text=Roti+Sobek+Coklat" 
                         alt="Roti Sobek Coklat" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Roti Sobek Coklat Keju</h4>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-400 line-through">Rp 30.000</span>
                        <span class="text-2xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                </div>
            </div>
            
            <!-- Preview Card 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden cursor-pointer transform hover:scale-105 transition-all" onclick="openPromoModal()">
                <div class="relative">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold">
                        PROMO
                    </div>
                    <img src="https://via.placeholder.com/400x400/D4AF37/FFFFFF?text=Roti+Mentega" 
                         alt="Roti Mentega" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Roti Sobek Mentega Gula</h4>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-400 line-through">Rp 30.000</span>
                        <span class="text-2xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                </div>
            </div>
            
            <!-- Preview Card 3 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden cursor-pointer transform hover:scale-105 transition-all" onclick="openPromoModal()">
                <div class="relative">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold">
                        PROMO
                    </div>
                    <img src="https://via.placeholder.com/400x400/CD853F/FFFFFF?text=Roti+Pisang" 
                         alt="Roti Pisang" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Roti Sobek Pisang Coklat</h4>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-400 line-through">Rp 30.000</span>
                        <span class="text-2xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <button 
                onclick="openPromoModal()"
                class="inline-flex items-center space-x-2 px-8 py-4 bg-orange-500 text-white rounded-full text-lg font-bold hover:bg-orange-600 transition-all shadow-lg"
            >
                <span>Lihat Semua Promo</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </section>
    
    <!-- Include Promo Modal Component -->
    @include('components.promo-modal')
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 Toko Roti. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>
