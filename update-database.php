<?php
/**
 * Helper Script: Update Database with Store Coordinates
 * 
 * Cara pakai:
 * php update-database.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ShippingRate;

echo "🔄 Updating database...\n\n";

// Baca koordinat dari file
$jsFile = 'public/js/checkout-modern.js';
$jsContent = file_get_contents($jsFile);

preg_match('/const STORE_LAT = (-?\d+\.?\d*);/', $jsContent, $latMatch);
preg_match('/const STORE_LNG = (-?\d+\.?\d*);/', $jsContent, $lngMatch);
preg_match('/const BASE_RATE = (\d+);/', $jsContent, $baseMatch);
preg_match('/const PER_KM_RATE = (\d+);/', $jsContent, $perKmMatch);
preg_match('/const MAX_DISTANCE = (\d+);/', $jsContent, $maxDistMatch);

$lat = floatval($latMatch[1] ?? 0);
$lng = floatval($lngMatch[1] ?? 0);
$baseRate = intval($baseMatch[1] ?? 5000);
$perKmRate = intval($perKmMatch[1] ?? 2000);
$maxDistance = intval($maxDistMatch[1] ?? 15);

if ($lat == 0 || $lng == 0) {
    echo "❌ Error: Koordinat tidak valid!\n";
    echo "   Jalankan dulu: php update-coordinates.php [LAT] [LNG]\n";
    exit(1);
}

echo "📍 Koordinat dari file:\n";
echo "   Latitude:  $lat\n";
echo "   Longitude: $lng\n";
echo "   Base Rate: Rp " . number_format($baseRate, 0, ',', '.') . "\n";
echo "   Per KM:    Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
echo "   Max Dist:  $maxDistance km\n\n";

// Update atau create shipping rate
$rate = ShippingRate::first();

if (!$rate) {
    echo "📦 Membuat shipping rate baru...\n";
    $rate = new ShippingRate();
    $rate->region_name = 'Otomatis (GPS)';
    $rate->cost = 0;
    $rate->type = 'distance';
    $rate->is_active = true;
}

$rate->store_latitude = $lat;
$rate->store_longitude = $lng;
$rate->base_rate = $baseRate;
$rate->per_km_rate = $perKmRate;
$rate->max_distance_km = $maxDistance;
$rate->use_distance_calculation = true;
$rate->save();

echo "✅ Database updated!\n\n";

echo "📊 Shipping Rate Details:\n";
echo "   ID: {$rate->id}\n";
echo "   Region: {$rate->region_name}\n";
echo "   Store Location: $lat, $lng\n";
echo "   Base Rate: Rp " . number_format($rate->base_rate, 0, ',', '.') . "\n";
echo "   Per KM Rate: Rp " . number_format($rate->per_km_rate, 0, ',', '.') . "\n";
echo "   Max Distance: {$rate->max_distance_km} km\n";
echo "   Status: " . ($rate->is_active ? '✅ Active' : '❌ Inactive') . "\n\n";

echo "🧮 Simulasi Harga:\n";
for ($km = 1; $km <= min(10, $maxDistance); $km++) {
    $price = $baseRate + ($km * $perKmRate);
    echo "   {$km} km  = Rp " . number_format($price, 0, ',', '.') . "\n";
}

echo "\n✅ Selesai!\n";
echo "\n🎯 Langkah selanjutnya:\n";
echo "   1. Test di checkout page: http://127.0.0.1:8000/checkout\n";
echo "   2. Klik 'Deteksi Lokasi' dan izinkan GPS\n";
echo "   3. Verify ongkir dihitung dengan benar\n\n";
