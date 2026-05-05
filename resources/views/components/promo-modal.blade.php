<!-- Promo Modal Component -->
<div id="promoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl max-w-6xl w-full max-h-[90vh] overflow-y-auto relative shadow-2xl">
        
        <!-- Close Button -->
        <button onclick="closePromoModal()" class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-100 transition-all z-10">
            <i class="fas fa-times text-gray-600 text-xl"></i>
        </button>
        
        <!-- Header -->
        <div class="text-center py-8 px-4">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <span class="text-5xl">🔥</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800" style="font-family: 'Georgia', serif;">
                    Pilih Roti Promo Hari Ini
                </h2>
            </div>
            
            <!-- Cart Button -->
            <button onclick="window.location.href='/cart'" class="inline-flex items-center space-x-2 px-6 py-3 bg-white border-2 border-orange-300 rounded-full hover:bg-orange-50 transition-all shadow-md">
                <i class="fas fa-shopping-cart text-orange-500"></i>
                <span class="font-medium text-gray-700">Lihat Keranjang (</span>
                <span id="cartCount" class="font-bold text-orange-500">0</span>
                <span class="font-medium text-gray-700">)</span>
            </button>
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 pb-8">
            
            <!-- Product Card 1: Roti Sobek Coklat Keju -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                <!-- Image Container -->
                <div class="relative">
                    <!-- Promo Badge -->
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg z-10">
                        PROMO
                    </div>
                    
                    <!-- Add to Cart Button -->
                    <button class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all z-10">
                        <i class="fas fa-plus text-xl"></i>
                    </button>
                    
                    <!-- Product Image -->
                    <div class="aspect-square bg-gradient-to-br from-amber-100 to-orange-100 p-6">
                        <img src="https://via.placeholder.com/400x400/8B4513/FFFFFF?text=Roti+Sobek+Coklat" 
                             alt="Roti Sobek Coklat Keju" 
                             class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-6">
                    <!-- Category -->
                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-2" style="font-family: 'Arial', sans-serif;">
                        Produk Berkualitas dari Dapoer Budess
                    </p>
                    
                    <!-- Product Name -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-3" style="font-family: 'Georgia', serif;">
                        ROTI SOBEK COKLAT KEJU
                    </h3>
                    
                    <!-- Price -->
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-gray-400 line-through text-sm">Rp 30.000</span>
                        <span class="text-3xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="inline-flex items-center space-x-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            <span>Ready Hari Ini</span>
                            <span>🍞</span>
                        </span>
                    </div>
                    
                    <!-- Info -->
                    <p class="text-sm text-orange-600 flex items-center space-x-2 mb-4">
                        <i class="fas fa-bolt"></i>
                        <span class="font-medium">Promo terbatas!</span>
                    </p>
                    
                    <!-- Buy Button -->
                    <button class="w-full py-4 bg-gradient-to-r from-amber-800 to-amber-900 text-white rounded-xl font-bold text-lg hover:from-amber-900 hover:to-amber-950 transition-all shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Beli</span>
                    </button>
                </div>
            </div>
            
            <!-- Product Card 2: Roti Sobek Mentega Gula -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                <div class="relative">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg z-10">
                        PROMO
                    </div>
                    <button class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all z-10">
                        <i class="fas fa-plus text-xl"></i>
                    </button>
                    <div class="aspect-square bg-black p-6">
                        <img src="https://via.placeholder.com/400x400/D4AF37/FFFFFF?text=Roti+Mentega" 
                             alt="Roti Sobek Mentega Gula" 
                             class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">
                        Rasa Premium yang Bikin Nagih di Setiap Gigitan
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3" style="font-family: 'Georgia', serif;">
                        ROTI SOBEK MENTEGA GULA
                    </h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-gray-400 line-through text-sm">Rp 30.000</span>
                        <span class="text-3xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="inline-flex items-center space-x-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            <span>Ready Hari Ini</span>
                            <span>🍞</span>
                        </span>
                    </div>
                    <p class="text-sm text-orange-600 flex items-center space-x-2 mb-4">
                        <i class="fas fa-fire"></i>
                        <span class="font-medium">Stok menipis!</span>
                    </p>
                    <button class="w-full py-4 bg-gradient-to-r from-amber-800 to-amber-900 text-white rounded-xl font-bold text-lg hover:from-amber-900 hover:to-amber-950 transition-all shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Beli</span>
                    </button>
                </div>
            </div>
            
            <!-- Product Card 3: Roti Sobek Pisang Coklat -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                <div class="relative">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg z-10">
                        PROMO
                    </div>
                    <button class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all z-10">
                        <i class="fas fa-plus text-xl"></i>
                    </button>
                    <div class="aspect-square bg-gradient-to-br from-orange-100 to-amber-100 p-6">
                        <img src="https://via.placeholder.com/400x400/CD853F/FFFFFF?text=Roti+Pisang" 
                             alt="Roti Sobek Pisang Coklat" 
                             class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">
                        Hangat, Lembut, dan Dibuat dengan Cinta Khusus untuk Anda
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3" style="font-family: 'Georgia', serif;">
                        ROTI SOBEK PISANG COKLAT
                    </h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-gray-400 line-through text-sm">Rp 30.000</span>
                        <span class="text-3xl font-bold text-orange-500">Rp 27.000</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="inline-flex items-center space-x-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            <span>Ready Hari Ini</span>
                            <span>🍞</span>
                        </span>
                    </div>
                    <p class="text-sm text-orange-600 flex items-center space-x-2 mb-4">
                        <i class="fas fa-leaf"></i>
                        <span class="font-medium">Fresh setiap hari!</span>
                    </p>
                    <button class="w-full py-4 bg-gradient-to-r from-amber-800 to-amber-900 text-white rounded-xl font-bold text-lg hover:from-amber-900 hover:to-amber-950 transition-all shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Beli</span>
                    </button>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<style>
    /* Custom scrollbar for modal */
    #promoModal::-webkit-scrollbar {
        width: 8px;
    }
    
    #promoModal::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    #promoModal::-webkit-scrollbar-thumb {
        background: #f97316;
        border-radius: 4px;
    }
    
    #promoModal::-webkit-scrollbar-thumb:hover {
        background: #ea580c;
    }
</style>

<script>
    // Open modal
    function openPromoModal() {
        document.getElementById('promoModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    // Close modal
    function closePromoModal() {
        document.getElementById('promoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePromoModal();
        }
    });
    
    // Close on backdrop click
    document.getElementById('promoModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closePromoModal();
        }
    });
</script>
