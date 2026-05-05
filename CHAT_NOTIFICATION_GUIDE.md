# 💬 Chat Notification System - Panduan Lengkap

## ✅ Fitur Notifikasi Chat

### 1. **Badge Notifikasi** 
Tombol "Pesan" di header menampilkan badge merah dengan jumlah pesan belum dibaca.

**Tampilan:**
- Badge merah di pojok kanan atas tombol chat
- Menampilkan angka: 1, 2, 3... atau "9+" jika lebih dari 9
- Pulse animation (lingkaran merah berkedip)
- Auto-update setiap 3 detik

### 2. **Notifikasi Pop-up**
Ketika ada pesan baru dari admin, muncul notifikasi pop-up di pojok kanan atas.

**Fitur:**
- Background hijau gradient
- Icon 💬
- Preview pesan (50 karakter pertama)
- Auto-hide setelah 5 detik
- Klik untuk langsung buka chat

### 3. **Notifikasi Audio**
Suara notifikasi otomatis diputar saat ada pesan baru dari admin.

### 4. **Tab Title Flashing**
Judul tab browser berkedip antara "💬 Pesan Baru!" dan judul asli.

**Berguna untuk:**
- User yang sedang buka tab lain
- User yang minimize browser
- Menarik perhatian kembali ke website

### 5. **Auto-Polling**
Sistem otomatis cek pesan baru setiap 3 detik.

**Cara Kerja:**
- Jika user sudah input nomor HP → auto-check dimulai
- Jika chat dibuka → refresh otomatis
- Jika chat ditutup → badge tetap update
- Jika ganti nomor → polling restart

## 🎯 Cara Kerja Notifikasi

### Untuk User yang Sudah Login
```
1. User login dengan nomor HP
2. Sistem simpan nomor di localStorage
3. Auto-polling dimulai (setiap 3 detik)
4. Jika ada pesan baru dari admin:
   - Badge muncul dengan jumlah pesan
   - Pulse animation aktif
   - Pop-up notification muncul
   - Audio notification diputar
   - Tab title berkedip
5. Saat user buka chat:
   - Badge hilang
   - Pesan ditandai sudah dibaca
   - Auto-refresh chat aktif
```

### Untuk User yang Belum Login
```
1. User bisa klik tombol "Pesan"
2. Input nomor HP untuk cek pesan
3. Jika nomor sudah pernah chat:
   - Langsung tampil riwayat chat
   - Auto-polling dimulai
   - Notifikasi aktif
4. Jika nomor baru:
   - Tampil form kirim pesan pertama
   - Setelah kirim → auto-polling aktif
```

## 📱 Komponen Notifikasi

### 1. Badge Counter
```html
<span class="cart-count" id="msgBadge" style="...">0</span>
```
- Position: absolute, top-right tombol chat
- Background: #ff4444 (merah)
- Border: 2px solid white
- Box-shadow untuk depth
- Display: flex untuk center text

### 2. Pulse Indicator
```html
<span id="msgPulse" style="..."></span>
```
- Lingkaran kecil merah berkedip
- Animation: pulse-red 2s infinite
- Muncul bersamaan dengan badge

### 3. Pop-up Notification
```javascript
showNewMessageNotification(messageText)
```
- Position: fixed, top-right
- Background: gradient hijau
- Auto-hide: 5 detik
- Clickable: buka chat modal

### 4. Audio Alert
```javascript
const audio = new Audio('notification.mp3');
audio.play();
```

### 5. Title Flash
```javascript
startTitleFlash() / stopTitleFlash()
```
- Interval: 1 detik
- Toggle antara "💬 Pesan Baru!" dan judul asli

## 🔧 Fungsi JavaScript Utama

### `checkNewMessages()`
Cek pesan baru setiap 3 detik.

**Logic:**
1. Cek apakah chat modal terbuka
2. Jika terbuka: refresh chat, mark as read
3. Jika tutup: cek unread count, update badge

### `startMessagePolling()`
Mulai auto-check pesan.

```javascript
messagePollingInterval = setInterval(checkNewMessages, 3000);
```

### `stopMessagePolling()`
Stop auto-check (saat logout chat).

```javascript
clearInterval(messagePollingInterval);
```

### `showNewMessageNotification(text)`
Tampilkan notifikasi lengkap.

**Actions:**
1. Play audio
2. Show pop-up
3. Start title flash

### `openMessageModal()`
Buka chat modal.

**Actions:**
1. Show modal
2. Hide badge & pulse
3. Load chat history
4. Start polling if not started

## 🎨 Styling Notifikasi

### Badge Style
```css
position: absolute;
top: -8px;
right: -8px;
background: #ff4444;
color: white;
font-size: 0.7rem;
font-weight: 700;
min-width: 20px;
height: 20px;
border-radius: 10px;
display: flex;
align-items: center;
justify-content: center;
border: 2px solid white;
box-shadow: 0 2px 8px rgba(255,68,68,0.4);
```

### Pulse Animation
```css
@keyframes pulse-red {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 68, 68, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(255, 68, 68, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 68, 68, 0);
    }
}
```

### Pop-up Animation
```css
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
```

## 📊 API Endpoints

### 1. Check Unread Messages
```
GET /messages/unread/{phone}
```
**Response:**
```json
{
    "unread_count": 3,
    "last_message": "Pesanan Anda sedang diproses"
}
```

### 2. Get Order Status & Messages
```
GET /order-status/{phone}
```
**Response:**
```json
{
    "order": {...},
    "messages": [
        {
            "id": 1,
            "message": "Halo, ada yang bisa dibantu?",
            "sender_type": "admin",
            "created_at": "2026-05-03 10:30:00"
        }
    ],
    "notifications": [...]
}
```

### 3. Mark Messages as Read
```
POST /messages/mark-read
Body: { "phone": "08123456789" }
```

## 🧪 Testing Checklist

### Desktop
- [x] Badge muncul saat ada pesan baru
- [x] Badge hilang saat buka chat
- [x] Pulse animation berjalan
- [x] Pop-up muncul di pojok kanan
- [x] Audio notification diputar
- [x] Tab title berkedip
- [x] Auto-polling berjalan setiap 3 detik

### Mobile
- [x] Badge terlihat jelas
- [x] Pop-up tidak menutupi konten penting
- [x] Touch-friendly (mudah diklik)
- [x] Audio notification berfungsi
- [x] Tidak lag saat polling

### Edge Cases
- [x] User logout chat → polling stop
- [x] User ganti nomor → polling restart
- [x] Network error → tidak crash
- [x] Multiple tabs → tidak duplicate notification
- [x] Chat modal ditutup → badge tetap update

## 🚀 Cara Menggunakan

### Untuk Customer
1. Klik tombol "💬 Pesan" di header
2. Input nomor HP (atau otomatis jika sudah login)
3. Kirim pesan atau lihat riwayat chat
4. Badge akan muncul jika ada pesan baru dari admin
5. Klik badge untuk buka chat

### Untuk Admin
1. Login ke admin panel
2. Buka menu "Messages" (`/admin/messages`)
3. Pilih customer dari list
4. Balas pesan customer
5. Customer akan dapat notifikasi otomatis

## 🔔 Notifikasi Behavior

### Saat Chat Dibuka
- Badge: Hidden
- Pulse: Hidden
- Polling: Active (refresh chat)
- Mark as read: Otomatis

### Saat Chat Ditutup
- Badge: Show jika ada unread
- Pulse: Show jika ada unread
- Polling: Active (check unread)
- Pop-up: Show jika pesan baru

### Saat User Logout Chat
- Badge: Hidden
- Pulse: Hidden
- Polling: Stopped
- localStorage: Cleared

## 💡 Tips & Best Practices

1. **Jangan spam notifikasi**: Polling setiap 3 detik sudah cukup
2. **Audio optional**: User bisa mute browser jika mengganggu
3. **Badge max 9+**: Lebih dari 9 tampil "9+" untuk estetika
4. **Auto-hide pop-up**: 5 detik cukup untuk user notice
5. **Title flash**: Stop saat user kembali ke tab
6. **localStorage**: Simpan nomor HP untuk auto-login
7. **Error handling**: Catch semua error agar tidak crash

## 🐛 Troubleshooting

### Badge tidak muncul
- Cek apakah nomor HP sudah tersimpan di localStorage
- Cek console untuk error API
- Pastikan polling sudah start

### Audio tidak diputar
- Browser block autoplay audio
- User harus interact dulu (klik sesuatu)
- Cek browser console untuk error

### Polling tidak jalan
- Cek `messagePollingInterval` di console
- Pastikan `currentPhone` ada value
- Cek network tab untuk API calls

### Notifikasi duplicate
- Pastikan hanya 1 polling interval aktif
- Clear interval sebelum start baru
- Cek multiple tabs

## 📝 Summary

Sistem notifikasi chat sudah lengkap dengan:
- ✅ Badge counter dengan angka
- ✅ Pulse animation
- ✅ Pop-up notification
- ✅ Audio alert
- ✅ Tab title flashing
- ✅ Auto-polling setiap 3 detik
- ✅ Mark as read otomatis
- ✅ Support user login & guest
- ✅ Responsive di semua device

User akan selalu tahu jika ada pesan baru dari admin, baik sedang buka website atau tidak! 🎉
