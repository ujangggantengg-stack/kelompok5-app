# 🔐 Google OAuth Setup Guide

> **Status:** Optional - Tombol Google saat ini disembunyikan  
> **Aktifkan:** Tambahkan credentials ke `.env`

---

## 📋 Cara Setup Google OAuth

### Step 1: Buat Project di Google Cloud Console

1. **Buka Google Cloud Console:**
   - Kunjungi: https://console.cloud.google.com/

2. **Buat Project Baru:**
   - Klik "Select a project" → "New Project"
   - Nama project: `Toko Roti` (atau nama lain)
   - Klik "Create"

### Step 2: Enable Google+ API

1. **Buka API Library:**
   - Di sidebar, pilih "APIs & Services" → "Library"

2. **Cari dan Enable:**
   - Cari "Google+ API"
   - Klik "Enable"

### Step 3: Buat OAuth 2.0 Credentials

1. **Buka Credentials:**
   - Di sidebar, pilih "APIs & Services" → "Credentials"

2. **Configure Consent Screen:**
   - Klik "Configure Consent Screen"
   - Pilih "External" → "Create"
   - Isi informasi:
     - App name: `Toko Roti`
     - User support email: email Anda
     - Developer contact: email Anda
   - Klik "Save and Continue"
   - Skip "Scopes" → "Save and Continue"
   - Skip "Test users" → "Save and Continue"

3. **Create OAuth Client ID:**
   - Klik "Create Credentials" → "OAuth client ID"
   - Application type: "Web application"
   - Name: `Toko Roti Web Client`
   
4. **Authorized redirect URIs:**
   Tambahkan URL berikut (sesuaikan dengan domain Anda):
   
   **Development:**
   ```
   http://localhost:8000/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback
   ```
   
   **Production (nanti):**
   ```
   https://yourdomain.com/auth/google/callback
   ```

5. **Klik "Create"**
   - Copy **Client ID** dan **Client Secret**

### Step 4: Update .env File

Tambahkan credentials ke file `.env`:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your-client-id-here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

**Contoh:**
```env
GOOGLE_CLIENT_ID=123456789-abcdefghijklmnop.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-AbCdEfGhIjKlMnOpQrStUvWx
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### Step 5: Clear Cache & Test

```bash
php artisan config:clear
php artisan cache:clear
```

Sekarang tombol "Masuk dengan Google" akan muncul di halaman login!

---

## 🧪 Testing

1. **Buka halaman login:**
   ```
   http://localhost:8000/customer/login
   ```

2. **Klik "Masuk dengan Google"**

3. **Pilih akun Google**

4. **Berhasil!** Anda akan diarahkan ke homepage dan sudah login

---

## 🔒 Security Notes

### Development:
- ✅ Gunakan `http://localhost:8000` untuk testing
- ✅ Client Secret aman di `.env` (tidak di-commit ke Git)

### Production:
- ⚠️ Ganti `APP_URL` ke domain production
- ⚠️ Update redirect URI di Google Console
- ⚠️ Gunakan HTTPS (wajib untuk production)
- ⚠️ Jangan commit `.env` ke Git

---

## 🐛 Troubleshooting

### Error: "redirect_uri_mismatch"
**Solusi:**
- Pastikan redirect URI di Google Console sama persis dengan di `.env`
- Cek tidak ada trailing slash (`/`)
- Cek http vs https

### Error: "invalid_client"
**Solusi:**
- Cek Client ID dan Client Secret sudah benar
- Clear cache: `php artisan config:clear`

### Error: "access_denied"
**Solusi:**
- User membatalkan login
- Atau app belum di-approve (untuk production)

### Tombol Google tidak muncul
**Solusi:**
- Pastikan `GOOGLE_CLIENT_ID` sudah ada di `.env`
- Clear cache: `php artisan config:clear`
- Refresh browser

---

## 📱 Cara Kerja

1. User klik "Masuk dengan Google"
2. Redirect ke Google OAuth
3. User pilih akun Google
4. Google redirect kembali ke `/auth/google/callback`
5. System buat/update customer di database
6. Auto login
7. Redirect ke homepage

---

## 💾 Data yang Disimpan

Dari Google, kita ambil:
- ✅ Name (nama lengkap)
- ✅ Email
- ✅ Avatar (foto profil)
- ✅ Google ID (untuk link account)

Data ini disimpan di tabel `customers`.

---

## 🎯 Benefits

**Untuk User:**
- ✅ Login cepat tanpa password
- ✅ Tidak perlu ingat password
- ✅ Foto profil otomatis
- ✅ Email terverifikasi

**Untuk Business:**
- ✅ Reduce friction saat register
- ✅ Email valid (dari Google)
- ✅ Increase conversion rate
- ✅ Better user experience

---

## 🔄 Update untuk Production

Saat deploy ke production:

1. **Update Google Console:**
   - Tambah production redirect URI
   - Contoh: `https://tokoroti.com/auth/google/callback`

2. **Update .env production:**
   ```env
   APP_URL=https://tokoroti.com
   GOOGLE_REDIRECT_URI=https://tokoroti.com/auth/google/callback
   ```

3. **Publish App (Optional):**
   - Untuk production, publish OAuth consent screen
   - Atau tetap "Testing" (max 100 users)

---

## 📚 Related Files

- `app/Http/Controllers/Auth/GoogleController.php` - OAuth logic
- `config/services.php` - Google config
- `routes/web.php` - OAuth routes
- `resources/views/auth/customer/login.blade.php` - Login page
- `resources/views/auth/customer/register.blade.php` - Register page

---

## ✅ Checklist

Setup Google OAuth:
- [ ] Buat project di Google Cloud Console
- [ ] Enable Google+ API
- [ ] Configure OAuth consent screen
- [ ] Create OAuth client ID
- [ ] Copy Client ID & Secret
- [ ] Update `.env` file
- [ ] Clear cache
- [ ] Test login dengan Google
- [ ] Verify data tersimpan di database

---

**Status Saat Ini:** Tombol Google disembunyikan (belum ada credentials)  
**Untuk Aktifkan:** Ikuti step di atas dan tambahkan credentials ke `.env`

**Last Updated:** 3 Mei 2026

