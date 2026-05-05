# 🚀 Checkout Modern - Quick Setup Guide

> **Setup checkout form modern dalam 10 menit!**

---

## ⚡ Super Quick Start

```bash
# 1. Get Google Maps API Key (5 min)
# https://console.cloud.google.com/

# 2. Update API key di blade file
# resources/views/checkout-modern.blade.php
# Ganti: YOUR_GOOGLE_MAPS_API_KEY

# 3. Update koordinat & rates
php update-coordinates.php -6.123456 106.789012
php update-shipping-rates.php 5000 2000 15
php update-database.php

# 4. Test!
php artisan serve
# Buka: http://127.0.0.1:8000/checkout-modern
```

**Done!** ✅

---

## 📋 Step-by-Step

### Step 1: Google Maps API Key (5 menit)

1. **Buka Google Cloud Console:**
   ```
   https://console.cloud.google.com/
   ```

2. **Create Project:**
   - Klik "Select a project" → "New Project"
   - Nama: "Toko Roti"
   - Klik "Create"

3. **Enable APIs:**
   - Menu → APIs & Services → Library
   - Enable 3 APIs ini:
     - ✅ Maps JavaScript API
     - ✅ Geocoding API
     - ✅ Places API

4. **Create API Key:**
   - Menu → APIs & Services → Credentials
   - Klik "Create Credentials" → "API Key"
   - Copy API key yang muncul
   - (Optional) Klik "Restrict Key" untuk keamanan

5. **Save API Key:**
   ```
   Contoh: AIzaSyBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
   ```

---

### Step 2: Update Blade File (2 menit)

**File:** `resources/views/checkout-modern.blade.php`

**Cari baris ini (sekitar baris 13):**
```html
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initMap" async defer></script>
```

**Ganti dengan:**
```html
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&libraries=places&callback=initMap" async defer></script>
```

**Ganti `AIzaSyBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` dengan API key Anda!**

---

### Step 3: Update Koordinat Toko (2 menit)

**Cara 1: Gunakan Helper Script (RECOMMENDED)**

```bash
# Get koordinat dari Google Maps
# 1. Buka https://maps.google.com
# 2. Cari alamat toko
# 3. Klik kanan → Copy koordinat
# Format: -6.123456, 106.789012

# Update dengan script
php update-coordinates.php -6.123456 106.789012
```

**Cara 2: Manual Edit**

**File:** `public/js/checkout-modern-enhanced.js`

```javascript
// Baris 7-8
const STORE_LAT = -6.123456; // Ganti dengan koordinat toko Anda
const STORE_LNG = 106.789012; // Ganti dengan koordinat toko Anda
```

---

### Step 4: Update Harga Ongkir (1 menit)

**Cara 1: Gunakan Helper Script (RECOMMENDED)**

```bash
# Format: BASE_RATE PER_KM_RATE MAX_DISTANCE
php update-shipping-rates.php 5000 2000 15
```

**Cara 2: Manual Edit**

**File:** `public/js/checkout-modern-enhanced.js`

```javascript
// Baris 11-13
const BASE_RATE = 5000;    // Biaya dasar (Rp)
const PER_KM_RATE = 2000;  // Per kilometer (Rp)
const MAX_DISTANCE = 15;   // Jarak maksimal (km)
```

---

### Step 5: Sync ke Database (30 detik)

```bash
php update-database.php
```

**Output:**
```
✅ Database updated!
📊 Shipping Rate Details:
   Store Location: -6.123456, 106.789012
   Base Rate: Rp 5.000
   Per KM Rate: Rp 2.000
   Max Distance: 15 km
```

---

### Step 6: Test! (2 menit)

```bash
# Start server
php artisan serve

# Buka browser
http://127.0.0.1:8000/checkout-modern
```

**Test Checklist:**
- [ ] Map muncul
- [ ] Klik "Deteksi Lokasi"
- [ ] Izinkan GPS
- [ ] Map zoom ke lokasi Anda
- [ ] Alamat auto-fill
- [ ] Geser pin → alamat update
- [ ] Klik chips "Rumah/Kantor/Kos"
- [ ] Isi detail alamat
- [ ] Pilih payment method
- [ ] Klik "Buat Pesanan"

---

## 🎯 Verification

### Check 1: Map Loaded

**Expected:**
- Map muncul dengan pin
- Centered di koordinat toko
- Zoom level 15

**If Failed:**
- Check API key valid
- Check APIs enabled
- Check console errors (F12)

---

### Check 2: GPS Detection

**Expected:**
- Klik "Deteksi Lokasi"
- Browser ask permission
- Map zoom ke lokasi user (zoom 18)
- Pin move ke lokasi user
- Alamat auto-fill

**If Failed:**
- Check HTTPS atau localhost
- Check browser permission
- Check Geocoding API enabled

---

### Check 3: Auto-fill Address

**Expected:**
- Field "Alamat dari GPS" terisi
- Field "Kota/Kabupaten" terisi
- Field "Kecamatan" terisi
- Field "Provinsi" terisi
- Field "Kode Pos" terisi (jika ada)

**If Failed:**
- Check Geocoding API enabled
- Check API quota
- Check console errors

---

### Check 4: Shipping Calculation

**Expected:**
- Ongkir muncul di sidebar
- Jarak ditampilkan
- Total terupdate

**If Failed:**
- Check koordinat toko benar
- Check BASE_RATE, PER_KM_RATE set
- Check console errors

---

## 🐛 Common Issues

### Issue 1: Map Tidak Muncul

**Symptoms:**
- Area map kosong/abu-abu
- Console error: "Google is not defined"

**Solutions:**
```bash
# 1. Check API key
# Pastikan tidak ada typo

# 2. Check APIs enabled
# Maps JavaScript API harus enabled

# 3. Check billing
# Google Maps requires billing account
# (Free tier: $200/month credit)
```

---

### Issue 2: GPS Permission Denied

**Symptoms:**
- Alert: "Izinkan akses lokasi"
- GPS tidak bekerja

**Solutions:**
```bash
# 1. Use HTTPS
# GPS requires HTTPS (or localhost for testing)

# 2. Check browser settings
# Chrome: Settings → Privacy → Site Settings → Location

# 3. Try different browser
# Some browsers block GPS by default
```

---

### Issue 3: Auto-fill Tidak Bekerja

**Symptoms:**
- Alamat tidak terisi otomatis
- Console error: "Geocoding failed"

**Solutions:**
```bash
# 1. Enable Geocoding API
# https://console.cloud.google.com/

# 2. Check API quota
# Free tier: 40,000 requests/month

# 3. Add billing account
# Required for production use
```

---

### Issue 4: Ongkir Tidak Terhitung

**Symptoms:**
- Ongkir shows loading spinner
- Atau shows "Rp 0"

**Solutions:**
```bash
# 1. Check koordinat toko
grep "STORE_LAT" public/js/checkout-modern-enhanced.js

# 2. Check rates configured
grep "BASE_RATE" public/js/checkout-modern-enhanced.js

# 3. Check console errors
F12 → Console
```

---

## 💡 Pro Tips

### Tip 1: Restrict API Key

**Why:** Keamanan & prevent abuse

**How:**
1. Google Cloud Console → Credentials
2. Klik API key → "Edit"
3. Application restrictions:
   - HTTP referrers
   - Add: `yourdomain.com/*`
4. API restrictions:
   - Restrict key
   - Select: Maps JavaScript API, Geocoding API, Places API
5. Save

---

### Tip 2: Monitor API Usage

**Why:** Avoid unexpected charges

**How:**
1. Google Cloud Console → APIs & Services → Dashboard
2. Check usage graphs
3. Set up billing alerts
4. Free tier: $200/month credit

---

### Tip 3: Optimize Geocoding Calls

**Why:** Reduce API calls & costs

**How:**
```javascript
// Cache results
const geocodeCache = {};

function reverseGeocode(lat, lng) {
  const key = `${lat},${lng}`;
  
  if (geocodeCache[key]) {
    // Use cached result
    return geocodeCache[key];
  }
  
  // Make API call
  // ...
  
  // Cache result
  geocodeCache[key] = result;
}
```

---

### Tip 4: Test on Mobile

**Why:** Most users on mobile

**How:**
```bash
# 1. Get local IP
ipconfig  # Windows
ifconfig  # Mac/Linux

# 2. Start server on 0.0.0.0
php artisan serve --host=0.0.0.0 --port=8000

# 3. Access from mobile
http://192.168.x.x:8000/checkout-modern

# 4. Test GPS on mobile
# Mobile GPS usually more accurate than desktop
```

---

## 📚 Related Documentation

- **Complete Guide:** [CHECKOUT_MODERN_UPGRADE.md](CHECKOUT_MODERN_UPGRADE.md)
- **Helper Scripts:** [HELPER_SCRIPTS.md](HELPER_SCRIPTS.md)
- **GPS Docs:** [GPS_DOCUMENTATION_INDEX.md](GPS_DOCUMENTATION_INDEX.md)

---

## 🎉 Success Criteria

Setup berhasil jika:

- ✅ Map muncul dengan benar
- ✅ GPS detection works
- ✅ Pin bisa digeser
- ✅ Alamat auto-fill
- ✅ Floating labels animasi
- ✅ Chips bisa diklik
- ✅ Ongkir terhitung
- ✅ Form bisa disubmit
- ✅ No console errors

---

## 🚀 Next Steps

After setup:

1. **Customize design:**
   - Change colors
   - Update logo
   - Adjust spacing

2. **Add features:**
   - Address history
   - Multiple addresses
   - Delivery time selection

3. **Production deployment:**
   - Setup HTTPS
   - Configure domain
   - Restrict API key
   - Monitor usage

---

**Ready to start?**

```bash
# Get API key first!
# Then run:
php update-coordinates.php -6.123456 106.789012
php update-shipping-rates.php 5000 2000 15
php update-database.php
php artisan serve
```

**Last Updated:** 3 Mei 2026  
**Version:** 2.0.0
