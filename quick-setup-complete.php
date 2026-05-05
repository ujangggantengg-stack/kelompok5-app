<?php
/**
 * Quick Setup - Complete All Critical Tasks
 * 
 * Script ini akan memandu Anda menyelesaikan semua critical tasks:
 * 1. Update koordinat toko
 * 2. Set harga ongkir
 * 3. Create admin user
 * 4. Update database
 * 
 * Cara pakai:
 * php quick-setup-complete.php
 */

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║         🚀 QUICK SETUP - TOKO ROTI SYSTEM                 ║\n";
echo "║         Complete All Critical Tasks in 5 Minutes!         ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$handle = fopen("php://stdin", "r");

// ============================================================================
// TASK 1: UPDATE KOORDINAT TOKO
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📍 TASK 1: UPDATE KOORDINAT TOKO\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "🗺️  Cara dapat koordinat dari Google Maps:\n";
echo "   1. Buka https://maps.google.com\n";
echo "   2. Cari alamat toko roti Anda\n";
echo "   3. Klik kanan pada pin merah\n";
echo "   4. Pilih koordinat yang muncul (akan auto-copy)\n";
echo "   5. Format: -6.123456, 106.789012\n\n";

echo "📝 Masukkan koordinat toko:\n";
echo "   Latitude (contoh: -6.5971469): ";
$lat = trim(fgets($handle));
echo "   Longitude (contoh: 106.8060394): ";
$lng = trim(fgets($handle));

$lat = floatval($lat);
$lng = floatval($lng);

if ($lat == 0 || $lng == 0) {
    echo "\n❌ Error: Koordinat tidak valid!\n";
    exit(1);
}

// Validasi koordinat Indonesia
if ($lat > 0 || $lat < -11 || $lng < 95 || $lng > 141) {
    echo "\n⚠️  Warning: Koordinat sepertinya bukan di Indonesia!\n";
    echo "   Latitude: $lat (seharusnya antara -11 sampai 6)\n";
    echo "   Longitude: $lng (seharusnya antara 95 sampai 141)\n";
    echo "\n❓ Lanjutkan? (y/n): ";
    if (trim(fgets($handle)) != 'y') {
        echo "❌ Dibatalkan.\n";
        exit(1);
    }
}

echo "\n✅ Koordinat: $lat, $lng\n\n";

// ============================================================================
// TASK 2: SET HARGA ONGKIR
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "💰 TASK 2: SET HARGA ONGKIR\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "💡 Tips: Cek harga Grab/GoFood di daerah Anda\n\n";

echo "📝 Masukkan tarif pengiriman:\n";
echo "   Base Rate/Biaya Dasar (Rp, default: 5000): ";
$baseRateInput = trim(fgets($handle));
$baseRate = $baseRateInput ? intval($baseRateInput) : 5000;

echo "   Per KM Rate/Biaya per KM (Rp, default: 2000): ";
$perKmRateInput = trim(fgets($handle));
$perKmRate = $perKmRateInput ? intval($perKmRateInput) : 2000;

echo "   Max Distance/Jarak Maksimal (km, default: 15): ";
$maxDistInput = trim(fgets($handle));
$maxDistance = $maxDistInput ? intval($maxDistInput) : 15;

echo "\n📊 Tarif yang akan digunakan:\n";
echo "   Base Rate:    Rp " . number_format($baseRate, 0, ',', '.') . "\n";
echo "   Per KM Rate:  Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
echo "   Max Distance: $maxDistance km\n\n";

echo "🧮 Simulasi Harga:\n";
for ($km = 1; $km <= min(5, $maxDistance); $km++) {
    $price = $baseRate + ($km * $perKmRate);
    echo "   {$km} km  = Rp " . number_format($price, 0, ',', '.') . "\n";
}

echo "\n❓ Lanjutkan dengan tarif ini? (y/n): ";
if (trim(fgets($handle)) != 'y') {
    echo "❌ Dibatalkan.\n";
    exit(1);
}

// ============================================================================
// TASK 3: CREATE ADMIN USER
// ============================================================================
echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "👤 TASK 3: CREATE ADMIN USER\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "📝 Masukkan data admin:\n";
echo "   Name (default: Admin Roti): ";
$nameInput = trim(fgets($handle));
$name = $nameInput ?: 'Admin Roti';

echo "   Email (default: admin@roti.local): ";
$emailInput = trim(fgets($handle));
$email = $emailInput ?: 'admin@roti.local';

echo "   Password (default: password123): ";
$passwordInput = trim(fgets($handle));
$password = $passwordInput ?: 'password123';

echo "\n🔐 Admin Credentials:\n";
echo "   Name: $name\n";
echo "   Email: $email\n";
echo "   Password: $password\n";

echo "\n❓ Lanjutkan? (y/n): ";
if (trim(fgets($handle)) != 'y') {
    echo "❌ Dibatalkan.\n";
    exit(1);
}

// ============================================================================
// APPLY CHANGES
// ============================================================================
echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "🔄 APPLYING CHANGES...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Update checkout-modern.js
echo "📝 Updating public/js/checkout-modern.js...\n";
$jsFile = 'public/js/checkout-modern.js';
if (!file_exists($jsFile)) {
    echo "❌ File tidak ditemukan: $jsFile\n";
    exit(1);
}

$jsContent = file_get_contents($jsFile);
$jsContent = preg_replace('/const STORE_LAT = -?\d+\.?\d*;/', "const STORE_LAT = $lat;", $jsContent);
$jsContent = preg_replace('/const STORE_LNG = -?\d+\.?\d*;/', "const STORE_LNG = $lng;", $jsContent);
$jsContent = preg_replace('/const BASE_RATE = \d+;/', "const BASE_RATE = $baseRate;", $jsContent);
$jsContent = preg_replace('/const PER_KM_RATE = \d+;/', "const PER_KM_RATE = $perKmRate;", $jsContent);
$jsContent = preg_replace('/const MAX_DISTANCE = \d+;/', "const MAX_DISTANCE = $maxDistance;", $jsContent);
file_put_contents($jsFile, $jsContent);
echo "✅ Updated: $jsFile\n";

// Update ShippingCalculator.php
echo "📝 Updating app/Services/ShippingCalculator.php...\n";
$phpFile = 'app/Services/ShippingCalculator.php';
if (!file_exists($phpFile)) {
    echo "❌ File tidak ditemukan: $phpFile\n";
    exit(1);
}

$phpContent = file_get_contents($phpFile);
$phpContent = preg_replace('/private \$storeLat = -?\d+\.?\d*;/', "private \$storeLat = $lat;", $phpContent);
$phpContent = preg_replace('/private \$storeLng = -?\d+\.?\d*;/', "private \$storeLng = $lng;", $phpContent);
file_put_contents($phpFile, $phpContent);
echo "✅ Updated: $phpFile\n";

// Update database
echo "📝 Updating database...\n";
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ShippingRate;
use App\Models\User;

$rate = ShippingRate::first();
if (!$rate) {
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
echo "✅ Database shipping_rates updated\n";

// Create admin user
echo "📝 Creating admin user...\n";
$existing = User::where('email', $email)->first();
if ($existing) {
    if (!$existing->is_admin) {
        $existing->is_admin = true;
        $existing->save();
        echo "✅ Existing user updated to admin\n";
    } else {
        echo "ℹ️  Admin user already exists\n";
    }
} else {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($password),
        'is_admin' => true,
        'email_verified_at' => now(),
    ]);
    echo "✅ Admin user created\n";
}

// ============================================================================
// SUMMARY
// ============================================================================
echo "\n╔════════════════════════════════════════════════════════════╗\n";
echo "║                    ✅ SETUP COMPLETE!                      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

echo "📊 SUMMARY:\n\n";

echo "📍 Store Location:\n";
echo "   Latitude:  $lat\n";
echo "   Longitude: $lng\n\n";

echo "💰 Shipping Rates:\n";
echo "   Base Rate:    Rp " . number_format($baseRate, 0, ',', '.') . "\n";
echo "   Per KM Rate:  Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
echo "   Max Distance: $maxDistance km\n\n";

echo "👤 Admin Credentials:\n";
echo "   Name:     $name\n";
echo "   Email:    $email\n";
echo "   Password: $password\n\n";

echo "🎯 NEXT STEPS:\n\n";
echo "1. Start development server:\n";
echo "   php artisan serve\n\n";
echo "2. Start Vite (terminal baru):\n";
echo "   npm run dev\n\n";
echo "3. Test GPS Checkout:\n";
echo "   http://127.0.0.1:8000/checkout\n";
echo "   - Klik 'Deteksi Lokasi'\n";
echo "   - Izinkan GPS\n";
echo "   - Verify ongkir dihitung benar\n\n";
echo "4. Test Admin Panel:\n";
echo "   http://127.0.0.1:8000/login\n";
echo "   - Login dengan credentials di atas\n";
echo "   - Verify dashboard loads\n\n";
echo "5. Run automated tests:\n";
echo "   php artisan test\n\n";

echo "⚠️  IMPORTANT:\n";
echo "   - Ganti admin password setelah login pertama!\n";
echo "   - Test semua fitur sebelum production\n";
echo "   - Backup database secara berkala\n\n";

echo "✅ All critical tasks completed!\n";
echo "📚 Check MASTER_CHECKLIST.md untuk testing tasks\n\n";
