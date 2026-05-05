# 🚀 START HERE - Quick Setup Guide

> **Setup sistem toko roti dalam 5 menit!**

---

## ⚡ Super Quick Start (RECOMMENDED)

```bash
# 1. Run quick setup (interactive)
php quick-setup-complete.php

# 2. Start server
php artisan serve

# 3. Start Vite (terminal baru)
npm run dev

# 4. Test!
# Buka: http://127.0.0.1:8000/checkout
```

**Done!** ✅

---

## 📋 What You Need

Sebelum mulai, siapkan:

1. **📍 Koordinat Toko**
   - Buka Google Maps
   - Cari alamat toko
   - Klik kanan → Copy koordinat
   - Format: `-6.123456, 106.789012`

2. **💰 Harga Ongkir**
   - Cek Grab/GoFood di daerah Anda
   - Catat: Base rate, Per KM rate, Max distance

3. **👤 Admin Credentials**
   - Email (default: `admin@roti.local`)
   - Password (default: `password123`)
   - Name (default: `Admin Roti`)

---

## 🎯 3 Critical Tasks

### Task 1: Update Koordinat Toko
```bash
php update-coordinates.php -6.5971469 106.8060394
```

### Task 2: Set Harga Ongkir
```bash
php update-shipping-rates.php 5000 2000 15
# (Base: 5000, Per KM: 2000, Max: 15 km)
```

### Task 3: Create Admin User
```bash
php create-admin.php
# Atau dengan custom values:
# php create-admin.php admin@roti.local password123 "Admin Roti"
```

### Sync to Database
```bash
php update-database.php
```

---

## ✅ Verify Setup

### 1. Check Files
```bash
grep "STORE_LAT" public/js/checkout-modern.js
grep "storeLat" app/Services/ShippingCalculator.php
```

### 2. Check Database
```bash
php artisan tinker
App\Models\ShippingRate::first();
App\Models\User::where('is_admin', true)->count();
exit
```

### 3. Test in Browser
```bash
# Start server
php artisan serve
npm run dev

# Test:
# 1. http://127.0.0.1:8000/checkout (GPS detection)
# 2. http://127.0.0.1:8000/login (Admin login)
```

---

## 📚 Documentation

### Essential Docs
- **HELPER_SCRIPTS.md** - Detailed guide untuk semua scripts
- **MASTER_CHECKLIST.md** - Complete checklist semua tasks
- **GPS_DOCUMENTATION_INDEX.md** - GPS system documentation

### Feature Guides
- **GPS_CHECKOUT_GUIDE.md** - GPS checkout system
- **ADMIN_SETUP_GUIDE.md** - Admin panel setup
- **DEPLOYMENT_CHECKLIST.md** - Production deployment

### Reference
- **GPS_FAQ.md** - Frequently asked questions
- **GPS_FEATURES_COMPARISON.md** - Feature comparison
- **QUICK_SETUP_GPS.md** - GPS quick setup

---

## 🐛 Common Issues

### "File tidak ditemukan"
```bash
# Pastikan di root project
pwd
ls public/js/checkout-modern.js
```

### "Database connection failed"
```bash
# Check .env
cat .env | grep DB_
php artisan config:clear
```

### "Koordinat tidak valid"
```bash
# Format: -6.123456 (titik, bukan koma)
# Latitude: -11 sampai 6
# Longitude: 95 sampai 141
```

---

## 🎉 After Setup

### Immediate Testing
1. ✅ GPS detection works
2. ✅ Ongkir calculated correctly
3. ✅ Admin login works
4. ✅ No console errors

### Run Tests
```bash
php artisan test
```

### Production Checklist
- [ ] Update .env for production
- [ ] Setup SSL certificate
- [ ] Configure backup strategy
- [ ] Test all features
- [ ] Monitor error logs

---

## 💡 Tips

### Time Estimates
- Quick setup: **5 minutes**
- Manual setup: **15 minutes**
- Testing: **10 minutes**
- **Total: 15-30 minutes**

### Priority Order
1. ⚠️ Critical tasks (WAJIB!)
2. 🧪 Testing
3. 📚 Documentation review
4. 🚀 Production deployment

### Need Help?
1. Check **HELPER_SCRIPTS.md**
2. Read **GPS_FAQ.md**
3. Review **MASTER_CHECKLIST.md**
4. Check console errors

---

## 🔗 Quick Links

| Document | Purpose |
|----------|---------|
| **START_HERE.md** | You are here! |
| **HELPER_SCRIPTS.md** | Script documentation |
| **MASTER_CHECKLIST.md** | Complete checklist |
| **GPS_DOCUMENTATION_INDEX.md** | GPS docs index |
| **DEPLOYMENT_CHECKLIST.md** | Production guide |

---

**Ready?** Run this now:

```bash
php quick-setup-complete.php
```

**Last Updated:** 3 Mei 2026
