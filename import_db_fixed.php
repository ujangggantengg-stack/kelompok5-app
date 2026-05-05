<?php
// Script import database dengan cara yang lebih baik

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'roti';

try {
    // Koneksi ke MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL\n";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$database' created/exists\n";
    
    // Use database
    $pdo->exec("USE `$database`");
    
    // Baca file SQL
    $sqlFile = 'roti.sql';
    if (!file_exists($sqlFile)) {
        die("File $sqlFile tidak ditemukan!\n");
    }
    
    echo "Reading SQL file...\n";
    $sql = file_get_contents($sqlFile);
    
    // Disable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO'");
    $pdo->exec("SET time_zone = '+00:00'");
    
    echo "Importing data (this may take a while)...\n";
    
    // Execute SQL
    $pdo->exec($sql);
    
    // Enable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    echo "\n=================================\n";
    echo "Import berhasil!\n";
    echo "Database '$database' sudah siap digunakan.\n";
    echo "=================================\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
