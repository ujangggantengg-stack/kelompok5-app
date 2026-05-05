# ✅ MASTER CHECKLIST - Toko Roti

> **Gunakan checklist ini untuk memastikan semua sudah siap!**

---

## 🎯 Quick Status

```
Current Status: 95% Complete
Time to Production: ~1 day
Critical Tasks: 3 items
```

---

## 📋 CRITICAL TASKS (WAJIB!)

> 💡 **QUICK TIP:** Gunakan helper scripts untuk setup otomatis!
> ```bash
> php quick-setup-complete.php  # Setup semua dalam 5 menit!
> ```
> Lihat **HELPER_SCRIPTS.md** untuk detail lengkap.

---

### ⚠️ Task 1: Update Koordinat Toko (5 menit)

**Status:** ⬜ Not Done

**Quick Command:**
```bash
php update-coordinates.php [LATITUDE] [LONGITUDE]
# Contoh: php update-coordinates.php -6.5971469 106.8060394
```

**Manual Steps:**
1. [ ] Buka Google Maps
2. [ ] Cari alamat toko roti
3. [ ] Klik kanan pada pin → Copy koordinat
4. [ ] Edit `public/js/checkout-modern.js` baris 7-8:
   ```javascript
   const STORE_LAT = -6.XXXXXX;  // Ganti dengan koordinat toko
   const STORE_LNG = 106.XXXXXX; // Ganti dengan koordinat toko
   ```
5. [ ] Edit `app/Services/ShippingCalculator.php` baris 8-9:
   ```php
   private $storeLat = -6.XXXXXX; // Ganti
   private $storeLng = 106.XXXXXX; // Ganti
   ```
6. [ ] Update database:
   ```bash
   php artisan tinker
   $rate = App\Models\ShippingRate::first();
   if (!$rate) {
       $rate = new App\Models\ShippingRate();
       $rate->region_name = 'Otomatis (GPS)';
       $rate->cost = 0;
       $rate->type = 'distance';
       $rate->is_active = true;
   }
   $rate->store_latitude = -6.XXXXXX;
   $rate->store_longitude = 106.XXXXXX;
   $rate->base_rate = 5000;
   $rate->per_km_rate = 2000;
   $rate->max_distance_km = 15;
   $rate->use_distance_calculation = true;
   $rate->save();
   exit
   ```

**Verify:**
```bash
grep "STORE_LAT" public/js/checkout-modern.js
grep "storeLat" app/Services/ShippingCalculator.php
```

---

### ⚠️ Task 2: Set Harga Ongkir (5 menit)

**Status:** ⬜ Not Done

**Quick Command:**
```bash
php update-shipping-rates.php [BASE_RATE] [PER_KM_RATE] [MAX_DISTANCE]
# Contoh: php update-shipping-rates.php 5000 2000 15
```

**Manual Steps:**
1. [ ] Riset harga Grab/GoFood di daerah Anda
2. [ ] Edit `public/js/checkout-modern.js` baris 11-13:
   ```javascript
   const BASE_RATE = 5000;    // Biaya dasar (Rp)
   const PER_KM_RATE = 2000;  // Per kilometer (Rp)
   const MAX_DISTANCE = 15;   // Jarak maksimal (km)
   ```
3. [ ] Test simulasi harga:
   - 1 km = BASE_RATE + (1 × PER_KM_RATE)
   - 5 km = BASE_RATE + (5 × PER_KM_RATE)
   - 10 km = BASE_RATE + (10 × PER_KM_RATE)

**Verify:**
```bash
grep "BASE_RATE\|PER_KM_RATE\|MAX_DISTANCE" public/js/checkout-modern.js
```

---

### ⚠️ Task 3: Create Admin User (2 menit)

**Status:** ⬜ Not Done

**Quick Command:**
```bash
php create-admin.php [EMAIL] [PASSWORD] [NAME]
# Contoh: php create-admin.php admin@roti.local password123 "Admin Roti"
# Atau tanpa parameter untuk gunakan default values
```

**Manual Steps:**
```bash
php artisan tinker
User::create([
    'name' => 'Admin Roti',
    'email' => 'admin@roti.local',
    'password' => bcrypt('password123'),
    'is_admin' => true,
]);
exit
```

**Verify:**
```bash
php artisan tinker
User::where('is_admin', true)->count();
# Should return 1 or more
exit
```

---

## 🧪 TESTING TASKS

### Test 1: Quick Test (5 menit)

**Status:** ⬜ Not Done

**Steps:**
1. [ ] Start server: `php artisan serve`
2. [ ] Start Vite: `npm run dev` (terminal lain)
3. [ ] Buka: http://127.0.0.1:8000/checkout
4. [ ] Klik "Deteksi Lokasi"
5. [ ] Izinkan GPS
6. [ ] Verify:
   - [ ] Alamat terisi otomatis
   - [ ] Ongkir muncul
   - [ ] Jarak ditampilkan
   - [ ] No console errors

---

### Test 2: Admin Dashboard (3 menit)

**Status:** ⬜ Not Done

**Steps:**
1. [ ] Buka: http://127.0.0.1:8000/login
2. [ ] Login dengan:
   - Email: `admin@roti.local`
   - Password: `password123`
3. [ ] Buka: http://127.0.0.1:8000/admin
4. [ ] Verify:
   - [ ] Dashboard loads
   - [ ] Stats displayed
   - [ ] Charts rendered
   - [ ] No errors

---

### Test 3: Full Checkout Flow (10 menit)

**Status:** ⬜ Not Done

**Steps:**
1. [ ] Add product to cart
2. [ ] Go to checkout
3. [ ] Fill form:
   - [ ] Nama lengkap
   - [ ] Nomor WhatsApp
   - [ ] Deteksi lokasi (GPS)
   - [ ] Lengkapi detail alamat
   - [ ] Pilih payment method
4. [ ] Submit order
5. [ ] Verify:
   - [ ] Order created
   - [ ] Redirect success
   - [ ] Order in admin panel
   - [ ] Ongkir saved correctly

---

### Test 4: Automated Tests (5 menit)

**Status:** ⬜ Not Done

**Steps:**
```bash
# Run all tests
php artisan test

# Or run comprehensive test script
bash run-tests.sh
```

**Expected:**
- [ ] All tests pass
- [ ] No errors
- [ ] Success rate > 90%

---

## 🚀 DEPLOYMENT TASKS

### Pre-Deployment

**Status:** ⬜ Not Done

**Checklist:**
- [ ] All critical tasks done
- [ ] All tests passed
- [ ] Documentation reviewed
- [ ] Backup strategy planned
- [ ] Rollback plan ready

---

### Production Setup

**Status:** ⬜ Not Done

**Steps:**
1. [ ] Server setup:
   ```bash
   # Install dependencies
   sudo apt update
   sudo apt install php8.1 php8.1-fpm php8.1-mysql nginx
   ```

2. [ ] Clone & install:
   ```bash
   git clone repo
   cd roti
   composer install --no-dev --optimize-autoloader
   npm install
   npm run build
   ```

3. [ ] Configure .env:
   ```bash
   cp .env.example .env
   nano .env
   # Set APP_ENV=production
   # Set APP_DEBUG=false
   # Set database credentials
   ```

4. [ ] Database:
   ```bash
   php artisan key:generate
   php artisan migrate --force
   ```

5. [ ] Optimize:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. [ ] Permissions:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

7. [ ] SSL:
   ```bash
   sudo certbot --nginx -d yourdomain.com
   ```

---

### Post-Deployment

**Status:** ⬜ Not Done

**Immediate Checks (5 menit):**
- [ ] Website loads (https://yourdomain.com)
- [ ] No 500 errors
- [ ] Assets loading
- [ ] GPS works
- [ ] Admin accessible

**First Hour:**
- [ ] Monitor error logs
- [ ] Check server resources
- [ ] Test all features
- [ ] Verify emails

**First Day:**
- [ ] Monitor user activity
- [ ] Check for errors
- [ ] Verify backups
- [ ] Test payments

---

## 📚 DOCUMENTATION REVIEW

**Status:** ⬜ Not Done

**Checklist:**
- [ ] README.md reviewed
- [ ] SETUP_INSTRUCTIONS.md clear
- [ ] GPS_DOCUMENTATION_INDEX.md complete
- [ ] DEPLOYMENT_CHECKLIST.md ready
- [ ] All links working
- [ ] No typos

---

## 🔒 SECURITY REVIEW

**Status:** ⬜ Not Done

**Checklist:**
- [ ] .env not in git
- [ ] Strong admin password
- [ ] Database password secure
- [ ] HTTPS enabled
- [ ] CSRF protection active
- [ ] Input validation working
- [ ] No exposed secrets

---

## 📊 FINAL VERIFICATION

### Code Quality

**Status:** ⬜ Not Done

**Checklist:**
- [ ] No console errors
- [ ] No PHP errors
- [ ] No SQL errors
- [ ] No broken links
- [ ] No dead code
- [ ] Comments adequate

---

### Performance

**Status:** ⬜ Not Done

**Checklist:**
- [ ] Page load < 3s
- [ ] GPS detection < 5s
- [ ] Address search < 1s
- [ ] Assets minified
- [ ] Database indexed
- [ ] Queries optimized

---

### User Experience

**Status:** ⬜ Not Done

**Checklist:**
- [ ] UI responsive
- [ ] Forms intuitive
- [ ] Errors clear
- [ ] Loading states visible
- [ ] Success messages shown
- [ ] Mobile friendly

---

## 🎯 SIGN-OFF

### Development Team

**Developer:** _______________
**Date:** _______________
**Status:** ⬜ Complete

**Notes:**
```
[Any development notes]
```

---

### QA Team

**QA Lead:** _______________
**Date:** _______________
**Status:** ⬜ Approved

**Test Results:**
- Passed: ___ / ___
- Failed: ___ / ___
- Blocked: ___ / ___

**Notes:**
```
[Any QA notes]
```

---

### Project Manager

**PM:** _______________
**Date:** _______________
**Status:** ⬜ Approved for Production

**Notes:**
```
[Any PM notes]
```

---

## 📞 EMERGENCY CONTACTS

### Technical
- **Developer:** [Phone/Email]
- **Server Admin:** [Phone/Email]
- **Database Admin:** [Phone/Email]

### Business
- **Project Manager:** [Phone/Email]
- **Business Owner:** [Phone/Email]

---

## 🎉 COMPLETION

### When All Checked:

✅ **CONGRATULATIONS!**

Your system is ready for production! 🚀

**Next Steps:**
1. Deploy to production
2. Monitor for 24 hours
3. Collect user feedback
4. Plan next features

---

## 📈 PROGRESS TRACKER

```
Critical Tasks:     ⬜⬜⬜ (0/3)
Testing Tasks:      ⬜⬜⬜⬜ (0/4)
Deployment Tasks:   ⬜⬜⬜ (0/3)
Documentation:      ⬜ (0/1)
Security:           ⬜ (0/1)
Final Verification: ⬜⬜⬜ (0/3)

Overall Progress:   0% ████░░░░░░░░░░░░░░░░
```

**Update this as you complete tasks!**

**Quick Verify:**
```bash
php test-setup.php  # Auto-check semua critical tasks
```

---

## 💡 TIPS

### Time Management
- Critical tasks: 15 minutes
- Testing: 30 minutes
- Deployment: 2 hours
- **Total: ~3 hours to production**

### Priority Order
1. ⚠️ Critical tasks (WAJIB!)
2. 🧪 Testing tasks
3. 🚀 Deployment tasks
4. ✅ Final verification

### If Stuck
1. Check documentation
2. Read FAQ (GPS_FAQ.md)
3. Check console errors
4. Ask for help

---

**Last Updated:** 3 Mei 2026

**Start Here:** ⬜ Task 1: Update Koordinat Toko
