#!/bin/bash

# Comprehensive Testing Script
# Jalankan: bash run-tests.sh

echo ""
echo "╔════════════════════════════════════════════════════════╗"
echo "║           COMPREHENSIVE TESTING SUITE                 ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

PASSED=0
FAILED=0

# Function to run test
run_test() {
    local test_name=$1
    local command=$2
    
    echo -e "${BLUE}▶ Testing: $test_name${NC}"
    
    if eval $command > /dev/null 2>&1; then
        echo -e "${GREEN}  ✅ PASSED${NC}"
        ((PASSED++))
    else
        echo -e "${RED}  ❌ FAILED${NC}"
        ((FAILED++))
    fi
    echo ""
}

# 1. Environment Tests
echo -e "${YELLOW}═══ ENVIRONMENT TESTS ═══${NC}"
echo ""

run_test "PHP Version (>= 8.1)" "php -v | grep -q 'PHP 8\.[1-9]'"
run_test "Node.js installed" "node --version"
run_test "NPM installed" "npm --version"
run_test "Composer installed" "composer --version"

# 2. File Structure Tests
echo -e "${YELLOW}═══ FILE STRUCTURE TESTS ═══${NC}"
echo ""

run_test "checkout-modern.js exists" "test -f public/js/checkout-modern.js"
run_test "ShippingCalculator.php exists" "test -f app/Services/ShippingCalculator.php"
run_test ".env file exists" "test -f .env"
run_test "vendor directory exists" "test -d vendor"
run_test "node_modules exists" "test -d node_modules"

# 3. Configuration Tests
echo -e "${YELLOW}═══ CONFIGURATION TESTS ═══${NC}"
echo ""

# Check if coordinates are updated
STORE_LAT=$(grep "const STORE_LAT" public/js/checkout-modern.js | grep -oP '[-]?\d+\.\d+')
if [ "$STORE_LAT" != "-6.5971469" ]; then
    echo -e "${GREEN}  ✅ Store coordinates updated${NC}"
    ((PASSED++))
else
    echo -e "${YELLOW}  ⚠️  Store coordinates still default (update recommended)${NC}"
    ((FAILED++))
fi
echo ""

# Check shipping rates
BASE_RATE=$(grep "const BASE_RATE" public/js/checkout-modern.js | grep -oP '\d+')
if [ "$BASE_RATE" -gt 0 ]; then
    echo -e "${GREEN}  ✅ Shipping rates configured (Rp $BASE_RATE base)${NC}"
    ((PASSED++))
else
    echo -e "${RED}  ❌ Shipping rates not configured${NC}"
    ((FAILED++))
fi
echo ""

# 4. Laravel Tests
echo -e "${YELLOW}═══ LARAVEL TESTS ═══${NC}"
echo ""

run_test "Laravel key generated" "grep -q 'APP_KEY=base64:' .env"
run_test "Database configured" "grep -q 'DB_DATABASE=' .env"

# Run Laravel tests if available
if [ -d "tests" ]; then
    echo -e "${BLUE}▶ Running Laravel tests...${NC}"
    php artisan test --stop-on-failure
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}  ✅ Laravel tests PASSED${NC}"
        ((PASSED++))
    else
        echo -e "${RED}  ❌ Laravel tests FAILED${NC}"
        ((FAILED++))
    fi
    echo ""
fi

# 5. JavaScript Syntax Tests
echo -e "${YELLOW}═══ JAVASCRIPT TESTS ═══${NC}"
echo ""

# Check for syntax errors
if node -c public/js/checkout-modern.js 2>/dev/null; then
    echo -e "${GREEN}  ✅ JavaScript syntax valid${NC}"
    ((PASSED++))
else
    echo -e "${RED}  ❌ JavaScript syntax errors${NC}"
    ((FAILED++))
fi
echo ""

# 6. Documentation Tests
echo -e "${YELLOW}═══ DOCUMENTATION TESTS ═══${NC}"
echo ""

run_test "GPS Documentation Index" "test -f GPS_DOCUMENTATION_INDEX.md"
run_test "Quick Setup Guide" "test -f QUICK_SETUP_GPS.md"
run_test "Testing Checklist" "test -f GPS_TESTING_CHECKLIST.md"
run_test "FAQ Document" "test -f GPS_FAQ.md"
run_test "Admin Setup Guide" "test -f ADMIN_SETUP_GUIDE.md"

# 7. Security Tests
echo -e "${YELLOW}═══ SECURITY TESTS ═══${NC}"
echo ""

# Check if .env is in .gitignore
if grep -q "^\.env$" .gitignore 2>/dev/null; then
    echo -e "${GREEN}  ✅ .env in .gitignore${NC}"
    ((PASSED++))
else
    echo -e "${RED}  ❌ .env not in .gitignore (security risk!)${NC}"
    ((FAILED++))
fi
echo ""

# Check for exposed secrets
if grep -q "password.*=.*[^=]$" .env 2>/dev/null; then
    echo -e "${YELLOW}  ⚠️  Database password set (ensure it's secure)${NC}"
fi
echo ""

# 8. Performance Tests
echo -e "${YELLOW}═══ PERFORMANCE TESTS ═══${NC}"
echo ""

# Check file sizes
JS_SIZE=$(stat -f%z public/js/checkout-modern.js 2>/dev/null || stat -c%s public/js/checkout-modern.js 2>/dev/null)
if [ "$JS_SIZE" -lt 50000 ]; then
    echo -e "${GREEN}  ✅ JavaScript file size optimal (${JS_SIZE} bytes)${NC}"
    ((PASSED++))
else
    echo -e "${YELLOW}  ⚠️  JavaScript file large (${JS_SIZE} bytes)${NC}"
    ((FAILED++))
fi
echo ""

# 9. Summary
echo ""
echo "╔════════════════════════════════════════════════════════╗"
echo "║                   TEST SUMMARY                         ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""
echo -e "${GREEN}  ✅ Passed: $PASSED${NC}"
echo -e "${RED}  ❌ Failed: $FAILED${NC}"
echo ""

TOTAL=$((PASSED + FAILED))
PERCENTAGE=$((PASSED * 100 / TOTAL))

echo "  Success Rate: $PERCENTAGE%"
echo ""

if [ $FAILED -eq 0 ]; then
    echo -e "${GREEN}  🎉 ALL TESTS PASSED!${NC}"
    echo ""
    echo "  ✅ System ready for production"
    echo "  📚 Read: GPS_DOCUMENTATION_INDEX.md"
    echo "  🚀 Deploy: Follow ADMIN_SETUP_GUIDE.md"
    echo ""
    exit 0
else
    echo -e "${YELLOW}  ⚠️  Some tests failed${NC}"
    echo ""
    echo "  📋 Action items:"
    echo "  1. Fix failed tests above"
    echo "  2. Update store coordinates if needed"
    echo "  3. Run: bash run-tests.sh again"
    echo ""
    exit 1
fi
