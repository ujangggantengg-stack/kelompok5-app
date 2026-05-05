<?php
// Test CSRF Token
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Start session
session_start();

echo "=== CSRF TOKEN TEST ===\n\n";

// Check if session is working
echo "Session ID: " . session_id() . "\n";
echo "Session Path: " . session_save_path() . "\n";
echo "Session Status: " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive') . "\n\n";

// Check Laravel session
echo "Laravel Session Driver: " . config('session.driver') . "\n";
echo "Laravel Session Lifetime: " . config('session.lifetime') . " minutes\n";
echo "Laravel Session Path: " . config('session.path') . "\n\n";

// Generate CSRF token
$token = csrf_token();
echo "CSRF Token: " . $token . "\n";
echo "Token Length: " . strlen($token) . "\n\n";

// Check session file
$sessionPath = storage_path('framework/sessions');
echo "Session Storage Path: " . $sessionPath . "\n";
echo "Session Storage Exists: " . (is_dir($sessionPath) ? 'Yes' : 'No') . "\n";
echo "Session Storage Writable: " . (is_writable($sessionPath) ? 'Yes' : 'No') . "\n\n";

// List session files
if (is_dir($sessionPath)) {
    $files = scandir($sessionPath);
    $sessionFiles = array_filter($files, function($file) {
        return $file !== '.' && $file !== '..' && $file !== '.gitignore';
    });
    echo "Session Files Count: " . count($sessionFiles) . "\n";
    if (count($sessionFiles) > 0) {
        echo "Recent Session Files:\n";
        foreach (array_slice($sessionFiles, 0, 5) as $file) {
            echo "  - " . $file . "\n";
        }
    }
}

echo "\n=== END TEST ===\n";
