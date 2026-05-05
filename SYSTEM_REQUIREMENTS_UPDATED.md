# DOKUMEN KEBUTUHAN SISTEM - UPDATED
## Aplikasi Penjualan Roti Berbasis Web "Dapoer Budess"

---

## 3.1 Analisis Pengguna
9
Aplikasi penjualan roti berbasis web ini memiliki **tiga jenis pengguna**, yaitu Admin, Pelanggan Terdaftar, dan Pelanggan Tamu.

### 1. Admin
Admin merupakan pengguna yang memiliki hak akses penuh terhadap sistem. Admin bertanggung jawab dalam mengelola data dan operasional aplikasi, mulai dari pengelolaan produk, pengelolaan pesanan, hingga pembuatan laporan penjualan.

### 2. Pelanggan Terdaftar (Customer Account) ⭐ **FITUR BARU**
Pelanggan yang membuat akun di sistem dengan cara:
- **Registrasi manual** menggunakan email dan password
- **Login dengan Google OAuth** untuk kemudahan akses

Pelanggan terdaftar mendapatkan keuntungan:
- Menyimpan alamat pengiriman untuk checkout lebih cepat
- Melihat riwayat pesanan
- Tracking status pesanan real-time
- Reorder dengan 1 klik
- Chat dengan admin tanpa input nomor HP berulang

### 3. Pelanggan Tamu (Guest)
Pelanggan yang melakukan pemesanan tanpa login. Dapat langsung melakukan pemesanan dengan mengisi data diri saat checkout. Untuk meningkatkan keamanan, pelanggan diwajibkan mengisi captcha sebelum menyelesaikan proses pemesanan agar terhindar dari aktivitas tidak valid (bot).

---

## 3.2 Kebutuhan Fungsional

### 3.2.1. Kebutuhan Fungsional Admin

Sistem harus dapat:

**Manajemen Akses:**
- Menyediakan fitur login dan logout untuk admin

**Manajemen Produk:**
- Mengelola data produk roti (Create, Read, Update, Delete)
- Mengatur status stok produk (Tersedia, Pre-order, Habis)
- Mengelola promo dan diskon produk ⭐ **FITUR BARU**
- Mengatur badge produk (Best Seller, New, Promo) ⭐ **FITUR BARU**

**Manajemen Pesanan:**
- Melihat daftar pesanan pelanggan
- Mengubah status pesanan:
  - Menunggu Pembayaran
  - Diproses
  - Dikirim ⭐ **UPDATED**
  - Selesai
  - Dibatalkan
- Melihat detail pesanan pelanggan, meliputi:
  - Nama pelanggan
  - Nomor HP
  - Alamat lengkap (dengan detail RT/RW, Kecamatan, Provinsi, Kode Pos) ⭐ **UPDATED**
  - Cara pengambilan (Ambil di Tempat / Diantar)
  - Metode pembayaran (QRIS)
  - Biaya ongkir (untuk pengiriman) ⭐ **FITUR BARU**
  - Koordinat GPS lokasi pengiriman ⭐ **FITUR BARU**
- Mengonfirmasi pembayaran
- Mengatur informasi pengiriman ⭐ **FITUR BARU**

**Manajemen Ongkir:** ⭐ **FITUR BARU**
- Mengatur tarif ongkir berdasarkan jarak
- Mengelola zona pengiriman
- Melihat estimasi jarak dan biaya

**Operasional Toko:**
- Mengatur jam operasional toko (jam buka dan tutup)
- Menutup pemesanan secara otomatis di luar jam operasional

**Laporan & Analitik:**
- Melihat grafik penjualan:
  - Grafik penjualan harian
  - Grafik penjualan bulanan
- Menginput data pemasukan penjualan
- Melihat laporan penjualan bulanan
- Mencetak laporan penjualan

**Komunikasi:**
- Menerima dan membalas pesan dari pelanggan
- Melihat notifikasi pesanan baru ⭐ **FITUR BARU**
- Melihat notifikasi pesan baru ⭐ **FITUR BARU**

**Pengaturan Pembayaran:** ⭐ **FITUR BARU**
- Upload dan kelola QRIS image
- Mengatur metode pembayaran

---

### 3.2.2. Kebutuhan Fungsional Pelanggan Terdaftar ⭐ **FITUR BARU**

Sistem harus dapat:

**Autentikasi:**
- Registrasi akun dengan email dan password
- Login dengan email dan password
- Login dengan Google OAuth (Single Sign-On)
- Logout dari akun
- Lupa password (reset password)

**Manajemen Profile:**
- Melihat dan mengedit informasi profile
- Upload foto profile/avatar
- Mengubah password
- Melihat informasi akun (email, nama, nomor HP)

**Manajemen Alamat:**
- Menambah alamat pengiriman baru
- Mengedit alamat yang sudah ada
- Menghapus alamat
- Mengatur alamat utama (primary address)
- Menyimpan multiple alamat
- Detail alamat meliputi:
  - Label alamat (Rumah, Kantor, dll)
  - Nama penerima
  - Nomor telepon
  - Nama jalan
  - No. Rumah & RT/RW
  - Detail alamat
  - Kecamatan
  - Kota
  - Provinsi
  - Kode Pos

**Manajemen Pesanan:**
- Melihat riwayat pesanan
- Melihat detail pesanan
- Tracking status pesanan real-time
- Reorder pesanan sebelumnya dengan 1 klik
- Filter pesanan berdasarkan status

**Proses Pemesanan:**
- Auto-fill data dari profile saat checkout
- Pilih alamat tersimpan saat checkout
- Perhitungan ongkir otomatis berdasarkan alamat
- Deteksi lokasi GPS untuk estimasi ongkir
- Menyimpan pesanan ke akun

**Komunikasi:**
- Chat dengan admin
- Melihat riwayat chat
- Notifikasi pesan baru dari admin

---

### 3.2.3. Kebutuhan Fungsional Pelanggan Tamu (Guest)

Sistem harus dapat:

**Browsing & Pemesanan:**
- Menampilkan landing page dengan hero slider ⭐ **UPDATED**
- Menampilkan daftar produk roti dengan filter dan sort ⭐ **UPDATED**
- Menampilkan detail produk roti
- Menampilkan badge produk (Best Seller, Promo, New) ⭐ **FITUR BARU**
- Menampilkan promo banner dengan countdown timer ⭐ **FITUR BARU**
- Menyediakan fitur keranjang belanja
- Menyimpan data keranjang pelanggan (localStorage)

**Checkout:**
- Menyediakan pilihan cara pengambilan pesanan:
  - Ambil di Tempat
  - Diantar
- Menyediakan form data diri pelanggan dengan field lengkap ⭐ **UPDATED**
- Deteksi lokasi GPS untuk perhitungan ongkir ⭐ **FITUR BARU**
- Auto-geocoding alamat untuk estimasi jarak ⭐ **FITUR BARU**
- Perhitungan ongkir otomatis berdasarkan jarak ⭐ **FITUR BARU**
- Menyediakan metode pembayaran QRIS
- Menampilkan QRIS sesuai total pembayaran
- Menerapkan captcha sebelum pelanggan menyelesaikan pesanan
- Verifikasi OTP untuk keamanan ⭐ **FITUR BARU**

**Pasca Pemesanan:**
- Menyimpan data pesanan pelanggan
- Menampilkan informasi bahwa pesanan berhasil dibuat
- Tracking pesanan via nomor HP
- Upload bukti pembayaran
- Chat dengan admin via nomor HP

**UI/UX Enhancement:** ⭐ **FITUR BARU**
- Responsive design untuk desktop, tablet, dan mobile
- Smooth scrolling dan animasi
- Product quick view modal
- Back to top button
- Loading states dan skeleton screens
- Toast notifications
- Enhanced product cards dengan hover effects

---

## 3.3 Kebutuhan Non-Fungsional

### Keamanan

**Autentikasi & Otorisasi:**
- Sistem login admin menggunakan username dan password
- Sistem login pelanggan dengan email/password atau Google OAuth ⭐ **FITUR BARU**
- Password hashing menggunakan bcrypt
- Session management dengan CSRF protection
- Multi-guard authentication (admin & customer) ⭐ **FITUR BARU**

**Validasi & Proteksi:**
- Captcha pada proses pemesanan untuk mencegah bot
- OTP verification untuk keamanan transaksi ⭐ **FITUR BARU**
- Input validation dan sanitization
- XSS protection
- SQL injection prevention

**Data Security:**
- Data pesanan dan pembayaran tersimpan dengan aman di database
- Enkripsi data sensitif
- Secure file upload untuk bukti pembayaran
- HTTPS untuk production ⭐ **RECOMMENDED**

---

### Performa

**Response Time:**
- Aplikasi mampu menampilkan data produk dan pesanan dengan cepat (< 2 detik)
- Lazy loading untuk gambar produk ⭐ **FITUR BARU**
- Optimized database queries dengan indexing
- Caching untuk data yang sering diakses ⭐ **RECOMMENDED**

**Scalability:**
- Sistem dapat menangani beberapa pemesanan secara bersamaan
- Session storage yang efisien (file-based atau database)
- Optimized asset loading (CSS/JS minification) ⭐ **RECOMMENDED**

**Reliability:**
- Error handling yang proper
- Logging untuk debugging
- Backup database regular ⭐ **RECOMMENDED**

---

### Usability (Kemudahan Penggunaan)

**User Interface:**
- Tampilan aplikasi mudah digunakan dan dipahami oleh pengguna
- Desain modern dan menarik dengan tema bakery ⭐ **UPDATED**
- Konsisten dalam penggunaan warna, font, dan spacing
- Clear call-to-action buttons
- Informative error messages

**User Experience:**
- Proses pemesanan dibuat sederhana (dengan atau tanpa login)
- Auto-fill data untuk pelanggan terdaftar ⭐ **FITUR BARU**
- Auto-calculate ongkir untuk kemudahan ⭐ **FITUR BARU**
- Progress indicator pada checkout ⭐ **FITUR BARU**
- Real-time feedback (toast notifications, loading states) ⭐ **FITUR BARU**
- Smooth animations dan transitions ⭐ **FITUR BARU**

**Accessibility:**
- Keyboard navigation support
- Proper form labels
- Alt text untuk images
- Readable font sizes
- High contrast colors

---

### Kompatibilitas

**Browser Support:**
- Google Chrome (latest)
- Mozilla Firefox (latest)
- Safari (latest)
- Microsoft Edge (latest)
- Opera (latest)

**Device Support:**
- Desktop (Windows, macOS, Linux)
- Tablet (iPad, Android tablets)
- Mobile (iOS, Android)
- Responsive breakpoints:
  - Desktop: > 1024px
  - Tablet: 768px - 1024px
  - Mobile: < 768px

**Screen Resolutions:**
- Minimum: 320px (mobile)
- Optimal: 1920px (desktop)
- Support untuk retina displays

---

## 3.4 Fitur Tambahan yang Diimplementasikan ⭐ **NEW SECTION**

### Customer Account System
- Registrasi dan login pelanggan
- Google OAuth integration
- Profile management
- Address management (CRUD)
- Order history dan tracking

### GPS & Shipping Calculator
- GPS location detection
- Auto-geocoding dari alamat text
- Distance calculation menggunakan Haversine formula
- Dynamic shipping cost calculation
- Shipping zones management

### Enhanced UI/UX
- Hero slider dengan auto-slide
- Promo banner dengan countdown timer
- Product quick view modal
- Responsive product grid
- Back to top button
- Smooth scrolling
- Loading skeletons
- Toast notifications
- Micro-interactions dan animations

### Admin Enhancements
- Notification system untuk pesanan baru
- Notification system untuk pesan baru
- Payment settings management
- Shipping rates management
- Enhanced order details dengan GPS coordinates

### Communication
- Real-time chat antara customer dan admin
- Chat notification dengan badge counter
- Message threading
- Unread message tracking

---

## 3.5 Teknologi yang Digunakan ⭐ **NEW SECTION**

### Backend
- **Framework:** Laravel 12
- **PHP Version:** 8.3+
- **Database:** MySQL
- **Authentication:** Laravel Multi-Guard (Admin & Customer)
- **Session:** File-based atau Database

### Frontend
- **Template Engine:** Blade
- **CSS Framework:** Custom CSS dengan Tailwind (untuk auth pages)
- **JavaScript:** Vanilla JS
- **Icons:** Font Awesome
- **Fonts:** Google Fonts (Playfair Display, Lora, Outfit, Great Vibes)
- **Animations:** AOS (Animate On Scroll)

### Third-Party Services
- **Google OAuth:** Socialite Laravel
- **Maps/Geocoding:** OpenStreetMap Nominatim API
- **Payment:** QRIS (Static)

### Development Tools
- **Version Control:** Git
- **Package Manager:** Composer (PHP), NPM (optional)
- **Server:** Laravel Artisan (development), Apache/Nginx (production)

---

## 3.6 Perbandingan Fitur Lama vs Baru

| Aspek | Versi Lama | Versi Baru ⭐ |
|-------|-----------|--------------|
| **User Management** | Hanya guest checkout | Guest + Registered customers dengan Google OAuth |
| **Address Management** | Input manual setiap checkout | Simpan multiple alamat, auto-fill |
| **Shipping Cost** | Manual input atau fixed | Auto-calculate berdasarkan GPS/jarak |
| **Order Tracking** | Via nomor HP saja | Via akun + nomor HP |
| **UI/UX** | Basic design | Modern, responsive, animated |
| **Product Display** | Simple grid | Enhanced cards dengan quick view, badges |
| **Homepage** | Static | Hero slider, promo banner, countdown |
| **Navigation** | Basic navbar | Sticky header dengan smooth scroll |
| **Notifications** | Tidak ada | Real-time untuk chat dan pesanan |
| **Profile Management** | Tidak ada | Full profile dengan avatar upload |
| **Reorder** | Manual | 1-click reorder dari history |
| **Chat** | Input HP setiap kali | Persistent untuk registered users |

---

## 3.7 Roadmap & Future Enhancements 🚀

### Short Term (1-3 bulan)
- [ ] Email notifications untuk status pesanan
- [ ] WhatsApp integration untuk notifikasi
- [ ] Product reviews dan ratings
- [ ] Wishlist functionality
- [ ] Promo code system

### Medium Term (3-6 bulan)
- [ ] Mobile app (React Native / Flutter)
- [ ] Multiple payment gateways (Midtrans, Xendit)
- [ ] Loyalty points system
- [ ] Advanced analytics dashboard
- [ ] Inventory management

### Long Term (6-12 bulan)
- [ ] Multi-vendor support
- [ ] Subscription/recurring orders
- [ ] AI-powered product recommendations
- [ ] Advanced reporting dengan export
- [ ] API untuk integrasi third-party

---

**Dokumen ini dibuat pada:** Mei 2026  
**Versi:** 2.0 (Updated)  
**Status:** ✅ Implemented & Production Ready
