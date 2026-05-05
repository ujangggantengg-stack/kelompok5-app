<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\UserAddress;

echo "🔄 Fixing address data...\n\n";

$address = UserAddress::find(2);

if ($address) {
    $address->house_number = '17';
    $address->rt_rw = '01/17';
    $address->district = 'Bogor Barat';
    $address->save();
    
    echo "✅ Address updated!\n\n";
    echo "Data:\n";
    echo "- Nama Jalan: {$address->address}\n";
    echo "- No. Rumah: {$address->house_number}\n";
    echo "- RT/RW: {$address->rt_rw}\n";
    echo "- Kecamatan: {$address->district}\n";
    echo "- Kota: {$address->city}\n";
    echo "- Provinsi: {$address->province}\n";
    echo "- Kode Pos: {$address->postal_code}\n";
} else {
    echo "❌ Address not found!\n";
}
