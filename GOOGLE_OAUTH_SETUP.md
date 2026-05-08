# 🔐 Panduan Setup Google OAuth Login

## 📋 Langkah-Langkah Mendapatkan Google Client ID & Secret

### STEP 1: Buka Google Cloud Console

1. Buka browser dan kunjungi: **https://console.cloud.google.com/**
2. Login dengan akun Google Anda

---

### STEP 2: Buat Project Baru (atau Pilih Project yang Ada)

#### Jika Belum Punya Project:

1. Klik dropdown **"Select a project"** di bagian atas
2. Klik tombol **"NEW PROJECT"**
3. Isi nama project: **"Dapoer Budess"** (atau nama lain)
4. Klik **"CREATE"**
5. Tunggu beberapa detik sampai project dibuat
6. Pilih project yang baru dibuat

#### Jika Sudah Punya Project:

1. Klik dropdown **"Select a project"**
2. Pilih project yang ingin digunakan

---

### STEP 3: Aktifkan Google+ API

1. Di sidebar kiri, klik **"APIs & Services"** → **"Library"**
2. Cari **"Google+ API"** di search box
3. Klik **"Google+ API"**
4. Klik tombol **"ENABLE"**
5. Tunggu sampai API aktif

**ATAU** cari **"Google Identity"** dan aktifkan

---

### STEP 4: Buat OAuth Consent Screen

1. Di sidebar kiri, klik **"APIs & Services"** → **"OAuth consent screen"**
2. Pilih **"External"** (untuk testing)
3. Klik **"CREATE"**

#### Isi Form OAuth Consent Screen:

**App Information:**
- **App name**: `Dapoer Budess`
- **User support email**: Pilih email Anda
- **App logo**: (opsional, bisa diisi nanti)

**App Domain:**
- **Application home page**: `http://127.0.0.1:8000`
- **Application privacy policy link**: `http://127.0.0.1:8000/privacy` (buat halaman ini nanti)
- **Application terms of service link**: `http://127.0.0.1:8000/terms` (buat halaman ini nanti)

**Developer contact information:**
- **Email addresses**: Masukkan email Anda

4. Klik **"SAVE AND CONTINUE"**

#### Scopes (Langkah 2):
1. Klik **"ADD OR REMOVE SCOPES"**
2. Pilih scope berikut:
   - `userinfo.email`
   - `userinfo.profile`
   - `openid`
3. Klik **"UPDATE"**
4. Klik **"SAVE AND CONTINUE"**

#### Test Users (Langkah 3):
1. Klik **"ADD USERS"**
2. Masukkan email Anda untuk testing
3. Klik **"ADD"**
4. Klik **"SAVE AND CONTINUE"**

5. Review dan klik **"BACK TO DASHBOARD"**

---

### STEP 5: Buat OAuth 2.0 Credentials

1. Di sidebar kiri, klik **"APIs & Services"** → **"Credentials"**
2. Klik tombol **"+ CREATE CREDENTIALS"** di atas
3. Pilih **"OAuth client ID"**

#### Isi Form Create OAuth Client ID:

**Application type:**
- Pilih **"Web application"**

**Name:**
- Isi: `Dapoer Budess Web Client`

**Authorized JavaScript origins:**
- Klik **"+ ADD URI"**
- Masukkan: `http://127.0.0.1:8000`
- Klik **"+ ADD URI"** lagi
- Masukkan: `http://localhost:8000`

**Authorized redirect URIs:**
- Klik **"+ ADD URI"**
- Masukkan: `http://127.0.0.1:8000/auth/google/callback`
- Klik **"+ ADD URI"** lagi
- Masukkan: `http://localhost:8000/auth/google/callback`

4. Klik **"CREATE"**

---

### STEP 6: Copy Client ID & Client Secret

Setelah klik CREATE, akan muncul popup dengan:

```
OAuth client created

Your Client ID
xxxxxxxxxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.apps.googleusercontent.com

Your Client Secret
GOCSPX-xxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

**PENTING:** Copy kedua nilai ini!

---

### STEP 7: Masukkan ke File .env

1. Buka file `.env` di project Laravel Anda
2. Cari baris berikut:

```env
GOOGLE_CLIENT_ID=masukkan_client_id_disini
GOOGLE_CLIENT_SECRET=masukkan_client_secret_disini
```

3. Ganti dengan nilai yang Anda copy:

```env
GOOGLE_CLIENT_ID=xxxxxxxxxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-xxxxxxxxxxxxxxxxxxxxxxxxxxxx
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

4. **SAVE** file `.env`

---

### STEP 8: Restart Laravel Server

```bash
# Stop server (Ctrl + C)
# Start server lagi
php artisan serve
```

---

## ✅ Testing Login Google

1. Buka browser: `http://127.0.0.1:8000/login`
2. Klik tombol **"Masuk dengan Google"**
3. Pilih akun Google Anda
4. Klik **"Allow"** untuk memberikan akses
5. Anda akan diarahkan kembali ke website dan otomatis login

---

## 🔧 Troubleshooting

### Error: "redirect_uri_mismatch"

**Penyebab:** URL redirect tidak sesuai dengan yang didaftarkan di Google Console

**Solusi:**
1. Cek file `.env`, pastikan `GOOGLE_REDIRECT_URI` sama persis dengan yang di Google Console
2. Pastikan tidak ada typo atau spasi
3. Pastikan menggunakan `http://127.0.0.1:8000` bukan `http://localhost:8000` (atau sebaliknya)

### Error: "Access blocked: This app's request is invalid"

**Penyebab:** OAuth Consent Screen belum dikonfigurasi dengan benar

**Solusi:**
1. Kembali ke Google Cloud Console
2. Pergi ke **OAuth consent screen**
3. Pastikan semua field wajib sudah diisi
4. Tambahkan email Anda sebagai Test User

### Error: "The OAuth client was not found"

**Penyebab:** Client ID salah atau belum dibuat

**Solusi:**
1. Cek kembali Client ID di Google Cloud Console
2. Copy ulang dan paste ke `.env`
3. Restart Laravel server

---

## 📸 Screenshot Referensi

### 1. Google Cloud Console - Dashboard
```
┌─────────────────────────────────────────┐
│  Google Cloud Console                   │
│  ┌─────────────────────────────────┐   │
│  │ Select a project ▼              │   │
│  └─────────────────────────────────┘   │
│                                         │
│  APIs & Services                        │
│  ├─ Dashboard                           │
│  ├─ Library                             │
│  ├─ Credentials  ← KLIK INI             │
│  └─ OAuth consent screen                │
└─────────────────────────────────────────┘
```

### 2. Create Credentials
```
┌─────────────────────────────────────────┐
│  + CREATE CREDENTIALS                   │
│  ┌─────────────────────────────────┐   │
│  │ API key                         │   │
│  │ OAuth client ID  ← PILIH INI    │   │
│  │ Service account key             │   │
│  └─────────────────────────────────┘   │
└─────────────────────────────────────────┘
```

### 3. OAuth Client ID Form
```
┌─────────────────────────────────────────┐
│  Application type                       │
│  ○ Web application  ← PILIH INI         │
│  ○ Android                              │
│  ○ iOS                                  │
│                                         │
│  Name                                   │
│  [Dapoer Budess Web Client]            │
│                                         │
│  Authorized JavaScript origins          │
│  [http://127.0.0.1:8000]               │
│  + ADD URI                              │
│                                         │
│  Authorized redirect URIs               │
│  [http://127.0.0.1:8000/auth/google/callback] │
│  + ADD URI                              │
│                                         │
│  [CREATE]                               │
└─────────────────────────────────────────┘
```

---

## 🎯 Checklist Setup

- [ ] Buka Google Cloud Console
- [ ] Buat/pilih project
- [ ] Aktifkan Google+ API atau Google Identity
- [ ] Buat OAuth Consent Screen
- [ ] Tambahkan Test Users
- [ ] Buat OAuth Client ID (Web application)
- [ ] Tambahkan Authorized JavaScript origins
- [ ] Tambahkan Authorized redirect URIs
- [ ] Copy Client ID
- [ ] Copy Client Secret
- [ ] Paste ke file `.env`
- [ ] Restart Laravel server
- [ ] Test login Google

---

## 📝 Catatan Penting

1. **Untuk Development (Local):**
   - Gunakan `http://127.0.0.1:8000` atau `http://localhost:8000`
   - Tambahkan email Anda sebagai Test User

2. **Untuk Production (Live Server):**
   - Ganti URL dengan domain asli: `https://dapoerbudess.com`
   - Update Authorized JavaScript origins dan redirect URIs
   - Publish OAuth Consent Screen (tidak perlu Test Users lagi)

3. **Keamanan:**
   - **JANGAN** commit file `.env` ke Git
   - **JANGAN** share Client Secret ke publik
   - Simpan Client ID & Secret dengan aman

---

## 🚀 Next Steps

Setelah setup selesai:

1. ✅ Login Google sudah berfungsi
2. ✅ User otomatis terdaftar di database
3. ✅ User otomatis login setelah authorize
4. ✅ Data user (nama, email, avatar) tersimpan

---

**Dibuat pada:** 8 Mei 2026  
**Untuk:** Dapoer Budess - Roti Rumahan  
**Status:** ✅ Ready to Use
