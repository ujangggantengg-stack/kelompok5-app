<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Promo - Dapoer Budess</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-cream: #F5EDD8;
            --dark-brown: #3B1F0A;
            --promo-red: #E53E3E;
            --ready-green: #C6F6D5;
            --text-ready: #22543D;
            --shop-label: #A0522D;
        }

        body {
            background-color: var(--bg-cream);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            position: relative;
        }

        /* Subtle Batik Watermark Background for the whole page */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M60 0 L120 60 L60 120 L0 60 Z' fill='none' stroke='%233B1F0A' stroke-opacity='0.03' stroke-width='0.5'/%3E%3Ccircle cx='60' cy='60' r='12' fill='none' stroke='%233B1F0A' stroke-opacity='0.03' stroke-width='0.5'/%3E%3Cpath d='M0 0 L120 120 M120 0 L0 120' stroke='%233B1F0A' stroke-opacity='0.02' stroke-width='0.3'/%3E%3C/svg%3E");
            z-index: -1;
            pointer-events: none;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .product-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(59, 31, 10, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(59, 31, 10, 0.05);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(59, 31, 10, 0.12);
        }

        /* Batik watermark inside card */
        .card-content {
            padding: 1.5rem;
            position: relative;
            background-image: url("data:image/svg+xml,%3Csvg width='150' height='150' viewBox='0 0 150 150' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M75 0 L150 75 L75 150 L0 75 Z' fill='none' stroke='%233B1F0A' stroke-opacity='0.02' stroke-width='1'/%3E%3C/svg%3E");
            background-position: bottom right;
            background-repeat: no-repeat;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .aspect-4-3 {
            aspect-ratio: 4 / 3;
            width: 100%;
            object-fit: cover;
        }

        .badge-promo {
            background-color: var(--promo-red);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(229, 62, 62, 0.3);
        }

        .cart-icon-container {
            background: white;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            color: var(--dark-brown);
            transition: all 0.2s ease;
        }
        
        .cart-icon-container:hover {
            transform: scale(1.1);
            background: var(--bg-cream);
        }

        .shop-label {
            color: var(--shop-label);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.4rem;
            display: block;
        }

        .price-original {
            color: #9CA3AF;
            text-decoration: line-through;
            font-size: 0.95rem;
        }

        .price-promo {
            color: #D9480F; /* Orange-red blend */
            font-weight: 800;
            font-size: 1.4rem;
        }

        .badge-ready {
            background-color: var(--ready-green);
            color: var(--text-ready);
            padding: 0.35rem 0.9rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            margin-bottom: 0.6rem;
        }

        .status-text {
            font-size: 0.8rem;
            color: #4B5563;
            margin-bottom: 1.2rem;
            font-weight: 500;
        }

        .btn-buy {
            background-color: var(--dark-brown);
            color: white;
            width: 100%;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            margin-top: auto;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-buy:hover {
            background-color: #261406;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(59, 31, 10, 0.25);
        }

        .page-title {
            color: var(--dark-brown);
            margin-bottom: 3rem;
            text-align: center;
        }

        .page-title h1 {
            font-size: 3rem;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .page-title h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: var(--dark-brown);
            opacity: 0.3;
        }
    </style>
</head>
<body>
    
    <!-- Navbar (Optional based on typical layout) -->
    <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto">
        <a href="/" class="flex items-center gap-2 text-[#3B1F0A] font-bold text-xl">
            <span class="text-3xl">🍞</span>
            <span class="font-serif">Dapoer Budess</span>
        </a>
        <div class="space-x-6 hidden md:block">
            <a href="/" class="text-[#3B1F0A] hover:opacity-70 transition">Home</a>
            <a href="/products" class="text-[#3B1F0A] hover:opacity-70 transition font-semibold">Produk</a>
            <a href="/promo-page" class="text-[#D9480F] font-bold border-b-2 border-[#D9480F]">Promo</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="page-title">
            <h1 class="font-serif">Forum Promo Artisan</h1>
            <p class="mt-4 text-[#A0522D] font-medium italic">"Hangatnya tradisi dalam setiap gigitan fresh"</p>
        </div>
        
        <!-- GRID SYSTEM: 3 COLUMNS DESKTOP, 1 COLUMN MOBILE -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <!-- PRODUCT CARD 1 -->
            <div class="product-card">
                <div class="relative overflow-hidden">
                    <img src="/images/hero/enakk.jpg" alt="Roti Sobek Coklat Keju" class="aspect-4-3 hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label">ROTI ENAKS</span>
                    <h2 class="font-serif text-2xl font-bold mb-3 text-[#3B1F0A]">Roti Sobek Coklat Keju</h2>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo">Rp 27.000</span>
                    </div>

                    <div class="mb-2">
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">⚡ Promo terbatas!</p>

                    <button class="btn-buy">
                        <i class="fas fa-shopping-cart"></i> Beli
                    </button>
                </div>
            </div>

            <!-- PRODUCT CARD 2 -->
            <div class="product-card">
                <div class="relative overflow-hidden">
                    <img src="/images/hero/slide2.jpg" alt="ROTI GULA MANIS" class="aspect-4-3 hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label">ENAK</span>
                    <h2 class="font-serif text-2xl font-bold mb-3 text-[#3B1F0A]">ROTI GULA MANIS</h2>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo">Rp 27.000</span>
                    </div>

                    <div class="mb-2">
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">🔥 Stok menipis!</p>

                    <button class="btn-buy">
                        <i class="fas fa-shopping-cart"></i> Beli
                    </button>
                </div>
            </div>

            <!-- PRODUCT CARD 3 -->
            <div class="product-card">
                <div class="relative overflow-hidden">
                    <img src="/images/hero/slide3.jpg" alt="Roti Sobek Pisang Coklat" class="aspect-4-3 hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label">Produk Berkualitas Dari Dapoer Budess</span>
                    <h2 class="font-serif text-2xl font-bold mb-3 text-[#3B1F0A]">Roti Sobek Pisang Coklat</h2>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo">Rp 27.000</span>
                    </div>

                    <div class="mb-2">
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">✨ Fresh setiap hari!</p>

                    <button class="btn-buy">
                        <i class="fas fa-shopping-cart"></i> Beli
                    </button>
                </div>
            </div>

        </div>

        <div class="mt-20 text-center text-[#3B1F0A] opacity-60 text-sm">
            <p>&copy; 2026 Dapoer Budess - Artisan Bakery & Pastry</p>
            <div class="flex justify-center gap-4 mt-2">
                <i class="fab fa-instagram"></i>
                <i class="fab fa-whatsapp"></i>
                <i class="fas fa-map-marker-alt"></i>
            </div>
        </div>
    </div>
</body>
</html>
