/* ============================================
   HOMEPAGE ENHANCED JAVASCRIPT
   Interactive Features & Animations
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    
    // ========== STICKY HEADER ON SCROLL ==========
    const header = document.querySelector('header');
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });
    
    // ========== ACTIVE NAVIGATION LINK ==========
    const navLinks = document.querySelectorAll('nav a');
    const sections = document.querySelectorAll('section[id]');
    
    function setActiveNav() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (window.pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', setActiveNav);
    
    // ========== BACK TO TOP BUTTON ==========
    let backToTopBtn = document.querySelector('.back-to-top');
    
    if (!backToTopBtn) {
        backToTopBtn = document.createElement('button');
        backToTopBtn.className = 'back-to-top';
        backToTopBtn.innerHTML = '↑';
        backToTopBtn.setAttribute('aria-label', 'Back to top');
        document.body.appendChild(backToTopBtn);
    }
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 500) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // ========== QUICK VIEW MODAL ==========
    let quickViewModal = document.querySelector('.quick-view-modal');
    
    if (!quickViewModal) {
        quickViewModal = document.createElement('div');
        quickViewModal.className = 'quick-view-modal';
        quickViewModal.innerHTML = `
            <div class="quick-view-content">
                <button class="quick-view-close" onclick="closeQuickView()">×</button>
                <div class="quick-view-body">
                    <div>
                        <img src="" alt="" class="quick-view-image" id="qvImage">
                    </div>
                    <div class="quick-view-details">
                        <h2 id="qvName"></h2>
                        <div class="quick-view-price" id="qvPrice"></div>
                        <p class="quick-view-description" id="qvDescription"></p>
                        <div class="product-actions">
                            <div class="quantity-selector">
                                <button class="qty-btn" onclick="changeQty('qv', -1)">-</button>
                                <input type="number" id="qvQty" value="1" min="1" readonly style="width: 50px; text-align: center; border: none; background: transparent; font-weight: 600;">
                                <button class="qty-btn" onclick="changeQty('qv', 1)">+</button>
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCartFromQuickView()">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(quickViewModal);
    }
    
    // Close modal when clicking outside
    quickViewModal.addEventListener('click', function(e) {
        if (e.target === quickViewModal) {
            closeQuickView();
        }
    });
    
    // ========== ADD QUICK VIEW BUTTONS TO PRODUCTS ==========
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        const imageWrapper = card.querySelector('.product-image-wrapper');
        
        if (imageWrapper && !imageWrapper.querySelector('.quick-view-btn')) {
            const quickViewBtn = document.createElement('button');
            quickViewBtn.className = 'quick-view-btn';
            quickViewBtn.textContent = 'Lihat Detail';
            quickViewBtn.onclick = function(e) {
                e.stopPropagation();
                openQuickView(card);
            };
            imageWrapper.appendChild(quickViewBtn);
        }
    });
    
    // ========== ENHANCED ADD TO CART ANIMATION ==========
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                width: 20px;
                height: 20px;
                background: rgba(255,255,255,0.6);
                border-radius: 50%;
                pointer-events: none;
                animation: ripple 0.6s ease-out;
            `;
            
            const rect = this.getBoundingClientRect();
            ripple.style.left = (e.clientX - rect.left - 10) + 'px';
            ripple.style.top = (e.clientY - rect.top - 10) + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
            
            // Button feedback
            const originalText = this.textContent;
            this.textContent = '✓ Ditambahkan!';
            this.style.background = '#4CAF50';
            
            setTimeout(() => {
                this.textContent = originalText;
                this.style.background = '';
            }, 2000);
        });
    });
    
    // ========== LAZY LOADING IMAGES ==========
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
    
    // ========== SMOOTH SCROLL FOR ANCHOR LINKS ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '#!') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // ========== ENHANCED TOAST NOTIFICATIONS ==========
    window.showToast = function(message, type = 'success') {
        const existingToast = document.querySelector('.toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
        
        toast.innerHTML = `
            <span style="font-size: 1.5rem;">${icon}</span>
            <span style="font-weight: 600;">${message}</span>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.4s ease';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    };
    
});

// ========== GLOBAL FUNCTIONS ==========

function openQuickView(productCard) {
    const modal = document.querySelector('.quick-view-modal');
    const name = productCard.querySelector('.product-name').textContent;
    const price = productCard.querySelector('.product-price').textContent;
    const image = productCard.querySelector('.product-image').src;
    const description = productCard.querySelector('.product-description')?.textContent || 'Roti lembut dan lezat dengan bahan berkualitas tinggi.';
    
    document.getElementById('qvName').textContent = name;
    document.getElementById('qvPrice').textContent = price;
    document.getElementById('qvImage').src = image;
    document.getElementById('qvImage').alt = name;
    document.getElementById('qvDescription').textContent = description;
    document.getElementById('qvQty').value = 1;
    
    // Store product ID for add to cart
    modal.dataset.productId = productCard.dataset.productId || '';
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeQuickView() {
    const modal = document.querySelector('.quick-view-modal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function changeQty(prefix, delta) {
    const input = document.getElementById(prefix + 'Qty');
    let value = parseInt(input.value) || 1;
    value = Math.max(1, value + delta);
    input.value = value;
}

function addToCartFromQuickView() {
    const modal = document.querySelector('.quick-view-modal');
    const productId = modal.dataset.productId;
    const qty = document.getElementById('qvQty').value;
    const name = document.getElementById('qvName').textContent;
    
    // Trigger the actual add to cart function if it exists
    if (typeof addToCart === 'function') {
        addToCart(productId, qty);
    }
    
    showToast(`${name} (${qty}x) ditambahkan ke keranjang!`, 'success');
    closeQuickView();
}

// ========== CHECKOUT PROGRESS INDICATOR ==========
function initCheckoutProgress(currentStep = 1) {
    const checkoutForm = document.querySelector('.checkout-form, #checkoutForm');
    
    if (!checkoutForm) return;
    
    const progressHTML = `
        <div class="checkout-progress">
            <div class="progress-line" style="width: ${(currentStep - 1) * 50}%"></div>
            <div class="progress-step ${currentStep >= 1 ? 'active' : ''} ${currentStep > 1 ? 'completed' : ''}">
                <div class="step-circle">${currentStep > 1 ? '✓' : '1'}</div>
                <div class="step-label">Informasi</div>
            </div>
            <div class="progress-step ${currentStep >= 2 ? 'active' : ''} ${currentStep > 2 ? 'completed' : ''}">
                <div class="step-circle">${currentStep > 2 ? '✓' : '2'}</div>
                <div class="step-label">Pembayaran</div>
            </div>
            <div class="progress-step ${currentStep >= 3 ? 'active' : ''}">
                <div class="step-circle">3</div>
                <div class="step-label">Selesai</div>
            </div>
        </div>
    `;
    
    checkoutForm.insertAdjacentHTML('afterbegin', progressHTML);
}

function updateCheckoutProgress(step) {
    const steps = document.querySelectorAll('.progress-step');
    const progressLine = document.querySelector('.progress-line');
    
    steps.forEach((stepEl, index) => {
        const circle = stepEl.querySelector('.step-circle');
        
        if (index < step - 1) {
            stepEl.classList.add('completed');
            stepEl.classList.remove('active');
            circle.textContent = '✓';
        } else if (index === step - 1) {
            stepEl.classList.add('active');
            stepEl.classList.remove('completed');
            circle.textContent = index + 1;
        } else {
            stepEl.classList.remove('active', 'completed');
            circle.textContent = index + 1;
        }
    });
    
    if (progressLine) {
        progressLine.style.width = `${(step - 1) * 50}%`;
    }
}

// ========== RIPPLE ANIMATION ==========
@keyframes ripple {
    to {
        width: 200px;
        height: 200px;
        opacity: 0;
    }
}

@keyframes slideOutRight {
    to {
        opacity: 0;
        transform: translateX(100px);
    }
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we're on checkout page
        if (window.location.pathname.includes('checkout') || document.querySelector('.checkout-form')) {
            initCheckoutProgress(1);
        }
    });
} else {
    if (window.location.pathname.includes('checkout') || document.querySelector('.checkout-form')) {
        initCheckoutProgress(1);
    }
}


// ========== MOBILE MENU TOGGLE ==========
function toggleMenu() {
    const navMenu = document.getElementById('navMenu');
    if (navMenu) {
        navMenu.classList.toggle('active');
    }
}

// Close mobile menu when clicking a link
document.addEventListener('DOMContentLoaded', function() {
    const navMenu = document.getElementById('navMenu');
    if (navMenu) {
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
            });
        });
    }
});

// ========== USER DROPDOWN TOGGLE ==========
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.getElementById('userDropdown');
    
    if (dropdown && userMenu && !userMenu.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});
