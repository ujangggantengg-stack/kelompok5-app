/**
 * Checkout Modern Enhanced - GPS + Map Picker + Auto-fill
 * Seperti Shopee/GoFood dengan fitur lengkap
 */

// KONFIGURASI TOKO - GANTI DENGAN KOORDINAT TOKO SEBENARNYA!
const STORE_LAT = -6.5971469; // Latitude toko (contoh: Bogor)
const STORE_LNG = 106.8060394; // Longitude toko (contoh: Bogor)

// KONFIGURASI ONGKIR - SESUAIKAN DENGAN HARGA GRAB/GOFOOD LOKAL
const BASE_RATE = 5000; // Biaya dasar (Rp)
const PER_KM_RATE = 2000; // Biaya per kilometer (Rp)
const MAX_DISTANCE = 15; // Jarak maksimal pengiriman (km)

// State
let map;
let marker;
let currentLat = null;
let currentLng = null;

/**
 * Initialize Google Maps
 */
let storeMarker; // Marker untuk toko
let accuracyCircle; // Circle untuk accuracy

function initMap() {
    // Default center (store location)
    const defaultCenter = { lat: STORE_LAT, lng: STORE_LNG };
    
    // Create map
    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultCenter,
        zoom: 15,
        mapTypeControl: true,
        mapTypeControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        },
        fullscreenControl: true,
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        styles: [
            {
                featureType: 'poi',
                elementType: 'labels',
                stylers: [{ visibility: 'on' }]
            }
        ]
    });
    
    // Create store marker (blue)
    storeMarker = new google.maps.Marker({
        position: defaultCenter,
        map: map,
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 10,
            fillColor: '#3B82F6',
            fillOpacity: 1,
            strokeColor: '#FFFFFF',
            strokeWeight: 3
        },
        title: 'Lokasi Toko Roti',
        zIndex: 1
    });
    
    // Info window for store
    const storeInfoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 8px;">
                <h3 style="font-weight: bold; margin-bottom: 4px; color: #1f2937;">🏪 Toko Roti</h3>
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Lokasi toko kami</p>
            </div>
        `
    });
    
    storeMarker.addListener('click', function() {
        storeInfoWindow.open(map, storeMarker);
    });
    
    // Create draggable customer marker (red)
    marker = new google.maps.Marker({
        position: defaultCenter,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 12,
            fillColor: '#EF4444',
            fillOpacity: 1,
            strokeColor: '#FFFFFF',
            strokeWeight: 3
        },
        title: 'Geser pin ini ke lokasi Anda',
        zIndex: 2
    });
    
    // Info window for customer marker
    const customerInfoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 8px;">
                <h3 style="font-weight: bold; margin-bottom: 4px; color: #1f2937;">📍 Lokasi Anda</h3>
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Geser pin untuk menyesuaikan</p>
            </div>
        `
    });
    
    marker.addListener('click', function() {
        customerInfoWindow.open(map, marker);
    });
    
    // Listen to marker drag end
    marker.addListener('dragend', function() {
        const position = marker.getPosition();
        currentLat = position.lat();
        currentLng = position.lng();
        
        // Update hidden inputs
        document.getElementById('latitude').value = currentLat;
        document.getElementById('longitude').value = currentLng;
        
        // Reverse geocode
        reverseGeocode(currentLat, currentLng);
        
        // Calculate shipping
        calculateShipping(currentLat, currentLng);
        
        // Update accuracy circle
        updateAccuracyCircle(currentLat, currentLng, 50); // 50m default accuracy
    });
    
    // Listen to map click
    map.addListener('click', function(event) {
        const position = event.latLng;
        marker.setPosition(position);
        marker.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout(() => marker.setAnimation(null), 750);
        
        currentLat = position.lat();
        currentLng = position.lng();
        
        document.getElementById('latitude').value = currentLat;
        document.getElementById('longitude').value = currentLng;
        
        reverseGeocode(currentLat, currentLng);
        calculateShipping(currentLat, currentLng);
        updateAccuracyCircle(currentLat, currentLng, 50);
    });
}

/**
 * Update Accuracy Circle
 */
function updateAccuracyCircle(lat, lng, accuracy) {
    // Remove old circle
    if (accuracyCircle) {
        accuracyCircle.setMap(null);
    }
    
    // Create new circle
    accuracyCircle = new google.maps.Circle({
        map: map,
        center: { lat: lat, lng: lng },
        radius: accuracy, // in meters
        fillColor: '#EF4444',
        fillOpacity: 0.15,
        strokeColor: '#EF4444',
        strokeOpacity: 0.4,
        strokeWeight: 1
    });
    
    // Show accuracy indicator
    const indicator = document.getElementById('accuracyIndicator');
    const accuracyValue = document.getElementById('accuracyValue');
    
    if (indicator && accuracyValue) {
        accuracyValue.textContent = Math.round(accuracy);
        indicator.classList.remove('hidden');
    }
}

/**
 * Detect Location with GPS
 */
document.getElementById('detectLocationBtn')?.addEventListener('click', function() {
    const btn = this;
    const originalHTML = btn.innerHTML;
    
    btn.innerHTML = '<div class="loading-spinner"></div><span class="ml-2">Mendeteksi...</span>';
    btn.disabled = true;
    
    if (!navigator.geolocation) {
        alert('Browser Anda tidak mendukung GPS');
        btn.innerHTML = originalHTML;
        btn.disabled = false;
        return;
    }
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;
            const accuracy = position.coords.accuracy; // GPS accuracy in meters
            
            // Update map
            const newPosition = { lat: currentLat, lng: currentLng };
            map.setCenter(newPosition);
            map.setZoom(18); // Zoom in untuk detail
            marker.setPosition(newPosition);
            marker.setAnimation(google.maps.Animation.BOUNCE);
            setTimeout(() => marker.setAnimation(null), 1500);
            
            // Update hidden inputs
            document.getElementById('latitude').value = currentLat;
            document.getElementById('longitude').value = currentLng;
            
            // Show accuracy circle
            updateAccuracyCircle(currentLat, currentLng, accuracy);
            
            // Reverse geocode
            reverseGeocode(currentLat, currentLng);
            
            // Calculate shipping
            calculateShipping(currentLat, currentLng);
            
            // Success feedback
            btn.innerHTML = '<i class="fas fa-check-circle"></i><span class="ml-2">Lokasi Terdeteksi!</span>';
            btn.classList.add('bg-green-500', 'hover:bg-green-600');
            btn.classList.remove('bg-orange-500', 'hover:bg-orange-600');
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-green-500', 'hover:bg-green-600');
                btn.classList.add('bg-gradient-to-r', 'from-orange-500', 'to-orange-600');
                btn.disabled = false;
            }, 3000);
        },
        function(error) {
            console.error('GPS error:', error);
            let message = 'Gagal mendeteksi lokasi. ';
            
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    message += 'Izinkan akses lokasi di browser Anda.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    message += 'Lokasi tidak tersedia.';
                    break;
                case error.TIMEOUT:
                    message += 'Waktu habis. Coba lagi.';
                    break;
                default:
                    message += 'Terjadi kesalahan.';
            }
            
            alert(message);
            btn.innerHTML = originalHTML;
            btn.disabled = false;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
});

/**
 * Reverse Geocode - Get address from coordinates
 */
function reverseGeocode(lat, lng) {
    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: lat, lng: lng };
    
    geocoder.geocode({ location: latlng }, function(results, status) {
        if (status === 'OK' && results[0]) {
            const result = results[0];
            const components = result.address_components;
            
            // Parse address components
            let street = '';
            let city = '';
            let district = '';
            let province = '';
            let postalCode = '';
            
            components.forEach(component => {
                const types = component.types;
                
                if (types.includes('route') || types.includes('street_address')) {
                    street = component.long_name;
                } else if (types.includes('administrative_area_level_2')) {
                    city = component.long_name;
                } else if (types.includes('administrative_area_level_3')) {
                    district = component.long_name;
                } else if (types.includes('administrative_area_level_1')) {
                    province = component.long_name;
                } else if (types.includes('postal_code')) {
                    postalCode = component.long_name;
                }
            });
            
            // Auto-fill form
            document.getElementById('full_address').value = result.formatted_address;
            
            if (city) {
                document.getElementById('city').value = city;
                triggerFloatingLabel('city');
            }
            
            if (district) {
                document.getElementById('district').value = district;
                triggerFloatingLabel('district');
            }
            
            if (province) {
                document.getElementById('province').value = province;
                triggerFloatingLabel('province');
            }
            
            if (postalCode) {
                document.getElementById('postal_code').value = postalCode;
                triggerFloatingLabel('postal_code');
            }
            
            // Focus on detail address for user to complete
            setTimeout(() => {
                document.getElementById('address_detail').focus();
            }, 500);
        }
    });
}

/**
 * Calculate Distance using Haversine Formula
 */
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Earth radius in km
    const dLat = toRad(lat2 - lat1);
    const dLon = toRad(lon2 - lon1);
    
    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
              Math.sin(dLon/2) * Math.sin(dLon/2);
    
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    const distance = R * c;
    
    return distance;
}

function toRad(degrees) {
    return degrees * (Math.PI / 180);
}

/**
 * Calculate Shipping Cost
 */
function calculateShipping(lat, lng) {
    const distance = calculateDistance(STORE_LAT, STORE_LNG, lat, lng);
    
    // Update distance line on map
    updateDistanceLine(lat, lng, distance);
    
    // Check max distance
    if (distance > MAX_DISTANCE) {
        document.getElementById('shipping_cost').innerHTML = 
            '<span class="text-red-500">Diluar jangkauan</span>';
        document.getElementById('distance').textContent = 
            `${distance.toFixed(1)} km (maks ${MAX_DISTANCE} km)`;
        return;
    }
    
    // Calculate cost
    const shippingCost = BASE_RATE + Math.ceil(distance * PER_KM_RATE);
    
    // Format currency
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(shippingCost);
    
    // Update display
    document.getElementById('shipping_cost').textContent = formatted;
    document.getElementById('distance').textContent = `${distance.toFixed(1)} km`;
    
    // Update total
    updateTotal(shippingCost);
}

/**
 * Update Distance Line on Map
 */
let distanceLine;
let distanceInfoWindow;

function updateDistanceLine(customerLat, customerLng, distance) {
    // Remove old line
    if (distanceLine) {
        distanceLine.setMap(null);
    }
    
    // Create new line
    const lineCoordinates = [
        { lat: STORE_LAT, lng: STORE_LNG },
        { lat: customerLat, lng: customerLng }
    ];
    
    distanceLine = new google.maps.Polyline({
        path: lineCoordinates,
        geodesic: true,
        strokeColor: distance > MAX_DISTANCE ? '#EF4444' : '#10B981',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        map: map
    });
    
    // Add distance label in the middle
    const midLat = (STORE_LAT + customerLat) / 2;
    const midLng = (STORE_LNG + customerLng) / 2;
    
    if (distanceInfoWindow) {
        distanceInfoWindow.close();
    }
    
    distanceInfoWindow = new google.maps.InfoWindow({
        position: { lat: midLat, lng: midLng },
        content: `
            <div style="padding: 8px; text-align: center;">
                <div style="font-weight: bold; font-size: 16px; color: ${distance > MAX_DISTANCE ? '#EF4444' : '#10B981'};">
                    ${distance.toFixed(1)} km
                </div>
                <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">
                    ${distance > MAX_DISTANCE ? '⚠️ Terlalu jauh' : '✅ Dalam jangkauan'}
                </div>
            </div>
        `
    });
    
    distanceInfoWindow.open(map);
}

/**
 * Update Total Price
 */
function updateTotal(shippingCost) {
    const subtotalText = document.getElementById('subtotal').textContent;
    const subtotal = parseInt(subtotalText.replace(/[^0-9]/g, ''));
    const total = subtotal + shippingCost;
    
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(total);
    
    document.getElementById('total').textContent = formatted;
}

/**
 * Initialize Address Chips (Label Alamat)
 */
function initAddressChips() {
    const chips = document.querySelectorAll('.address-chip');
    const hiddenInput = document.getElementById('address_label');
    
    // Set default active
    chips[0]?.classList.add('active');
    
    chips.forEach(chip => {
        chip.addEventListener('click', function() {
            // Remove active from all
            chips.forEach(c => c.classList.remove('active'));
            
            // Add active to clicked
            this.classList.add('active');
            
            // Update hidden input
            hiddenInput.value = this.dataset.label;
        });
    });
}

/**
 * Initialize Floating Labels
 */
function initFloatingLabels() {
    const floatingInputs = document.querySelectorAll('.floating-label input, .floating-label textarea, .floating-label select');
    
    floatingInputs.forEach(input => {
        // Check on load
        if (input.value) {
            input.closest('.floating-label').classList.add('has-value');
        }
        
        // Check on input
        input.addEventListener('input', function() {
            if (this.value) {
                this.closest('.floating-label').classList.add('has-value');
            } else {
                this.closest('.floating-label').classList.remove('has-value');
            }
        });
        
        // Check on blur
        input.addEventListener('blur', function() {
            if (this.value) {
                this.closest('.floating-label').classList.add('has-value');
            } else {
                this.closest('.floating-label').classList.remove('has-value');
            }
        });
    });
}

/**
 * Trigger Floating Label (for programmatic value changes)
 */
function triggerFloatingLabel(inputId) {
    const input = document.getElementById(inputId);
    if (input && input.value) {
        input.closest('.floating-label')?.classList.add('has-value');
    }
}

/**
 * Form Validation
 */
document.getElementById('checkoutForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check if location is detected
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;
    
    if (!lat || !lng) {
        alert('Silakan deteksi lokasi Anda terlebih dahulu!');
        document.getElementById('detectLocationBtn').scrollIntoView({ behavior: 'smooth' });
        return false;
    }
    
    // Check distance
    const distance = calculateDistance(STORE_LAT, STORE_LNG, parseFloat(lat), parseFloat(lng));
    if (distance > MAX_DISTANCE) {
        alert(`Maaf, lokasi Anda terlalu jauh (${distance.toFixed(1)} km). Maksimal jarak pengiriman adalah ${MAX_DISTANCE} km.`);
        return false;
    }
    
    // Check required fields
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('border-red-500');
            field.focus();
        } else {
            field.classList.remove('border-red-500');
        }
    });
    
    if (!isValid) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }
    
    // Show loading
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<div class="loading-spinner inline-block mr-2"></div>Memproses...';
    
    // Submit form
    this.submit();
});

/**
 * Phone Number Formatting
 */
document.getElementById('phone')?.addEventListener('input', function(e) {
    // Remove non-numeric characters
    let value = this.value.replace(/\D/g, '');
    
    // Limit to 13 digits
    if (value.length > 13) {
        value = value.slice(0, 13);
    }
    
    this.value = value;
});

/**
 * Initialize on page load
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Checkout Modern Enhanced loaded');
    console.log('Store location:', STORE_LAT, STORE_LNG);
    console.log('Shipping config:', { BASE_RATE, PER_KM_RATE, MAX_DISTANCE });
    
    // Note: initMap() will be called automatically by Google Maps API
    // initAddressChips() and initFloatingLabels() are called from HTML
});
