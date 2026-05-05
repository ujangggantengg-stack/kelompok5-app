# 🎯 Setup Google OAuth - Panduan Super Mudah!

## 🚀 Cara Tercepat (5 Menit)

### Opsi 1: Jalankan Script Otomatis
```bash
# Double-click file ini:
setup-google-oauth.bat
```
Script akan otomatis buka Google Cloud Console!

### Opsi 2: Manual (Ikuti Step by Step)

---

## 📝 Step 1: Buat Project

**Link:** https://console.cloud.google.com/projectcreate

1. **Project name:** `TokoRoti`
2. Klik **"CREATE"**
3. Tunggu 10 detik

✅ **Done!**

---

## 📝 Step 2: Enable Google+ API

**Link:** https://console.cloud.google.com/apis/library/plus.googleapis.com

1. Pastikan project "TokoRoti" terpilih (atas kiri)
2. Klik **"ENABLE"**
3. Tunggu 5 detik

✅ **Done!**

---

## 📝 Step 3: OAuth Consent Screen

**Link:** https://console.cloud.google.com/apis/credentials/consent

### Halaman 1: OAuth consent screen
- Pilih **"External"**
- Klik **"CREATE"**

### Halaman 2: Edit app registration
Isi form ini:

```
App name: Toko Roti
User support email: [pilih email Anda dari dropdown]
App logo: [skip - kosongkan]
App domain: [skip - kosongkan]
Authorized domains: [skip - kosongkan]
Developer contact information: [ketik email Anda]
```

Klik **"SAVE AND CONTINUE"**

### Halaman 3: Scopes
- Jangan tambah apa-apa
- Klik **"SAVE AND CONTINUE"**

### Halaman 4: Test users
- Jangan tambah apa-apa
- Klik **"SAVE AND CONTINUE"**

### Halaman 5: Summary
- Klik **"BACK TO DASHBOARD"**

✅ **Done!**

---

## 📝 Step 4: Buat OAuth Client ID

**Link:** https://console.cloud.google.com/apis/credentials

1. Klik **"+ CREATE CREDENTIALS"** (atas)
2. Pilih **"OAuth client ID"**

### Form Create OAuth client ID:

```
Application type: Web application
Name: Toko Roti Web
```

### Authorized JavaScript origins:
**KOSONGKAN** (tidak perlu diisi)

### Authorized redirect URIs:
Klik **"+ ADD URI"** dan tambahkan 2 URL ini:

```
http://localhost:8000/auth/google/callback
```

Klik **"+ ADD URI"** lagi:

```
http://127.0.0.1:8000/auth/google/callback
```

Klik **"CREATE"**

✅ **Done!**

---

## 📝 Step 5: Copy Credentials

Setelah klik CREATE, akan muncul popup **"OAuth client created"**:

### Copy 2 hal ini:

1. **Your Client ID**
   ```
   Contoh: 123456789-abc123def456ghi789.apps.googleusercontent.com
   ```
   Klik icon copy di sebelah kanan

2. **Your Client Secret**
   ```
   Contoh: GOCSPX-AbCdEfGhIjKlMnOpQrStUv
   ```
   Klik icon copy di sebelah kanan

Klik **"OK"**

✅ **Done!**

---

## 📝 Step 6: Update File .env

Buka file `.env` di project Anda.

Cari bagian ini:

```env
# Google OAuth (Development - Perlu diganti dengan credentials sendiri)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

**Paste credentials yang tadi di-copy:**

```env
# Google OAuth (Development - Perlu diganti dengan credentials sendiri)
GOOGLE_CLIENT_ID=123456789-abc123def456ghi789.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-AbCdEfGhIjKlMnOpQrStUv
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

**Save file .env** (Ctrl + S)

✅ **Done!**

---

## 📝 Step 7: Clear Cache Laravel

Buka terminal/command prompt di folder project:

```bash
php artisan config:clear
```

Output:
```
Configuration cache cleared successfully.
```

✅ **Done!**

---

## 📝 Step 8: Test Login Google!

### Buka browser:
```
http://127.0.0.1:8000/customer/login
```

### Anda akan lihat:
- ✅ Tombol **"Masuk dengan Google"** (dengan logo Google)
- ✅ Form email/password

### Klik tombol "Masuk dengan Google":
1. Pilih akun Google Anda
2. Klik "Continue" atau "Lanjutkan"
3. **BOOM!** Anda sudah login! 🎉

### Cek di header:
- ✅ Avatar Google Anda muncul
- ✅ Nama Anda muncul
- ✅ Dropdown menu (Profile, Pesanan, Alamat, Logout)

✅ **SELESAI!**

---

## 🎉 Selamat!

Sekarang sistem login Google sudah aktif!

### User bisa:
- ✅ Login dengan Google (1 klik)
- ✅ Register dengan Google (1 klik)
- ✅ Foto profil otomatis
- ✅ Email terverifikasi
- ✅ Tidak perlu ingat password

### Anda bisa:
- ✅ Dapat data user lengkap
- ✅ Email valid dari Google
- ✅ Reduce friction saat register
- ✅ Increase conversion rate

---

## 🐛 Troubleshooting

### Tombol Google tidak muncul?

**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear
```
Refresh browser (Ctrl + F5)

### Error "redirect_uri_mismatch"?

**Penyebab:** Redirect URI tidak cocok

**Solusi:**
1. Buka: https://console.cloud.google.com/apis/credentials
2. Klik nama OAuth client ("Toko Roti Web")
3. Cek "Authorized redirect URIs"
4. Pastikan ada: `http://127.0.0.1:8000/auth/google/callback`
5. Klik "SAVE"
6. Tunggu 1 menit
7. Test lagi

### Error "invalid_client"?

**Penyebab:** Client ID atau Secret salah

**Solusi:**
1. Buka: https://console.cloud.google.com/apis/credentials
2. Klik nama OAuth client ("Toko Roti Web")
3. Copy ulang Client ID dan Secret
4. Paste ke `.env`
5. Pastikan tidak ada spasi di awal/akhir
6. Save `.env`
7. Run: `php artisan config:clear`
8. Test lagi

### Error "access_blocked"?

**Penyebab:** App belum verified (normal untuk development)

**Solusi:**
1. Di halaman Google login, klik "Advanced"
2. Klik "Go to Toko Roti (unsafe)"
3. Klik "Continue"
4. Done!

**Note:** Ini normal untuk development. Untuk production, perlu verify app.

---

## 📚 File Terkait

- `SETUP_GOOGLE_CEPAT.md` - Panduan ringkas
- `GOOGLE_OAUTH_SETUP.md` - Panduan lengkap
- `setup-google-oauth.bat` - Script otomatis
- `.env` - File konfigurasi
- `config/services.php` - Config Google OAuth

---

## 🎯 Next Steps

Setelah Google OAuth jalan:

1. **Test dengan beberapa akun Google**
2. **Cek data tersimpan di database** (tabel `customers`)
3. **Test logout dan login lagi**
4. **Test di mobile browser**

---

**Total waktu setup: 5 menit**  
**Difficulty: ⭐⭐☆☆☆ (Mudah)**

**Selamat mencoba!** 🚀

