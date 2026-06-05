<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        
        // Use custom CSRF middleware
        $middleware->validateCsrfTokens(except: [
            // Add routes that should be excluded from CSRF verification if needed
        ]);

        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'auth.customer' => \App\Http\Middleware\CustomerAuth::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Jika aplikasi berjalan di sistem file yang Read-Only (seperti Vercel)
if (!is_writable(dirname(__DIR__) . '/storage')) {
    $_ENV['APP_STORAGE'] = '/tmp/storage';
    $app->useStoragePath($_ENV['APP_STORAGE']);

    // Pastikan folder yang dibutuhkan Laravel tersedia di /tmp Vercel
    $dirs = [
        $_ENV['APP_STORAGE'] . '/app',
        $_ENV['APP_STORAGE'] . '/framework/cache/data',
        $_ENV['APP_STORAGE'] . '/framework/sessions',
        $_ENV['APP_STORAGE'] . '/framework/testing',
        $_ENV['APP_STORAGE'] . '/framework/views',
        $_ENV['APP_STORAGE'] . '/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}

return $app;
