<?php
/**
 * Helper Script: Create Admin User
 * 
 * Cara pakai:
 * php create-admin.php [EMAIL] [PASSWORD] [NAME]
 * 
 * Contoh:
 * php create-admin.php admin@roti.local password123 "Admin Roti"
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

// Default values
$email = $argv[1] ?? 'admin@roti.local';
$password = $argv[2] ?? 'password123';
$name = $argv[3] ?? 'Admin Roti';

echo "👤 Creating admin user...\n\n";

// Check if admin already exists
$existing = User::where('email', $email)->first();
if ($existing) {
    echo "⚠️  User dengan email '$email' sudah ada!\n\n";
    echo "📊 User Details:\n";
    echo "   ID: {$existing->id}\n";
    echo "   Name: {$existing->name}\n";
    echo "   Email: {$existing->email}\n";
    echo "   Is Admin: " . ($existing->is_admin ? '✅ Yes' : '❌ No') . "\n";
    echo "   Created: {$existing->created_at}\n\n";
    
    if (!$existing->is_admin) {
        echo "🔄 Update user menjadi admin? (y/n): ";
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        if (trim($line) == 'y') {
            $existing->is_admin = true;
            $existing->save();
            echo "✅ User updated menjadi admin!\n";
        } else {
            echo "❌ Dibatalkan.\n";
        }
    }
    exit(0);
}

// Create new admin
try {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($password),
        'is_admin' => true,
        'email_verified_at' => now(),
    ]);
    
    echo "✅ Admin user created!\n\n";
    echo "📊 User Details:\n";
    echo "   ID: {$user->id}\n";
    echo "   Name: {$user->name}\n";
    echo "   Email: {$user->email}\n";
    echo "   Password: $password\n";
    echo "   Is Admin: ✅ Yes\n";
    echo "   Created: {$user->created_at}\n\n";
    
    echo "🔐 Login Credentials:\n";
    echo "   URL: http://127.0.0.1:8000/login\n";
    echo "   Email: $email\n";
    echo "   Password: $password\n\n";
    
    echo "⚠️  PENTING: Ganti password setelah login pertama!\n\n";
    
    // Count total admins
    $adminCount = User::where('is_admin', true)->count();
    echo "📈 Total admin users: $adminCount\n\n";
    
    echo "✅ Selesai!\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
