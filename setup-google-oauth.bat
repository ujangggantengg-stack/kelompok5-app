@echo off
echo ========================================
echo   SETUP GOOGLE OAUTH - TOKO ROTI
echo ========================================
echo.
echo Langkah-langkah:
echo.
echo 1. Buat Project di Google Cloud Console
echo 2. Enable Google+ API
echo 3. Setup OAuth Consent Screen
echo 4. Buat OAuth Client ID
echo 5. Copy credentials ke .env
echo.
echo ========================================
echo.
echo Membuka Google Cloud Console...
echo.

REM Buka Google Cloud Console
start https://console.cloud.google.com/

echo.
echo Browser sudah terbuka!
echo.
echo Ikuti panduan di file: SETUP_GOOGLE_CEPAT.md
echo.
echo Setelah dapat Client ID dan Secret:
echo 1. Buka file .env
echo 2. Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET
echo 3. Jalankan: php artisan config:clear
echo 4. Test di: http://127.0.0.1:8000/customer/login
echo.
pause
