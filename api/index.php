<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

try {
    define('LARAVEL_START', microtime(true));

    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    require __DIR__.'/../vendor/autoload.php';

    $app = require_once __DIR__.'/../bootstrap/app.php';

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    echo "<h1>FATAL ERROR CAUGHT IN INDEX.PHP</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    echo "<p>File: " . $e->getFile() . " on line " . $e->getLine() . "</p>";
}
