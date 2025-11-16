/**
 * VelvetVogue - Navigation Controller
 * Header scroll effects and mobile menu functionality
 */

(function() {
    'use strict';
    
    // DOM Elements
    const header = document.getElementById('header');
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav__link');
    const backToTop = document.getElementById('backToTop');
    
    // State
    let lastScrollY = 0;
    let isMenuOpen = false;
    
    /**
     * Initialize navigation functionality
     */
    function init() {
        setupScrollEffects();
        setupMobileMenu();
        setupBackToTop();
        setupDropdowns();
        setActiveNavLink();
    }
    
    /**
     * Setup header scroll effects
     */
    function setupScrollEffects() {
        if (!header) return;
        
        // Check initial scroll position
        checkScrollPosition();
        
        // Listen for scroll events (throttled)
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    checkScrollPosition();
                    ticking = false;
                });
                ticking = true;
            }
        });
    }
    
    /**
     * Check scroll position and update header
     */
    function checkScrollPosition() {
        const scrollY = window.scrollY;
        
        // Add/remove scrolled class
        if (scrollY > 50) {
            header.classList.add('header--scrolled');
        } else {
            header.classList.remove('header--scrolled');
        }
        
        // Show/hide back to top button
        if (backToTop) {
            if (scrollY > 500) {
                backToTop.classList.add('back-to-top--visible');
            } else {
                backToTop.classList.remove('back-to-top--visible');
            }
        }
        
        lastScrollY = scrollY;
    }
    
    /**
     * Setup mobile menu toggle
     */
    function setupMobileMenu() {
        if (!navToggle || !navMenu) return;
        
        navToggle.addEventListener('click', toggleMenu);
        
        // Close menu when clicking on a link
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (isMenuOpen) {
                    closeMenu();
                }
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (isMenuOpen && !navMenu.contains(e.target) && !navToggle.contains(e.target)) {
                closeMenu();
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMenu();
            }
        });
        
        // Close menu on resize if desktop size
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && isMenuOpen) {
                closeMenu();
            }
        });
    }
    
    /**
     * Toggle mobile menu
     */
    function toggleMenu() {
        if (isMenuOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    }
    
    /**
     * Open mobile menu
     */
    function openMenu() {
        isMenuOpen = true;
        navToggle.classList.add('nav__toggle--active');
        navMenu.classList.add('nav__menu--open');
        document.body.style.overflow = 'hidden';
        navToggle.setAttribute('aria-expanded', 'true');
    }
    
    /**
     * Close mobile menu
     */
    function closeMenu() {
        isMenuOpen = false;
        navToggle.classList.remove('nav__toggle--active');
        navMenu.classList.remove('nav__menu--open');
        document.body.style.overflow = '';
        navToggle.setAttribute('aria-expanded', 'false');
    }
    
    /**
     * Setup back to top button
     */
    function setupBackToTop() {
        if (!backToTop) return;
        
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    /**
     * Setup dropdown menus for desktop
     */
    function setupDropdowns() {
        const dropdownItems = document.querySelectorAll('.nav__item--dropdown');
        
        dropdownItems.forEach(item => {
            const link = item.querySelector('.nav__link');
            const dropdown = item.querySelector('.nav__dropdown');
            
            if (!link || !dropdown) return;
            
            // Mobile: toggle on click
            if (window.innerWidth <= 768) {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    item.classList.toggle('nav__item--open');
                });
            }
        });
    }
    
    /**
     * Set active navigation link based on current page
     */
    function setActiveNavLink() {
        const currentPage = window.location.pathname.split('/').pop() || 'home.php';
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPage) {
                link.classList.add('nav__link--active');
            }
        });
    }
    
    /**
     * Smooth scroll to section
     * @param {string} targetId - ID of target section
     */
    function smoothScrollTo(targetId) {
        const target = document.getElementById(targetId);
        if (!target) return;
        
        const headerHeight = header ? header.offsetHeight : 0;
        const targetPosition = target.offsetTop - headerHeight;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
    
    /**
     * Handle anchor links with smooth scroll
     */
    function setupAnchorLinks() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href.length > 1) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    smoothScrollTo(targetId);
                    
                    // Close mobile menu if open
                    if (isMenuOpen) {
                        closeMenu();
                    }
                }
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            init();
            setupAnchorLinks();
        });
    } else {
        init();
        setupAnchorLinks();
    }
    
})();