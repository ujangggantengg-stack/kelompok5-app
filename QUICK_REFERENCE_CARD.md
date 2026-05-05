# 🚀 Quick Reference Card

> **Cheat sheet untuk setup dan troubleshooting**

---

## ⚡ Super Quick Start

```bash
php quick-setup-complete.php && php test-setup.php && php artisan serve
```

---

## 📋 Essential Commands

### Setup
```bash
# Complete setup (interactive)
php quick-setup-complete.php

# Verify setup
php test-setup.php

# Start server
php artisan serve
npm run dev
```

### Update Coordinates
```bash
php update-coordinates.php -6.123456 106.789012
php update-database.php
```

### Update Shipping Rates
```bash
php update-shipping-rates.php 5000 2000 15
php update-database.php
```

### Create Admin
```bash
php create-admin.php admin@example.com password123 "Admin Name"
```

---

## 📍 Get Coordinates

1. Open: https://maps.google.com
2. Search your store address
3. Right-click on red pin
4. Click coordinates (auto-copy)
5. Format: `-6.123456, 106.789012`

---

## 💰 Shipping Rate Examples

### Jakarta
```bash
php update-shipping-rates.php 5000 2000 15
# Base: Rp 5.000, Per KM: Rp 2.000, Max: 15 km
```

### Bogor
```bash
php update-shipping-rates.php 4000 1500 10
# Base: Rp 4.000, Per KM: Rp 1.500, Max: 10 km
```

### Bandung
```bash
php update-shipping-rates.php 5000 2500 12
# Base: Rp 5.000, Per KM: Rp 2.500, Max: 12 km
```

---

## 🧪 Testing

### Quick Test
```bash
php test-setup.php
```

### Full Test
```bash
php artisan test
```

### Manual Test
```
http://127.0.0.1:8000/checkout  → GPS detection
http://127.0.0.1:8000/login     → Admin login
```

---

## 🐛 Troubleshooting

### File Not Found
```bash
pwd  # Check you're in project root
ls public/js/checkout-modern.js
```

### Database Error
```bash
cat .env | grep DB_
php artisan config:clear
```

### Coordinates Invalid
```bash
# Format: -6.123456 (dot, not comma)
# Latitude: -11 to 6
# Longitude: 95 to 141
```

### Admin Already Exists
```bash
php artisan tinker
$user = User::where('email', 'admin@roti.local')->first();
$user->is_admin = true;
$user->save();
exit
```

---

## 📚 Documentation Quick Links

| Need | Read |
|------|------|
| **First time setup** | [START_HERE.md](START_HERE.md) |
| **All documentation** | [QUICK_START_INDEX.md](QUICK_START_INDEX.md) |
| **Script help** | [HELPER_SCRIPTS.md](HELPER_SCRIPTS.md) |
| **Task checklist** | [MASTER_CHECKLIST.md](MASTER_CHECKLIST.md) |
| **GPS system** | [GPS_DOCUMENTATION_INDEX.md](GPS_DOCUMENTATION_INDEX.md) |
| **Admin panel** | [ADMIN_SETUP_GUIDE.md](ADMIN_SETUP_GUIDE.md) |
| **Deployment** | [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md) |
| **FAQ** | [GPS_FAQ.md](GPS_FAQ.md) |

---

## ✅ Success Checklist

- [ ] `php test-setup.php` returns 100%
- [ ] GPS detection works
- [ ] Ongkir calculated correctly
- [ ] Admin login works
- [ ] No console errors
- [ ] `php artisan test` passes

---

## 🎯 Critical Tasks

### Task 1: Coordinates
```bash
php update-coordinates.php [LAT] [LNG]
```

### Task 2: Shipping Rates
```bash
php update-shipping-rates.php [BASE] [PER_KM] [MAX]
```

### Task 3: Admin User
```bash
php create-admin.php
```

### Task 4: Sync Database
```bash
php update-database.php
```

---

## 🔍 Verification Commands

### Check Files
```bash
grep "STORE_LAT" public/js/checkout-modern.js
grep "storeLat" app/Services/ShippingCalculator.php
```

### Check Database
```bash
php artisan tinker
App\Models\ShippingRate::first();
App\Models\User::where('is_admin', true)->count();
exit
```

### Check Server
```bash
php artisan serve
# Visit: http://127.0.0.1:8000
```

---

## 💡 Pro Tips

### Time Savers
- Use `quick-setup-complete.php` for first setup
- Use individual scripts for updates
- Run `test-setup.php` after changes
- Keep coordinates in notes for reference

### Best Practices
- Always verify with `test-setup.php`
- Test in browser after setup
- Change admin password after first login
- Backup database before production

### Common Mistakes
- ❌ Using comma instead of dot in coordinates
- ❌ Forgetting to run `update-database.php`
- ❌ Not verifying setup before testing
- ❌ Using example coordinates in production

---

## 📞 Get Help

### Quick Help
```bash
php [script-name].php --help
```

### Documentation
```bash
cat START_HERE.md
cat HELPER_SCRIPTS.md
cat GPS_FAQ.md
```

### Verify Setup
```bash
php test-setup.php
```

---

## 🎉 One-Liner Setup

```bash
php quick-setup-complete.php && php test-setup.php && echo "✅ Setup complete! Run: php artisan serve"
```

---

**Print this card and keep it handy!**

**Last Updated:** 3 Mei 2026
