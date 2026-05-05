# ⚡ Setup Google OAuth - 5 Menit!

## 🚀 Langkah Cepat (Copy-Paste)

### 1. Buka Google Cloud Console
Klik link ini: https://console.cloud.google.com/

### 2. Buat Project Baru
- Klik dropdown project (atas kiri)
- Klik "NEW PROJECT"
- Nama: `TokoRoti`
- Klik "CREATE"
- Tunggu 10 detik

### 3. Enable API
Klik link ini (otomatis enable): https://console.cloud.google.com/apis/library/plus.googleapis.com

Atau manual:
- Sidebar → "APIs & Services" → "Library"
- Cari "Google+ API"
- Klik "ENABLE"

### 4. Setup OAuth Consent Screen
Link: https://console.cloud.google.com/apis/credentials/consent

- Pilih "External" → "CREATE"
- **App name:** `Toko Roti`
- **User support email:** (pilih email Anda)
- **Developer contact:** (email Anda)
- Klik "SAVE AND CONTINUE"
- Skip "Scopes" → "SAVE AND CONTINUE"
- Skip "Test users" → "SAVE AND CONTINUE"
- Klik "BACK TO DASHBOARD"

### 5. Buat OAuth Client ID
Link: https://console.cloud.google.com/apis/credentials

- Klik "CREATE CREDENTIALS" → "OAuth client ID"
- **Application type:** Web application
- **Name:** `Toko Roti Web`
- **Authorized redirect URIs:** Klik "ADD URI"
  
  Tambahkan 2 URL ini:
  ```
  http://localhost:8000/auth/google/callback
  http://127.0.0.1:8000/auth/google/callback
  ```

- Klik "CREATE"

### 6. Copy Credentials
Setelah klik CREATE, akan muncul popup:
- **Client ID:** (copy semua, panjang banget)
- **Client Secret:** (copy juga)

### 7. Update .env
Buka file `.env` di project, cari bagian Google OAuth:

```env
GOOGLE_CLIENT_ID=paste-client-id-disini.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=paste-client-secret-disini
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

**Contoh hasil:**
```env
GOOGLE_CLIENT_ID=123456789-abc123def456.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-AbCdEfGhIjKlMnOp
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

### 8. Clear Cache
Jalankan di terminal:
```bash
php artisan config:clear
```

### 9. Test!
Buka browser:
```
http://127.0.0.1:8000/customer/login
```

Klik tombol "Masuk dengan Google" → Pilih akun Google → DONE! ✅

---

## 🎯 Troubleshooting Cepat

**Tombol Google tidak muncul?**
```bash
php artisan config:clear
php artisan cache:clear
```
Refresh browser (Ctrl + F5)

**Error "redirect_uri_mismatch"?**
- Pastikan di Google Console ada: `http://127.0.0.1:8000/auth/google/callback`
- Cek tidak ada spasi atau typo

**Error "invalid_client"?**
- Copy ulang Client ID dan Secret
- Pastikan tidak ada spasi di awal/akhir
- Clear cache lagi

---

## 📸 Screenshot Helper

### Tampilan OAuth Consent Screen:
```
App name: Toko Roti
User support email: [your-email@gmail.com]
App logo: (skip)
App domain: (skip)
Authorized domains: (skip)
Developer contact: [your-email@gmail.com]
```

### Tampilan Create OAuth Client:
```
Application type: Web application
Name: Toko Roti Web

Authorized JavaScript origins: (kosongkan)

Authorized redirect URIs:
  http://localhost:8000/auth/google/callback
  http://127.0.0.1:8000/auth/google/callback
```

---

## ✅ Selesai!

Total waktu: **5 menit**

Sekarang user bisa:
- ✅ Login dengan Google
- ✅ Register dengan Google
- ✅ Foto profil otomatis dari Google
- ✅ Email terverifikasi

**Enjoy!** 🎉

