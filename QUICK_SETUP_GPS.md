# ⚡ Quick Setup - GPS Checkout (5 Menit)

## 🎯 Yang Harus Dilakukan SEKARANG

### 1️⃣ Buka File JavaScript
```
public/js/checkout-modern.js
```

### 2️⃣ Edit 3 Baris Ini (Baris 7-12)

**SEBELUM:**
```javascript
const STORE_LAT = -6.5971469; // ❌ Koordinat contoh
const STORE_LNG = 106.8060394; // ❌ Koordinat contoh

const BASE_RATE = 5000; // ❌ Harga contoh
const PER_KM_RATE = 2000; // ❌ Harga contoh
const MAX_DISTANCE = 15; // ❌ Jarak contoh
```

**SESUDAH:**
```javascript
const STORE_LAT = -6.XXXXXX; // ✅ Koordinat toko ASLI
const STORE_LNG = 106.XXXXXX; // ✅ Koordinat toko ASLI

const BASE_RATE = 8000; // ✅ Sesuai Grab lokal
const PER_KM_RATE = 3000; // ✅ Sesuai Grab lokal
const MAX_DISTANCE = 10; // ✅ Sesuai jangkauan
```

---

## 📍 Cara Dapat Koordinat Toko

### Metode 1: Google Maps (Paling Mudah)
1. Buka https://www.google.com/maps
2. Cari alamat toko: **"Dapoer Budess Bakery, Bogor"**
3. Klik kanan pada pin merah toko
4. Pilih **"What's here?"** atau **"Apa yang ada di sini?"**
5. Koordinat muncul di bawah: **-6.5971469, 106.8060394**
6. Copy angka pertama → `STORE_LAT`
7. Copy angka kedua → `STORE_LNG`

### Metode 2: Dari HP
1. Buka Google Maps di HP
2. Tap dan tahan pada lokasi toko
3. Pin merah muncul
4. Swipe up panel bawah
5. Koordinat ada di atas
6. Tap untuk copy

---

## 💰 Cara Tentukan Harga Ongkir

### Step 1: Riset Grab/GoFood
1. Buka app Grab atau GoFood
2. Coba pesan dari toko ke 3 lokasi berbeda:
   - Dekat (1-2 km)
   - Sedang (3-5 km)
   - Jauh (7-10 km)
3. Catat ongkirnya

### Step 2: Hitung Rata-rata
**Contoh hasil riset:**
- 1 km = Rp 8.000
- 3 km = Rp 12.000 → (12.000 - 8.000) / 2 = Rp 2.000/km
- 5 km = Rp 16.000 → (16.000 - 8.000) / 4 = Rp 2.000/km

**Kesimpulan:**
```javascript
const BASE_RATE = 8000; // Biaya minimal
const PER_KM_RATE = 2000; // Biaya per km
```

### Step 3: Set Jarak Maksimal
Berapa jauh Anda mau antar?
- Dalam kota: `MAX_DISTANCE = 10`
- Antar kota: `MAX_DISTANCE = 20`
- Unlimited: `MAX_DISTANCE = 999`

---

## ✅ Checklist Setup

- [ ] Buka `public/js/checkout-modern.js`
- [ ] Ganti `STORE_LAT` dengan koordinat toko
- [ ] Ganti `STORE_LNG` dengan koordinat toko
- [ ] Sesuaikan `BASE_RATE` dengan harga Grab
- [ ] Sesuaikan `PER_KM_RATE` dengan harga Grab
- [ ] Set `MAX_DISTANCE` sesuai jangkauan
- [ ] Save file
- [ ] Refresh browser
- [ ] Test "Deteksi Lokasi"
- [ ] Cek ongkir muncul

---

## 🧪 Cara Test

### Test 1: GPS Detection
1. Buka halaman checkout
2. Klik **"Deteksi Lokasi"**
3. Izinkan akses lokasi
4. Tunggu 2-5 detik
5. ✅ Alamat terisi otomatis
6. ✅ Ongkir muncul

### Test 2: Search Manual
1. Ketik nama jalan di search box
2. Pilih dari suggestions
3. ✅ Form terisi
4. ✅ Ongkir muncul

### Test 3: Validasi Jarak
1. Coba lokasi yang jauh (>MAX_DISTANCE)
2. ✅ Muncul "Diluar jangkauan"
3. ✅ Card berubah warna merah

---

## 🐛 Troubleshooting Cepat

### GPS Tidak Jalan?
```
❌ Masalah: Tombol "Deteksi Lokasi" tidak respon
✅ Solusi: 
   1. Cek browser support GPS (Chrome/Firefox)
   2. Izinkan akses lokasi di browser
   3. Pakai HTTPS atau localhost
```

### Ongkir Tidak Muncul?
```
❌ Masalah: Ongkir tetap "Menghitung..."
✅ Solusi:
   1. Cek STORE_LAT dan STORE_LNG sudah diisi
   2. Buka Console (F12) → lihat error
   3. Pastikan koneksi internet aktif
```

### Alamat Tidak Akurat?
```
❌ Masalah: Alamat salah atau tidak lengkap
✅ Solusi:
   1. Deteksi ulang (GPS butuh waktu lock)
   2. Edit manual di form
   3. Gunakan search box
```

---

## 📞 Support

Jika masih ada masalah:
1. Buka Console browser (F12)
2. Screenshot error yang muncul
3. Kirim ke developer

---

## 🎉 Selesai!

Setelah setup, sistem akan:
- ✅ Deteksi lokasi user sampai gang
- ✅ Hitung ongkir otomatis
- ✅ Validasi jarak maksimal
- ✅ Tampilan modern seperti Shopee

**Total waktu setup: 5 menit** ⏱️

Selamat mencoba! 🚀
