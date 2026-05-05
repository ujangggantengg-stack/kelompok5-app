<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\UserAddress;

echo "🔄 Updating existing addresses...\n\n";

$addresses = UserAddress::whereNull('house_number')
    ->orWhereNull('rt_rw')
    ->orWhereNull('district')
    ->get();

echo "Found " . $addresses->count() . " addresses to update\n\n";

foreach ($addresses as $address) {
    echo "Updating address ID: {$address->id}\n";
    echo "Current address: {$address->address}\n";
    
    // Parse address if it contains "Rt" or "RW"
    $addressText = $address->address;
    
    // Extract RT/RW if exists in address
    if (preg_match('/Rt\s*(\d+)\s*RW\s*(\d+)/i', $addressText, $matches)) {
        $rt = $matches[1];
        $rw = $matches[2];
        $address->rt_rw = str_pad($rt, 2, '0', STR_PAD_LEFT) . '/' . str_pad($rw, 2, '0', STR_PAD_LEFT);
        
        // Remove RT/RW from address
        $addressText = preg_replace('/Rt\s*\d+\s*RW\s*\d+/i', '', $addressText);
        $addressText = trim($addressText);
        $address->address = $addressText;
        
        echo "  ✓ Set RT/RW: {$address->rt_rw}\n";
    }
    
    // Set district from city if not set
    if (!$address->district && $address->city) {
        // Try to extract district from city name
        if (strpos($address->city, ',') !== false) {
            $parts = explode(',', $address->city);
            $address->district = trim($parts[0]);
            $address->city = trim($parts[1]);
            echo "  ✓ Set district: {$address->district}\n";
            echo "  ✓ Updated city: {$address->city}\n";
        }
    }
    
    $address->save();
    echo "  ✅ Address updated!\n\n";
}

echo "✅ Done! All addresses updated.\n";
echo "\nPlease check your addresses at /customer/addresses and fill in any missing data.\n";
