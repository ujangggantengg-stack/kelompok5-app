# 🚀 Instruksi Setup Final - Toko Roti

## ⚠️ PENTING: Yang Harus Dilakukan Sekarang

### 1. Setup Koordinat Toko (WAJIB!)

Koordinat saat ini masih **CONTOH** (Bogor). Harus diganti dengan koordinat toko asli!

#### Cara Mendapatkan Koordinat Toko:

**Opsi A: Google Maps (Termudah)**
1. Buka https://maps.google.com
2. Cari alamat toko roti Anda
3. Klik kanan pada pin lokasi → Pilih koordinat yang muncul
4. Copy koordinat (format: -6.2088, 106.8456)

**Opsi B: GPS HP**
1. Pergi ke lokasi toko
2. Buka Google Maps di HP
3. Tap lokasi saat ini (titik biru)
4. Lihat koordinat di bagian bawah

#### Update Koordinat di 3 Tempat:

**File 1: `public/js/checkout-modern.js` (baris 7-8)**
```javascript
const STORE_LAT = -6.XXXXXX; // GANTI dengan latitude toko
const STORE_LNG = 106.XXXXXX; // GANTI dengan longitude toko
```

**File 2: `app/Services/ShippingCalculator.php` (baris 8-9)**
```php
private $storeLat = -6.XXXXXX; // GANTI
private $storeLng = 106.XXXXXX; // GANTI
```

**File 3: Database (jalankan di terminal)**
```bash
php artisan tinker
```
Lalu:
```php
$rate = App\Models\ShippingRate::first();
if (!$rate) {
    $rate = new App\Models\ShippingRate();
    $rate->region_name = 'Otomatis (GPS)';
    $rate->cost = 0;
    $rate->type = 'distance';
    $rate->is_active = true;
}
$rate->store_latitude = -6.XXXXXX;  // GANTI
$rate->store_longitude = 106.XXXXXX; // GANTI
$rate->base_rate = 5000;
$rate->per_km_rate = 2000;
$rate->max_distance_km = 15;
$rate->use_distance_calculation = true;
$rate->save();
exit
```

---

### 2. Riset & Set Harga Ongkir

Cek harga Grab/GoFood di daerah Anda, lalu update:

**File: `public/js/checkout-modern.js` (baris 11-13)**
```javascript
const BASE_RATE = 5000;    // Biaya dasar (Rp)
const PER_KM_RATE = 2000;  // Per kilometer (Rp)
const MAX_DISTANCE = 15;   // Jarak maksimal (km)
```

**Simulasi Harga:**
- 1 km = Rp 5.000 + (1 × Rp 2.000) = **Rp 7.000**
- 3 km = Rp 5.000 + (3 × Rp 2.000) = **Rp 11.000**
- 5 km = Rp 5.000 + (5 × Rp 2.000) = **Rp 15.000**
- 10 km = Rp 5.000 + (10 × Rp 2.000) = **Rp 25.000**

---

### 3. Testing Lengkap

Ikuti checklist di `GPS_TESTING_CHECKLIST.md`:

```bash
# Quick test (5 menit)
1. Buka http://127.0.0.1:8000/checkout
2. Klik "Deteksi Lokasi"
3. Izinkan GPS
4. Cek apakah ongkir muncul
5. Cek apakah jarak benar
```

---

### 4. Deploy ke Production

**Checklist:**
- [ ] Koordinat toko sudah benar
- [ ] Harga ongkir sudah sesuai
- [ ] Testing sudah pass
- [ ] HTTPS sudah aktif (GPS butuh HTTPS)
- [ ] Database production sudah setup

**Commands:**
```bash
# Build assets
npm run build

# Clear cache
php artisan cache:clear
php artisan config:clear

# Optimize
php artisan optimize
```

---

## 📊 Status Fitur

### ✅ Sudah Selesai:
- [x] GPS Detection dengan akurasi tinggi (zoom 18)
- [x] Perhitungan ongkir otomatis
- [x] Address search dengan autocomplete
- [x] Modern UI dengan gradient cards
- [x] Form validation
- [x] Admin dashboard lengkap
- [x] Dokumentasi lengkap (7 files)

### ⚠️ Perlu Setup:
- [ ] Koordinat toko asli (WAJIB!)
- [ ] Harga ongkir sesuai daerah
- [ ] Testing di production
- [ ] SSL/HTTPS untuk GPS

---

## 🎯 Quick Start (5 Menit)

```bash
# 1. Update koordinat toko di checkout-modern.js
# 2. Update harga ongkir di file yang sama
# 3. Refresh browser (Ctrl + Shift + R)
# 4. Test GPS detection
# 5. Done!
```

---

## 📞 Butuh Bantuan?

Baca dokumentasi lengkap:
- `GPS_DOCUMENTATION_INDEX.md` - Index semua dokumentasi
- `QUICK_SETUP_GPS.md` - Setup 5 menit
- `GPS_FAQ.md` - 60+ pertanyaan umum
- `GPS_TESTING_CHECKLIST.md` - Testing lengkap

---

**Last Updated:** 3 Mei 2026
