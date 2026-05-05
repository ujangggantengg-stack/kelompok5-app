# 🚀 Deployment Checklist - Production Ready

## Pre-Deployment Checklist

### 1. Configuration ⚙️

#### Koordinat Toko
- [ ] Update `STORE_LAT` di `public/js/checkout-modern.js`
- [ ] Update `STORE_LNG` di `public/js/checkout-modern.js`
- [ ] Update `storeLat` di `app/Services/ShippingCalculator.php`
- [ ] Update `storeLng` di `app/Services/ShippingCalculator.php`
- [ ] Update database via `php artisan tinker`

**Verify:**
```bash
grep "STORE_LAT" public/js/checkout-modern.js
grep "storeLat" app/Services/ShippingCalculator.php
```

#### Harga Ongkir
- [ ] Riset harga Grab/GoFood lokal
- [ ] Update `BASE_RATE` di `checkout-modern.js`
- [ ] Update `PER_KM_RATE` di `checkout-modern.js`
- [ ] Update `MAX_DISTANCE` di `checkout-modern.js`
- [ ] Update rates di `ShippingCalculator.php`

**Test Calculation:**
```javascript
// 1 km = BASE_RATE + (1 × PER_KM_RATE)
// 5 km = BASE_RATE + (5 × PER_KM_RATE)
// 10 km = BASE_RATE + (10 × PER_KM_RATE)
```

#### Environment (.env)
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` set to production URL
- [ ] Database credentials correct
- [ ] `SESSION_DRIVER=database` (recommended)
- [ ] `CACHE_DRIVER=redis` (recommended)
- [ ] Mail settings configured
- [ ] Strong `APP_KEY` generated

**Verify:**
```bash
cat .env | grep "APP_ENV\|APP_DEBUG\|APP_URL"
```

---

### 2. Security 🔒

#### SSL/HTTPS
- [ ] SSL certificate installed
- [ ] HTTPS enabled (GPS requires HTTPS!)
- [ ] HTTP → HTTPS redirect configured
- [ ] Mixed content warnings resolved

**Test:**
```bash
curl -I https://yourdomain.com
# Should return 200 OK
```

#### Permissions
- [ ] `storage/` writable (755)
- [ ] `bootstrap/cache/` writable (755)
- [ ] `.env` not publicly accessible
- [ ] `.git/` not publicly accessible

**Set Permissions:**
```bash
chmod -R 755 storage bootstrap/cache
chmod 644 .env
```

#### Database
- [ ] Strong database password
- [ ] Database user has minimal privileges
- [ ] Backup strategy in place
- [ ] No default/test data in production

#### Admin Access
- [ ] Admin user created
- [ ] Strong admin password
- [ ] Admin email verified
- [ ] Test admin login

**Create Admin:**
```bash
php artisan tinker
User::create([
    'name' => 'Admin',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('STRONG_PASSWORD_HERE'),
    'is_admin' => true,
]);
```

---

### 3. Testing ✅

#### Automated Tests
- [ ] Run: `php artisan test`
- [ ] All tests passing
- [ ] No warnings or errors

```bash
php artisan test --stop-on-failure
```

#### Manual Testing
- [ ] GPS detection works
- [ ] Address search works
- [ ] Ongkir calculation correct
- [ ] Form validation works
- [ ] Checkout flow complete
- [ ] Admin dashboard accessible
- [ ] Orders display correctly
- [ ] Messages work

**Follow:** `GPS_TESTING_CHECKLIST.md`

#### Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile browsers (iOS/Android)

#### Device Testing
- [ ] Desktop (Windows/Mac)
- [ ] Laptop
- [ ] Smartphone (Android)
- [ ] Smartphone (iOS)
- [ ] Tablet

#### Performance Testing
- [ ] Page load < 3 seconds
- [ ] GPS detection < 5 seconds
- [ ] No console errors
- [ ] No memory leaks

**Tools:**
- Google PageSpeed Insights
- GTmetrix
- Chrome DevTools

---

### 4. Database 💾

#### Migrations
- [ ] All migrations run
- [ ] No pending migrations
- [ ] Rollback tested (in staging)

```bash
php artisan migrate:status
php artisan migrate --force
```

#### Seeding (Optional)
- [ ] Sample data removed
- [ ] Only production data present

#### Backup
- [ ] Backup strategy configured
- [ ] Test restore procedure
- [ ] Automated daily backups

**Backup Command:**
```bash
mysqldump -u user -p database > backup_$(date +%Y%m%d).sql
```

---

### 5. Assets 📦

#### Build
- [ ] Run: `npm run build`
- [ ] Assets compiled successfully
- [ ] No build errors
- [ ] `public/build/` directory exists

```bash
npm run build
ls -la public/build/
```

#### Optimization
- [ ] CSS minified
- [ ] JavaScript minified
- [ ] Images optimized
- [ ] Unused assets removed

#### Cache
- [ ] Config cached: `php artisan config:cache`
- [ ] Routes cached: `php artisan route:cache`
- [ ] Views cached: `php artisan view:cache`

```bash
php artisan optimize
```

---

### 6. Monitoring 📊

#### Logging
- [ ] Log level set appropriately
- [ ] Error logging enabled
- [ ] Log rotation configured
- [ ] Disk space monitored

**Check Logs:**
```bash
tail -f storage/logs/laravel.log
```

#### Error Tracking
- [ ] Error tracking service configured (Sentry, Bugsnag, etc.)
- [ ] Test error reporting
- [ ] Alert notifications set up

#### Analytics
- [ ] Google Analytics installed (optional)
- [ ] Conversion tracking set up
- [ ] User behavior tracked

#### Uptime Monitoring
- [ ] Uptime monitor configured
- [ ] Alert notifications set up
- [ ] Response time tracked

**Tools:**
- UptimeRobot
- Pingdom
- StatusCake

---

### 7. Performance ⚡

#### Caching
- [ ] Redis/Memcached configured
- [ ] Query caching enabled
- [ ] View caching enabled
- [ ] Route caching enabled

#### Database
- [ ] Indexes on frequently queried columns
- [ ] N+1 queries eliminated
- [ ] Query optimization done

**Check Queries:**
```bash
php artisan telescope:install # For debugging
```

#### CDN (Optional)
- [ ] Static assets on CDN
- [ ] Images on CDN
- [ ] DNS configured

---

### 8. Documentation 📚

#### Internal Docs
- [ ] All documentation files present
- [ ] Setup instructions clear
- [ ] Troubleshooting guide available
- [ ] API documentation (if applicable)

**Check:**
```bash
ls -la *.md
```

#### User Guides
- [ ] Customer checkout guide
- [ ] Admin panel guide
- [ ] FAQ for customers

#### Developer Docs
- [ ] Code comments adequate
- [ ] Architecture documented
- [ ] Deployment process documented

---

## Deployment Steps

### Step 1: Prepare Server

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install dependencies
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### Step 2: Deploy Code

```bash
# Clone repository
git clone https://github.com/yourusername/roti.git
cd roti

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Set permissions
chmod -R 755 storage bootstrap/cache
```

### Step 3: Configure Environment

```bash
# Copy .env
cp .env.example .env
nano .env  # Edit configuration

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force
```

### Step 4: Optimize

```bash
# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 5: Configure Web Server

**Nginx Example:**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/roti/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Step 6: SSL Setup

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Get certificate
sudo certbot --nginx -d yourdomain.com

# Auto-renewal
sudo certbot renew --dry-run
```

### Step 7: Start Services

```bash
# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm

# Enable on boot
sudo systemctl enable nginx
sudo systemctl enable php8.1-fpm
```

---

## Post-Deployment

### Immediate Checks (First 5 Minutes)

- [ ] Website loads (https://yourdomain.com)
- [ ] No 500 errors
- [ ] Assets loading correctly
- [ ] GPS detection works
- [ ] Checkout flow works
- [ ] Admin panel accessible

### First Hour

- [ ] Monitor error logs
- [ ] Check server resources (CPU, RAM, Disk)
- [ ] Test all major features
- [ ] Verify email sending
- [ ] Check database connections

### First Day

- [ ] Monitor user activity
- [ ] Check for errors in logs
- [ ] Verify backups running
- [ ] Test payment processing
- [ ] Monitor performance metrics

### First Week

- [ ] Collect user feedback
- [ ] Fix any reported bugs
- [ ] Optimize based on usage patterns
- [ ] Review analytics data

---

## Rollback Plan

If something goes wrong:

### Quick Rollback

```bash
# Restore previous version
git checkout previous-tag
composer install --no-dev
npm run build
php artisan migrate:rollback
php artisan cache:clear
```

### Database Rollback

```bash
# Restore database backup
mysql -u user -p database < backup_YYYYMMDD.sql
```

### Full Rollback

```bash
# Restore entire application
cd /var/www/
rm -rf roti
tar -xzf roti_backup_YYYYMMDD.tar.gz
cd roti
php artisan cache:clear
sudo systemctl restart nginx php8.1-fpm
```

---

## Maintenance Mode

### Enable Maintenance

```bash
php artisan down --message="Sedang maintenance, kembali sebentar lagi"
```

### Disable Maintenance

```bash
php artisan up
```

---

## Support Contacts

### Emergency Contacts
- Developer: [Your contact]
- Server Admin: [Contact]
- Database Admin: [Contact]

### Monitoring Alerts
- Email: alerts@yourdomain.com
- Slack: #production-alerts
- SMS: [Phone number]

---

## Sign-Off

**Deployed By:** _______________
**Date:** _______________
**Version:** _______________
**Environment:** Production

**Checklist Completed:** ⬜ Yes / ⬜ No

**Notes:**
```
[Any deployment notes]
```

---

**Last Updated:** 3 Mei 2026
