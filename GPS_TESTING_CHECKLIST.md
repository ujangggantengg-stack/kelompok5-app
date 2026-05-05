# ✅ GPS Checkout Testing Checklist

## 📋 Pre-Testing Setup

### 1. Konfigurasi File
- [ ] Buka `public/js/checkout-modern.js`
- [ ] Set `STORE_LAT` dengan koordinat toko asli
- [ ] Set `STORE_LNG` dengan koordinat toko asli
- [ ] Set `BASE_RATE` sesuai harga lokal
- [ ] Set `PER_KM_RATE` sesuai harga lokal
- [ ] Set `MAX_DISTANCE` sesuai jangkauan
- [ ] Save file

### 2. Browser Setup
- [ ] Gunakan Chrome atau Firefox (support GPS terbaik)
- [ ] Buka http://127.0.0.1:8000 atau https://domain.com
- [ ] Pastikan koneksi internet aktif
- [ ] Clear cache browser (Ctrl+Shift+Delete)

### 3. Device Setup
- [ ] Test di laptop/PC
- [ ] Test di smartphone (GPS lebih akurat)
- [ ] Test di tablet (opsional)
- [ ] Izinkan akses lokasi di browser

---

## 🧪 Test Cases

### TEST 1: GPS Detection - Happy Path ✅

**Steps:**
1. Buka halaman checkout
2. Scroll ke section "Alamat Pengiriman"
3. Klik tombol "📍 Deteksi Lokasi"
4. Browser minta izin → Klik "Allow"
5. Tunggu 2-5 detik

**Expected Results:**
- [ ] Tombol berubah jadi "⏳ Mendeteksi..."
- [ ] Setelah selesai: "✅ Lokasi Terdeteksi"
- [ ] Field "Nama Jalan" terisi otomatis
- [ ] Field "Kota/Kabupaten" terisi otomatis
- [ ] Search box terisi alamat lengkap
- [ ] Ongkir muncul di card ungu
- [ ] Jarak ditampilkan (contoh: "Jarak 3.2 km dari toko")
- [ ] Card tetap warna biru/ungu (dalam jangkauan)

**Screenshot:**
```
[Ambil screenshot hasil GPS detection]
```

---

### TEST 2: GPS Detection - Diluar Jangkauan ⚠️

**Steps:**
1. Buka halaman checkout
2. Klik "Deteksi Lokasi"
3. Gunakan lokasi yang jauh (>MAX_DISTANCE)

**Expected Results:**
- [ ] Ongkir menampilkan "Diluar jangkauan"
- [ ] Jarak ditampilkan (contoh: "Jarak 18.5 km (maks 15 km)")
- [ ] Card berubah warna merah/pink
- [ ] Form tetap bisa diisi
- [ ] Submit button tetap aktif (tapi akan ditolak server)

**Screenshot:**
```
[Ambil screenshot diluar jangkauan]
```

---

### TEST 3: GPS Detection - Permission Denied 🚫

**Steps:**
1. Buka halaman checkout
2. Klik "Deteksi Lokasi"
3. Browser minta izin → Klik "Block" atau "Deny"

**Expected Results:**
- [ ] Alert muncul: "Gagal mendeteksi lokasi. Izinkan akses lokasi di browser Anda."
- [ ] Tombol kembali normal
- [ ] Form tetap bisa diisi manual
- [ ] User bisa gunakan search box

**Screenshot:**
```
[Ambil screenshot error permission]
```

---

### TEST 4: Address Search - Autocomplete 🔍

**Steps:**
1. Buka halaman checkout
2. Klik di search box "🔍 Cari alamat..."
3. Ketik minimal 3 karakter (contoh: "Jl. Paj")
4. Tunggu suggestions muncul
5. Klik salah satu suggestion

**Expected Results:**
- [ ] Suggestions muncul setelah 3 karakter
- [ ] Maksimal 5 suggestions ditampilkan
- [ ] Hover pada suggestion → background berubah
- [ ] Klik suggestion → form auto-fill
- [ ] Ongkir langsung dihitung
- [ ] Suggestions hilang setelah dipilih

**Screenshot:**
```
[Ambil screenshot autocomplete]
```

---

### TEST 5: Manual Input - Edit Form 📝

**Steps:**
1. Buka halaman checkout
2. Klik "Deteksi Lokasi" (auto-fill)
3. Edit field "Nama Jalan" manual
4. Edit field "Kota/Kabupaten" manual
5. Isi "No. Rumah" dan "RT/RW"
6. Isi "Patokan" (opsional)

**Expected Results:**
- [ ] Semua field bisa diedit
- [ ] Ongkir tetap valid (dari GPS)
- [ ] Koordinat GPS tetap tersimpan
- [ ] Form validation berjalan
- [ ] Submit button aktif

**Screenshot:**
```
[Ambil screenshot manual edit]
```

---

### TEST 6: Delivery Method - Toggle 🚚

**Steps:**
1. Buka halaman checkout
2. Default: "Diantar" terpilih
3. Klik "Ambil Sendiri"
4. Klik "Diantar" lagi

**Expected Results:**

**Saat "Diantar" dipilih:**
- [ ] Card "Diantar" border orange, background pink muda
- [ ] Card "Ambil Sendiri" border abu, background putih
- [ ] Section "Alamat Pengiriman" tampil
- [ ] Section "Pickup Location" hilang
- [ ] Field alamat required

**Saat "Ambil Sendiri" dipilih:**
- [ ] Card "Ambil Sendiri" border orange, background pink muda
- [ ] Card "Diantar" border abu, background putih
- [ ] Section "Alamat Pengiriman" hilang
- [ ] Section "Pickup Location" tampil (alamat toko)
- [ ] Field alamat tidak required
- [ ] Ongkir = Rp 0

**Screenshot:**
```
[Ambil screenshot kedua mode]
```

---

### TEST 7: Form Validation ⚠️

**Steps:**
1. Buka halaman checkout
2. Klik "Buat Pesanan" tanpa isi form
3. Isi nama saja, submit lagi
4. Isi semua kecuali alamat, submit

**Expected Results:**
- [ ] Browser validation muncul
- [ ] Field required ditandai merah
- [ ] Focus ke field pertama yang error
- [ ] Submit tidak jalan sampai valid

**Required Fields (Delivery):**
- [ ] Nama Lengkap
- [ ] Nomor WhatsApp
- [ ] Nama Jalan
- [ ] No. Rumah
- [ ] RT/RW
- [ ] Kota/Kabupaten

**Required Fields (Pickup):**
- [ ] Nama Lengkap
- [ ] Nomor WhatsApp

**Screenshot:**
```
[Ambil screenshot validation errors]
```

---

### TEST 8: Shipping Cost Calculation 💰

**Test Data:**
```javascript
STORE_LAT = -6.5971469
STORE_LNG = 106.8060394
BASE_RATE = 5000
PER_KM_RATE = 2000
```

**Test Locations:**

| Lokasi | Lat | Lng | Jarak | Expected Ongkir |
|--------|-----|-----|-------|-----------------|
| Dekat | -6.5980000 | 106.8070000 | ~1 km | Rp 7.000 |
| Sedang | -6.6100000 | 106.8200000 | ~3 km | Rp 11.000 |
| Jauh | -6.6300000 | 106.8400000 | ~7 km | Rp 19.000 |

**Steps:**
1. Set koordinat test di console:
```javascript
selectAddress(-6.5980000, 106.8070000, 'Test Location 1');
```
2. Cek ongkir yang muncul
3. Hitung manual: BASE_RATE + (jarak × PER_KM_RATE)
4. Bandingkan hasil

**Expected Results:**
- [ ] Ongkir sesuai perhitungan manual
- [ ] Format rupiah benar (Rp 7.000)
- [ ] Jarak ditampilkan dengan 1 desimal (3.2 km)
- [ ] Tidak ada error di console

**Screenshot:**
```
[Ambil screenshot perhitungan ongkir]
```

---

### TEST 9: Mobile Responsiveness 📱

**Steps:**
1. Buka di smartphone
2. Test semua fitur di atas
3. Rotate landscape/portrait
4. Zoom in/out

**Expected Results:**
- [ ] Layout responsive (tidak pecah)
- [ ] Button ukuran cukup besar (min 44px)
- [ ] Text readable tanpa zoom
- [ ] GPS lebih akurat di mobile
- [ ] Touch targets tidak overlap
- [ ] Keyboard tidak tutup form

**Screenshot:**
```
[Ambil screenshot mobile view]
```

---

### TEST 10: Console Errors 🐛

**Steps:**
1. Buka Developer Tools (F12)
2. Tab "Console"
3. Lakukan semua test di atas
4. Perhatikan error/warning

**Expected Results:**
- [ ] Tidak ada error merah
- [ ] Hanya log info (biru/hitam)
- [ ] Log yang muncul:
  ```
  Checkout Modern JS loaded
  Store location: -6.5971469 106.8060394
  Shipping config: {BASE_RATE: 5000, PER_KM_RATE: 2000, MAX_DISTANCE: 15}
  ```

**Screenshot:**
```
[Ambil screenshot console]
```

---

### TEST 11: Network Requests 🌐

**Steps:**
1. Buka Developer Tools (F12)
2. Tab "Network"
3. Klik "Deteksi Lokasi"
4. Perhatikan API calls

**Expected Results:**
- [ ] Request ke `nominatim.openstreetmap.org/reverse`
- [ ] Status 200 OK
- [ ] Response time < 2 detik
- [ ] Response berisi address data

**Screenshot:**
```
[Ambil screenshot network tab]
```

---

### TEST 12: Full Checkout Flow 🛒

**Steps:**
1. Tambah produk ke cart
2. Buka checkout
3. Isi nama: "Test User"
4. Isi nomor: "081234567890"
5. Pilih "Diantar"
6. Klik "Deteksi Lokasi"
7. Lengkapi detail alamat
8. Isi catatan: "Test order"
9. Pilih payment: "QRIS"
10. Klik "Buat Pesanan"

**Expected Results:**
- [ ] Form tersubmit
- [ ] Redirect ke halaman konfirmasi/payment
- [ ] Data tersimpan di database
- [ ] Order muncul di admin panel
- [ ] Ongkir tersimpan dengan benar

**Data yang Harus Tersimpan:**
- [ ] customer_name
- [ ] customer_phone
- [ ] shipping_method = "delivery"
- [ ] street
- [ ] house_number
- [ ] rt_rw
- [ ] city
- [ ] house_details
- [ ] customer_lat
- [ ] customer_lng
- [ ] shipping_region (ongkir dalam Rupiah)
- [ ] notes
- [ ] payment_method = "QRIS"

**Screenshot:**
```
[Ambil screenshot order di database]
```

---

## 🎯 Performance Testing

### Load Time:
- [ ] Halaman load < 3 detik
- [ ] JavaScript load < 500ms
- [ ] GPS detection < 5 detik
- [ ] Address search < 1 detik

### Browser Compatibility:
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile browsers

### Device Testing:
- [ ] Desktop (Windows/Mac)
- [ ] Laptop
- [ ] Smartphone (Android/iOS)
- [ ] Tablet

---

## 🐛 Known Issues & Workarounds

### Issue 1: GPS Tidak Akurat di Laptop
**Workaround:** Gunakan smartphone untuk GPS lebih akurat

### Issue 2: Nominatim Rate Limit
**Workaround:** Jangan spam request, ada debounce 500ms

### Issue 3: GPS Tidak Jalan di HTTP
**Workaround:** Gunakan HTTPS atau localhost

### Issue 4: Browser Tidak Support GPS
**Workaround:** Gunakan address search manual

---

## 📊 Test Results Summary

| Test Case | Status | Notes |
|-----------|--------|-------|
| GPS Detection - Happy Path | ⬜ | |
| GPS Detection - Diluar Jangkauan | ⬜ | |
| GPS Detection - Permission Denied | ⬜ | |
| Address Search - Autocomplete | ⬜ | |
| Manual Input - Edit Form | ⬜ | |
| Delivery Method - Toggle | ⬜ | |
| Form Validation | ⬜ | |
| Shipping Cost Calculation | ⬜ | |
| Mobile Responsiveness | ⬜ | |
| Console Errors | ⬜ | |
| Network Requests | ⬜ | |
| Full Checkout Flow | ⬜ | |

**Legend:**
- ⬜ Not Tested
- ✅ Passed
- ❌ Failed
- ⚠️ Passed with Issues

---

## 📝 Bug Report Template

Jika menemukan bug, catat dengan format:

```
BUG #1
Title: [Judul singkat]
Severity: [Critical/High/Medium/Low]
Steps to Reproduce:
1. ...
2. ...
3. ...

Expected Result:
[Apa yang seharusnya terjadi]

Actual Result:
[Apa yang terjadi]

Screenshot:
[Attach screenshot]

Console Log:
[Copy error dari console]

Environment:
- Browser: Chrome 120
- OS: Windows 11
- Device: Laptop
- URL: http://127.0.0.1:8000
```

---

## ✅ Sign-off

**Tested By:** _______________
**Date:** _______________
**Overall Status:** ⬜ Pass / ⬜ Fail
**Ready for Production:** ⬜ Yes / ⬜ No

**Notes:**
```
[Catatan tambahan]
```

---

## 🚀 Post-Testing Actions

Setelah semua test pass:
- [ ] Update koordinat toko dengan yang asli
- [ ] Update harga ongkir sesuai riset Grab
- [ ] Deploy ke production
- [ ] Setup HTTPS/SSL
- [ ] Monitor error logs
- [ ] Collect user feedback

**Selamat testing!** 🎉
