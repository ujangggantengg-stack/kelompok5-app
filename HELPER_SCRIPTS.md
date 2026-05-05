# 🛠️ Helper Scripts - Quick Setup Guide

> **Scripts untuk menyelesaikan Critical Tasks dengan cepat dan mudah**

---

## 📋 Daftar Scripts

### 1. **quick-setup-complete.php** ⭐ RECOMMENDED
**Fungsi:** Setup lengkap semua critical tasks dalam 1 script interaktif

**Cara pakai:**
```bash
php quick-setup-complete.php
```

**Yang dilakukan:**
- ✅ Update koordinat toko
- ✅ Set harga ongkir
- ✅ Create admin user
- ✅ Update database

**Waktu:** ~5 menit

---

### 2. **update-coordinates.php**
**Fungsi:** Update koordinat toko saja

**Cara pakai:**
```bash
php update-coordinates.php [LATITUDE] [LONGITUDE]
```

**Contoh:**
```bash
php update-coordinates.php -6.5971469 106.8060394
```

**Yang diupdate:**
- `public/js/checkout-modern.js` (STORE_LAT, STORE_LNG)
- `app/Services/ShippingCalculator.php` (storeLat, storeLng)

---

### 3. **update-shipping-rates.php**
**Fungsi:** Update harga ongkir saja

**Cara pakai:**
```bash
php update-shipping-rates.php [BASE_RATE] [PER_KM_RATE] [MAX_DISTANCE]
```

**Contoh:**
```bash
php update-shipping-rates.php 5000 2000 15
```

**Parameter:**
- `BASE_RATE`: Biaya dasar (Rp)
- `PER_KM_RATE`: Biaya per kilometer (Rp)
- `MAX_DISTANCE`: Jarak maksimal pengiriman (km)

---

### 4. **update-database.php**
**Fungsi:** Sync koordinat & tarif dari file ke database

**Cara pakai:**
```bash
php update-database.php
```

**Yang dilakukan:**
- Baca koordinat dari `checkout-modern.js`
- Baca tarif dari `checkout-modern.js`
- Update tabel `shipping_rates`
- Tampilkan simulasi harga

---

### 5. **create-admin.php**
**Fungsi:** Create admin user

**Cara pakai:**
```bash
php create-admin.php [EMAIL] [PASSWORD] [NAME]
```

**Contoh:**
```bash
php create-admin.php admin@roti.local password123 "Admin Roti"
```

**Default values:**
- Email: `admin@roti.local`
- Password: `password123`
- Name: `Admin Roti`

---

## 🚀 Quick Start (Recommended Flow)

### Option A: All-in-One (TERCEPAT!)

```bash
# 1. Run quick setup
php quick-setup-complete.php

# 2. Start server
php artisan serve

# 3. Start Vite (terminal baru)
npm run dev

# 4. Test checkout
# Buka: http://127.0.0.1:8000/checkout
```

**Waktu total:** ~5 menit

---

### Option B: Step-by-Step

```bash
# 1. Update koordinat
php update-coordinates.php -6.5971469 106.8060394

# 2. Update tarif
php update-shipping-rates.php 5000 2000 15

# 3. Sync ke database
php update-database.php

# 4. Create admin
php create-admin.php

# 5. Start server
php artisan serve
npm run dev
```

**Waktu total:** ~10 menit

---

## 📍 Cara Dapat Koordinat dari Google Maps

1. Buka https://maps.google.com
2. Cari alamat toko roti Anda
3. Klik kanan pada pin merah
4. Pilih koordinat yang muncul (akan auto-copy)
5. Format: `-6.123456, 106.789012`

**Contoh koordinat Indonesia:**
- Jakarta: `-6.2088, 106.8456`
- Bogor: `-6.5971469, 106.8060394`
- Bandung: `-6.9175, 107.6191`
- Surabaya: `-7.2575, 112.7521`

---

## 💰 Cara Tentukan Harga Ongkir

### Riset Harga Lokal
1. Buka Grab/GoFood
2. Cek harga pengiriman di daerah Anda
3. Catat:
   - Biaya minimum (BASE_RATE)
   - Biaya per km (PER_KM_RATE)
   - Jarak maksimal (MAX_DISTANCE)

### Contoh Tarif
```
Jakarta:
- Base: Rp 5.000
- Per KM: Rp 2.000
- Max: 15 km

Bogor:
- Base: Rp 4.000
- Per KM: Rp 1.500
- Max: 10 km

Bandung:
- Base: Rp 5.000
- Per KM: Rp 2.500
- Max: 12 km
```

### Simulasi Harga
```
Base: Rp 5.000, Per KM: Rp 2.000

1 km  = Rp 7.000
2 km  = Rp 9.000
3 km  = Rp 11.000
5 km  = Rp 15.000
10 km = Rp 25.000
```

---

## ✅ Verification Checklist

Setelah run scripts, verify:

### 1. File Updates
```bash
# Check koordinat
grep "STORE_LAT\|STORE_LNG" public/js/checkout-modern.js
grep "storeLat\|storeLng" app/Services/ShippingCalculator.php

# Check tarif
grep "BASE_RATE\|PER_KM_RATE\|MAX_DISTANCE" public/js/checkout-modern.js
```

### 2. Database
```bash
php artisan tinker
App\Models\ShippingRate::first();
# Verify: store_latitude, store_longitude, base_rate, per_km_rate
exit
```

### 3. Admin User
```bash
php artisan tinker
App\Models\User::where('is_admin', true)->count();
# Should return 1 or more
exit
```

### 4. Functional Test
```bash
# Start server
php artisan serve

# Buka browser:
# 1. http://127.0.0.1:8000/checkout
#    - Klik "Deteksi Lokasi"
#    - Verify ongkir muncul
#
# 2. http://127.0.0.1:8000/login
#    - Login dengan admin credentials
#    - Verify dashboard loads
```

---

## 🐛 Troubleshooting

### Error: "File tidak ditemukan"
```bash
# Pastikan run dari root project
pwd
# Should show: /path/to/roti

# Check files exist
ls public/js/checkout-modern.js
ls app/Services/ShippingCalculator.php
```

### Error: "Koordinat tidak valid"
```bash
# Format harus: -6.123456 (dengan titik, bukan koma)
# Latitude: -11 sampai 6 (Indonesia)
# Longitude: 95 sampai 141 (Indonesia)
```

### Error: "Database connection"
```bash
# Check .env
cat .env | grep DB_

# Test connection
php artisan tinker
DB::connection()->getPdo();
exit
```

### Error: "Admin user already exists"
```bash
# Update existing user
php artisan tinker
$user = User::where('email', 'admin@roti.local')->first();
$user->is_admin = true;
$user->save();
exit
```

---

## 📚 Related Documentation

- **MASTER_CHECKLIST.md** - Complete checklist semua tasks
- **QUICK_SETUP_GPS.md** - GPS system setup guide
- **ADMIN_SETUP_GUIDE.md** - Admin panel setup
- **GPS_FAQ.md** - Frequently asked questions

---

## 🎯 Next Steps

Setelah setup selesai:

1. ✅ Run automated tests
   ```bash
   php artisan test
   ```

2. ✅ Test manual di browser
   - Checkout flow
   - GPS detection
   - Admin dashboard

3. ✅ Review documentation
   - Read GPS_DOCUMENTATION_INDEX.md
   - Check DEPLOYMENT_CHECKLIST.md

4. ✅ Prepare for production
   - Update .env for production
   - Setup SSL certificate
   - Configure backup strategy

---

**Last Updated:** 3 Mei 2026

**Need Help?** Check GPS_FAQ.md atau MASTER_CHECKLIST.md
