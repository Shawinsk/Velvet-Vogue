/**
 * VelvetVogue - Product Page Controller
 * Handles gallery, options, quantity, tabs, cart functionality
 */

(function() {
    'use strict';
    
    // Product state
    let selectedSize = null;
    let selectedColor = null;
    let quantity = 1;
    let maxStock = 10;
    
    /**
     * Initialize product page
     */
    function init() {
        setupGallery();
        setupSizeSelection();
        setupColorSelection();
        setupQuantityControls();
        setupTabs();
        setupAddToCart();
        setupWishlist();
        setupZoom();
    }
    
    /**
     * Setup image gallery with thumbnails
     */
    function setupGallery() {
        const thumbnails = document.querySelectorAll('.product-gallery__thumb');
        const mainImage = document.querySelector('.product-gallery__image');
        
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                // Update active state
                thumbnails.forEach(t => t.classList.remove('product-gallery__thumb--active'));
                thumb.classList.add('product-gallery__thumb--active');
                
                // Update main image (in real app, would change image src)
                if (mainImage) {
                    mainImage.textContent = `Product Image ${index + 1}`;
                }
            });
        });
    }
    
    /**
     * Setup size selection buttons
     */
    function setupSizeSelection() {
        const sizeButtons = document.querySelectorAll('.product-option__size');
        
        sizeButtons.forEach(btn => {
            if (btn.classList.contains('product-option__size--disabled')) return;
            
            btn.addEventListener('click', () => {
                sizeButtons.forEach(b => b.classList.remove('product-option__size--active'));
                btn.classList.add('product-option__size--active');
                selectedSize = btn.textContent.trim();
            });
            
            // Set initial selection
            if (btn.classList.contains('product-option__size--active')) {
                selectedSize = btn.textContent.trim();
            }
        });
    }
    
    /**
     * Setup color selection swatches
     */
    function setupColorSelection() {
        const colorButtons = document.querySelectorAll('.product-option__color');
        const colorLabel = document.getElementById('selectedColor');
        
        colorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                colorButtons.forEach(b => b.classList.remove('product-option__color--active'));
                btn.classList.add('product-option__color--active');
                selectedColor = btn.dataset.color;
                
                if (colorLabel) {
                    colorLabel.textContent = selectedColor;
                }
            });
            
            // Set initial selection
            if (btn.classList.contains('product-option__color--active')) {
                selectedColor = btn.dataset.color;
            }
        });
    }
    
    /**
     * Setup quantity increase/decrease controls
     */
    function setupQuantityControls() {
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.querySelector('.quantity-btn[data-action="decrease"]');
        const increaseBtn = document.querySelector('.quantity-btn[data-action="increase"]');
        
        if (!quantityInput) return;
        
        // Get max stock from input
        maxStock = parseInt(quantityInput.max) || 10;
        
        // Manual input change
        quantityInput.addEventListener('change', () => {
            let value = parseInt(quantityInput.value);
            
            if (isNaN(value) || value < 1) value = 1;
            if (value > maxStock) value = maxStock;
            
            quantityInput.value = value;
            quantity = value;
        });
        
        // Decrease button
        if (decreaseBtn) {
            decreaseBtn.addEventListener('click', () => {
                changeQuantity(-1);
            });
        }
        
        // Increase button
        if (increaseBtn) {
            increaseBtn.addEventListener('click', () => {
                changeQuantity(1);
            });
        }
    }
    
    /**
     * Change quantity by delta
     */
    function changeQuantity(delta) {
        const input = document.getElementById('quantity');
        if (!input) return;
        
        let value = parseInt(input.value) + delta;
        
        if (value < 1) value = 1;
        if (value > maxStock) value = maxStock;
        
        input.value = value;
        quantity = value;
    }
    
    // Make globally accessible
    window.changeQuantity = changeQuantity;
    
    /**
     * Setup product tabs
     */
    function setupTabs() {
        const tabButtons = document.querySelectorAll('.product-tabs__btn');
        const tabContents = document.querySelectorAll('.product-tabs__content');
        
        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabName = btn.dataset.tab;
                
                // Update button states
                tabButtons.forEach(b => b.classList.remove('product-tabs__btn--active'));
                btn.classList.add('product-tabs__btn--active');
                
                // Update content visibility
                tabContents.forEach(content => {
                    content.classList.remove('product-tabs__content--active');
                    if (content.id === `tab-${tabName}`) {
                        content.classList.add('product-tabs__content--active');
                    }
                });
            });
        });
    }
    
    /**
     * Setup add to cart functionality
     */
    function setupAddToCart() {
        const addToCartBtn = document.querySelector('.product-actions__cart');
        
        if (!addToCartBtn) return;
        
        addToCartBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const productId = addToCartBtn.dataset.productId || getProductIdFromUrl();
            
            // Validate selections
            if (!validateSelections()) return;
            
            // Add to cart
            const cartItem = {
                id: productId,
                size: selectedSize,
                color: selectedColor,
                quantity: quantity
            };
            
            // Save to localStorage
            addToLocalCart(cartItem);
            
            // Show success message
            if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                VelvetVogue.showToast('Added to cart!', 'success');
            }
            
            // Update cart badge
            updateCartBadge();
            
            console.log('Added to cart:', cartItem);
        });
    }
    
    /**
     * Validate product selections before adding to cart
     */
    function validateSelections() {
        if (!selectedSize) {
            if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                VelvetVogue.showToast('Please select a size', 'error');
            }
            return false;
        }
        
        if (!selectedColor) {
            if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                VelvetVogue.showToast('Please select a color', 'error');
            }
            return false;
        }
        
        return true;
    }
    
    /**
     * Add item to cart in localStorage
     */
    function addToLocalCart(item) {
        let cart = JSON.parse(localStorage.getItem('velvetvogue_cart') || '[]');
        
        // Check if same item exists
        const existingIndex = cart.findIndex(i => 
            i.id === item.id && 
            i.size === item.size && 
            i.color === item.color
        );
        
        if (existingIndex > -1) {
            cart[existingIndex].quantity += item.quantity;
        } else {
            cart.push(item);
        }
        
        localStorage.setItem('velvetvogue_cart', JSON.stringify(cart));
    }
    
    /**
     * Update cart badge count
     */
    function updateCartBadge() {
        const badge = document.querySelector('.header__cart-badge');
        if (!badge) return;
        
        const cart = JSON.parse(localStorage.getItem('velvetvogue_cart') || '[]');
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        
        if (totalItems > 0) {
            badge.textContent = totalItems;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
    
    /**
     * Get product ID from URL
     */
    function getProductIdFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('id') || '1';
    }
    
    /**
     * Setup wishlist button
     */
    function setupWishlist() {
        const wishlistBtn = document.querySelector('.product-actions__wishlist');
        
        if (!wishlistBtn) return;
        
        wishlistBtn.addEventListener('click', () => {
            const productId = getProductIdFromUrl();
            
            // Toggle wishlist state
            let wishlist = JSON.parse(localStorage.getItem('velvetvogue_wishlist') || '[]');
            const index = wishlist.indexOf(productId);
            
            if (index > -1) {
                wishlist.splice(index, 1);
                if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                    VelvetVogue.showToast('Removed from wishlist', 'info');
                }
            } else {
                wishlist.push(productId);
                if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                    VelvetVogue.showToast('Added to wishlist!', 'success');
                }
            }
            
            localStorage.setItem('velvetvogue_wishlist', JSON.stringify(wishlist));
        });
    }
    
    /**
     * Setup image zoom functionality
     */
    function setupZoom() {
        const zoomBtn = document.querySelector('.product-gallery__zoom');
        const mainImage = document.querySelector('.product-gallery__main');
        
        if (!zoomBtn || !mainImage) return;
        
        zoomBtn.addEventListener('click', () => {
            // Toggle fullscreen zoom (simplified version)
            mainImage.classList.toggle('product-gallery__main--zoomed');
            
            if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                VelvetVogue.showToast('Zoom feature coming soon!', 'info');
            }
        });
    }
    
    /**
     * Setup review helpful buttons
     */
    function setupReviewHelpful() {
        const helpfulBtns = document.querySelectorAll('.review-card__helpful button');
        
        helpfulBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (typeof VelvetVogue !== 'undefined' && VelvetVogue.showToast) {
                    VelvetVogue.showToast('Thank you for your feedback!', 'success');
                }
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            init();
            updateCartBadge(); // Update badge on page load
        });
    } else {
        init();
        updateCartBadge();
    }
    
})();