<?php

use App\Models\PromoBanner;
use App\Models\Product;
use App\Models\PromoProduct;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create default banner
$banner = PromoBanner::create([
    'title' => "Roti Sobek\nPremium,\nLembut & Fresh!",
    'subtitle' => 'Roti sobek premium dengan tekstur lembut dan rasa yang menggugah selera. Sempurna untuk sarapan atau camilan Anda!',
    'price_original' => 35000,
    'price_promo' => 28000,
    'badge_text' => '🔥 Spesial Hari Ini!',
    'discount_badge_text' => '💎 Hemat 20%',
    'is_active' => true,
    'end_time' => now()->addDays(7),
    'background_image' => 'https://images.unsplash.com/photo-1589569444360-61ed59c6e2be?q=80&w=1170&auto=format&fit=crop',
    'image_main' => 'images/besar1.jpg',
    'image_second' => 'images/besar 2.jpg',
    'image_third' => 'images/besar 3.jpg',
]);

// Add some products to the banner modal
$products = Product::take(3)->get();
foreach ($products as $index => $product) {
    PromoProduct::create([
        'promo_banner_id' => $banner->id,
        'product_id' => $product->id,
        'order' => $index
    ]);
}

echo "Default banner created successfully!\n";
