# 🗺️ Map Features Guide - Visual Location Picker

> **Interactive map dengan visual indicators untuk memastikan lokasi akurat!**

---

## ✨ Fitur Map

### 1. 🗺️ Interactive Map Display

**Tampilan:**
- Map muncul langsung di halaman checkout
- Ukuran: 400px (desktop), 300px (mobile)
- Rounded corners dengan shadow
- Zoom controls, Street View, Fullscreen

**Fungsi:**
- User bisa lihat lokasi mereka secara visual
- Memastikan pin tepat di rumah/lokasi yang benar
- Zoom in/out untuk detail

---

### 2. 📍 Dual Markers

**Pin Merah (Lokasi User):**
- Draggable (bisa digeser)
- Bounce animation saat diklik/dideteksi
- Tooltip: "Lokasi Anda"
- Ukuran: 12px

**Pin Biru (Lokasi Toko):**
- Static (tidak bisa digeser)
- Tooltip: "Lokasi Toko Roti"
- Ukuran: 10px

**Visual:**
```
🔴 Pin Merah = Lokasi User (bisa digeser)
🔵 Pin Biru = Lokasi Toko (fixed)
```

---

### 3. 🎯 Accuracy Circle

**Fitur:**
- Circle merah transparan di sekitar pin user
- Radius = GPS accuracy (dalam meter)
- Semakin kecil circle = semakin akurat

**Indicator:**
- Badge di pojok kiri bawah map
- Menampilkan: "Akurasi: 50m"
- Icon: 🎯

**Contoh:**
```
Akurasi GPS bagus: 5-20 meter
Akurasi GPS sedang: 20-50 meter
Akurasi GPS buruk: >50 meter
```

---

### 4. 📏 Distance Line

**Fitur:**
- Garis dari toko ke lokasi user
- Warna hijau: dalam jangkauan
- Warna merah: diluar jangkauan
- Label jarak di tengah garis

**Info Window:**
```
✅ 3.5 km
   Dalam jangkauan

atau

⚠️ 18.2 km
   Terlalu jauh
```

---

### 5. 🏷️ Map Legend

**Posisi:** Pojok kiri atas map

**Isi:**
```
🔴 Pin Lokasi Anda
🔵 Lokasi Toko
```

**Fungsi:**
- Membantu user memahami marker
- Selalu visible di atas map

---

## 🎮 Cara Pakai

### Method 1: GPS Auto-detect

1. **Klik "Deteksi Lokasi"**
   - Browser minta permission
   - Izinkan akses lokasi

2. **Map Auto-update:**
   - Zoom ke lokasi user (zoom 18)
   - Pin merah pindah ke lokasi user
   - Pin bounce animation
   - Accuracy circle muncul
   - Distance line muncul
   - Alamat auto-fill

3. **Verify:**
   - Cek apakah pin tepat di rumah
   - Jika tidak, geser pin ke lokasi yang benar

---

### Method 2: Manual Drag Pin

1. **Geser Pin Merah:**
   - Klik dan tahan pin merah
   - Drag ke lokasi yang benar
   - Lepas mouse

2. **Auto-update:**
   - Alamat update otomatis
   - Distance line update
   - Ongkir recalculate

---

### Method 3: Click on Map

1. **Klik di Map:**
   - Klik langsung di lokasi yang diinginkan
   - Pin merah pindah ke sana
   - Bounce animation

2. **Auto-update:**
   - Sama seperti drag pin

---

## 🎨 Visual Indicators

### Status Colors

**Hijau (✅):**
- Distance line hijau
- "Dalam jangkauan"
- Ongkir bisa dihitung

**Merah (⚠️):**
- Distance line merah
- "Terlalu jauh"
- Diluar jangkauan pengiriman

---

### Animations

**Bounce Animation:**
- Saat GPS detect
- Saat klik map
- Duration: 1.5 detik

**Drop Animation:**
- Saat page load
- Pin "jatuh" dari atas

**Smooth Transitions:**
- Zoom in/out
- Pan map
- Marker movement

---

## 📱 Responsive Design

### Desktop (>1024px)

```
Map Height: 400px
Controls: Full (zoom, street view, fullscreen)
Legend: Visible
Accuracy: Visible
```

### Mobile (<768px)

```
Map Height: 300px
Controls: Minimal (zoom only)
Legend: Visible
Accuracy: Visible
Touch: Optimized
```

---

## 🔧 Technical Details

### Map Configuration

```javascript
{
  center: { lat: STORE_LAT, lng: STORE_LNG },
  zoom: 15,
  mapTypeControl: true,
  streetViewControl: true,
  fullscreenControl: true,
  zoomControl: true
}
```

---

### Markers

**Customer Marker (Red):**
```javascript
{
  position: { lat, lng },
  draggable: true,
  animation: google.maps.Animation.DROP,
  icon: {
    path: google.maps.SymbolPath.CIRCLE,
    scale: 12,
    fillColor: '#EF4444',
    fillOpacity: 1,
    strokeColor: '#FFFFFF',
    strokeWeight: 3
  }
}
```

**Store Marker (Blue):**
```javascript
{
  position: { lat: STORE_LAT, lng: STORE_LNG },
  draggable: false,
  icon: {
    path: google.maps.SymbolPath.CIRCLE,
    scale: 10,
    fillColor: '#3B82F6',
    fillOpacity: 1,
    strokeColor: '#FFFFFF',
    strokeWeight: 3
  }
}
```

---

### Accuracy Circle

```javascript
{
  center: { lat, lng },
  radius: accuracy, // in meters
  fillColor: '#EF4444',
  fillOpacity: 0.15,
  strokeColor: '#EF4444',
  strokeOpacity: 0.4,
  strokeWeight: 1
}
```

---

### Distance Line

```javascript
{
  path: [
    { lat: STORE_LAT, lng: STORE_LNG },
    { lat: customerLat, lng: customerLng }
  ],
  geodesic: true,
  strokeColor: distance > MAX_DISTANCE ? '#EF4444' : '#10B981',
  strokeOpacity: 0.8,
  strokeWeight: 3
}
```

---

## 🎯 User Experience

### Visual Feedback

**Loading State:**
```
Button: "⏳ Mendeteksi..."
Map: No change
```

**Success State:**
```
Button: "✅ Lokasi Terdeteksi!"
Map: Zoom to location, bounce animation
Pin: Move to location
Circle: Show accuracy
Line: Show distance
```

**Error State:**
```
Button: Back to normal
Alert: Error message
Map: No change
```

---

### Tooltips

**Hover Pin Merah:**
```
"Geser pin ini ke lokasi Anda"
```

**Hover Pin Biru:**
```
"Lokasi Toko Roti"
```

**Click Pin:**
```
Info window dengan detail
```

---

## 💡 Tips untuk User

### Untuk Akurasi Maksimal:

1. **Enable GPS di device:**
   - Settings → Location → On

2. **Gunakan di outdoor:**
   - GPS lebih akurat di luar ruangan

3. **Zoom in sebelum adjust:**
   - Zoom level 18-20 untuk detail

4. **Verify dengan Street View:**
   - Klik Street View icon
   - Lihat foto lokasi

5. **Geser pin jika perlu:**
   - Jangan ragu adjust manual

---

### Untuk Akurasi Terbaik:

**✅ DO:**
- Gunakan GPS di outdoor
- Zoom in untuk detail
- Verify dengan Street View
- Adjust pin manual jika perlu
- Isi detail alamat lengkap

**❌ DON'T:**
- Gunakan GPS di dalam gedung
- Terlalu cepat klik submit
- Skip verify lokasi
- Abaikan accuracy indicator

---

## 🐛 Troubleshooting

### Map Tidak Muncul

**Symptoms:**
- Area map kosong/abu-abu

**Solutions:**
1. Check API key valid
2. Check APIs enabled
3. Check console errors (F12)
4. Refresh page

---

### Pin Tidak Bisa Digeser

**Symptoms:**
- Pin stuck, tidak bisa drag

**Solutions:**
1. Refresh page
2. Check JavaScript errors
3. Try different browser

---

### Accuracy Circle Tidak Muncul

**Symptoms:**
- No circle around pin

**Solutions:**
1. GPS accuracy might be very good (<5m)
2. Check if GPS permission granted
3. Try outdoor for better GPS

---

### Distance Line Tidak Muncul

**Symptoms:**
- No line between pins

**Solutions:**
1. Detect location first
2. Check if coordinates valid
3. Refresh page

---

## 📊 Performance

### Load Time

```
Map Load: ~1-2 seconds
GPS Detect: ~2-5 seconds
Geocoding: ~0.5-1 second
Total: ~4-8 seconds
```

---

### API Calls

**Per Checkout:**
```
Maps JavaScript API: 1 call (map load)
Geocoding API: 1-3 calls (reverse geocode)
Total: 2-4 calls
```

**Cost Estimate:**
```
Free tier: $200/month credit
~28,000 map loads/month free
~40,000 geocoding calls/month free
```

---

## 🎉 Benefits

### For Users:

✅ Visual confirmation lokasi benar  
✅ Bisa adjust pin manual  
✅ Lihat jarak ke toko  
✅ Tahu apakah dalam jangkauan  
✅ Akurasi tinggi (sampai level gang)  
✅ User-friendly & intuitive  

### For Business:

✅ Reduce wrong address  
✅ Accurate shipping cost  
✅ Better customer experience  
✅ Professional appearance  
✅ Competitive advantage  

---

## 🚀 Next Steps

### Immediate:

1. ✅ Setup Google Maps API key
2. ✅ Test GPS detection
3. ✅ Verify map display
4. ✅ Test on mobile

### Future Enhancements:

- [ ] Save favorite locations
- [ ] Multiple delivery addresses
- [ ] Route preview to store
- [ ] Estimated delivery time
- [ ] Real-time driver tracking

---

**Map features sekarang sudah production-ready!** 🎉

User bisa:
- ✅ Lihat map langsung di checkout
- ✅ Verify lokasi secara visual
- ✅ Geser pin untuk adjust
- ✅ Lihat jarak ke toko
- ✅ Lihat accuracy GPS
- ✅ Memastikan dalam jangkauan

**Last Updated:** 3 Mei 2026  
**Version:** 2.0.0
