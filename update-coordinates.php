<?php
/**
 * Helper Script: Update Store Coordinates
 * 
 * Cara pakai:
 * 1. Dapatkan koordinat dari Google Maps
 * 2. Jalankan: php update-coordinates.php -6.123456 106.789012
 */

if ($argc < 3) {
    echo "❌ Error: Koordinat tidak lengkap!\n\n";
    echo "📍 Cara pakai:\n";
    echo "   php update-coordinates.php [LATITUDE] [LONGITUDE]\n\n";
    echo "📝 Contoh:\n";
    echo "   php update-coordinates.php -6.5971469 106.8060394\n\n";
    echo "🗺️  Cara dapat koordinat dari Google Maps:\n";
    echo "   1. Buka https://maps.google.com\n";
    echo "   2. Cari alamat toko roti Anda\n";
    echo "   3. Klik kanan pada pin merah\n";
    echo "   4. Pilih koordinat yang muncul (akan auto-copy)\n";
    echo "   5. Format: -6.123456, 106.789012\n\n";
    exit(1);
}

$lat = floatval($argv[1]);
$lng = floatval($argv[2]);

// Validasi koordinat Indonesia
if ($lat > 0 || $lat < -11 || $lng < 95 || $lng > 141) {
    echo "⚠️  Warning: Koordinat sepertinya bukan di Indonesia!\n";
    echo "   Latitude: $lat (seharusnya antara -11 sampai 6)\n";
    echo "   Longitude: $lng (seharusnya antara 95 sampai 141)\n";
    echo "\n❓ Lanjutkan? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) != 'y') {
        echo "❌ Dibatalkan.\n";
        exit(1);
    }
}

echo "🔄 Updating coordinates...\n\n";

// Update checkout-modern.js
$jsFile = 'public/js/checkout-modern.js';
if (!file_exists($jsFile)) {
    echo "❌ File tidak ditemukan: $jsFile\n";
    exit(1);
}

$jsContent = file_get_contents($jsFile);
$jsContent = preg_replace(
    '/const STORE_LAT = -?\d+\.?\d*;/',
    "const STORE_LAT = $lat;",
    $jsContent
);
$jsContent = preg_replace(
    '/const STORE_LNG = -?\d+\.?\d*;/',
    "const STORE_LNG = $lng;",
    $jsContent
);
file_put_contents($jsFile, $jsContent);
echo "✅ Updated: $jsFile\n";

// Update ShippingCalculator.php
$phpFile = 'app/Services/ShippingCalculator.php';
if (!file_exists($phpFile)) {
    echo "❌ File tidak ditemukan: $phpFile\n";
    exit(1);
}

$phpContent = file_get_contents($phpFile);
$phpContent = preg_replace(
    '/private \$storeLat = -?\d+\.?\d*;/',
    "private \$storeLat = $lat;",
    $phpContent
);
$phpContent = preg_replace(
    '/private \$storeLng = -?\d+\.?\d*;/',
    "private \$storeLng = $lng;",
    $phpContent
);
file_put_contents($phpFile, $phpContent);
echo "✅ Updated: $phpFile\n";

echo "\n📊 Verifikasi:\n";
echo "   Latitude:  $lat\n";
echo "   Longitude: $lng\n";
echo "\n🎯 Langkah selanjutnya:\n";
echo "   1. Update database dengan koordinat ini\n";
echo "   2. Jalankan: php update-database.php\n";
echo "   3. Test GPS di checkout page\n\n";
echo "✅ Selesai!\n";
