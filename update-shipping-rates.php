<?php
/**
 * Helper Script: Update Shipping Rates (BASE_RATE, PER_KM_RATE, MAX_DISTANCE)
 * 
 * Cara pakai:
 * php update-shipping-rates.php [BASE_RATE] [PER_KM_RATE] [MAX_DISTANCE]
 * 
 * Contoh:
 * php update-shipping-rates.php 5000 2000 15
 */

if ($argc < 4) {
    echo "❌ Error: Parameter tidak lengkap!\n\n";
    echo "📍 Cara pakai:\n";
    echo "   php update-shipping-rates.php [BASE_RATE] [PER_KM_RATE] [MAX_DISTANCE]\n\n";
    echo "📝 Contoh:\n";
    echo "   php update-shipping-rates.php 5000 2000 15\n";
    echo "   (Base: Rp 5.000, Per KM: Rp 2.000, Max: 15 km)\n\n";
    echo "💡 Tips:\n";
    echo "   - Cek harga Grab/GoFood di daerah Anda\n";
    echo "   - Base rate: biaya minimum pengiriman\n";
    echo "   - Per KM rate: biaya tambahan per kilometer\n";
    echo "   - Max distance: jarak maksimal yang dilayani\n\n";
    exit(1);
}

$baseRate = intval($argv[1]);
$perKmRate = intval($argv[2]);
$maxDistance = intval($argv[3]);

if ($baseRate < 0 || $perKmRate < 0 || $maxDistance < 1) {
    echo "❌ Error: Nilai tidak valid!\n";
    echo "   Base Rate: $baseRate (harus >= 0)\n";
    echo "   Per KM Rate: $perKmRate (harus >= 0)\n";
    echo "   Max Distance: $maxDistance (harus >= 1)\n";
    exit(1);
}

echo "🔄 Updating shipping rates...\n\n";

// Update checkout-modern.js
$jsFile = 'public/js/checkout-modern.js';
if (!file_exists($jsFile)) {
    echo "❌ File tidak ditemukan: $jsFile\n";
    exit(1);
}

$jsContent = file_get_contents($jsFile);
$jsContent = preg_replace(
    '/const BASE_RATE = \d+;/',
    "const BASE_RATE = $baseRate;",
    $jsContent
);
$jsContent = preg_replace(
    '/const PER_KM_RATE = \d+;/',
    "const PER_KM_RATE = $perKmRate;",
    $jsContent
);
$jsContent = preg_replace(
    '/const MAX_DISTANCE = \d+;/',
    "const MAX_DISTANCE = $maxDistance;",
    $jsContent
);
file_put_contents($jsFile, $jsContent);
echo "✅ Updated: $jsFile\n";

echo "\n📊 Tarif Baru:\n";
echo "   Base Rate:    Rp " . number_format($baseRate, 0, ',', '.') . "\n";
echo "   Per KM Rate:  Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
echo "   Max Distance: $maxDistance km\n\n";

echo "🧮 Simulasi Harga:\n";
for ($km = 1; $km <= min(10, $maxDistance); $km++) {
    $price = $baseRate + ($km * $perKmRate);
    echo "   {$km} km  = Rp " . number_format($price, 0, ',', '.') . "\n";
}

echo "\n🎯 Langkah selanjutnya:\n";
echo "   1. Update database: php update-database.php\n";
echo "   2. Test di checkout page\n\n";
echo "✅ Selesai!\n";
