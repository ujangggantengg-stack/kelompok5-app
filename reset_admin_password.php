<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

$admin = User::where('email', 'admin@budess.com')->first();

if ($admin) {
    $admin->password = bcrypt('admin123');
    $admin->save();
    
    echo "✅ Password admin berhasil direset!\n\n";
    echo "=================================\n";
    echo "Email: admin@budess.com\n";
    echo "Password: admin123\n";
    echo "=================================\n\n";
    echo "Login di: http://127.0.0.1:8000/login\n";
    echo "Admin panel: http://127.0.0.1:8000/admin\n";
} else {
    echo "❌ Admin tidak ditemukan!\n";
}
?>
