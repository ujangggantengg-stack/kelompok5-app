# 🗺️ GPS Checkout System - Visual Diagram

## 📊 System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    USER BROWSER                              │
│                                                              │
│  ┌────────────────────────────────────────────────────┐    │
│  │         Checkout Form (roti.blade.php)             │    │
│  │                                                     │    │
│  │  [Nama] [Nomor WA]                                 │    │
│  │  [📍 Deteksi Lokasi] ← User clicks                │    │
│  │  [🔍 Search Address]                               │    │
│  │  [Nama Jalan] [No. Rumah] [RT/RW]                 │    │
│  │  [Kota/Kabupaten]                                  │    │
│  │  [💳 Ongkir: Rp 11.400]                           │    │
│  │  [Jarak: 3.2 km]                                   │    │
│  └────────────────────────────────────────────────────┘    │
│                          ↓                                   │
│  ┌────────────────────────────────────────────────────┐    │
│  │      JavaScript (checkout-modern.js)               │    │
│  │                                                     │    │
│  │  • detectLocation()                                │    │
│  │  • calculateDistance()                             │    │
│  │  • calculateShipping()                             │    │
│  │  • selectAddress()                                 │    │
│  └────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
                          ↓
        ┌─────────────────┴─────────────────┐
        ↓                                    ↓
┌───────────────────┐              ┌──────────────────┐
│  Geolocation API  │              │  Nominatim API   │
│   (Browser)       │              │  (OpenStreetMap) │
│                   │              │                  │
│ • getCurrentPos() │              │ • Reverse Geo    │
│ • High Accuracy   │              │ • Forward Geo    │
│ • Coordinates     │              │ • Search         │
└───────────────────┘              └──────────────────┘
        ↓                                    ↓
        └─────────────────┬─────────────────┘
                          ↓
              ┌───────────────────────┐
              │   Data Processing     │
              │                       │
              │ • Lat/Lng → Address   │
              │ • Distance Calc       │
              │ • Shipping Cost       │
              └───────────────────────┘
                          ↓
              ┌───────────────────────┐
              │   Laravel Backend     │
              │  (RotiController)     │
              │                       │
              │ • Validate Data       │
              │ • Save to Database    │
              │ • Create Order        │
              └───────────────────────┘
                          ↓
              ┌───────────────────────┐
              │   MySQL Database      │
              │                       │
              │ • orders table        │
              │ • customer_lat/lng    │
              │ • shipping_region     │
              └───────────────────────┘
```

---

## 🔄 GPS Detection Flow

```
USER ACTION                    SYSTEM RESPONSE
─────────────────────────────────────────────────────────

1. Click "Deteksi Lokasi"
                          →    Button: "⏳ Mendeteksi..."
                          →    navigator.geolocation.getCurrentPosition()
                               
2. Browser asks permission
   "Allow location access?"
                          
3. User clicks "Allow"
                          →    GPS starts acquiring position
                          →    enableHighAccuracy: true
                          →    timeout: 10000ms
                               
4. GPS lock acquired
                          →    Coordinates: -6.5971469, 106.8060394
                          →    Accuracy: 5-10 meters
                               
5. Reverse Geocoding
                          →    API Call: nominatim.openstreetmap.org
                          →    Params: lat, lng, zoom=18
                          →    Response: Address details
                               
6. Parse Address
                          →    Extract: road, village, district, city
                          →    Priority: road > pedestrian > path
                               
7. Auto-fill Form
                          →    streetInput.value = "Jl. Wates Dalam"
                          →    cityInput.value = "Pasirmulya, Kec. Bogor Bar., Bogor"
                          →    addressSearch.value = "Full address"
                               
8. Calculate Distance
                          →    Haversine Formula
                          →    storeLat, storeLng vs customerLat, customerLng
                          →    Result: 3.2 km
                               
9. Calculate Shipping
                          →    BASE_RATE + (distance × PER_KM_RATE)
                          →    5000 + (3.2 × 2000) = 11,400
                               
10. Update UI
                          →    shippingCostDisplay: "Rp 11.400"
                          →    distanceDisplay: "Jarak 3.2 km dari toko"
                          →    Button: "✅ Lokasi Terdeteksi"
                               
11. Save to Hidden Inputs
                          →    customerLat.value = -6.5971469
                          →    customerLng.value = 106.8060394
                          →    shippingRegion.value = 11400
                               
12. Ready to Submit
                          →    Form validation: OK
                          →    Submit button: Active
```

---

## 🔍 Address Search Flow

```
USER ACTION                    SYSTEM RESPONSE
─────────────────────────────────────────────────────────

1. Type in search box
   "Jl. Paj"
                          →    Input event triggered
                          →    Check length >= 3 chars
                               
2. Debounce (500ms)
                          →    clearTimeout(searchTimeout)
                          →    setTimeout(() => search(), 500)
                               
3. API Call
                          →    nominatim.openstreetmap.org/search
                          →    Params: q="Jl. Paj", limit=5
                          →    countrycodes=id
                               
4. Receive Results
                          →    [
                               {
                                 lat: -6.xxx,
                                 lon: 106.xxx,
                                 display_name: "Jl. Pajajaran, Bogor",
                                 address: {...}
                               },
                               ...
                             ]
                               
5. Render Suggestions
                          →    Create HTML for each result
                          →    Show in dropdown
                          →    Max 5 suggestions
                               
6. User hovers
                          →    Background: #f8f8f8
                               
7. User clicks suggestion
                          →    selectAddress(lat, lng, name)
                          →    Hide suggestions
                               
8. Reverse Geocoding
                          →    Get detailed address
                          →    zoom=18 for accuracy
                               
9. Auto-fill Form
                          →    Same as GPS detection
                               
10. Calculate Shipping
                          →    Same as GPS detection
```

---

## 💰 Shipping Cost Calculation

```
INPUT:
┌─────────────────────────────────────┐
│ Store Location (Fixed)              │
│ Lat: -6.5971469                     │
│ Lng: 106.8060394                    │
└─────────────────────────────────────┘
              +
┌─────────────────────────────────────┐
│ Customer Location (GPS)             │
│ Lat: -6.6123456                     │
│ Lng: 106.8234567                    │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│ Haversine Formula                   │
│                                     │
│ R = 6371 (Earth radius in km)       │
│ dLat = lat2 - lat1                  │
│ dLon = lon2 - lon1                  │
│                                     │
│ a = sin²(dLat/2) +                  │
│     cos(lat1) × cos(lat2) ×         │
│     sin²(dLon/2)                    │
│                                     │
│ c = 2 × atan2(√a, √(1-a))           │
│ distance = R × c                    │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│ Distance Result                     │
│ 3.2 km                              │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│ Check Max Distance                  │
│ if (distance > MAX_DISTANCE)        │
│   → "Diluar jangkauan"              │
│ else                                │
│   → Calculate cost                  │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│ Shipping Cost Formula               │
│                                     │
│ cost = BASE_RATE +                  │
│        (distance × PER_KM_RATE)     │
│                                     │
│ cost = 5000 + (3.2 × 2000)          │
│      = 5000 + 6400                  │
│      = 11,400                       │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│ Format to Rupiah                    │
│ Rp 11.400                           │
└─────────────────────────────────────┘
              ↓
OUTPUT:
┌─────────────────────────────────────┐
│ Display to User                     │
│ "Ongkos Kirim: Rp 11.400"           │
│ "Jarak 3.2 km dari toko"            │
└─────────────────────────────────────┘
```

---

## 🎨 UI State Diagram

```
┌─────────────────────────────────────────────────────────┐
│                    INITIAL STATE                         │
│                                                          │
│  Delivery Method: [Diantar] selected                    │
│  Address Section: Visible                               │
│  Pickup Section: Hidden                                 │
│  GPS Button: "📍 Deteksi Lokasi"                        │
│  Shipping Cost: "Menghitung..."                         │
│  Form Fields: Empty                                     │
└─────────────────────────────────────────────────────────┘
                          ↓
        ┌─────────────────┴─────────────────┐
        ↓                                    ↓
┌──────────────────┐              ┌──────────────────┐
│  GPS DETECTING   │              │  MANUAL INPUT    │
│                  │              │                  │
│ Button: "⏳..."  │              │ User types in    │
│ Disabled: true   │              │ search box or    │
│ Loading: true    │              │ form fields      │
└──────────────────┘              └──────────────────┘
        ↓                                    ↓
┌──────────────────┐              ┌──────────────────┐
│  GPS SUCCESS     │              │  SEARCH RESULTS  │
│                  │              │                  │
│ Button: "✅..."  │              │ Suggestions      │
│ Form: Auto-fill  │              │ dropdown shown   │
│ Shipping: Calc   │              │ Max 5 results    │
└──────────────────┘              └──────────────────┘
        ↓                                    ↓
        └─────────────────┬─────────────────┘
                          ↓
        ┌─────────────────────────────────┐
        │  SHIPPING CALCULATED             │
        │                                  │
        │  Within Range:                   │
        │  • Card: Blue/Purple gradient    │
        │  • Cost: "Rp 11.400"             │
        │  • Distance: "3.2 km"            │
        │                                  │
        │  Out of Range:                   │
        │  • Card: Red/Pink gradient       │
        │  • Cost: "Diluar jangkauan"      │
        │  • Distance: "18.5 km (max 15)"  │
        └─────────────────────────────────┘
                          ↓
        ┌─────────────────────────────────┐
        │  READY TO SUBMIT                 │
        │                                  │
        │  • All required fields filled    │
        │  • Shipping cost calculated      │
        │  • GPS coordinates saved         │
        │  • Submit button: Active         │
        └─────────────────────────────────┘
                          ↓
        ┌─────────────────────────────────┐
        │  FORM SUBMITTED                  │
        │                                  │
        │  • POST to /checkout             │
        │  • Data saved to database        │
        │  • Redirect to confirmation      │
        └─────────────────────────────────┘
```

---

## 🔀 Delivery Method Toggle

```
┌─────────────────────────────────────────────────────────┐
│                  DELIVERY METHOD                         │
│                                                          │
│  ┌──────────────┐         ┌──────────────┐             │
│  │   DIANTAR    │         │ AMBIL SENDIRI│             │
│  │   (Active)   │         │  (Inactive)  │             │
│  └──────────────┘         └──────────────┘             │
│                                                          │
│  When DIANTAR selected:                                 │
│  ✅ Address Section: Visible                            │
│  ❌ Pickup Section: Hidden                              │
│  ✅ GPS Button: Active                                  │
│  ✅ Shipping Cost: Calculated                           │
│  ✅ Required: street, house_number, rt_rw, city         │
│                                                          │
│  When AMBIL SENDIRI selected:                           │
│  ❌ Address Section: Hidden                             │
│  ✅ Pickup Section: Visible (store address)             │
│  ❌ GPS Button: Inactive                                │
│  ✅ Shipping Cost: Rp 0                                 │
│  ❌ Required: none (only name & phone)                  │
└─────────────────────────────────────────────────────────┘
```

---

## 📊 Data Flow

```
┌─────────────────────────────────────────────────────────┐
│                    FRONTEND                              │
│                                                          │
│  Form Data:                                             │
│  • customer_name: "John Doe"                            │
│  • customer_phone: "081234567890"                       │
│  • shipping_method: "delivery"                          │
│  • street: "Jl. Wates Dalam"                            │
│  • house_number: "61"                                   │
│  • rt_rw: "02/05"                                       │
│  • city: "Pasirmulya, Kec. Bogor Bar., Bogor"          │
│  • house_details: "Dekat minimarket"                    │
│  • customer_lat: "-6.5971469"                           │
│  • customer_lng: "106.8060394"                          │
│  • shipping_region: "11400"                             │
│  • notes: "Hubungi dulu sebelum antar"                  │
│  • payment_method: "QRIS"                               │
└─────────────────────────────────────────────────────────┘
                          ↓ POST /checkout
┌─────────────────────────────────────────────────────────┐
│                    BACKEND                               │
│                  (RotiController)                        │
│                                                          │
│  Validation:                                            │
│  • Required fields check                                │
│  • Phone number format                                  │
│  • Coordinates validation                               │
│  • Shipping cost validation                             │
│                                                          │
│  Processing:                                            │
│  • Calculate total (cart + shipping)                    │
│  • Generate order number                                │
│  • Create order record                                  │
│  • Create order items                                   │
│  • Clear cart                                           │
│                                                          │
│  Response:                                              │
│  • Redirect to payment page                             │
│  • Or show confirmation                                 │
└─────────────────────────────────────────────────────────┘
                          ↓ INSERT
┌─────────────────────────────────────────────────────────┐
│                    DATABASE                              │
│                  (MySQL - orders)                        │
│                                                          │
│  Record:                                                │
│  • id: 123                                              │
│  • order_number: "ORD-20260503-001"                     │
│  • customer_name: "John Doe"                            │
│  • customer_phone: "081234567890"                       │
│  • shipping_method: "delivery"                          │
│  • delivery_address: "Jl. Wates Dalam No.61..."         │
│  • customer_lat: -6.5971469                             │
│  • customer_lng: 106.8060394                            │
│  • shipping_cost: 11400                                 │
│  • subtotal: 50000                                      │
│  • total: 61400                                         │
│  • payment_method: "QRIS"                               │
│  • status: "pending"                                    │
│  • created_at: "2026-05-03 11:30:00"                    │
└─────────────────────────────────────────────────────────┘
```

---

## 🎯 Error Handling Flow

```
GPS Detection Error
├── Permission Denied
│   └── Alert: "Izinkan akses lokasi di browser"
│   └── Fallback: Manual input / Search
│
├── Position Unavailable
│   └── Alert: "Lokasi tidak tersedia"
│   └── Fallback: Manual input / Search
│
├── Timeout
│   └── Alert: "Waktu habis. Coba lagi."
│   └── Fallback: Manual input / Search
│
└── Geocoding Failed
    └── Alert: "Gagal mendapatkan alamat"
    └── Fallback: Manual input

Address Search Error
├── No Results
│   └── Hide suggestions dropdown
│   └── User can type manually
│
├── API Error
│   └── Console log error
│   └── Hide suggestions dropdown
│
└── Network Error
    └── Console log error
    └── Fallback: Manual input

Shipping Calculation Error
├── Out of Range
│   └── Display: "Diluar jangkauan"
│   └── Card color: Red/Pink
│   └── Submit: Blocked
│
├── Invalid Coordinates
│   └── Alert: "Koordinat GPS tidak valid"
│   └── Request: Deteksi ulang
│
└── Missing Store Coordinates
    └── Console error: "STORE_LAT/LNG not set"
    └── Display: "Menghitung..."

Form Validation Error
├── Required Field Empty
│   └── Browser validation message
│   └── Focus to first error field
│
├── Invalid Phone Format
│   └── Custom validation message
│   └── Highlight field
│
└── Missing GPS Data (for delivery)
    └── Alert: "Silakan deteksi lokasi terlebih dahulu"
    └── Prevent submit
```

---

## 🔐 Security & Privacy

```
┌─────────────────────────────────────────────────────────┐
│                  SECURITY MEASURES                       │
│                                                          │
│  GPS Data:                                              │
│  • Only collected when user clicks "Deteksi Lokasi"     │
│  • Requires explicit browser permission                 │
│  • Stored only for order fulfillment                    │
│  • Not shared with third parties                        │
│                                                          │
│  API Calls:                                             │
│  • HTTPS only (GPS requires secure context)             │
│  • No API keys exposed in frontend                      │
│  • Rate limiting via debounce (500ms)                   │
│  • OpenStreetMap: Free & privacy-friendly               │
│                                                          │
│  Form Data:                                             │
│  • CSRF token protection                                │
│  • Server-side validation                               │
│  • SQL injection prevention (Laravel ORM)               │
│  • XSS prevention (input sanitization)                  │
│                                                          │
│  User Privacy:                                          │
│  • Coordinates used only for shipping calculation       │
│  • No tracking or analytics on GPS data                 │
│  • User can opt for "Ambil Sendiri" (no GPS)           │
│  • Manual input always available as fallback            │
└─────────────────────────────────────────────────────────┘
```

---

## 📱 Responsive Design

```
┌─────────────────────────────────────────────────────────┐
│                    DESKTOP VIEW                          │
│  (> 768px)                                              │
│                                                          │
│  ┌────────────────────────────────────────────────┐    │
│  │  [Nama Lengkap]        [Nomor WhatsApp]        │    │
│  │  [📍 Deteksi Lokasi]                           │    │
│  │  [🔍 Search Address]                           │    │
│  │  [Nama Jalan]                                  │    │
│  │  [No. Rumah]           [RT/RW]                 │    │
│  │  [Kota/Kabupaten]                              │    │
│  │  [💳 Ongkir Card - Full Width]                │    │
│  └────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│                    MOBILE VIEW                           │
│  (< 768px)                                              │
│                                                          │
│  ┌──────────────────────┐                               │
│  │  [Nama Lengkap]      │                               │
│  │  [Nomor WhatsApp]    │                               │
│  │  [📍 Deteksi Lokasi] │                               │
│  │  [🔍 Search]         │                               │
│  │  [Nama Jalan]        │                               │
│  │  [No. Rumah]         │                               │
│  │  [RT/RW]             │                               │
│  │  [Kota/Kabupaten]    │                               │
│  │  [💳 Ongkir Card]    │                               │
│  └──────────────────────┘                               │
│                                                          │
│  • Single column layout                                 │
│  • Larger touch targets (min 44px)                      │
│  • Optimized for thumb reach                            │
│  • GPS more accurate on mobile                          │
└─────────────────────────────────────────────────────────┘
```

---

## 🎉 Success Indicators

```
✅ GPS Detection Success
   • Button: "✅ Lokasi Terdeteksi" (green)
   • Form: Auto-filled with accurate data
   • Shipping: Cost displayed
   • Distance: Shown in km
   • Card: Blue/Purple gradient

✅ Address Search Success
   • Suggestions: Displayed (max 5)
   • Selection: Form auto-filled
   • Shipping: Cost calculated
   • Coordinates: Saved

✅ Manual Input Success
   • All fields: Editable
   • Validation: Passed
   • Submit: Enabled

✅ Form Submit Success
   • Order: Created in database
   • Redirect: To confirmation page
   • Cart: Cleared
   • Notification: Sent (if configured)
```

---

**Diagram ini membantu memahami:**
- 🏗️ Arsitektur sistem
- 🔄 Alur data dan proses
- 🎨 State management UI
- 🔐 Security measures
- 📱 Responsive behavior
- ✅ Success criteria

**Gunakan sebagai referensi saat development dan debugging!**
