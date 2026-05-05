<?php

namespace App\Services;

class ShippingCalculator
{
    // Koordinat toko roti (ganti dengan koordinat toko sebenarnya)
    private $storeLat = -6.2088; // Contoh: Jakarta
    private $storeLng = 106.8456;
    
    // Tarif per kilometer (sesuaikan dengan tarif Grab/GoFood di daerah kamu)
    private $baseRate = 5000; // Biaya dasar
    private $perKmRate = 2000; // Biaya per km
    private $minDistance = 1; // Jarak minimum (km)
    private $maxDistance = 15; // Jarak maksimum pengiriman (km)
    
    /**
     * Hitung jarak antara 2 koordinat menggunakan Haversine formula
     */
    public function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Radius bumi dalam km
        
        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);
        
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lngDiff / 2) * sin($lngDiff / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        
        return round($distance, 2);
    }
    
    /**
     * Hitung ongkir berdasarkan jarak
     */
    public function calculateShippingCost($customerLat, $customerLng)
    {
        $distance = $this->calculateDistance(
            $this->storeLat, 
            $this->storeLng, 
            $customerLat, 
            $customerLng
        );
        
        // Cek apakah dalam jangkauan
        if ($distance > $this->maxDistance) {
            return [
                'success' => false,
                'message' => "Maaf, jarak pengiriman maksimal {$this->maxDistance} km. Jarak Anda: {$distance} km",
                'distance' => $distance,
                'cost' => 0
            ];
        }
        
        // Hitung ongkir
        $effectiveDistance = max($distance, $this->minDistance);
        $shippingCost = $this->baseRate + ($effectiveDistance * $this->perKmRate);
        
        // Bulatkan ke kelipatan 1000
        $shippingCost = ceil($shippingCost / 1000) * 1000;
        
        return [
            'success' => true,
            'distance' => $distance,
            'cost' => $shippingCost,
            'message' => "Jarak: {$distance} km"
        ];
    }
    
    /**
     * Estimasi waktu pengiriman berdasarkan jarak
     */
    public function estimateDeliveryTime($distance)
    {
        // Asumsi kecepatan rata-rata 20 km/jam
        $hours = $distance / 20;
        $minutes = ceil($hours * 60);
        
        // Tambah waktu persiapan (15-30 menit)
        $prepTime = rand(15, 30);
        $totalMinutes = $minutes + $prepTime;
        
        return [
            'min' => $totalMinutes,
            'max' => $totalMinutes + 15,
            'text' => $totalMinutes . '-' . ($totalMinutes + 15) . ' menit'
        ];
    }
    
    /**
     * Set koordinat toko
     */
    public function setStoreLocation($lat, $lng)
    {
        $this->storeLat = $lat;
        $this->storeLng = $lng;
    }
    
    /**
     * Set tarif
     */
    public function setRates($baseRate, $perKmRate)
    {
        $this->baseRate = $baseRate;
        $this->perKmRate = $perKmRate;
    }
}
