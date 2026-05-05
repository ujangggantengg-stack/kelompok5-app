# 🚀 Quick Start - Setup Ongkir Seperti Grab/GoFood

## Langkah Cepat (5 Menit)

### 1️⃣ Dapatkan Koordinat Toko

**Cara Termudah:**
1. Buka: https://maps.google.com
2. Cari alamat toko roti kamu
3. Klik kanan pada pin lokasi
4. Klik koordinat yang muncul (akan otomatis ter-copy)
5. Paste di notepad

**Contoh hasil:**
```
-6.2088, 106.8456
```

---

### 2️⃣ Jalankan Setup Script

Buka terminal/command prompt di folder project, lalu jalankan:

```bash
php setup_ongkir.php
```

Ikuti instruksi yang muncul:
- Masukkan latitude toko
- Masukkan longitude toko
- Masukkan biaya dasar (contoh: 5000)
- Masukkan tarif per km (contoh: 2000)
- Masukkan jarak maksimal (contoh: 15)

---

### 3️⃣ Selesai!

Sistem ongkir otomatis sudah aktif. Sekarang:
- Customer input alamat
- Sistem hitung jarak otomatis
- Ongkir muncul sesuai jarak

---

## 💡 Rekomendasi Tarif

### Untuk Jakarta & Sekitarnya:
```
Biaya Dasar: 8000
Per KM: 2500
Jarak Maksimal: 12
```

### Untuk Kota Besar Lainnya:
```
Biaya Dasar: 6000
Per KM: 2000
Jarak Maksimal: 15
```

### Untuk Kota Kecil:
```
Biaya Dasar: 5000
Per KM: 1500
Jarak Maksimal: 10
```

---

## 📝 Catatan Penting

1. **Tarif disesuaikan dengan:**
   - Harga BBM di daerah kamu
   - Tarif Grab/GoFood lokal
   - Biaya operasional

2. **Jarak maksimal:**
   - Sesuaikan dengan kemampuan pengiriman
   - Biasanya 10-15 km untuk toko kecil

3. **Testing:**
   - Test dengan beberapa alamat
   - Pastikan harga masuk akal
   - Sesuaikan jika perlu

---

## ❓ Butuh Bantuan?

Baca file **CARA_SETTING_ONGKIR.md** untuk panduan lengkap!
