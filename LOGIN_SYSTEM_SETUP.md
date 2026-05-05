# 🔐 Login System - Setup Guide

**Status:** ✅ Core Implementation Complete  
**Date:** 3 Mei 2026

---

## ✅ What's Been Implemented

### 1. Database & Models
- ✅ `customers` table (migrated)
- ✅ `user_addresses` table (migrated)
- ✅ `Customer` model with relationships
- ✅ `UserAddress` model with features
- ✅ Authentication guards configured

### 2. Authentication
- ✅ Email/Password login & register
- ✅ Google OAuth integration (Socialite installed)
- ✅ Customer authentication guard
- ✅ Session management
- ✅ Remember me functionality
- ✅ Logout functionality

### 3. Controllers
- ✅ `CustomerAuthController` - Login/Register/Logout
- ✅ `GoogleController` - Google OAuth
- ✅ `ProfileController` - Profile management
- ✅ `AddressController` - Address CRUD
- ✅ `OrderController` - Order history

### 4. Views
- ✅ Login page (`/login`)
- ✅ Register page (`/register`)
- ✅ Profile page (`/customer/profile`)

### 5. Routes
- ✅ Guest routes (login, register, Google OAuth)
- ✅ Protected routes (profile, addresses, orders)
- ✅ Middleware configured

### 6. Configuration
- ✅ Auth guards (web, customer)
- ✅ Auth providers (users, customers)
- ✅ Google OAuth config
- ✅ Password reset config
- ✅ Middleware aliases

---

## 🚀 Quick Start

### Step 1: Configure Google OAuth

1. **Get Google OAuth Credentials:**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Create a new project or select existing
   - Enable Google+ API
   - Create OAuth 2.0 credentials
   - Add authorized redirect URI: `http://localhost:8000/auth/google/callback`

2. **Update `.env` file:**
```env
GOOGLE_CLIENT_ID=your-client-id-here
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### Step 2: Run Migrations (if not done)

```bash
php artisan migrate
```

### Step 3: Test the System

1. **Register a new account:**
   - Visit: `http://localhost:8000/register`
   - Fill in the form
   - Submit

2. **Login:**
   - Visit: `http://localhost:8000/login`
   - Use email/password or Google

3. **Access profile:**
   - Visit: `http://localhost:8000/customer/profile`

---

## 📋 Available Routes

### Guest Routes (No Login Required)
```
GET  /login                    - Login page
POST /login                    - Process login
GET  /register                 - Register page
POST /register                 - Process registration
GET  /auth/google              - Redirect to Google
GET  /auth/google/callback     - Google callback
```

### Protected Routes (Login Required)
```
GET  /customer/profile         - Profile page
PUT  /customer/profile         - Update profile
PUT  /customer/profile/password - Change password
POST /customer/profile/avatar  - Upload avatar

GET  /customer/addresses       - List addresses
POST /customer/addresses       - Add address
PUT  /customer/addresses/{id}  - Update address
POST /customer/addresses/{id}/primary - Set primary
DELETE /customer/addresses/{id} - Delete address

GET  /customer/orders          - Order history
GET  /customer/orders/{id}     - Order detail
POST /customer/orders/{id}/reorder - Reorder

POST /logout                   - Logout
```

---

## 🎯 Next Steps (To Complete)

### 1. Create Address Management Views
- [ ] `resources/views/customer/addresses/index.blade.php`
- [ ] Add address form modal
- [ ] GPS map picker integration

### 2. Create Order History Views
- [ ] `resources/views/customer/orders/index.blade.php`
- [ ] `resources/views/customer/orders/show.blade.php`
- [ ] Order status tracking

### 3. Integrate with Checkout
- [ ] Update checkout to detect logged-in user
- [ ] Auto-fill from profile
- [ ] Show saved addresses
- [ ] Save order to customer

### 4. Add User Menu to Header
- [ ] Show login/register buttons for guests
- [ ] Show user avatar & dropdown for members
- [ ] Quick links to profile, orders, logout

### 5. Chat Integration
- [ ] Auto-fill customer info in chat
- [ ] Link chat messages to customer
- [ ] Show chat history

---

## 🔒 Security Features

### Implemented:
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ Session regeneration on login
- ✅ Email validation
- ✅ Password confirmation
- ✅ Separate customer guard
- ✅ Middleware protection

### Recommended:
- [ ] Email verification
- [ ] Password reset via email
- [ ] Rate limiting on login
- [ ] Two-factor authentication (optional)
- [ ] Account lockout after failed attempts

---

## 📱 User Experience Flow

### Guest User:
```
Homepage → Browse → Add to Cart → Checkout (Guest)
                                      ↓
                            [Prompt: Create Account?]
                                   ↙     ↘
                              Yes: Register   No: Continue
```

### Member User:
```
Homepage → Login → Browse → Add to Cart → Checkout (Auto-fill)
                                              ↓
                                        Complete Order
                                              ↓
                                        View in Orders
```

---

## 🎨 Design Features

### Login/Register Pages:
- ✅ Modern gradient background
- ✅ Google OAuth button with logo
- ✅ Clean form design
- ✅ Floating labels
- ✅ Error messages
- ✅ Success notifications
- ✅ Benefits list
- ✅ Guest checkout option

### Profile Page:
- ✅ Sidebar navigation
- ✅ Avatar display
- ✅ Profile edit form
- ✅ Password change form
- ✅ Responsive design

---

## 🧪 Testing Checklist

### Authentication:
- [ ] Register with email/password
- [ ] Login with email/password
- [ ] Login with Google
- [ ] Remember me works
- [ ] Logout works
- [ ] Invalid credentials show error
- [ ] Duplicate email shows error

### Profile:
- [ ] View profile
- [ ] Update profile info
- [ ] Change password
- [ ] Upload avatar
- [ ] Validation works

### Authorization:
- [ ] Guest cannot access protected routes
- [ ] Redirects to login page
- [ ] After login, redirects back
- [ ] Customer guard works separately from admin

---

## 💡 Tips

### For Development:
1. Use `php artisan tinker` to create test customers:
```php
$customer = \App\Models\Customer::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password'),
]);
```

2. Check if user is logged in:
```php
Auth::guard('customer')->check()
Auth::guard('customer')->user()
```

3. Login programmatically:
```php
Auth::guard('customer')->login($customer);
```

### For Production:
1. Set strong `APP_KEY` in `.env`
2. Use HTTPS for Google OAuth
3. Update Google OAuth redirect URI
4. Enable email verification
5. Set up password reset emails
6. Configure session driver (redis/database)

---

## 📚 Related Documentation

- `USER_LOGIN_SYSTEM_GUIDE.md` - Complete feature guide
- `app/Models/Customer.php` - Customer model
- `app/Models/UserAddress.php` - Address model
- `config/auth.php` - Authentication config
- `routes/web.php` - All routes

---

## 🆘 Troubleshooting

### "Class 'Laravel\Socialite\Facades\Socialite' not found"
```bash
composer require laravel/socialite
```

### "SQLSTATE[HY000]: General error: 1 no such table: customers"
```bash
php artisan migrate
```

### "Unauthenticated" when accessing protected routes
- Make sure you're logged in
- Check if using correct guard: `Auth::guard('customer')`

### Google OAuth not working
- Check credentials in `.env`
- Verify redirect URI matches Google Console
- Make sure Google+ API is enabled

---

**System is ready for testing!** 🎉

Login at: `http://localhost:8000/login`  
Register at: `http://localhost:8000/register`

