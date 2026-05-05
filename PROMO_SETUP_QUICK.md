# 🚀 Promo Modal - Quick Setup

> **Setup modal promo dalam 5 menit!**

---

## ⚡ Super Quick Start

```bash
# 1. Files sudah dibuat:
# - resources/views/components/promo-modal.blade.php
# - resources/views/promo-page.blade.php

# 2. Add route (routes/web.php)
Route::get('/promo', function () {
    return view('promo-page');
});

# 3. Test!
php artisan serve
# Buka: http://127.0.0.1:8000/promo
```

**Done!** ✅

---

## 📋 Step-by-Step

### Step 1: Add Route (30 detik)

**File:** `routes/web.php`

```php
// Add this route
Route::get('/promo', function () {
    return view('promo-page');
});
```

---

### Step 2: Test Page (1 menit)

```bash
# Start server
php artisan serve

# Open browser
http://127.0.0.1:8000/promo
```

**Expected:**
- Hero section dengan button "Lihat Promo Sekarang!"
- Preview cards (3 produk)
- Click button → Modal muncul ✅

---

### Step 3: Customize Products (2 menit)

**File:** `resources/views/components/promo-modal.blade.php`

**Find and replace:**
```html
<!-- Product 1 -->
<h3>ROTI SOBEK COKLAT KEJU</h3>
<span>Rp 27.000</span>

<!-- Change to your product -->
<h3>YOUR PRODUCT NAME</h3>
<span>Rp YOUR_PRICE</span>
```

---

### Step 4: Add Real Images (1 menit)

**Replace placeholder images:**
```html
<!-- Before -->
<img src="https://via.placeholder.com/400x400/8B4513/FFFFFF?text=Roti+Sobek+Coklat">

<!-- After -->
<img src="{{ asset('images/products/roti-coklat.jpg') }}">
```

**Upload images to:**
```
public/images/products/
├── roti-coklat.jpg
├── roti-mentega.jpg
└── roti-pisang.jpg
```

---

## 🎯 Integration

### Use in Any Page

**Method 1: Include Component**
```blade
<!-- In your blade file -->
@include('components.promo-modal')

<!-- Add trigger button -->
<button onclick="openPromoModal()" class="btn">
    🔥 Lihat Promo
</button>
```

---

### Method 2: Auto-show on Homepage

**File:** `resources/views/welcome.blade.php`

```blade
<!-- At the bottom, before </body> -->
@include('components.promo-modal')

<script>
    // Auto-show after 3 seconds
    setTimeout(() => {
        openPromoModal();
    }, 3000);
</script>
```

---

### Method 3: Show Once Per Session

```blade
@include('components.promo-modal')

<script>
    // Show only once per session
    if (!sessionStorage.getItem('promoShown')) {
        setTimeout(() => {
            openPromoModal();
            sessionStorage.setItem('promoShown', 'true');
        }, 2000);
    }
</script>
```

---

## 🎨 Quick Customization

### Change Colors

**Orange → Blue:**
```html
<!-- Find and replace in promo-modal.blade.php -->
bg-orange-500 → bg-blue-500
text-orange-500 → text-blue-500
from-orange-50 to-amber-50 → from-blue-50 to-indigo-50
```

---

### Change Button Text

```html
<!-- Find -->
<span>Beli</span>

<!-- Replace with -->
<span>Pesan Sekarang</span>
```

---

### Add Discount Badge

```html
<!-- Add after price -->
<div class="inline-block px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-bold">
    HEMAT 10%
</div>
```

---

## 🛒 Cart Integration

### Connect to Cart System

**File:** `resources/views/components/promo-modal.blade.php`

**Find buy button:**
```html
<button class="w-full py-4 bg-gradient-to-r from-amber-800...">
```

**Add onclick:**
```html
<button 
    onclick="addToCart({{ $product->id }})"
    class="w-full py-4 bg-gradient-to-r from-amber-800...">
    <i class="fas fa-shopping-cart"></i>
    <span>Beli</span>
</button>
```

**Add JavaScript:**
```javascript
function addToCart(productId) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ 
            product_id: productId,
            quantity: 1 
        })
    })
    .then(response => response.json())
    .then(data => {
        // Update cart count
        document.getElementById('cartCount').textContent = data.cart_count;
        
        // Show notification
        alert('Produk ditambahkan ke keranjang!');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menambahkan ke keranjang');
    });
}
```

---

## 📱 Mobile Optimization

**Already optimized!**
- ✅ Responsive grid
- ✅ Touch-friendly buttons
- ✅ Readable text size
- ✅ Smooth scrolling

**Test on mobile:**
```bash
# Get local IP
ipconfig  # Windows
ifconfig  # Mac/Linux

# Start server
php artisan serve --host=0.0.0.0

# Access from mobile
http://192.168.x.x:8000/promo
```

---

## 🎯 Testing Checklist

### Desktop
- [ ] Modal opens on button click
- [ ] Modal closes on X button
- [ ] Modal closes on ESC key
- [ ] Modal closes on backdrop click
- [ ] All images load
- [ ] Hover effects work
- [ ] Buttons clickable

### Mobile
- [ ] Modal responsive
- [ ] Touch scrolling works
- [ ] Buttons touch-friendly
- [ ] Text readable
- [ ] Images fit screen

---

## 💡 Pro Tips

### Tip 1: Use Real Product Data

**Create controller:**
```php
// app/Http/Controllers/PromoController.php
public function index()
{
    $promos = Product::where('is_promo', true)
                    ->where('promo_end', '>=', now())
                    ->get();
    
    return view('promo-page', compact('promos'));
}
```

**Update route:**
```php
Route::get('/promo', [PromoController::class, 'index']);
```

**Update blade:**
```blade
@foreach($promos as $promo)
    <div class="bg-white rounded-2xl...">
        <h3>{{ $promo->name }}</h3>
        <span>Rp {{ number_format($promo->promo_price) }}</span>
    </div>
@endforeach
```

---

### Tip 2: Add Timer

```html
<!-- Add countdown timer -->
<div class="text-center mb-4">
    <p class="text-sm text-gray-600">Promo berakhir dalam:</p>
    <div id="countdown" class="text-2xl font-bold text-red-500">
        00:00:00
    </div>
</div>

<script>
    // Countdown to midnight
    function updateCountdown() {
        const now = new Date();
        const midnight = new Date();
        midnight.setHours(24, 0, 0, 0);
        
        const diff = midnight - now;
        const hours = Math.floor(diff / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);
        
        document.getElementById('countdown').textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
```

---

### Tip 3: Add Stock Counter

```html
<!-- Add stock indicator -->
<div class="flex items-center space-x-2 text-sm text-gray-600">
    <i class="fas fa-box"></i>
    <span>Tersisa <strong class="text-orange-500">{{ $product->stock }}</strong> pcs</span>
</div>
```

---

## 🐛 Common Issues

### Issue 1: Modal Not Opening

**Check:**
```javascript
// Console
console.log(document.getElementById('promoModal'));

// Should not be null
```

**Fix:**
```blade
<!-- Make sure component is included -->
@include('components.promo-modal')
```

---

### Issue 2: Images Not Loading

**Check path:**
```bash
# Images should be in
public/images/products/

# Access via
{{ asset('images/products/roti.jpg') }}
```

**Fix:**
```bash
# Create directory
mkdir -p public/images/products

# Upload images
# Copy images to public/images/products/
```

---

### Issue 3: Scroll Not Working

**Check:**
```css
/* Modal should have */
overflow-y: auto
max-h-[90vh]
```

**Fix:**
```html
<div class="... max-h-[90vh] overflow-y-auto">
```

---

## 🎉 Success Criteria

Modal berhasil jika:
- ✅ Opens on button click
- ✅ Shows 3 products
- ✅ Images load correctly
- ✅ Prices displayed
- ✅ Buttons clickable
- ✅ Closes properly
- ✅ Responsive on mobile

---

## 📚 Next Steps

### Immediate
1. ✅ Add route
2. ✅ Test page
3. ✅ Customize products
4. ✅ Add real images

### Short Term
- [ ] Connect to cart system
- [ ] Add real product data
- [ ] Add countdown timer
- [ ] Add stock counter

### Long Term
- [ ] A/B testing
- [ ] Analytics tracking
- [ ] Personalization
- [ ] Dynamic pricing

---

**Ready to use!** 🎉

```bash
php artisan serve
# Visit: http://127.0.0.1:8000/promo
```

**Last Updated:** 3 Mei 2026
