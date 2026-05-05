# 👤 User Login System - Complete Guide

> **Optional login system seperti Shopee - Guest checkout tetap bisa, tapi login dapat benefit lebih!**

**Created:** 3 Mei 2026  
**Status:** ✅ Database Ready, 🚧 Implementation In Progress

---

## 🎯 Fitur Lengkap

### 1. ✅ Optional Login
- Guest bisa checkout tanpa login
- Login opsional untuk benefit lebih
- Smooth transition dari guest ke member

### 2. 🔐 Login Methods
- **Email & Password** - Register manual
- **Google OAuth** - Login dengan Google
- **Remember Me** - Stay logged in

### 3. 👤 User Profile
- Nama lengkap
- Email
- Nomor HP
- Avatar (dari Google atau upload)
- Alamat default

### 4. 📍 Saved Addresses
- Multiple addresses (Rumah, Kantor, Kos, dll)
- Set primary address
- GPS coordinates tersimpan
- Quick select saat checkout

### 5. 📦 Order History
- Lihat semua pesanan
- Status real-time
- Track delivery
- Reorder dengan 1 klik

### 6. 💬 Quick Chat
- Chat admin langsung
- Tanpa input nomor lagi
- History chat tersimpan
- Notifikasi real-time

### 7. ⚡ Quick Checkout
- Auto-fill dari profile
- Select saved address
- 1-click checkout
- Faster than guest

---

## 📊 Database Schema

### ✅ Tables Created

**1. customers**
```sql
- id
- name
- email (unique)
- password (nullable for Google)
- google_id (nullable, unique)
- avatar
- phone
- address
- city, province, postal_code
- latitude, longitude
- save_address (boolean)
- notifications_enabled (boolean)
- timestamps
```

**2. user_addresses**
```sql
- id
- user_id (foreign to customers)
- label (Rumah/Kantor/Kos)
- recipient_name
- phone
- address, address_detail
- city, district, province, postal_code
- latitude, longitude
- is_primary (boolean)
- is_active (boolean)
- timestamps
```

---

## 🚀 Implementation Roadmap

### Phase 1: Authentication (Week 1)

**1.1 Register & Login Pages**
- [ ] Create register page (email/password)
- [ ] Create login page
- [ ] Add validation
- [ ] Add CSRF protection

**1.2 Google OAuth**
- [ ] Install Laravel Socialite
- [ ] Configure Google OAuth
- [ ] Create OAuth controller
- [ ] Handle OAuth callback

**1.3 Session Management**
- [ ] Configure session driver
- [ ] Add remember me functionality
- [ ] Add logout functionality

---

### Phase 2: User Profile (Week 2)

**2.1 Profile Page**
- [ ] Create profile view
- [ ] Show user info
- [ ] Edit profile form
- [ ] Upload avatar
- [ ] Update password

**2.2 Address Management**
- [ ] List saved addresses
- [ ] Add new address
- [ ] Edit address
- [ ] Delete address
- [ ] Set primary address
- [ ] GPS integration

---

### Phase 3: Checkout Integration (Week 3)

**3.1 Guest Checkout**
- [ ] Keep existing guest checkout
- [ ] Add "Login to save address" prompt
- [ ] Convert guest to member after checkout

**3.2 Member Checkout**
- [ ] Auto-fill from profile
- [ ] Select saved address
- [ ] Quick checkout flow
- [ ] Save new address option

---

### Phase 4: Order History (Week 4)

**4.1 Order List**
- [ ] Show all orders
- [ ] Filter by status
- [ ] Search orders
- [ ] Pagination

**4.2 Order Detail**
- [ ] Show order details
- [ ] Track delivery
- [ ] Download invoice
- [ ] Reorder button

---

### Phase 5: Chat Integration (Week 5)

**5.1 Quick Chat**
- [ ] Chat button in header
- [ ] Auto-fill user info
- [ ] Chat history
- [ ] Real-time updates

**5.2 Notifications**
- [ ] Order status updates
- [ ] Chat notifications
- [ ] Email notifications
- [ ] Push notifications (optional)

---

## 💻 Code Examples

### 1. Customer Model (✅ Done)

```php
// app/Models/Customer.php
class Customer extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'google_id',
        'avatar', 'phone', 'address', 'city',
        'province', 'postal_code', 'latitude', 'longitude'
    ];
    
    public function addresses() {
        return $this->hasMany(UserAddress::class, 'user_id');
    }
    
    public function primaryAddress() {
        return $this->hasOne(UserAddress::class, 'user_id')
                    ->where('is_primary', true);
    }
    
    public function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
```

---

### 2. Register Controller (To Do)

```php
// app/Http/Controllers/Auth/CustomerRegisterController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers',
        'password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string',
    ]);
    
    $customer = Customer::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'phone' => $validated['phone'],
    ]);
    
    Auth::guard('customer')->login($customer);
    
    return redirect()->route('home')
        ->with('success', 'Akun berhasil dibuat!');
}
```

---

### 3. Google OAuth Controller (To Do)

```php
// app/Http/Controllers/Auth/GoogleController.php
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->user();
    
    $customer = Customer::updateOrCreate(
        ['google_id' => $googleUser->id],
        [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'avatar' => $googleUser->avatar,
            'email_verified_at' => now(),
        ]
    );
    
    Auth::guard('customer')->login($customer);
    
    return redirect()->route('home');
}
```

---

### 4. Checkout with Auth (To Do)

```php
// app/Http/Controllers/CheckoutController.php
public function index()
{
    $customer = Auth::guard('customer')->user();
    
    if ($customer) {
        // Member checkout - auto-fill
        $addresses = $customer->addresses()->active()->get();
        $primaryAddress = $customer->primaryAddress;
        
        return view('checkout', compact('customer', 'addresses', 'primaryAddress'));
    } else {
        // Guest checkout
        return view('checkout-guest');
    }
}
```

---

## 🎨 UI/UX Flow

### Guest User Flow

```
Homepage
  ↓
Browse Products
  ↓
Add to Cart
  ↓
Checkout (Guest)
  ├─ Fill form manually
  ├─ Enter phone, address, etc
  └─ Complete order
      ↓
  [Prompt: "Create account to save address?"]
      ├─ Yes → Register → Save address
      └─ No → Continue as guest
```

---

### Member User Flow

```
Homepage
  ↓
Login/Register
  ├─ Email/Password
  └─ Google OAuth
      ↓
Browse Products
  ↓
Add to Cart
  ↓
Checkout (Member)
  ├─ Auto-fill from profile ✅
  ├─ Select saved address ✅
  ├─ Or add new address
  └─ 1-Click checkout ⚡
      ↓
Order Placed
  ↓
View Order History
  ├─ Track delivery
  ├─ Chat admin
  └─ Reorder
```

---

## 📱 UI Components

### 1. Login/Register Modal

```html
<!-- Login Modal -->
<div class="modal">
    <h2>Masuk ke Akun</h2>
    
    <!-- Google Login -->
    <button class="btn-google">
        <i class="fab fa-google"></i>
        Masuk dengan Google
    </button>
    
    <div class="divider">atau</div>
    
    <!-- Email Login -->
    <form>
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Password">
        <button type="submit">Masuk</button>
    </form>
    
    <p>Belum punya akun? <a href="/register">Daftar</a></p>
</div>
```

---

### 2. User Menu (Header)

```html
<!-- If logged in -->
<div class="user-menu">
    <img src="{{ $customer->avatar_url }}" class="avatar">
    <span>{{ $customer->name }}</span>
    
    <div class="dropdown">
        <a href="/profile">Profile</a>
        <a href="/orders">Pesanan Saya</a>
        <a href="/addresses">Alamat</a>
        <a href="/logout">Keluar</a>
    </div>
</div>

<!-- If not logged in -->
<div class="auth-buttons">
    <a href="/login">Masuk</a>
    <a href="/register">Daftar</a>
</div>
```

---

### 3. Saved Address Selector

```html
<!-- In checkout page -->
<div class="address-selector">
    <h3>Pilih Alamat Pengiriman</h3>
    
    @foreach($addresses as $address)
    <div class="address-card {{ $address->is_primary ? 'primary' : '' }}">
        <input type="radio" name="address_id" value="{{ $address->id }}">
        <div class="address-info">
            <span class="label">{{ $address->label }}</span>
            <p class="recipient">{{ $address->recipient_name }}</p>
            <p class="phone">{{ $address->phone }}</p>
            <p class="address">{{ $address->full_address }}</p>
        </div>
        <div class="actions">
            <button class="edit">Edit</button>
            <button class="delete">Hapus</button>
        </div>
    </div>
    @endforeach
    
    <button class="add-new-address">
        <i class="fas fa-plus"></i>
        Tambah Alamat Baru
    </button>
</div>
```

---

## 🔒 Security

### 1. Authentication Guards

```php
// config/auth.php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users', // Admin
    ],
    'customer' => [
        'driver' => 'session',
        'provider' => 'customers', // Customer
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'customers' => [
        'driver' => 'eloquent',
        'model' => App\Models\Customer::class,
    ],
],
```

---

### 2. Middleware

```php
// app/Http/Middleware/CustomerAuth.php
public function handle($request, Closure $next)
{
    if (!Auth::guard('customer')->check()) {
        return redirect()->route('login')
            ->with('error', 'Silakan login terlebih dahulu');
    }
    
    return $next($request);
}
```

---

### 3. Routes

```php
// routes/web.php

// Guest routes
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login']);
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register']);

// Google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Protected routes (require login)
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update']);
    
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses');
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::put('/addresses/{id}', [AddressController::class, 'update']);
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
});

// Guest checkout (no login required)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process']);
```

---

## 📦 Required Packages

### 1. Laravel Socialite (Google OAuth)

```bash
composer require laravel/socialite
```

**Config:**
```php
// config/services.php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
```

**.env:**
```
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

---

## 🎯 Benefits

### For Users:
✅ Faster checkout (auto-fill)  
✅ Save multiple addresses  
✅ Order history tracking  
✅ Quick reorder  
✅ Chat without entering phone  
✅ Personalized experience  

### For Business:
✅ Customer data collection  
✅ Repeat purchase tracking  
✅ Marketing opportunities  
✅ Better customer service  
✅ Reduced cart abandonment  
✅ Increased loyalty  

---

## 📊 Success Metrics

### Track These:
- Registration rate
- Login rate
- Guest vs Member checkout
- Saved address usage
- Reorder rate
- Customer lifetime value

### Goals:
- Registration: >20% of visitors
- Member checkout: >60%
- Saved address usage: >80%
- Reorder rate: >30%

---

## 🚀 Next Steps

### Immediate (This Week):
1. ✅ Database schema created
2. ✅ Models created
3. [ ] Install Laravel Socialite
4. [ ] Configure Google OAuth
5. [ ] Create auth controllers

### Short Term (Next 2 Weeks):
- [ ] Build login/register UI
- [ ] Implement Google OAuth
- [ ] Create profile page
- [ ] Build address management

### Long Term (Next Month):
- [ ] Order history page
- [ ] Quick checkout flow
- [ ] Chat integration
- [ ] Email notifications

---

**Database sudah ready!** ✅  
**Tinggal implementasi UI dan logic!** 🚀

**Last Updated:** 3 Mei 2026  
**Version:** 1.0.0
