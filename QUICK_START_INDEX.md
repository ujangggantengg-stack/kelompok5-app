# 📚 Quick Start Index - Toko Roti System

> **Central hub untuk semua dokumentasi dan helper scripts**

---

## 🚀 GETTING STARTED

### New User? Start Here!

```bash
# 1. Read this first
cat START_HERE.md

# 2. Run quick setup
php quick-setup-complete.php

# 3. Verify setup
php test-setup.php

# 4. Start server
php artisan serve
npm run dev
```

**Time:** 5-10 minutes

---

## 📋 DOCUMENTATION INDEX

### 🎯 Essential (READ FIRST!)

| Document | Purpose | Time |
|----------|---------|------|
| **START_HERE.md** | Quick start guide | 2 min |
| **HELPER_SCRIPTS.md** | Helper scripts documentation | 5 min |
| **MASTER_CHECKLIST.md** | Complete task checklist | 10 min |

### 📍 GPS System

| Document | Purpose | Time |
|----------|---------|------|
| **GPS_DOCUMENTATION_INDEX.md** | GPS docs central hub | 2 min |
| **GPS_CHECKOUT_GUIDE.md** | GPS checkout implementation | 15 min |
| **QUICK_SETUP_GPS.md** | GPS quick setup | 5 min |
| **GPS_FAQ.md** | Frequently asked questions | 10 min |
| **GPS_FEATURES_COMPARISON.md** | Feature comparison | 5 min |
| **GPS_SYSTEM_DIAGRAM.md** | System architecture | 10 min |
| **GPS_TESTING_CHECKLIST.md** | Testing guide | 15 min |

### 👤 Admin Panel

| Document | Purpose | Time |
|----------|---------|------|
| **ADMIN_SETUP_GUIDE.md** | Admin panel setup | 10 min |
| **ADMIN_DOCUMENTATION_INDEX.md** | Admin docs hub | 2 min |
| **ADMIN_PANEL_FEATURES.md** | Feature list | 5 min |
| **ADMIN_QUICK_REFERENCE.md** | Quick reference | 3 min |

### 🚀 Deployment

| Document | Purpose | Time |
|----------|---------|------|
| **DEPLOYMENT_CHECKLIST.md** | Production deployment | 30 min |
| **SETUP_INSTRUCTIONS.md** | Setup instructions | 15 min |
| **PROJECT_STATUS.md** | Project status | 5 min |

### 📖 Reference

| Document | Purpose | Time |
|----------|---------|------|
| **QUICK_REFERENCE.md** | Quick reference guide | 5 min |
| **EXECUTIVE_SUMMARY.md** | Executive summary | 5 min |
| **IMPLEMENTATION_COMPLETE.md** | Implementation details | 10 min |

---

## 🛠️ HELPER SCRIPTS

### ⭐ Main Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **quick-setup-complete.php** | Setup semua tasks | `php quick-setup-complete.php` |
| **test-setup.php** | Verify setup | `php test-setup.php` |

### 📍 Coordinate Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **update-coordinates.php** | Update store coordinates | `php update-coordinates.php [LAT] [LNG]` |

### 💰 Shipping Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **update-shipping-rates.php** | Update shipping rates | `php update-shipping-rates.php [BASE] [PER_KM] [MAX]` |
| **update-database.php** | Sync to database | `php update-database.php` |

### 👤 User Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **create-admin.php** | Create admin user | `php create-admin.php [EMAIL] [PASS] [NAME]` |

### 🧪 Testing Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **test-setup.php** | Verify critical tasks | `php test-setup.php` |
| **run-tests.sh** | Run all tests | `bash run-tests.sh` |

### ⚙️ Setup Scripts

| Script | Purpose | Usage |
|--------|---------|-------|
| **setup_ongkir.php** | Setup shipping rates | `php setup_ongkir.php` |
| **quick-setup.sh** | Quick bash setup | `bash quick-setup.sh` |

---

## 🎯 WORKFLOWS

### Workflow 1: First Time Setup

```bash
# 1. Read documentation
cat START_HERE.md
cat HELPER_SCRIPTS.md

# 2. Run quick setup
php quick-setup-complete.php

# 3. Verify
php test-setup.php

# 4. Test
php artisan serve
npm run dev
# Visit: http://127.0.0.1:8000/checkout
```

---

### Workflow 2: Update Coordinates Only

```bash
# 1. Update coordinates
php update-coordinates.php -6.123456 106.789012

# 2. Sync to database
php update-database.php

# 3. Verify
php test-setup.php

# 4. Test
# Visit: http://127.0.0.1:8000/checkout
```

---

### Workflow 3: Update Shipping Rates Only

```bash
# 1. Update rates
php update-shipping-rates.php 5000 2000 15

# 2. Sync to database
php update-database.php

# 3. Verify
php test-setup.php

# 4. Test checkout
```

---

### Workflow 4: Create Admin User Only

```bash
# 1. Create admin
php create-admin.php admin@roti.local password123 "Admin Roti"

# 2. Verify
php artisan tinker
User::where('is_admin', true)->count();
exit

# 3. Test login
# Visit: http://127.0.0.1:8000/login
```

---

### Workflow 5: Full Testing

```bash
# 1. Verify setup
php test-setup.php

# 2. Run unit tests
php artisan test

# 3. Manual testing
php artisan serve
npm run dev

# Test:
# - GPS detection
# - Shipping calculation
# - Admin login
# - Order creation
```

---

### Workflow 6: Production Deployment

```bash
# 1. Complete checklist
cat MASTER_CHECKLIST.md

# 2. Verify all tasks
php test-setup.php

# 3. Run tests
php artisan test

# 4. Follow deployment guide
cat DEPLOYMENT_CHECKLIST.md

# 5. Deploy!
```

---

## 📊 TASK CHECKLIST

### Critical Tasks (WAJIB!)

- [ ] **Task 1:** Update koordinat toko
  ```bash
  php update-coordinates.php [LAT] [LNG]
  ```

- [ ] **Task 2:** Set harga ongkir
  ```bash
  php update-shipping-rates.php [BASE] [PER_KM] [MAX]
  ```

- [ ] **Task 3:** Create admin user
  ```bash
  php create-admin.php
  ```

- [ ] **Task 4:** Sync to database
  ```bash
  php update-database.php
  ```

### Verification

- [ ] Run test script
  ```bash
  php test-setup.php
  ```

- [ ] Test GPS detection
  ```
  http://127.0.0.1:8000/checkout
  ```

- [ ] Test admin login
  ```
  http://127.0.0.1:8000/login
  ```

- [ ] Run automated tests
  ```bash
  php artisan test
  ```

---

## 🔍 QUICK SEARCH

### By Topic

**GPS System:**
- Setup: `GPS_CHECKOUT_GUIDE.md`, `QUICK_SETUP_GPS.md`
- FAQ: `GPS_FAQ.md`
- Testing: `GPS_TESTING_CHECKLIST.md`

**Admin Panel:**
- Setup: `ADMIN_SETUP_GUIDE.md`
- Features: `ADMIN_PANEL_FEATURES.md`
- Reference: `ADMIN_QUICK_REFERENCE.md`

**Deployment:**
- Checklist: `DEPLOYMENT_CHECKLIST.md`
- Setup: `SETUP_INSTRUCTIONS.md`

**Scripts:**
- All scripts: `HELPER_SCRIPTS.md`
- Quick setup: `quick-setup-complete.php`
- Testing: `test-setup.php`

---

## 💡 TIPS

### Time Management

| Task | Time |
|------|------|
| Quick setup | 5 min |
| Manual setup | 15 min |
| Testing | 10 min |
| Documentation review | 30 min |
| **Total** | **1 hour** |

### Priority Order

1. ⚠️ **Critical tasks** (WAJIB!)
2. 🧪 **Testing**
3. 📚 **Documentation review**
4. 🚀 **Production deployment**

### Common Commands

```bash
# Setup
php quick-setup-complete.php

# Verify
php test-setup.php

# Test
php artisan test

# Server
php artisan serve
npm run dev

# Database
php artisan tinker
php artisan migrate
```

---

## 🐛 TROUBLESHOOTING

### Quick Fixes

| Issue | Solution |
|-------|----------|
| File not found | Check `pwd`, ensure in project root |
| Database error | Check `.env`, run `php artisan config:clear` |
| Coordinates invalid | Format: `-6.123456` (titik, bukan koma) |
| Admin exists | Update: `php create-admin.php` |

### Get Help

1. Check **GPS_FAQ.md**
2. Read **HELPER_SCRIPTS.md**
3. Review **MASTER_CHECKLIST.md**
4. Check console errors
5. Run `php test-setup.php`

---

## 📞 SUPPORT

### Documentation

- **START_HERE.md** - Quick start
- **HELPER_SCRIPTS.md** - Script docs
- **GPS_FAQ.md** - FAQ
- **MASTER_CHECKLIST.md** - Complete checklist

### Scripts

- **quick-setup-complete.php** - Interactive setup
- **test-setup.php** - Verify setup
- **update-*.php** - Update specific settings

---

## 🎉 SUCCESS CRITERIA

Setup berhasil jika:

- ✅ `php test-setup.php` returns 100%
- ✅ GPS detection works di checkout
- ✅ Ongkir calculated correctly
- ✅ Admin login works
- ✅ No console errors
- ✅ `php artisan test` passes

---

## 🔗 EXTERNAL LINKS

- **Google Maps:** https://maps.google.com (untuk koordinat)
- **Laravel Docs:** https://laravel.com/docs
- **Inertia.js:** https://inertiajs.com
- **Tailwind CSS:** https://tailwindcss.com

---

**Ready to start?**

```bash
php quick-setup-complete.php
```

**Last Updated:** 3 Mei 2026

**Version:** 1.0.0
