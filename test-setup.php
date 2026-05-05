<?php
/**
 * Test Setup - Verify All Critical Tasks Completed
 * 
 * Script ini akan mengecek apakah semua critical tasks sudah selesai:
 * ✅ Koordinat toko sudah diupdate
 * ✅ Harga ongkir sudah diset
 * ✅ Admin user sudah dibuat
 * ✅ Database sudah diupdate
 * 
 * Cara pakai:
 * php test-setup.php
 */

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║           🧪 SETUP VERIFICATION TEST                      ║\n";
echo "║           Checking All Critical Tasks...                  ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$errors = [];
$warnings = [];
$passed = 0;
$total = 0;

// ============================================================================
// TEST 1: Check Files Exist
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📁 TEST 1: Checking Files...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$files = [
    'public/js/checkout-modern.js',
    'app/Services/ShippingCalculator.php',
];

foreach ($files as $file) {
    $total++;
    if (file_exists($file)) {
        echo "✅ Found: $file\n";
        $passed++;
    } else {
        echo "❌ Missing: $file\n";
        $errors[] = "File tidak ditemukan: $file";
    }
}

echo "\n";

// ============================================================================
// TEST 2: Check Coordinates Updated
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "📍 TEST 2: Checking Coordinates...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Check JS file
$jsFile = 'public/js/checkout-modern.js';
if (file_exists($jsFile)) {
    $jsContent = file_get_contents($jsFile);
    
    preg_match('/const STORE_LAT = (-?\d+\.?\d*);/', $jsContent, $latMatch);
    preg_match('/const STORE_LNG = (-?\d+\.?\d*);/', $jsContent, $lngMatch);
    
    $jsLat = floatval($latMatch[1] ?? 0);
    $jsLng = floatval($lngMatch[1] ?? 0);
    
    $total++;
    if ($jsLat != 0 && $jsLng != 0) {
        echo "✅ JS Coordinates: $jsLat, $jsLng\n";
        $passed++;
        
        // Check if still using example coordinates
        if ($jsLat == -6.5971469 && $jsLng == 106.8060394) {
            $warnings[] = "Masih menggunakan koordinat contoh (Bogor). Update dengan koordinat toko sebenarnya!";
        } elseif ($jsLat == -6.2088 && $jsLng == 106.8456) {
            $warnings[] = "Masih menggunakan koordinat contoh (Jakarta). Update dengan koordinat toko sebenarnya!";
        }
    } else {
        echo "❌ JS Coordinates: Invalid ($jsLat, $jsLng)\n";
        $errors[] = "Koordinat di checkout-modern.js belum diupdate";
    }
}

// Check PHP file
$phpFile = 'app/Services/ShippingCalculator.php';
if (file_exists($phpFile)) {
    $phpContent = file_get_contents($phpFile);
    
    preg_match('/private \$storeLat = (-?\d+\.?\d*);/', $phpContent, $latMatch);
    preg_match('/private \$storeLng = (-?\d+\.?\d*);/', $phpContent, $lngMatch);
    
    $phpLat = floatval($latMatch[1] ?? 0);
    $phpLng = floatval($lngMatch[1] ?? 0);
    
    $total++;
    if ($phpLat != 0 && $phpLng != 0) {
        echo "✅ PHP Coordinates: $phpLat, $phpLng\n";
        $passed++;
    } else {
        echo "❌ PHP Coordinates: Invalid ($phpLat, $phpLng)\n";
        $errors[] = "Koordinat di ShippingCalculator.php belum diupdate";
    }
    
    // Check if JS and PHP coordinates match
    $total++;
    if (abs($jsLat - $phpLat) < 0.0001 && abs($jsLng - $phpLng) < 0.0001) {
        echo "✅ Coordinates Match\n";
        $passed++;
    } else {
        echo "❌ Coordinates Mismatch!\n";
        echo "   JS:  $jsLat, $jsLng\n";
        echo "   PHP: $phpLat, $phpLng\n";
        $errors[] = "Koordinat di JS dan PHP tidak sama!";
    }
}

echo "\n";

// ============================================================================
// TEST 3: Check Shipping Rates
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "💰 TEST 3: Checking Shipping Rates...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

if (file_exists($jsFile)) {
    preg_match('/const BASE_RATE = (\d+);/', $jsContent, $baseMatch);
    preg_match('/const PER_KM_RATE = (\d+);/', $jsContent, $perKmMatch);
    preg_match('/const MAX_DISTANCE = (\d+);/', $jsContent, $maxDistMatch);
    
    $baseRate = intval($baseMatch[1] ?? 0);
    $perKmRate = intval($perKmMatch[1] ?? 0);
    $maxDistance = intval($maxDistMatch[1] ?? 0);
    
    $total++;
    if ($baseRate > 0 && $perKmRate > 0 && $maxDistance > 0) {
        echo "✅ Shipping Rates Configured:\n";
        echo "   Base Rate:    Rp " . number_format($baseRate, 0, ',', '.') . "\n";
        echo "   Per KM Rate:  Rp " . number_format($perKmRate, 0, ',', '.') . "\n";
        echo "   Max Distance: $maxDistance km\n";
        $passed++;
        
        // Show price simulation
        echo "\n   Price Simulation:\n";
        for ($km = 1; $km <= min(5, $maxDistance); $km++) {
            $price = $baseRate + ($km * $perKmRate);
            echo "   {$km} km = Rp " . number_format($price, 0, ',', '.') . "\n";
        }
    } else {
        echo "❌ Shipping Rates: Invalid\n";
        $errors[] = "Tarif ongkir belum diset dengan benar";
    }
}

echo "\n";

// ============================================================================
// TEST 4: Check Database
// ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "🗄️  TEST 4: Checking Database...\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    use App\Models\ShippingRate;
    use App\Models\User;
    
    // Check shipping rate
    $total++;
    $rate = ShippingRate::first();
    if ($rate) {
        echo "✅ Shipping Rate Found:\n";
        echo "   ID: {$rate->id}\n";
        echo "   Region: {$rate->region_name}\n";
        echo "   Store Location: {$rate->store_latitude}, {$rate->store_longitude}\n";
        echo "   Base Rate: Rp " . number_format($rate->base_rate, 0, ',', '.') . "\n";
        echo "   Per KM Rate: Rp " . number_format($rate->per_km_rate, 0, ',', '.') . "\n";
        echo "   Max Distance: {$rate->max_distance_km} km\n";
        echo "   Status: " . ($rate->is_active ? '✅ Active' : '❌ Inactive') . "\n";
        $passed++;
        
        // Verify coordinates match
        if ($rate->store_latitude == 0 || $rate->store_longitude == 0) {
            $warnings[] = "Koordinat di database masih 0. Jalankan: php update-database.php";
        }
    } else {
        echo "❌ Shipping Rate: Not Found\n";
        $errors[] = "Shipping rate belum dibuat di database. Jalankan: php update-database.php";
    }
    
    echo "\n";
    
    // Check admin user
    $total++;
    $adminCount = User::where('is_admin', true)->count();
    if ($adminCount > 0) {
        echo "✅ Admin Users: $adminCount found\n";
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            echo "   - {$admin->name} ({$admin->email})\n";
        }
        $passed++;
    } else {
        echo "❌ Admin Users: None found\n";
        $errors[] = "Admin user belum dibuat. Jalankan: php create-admin.php";
    }
    
} catch (\Exception $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    $errors[] = "Database connection failed. Check .env configuration.";
}

echo "\n";

// ============================================================================
// SUMMARY
// ============================================================================
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║                    📊 TEST SUMMARY                         ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$percentage = $total > 0 ? round(($passed / $total) * 100) : 0;
$status = $percentage == 100 ? '✅ PASSED' : ($percentage >= 75 ? '⚠️  PARTIAL' : '❌ FAILED');

echo "Status: $status\n";
echo "Passed: $passed / $total ($percentage%)\n\n";

if (count($errors) > 0) {
    echo "❌ ERRORS:\n";
    foreach ($errors as $i => $error) {
        echo "   " . ($i + 1) . ". $error\n";
    }
    echo "\n";
}

if (count($warnings) > 0) {
    echo "⚠️  WARNINGS:\n";
    foreach ($warnings as $i => $warning) {
        echo "   " . ($i + 1) . ". $warning\n";
    }
    echo "\n";
}

// ============================================================================
// RECOMMENDATIONS
// ============================================================================
if ($percentage < 100) {
    echo "🎯 RECOMMENDED ACTIONS:\n\n";
    
    if (count($errors) > 0) {
        echo "1. Fix errors terlebih dahulu:\n";
        if (in_array("Koordinat di checkout-modern.js belum diupdate", $errors) || 
            in_array("Koordinat di ShippingCalculator.php belum diupdate", $errors)) {
            echo "   php update-coordinates.php [LAT] [LNG]\n";
        }
        if (in_array("Tarif ongkir belum diset dengan benar", $errors)) {
            echo "   php update-shipping-rates.php [BASE] [PER_KM] [MAX]\n";
        }
        if (in_array("Shipping rate belum dibuat di database. Jalankan: php update-database.php", $errors)) {
            echo "   php update-database.php\n";
        }
        if (in_array("Admin user belum dibuat. Jalankan: php create-admin.php", $errors)) {
            echo "   php create-admin.php\n";
        }
        echo "\n";
    }
    
    echo "2. Atau gunakan quick setup:\n";
    echo "   php quick-setup-complete.php\n\n";
    
    echo "3. Test ulang:\n";
    echo "   php test-setup.php\n\n";
} else {
    echo "🎉 CONGRATULATIONS!\n\n";
    echo "All critical tasks completed! ✅\n\n";
    
    echo "🎯 NEXT STEPS:\n\n";
    echo "1. Start development server:\n";
    echo "   php artisan serve\n";
    echo "   npm run dev\n\n";
    
    echo "2. Test in browser:\n";
    echo "   http://127.0.0.1:8000/checkout (GPS detection)\n";
    echo "   http://127.0.0.1:8000/login (Admin login)\n\n";
    
    echo "3. Run automated tests:\n";
    echo "   php artisan test\n\n";
    
    echo "4. Review documentation:\n";
    echo "   - MASTER_CHECKLIST.md (testing tasks)\n";
    echo "   - DEPLOYMENT_CHECKLIST.md (production)\n\n";
}

// Exit code
exit($percentage == 100 ? 0 : 1);
