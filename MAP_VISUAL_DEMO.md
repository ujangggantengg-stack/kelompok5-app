# 📸 Map Visual Demo - Screenshot Guide

> **Visual guide untuk memahami tampilan map di checkout**

---

## 🖼️ Tampilan Map

### Full View - Desktop

```
┌─────────────────────────────────────────────────────────────┐
│  🍞 Toko Roti                                    Checkout   │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  👤 Detail Penerima                                         │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  👤 Nama Lengkap Penerima                          │   │
│  │  📱 Nomor WhatsApp                                  │   │
│  └─────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  📍 Lokasi Pengiriman              [🎯 Deteksi Lokasi]     │
│                                                              │
│  ┌────────────────────────────────────────────────────┐    │
│  │  ┌──────────────────┐                              │    │
│  │  │ 🔴 Pin Lokasi    │         🗺️ MAP AREA         │    │
│  │  │ 🔵 Lokasi Toko   │                              │    │
│  │  └──────────────────┘                              │    │
│  │                                                     │    │
│  │                    🔵 (Toko)                       │    │
│  │                      │                             │    │
│  │                      │ ━━━━━━━ 3.5 km             │    │
│  │                      │    ✅ Dalam jangkauan       │    │
│  │                      │                             │    │
│  │                    🔴 (User)                       │    │
│  │                   ⭕ (Accuracy)                    │    │
│  │                                                     │    │
│  │  ┌──────────────┐                                  │    │
│  │  │ 🎯 Akurasi:  │                                  │    │
│  │  │    25m       │                                  │    │
│  │  └──────────────┘                                  │    │
│  └────────────────────────────────────────────────────┘    │
│                                                              │
│  ℹ️ Tips: Geser pin merah untuk menyesuaikan lokasi        │
│                                                              │
│  🏷️ Label Alamat:                                          │
│  [🏠 Rumah] [💼 Kantor] [🛏️ Kos] [📍 Lainnya]            │
│                                                              │
│  📍 Alamat dari GPS:                                        │
│  Jl. Merdeka No. 123, Bogor Barat, Bogor                   │
│                                                              │
│  📝 Detail Alamat:                                          │
│  ┌─────────────────────────────────────────────────────┐   │
│  │ Dekat Indomaret, rumah cat hijau                   │   │
│  └─────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
```

---

## 🎯 Map States

### State 1: Initial Load

```
┌────────────────────────────────────────┐
│  🗺️ MAP                               │
│                                        │
│              🔵 Toko                  │
│              (Center)                  │
│                                        │
│              🔴 Pin                   │
│           (Same as toko)               │
│                                        │
│  Zoom: 15                              │
│  Status: Waiting for GPS               │
└────────────────────────────────────────┘

Button: [🎯 Deteksi Lokasi]
```

---

### State 2: GPS Detecting

```
┌────────────────────────────────────────┐
│  🗺️ MAP                               │
│                                        │
│              🔵 Toko                  │
│                                        │
│              🔴 Pin                   │
│           (Animating...)               │
│                                        │
│  Status: Detecting GPS...              │
└────────────────────────────────────────┘

Button: [⏳ Mendeteksi...]
```

---

### State 3: GPS Detected (Success)

```
┌────────────────────────────────────────┐
│  🗺️ MAP                               │
│  ┌──────────┐                          │
│  │🔴 Lokasi │                          │
│  │🔵 Toko   │                          │
│  └──────────┘                          │
│                                        │
│         🔵 Toko                        │
│          │                             │
│          │ ━━━━━ 3.5 km               │
│          │   ✅ OK                     │
│          │                             │
│         🔴 User                        │
│        ⭕ 25m                          │
│                                        │
│  ┌──────────┐                          │
│  │🎯 25m    │                          │
│  └──────────┘                          │
│                                        │
│  Zoom: 18 (Detail)                     │
└────────────────────────────────────────┘

Button: [✅ Lokasi Terdeteksi!]
Address: Auto-filled ✅
Shipping: Calculated ✅
```

---

### State 4: User Dragging Pin

```
┌────────────────────────────────────────┐
│  🗺️ MAP                               │
│                                        │
│         🔵 Toko                        │
│          │                             │
│          │ ━━━━━ 4.2 km               │
│          │   ✅ OK                     │
│          │                             │
│         🔴 User                        │
│        (Dragging...)                   │
│        ⭕ 50m                          │
│                                        │
│  Status: Updating address...           │
└────────────────────────────────────────┘

Address: Updating... ⏳
Shipping: Recalculating... ⏳
```

---

### State 5: Out of Range

```
┌────────────────────────────────────────┐
│  🗺️ MAP                               │
│                                        │
│         🔵 Toko                        │
│          │                             │
│          │ ━━━━━━━━━━━━━ 18.5 km     │
│          │   ⚠️ Terlalu jauh          │
│          │                             │
│         🔴 User                        │
│        ⭕ 30m                          │
│                                        │
│  Status: Out of range!                 │
└────────────────────────────────────────┘

Shipping: ⚠️ Diluar jangkauan
Distance: 18.5 km (maks 15 km)
```

---

## 📱 Mobile View

```
┌─────────────────────────┐
│  🍞 Toko Roti          │
│                         │
│  👤 Detail Penerima    │
│  ┌───────────────────┐ │
│  │ 👤 Nama           │ │
│  │ 📱 Phone          │ │
│  └───────────────────┘ │
│                         │
│  📍 Lokasi Pengiriman  │
│  [🎯 Deteksi Lokasi]  │
│                         │
│  ┌───────────────────┐ │
│  │  🗺️ MAP          │ │
│  │                   │ │
│  │      🔵          │ │
│  │       │          │ │
│  │       │━━━ 3km   │ │
│  │       │          │ │
│  │      🔴          │ │
│  │     ⭕           │ │
│  │                   │ │
│  │  🎯 25m          │ │
│  └───────────────────┘ │
│                         │
│  ℹ️ Geser pin         │
│                         │
│  🏷️ [🏠][💼][🛏️]    │
│                         │
│  📍 Alamat:            │
│  Jl. Merdeka...        │
│                         │
│  📝 Detail:            │
│  ┌───────────────────┐ │
│  │ Dekat Indomaret   │ │
│  └───────────────────┘ │
└─────────────────────────┘
```

---

## 🎨 Color Coding

### Map Elements

```
🔴 Red Pin    = User location (draggable)
🔵 Blue Pin   = Store location (fixed)
⭕ Red Circle = GPS accuracy radius
━━━ Green Line = Distance (in range)
━━━ Red Line   = Distance (out of range)
```

---

### Status Colors

```
✅ Green  = Success / In range
⚠️ Orange = Warning
❌ Red    = Error / Out of range
🔵 Blue   = Info
⏳ Gray   = Loading
```

---

## 🎬 Animation Sequence

### GPS Detection Flow

```
1. User clicks "Deteksi Lokasi"
   Button: 🎯 → ⏳

2. Browser requests permission
   Popup: "Allow location access?"

3. GPS acquiring...
   Map: No change
   Button: ⏳ Mendeteksi...

4. GPS acquired!
   Map: Zoom to location (15 → 18)
   Pin: Drop animation + Bounce
   Circle: Fade in
   Line: Draw from store to user
   Button: ⏳ → ✅

5. Reverse geocoding...
   Address fields: Filling...

6. Complete!
   Button: ✅ → 🎯 (after 3s)
   All fields: Filled ✅
```

---

### Manual Pin Drag Flow

```
1. User grabs red pin
   Cursor: 👆 → ✊

2. User drags pin
   Pin: Moving...
   Line: Updating...
   Distance: Updating...

3. User releases pin
   Pin: Drop
   Circle: Update
   Address: Updating...
   Shipping: Recalculating...

4. Complete!
   Address: Updated ✅
   Shipping: Updated ✅
```

---

## 🔍 Zoom Levels

### Zoom 15 (Default)

```
┌────────────────────────┐
│                        │
│    🏙️ City View       │
│                        │
│    🔵 ━━━━━ 🔴       │
│                        │
│    Can see:            │
│    - Multiple streets  │
│    - Neighborhoods     │
│    - Major landmarks   │
└────────────────────────┘
```

---

### Zoom 18 (GPS Detected)

```
┌────────────────────────┐
│                        │
│    🏘️ Street View     │
│                        │
│    🔵                 │
│     │                  │
│     │━━━ 3.5km         │
│     │                  │
│    🔴                 │
│   ⭕                  │
│                        │
│    Can see:            │
│    - Individual houses │
│    - Street names      │
│    - Building details  │
└────────────────────────┘
```

---

### Zoom 20 (Maximum Detail)

```
┌────────────────────────┐
│                        │
│    🏠 House Level      │
│                        │
│       🔴              │
│      ⭕               │
│                        │
│    Can see:            │
│    - House numbers     │
│    - Driveways         │
│    - Trees             │
│    - Exact location    │
└────────────────────────┘
```

---

## 💡 User Interaction Examples

### Example 1: Perfect GPS

```
User: *clicks "Deteksi Lokasi"*
System: *detects GPS*
Map: *zooms to exact house*
Pin: *right on the house*
Accuracy: 5m ✅
User: "Perfect! Submit order"
```

---

### Example 2: GPS Slightly Off

```
User: *clicks "Deteksi Lokasi"*
System: *detects GPS*
Map: *zooms to street*
Pin: *50m away from house*
Accuracy: 50m ⚠️
User: *drags pin to exact house*
System: *updates address*
User: "Now it's correct! Submit"
```

---

### Example 3: Manual Entry

```
User: *doesn't click GPS*
User: *clicks directly on map*
Pin: *moves to clicked location*
System: *gets address*
User: *adjusts pin by dragging*
System: *updates*
User: "Good! Submit"
```

---

### Example 4: Out of Range

```
User: *clicks "Deteksi Lokasi"*
System: *detects GPS*
Map: *shows user is 20km away*
Line: Red ━━━━━━━━━━━━━
Distance: 20km ⚠️
Shipping: "Diluar jangkauan"
User: "Oh no, too far!"
```

---

## 🎯 Best Practices

### For Accurate Location:

1. **Use GPS first**
   - Click "Deteksi Lokasi"
   - Wait for GPS to acquire

2. **Verify visually**
   - Check if pin is on your house
   - Use Street View if needed

3. **Adjust if needed**
   - Drag pin to exact location
   - Zoom in for precision

4. **Check distance**
   - Make sure green line
   - Within max distance

5. **Fill details**
   - Add house number
   - Add landmarks

---

## 📊 Success Indicators

### All Good ✅

```
✅ Pin on exact location
✅ Accuracy < 50m
✅ Distance line green
✅ Within max distance
✅ Address auto-filled
✅ Shipping calculated
```

### Needs Attention ⚠️

```
⚠️ Accuracy > 50m
⚠️ Pin not on house
⚠️ Address incomplete
→ Adjust pin manually
→ Fill missing details
```

### Error ❌

```
❌ GPS permission denied
❌ Out of range
❌ No address found
→ Try again
→ Contact support
```

---

**Map visual demo complete!** 🎉

User sekarang bisa:
- ✅ Lihat map dengan jelas
- ✅ Understand visual indicators
- ✅ Know how to interact
- ✅ Verify location accuracy
- ✅ Adjust if needed

**Last Updated:** 3 Mei 2026
