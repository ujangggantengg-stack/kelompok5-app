# 🔥 Promo Modal Guide - Shopee Style

> **Modal promo yang menarik seperti Shopee/GoFood untuk meningkatkan konversi!**

**Created:** 3 Mei 2026  
**Version:** 1.0.0

---

## ✨ Features

### 1. 🎨 Design Premium

**Tampilan:**
- Background gradient (amber-50 to orange-50)
- Rounded corners (3xl)
- Shadow 2xl untuk depth
- Responsive grid layout

**Typography:**
- Header: Georgia serif (elegant)
- Body: Arial sans-serif (clean)
- Bold pricing dengan color contrast

---

### 2. 🛒 Product Cards

**Setiap Card Punya:**
- ✅ Promo badge (merah, pojok kiri atas)
- ✅ Add to cart button (pojok kanan atas)
- ✅ Product image dengan background gradient
- ✅ Category description
- ✅ Product name (bold, besar)
- ✅ Price (coret harga lama, bold harga promo)
- ✅ Status badge (Ready Hari Ini)
- ✅ Info icon (Promo terbatas/Stok menipis/Fresh)
- ✅ Buy button (gradient brown)

---

### 3. 🎯 Interactive Elements

**Hover Effects:**
- Card lift up (-translate-y-2)
- Shadow increase
- Button color change
- Smooth transitions

**Click Actions:**
- Add to cart (+)
- Buy button
- Close modal (X)
- Cart button

---

## 📁 File Structure

```
resources/views/
├── components/
│   └── promo-modal.blade.php    # Modal component
└── promo-page.blade.php          # Demo page
```

---

## 🚀 Usage

### Method 1: Include in Blade

```blade
<!-- In your blade file -->
@include('components.promo-modal')

<!-- Trigger button -->
<button onclick="openPromoModal()">
    Lihat Promo
</button>
```

---

### Method 2: Auto-show on Page Load

```javascript
// Show modal automatically
document.addEventListener('DOMContentLoaded', function() {
    // Show after 2 seconds
    setTimeout(() => {
        openPromoModal();
    }, 2000);
});
```

---

### Method 3: Show on Specific Condition

```javascript
// Show if user is first time visitor
if (!localStorage.getItem('promoShown')) {
    openPromoModal();
    localStorage.setItem('promoShown', 'true');
}
```

---

## 🎨 Customization

### Change Colors

**Primary Color (Orange):**
```css
/* Find and replace */
bg-orange-500 → bg-blue-500
text-orange-500 → text-blue-500
from-orange-50 to-amber-50 → from-blue-50 to-indigo-50
```

**Button Color (Brown):**
```css
/* Find and replace */
from-amber-800 to-amber-900 → from-blue-800 to-blue-900
```

---

### Change Product Images

**Replace placeholder images:**
```html
<!-- Before -->
<img src="https://via.placeholder.com/400x400/8B4513/FFFFFF?text=Roti+Sobek+Coklat">

<!-- After -->
<img src="{{ asset('images/products/roti-coklat.jpg') }}">
```

---

### Add More Products

**Copy this block:**
```html
<div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
    <!-- Product content here -->
</div>
```

**Adjust grid:**
```html
<!-- For 4 products -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

<!-- For 6 products -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
```

---

## 🎯 Product Card Anatomy

```
┌─────────────────────────────┐
│ [PROMO]              [+]    │ ← Badges
│                              │
│      Product Image           │ ← Image with gradient bg
│                              │
├─────────────────────────────┤
│ Category Description         │ ← Small text
│                              │
│ PRODUCT NAME                 │ ← Bold, large
│                              │
│ Rp 30.000  Rp 27.000        │ ← Price (old + new)
│                              │
│ [Ready Hari Ini 🍞]         │ ← Status badge
│                              │
│ ⚡ Promo terbatas!          │ ← Info
│                              │
│ [🛒 Beli]                   │ ← Buy button
└─────────────────────────────┘
```

---

## 📱 Responsive Design

### Desktop (>1024px)
```
┌─────────────────────────────────────┐
│  Header                             │
│  [Cart Button]                      │
├───────────┬───────────┬─────────────┤
│  Card 1   │  Card 2   │  Card 3    │
│           │           │             │
└───────────┴───────────┴─────────────┘
```

### Tablet (768px - 1024px)
```
┌─────────────────────────────┐
│  Header                     │
│  [Cart Button]              │
├──────────────┬──────────────┤
│  Card 1      │  Card 2      │
├──────────────┼──────────────┤
│  Card 3      │              │
└──────────────┴──────────────┘
```

### Mobile (<768px)
```
┌─────────────────┐
│  Header         │
│  [Cart Button]  │
├─────────────────┤
│  Card 1         │
├─────────────────┤
│  Card 2         │
├─────────────────┤
│  Card 3         │
└─────────────────┘
```

---

## 🎬 Animations

### Card Hover
```css
hover:shadow-2xl
hover:-translate-y-2
transition-all
```

### Button Hover
```css
hover:bg-orange-500
hover:text-white
transition-all
```

### Modal Open/Close
```javascript
// Fade in
classList.remove('hidden')

// Fade out
classList.add('hidden')
```

---

## 🔧 JavaScript Functions

### Open Modal
```javascript
function openPromoModal() {
    document.getElementById('promoModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent scroll
}
```

### Close Modal
```javascript
function closePromoModal() {
    document.getElementById('promoModal').classList.add('hidden');
    document.body.style.overflow = 'auto'; // Enable scroll
}
```

### Close on ESC
```javascript
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePromoModal();
    }
});
```

### Close on Backdrop Click
```javascript
document.getElementById('promoModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closePromoModal();
    }
});
```

---

## 🛒 Cart Integration

### Update Cart Count
```javascript
function updateCartCount() {
    const count = getCartItemCount(); // Your function
    document.getElementById('cartCount').textContent = count;
}
```

### Add to Cart
```javascript
function addToCart(productId) {
    // Your add to cart logic
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        updateCartCount();
        showNotification('Produk ditambahkan ke keranjang!');
    });
}
```

---

## 💡 Best Practices

### Performance
1. **Lazy load images:**
   ```html
   <img loading="lazy" src="...">
   ```

2. **Optimize images:**
   - Use WebP format
   - Compress to <100KB
   - Use CDN

3. **Minimize animations:**
   - Use CSS transforms (GPU accelerated)
   - Avoid layout shifts

---

### UX
1. **Clear CTA:**
   - "Beli" button prominent
   - Easy to close modal

2. **Visual hierarchy:**
   - Price most visible
   - Product name clear
   - Status badge noticeable

3. **Mobile-first:**
   - Touch-friendly buttons
   - Readable text size
   - Easy scrolling

---

### Accessibility
1. **Keyboard navigation:**
   - ESC to close
   - Tab through buttons

2. **ARIA labels:**
   ```html
   <button aria-label="Close modal">
   ```

3. **Focus management:**
   - Focus on modal when opened
   - Return focus when closed

---

## 🎯 Conversion Optimization

### Urgency
- ⚡ "Promo terbatas!"
- 🔥 "Stok menipis!"
- ⏰ "Hanya hari ini!"

### Social Proof
- ⭐ "Rating 4.9/5"
- 👥 "1000+ terjual"
- 💬 "Review positif"

### Value Proposition
- 💰 Show discount percentage
- 🎁 Free shipping badge
- ✅ Quality guarantee

---

## 📊 Analytics

### Track Events
```javascript
// Modal opened
gtag('event', 'promo_modal_opened');

// Product clicked
gtag('event', 'promo_product_clicked', {
    product_name: 'Roti Sobek Coklat',
    product_price: 27000
});

// Add to cart
gtag('event', 'add_to_cart', {
    product_id: 123,
    product_name: 'Roti Sobek Coklat'
});
```

---

## 🐛 Troubleshooting

### Modal Not Showing
```javascript
// Check if element exists
console.log(document.getElementById('promoModal'));

// Check classes
console.log(document.getElementById('promoModal').classList);
```

### Images Not Loading
```html
<!-- Check path -->
<img src="{{ asset('images/products/roti.jpg') }}" 
     onerror="this.src='https://via.placeholder.com/400'">
```

### Scroll Not Disabled
```javascript
// Force disable
document.body.style.overflow = 'hidden';
document.body.style.position = 'fixed';
document.body.style.width = '100%';
```

---

## 🚀 Advanced Features

### Auto-show Timer
```javascript
// Show after 5 seconds
setTimeout(() => {
    if (!sessionStorage.getItem('promoShown')) {
        openPromoModal();
        sessionStorage.setItem('promoShown', 'true');
    }
}, 5000);
```

### Exit Intent
```javascript
document.addEventListener('mouseout', function(e) {
    if (e.clientY < 0 && !sessionStorage.getItem('exitPromoShown')) {
        openPromoModal();
        sessionStorage.setItem('exitPromoShown', 'true');
    }
});
```

### Scroll Trigger
```javascript
window.addEventListener('scroll', function() {
    const scrollPercent = (window.scrollY / document.body.scrollHeight) * 100;
    
    if (scrollPercent > 50 && !sessionStorage.getItem('scrollPromoShown')) {
        openPromoModal();
        sessionStorage.setItem('scrollPromoShown', 'true');
    }
});
```

---

## 🎉 Success Metrics

### Track These:
- Modal open rate
- Click-through rate
- Add to cart rate
- Conversion rate
- Average order value

### Goals:
- Open rate: >30%
- CTR: >10%
- Add to cart: >5%
- Conversion: >2%

---

## 📚 Related Files

- **promo-modal.blade.php** - Modal component
- **promo-page.blade.php** - Demo page
- **PROMO_MODAL_GUIDE.md** - This file

---

**Modal promo sekarang production-ready!** 🎉

Features:
- ✅ Design premium seperti Shopee
- ✅ Responsive untuk semua device
- ✅ Interactive hover effects
- ✅ Easy to customize
- ✅ Cart integration ready
- ✅ Analytics ready

**Last Updated:** 3 Mei 2026  
**Version:** 1.0.0
