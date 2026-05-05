#!/bin/bash

# Quick Setup Script untuk GPS Checkout System
# Jalankan: bash quick-setup.sh

echo ""
echo "╔════════════════════════════════════════════════════════╗"
echo "║        QUICK SETUP - GPS CHECKOUT SYSTEM              ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""

# Warna
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Check koordinat toko
echo -e "${YELLOW}📍 Checking koordinat toko...${NC}"
CURRENT_LAT=$(grep "const STORE_LAT" public/js/checkout-modern.js | grep -oP '[-]?\d+\.\d+')
CURRENT_LNG=$(grep "const STORE_LNG" public/js/checkout-modern.js | grep -oP '[-]?\d+\.\d+')

echo "   Current: $CURRENT_LAT, $CURRENT_LNG"

if [ "$CURRENT_LAT" == "-6.5971469" ]; then
    echo -e "${RED}   ⚠️  MASIH KOORDINAT CONTOH!${NC}"
    echo ""
    echo "   Cara update:"
    echo "   1. Buka Google Maps"
    echo "   2. Cari alamat toko"
    echo "   3. Klik kanan → Copy koordinat"
    echo "   4. Edit file: public/js/checkout-modern.js (baris 7-8)"
    echo ""
else
    echo -e "${GREEN}   ✅ Koordinat sudah diupdate${NC}"
fi

# 2. Check harga ongkir
echo -e "${YELLOW}💰 Checking harga ongkir...${NC}"
BASE_RATE=$(grep "const BASE_RATE" public/js/checkout-modern.js | grep -oP '\d+')
PER_KM=$(grep "const PER_KM_RATE" public/js/checkout-modern.js | grep -oP '\d+')
MAX_DIST=$(grep "const MAX_DISTANCE" public/js/checkout-modern.js | grep -oP '\d+')

echo "   Biaya Dasar: Rp $BASE_RATE"
echo "   Per KM: Rp $PER_KM"
echo "   Jarak Max: $MAX_DIST km"
echo ""
echo "   Simulasi:"
echo "   - 1 km  = Rp $((BASE_RATE + 1 * PER_KM))"
echo "   - 3 km  = Rp $((BASE_RATE + 3 * PER_KM))"
echo "   - 5 km  = Rp $((BASE_RATE + 5 * PER_KM))"
echo "   - 10 km = Rp $((BASE_RATE + 10 * PER_KM))"
echo ""

# 3. Check dependencies
echo -e "${YELLOW}📦 Checking dependencies...${NC}"

if [ -d "node_modules" ]; then
    echo -e "${GREEN}   ✅ Node modules installed${NC}"
else
    echo -e "${RED}   ❌ Node modules not found${NC}"
    echo "   Run: npm install"
fi

if [ -d "vendor" ]; then
    echo -e "${GREEN}   ✅ Composer packages installed${NC}"
else
    echo -e "${RED}   ❌ Vendor not found${NC}"
    echo "   Run: composer install"
fi

# 4. Check .env
echo -e "${YELLOW}⚙️  Checking .env...${NC}"
if [ -f ".env" ]; then
    echo -e "${GREEN}   ✅ .env exists${NC}"
    
    # Check database
    DB_NAME=$(grep "DB_DATABASE" .env | cut -d '=' -f2)
    echo "   Database: $DB_NAME"
else
    echo -e "${RED}   ❌ .env not found${NC}"
    echo "   Run: cp .env.example .env"
fi

# 5. Quick test
echo ""
echo -e "${YELLOW}🧪 Quick Test Commands:${NC}"
echo ""
echo "   # Start development server"
echo "   php artisan serve"
echo ""
echo "   # In another terminal:"
echo "   npm run dev"
echo ""
echo "   # Open browser:"
echo "   http://127.0.0.1:8000/checkout"
echo ""

# 6. Next steps
echo -e "${YELLOW}📋 Next Steps:${NC}"
echo ""
echo "   1. Update koordinat toko (jika belum)"
echo "   2. Sesuaikan harga ongkir"
echo "   3. Run: php artisan serve"
echo "   4. Run: npm run dev (terminal lain)"
echo "   5. Test di browser"
echo ""
echo "   📚 Baca: GPS_DOCUMENTATION_INDEX.md"
echo "   ⚡ Quick: QUICK_SETUP_GPS.md"
echo "   ✅ Test: GPS_TESTING_CHECKLIST.md"
echo ""

echo "╔════════════════════════════════════════════════════════╗"
echo "║                    SETUP COMPLETE                      ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""
