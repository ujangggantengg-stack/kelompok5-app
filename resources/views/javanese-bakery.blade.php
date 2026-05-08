<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Roti Tradisional - Dapoer Budess</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
            padding: 2rem 1rem;
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
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L100 50 L50 100 L0 50 Z' fill='none' stroke='%233B1F0A' stroke-opacity='0.03' stroke-width='0.5'/%3E%3Ccircle cx='50' cy='50' r='10' fill='none' stroke='%233B1F0A' stroke-opacity='0.03' stroke-width='0.5'/%3E%3C/svg%3E");
            z-index: -1;
            pointer-events: none;
        }

        .product-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(59, 31, 10, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(59, 31, 10, 0.15);
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

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .aspect-4-3 {
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }

        .btn-buy {
            background-color: var(--dark-brown);
            color: white;
            width: 100%;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background-color 0.3s ease;
            margin-top: auto;
        }

        .btn-buy:hover {
            background-color: #4e2b0e;
        }

        .badge-promo {
            background-color: var(--promo-red);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .cart-icon-container {
            background: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            color: var(--dark-brown);
        }

        .shop-label {
            color: var(--shop-label);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
            display: block;
        }

        .price-original {
            color: #9CA3AF;
            text-decoration: line-through;
            font-size: 0.9rem;
        }

        .price-promo {
            color: var(--promo-red);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .badge-ready {
            background-color: var(--ready-green);
            color: var(--text-ready);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .status-text {
            font-size: 0.75rem;
            color: #4B5563;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="max-w-6xl mx-auto">
        <h1 class="font-serif text-4xl text-center mb-12 text-[#3B1F0A]">Katalog Roti Artisan</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="product-card">
                <div class="relative">
                    <img src="/images/hero/enakk.jpg" alt="Roti Sobek Coklat Keju" class="w-full aspect-4-3">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label">ROTI ENAKS</span>
                    <h2 class="font-serif text-2xl font-bold mb-2 text-[#3B1F0A]">Roti Sobek Coklat Keju</h2>
                    
                    <div class="flex items-center gap-3 mb-3">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo text-orange-600">Rp 27.000</span>
                    </div>

                    <div>
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">⚡ Promo terbatas!</p>

                    <button class="btn-buy">
                        <i class="fas fa-cart-plus"></i> Beli
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="product-card">
                <div class="relative">
                    <img src="/images/hero/slide2.jpg" alt="ROTI GULA MANIS" class="w-full aspect-4-3">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label">ENAK</span>
                    <h2 class="font-serif text-2xl font-bold mb-2 text-[#3B1F0A]">ROTI GULA MANIS</h2>
                    
                    <div class="flex items-center gap-3 mb-3">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo text-orange-600">Rp 27.000</span>
                    </div>

                    <div>
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">🔥 Stok menipis!</p>

                    <button class="btn-buy">
                        <i class="fas fa-cart-plus"></i> Beli
                    </button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="product-card">
                <div class="relative">
                    <img src="/images/hero/slide3.jpg" alt="Roti Sobek Pisang Coklat" class="w-full aspect-4-3">
                    <div class="absolute top-4 left-4">
                        <span class="badge-promo">PROMO</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="cart-icon-container">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <span class="shop-label uppercase text-[10px]">Produk Berkualitas Dari Dapoer Budess</span>
                    <h2 class="font-serif text-2xl font-bold mb-2 text-[#3B1F0A]">Roti Sobek Pisang Coklat</h2>
                    
                    <div class="flex items-center gap-3 mb-3">
                        <span class="price-original">Rp 30.000</span>
                        <span class="price-promo text-orange-600">Rp 27.000</span>
                    </div>

                    <div>
                        <span class="badge-ready">Ready Hari Ini 🍞</span>
                    </div>
                    
                    <p class="status-text">✨ Fresh setiap hari!</p>

                    <button class="btn-buy">
                        <i class="fas fa-cart-plus"></i> Beli
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
