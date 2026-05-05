# ❓ GPS Checkout - Frequently Asked Questions (FAQ)

## 📍 GPS & Location

### Q1: Kenapa GPS tidak berfungsi di laptop saya?
**A:** GPS di laptop biasanya kurang akurat atau tidak ada. Solusi:
- Gunakan smartphone untuk testing (GPS lebih akurat)
- Atau gunakan fitur Address Search sebagai alternatif
- Laptop menggunakan WiFi positioning (kurang akurat)

### Q2: Apakah GPS berfungsi di semua browser?
**A:** GPS didukung oleh browser modern:
- ✅ Chrome (recommended)
- ✅ Firefox
- ✅ Safari
- ✅ Edge
- ❌ Internet Explorer (tidak support)

### Q3: Kenapa browser minta izin akses lokasi?
**A:** Ini adalah fitur keamanan browser. GPS hanya bisa diakses jika user memberikan izin. Klik "Allow" atau "Izinkan" untuk menggunakan fitur GPS.

### Q4: Apakah lokasi saya akan dilacak terus-menerus?
**A:** TIDAK. Lokasi hanya diambil sekali saat Anda klik "Deteksi Lokasi". Tidak ada tracking atau monitoring berkelanjutan.

### Q5: Seberapa akurat GPS detection?
**A:** Akurasi GPS:
- **Smartphone outdoor**: 5-10 meter (sangat akurat)
- **Smartphone indoor**: 10-50 meter
- **Laptop**: 50-500 meter (kurang akurat)
- **Zoom level 18**: Detail sampai gang/jalan kecil

### Q6: Kenapa alamat yang terdeteksi tidak lengkap?
**A:** Beberapa kemungkinan:
- GPS belum lock sempurna (tunggu 5-10 detik)
- Area Anda belum ter-map detail di OpenStreetMap
- Sinyal GPS lemah (coba di outdoor)
- **Solusi**: Edit manual atau gunakan Address Search

### Q7: Apakah GPS berfungsi tanpa internet?
**A:** TIDAK. GPS butuh internet untuk:
- Reverse geocoding (koordinat → alamat)
- Address search
- Menampilkan nama jalan/kota

---

## 💰 Ongkir & Perhitungan

### Q8: Bagaimana cara ongkir dihitung?
**A:** Formula: `BASE_RATE + (Jarak × PER_KM_RATE)`

**Contoh:**
```
Jarak: 3.2 km
BASE_RATE: Rp 5.000
PER_KM_RATE: Rp 2.000

Ongkir = 5.000 + (3.2 × 2.000)
       = 5.000 + 6.400
       = Rp 11.400
```

### Q9: Kenapa ongkir saya berbeda dengan teman saya?
**A:** Karena ongkir dihitung dari **jarak GPS sebenarnya**, bukan region. Ini lebih fair:
- Anda (1 km): Rp 7.000
- Teman (5 km): Rp 15.000

### Q10: Apakah ongkir bisa lebih murah dari BASE_RATE?
**A:** TIDAK. BASE_RATE adalah biaya minimal. Bahkan jarak 0.1 km tetap kena BASE_RATE.

### Q11: Bagaimana jika lokasi saya diluar jangkauan?
**A:** Sistem akan menampilkan "Diluar jangkauan" dan card berubah merah. Anda tidak bisa order delivery, tapi bisa pilih "Ambil Sendiri".

### Q12: Apakah ongkir sudah termasuk pajak?
**A:** Tergantung setting toko. Biasanya ongkir sudah final (tidak ada biaya tambahan).

### Q13: Kenapa ongkir tidak muncul?
**A:** Cek:
1. Apakah sudah klik "Deteksi Lokasi"?
2. Apakah koordinat toko sudah diset di `checkout-modern.js`?
3. Buka Console (F12) → lihat error
4. Pastikan internet aktif

---

## 🔍 Address Search

### Q14: Bagaimana cara menggunakan Address Search?
**A:** 
1. Ketik minimal 3 karakter di search box
2. Tunggu suggestions muncul (max 5 hasil)
3. Klik salah satu suggestion
4. Form auto-fill dan ongkir dihitung

### Q15: Kenapa suggestions tidak muncul?
**A:** Kemungkinan:
- Kurang dari 3 karakter
- Koneksi internet lambat
- API OpenStreetMap down (jarang)
- **Solusi**: Tunggu 1-2 detik atau ketik lebih spesifik

### Q16: Apakah bisa search dengan nama tempat (bukan alamat)?
**A:** YA! Contoh:
- "Stasiun Bogor"
- "Mall BTM"
- "Universitas Pakuan"

### Q17: Kenapa hasil search tidak akurat?
**A:** OpenStreetMap kadang tidak punya data lengkap untuk area tertentu. **Solusi**: Gunakan GPS detection atau isi manual.

---

## 📝 Form & Input

### Q18: Apakah semua field wajib diisi?
**A:** Tergantung metode pengiriman:

**Delivery (Diantar):**
- ✅ Nama Lengkap (required)
- ✅ Nomor WhatsApp (required)
- ✅ Nama Jalan (required)
- ✅ No. Rumah (required)
- ✅ RT/RW (required)
- ✅ Kota/Kabupaten (required)
- ❌ Patokan (optional)
- ❌ Catatan (optional)

**Pickup (Ambil Sendiri):**
- ✅ Nama Lengkap (required)
- ✅ Nomor WhatsApp (required)
- ❌ Alamat (tidak perlu)

### Q19: Apakah bisa edit alamat setelah GPS detection?
**A:** YA! Semua field bisa diedit manual. Ongkir tetap valid dari koordinat GPS.

### Q20: Format nomor WhatsApp yang benar?
**A:** 
- ✅ 081234567890
- ✅ 62812345678 90
- ✅ +6281234567890
- ❌ 0812-3456-7890 (jangan pakai dash)

### Q21: Apakah bisa checkout tanpa GPS?
**A:** YA! Ada 3 cara:
1. Gunakan Address Search
2. Isi manual semua field
3. Pilih "Ambil Sendiri" (tidak perlu alamat)

---

## 🚚 Delivery Method

### Q22: Apa bedanya "Diantar" dan "Ambil Sendiri"?
**A:**

**Diantar:**
- Produk diantar ke alamat Anda
- Perlu isi alamat lengkap
- Ada ongkir (dihitung dari jarak)
- Estimasi: 1-2 jam (tergantung jarak)

**Ambil Sendiri:**
- Anda datang ke toko
- Tidak perlu isi alamat
- Ongkir: Rp 0
- Alamat toko ditampilkan

### Q23: Apakah bisa ganti metode setelah order?
**A:** Tergantung kebijakan toko. Hubungi admin via WhatsApp untuk perubahan.

### Q24: Berapa lama estimasi pengiriman?
**A:** Tergantung jarak:
- 0-5 km: 30-60 menit
- 5-10 km: 1-2 jam
- 10-15 km: 2-3 jam

---

## 🔧 Technical Issues

### Q25: Kenapa muncul error "Vite manifest not found"?
**A:** Ini error Laravel development. Solusi:
```bash
npm install
npm run build
```
Atau untuk development:
```bash
npm run dev
```

### Q26: Kenapa halaman checkout tidak muncul?
**A:** Cek:
1. Apakah sudah login?
2. Apakah ada produk di cart?
3. Buka Console (F12) → lihat error
4. Clear cache browser

### Q27: Kenapa JavaScript tidak jalan?
**A:** Cek:
1. Apakah file `public/js/checkout-modern.js` ada?
2. Apakah di-load di blade view?
3. Buka Console → lihat error
4. Cek path file benar

### Q28: Bagaimana cara debug error?
**A:**
1. Buka Developer Tools (F12)
2. Tab "Console" → lihat error merah
3. Tab "Network" → cek API calls
4. Screenshot error dan kirim ke developer

---

## 🔐 Security & Privacy

### Q29: Apakah data lokasi saya aman?
**A:** YA! 
- Lokasi hanya digunakan untuk hitung ongkir
- Tidak dibagikan ke pihak ketiga
- Tidak ada tracking berkelanjutan
- Disimpan hanya untuk order fulfillment

### Q30: Apakah OpenStreetMap mencatat lokasi saya?
**A:** OpenStreetMap adalah layanan publik dan open source. Mereka tidak menyimpan data pribadi Anda. Hanya request API yang di-log (tanpa identitas).

### Q31: Apakah GPS bisa digunakan di HTTP?
**A:** TIDAK. Browser modern hanya mengizinkan GPS di:
- HTTPS (secure connection)
- localhost (untuk development)

**Untuk production, WAJIB pakai SSL/HTTPS!**

### Q32: Apakah ada biaya untuk menggunakan GPS?
**A:** TIDAK. Semua gratis:
- Geolocation API (browser native)
- OpenStreetMap Nominatim (free API)
- Tidak ada biaya tersembunyi

---

## 📱 Mobile & Device

### Q33: Apakah bisa digunakan di smartphone?
**A:** YA! Bahkan **LEBIH BAIK** di smartphone karena:
- GPS lebih akurat
- Touch interface lebih nyaman
- Responsive design optimized untuk mobile

### Q34: Apakah bisa digunakan di tablet?
**A:** YA! Layout responsive untuk semua ukuran layar.

### Q35: Kenapa GPS lebih akurat di HP daripada laptop?
**A:** Smartphone punya:
- Chip GPS dedicated
- A-GPS (Assisted GPS)
- GLONASS/Galileo support
- Better antenna

Laptop hanya pakai WiFi positioning (kurang akurat).

---

## 🎨 UI/UX

### Q36: Kenapa desain mirip Shopee/GoFood?
**A:** Karena user sudah familiar dengan UI tersebut. Ini membuat checkout lebih mudah dan intuitif.

### Q37: Apakah bisa custom warna/design?
**A:** YA! Edit file:
- `resources/views/roti.blade.php` (HTML/CSS)
- `public/js/checkout-modern.js` (JavaScript)

### Q38: Kenapa ada animasi loading?
**A:** Untuk memberikan feedback visual ke user bahwa sistem sedang bekerja (GPS detection, API call, dll).

---

## ⚙️ Configuration

### Q39: Dimana setting koordinat toko?
**A:** File: `public/js/checkout-modern.js` baris 7-8
```javascript
const STORE_LAT = -6.5971469; // Ganti ini
const STORE_LNG = 106.8060394; // Ganti ini
```

### Q40: Dimana setting harga ongkir?
**A:** File: `public/js/checkout-modern.js` baris 10-12
```javascript
const BASE_RATE = 5000; // Biaya dasar
const PER_KM_RATE = 2000; // Per km
const MAX_DISTANCE = 15; // Jarak maks
```

### Q41: Bagaimana cara dapat koordinat toko?
**A:**
1. Buka Google Maps
2. Cari alamat toko
3. Klik kanan pada pin → "What's here?"
4. Copy koordinat (contoh: -6.5971469, 106.8060394)

### Q42: Apakah bisa beda harga ongkir untuk area berbeda?
**A:** Saat ini sistem pakai formula linear (BASE_RATE + distance × PER_KM_RATE). Untuk harga berbeda per area, perlu custom logic tambahan.

### Q43: Bagaimana cara update harga ongkir?
**A:**
1. Edit `checkout-modern.js`
2. Ubah `BASE_RATE` dan `PER_KM_RATE`
3. Save file
4. Refresh browser (Ctrl+F5)
5. Test dengan deteksi lokasi

---

## 🧪 Testing

### Q44: Bagaimana cara test sistem?
**A:** Lihat file `GPS_TESTING_CHECKLIST.md` untuk checklist lengkap. Quick test:
1. Buka checkout
2. Klik "Deteksi Lokasi"
3. Cek alamat auto-fill ✅
4. Cek ongkir muncul ✅

### Q45: Apakah bisa test dengan lokasi palsu?
**A:** YA! Di Chrome:
1. F12 → Console
2. Ketik:
```javascript
selectAddress(-6.5980000, 106.8070000, 'Test Location');
```
3. Ongkir akan dihitung dari koordinat test

### Q46: Bagaimana cara test di berbagai lokasi?
**A:**
- Gunakan smartphone dan pindah lokasi fisik
- Atau gunakan browser developer tools untuk spoof GPS
- Atau gunakan console command `selectAddress()`

---

## 🚀 Deployment

### Q47: Apakah siap untuk production?
**A:** YA! Tapi pastikan:
- ✅ Koordinat toko sudah diset
- ✅ Harga ongkir sudah disesuaikan
- ✅ Testing sudah dilakukan
- ✅ HTTPS sudah aktif

### Q48: Apakah perlu install library tambahan?
**A:** TIDAK! Sistem menggunakan:
- Vanilla JavaScript (no dependencies)
- Browser native APIs
- Free public APIs

### Q49: Apakah ada biaya hosting khusus?
**A:** TIDAK. Hosting biasa sudah cukup. Yang penting:
- Support PHP & Laravel
- Support HTTPS/SSL
- Koneksi internet stabil

### Q50: Bagaimana cara backup data GPS?
**A:** Data GPS tersimpan di database (kolom `customer_lat`, `customer_lng`). Backup database secara regular dengan:
```bash
php artisan backup:run
```
Atau export manual dari phpMyAdmin.

---

## 📞 Support & Help

### Q51: Dimana saya bisa dapat bantuan?
**A:** 
1. Baca dokumentasi di folder ini
2. Cek Console (F12) untuk error
3. Lihat `GPS_TESTING_CHECKLIST.md`
4. Screenshot error dan kirim ke developer

### Q52: Apakah ada video tutorial?
**A:** Saat ini belum ada. Tapi dokumentasi sudah sangat lengkap dengan:
- Step-by-step guide
- Visual diagrams
- Code examples
- Troubleshooting tips

### Q53: Bagaimana cara request fitur baru?
**A:** Hubungi developer dengan detail:
- Fitur yang diinginkan
- Use case / skenario
- Mockup/sketch (jika ada)

---

## 💡 Tips & Tricks

### Q54: Tips untuk akurasi GPS maksimal?
**A:**
1. Gunakan smartphone (bukan laptop)
2. Test di outdoor (bukan dalam gedung)
3. Tunggu 5-10 detik untuk GPS lock
4. Pastikan GPS HP aktif
5. Pastikan internet stabil

### Q55: Tips untuk user experience terbaik?
**A:**
1. Berikan instruksi jelas ke customer
2. Test di berbagai device
3. Monitor error logs
4. Collect user feedback
5. Update harga ongkir berkala

### Q56: Tips untuk performa optimal?
**A:**
1. Gunakan CDN untuk assets
2. Enable browser caching
3. Compress images
4. Minify JavaScript
5. Use HTTPS/2

---

## 🎯 Best Practices

### Q57: Kapan sebaiknya update harga ongkir?
**A:**
- Saat BBM naik
- Saat kompetitor (Grab/GoFood) update harga
- Saat biaya operasional berubah
- Minimal review setiap 3-6 bulan

### Q58: Bagaimana cara handle customer complaint tentang ongkir?
**A:**
1. Jelaskan sistem perhitungan (fair berdasarkan jarak)
2. Tunjukkan jarak GPS sebenarnya
3. Bandingkan dengan Grab/GoFood
4. Tawarkan promo free ongkir untuk jarak tertentu

### Q59: Apakah perlu backup koordinat GPS customer?
**A:** YA! Berguna untuk:
- Analisis area delivery populer
- Optimasi rute kurir
- Marketing (area mana yang perlu promo)
- Dispute resolution

### Q60: Bagaimana cara optimize untuk SEO?
**A:** GPS checkout tidak langsung affect SEO, tapi:
- Fast loading time → better SEO
- Mobile-friendly → better ranking
- Good UX → lower bounce rate
- HTTPS → SEO boost

---

## 🎉 Success Stories

### Q61: Apa keuntungan menggunakan GPS checkout?
**A:**
- ✅ Ongkir lebih fair (sesuai jarak)
- ✅ Checkout lebih cepat (auto-fill)
- ✅ Alamat lebih akurat (GPS)
- ✅ UI lebih profesional (Shopee-like)
- ✅ Customer satisfaction meningkat

### Q62: Apakah customer suka fitur ini?
**A:** Berdasarkan feedback umum:
- 👍 "Gampang kayak Shopee!"
- 👍 "Ongkir fair, ga kemahalan"
- 👍 "Ga perlu ketik alamat panjang"
- 👍 "Cepet banget checkoutnya"

---

**Masih ada pertanyaan?**
- Baca dokumentasi lengkap di folder ini
- Cek `GPS_CHECKOUT_GUIDE.md` untuk technical details
- Lihat `GPS_SYSTEM_DIAGRAM.md` untuk visual flow
- Test dengan `GPS_TESTING_CHECKLIST.md`

**Happy selling!** 🚀
