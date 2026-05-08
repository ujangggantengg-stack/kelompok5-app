<!-- Promo Modal Component -->
<div id="promoModal" class="fixed inset-0 bg-black/80 z-[10000] hidden flex items-center justify-center p-4 backdrop-blur-md">
    <!-- Modal Container with Cream Background -->
    <div style="background-color: #F5EDD8 !important; border-radius: 40px; max-width: 1200px; width: 100%; max-height: 90vh; overflow: hidden; position: relative; box-shadow: 0 35px 60px -15px rgba(0,0,0,0.6); display: flex; flex-direction: column;">
        
        <!-- Subtle Batik Background Overlay -->
        <div style="position: absolute; inset: 0; opacity: 0.08; pointer-events: none; z-index: 0; background-image: url('data:image/svg+xml,%3Csvg width=\'150\' height=\'150\' viewBox=\'0 0 150 150\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M75 0 L150 75 L75 150 L0 75 Z\' fill=\'none\' stroke=\'%233B1F0A\' stroke-width=\'1.5\'/%3E%3Ccircle cx=\'75\' cy=\'75\' r=\'20\' fill=\'none\' stroke=\'%233B1F0A\' stroke-width=\'1\'/%3E%3Cpath d=\'M0 0 L150 150 M150 0 L0 150\' stroke=\'%233B1F0A\' stroke-width=\'0.5\'/%3E%3C/svg%3E'); background-repeat: repeat;"></div>

        <!-- Close Button -->
        <button onclick="closePromoModal()" style="position: absolute; top: 24px; right: 24px; width: 48px; height: 48px; background-color: white; border-radius: 50%; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; z-index: 100; transition: all 0.3s ease;">
            <i class="fas fa-times" style="color: #666; font-size: 24px;"></i>
        </button>
        
        <!-- Scrollable Content -->
        <div class="custom-modal-scrollbar" style="overflow-y: auto; flex-grow: 1; z-index: 10; position: relative; display: flex; flex-direction: column;">
            
            <!-- Header Section -->
            <div style="text-align: center; padding-top: 48px; padding-bottom: 32px; padding-left: 16px; padding-right: 16px;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 32px;">
                    <span style="font-size: 48px;" class="animate-pulse">🔥</span>
                    <h2 style="font-size: 42px; font-weight: 800; color: #3B1F0A; font-family: 'Playfair Display', serif; margin: 0;">
                        Pilih Roti Promo Hari Ini
                    </h2>
                </div>
                
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 16px;">
                    <!-- Cart Button -->
                    <button onclick="window.location.href='/cart'" style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 32px; background-color: white; border: 2px solid #D2B48C; border-radius: 50px; font-weight: 700; color: #3B1F0A; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05); font-family: 'Outfit', sans-serif;">
                        <i class="fas fa-shopping-cart" style="color: #A0522D;"></i>
                        <span>Lihat Keranjang ( <span id="cartCount" style="color: #D9480F;">0</span> )</span>
                    </button>

                    <!-- Finish Button -->
                    <button onclick="closePromoModal()" style="display: inline-flex; align-items: center; gap: 12px; padding: 12px 32px; background-color: #3B1F0A; color: white; border-radius: 50px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(59, 31, 10, 0.4); transition: all 0.3s; font-family: 'Outfit', sans-serif;">
                        <i class="fas fa-check"></i>
                        <span>Selesai Belanja</span>
                    </button>
                </div>
            </div>
            
            <!-- Grid System -->
            <div class="grid-promo-artisan">
                
                <!-- Card 1 -->
                <div class="artisan-promo-card">
                    <div class="card-image-box">
                        <img src="/images/hero/enakk.jpg" alt="Roti Sobek Coklat Keju">
                        <span class="card-badge-promo-tag">PROMO</span>
                        <div class="card-cart-icon-float">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    
                    <div class="card-info-box">
                        <span class="card-label-artisan">Produk Berkualitas Dari Dapoer Budess</span>
                        <h3 class="card-product-name">Roti Sobek Coklat Keju</h3>
                        
                        <div class="card-price-container">
                            <span class="price-grey-old">Rp 30.000</span>
                            <span class="price-red-promo">Rp 27.000</span>
                        </div>

                        <div style="margin-bottom: 12px;">
                            <span class="card-ready-badge">Ready Hari Ini 🍞</span>
                        </div>
                        
                        <p class="card-status-small">⚡ Promo terbatas!</p>

                        <button class="card-btn-buy-artisan">
                            🛒 Beli
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="artisan-promo-card">
                    <div class="card-image-box">
                        <img src="/images/hero/slide2.jpg" alt="ROTI GULA MANIS">
                        <span class="card-badge-promo-tag">PROMO</span>
                        <div class="card-cart-icon-float">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    
                    <div class="card-info-box">
                        <span class="card-label-artisan">Rasa Premium yang Bikin Nagih di Setiap Gigitan.</span>
                        <h3 class="card-product-name">ROTI GULA MANIS</h3>
                        
                        <div class="card-price-container">
                            <span class="price-grey-old">Rp 30.000</span>
                            <span class="price-red-promo">Rp 27.000</span>
                        </div>

                        <div style="margin-bottom: 12px;">
                            <span class="card-ready-badge">Ready Hari Ini 🍞</span>
                        </div>
                        
                        <p class="card-status-small">🔥 Stok menipis!</p>

                        <button class="card-btn-buy-artisan">
                            🛒 Beli
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="artisan-promo-card">
                    <div class="card-image-box">
                        <img src="/images/hero/slide3.jpg" alt="Roti Sobek Pisang Coklat">
                        <span class="card-badge-promo-tag">PROMO</span>
                        <div class="card-cart-icon-float">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    
                    <div class="card-info-box">
                        <span class="card-label-artisan">Hangat, Lembut, dan Dibuat dengan Cinta Khusus untuk Anda.</span>
                        <h3 class="card-product-name">Roti Sobek Pisang Coklat</h3>
                        
                        <div class="card-price-container">
                            <span class="price-grey-old">Rp 30.000</span>
                            <span class="price-red-promo">Rp 27.000</span>
                        </div>

                        <div style="margin-bottom: 12px;">
                            <span class="card-ready-badge">Ready Hari Ini 🍞</span>
                        </div>
                        
                        <p class="card-status-small">✨ Fresh setiap hari!</p>

                        <button class="card-btn-buy-artisan">
                            🛒 Beli
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Grid System: 3 Columns Desktop, 1 Column Mobile */
    .grid-promo-artisan {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 48px;
    }
    @media (max-width: 768px) {
        .grid-promo-artisan {
            grid-template-columns: 1fr;
        }
    }

    /* Product Card Styles */
    .artisan-promo-card {
        background-color: white;
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 30px -5px rgba(59, 31, 10, 0.1);
        transition: all 0.4s ease;
        border: 1px solid rgba(59, 31, 10, 0.05);
    }
    .artisan-promo-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(59, 31, 10, 0.2);
    }

    /* Image Section */
    .card-image-box {
        position: relative;
        width: 100%;
        aspect-ratio: 4/3;
        overflow: hidden;
    }
    .card-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .artisan-promo-card:hover .card-image-box img {
        transform: scale(1.1);
    }

    /* Badges & Icons */
    .card-badge-promo-tag {
        position: absolute;
        top: 16px;
        left: 16px;
        background-color: #E53E3E;
        color: white;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(229, 62, 62, 0.3);
    }
    .card-cart-icon-float {
        position: absolute;
        top: 16px;
        right: 16px;
        background-color: white;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3B1F0A;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: all 0.3s;
    }
    .card-cart-icon-float:hover {
        background-color: #3B1F0A;
        color: white;
    }

    /* Info Section */
    .card-info-box {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L100 50 L50 100 L0 50 Z' fill='none' stroke='%233B1F0A' stroke-opacity='0.02' stroke-width='1'/%3E%3C/svg%3E");
        background-position: bottom right;
        background-repeat: no-repeat;
    }
    .card-label-artisan {
        color: #A0522D;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        display: block;
        font-family: 'Outfit', sans-serif;
    }
    .card-product-name {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        color: #3B1F0A;
        margin-bottom: 12px;
        line-height: 1.2;
    }
    .card-price-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .price-grey-old {
        color: #9CA3AF;
        text-decoration: line-through;
        font-size: 14px;
        font-family: 'Outfit', sans-serif;
    }
    .price-red-promo {
        color: #D9480F;
        font-size: 22px;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
    }
    .card-ready-badge {
        background-color: #C6F6D5;
        color: #22543D;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: 'Outfit', sans-serif;
    }
    .card-status-small {
        font-size: 13px;
        color: #4B5563;
        margin-bottom: 24px;
        font-family: 'Outfit', sans-serif;
        font-weight: 500;
    }
    .card-btn-buy-artisan {
        width: 100%;
        background-color: #3B1F0A;
        color: white;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: auto;
        font-family: 'Outfit', sans-serif;
    }
    .card-btn-buy-artisan:hover {
        background-color: #261406;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(59, 31, 10, 0.4);
    }

    /* Custom Scrollbar */
    .custom-modal-scrollbar::-webkit-scrollbar {
        width: 10px;
    }
    .custom-modal-scrollbar::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    .custom-modal-scrollbar::-webkit-scrollbar-thumb {
        background: #D2B48C;
        border-radius: 10px;
        border: 2px solid #F5EDD8;
    }
    .custom-modal-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #A0522D;
    }
</style>

<script>
    function openPromoModal() {
        const modal = document.getElementById('promoModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closePromoModal() {
        const modal = document.getElementById('promoModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePromoModal();
    });
    
    document.getElementById('promoModal')?.addEventListener('click', function(e) {
        if (e.target === this) closePromoModal();
    });
</script>