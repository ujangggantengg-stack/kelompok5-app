<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ShippingRate;

echo "\n";
echo "╔════════════════════════════════════════════════════════╗\n";
echo "║     SETUP ONGKIR BERDASARKAN JARAK (GRAB/GOFOOD)      ║\n";
echo "╚════════════════════════════════════════════════════════╝\n";
echo "\n";

// Input koordinat toko
echo "📍 KOORDINAT TOKO ROTI\n";
echo "Cara mendapatkan koordinat:\n";
echo "1. Buka Google Maps\n";
echo "2. Cari alamat toko\n";
echo "3. Klik kanan pada pin → Copy koordinat\n";
echo "\n";

echo "Masukkan Latitude toko (contoh: -6.2088): ";
$latitude = trim(fgets(STDIN));

echo "Masukkan Longitude toko (contoh: 106.8456): ";
$longitude = trim(fgets(STDIN));

echo "\n";
echo "💰 TARIF ONGKIR\n";
echo "Sesuaikan dengan tarif Grab/GoFood di daerah kamu\n";
echo "\n";

echo "Biaya Dasar (Rp): [default: 5000]: ";
$baseRate = trim(fgets(STDIN));
$baseRate = $baseRate ?: 5000;

echo "Tarif per KM (Rp): [default: 2000]: ";
$perKmRate = trim(fgets(STDIN));
$perKmRate = $perKmRate ?: 2000;

echo "Jarak Maksimal (km): [default: 15]: ";
$maxDistance = trim(fgets(STDIN));
$maxDistance = $maxDistance ?: 15;

echo "\n";
echo "📊 RINGKASAN SETTING:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Koordinat Toko : {$latitude}, {$longitude}\n";
echo "Biaya Dasar    : Rp " . number_format($baseRate, 0, ',', '.') . "\n";
echo "Per KM         : Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
echo "Jarak Maksimal : {$maxDistance} km\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n";

echo "SIMULASI HARGA ONGKIR:\n";
for ($km = 1; $km <= 10; $km += 2) {
    $cost = $baseRate + ($km * $perKmRate);
    echo "  {$km} km  → Rp " . number_format($cost, 0, ',', '.') . "\n";
}
echo "\n";

echo "Simpan setting ini? (y/n): ";
$confirm = trim(fgets(STDIN));

if (strtolower($confirm) === 'y') {
    try {
        $rate = ShippingRate::first();
        
        if (!$rate) {
            $rate = new ShippingRate();
            $rate->region_name = 'Otomatis (Berdasarkan Jarak)';
            $rate->cost = 0;
            $rate->type = 'distance';
            $rate->is_active = true;
        }
        
        $rate->store_latitude = $latitude;
        $rate->store_longitude = $longitude;
        $rate->base_rate = $baseRate;
        $rate->per_km_rate = $perKmRate;
        $rate->max_distance_km = $maxDistance;
        $rate->use_distance_calculation = true;
        $rate->save();
        
        echo "\n";
        echo "✅ Setting ongkir berhasil disimpan!\n";
        echo "\n";
        echo "LANGKAH SELANJUTNYA:\n";
        echo "1. Baca file CARA_SETTING_ONGKIR.md untuk panduan lengkap\n";
        echo "2. Test sistem ongkir dengan beberapa alamat\n";
        echo "3. Sesuaikan tarif jika perlu\n";
        echo "\n";
        
    } catch (\Exception $e) {
        echo "\n";
        echo "❌ Error: " . $e->getMessage() . "\n";
        echo "\n";
    }
} else {
    echo "\n";
    echo "❌ Setting dibatalkan.\n";
    echo "\n";
}

?>
