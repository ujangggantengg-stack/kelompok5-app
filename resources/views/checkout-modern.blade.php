<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - Toko Roti</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initMap" async defer></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Floating Label Animation */
        .floating-label {
            position: relative;
        }
        
        .floating-label input:focus ~ label,
        .floating-label input:not(:placeholder-shown) ~ label,
        .floating-label textarea:focus ~ label,
        .floating-label textarea:not(:placeholder-shown) ~ label,
        .floating-label select:focus ~ label,
        .floating-label.has-value label {
            transform: translateY(-1.5rem) scale(0.85);
            color: #f97316;
            font-weight: 500;
        }
        
        .floating-label label {
            position: absolute;
            left: 2.75rem;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.2s ease;
            pointer-events: none;
            color: #9ca3af;
            background: white;
            padding: 0 0.25rem;
        }
        
        .floating-label textarea ~ label {
            top: 1.25rem;
            transform: translateY(0);
        }
        
        .floating-label textarea:focus ~ label,
        .floating-label textarea:not(:placeholder-shown) ~ label {
            transform: translateY(-2.5rem) scale(0.85);
        }
        
        /* Map Container */
        #map {
            height: 400px; /* Lebih tinggi untuk visibility lebih baik */
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        /* Map on mobile */
        @media (max-width: 768px) {
            #map {
                height: 300px;
            }
        }
        
        /* Chip/Badge Styles */
        .address-chip {
            transition: all 0.2s ease;
        }
        
        .address-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .address-chip.active {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            border-color: #f97316;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Loading Animation */
        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #f97316;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fcd34d 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center space-x-2">
                    <i class="fas fa-bread-slice text-orange-500 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">Toko Roti</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Checkout</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        
        <form id="checkoutForm" method="POST" action="/checkout/process">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column: Forms -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Section 1: Detail Penerima -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">Detail Penerima</h2>
                                <p class="text-sm text-gray-500">Informasi kontak penerima pesanan</p>
                            </div>
                        </div>
                        
                        <div class="space-y-5">
                            <!-- Nama Penerima -->
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="recipient_name" 
                                        name="recipient_name"
                                        placeholder=" "
                                        required
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="recipient_name">Nama Lengkap Penerima</label>
                                </div>
                            </div>
                            
                            <!-- Nomor Telepon -->
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="tel" 
                                        id="phone" 
                                        name="phone"
                                        placeholder=" "
                                        required
                                        pattern="[0-9]{10,13}"
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="phone">Nomor WhatsApp</label>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 ml-11">Format: 08xxxxxxxxxx</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 2: Lokasi Pengiriman -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">Lokasi Pengiriman</h2>
                                    <p class="text-sm text-gray-500">Tentukan lokasi pengiriman Anda</p>
                                </div>
                            </div>
                            <button 
                                type="button" 
                                id="detectLocationBtn"
                                class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg"
                            >
                                <i class="fas fa-crosshairs"></i>
                                <span class="text-sm font-medium">Deteksi Lokasi</span>
                            </button>
                        </div>
                        
                        <!-- Map Picker -->
                        <div class="mb-5">
                            <div class="relative">
                                <div id="map" class="border-2 border-gray-200"></div>
                                <!-- Map Legend -->
                                <div class="absolute top-4 left-4 bg-white rounded-lg shadow-lg p-3 z-10">
                                    <div class="flex items-center space-x-2 text-xs">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <span class="text-gray-700 font-medium">Pin Lokasi Anda</span>
                                    </div>
                                    <div class="flex items-center space-x-2 text-xs mt-2">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <span class="text-gray-700 font-medium">Lokasi Toko</span>
                                    </div>
                                </div>
                                <!-- Accuracy Indicator -->
                                <div id="accuracyIndicator" class="absolute bottom-4 left-4 bg-white rounded-lg shadow-lg px-3 py-2 z-10 hidden">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-bullseye text-green-500"></i>
                                        <span class="text-xs font-medium text-gray-700">Akurasi: <span id="accuracyValue">-</span>m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-xs text-blue-800 flex items-start">
                                    <i class="fas fa-info-circle mr-2 mt-0.5"></i>
                                    <span><strong>Tips:</strong> Geser pin merah untuk menyesuaikan lokasi yang tepat. Zoom in untuk detail lebih akurat!</span>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Koordinat (Hidden) -->
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        
                        <!-- Label Alamat -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Label Alamat</label>
                            <div class="flex flex-wrap gap-3">
                                <button 
                                    type="button" 
                                    class="address-chip px-4 py-2 border-2 border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-orange-500"
                                    data-label="Rumah"
                                >
                                    <i class="fas fa-home mr-2"></i>Rumah
                                    </button>
                                <button 
                                    type="button" 
                                    class="address-chip px-4 py-2 border-2 border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-orange-500"
                                    data-label="Kantor"
                                >
                                    <i class="fas fa-briefcase mr-2"></i>Kantor
                                </button>
                                <button 
                                    type="button" 
                                    class="address-chip px-4 py-2 border-2 border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-orange-500"
                                    data-label="Kos"
                                >
                                    <i class="fas fa-bed mr-2"></i>Kos
                                </button>
                                <button 
                                    type="button" 
                                    class="address-chip px-4 py-2 border-2 border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:border-orange-500"
                                    data-label="Lainnya"
                                >
                                    <i class="fas fa-map-pin mr-2"></i>Lainnya
                                </button>
                            </div>
                            <input type="hidden" id="address_label" name="address_label" value="Rumah">
                        </div>
                        
                        <!-- Alamat Lengkap (Auto-filled from GPS) -->
                        <div class="floating-label mb-5">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marked-alt text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="full_address" 
                                    name="full_address"
                                    placeholder=" "
                                    required
                                    readonly
                                    class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-50 cursor-not-allowed"
                                >
                                <label for="full_address">Alamat dari GPS</label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ml-11">Alamat ini terdeteksi otomatis dari lokasi Anda</p>
                        </div>
                        
                        <!-- Detail Alamat -->
                        <div class="floating-label mb-5">
                            <div class="relative">
                                <div class="absolute top-4 left-0 pl-4 pointer-events-none">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <textarea 
                                    id="address_detail" 
                                    name="address_detail"
                                    placeholder=" "
                                    required
                                    rows="3"
                                    class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none resize-none"
                                ></textarea>
                                <label for="address_detail">Detail Alamat (Nama Jalan, No. Rumah, Patokan)</label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ml-11">Contoh: Jl. Merdeka No. 123, dekat Indomaret</p>
                        </div>
                        
                        <!-- Kota/Kecamatan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-city text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="city" 
                                        name="city"
                                        placeholder=" "
                                        required
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="city">Kota/Kabupaten</label>
                                </div>
                            </div>
                            
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-map text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="district" 
                                        name="district"
                                        placeholder=" "
                                        required
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="district">Kecamatan</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Provinsi & Kode Pos -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="province" 
                                        name="province"
                                        placeholder=" "
                                        required
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="province">Provinsi</label>
                                </div>
                            </div>
                            
                            <div class="floating-label">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-mail-bulk text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="postal_code" 
                                        name="postal_code"
                                        placeholder=" "
                                        pattern="[0-9]{5}"
                                        class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                                    >
                                    <label for="postal_code">Kode Pos</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Checkbox: Alamat Utama -->
                        <div class="mt-5 flex items-center">
                            <input 
                                type="checkbox" 
                                id="is_primary" 
                                name="is_primary"
                                class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
                            >
                            <label for="is_primary" class="ml-3 text-sm text-gray-700">
                                <i class="fas fa-star text-yellow-500 mr-1"></i>
                                Simpan sebagai alamat utama
                            </label>
                        </div>
                    </div>
                    
                    <!-- Section 3: Metode Pembayaran -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-credit-card text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">Metode Pembayaran</h2>
                                <p class="text-sm text-gray-500">Pilih cara pembayaran Anda</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <!-- QRIS -->
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-500 transition-all">
                                <input type="radio" name="payment_method" value="qris" class="w-5 h-5 text-orange-500" required>
                                <div class="ml-4 flex items-center justify-between flex-1">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-qrcode text-2xl text-orange-500"></i>
                                        <div>
                                            <p class="font-medium text-gray-800">QRIS</p>
                                            <p class="text-xs text-gray-500">Scan & bayar dengan e-wallet</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <!-- Transfer Bank -->
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-500 transition-all">
                                <input type="radio" name="payment_method" value="bank_transfer" class="w-5 h-5 text-orange-500">
                                <div class="ml-4 flex items-center justify-between flex-1">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-university text-2xl text-blue-500"></i>
                                        <div>
                                            <p class="font-medium text-gray-800">Transfer Bank</p>
                                            <p class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <!-- COD -->
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-500 transition-all">
                                <input type="radio" name="payment_method" value="cod" class="w-5 h-5 text-orange-500">
                                <div class="ml-4 flex items-center justify-between flex-1">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-money-bill-wave text-2xl text-green-500"></i>
                                        <div>
                                            <p class="font-medium text-gray-800">Bayar di Tempat (COD)</p>
                                            <p class="text-xs text-gray-500">Bayar saat pesanan tiba</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                        
                        <!-- Order Items -->
                        <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <img src="https://via.placeholder.com/60" alt="Product" class="w-14 h-14 rounded-lg object-cover">
                                <div class="flex-1">
                                    <p class="font-medium text-sm text-gray-800">Roti Cokelat</p>
                                    <p class="text-xs text-gray-500">2x Rp 15.000</p>
                                </div>
                                <p class="font-bold text-orange-500">Rp 30.000</p>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4 space-y-3">
                            <!-- Subtotal -->
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800" id="subtotal">Rp 30.000</span>
                            </div>
                            
                            <!-- Shipping -->
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ongkir</span>
                                <span class="font-medium text-gray-800" id="shipping_cost">
                                    <span class="loading-spinner inline-block"></span>
                                </span>
                            </div>
                            
                            <!-- Distance -->
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Jarak</span>
                                <span id="distance">-</span>
                            </div>
                            
                            <!-- Total -->
                            <div class="flex justify-between text-lg font-bold pt-3 border-t">
                                <span class="text-gray-800">Total</span>
                                <span class="text-orange-500" id="total">Rp 30.000</span>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full mt-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submitBtn"
                        >
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Buat Pesanan
                        </button>
                        
                        <p class="text-xs text-center text-gray-500 mt-4">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Transaksi Anda aman & terenkripsi
                        </p>
                    </div>
                </div>
                
            </div>
        </form>
        
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t mt-12 py-6">
        <div class="container mx-auto px-4 text-center text-sm text-gray-600">
            <p>&copy; 2026 Toko Roti. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Checkout Modern Enhanced JS -->
    <script src="{{ asset('js/checkout-modern-enhanced.js') }}"></script>
    
    <script>
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // initMap() will be called automatically by Google Maps API callback
            initAddressChips();
            initFloatingLabels();
        });
    </script>
    
</body>
</html>
