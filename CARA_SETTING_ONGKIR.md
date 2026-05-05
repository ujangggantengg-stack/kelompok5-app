# 📦 Cara Setting Ongkir Seperti Grab/GoFood

## 🎯 Pilihan Sistem Ongkir

### **Opsi 1: Ongkir Berdasarkan Jarak (RECOMMENDED)**
Sistem ini menghitung ongkir otomatis berdasarkan jarak dari toko ke alamat customer, mirip Grab/GoFood.

**Kelebihan:**
- ✅ Otomatis, tidak perlu input manual
- ✅ Akurat sesuai jarak sebenarnya
- ✅ Customer tahu persis berapa ongkir sebelum pesan
- ✅ Mirip dengan sistem Grab/GoFood

**Cara Kerja:**
1. Customer input alamat lengkap
2. Sistem ambil koordinat (latitude/longitude) dari alamat
3. Hitung jarak dari toko ke alamat customer
4. Ongkir = Biaya Dasar + (Jarak × Tarif per KM)

**Contoh Perhitungan:**
```
Biaya Dasar: Rp 5.000
Tarif per KM: Rp 2.000
Jarak: 5 km

Ongkir = 5.000 + (5 × 2.000) = Rp 15.000
```

---

### **Opsi 2: Ongkir Manual Berdasarkan Wilayah**
Sistem yang sudah ada sekarang - admin set harga ongkir per wilayah.

**Kelebihan:**
- ✅ Sederhana
- ✅ Tidak perlu API pihak ketiga

**Kekurangan:**
- ❌ Kurang akurat
- ❌ Customer harus pilih wilayah manual
- ❌ Tidak fleksibel untuk alamat spesifik

---

## 🚀 Cara Implementasi Opsi 1 (Berdasarkan Jarak)

### **Langkah 1: Dapatkan Koordinat Toko Roti**

Ada 3 cara:

#### **Cara A: Pakai Google Maps (Paling Mudah)**
1. Buka Google Maps: https://maps.google.com
2. Cari alamat toko roti kamu
3. Klik kanan pada pin lokasi toko
4. Pilih koordinat yang muncul (contoh: -6.2088, 106.8456)
5. Copy koordinat tersebut

#### **Cara B: Pakai GPS HP**
1. Buka aplikasi Maps di HP
2. Pergi ke lokasi toko
3. Tap lokasi saat ini
4. Lihat koordinat (latitude, longitude)

#### **Cara C: Pakai Website**
1. Buka: https://www.latlong.net/
2. Masukkan alamat toko
3. Copy koordinat yang muncul

**Contoh Koordinat:**
```
Latitude: -6.2088
Longitude: 106.8456
```

---

### **Langkah 2: Setting Tarif Ongkir**

Sesuaikan dengan tarif Grab/GoFood di daerah kamu:

**Tarif Grab/GoFood Umumnya:**
- **Biaya Dasar:** Rp 5.000 - Rp 10.000
- **Per KM:** Rp 1.500 - Rp 3.000
- **Jarak Maksimal:** 10-15 km

**Contoh Setting:**
```php
Biaya Dasar: Rp 5.000
Per KM: Rp 2.000
Jarak Maksimal: 15 km
```

**Simulasi Harga:**
| Jarak | Perhitungan | Ongkir |
|-------|-------------|--------|
| 1 km  | 5.000 + (1 × 2.000) | Rp 7.000 |
| 3 km  | 5.000 + (3 × 2.000) | Rp 11.000 |
| 5 km  | 5.000 + (5 × 2.000) | Rp 15.000 |
| 10 km | 5.000 + (10 × 2.000) | Rp 25.000 |

---

### **Langkah 3: Update Koordinat Toko di Database**

Jalankan query ini di phpMyAdmin atau terminal:

```sql
-- Update koordinat toko (ganti dengan koordinat toko kamu)
UPDATE shipping_rates 
SET 
    store_latitude = -6.2088,
    store_longitude = 106.8456,
    base_rate = 5000,
    per_km_rate = 2000,
    max_distance_km = 15,
    use_distance_calculation = 1
WHERE id = 1;
```

**Atau pakai PHP Artisan Tinker:**
```bash
php artisan tinker
```

Lalu jalankan:
```php
$rate = App\Models\ShippingRate::first();
$rate->store_latitude = -6.2088;  // Ganti dengan koordinat toko
$rate->store_longitude = 106.8456; // Ganti dengan koordinat toko
$rate->base_rate = 5000;
$rate->per_km_rate = 2000;
$rate->max_distance_km = 15;
$rate->use_distance_calculation = true;
$rate->save();
```

---

### **Langkah 4: Integrasi dengan Google Maps API (Optional)**

Untuk mendapatkan koordinat dari alamat customer secara otomatis, kamu perlu Google Maps API.

#### **Cara Daftar Google Maps API:**

1. **Buka Google Cloud Console**
   - https://console.cloud.google.com/

2. **Buat Project Baru**
   - Klik "Select a project" → "New Project"
   - Nama: "Toko Roti Ongkir"
   - Klik "Create"

3. **Aktifkan API**
   - Buka "APIs & Services" → "Library"
   - Cari "Geocoding API"
   - Klik "Enable"
   - Cari "Distance Matrix API"
   - Klik "Enable"

4. **Buat API Key**
   - Buka "APIs & Services" → "Credentials"
   - Klik "Create Credentials" → "API Key"
   - Copy API Key yang muncul

5. **Tambahkan ke .env**
   ```env
   GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   ```

**Catatan:** Google Maps API gratis untuk 40.000 request per bulan.

---

## 💡 Alternatif Tanpa Google Maps API

Jika tidak mau pakai Google Maps API, kamu bisa:

### **Opsi A: Customer Input Koordinat Manual**
- Minta customer share lokasi dari Google Maps
- Customer copy-paste koordinat ke form

### **Opsi B: Pilih Wilayah dari Dropdown**
- Buat dropdown wilayah (Jakarta Pusat, Jakarta Selatan, dll)
- Set harga ongkir per wilayah
- Lebih sederhana tapi kurang akurat

### **Opsi C: Pakai Estimasi Berdasarkan Kecamatan**
- Buat database kecamatan dengan koordinat tengahnya
- Hitung jarak dari koordinat tengah kecamatan
- Lebih akurat dari wilayah, tapi tetap estimasi

---

## 📊 Rekomendasi Tarif Berdasarkan Daerah

### **Jakarta & Sekitarnya:**
```
Biaya Dasar: Rp 8.000
Per KM: Rp 2.500
Jarak Maksimal: 12 km
```

### **Kota Besar (Surabaya, Bandung, Medan):**
```
Biaya Dasar: Rp 6.000
Per KM: Rp 2.000
Jarak Maksimal: 15 km
```

### **Kota Kecil:**
```
Biaya Dasar: Rp 5.000
Per KM: Rp 1.500
Jarak Maksimal: 10 km
```

---

## 🛠️ Testing Sistem Ongkir

Setelah setup, test dengan beberapa alamat:

1. **Alamat Dekat (1-2 km)**
   - Cek apakah ongkir masuk akal (Rp 7.000 - Rp 10.000)

2. **Alamat Sedang (5-7 km)**
   - Cek apakah ongkir sesuai (Rp 15.000 - Rp 20.000)

3. **Alamat Jauh (10+ km)**
   - Cek apakah ongkir atau ditolak jika melebihi jarak maksimal

---

## ❓ FAQ

**Q: Apakah harus pakai Google Maps API?**
A: Tidak wajib. Bisa pakai sistem manual berdasarkan wilayah.

**Q: Berapa biaya Google Maps API?**
A: Gratis untuk 40.000 request/bulan. Cukup untuk toko kecil-menengah.

**Q: Bagaimana jika customer di luar jangkauan?**
A: Sistem akan otomatis tolak dan kasih pesan "Jarak pengiriman maksimal X km".

**Q: Bisa pakai kurir pihak ketiga (Grab/GoSend)?**
A: Bisa! Tinggal tambahkan opsi "Pakai Kurir Sendiri" atau "Pakai Grab/GoSend" di checkout.

---

## 📞 Butuh Bantuan?

Jika ada pertanyaan atau butuh bantuan setup, hubungi developer atau baca dokumentasi lengkap di folder project.
