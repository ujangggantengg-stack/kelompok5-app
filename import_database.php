<?php
// Script untuk import database roti.sql

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'roti';

// Koneksi ke MySQL
$conn = new mysqli($host, $username, $password);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully\n";

// Drop database jika sudah ada
$sql = "DROP DATABASE IF EXISTS `$database`";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully\n";
}

// Create database baru
$sql = "CREATE DATABASE `$database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
}

// Pilih database
$conn->select_db($database);

// Baca file SQL
$sqlFile = 'roti.sql';
if (!file_exists($sqlFile)) {
    die("File $sqlFile tidak ditemukan!\n");
}

echo "Reading SQL file...\n";
$sql = file_get_contents($sqlFile);

// Pisahkan query berdasarkan delimiter
$queries = explode(';', $sql);

$success = 0;
$failed = 0;

echo "Importing data...\n";

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if ($conn->query($query) === TRUE) {
            $success++;
        } else {
            $failed++;
            // Uncomment untuk melihat error detail
            // echo "Error: " . $conn->error . "\n";
        }
    }
}

echo "\n=================================\n";
echo "Import selesai!\n";
echo "Berhasil: $success queries\n";
echo "Gagal: $failed queries\n";
echo "=================================\n";

$conn->close();
?>
