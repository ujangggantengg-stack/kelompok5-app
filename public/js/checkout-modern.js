/**
 * Checkout Modern - GPS Detection & Shipping Calculator
 * Akurasi tinggi sampai level gang seperti Grab/GoFood
 */

// KONFIGURASI TOKO - GANTI DENGAN KOORDINAT TOKO SEBENARNYA!
const STORE_LAT = -6.5971469; // Latitude toko (contoh: Bogor)
const STORE_LNG = 106.8060394; // Longitude toko (contoh: Bogor)

// KONFIGURASI ONGKIR - SESUAIKAN DENGAN HARGA GRAB/GOFOOD LOKAL
const BASE_RATE = 5000; // Biaya dasar (Rp)
const PER_KM_RATE = 2000; // Biaya per kilometer (Rp)
const MAX_DISTANCE = 15; // Jarak maksimal pengiriman (km)

// State
let currentLat = null;
let currentLng = null;
let searchTimeout = null;

/**
 * Deteksi lokasi GPS dengan akurasi SANGAT TINGGI (zoom 18)
 * Bisa detect sampai level gang/jalan kecil seperti Grab
 */
function detectLocation() {
    const btn = event.target.closest('button');
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<span>⏳</span> Mendeteksi...';
    btn.disabled = true;

    if (!navigator.geolocation) {
        alert('Browser Anda tidak mendukung GPS');
        btn.innerHTML = originalHTML;
        btn.disabled = false;
        return;
    }

    // Request GPS dengan akurasi MAKSIMAL
    navigator.geolocation.getCurrentPosition(
        async (position) => {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;
            
            // Simpan koordinat ke hidden input
            document.getElementById('customerLat').value = currentLat;
            document.getElementById('customerLng').value = currentLng;

            // Reverse geocoding dengan zoom 18 untuk akurasi tinggi
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?` +
                    `format=json&lat=${currentLat}&lon=${currentLng}&zoom=18&addressdetails=1`,
                    {
                        headers: {
                            'Accept-Language': 'id'
                        }
                    }
                );
                
                const data = await response.json();
                
                if (data && data.address) {
                    // Extract detail alamat dengan prioritas tinggi ke rendah
                    const addr = data.address;
                    
                    // Jalan/Gang (prioritas tertinggi)
                    const road = addr.road || addr.pedestrian || addr.path || 
                                addr.footway || addr.cycleway || addr.residential || '';
                    
                    // Kelurahan/Desa
                    const village = addr.village || addr.suburb || addr.neighbourhood || 
                                   addr.quarter || addr.hamlet || '';
                    
                    // Kecamatan
                    const district = addr.city_district || addr.district || 
                                    addr.municipality || addr.county || '';
                    
                    // Kota
                    const city = addr.city || addr.town || addr.city_district || 
                                addr.state_district || 'Bogor';
                    
                    // Provinsi
                    const state = addr.state || 'Jawa Barat';
                    
                    // Kode pos
                    const postcode = addr.postcode || '';

                    // Auto-fill form dengan detail lengkap
                    if (road) {
                        document.getElementById('streetInput').value = road;
                    }
                    
                    // Gabungkan kelurahan dan kecamatan untuk field city
                    let cityValue = '';
                    if (village && district) {
                        cityValue = `${village}, Kec. ${district}, ${city}`;
                    } else if (district) {
                        cityValue = `Kec. ${district}, ${city}`;
                    } else if (village) {
                        cityValue = `${village}, ${city}`;
                    } else {
                        cityValue = city;
                    }
                    
                    document.getElementById('cityInput').value = cityValue;
                    
                    // Update search box dengan alamat lengkap
                    const fullAddress = data.display_name || 
                        `${road}, ${village}, ${district}, ${city}`;
                    document.getElementById('addressSearch').value = fullAddress;

                    // Hitung ongkir otomatis
                    calculateShipping(currentLat, currentLng);
                    
                    btn.innerHTML = '<span>✅</span> Lokasi Terdeteksi';
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    }, 2000);
                } else {
                    throw new Error('Alamat tidak ditemukan');
                }
            } catch (error) {
                console.error('Geocoding error:', error);
                alert('Gagal mendapatkan alamat. Silakan isi manual.');
                btn.innerHTML = originalHTML;
                btn.disabled = false;
            }
        },
        (error) => {
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
            enableHighAccuracy: true, // Akurasi maksimal
            timeout: 10000, // 10 detik
            maximumAge: 0 // Selalu ambil posisi terbaru
        }
    );
}

/**
 * Hitung jarak menggunakan Haversine Formula
 * Hasil dalam kilometer
 */
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius bumi dalam km
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
 * Hitung ongkir berdasarkan jarak GPS
 * Formula: BASE_RATE + (distance * PER_KM_RATE)
 */
function calculateShipping(lat, lng) {
    const distance = calculateDistance(STORE_LAT, STORE_LNG, lat, lng);
    
    // Cek jarak maksimal
    if (distance > MAX_DISTANCE) {
        document.getElementById('shippingCostDisplay').textContent = 'Diluar jangkauan';
        document.getElementById('distanceDisplay').textContent = 
            `Jarak ${distance.toFixed(1)} km (maks ${MAX_DISTANCE} km)`;
        document.getElementById('shippingCostCard').style.background = 
            'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)';
        document.getElementById('shippingRegionHidden').value = '';
        return;
    }
    
    // Hitung biaya
    const shippingCost = BASE_RATE + Math.ceil(distance * PER_KM_RATE);
    
    // Format rupiah
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(shippingCost);
    
    // Update tampilan
    document.getElementById('shippingCostDisplay').textContent = formatted;
    document.getElementById('distanceDisplay').textContent = 
        `Jarak ${distance.toFixed(1)} km dari toko`;
    document.getElementById('shippingCostCard').style.background = 
        'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    
    // Simpan ke hidden input untuk dikirim ke server
    document.getElementById('shippingRegionHidden').value = shippingCost;
}

/**
 * Search alamat dengan autocomplete
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('addressSearch');
    const suggestionsDiv = document.getElementById('addressSuggestions');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length < 3) {
                suggestionsDiv.style.display = 'none';
                return;
            }
            
            searchTimeout = setTimeout(async () => {
                try {
                    const response = await fetch(
                        `https://nominatim.openstreetmap.org/search?` +
                        `format=json&q=${encodeURIComponent(query)}&` +
                        `countrycodes=id&limit=5&addressdetails=1`,
                        {
                            headers: {
                                'Accept-Language': 'id'
                            }
                        }
                    );
                    
                    const results = await response.json();
                    
                    if (results.length > 0) {
                        suggestionsDiv.innerHTML = results.map(result => `
                            <div style="padding: 0.75rem; border-bottom: 1px solid #f0f0f0; cursor: pointer; transition: background 0.2s;"
                                 onmouseover="this.style.background='#f8f8f8'"
                                 onmouseout="this.style.background='white'"
                                 onclick="selectAddress(${result.lat}, ${result.lon}, '${result.display_name.replace(/'/g, "\\'")}')">
                                <div style="font-weight: 600; font-size: 0.9rem; color: #333; margin-bottom: 0.25rem;">
                                    ${result.address?.road || result.address?.village || 'Alamat'}
                                </div>
                                <div style="font-size: 0.8rem; color: #666;">
                                    ${result.display_name}
                                </div>
                            </div>
                        `).join('');
                        suggestionsDiv.style.display = 'block';
                    } else {
                        suggestionsDiv.style.display = 'none';
                    }
                } catch (error) {
                    console.error('Search error:', error);
                    suggestionsDiv.style.display = 'none';
                }
            }, 500);
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.style.display = 'none';
            }
        });
    }
});

/**
 * Pilih alamat dari hasil pencarian
 */
function selectAddress(lat, lng, displayName) {
    currentLat = lat;
    currentLng = lng;
    
    document.getElementById('customerLat').value = lat;
    document.getElementById('customerLng').value = lng;
    document.getElementById('addressSearch').value = displayName;
    document.getElementById('addressSuggestions').style.display = 'none';
    
    // Parse dan isi form
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
        headers: { 'Accept-Language': 'id' }
    })
    .then(res => res.json())
    .then(data => {
        if (data && data.address) {
            const addr = data.address;
            const road = addr.road || addr.pedestrian || addr.path || '';
            const village = addr.village || addr.suburb || '';
            const district = addr.city_district || addr.district || '';
            const city = addr.city || addr.town || 'Bogor';
            
            if (road) document.getElementById('streetInput').value = road;
            
            let cityValue = '';
            if (village && district) {
                cityValue = `${village}, Kec. ${district}, ${city}`;
            } else if (district) {
                cityValue = `Kec. ${district}, ${city}`;
            } else {
                cityValue = city;
            }
            document.getElementById('cityInput').value = cityValue;
        }
    });
    
    // Hitung ongkir
    calculateShipping(lat, lng);
}

/**
 * Toggle address fields based on delivery method
 */
function toggleAddressFields(method) {
    const addressSection = document.getElementById('addressSection');
    const pickupSection = document.getElementById('pickupSection');
    const deliveryOptions = document.querySelectorAll('.delivery-option');
    
    deliveryOptions.forEach(option => {
        if (option.dataset.method === method) {
            option.style.borderColor = '#ee4d2d';
            option.style.background = '#fff5f5';
        } else {
            option.style.borderColor = '#e0e0e0';
            option.style.background = 'white';
        }
    });
    
    if (method === 'delivery') {
        addressSection.style.display = 'block';
        pickupSection.style.display = 'none';
        
        // Set required untuk delivery
        document.getElementById('streetInput').required = true;
        document.querySelector('[name="house_number"]').required = true;
        document.querySelector('[name="rt_rw"]').required = true;
        document.getElementById('cityInput').required = true;
    } else {
        addressSection.style.display = 'none';
        pickupSection.style.display = 'block';
        
        // Remove required untuk pickup
        document.getElementById('streetInput').required = false;
        document.querySelector('[name="house_number"]').required = false;
        document.querySelector('[name="rt_rw"]').required = false;
        document.getElementById('cityInput').required = false;
        
        // Reset shipping cost
        document.getElementById('shippingRegionHidden').value = '0';
    }
}

/**
 * Handle checkout form submission
 */
function handleCheckoutSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const shippingMethod = form.shipping_method.value;
    
    // Validasi untuk delivery
    if (shippingMethod === 'delivery') {
        const shippingCost = document.getElementById('shippingRegionHidden').value;
        
        if (!shippingCost || shippingCost === '' || shippingCost === '0') {
            alert('Silakan deteksi lokasi Anda terlebih dahulu untuk menghitung ongkir!');
            return false;
        }
        
        const lat = document.getElementById('customerLat').value;
        const lng = document.getElementById('customerLng').value;
        
        if (!lat || !lng) {
            alert('Koordinat GPS tidak valid. Silakan deteksi lokasi lagi.');
            return false;
        }
        
        // Cek jarak maksimal
        const distance = calculateDistance(STORE_LAT, STORE_LNG, parseFloat(lat), parseFloat(lng));
        if (distance > MAX_DISTANCE) {
            alert(`Maaf, lokasi Anda terlalu jauh (${distance.toFixed(1)} km). Maksimal jarak pengiriman adalah ${MAX_DISTANCE} km.`);
            return false;
        }
    }
    
    // Submit form
    form.submit();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Checkout Modern JS loaded');
    console.log('Store location:', STORE_LAT, STORE_LNG);
    console.log('Shipping config:', { BASE_RATE, PER_KM_RATE, MAX_DISTANCE });
});
