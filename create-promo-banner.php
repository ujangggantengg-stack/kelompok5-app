<?php
/**
 * Script untuk membuat Promo Banner
 * 
 * Cara pakai:
 * php create-promo-banner.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\PromoSetting;
use App\Models\PromoModalProduct;

echo "🔥 Creating Promo Banner...\n\n";

// Create or update promo banner
$promo = PromoSetting::first();

if ($promo) {
    echo "⚠️  Promo sudah ada! Update? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) != 'y') {
        echo "❌ Dibatalkan.\n";
        exit(0);
    }
}

$promoData = [
    'title' => "Roti Sobek Premium,\nLembut & Fresh!",
    'subtitle' => 'Roti sobek premium dengan tekstur lembut dan rasa yang menggugah selera.',
    'badge_text' => 'SPECIAL',
    'discount_badge_text' => 'HEMAT 3.000',
    'price_original' => 30000,
    'price_promo' => 26999,
    'is_active' => true,
    'end_time' => now()->addDays(7), // Promo 7 hari
    'image_main' => 'images/besar1.jpg',
    'image_second' => 'images/besar 2.jpg',
    'image_third' => 'images/besar 3.jpg',
];

if ($promo) {
    $promo->update($promoData);
    echo "✅ Promo banner updated!\n\n";
} else {
    $promo = PromoSetting::create($promoData);
    echo "✅ Promo banner created!\n\n";
}

echo "📊 Promo Details:\n";
echo "   Title: {$promo->title}\n";
echo "   Subtitle: {$promo->subtitle}\n";
echo "   Price Original: Rp " . number_format($promo->price_original, 0, ',', '.') . "\n";
echo "   Price Promo: Rp " . number_format($promo->price_promo, 0, ',', '.') . "\n";
echo "   Discount: Rp " . number_format($promo->price_original - $promo->price_promo, 0, ',', '.') . "\n";
echo "   Active: " . ($promo->is_active ? '✅ YES' : '❌ NO') . "\n";
echo "   End Time: {$promo->end_time}\n\n";

// Create promo modal products
echo "🛒 Creating Promo Modal Products...\n\n";

$modalProducts = [
    [
        'name' => 'Roti Sobek Coklat Keju',
        'subtitle' => 'BEST SELLER',
        'price_original' => 30000,
        'price_promo' => 27000,
        'badge' => 'PROMO',
        'stock_label' => 'Stok Terbatas',
        'bottom_label' => 'Lembut, manis, dan penuh coklat!',
        'image' => 'images/besar1.jpg',
        'order' => 1,
    ],
    [
        'name' => 'Roti Sobek Mentega Gula',
        'subtitle' => 'FAVORIT',
        'price_original' => 30000,
        'price_promo' => 27000,
        'badge' => 'PROMO',
        'stock_label' => 'Ready Stock',
        'bottom_label' => 'Gurih mentega dengan taburan gula!',
        'image' => 'images/besar 2.jpg',
        'order' => 2,
    ],
    [
        'name' => 'Roti Sobek Pisang Coklat',
        'subtitle' => 'NEW',
        'price_original' => 30000,
        'price_promo' => 27000,
        'badge' => 'PROMO',
        'stock_label' => 'Stok Terbatas',
        'bottom_label' => 'Kombinasi pisang dan coklat yang sempurna!',
        'image' => 'images/besar 3.jpg',
        'order' => 3,
    ],
];

// Delete existing modal products
PromoModalProduct::truncate();

foreach ($modalProducts as $product) {
    PromoModalProduct::create($product);
    echo "   ✅ {$product['name']} - Rp " . number_format($product['price_promo'], 0, ',', '.') . "\n";
}

echo "\n✅ Selesai!\n\n";
echo "🌐 Buka website untuk melihat promo banner:\n";
echo "   http://127.0.0.1:8000\n\n";
echo "⚠️  PENTING: Pastikan gambar promo ada di folder public/images/\n";
echo "   - public/images/besar1.jpg\n";
echo "   - public/images/besar 2.jpg\n";
echo "   - public/images/besar 3.jpg\n\n";
