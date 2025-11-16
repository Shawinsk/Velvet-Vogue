/**
 * VelvetVogue - Shop Page Controller
 * Filters, sorting, grid view toggle
 */

(function() {
    'use strict';
    
    // State
    let activeFilters = {
        categories: [],
        colors: [],
        sizes: [],
        priceMin: 0,
        priceMax: 100000
    };
    
    let currentSort = 'featured';
    let currentView = 'grid-3';
    
    /**
     * Initialize shop functionality
     */
    function init() {
        setupFilters();
        setupSorting();
        setupViewToggle();
        setupMobileFilters();
        setupPriceRange();
    }
    
    /**
     * Setup filter checkboxes and interactions
     */
    function setupFilters() {
        // Category filters
        const categoryCheckboxes = document.querySelectorAll('.filter-checkbox input[data-filter="category"]');
        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                updateCategoryFilters();
                applyFilters();
            });
        });
        
        // Size filters
        const sizeButtons = document.querySelectorAll('.filter-size');
        sizeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('filter-size--active');
                updateSizeFilters();
                applyFilters();
            });
        });
        
        // Color filters
        const colorButtons = document.querySelectorAll('.filter-color');
        colorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('filter-color--active');
                updateColorFilters();
                applyFilters();
            });
        });
        
        // Clear all filters
        const clearBtn = document.querySelector('.filters__clear');
        if (clearBtn) {
            clearBtn.addEventListener('click', clearAllFilters);
        }
    }
    
    /**
     * Update category filters array
     */
    function updateCategoryFilters() {
        const checked = document.querySelectorAll('.filter-checkbox input[data-filter="category"]:checked');
        activeFilters.categories = Array.from(checked).map(cb => cb.value);
    }
    
    /**
     * Update size filters array
     */
    function updateSizeFilters() {
        const active = document.querySelectorAll('.filter-size--active');
        activeFilters.sizes = Array.from(active).map(btn => btn.dataset.size);
    }
    
    /**
     * Update color filters array
     */
    function updateColorFilters() {
        const active = document.querySelectorAll('.filter-color--active');
        activeFilters.colors = Array.from(active).map(btn => btn.dataset.color);
    }
    
    /**
     * Setup price range inputs
     */
    function setupPriceRange() {
        const minInput = document.getElementById('priceMin');
        const maxInput = document.getElementById('priceMax');
        
        if (minInput && maxInput) {
            minInput.addEventListener('change', () => {
                activeFilters.priceMin = parseInt(minInput.value) || 0;
                applyFilters();
            });
            
            maxInput.addEventListener('change', () => {
                activeFilters.priceMax = parseInt(maxInput.value) || 100000;
                applyFilters();
            });
        }
    }
    
    /**
     * Apply all active filters
     */
    function applyFilters() {
        const products = document.querySelectorAll('.product-card');
        let visibleCount = 0;
        
        products.forEach(product => {
            const shouldShow = checkProductFilters(product);
            product.style.display = shouldShow ? 'block' : 'none';
            if (shouldShow) visibleCount++;
        });
        
        // Update count
        updateProductCount(visibleCount);
        
        // Show empty state if no products
        toggleEmptyState(visibleCount === 0);
    }
    
    /**
     * Check if product matches active filters
     */
    function checkProductFilters(product) {
        // Category check
        if (activeFilters.categories.length > 0) {
            const productCategory = product.dataset.category;
            if (!activeFilters.categories.includes(productCategory)) {
                return false;
            }
        }
        
        // Size check
        if (activeFilters.sizes.length > 0) {
            const productSizes = product.dataset.sizes ? product.dataset.sizes.split(',') : [];
            const hasSize = activeFilters.sizes.some(size => productSizes.includes(size));
            if (!hasSize) return false;
        }
        
        // Color check
        if (activeFilters.colors.length > 0) {
            const productColors = product.dataset.colors ? product.dataset.colors.split(',') : [];
            const hasColor = activeFilters.colors.some(color => productColors.includes(color));
            if (!hasColor) return false;
        }
        
        // Price check
        const productPrice = parseFloat(product.dataset.price) || 0;
        if (productPrice < activeFilters.priceMin || productPrice > activeFilters.priceMax) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Clear all filters
     */
    function clearAllFilters() {
        // Reset checkboxes
        document.querySelectorAll('.filter-checkbox input').forEach(cb => cb.checked = false);
        
        // Reset size buttons
        document.querySelectorAll('.filter-size--active').forEach(btn => btn.classList.remove('filter-size--active'));
        
        // Reset color buttons
        document.querySelectorAll('.filter-color--active').forEach(btn => btn.classList.remove('filter-color--active'));
        
        // Reset price inputs
        const minInput = document.getElementById('priceMin');
        const maxInput = document.getElementById('priceMax');
        if (minInput) minInput.value = '';
        if (maxInput) maxInput.value = '';
        
        // Reset state
        activeFilters = {
            categories: [],
            colors: [],
            sizes: [],
            priceMin: 0,
            priceMax: 100000
        };
        
        applyFilters();
        
        VelvetVogue.showToast('Filters cleared', 'info');
    }
    
    /**
     * Update product count display
     */
    function updateProductCount(count) {
        const countEl = document.querySelector('.products__count');
        if (countEl) {
            countEl.innerHTML = `Showing <strong>${count}</strong> products`;
        }
    }
    
    /**
     * Toggle empty state
     */
    function toggleEmptyState(show) {
        const emptyState = document.querySelector('.products__empty');
        const grid = document.querySelector('.products__grid');
        
        if (emptyState) {
            emptyState.style.display = show ? 'block' : 'none';
        }
        if (grid) {
            grid.style.display = show ? 'none' : 'grid';
        }
    }
    
    /**
     * Setup sorting functionality
     */
    function setupSorting() {
        const sortSelect = document.getElementById('sortSelect');
        if (!sortSelect) return;
        
        sortSelect.addEventListener('change', () => {
            currentSort = sortSelect.value;
            sortProducts(currentSort);
        });
    }
    
    /**
     * Sort products
     */
    function sortProducts(sortBy) {
        const grid = document.querySelector('.products__grid');
        if (!grid) return;
        
        const products = Array.from(grid.querySelectorAll('.product-card'));
        
        products.sort((a, b) => {
            switch (sortBy) {
                case 'price-low':
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                case 'price-high':
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                case 'name-asc':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'name-desc':
                    return b.dataset.name.localeCompare(a.dataset.name);
                case 'newest':
                    return new Date(b.dataset.date) - new Date(a.dataset.date);
                default:
                    return 0;
            }
        });
        
        // Re-append sorted products
        products.forEach(product => grid.appendChild(product));
    }
    
    /**
     * Setup view toggle (grid columns)
     */
    function setupViewToggle() {
        const toggleBtns = document.querySelectorAll('.view-toggle__btn');
        const grid = document.querySelector('.products__grid');
        
        if (!grid) return;
        
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                toggleBtns.forEach(b => b.classList.remove('view-toggle__btn--active'));
                btn.classList.add('view-toggle__btn--active');
                
                // Update grid
                const cols = btn.dataset.cols;
                grid.className = 'products__grid';
                if (cols === '4') {
                    grid.classList.add('products__grid--4cols');
                } else if (cols === '2') {
                    grid.classList.add('products__grid--2cols');
                }
                
                currentView = `grid-${cols}`;
            });
        });
    }
    
    /**
     * Setup mobile filter panel
     */
    function setupMobileFilters() {
        const openBtn = document.querySelector('.filters__mobile-toggle');
        const closeBtn = document.querySelector('.filters__close');
        const filters = document.querySelector('.filters');
        const overlay = document.createElement('div');
        
        overlay.className = 'filters-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 399;
            display: none;
        `;
        document.body.appendChild(overlay);
        
        if (openBtn && filters) {
            openBtn.addEventListener('click', () => {
                filters.classList.add('filters--open');
                overlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        }
        
        const closeFilters = () => {
            if (filters) {
                filters.classList.remove('filters--open');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        };
        
        if (closeBtn) {
            closeBtn.addEventListener('click', closeFilters);
        }
        
        overlay.addEventListener('click', closeFilters);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
})();