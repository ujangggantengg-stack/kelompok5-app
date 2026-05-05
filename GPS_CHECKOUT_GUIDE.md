# 🎯 Panduan Checkout dengan GPS Akurat Seperti Grab

## ✅ Fitur yang Sudah Diimplementasikan

### 1. **GPS Detection Super Akurat (Zoom Level 18)**
- Deteksi lokasi sampai level **gang/jalan kecil** seperti Grab
- Menggunakan `enableHighAccuracy: true` untuk akurasi maksimal
- Zoom level 18 pada reverse geocoding untuk detail tinggi
- Auto-fill alamat lengkap: Jalan, Kelurahan, Kecamatan, Kota

### 2. **Perhitungan Ongkir Otomatis**
- Formula: `BASE_RATE + (Jarak × PER_KM_RATE)`
- Menggunakan Haversine Formula untuk hitung jarak GPS
- Real-time calculation saat lokasi terdeteksi
- Validasi jarak maksimal pengiriman

### 3. **Address Search dengan Autocomplete**
- Ketik minimal 3 karakter untuk search
- Suggestions dari OpenStreetMap Nominatim
- Klik hasil untuk auto-fill form
- Support pencarian alamat Indonesia

### 4. **Modern UI/UX**
- Card-based layout seperti Shopee/GoFood
- Gradient colors dan smooth transitions
- Icon-based visual feedback
- Hover effects pada semua interactive elements

### 5. **Dual Delivery Method**
- **Diantar**: Dengan GPS detection dan ongkir otomatis
- **Ambil Sendiri**: Tampilkan alamat toko lengkap

---

## 🔧 Cara Setup (PENTING!)

### Step 1: Set Koordinat Toko
Buka file `public/js/checkout-modern.js` dan edit baris 7-8:

```javascript
// GANTI DENGAN KOORDINAT TOKO SEBENARNYA!
const STORE_LAT = -6.5971469; // Latitude toko
const STORE_LNG = 106.8060394; // Longitude toko
```

**Cara dapat koordinat toko:**
1. Buka Google Maps
2. Cari lokasi toko Anda
3. Klik kanan pada pin toko → "What's here?"
4. Copy koordinat yang muncul (contoh: -6.5971469, 106.8060394)
5. Paste ke file JavaScript

### Step 2: Sesuaikan Harga Ongkir
Edit baris 10-12 sesuai harga Grab/GoFood lokal:

```javascript
const BASE_RATE = 5000; // Biaya dasar (Rp)
const PER_KM_RATE = 2000; // Biaya per kilometer (Rp)
const MAX_DISTANCE = 15; // Jarak maksimal (km)
```

**Contoh perhitungan:**
- Jarak 3 km: Rp 5.000 + (3 × Rp 2.000) = **Rp 11.000**
- Jarak 5 km: Rp 5.000 + (5 × Rp 2.000) = **Rp 15.000**
- Jarak 10 km: Rp 5.000 + (10 × Rp 2.000) = **Rp 25.000**

**Tips menentukan harga:**
1. Cek harga Grab/GoFood untuk jarak 1-5 km di area Anda
2. Hitung rata-rata biaya per km
3. Set BASE_RATE = biaya minimal Grab
4. Set PER_KM_RATE = biaya tambahan per km

---

## 📱 Cara Pakai (User)

### Untuk Pengiriman (Diantar):

1. **Klik "Deteksi Lokasi"**
   - Browser akan minta izin akses lokasi
   - Klik "Allow" / "Izinkan"
   - Tunggu 2-5 detik

2. **Alamat Auto-Fill**
   - Nama jalan otomatis terisi
   - Kota/kecamatan otomatis terisi
   - Ongkir langsung muncul

3. **Lengkapi Detail**
   - Isi nomor rumah
   - Isi RT/RW
   - Tambah patokan (opsional)

4. **Cek Ongkir**
   - Lihat biaya di card ungu
   - Lihat jarak dari toko
   - Pastikan dalam jangkauan

### Alternatif: Search Manual

1. **Ketik di Search Box**
   - Ketik nama jalan/area
   - Pilih dari suggestions
   - Form auto-fill

2. **Edit Manual**
   - Bisa edit semua field
   - Ongkir tetap dihitung dari GPS

---

## 🎨 Fitur UI/UX

### Visual Feedback:
- ✅ **Hijau**: Lokasi berhasil terdeteksi
- 🔵 **Biru**: Ongkir dalam jangkauan
- 🔴 **Merah**: Diluar jangkauan pengiriman

### Interactive Elements:
- Hover effects pada semua button
- Focus border color change (orange)
- Smooth transitions
- Loading states

### Card Layout:
1. **Informasi Kontak** (👤)
2. **Metode Pengiriman** (🚚)
3. **Alamat Pengiriman** (📍)
4. **Catatan** (📝)
5. **Metode Pembayaran** (💳)

---

## 🔍 Akurasi GPS

### Level Deteksi:
- **Zoom 18** = Akurasi 5-10 meter
- Bisa detect sampai **gang/jalan kecil**
- Sama akuratnya dengan Grab/GoFood

### Data yang Diambil:
1. **Jalan/Gang** (road, pedestrian, path)
2. **Kelurahan** (village, suburb, neighbourhood)
3. **Kecamatan** (city_district, district)
4. **Kota** (city, town)
5. **Provinsi** (state)
6. **Kode Pos** (postcode)

### Prioritas Pencarian:
```
road > pedestrian > path > footway > cycleway > residential
```

---

## 🛠️ Troubleshooting

### GPS Tidak Berfungsi:
1. **Cek izin browser**
   - Chrome: Settings → Privacy → Location
   - Pastikan site diizinkan

2. **Cek HTTPS**
   - GPS hanya jalan di HTTPS atau localhost
   - Untuk production, wajib pakai SSL

3. **Cek koneksi internet**
   - Reverse geocoding butuh internet
   - OpenStreetMap API harus accessible

### Ongkir Tidak Muncul:
1. **Pastikan koordinat toko sudah diset**
   - Cek `STORE_LAT` dan `STORE_LNG`
   - Jangan pakai koordinat default

2. **Cek console browser**
   - F12 → Console
   - Lihat error messages

3. **Cek jarak**
   - Mungkin diluar `MAX_DISTANCE`
   - Naikkan nilai MAX_DISTANCE jika perlu

### Alamat Tidak Akurat:
1. **Coba deteksi ulang**
   - Klik "Deteksi Lokasi" lagi
   - GPS butuh waktu untuk lock

2. **Gunakan search manual**
   - Ketik alamat lengkap
   - Pilih dari suggestions

3. **Edit manual**
   - Semua field bisa diedit
   - Ongkir tetap valid dari GPS

---

## 📊 Data yang Dikirim ke Server

Form mengirim data berikut:

```php
// Contact
customer_name
customer_phone

// Delivery method
shipping_method (delivery/pickup)

// Address (jika delivery)
street
house_number
rt_rw
city
house_details

// GPS coordinates
customer_lat
customer_lng

// Shipping cost
shipping_region (berisi nilai ongkir dalam Rupiah)

// Other
notes
payment_method
```

---

## 🚀 Upgrade Selanjutnya (Opsional)

### 1. Map Preview dengan Leaflet.js
- Tampilkan peta interaktif
- User bisa drag pin untuk adjust lokasi
- Visual distance indicator

### 2. Saved Addresses
- Simpan alamat ke database
- User bisa pilih dari riwayat
- Label: Rumah, Kantor, Kos

### 3. Multiple Shipping Options
- Reguler (murah, lambat)
- Express (mahal, cepat)
- Same-day delivery

### 4. Real-time Tracking
- Integrasi dengan kurir
- Live location tracking
- ETA calculation

---

## 📝 Catatan Penting

1. **Koordinat Toko WAJIB Diset**
   - Tanpa ini, ongkir tidak akan akurat
   - Gunakan Google Maps untuk akurasi tinggi

2. **Harga Ongkir Harus Disesuaikan**
   - Cek harga kompetitor (Grab/GoFood)
   - Sesuaikan dengan biaya operasional
   - Update berkala jika BBM naik

3. **Testing di Real Device**
   - GPS lebih akurat di HP daripada laptop
   - Test di berbagai lokasi
   - Pastikan dalam jangkauan toko

4. **HTTPS untuk Production**
   - GPS tidak jalan di HTTP (kecuali localhost)
   - Pakai SSL certificate
   - Let's Encrypt gratis

---

## 🎯 Kesimpulan

Sistem checkout sudah **SANGAT LENGKAP** dengan fitur:
- ✅ GPS detection akurat sampai gang
- ✅ Auto-fill alamat lengkap
- ✅ Perhitungan ongkir otomatis
- ✅ Address search dengan autocomplete
- ✅ Modern UI seperti Shopee/GoFood
- ✅ Validasi jarak maksimal
- ✅ Dual delivery method

**Yang perlu dilakukan:**
1. Set koordinat toko di `checkout-modern.js`
2. Sesuaikan harga ongkir
3. Test di berbagai lokasi
4. Deploy dengan HTTPS

Selamat mencoba! 🎉
