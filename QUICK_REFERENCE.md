# ⚡ Quick Reference Card

> **Print this page and keep it handy!**

---

## 🚀 Quick Start Commands

### Development
```bash
# Start Laravel
php artisan serve

# Start Vite (new terminal)
npm run dev

# Open browser
http://127.0.0.1:8000
```

### Testing
```bash
# Run all tests
php artisan test

# Quick test script
bash run-tests.sh

# Check setup
bash quick-setup.sh
```

### Production
```bash
# Build assets
npm run build

# Optimize
php artisan optimize

# Clear cache
php artisan cache:clear
```

---

## 📍 Koordinat Toko

### Current Settings
```javascript
// File: public/js/checkout-modern.js
STORE_LAT = -6.5971469   // ⚠️ CONTOH - GANTI!
STORE_LNG = 106.8060394  // ⚠️ CONTOH - GANTI!
```

### How to Update
1. Google Maps → Cari toko
2. Klik kanan → Copy koordinat
3. Edit file di atas
4. Save & refresh browser

---

## 💰 Harga Ongkir

### Current Settings
```javascript
// File: public/js/checkout-modern.js
BASE_RATE = 5000      // Biaya dasar (Rp)
PER_KM_RATE = 2000    // Per kilometer (Rp)
MAX_DISTANCE = 15     // Jarak maksimal (km)
```

### Simulasi
| Jarak | Harga |
|-------|-------|
| 1 km  | Rp 7.000 |
| 3 km  | Rp 11.000 |
| 5 km  | Rp 15.000 |
| 10 km | Rp 25.000 |

---

## 🔑 Admin Access

### Login
```
URL: http://127.0.0.1:8000/admin
Email: admin@roti.local
Password: password123
```

### Create New Admin
```bash
php artisan tinker
User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true,
]);
exit
```

---

## 🧪 Testing Checklist

### Quick Test (5 min)
- [ ] GPS detection works
- [ ] Address search works
- [ ] Ongkir calculated
- [ ] Form submits
- [ ] Admin accessible

### Full Test
See: [GPS_TESTING_CHECKLIST.md](GPS_TESTING_CHECKLIST.md)

---

## 🐛 Common Issues

### GPS Not Working
```
Problem: GPS tidak detect
Solution: 
1. Pastikan HTTPS (atau localhost)
2. Allow location permission
3. Try different browser
```

### Ongkir Not Showing
```
Problem: Ongkir tidak muncul
Solution:
1. Check koordinat toko sudah benar
2. Open console (F12) → check errors
3. Verify JavaScript loaded
```

### Admin 403 Error
```bash
# Fix admin access
php artisan tinker
$user = User::where('email', 'admin@roti.local')->first();
$user->update(['is_admin' => true]);
exit
```

### Assets Not Loading
```bash
# Rebuild assets
npm run build

# Clear cache
php artisan cache:clear
php artisan config:clear
```

---

## 📁 Important Files

### Configuration
```
public/js/checkout-modern.js     # GPS settings
app/Services/ShippingCalculator.php
.env                             # Environment
```

### Documentation
```
README.md                        # Main docs
SETUP_INSTRUCTIONS.md            # Setup guide
MASTER_CHECKLIST.md              # Checklist
GPS_FAQ.md                       # 60+ Q&A
```

### Scripts
```
quick-setup.sh                   # Setup checker
run-tests.sh                     # Test runner
setup_ongkir.php                 # Ongkir setup
```

---

## 🔗 Important URLs

### Development
```
Homepage:    http://127.0.0.1:8000
Checkout:    http://127.0.0.1:8000/checkout
Admin:       http://127.0.0.1:8000/admin
Login:       http://127.0.0.1:8000/login
```

### Production
```
Homepage:    https://yourdomain.com
Checkout:    https://yourdomain.com/checkout
Admin:       https://yourdomain.com/admin
```

---

## 📞 Emergency Contacts

### Technical Support
```
Developer:    [Phone/Email]
Server Admin: [Phone/Email]
Database:     [Phone/Email]
```

### Documentation
```
Main Docs:    README.md
GPS Docs:     GPS_DOCUMENTATION_INDEX.md
FAQ:          GPS_FAQ.md
Status:       PROJECT_STATUS.md
```

---

## ⚡ Quick Fixes

### Clear Everything
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
npm run build
```

### Reset Database
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Restart Services
```bash
# Stop all
Ctrl + C (in each terminal)

# Start again
php artisan serve
npm run dev
```

---

## 📊 Status Check

### System Health
```bash
# Check PHP
php --version

# Check Node
node --version

# Check database
php artisan tinker
DB::connection()->getPdo();
exit

# Check files
ls -la public/js/checkout-modern.js
ls -la app/Services/ShippingCalculator.php
```

### Performance
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check disk space
df -h

# Check memory
free -m
```

---

## 🎯 Daily Checklist

### Morning
- [ ] Check error logs
- [ ] Check server status
- [ ] Check pending orders
- [ ] Check messages

### Evening
- [ ] Process all orders
- [ ] Reply all messages
- [ ] Check analytics
- [ ] Backup database

---

## 💡 Pro Tips

### Development
```bash
# Watch for changes
npm run dev

# Hot reload
# Vite automatically reloads on save

# Debug
dd($variable);        # Dump and die
dump($variable);      # Dump
console.log(var);     # JavaScript
```

### Production
```bash
# Always backup before deploy
mysqldump -u user -p db > backup.sql

# Always test before deploy
php artisan test

# Always optimize after deploy
php artisan optimize
```

---

## 📚 Documentation Index

| Doc | Purpose | Time |
|-----|---------|------|
| [README.md](README.md) | Overview | 10 min |
| [SETUP_INSTRUCTIONS.md](SETUP_INSTRUCTIONS.md) | Setup | 5 min |
| [MASTER_CHECKLIST.md](MASTER_CHECKLIST.md) | Checklist | 15 min |
| [GPS_FAQ.md](GPS_FAQ.md) | Q&A | 30 min |
| [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md) | Deploy | 30 min |

---

## 🎓 Learning Resources

### For Beginners
1. Start: [SETUP_INSTRUCTIONS.md](SETUP_INSTRUCTIONS.md)
2. Then: [QUICK_SETUP_GPS.md](QUICK_SETUP_GPS.md)
3. Test: [GPS_TESTING_CHECKLIST.md](GPS_TESTING_CHECKLIST.md)

### For Advanced
1. Read: [GPS_SYSTEM_DIAGRAM.md](GPS_SYSTEM_DIAGRAM.md)
2. Study: [GPS_CHECKOUT_GUIDE.md](GPS_CHECKOUT_GUIDE.md)
3. Deploy: [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)

---

## ✅ Pre-Launch Checklist

- [ ] Koordinat toko updated
- [ ] Harga ongkir set
- [ ] Admin user created
- [ ] All tests passed
- [ ] Documentation reviewed
- [ ] Backup strategy ready
- [ ] Monitoring setup
- [ ] SSL configured

**Ready?** → [MASTER_CHECKLIST.md](MASTER_CHECKLIST.md)

---

## 🚨 Emergency Procedures

### Site Down
```bash
# Check logs
tail -f storage/logs/laravel.log

# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm

# Check disk space
df -h
```

### Database Issues
```bash
# Check connection
php artisan tinker
DB::connection()->getPdo();

# Restore backup
mysql -u user -p db < backup.sql
```

### Performance Issues
```bash
# Clear cache
php artisan cache:clear

# Optimize
php artisan optimize

# Check processes
top
htop
```

---

## 📱 Mobile Testing

### Devices to Test
- [ ] iPhone (Safari)
- [ ] Android (Chrome)
- [ ] Tablet (iPad/Android)

### Features to Test
- [ ] GPS detection
- [ ] Touch targets
- [ ] Form inputs
- [ ] Keyboard behavior
- [ ] Orientation change

---

## 🎉 Success Metrics

### Daily
- Orders processed: ___
- Average order value: Rp ___
- Cart abandonment: ___%
- Response time: ___ ms

### Weekly
- Total revenue: Rp ___
- New customers: ___
- Repeat rate: ___%
- Customer satisfaction: ___/5

---

**Print this page and keep it at your desk!** 📄

**Last Updated:** 3 Mei 2026
