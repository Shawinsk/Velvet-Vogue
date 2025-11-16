/**
 * VelvetVogue - Hero Background Slider
 * Full-screen image slider with auto-play and Ken Burns effect
 */

(function() {
    'use strict';
    
    // Configuration
    const CONFIG = {
        autoPlay: true,
        autoPlayInterval: 6000,  // 6 seconds per slide
        transitionDuration: 1500, // 1.5 seconds transition
        pauseOnHover: true,
        enableKeyboard: true,
        enableTouch: true
    };
    
    // State
    let currentSlide = 0;
    let totalSlides = 0;
    let autoPlayTimer = null;
    let isPlaying = true;
    let touchStartX = 0;
    let touchEndX = 0;
    
    // DOM Elements
    let slider = null;
    let slides = [];
    let dots = [];
    let prevBtn = null;
    let nextBtn = null;
    
    /**
     * Initialize the slider
     */
    function init() {
        slider = document.getElementById('heroSlider');
        if (!slider) return;
        
        slides = slider.querySelectorAll('.hero__slide');
        totalSlides = slides.length;
        
        if (totalSlides === 0) return;
        
        // Get navigation elements
        const dotsContainer = document.getElementById('heroSliderDots');
        if (dotsContainer) {
            dots = dotsContainer.querySelectorAll('.hero__slider-dot');
        }
        
        prevBtn = document.getElementById('heroSliderPrev');
        nextBtn = document.getElementById('heroSliderNext');
        
        // Set first slide as active
        showSlide(0);
        
        // Setup controls
        setupControls();
        
        // Start autoplay
        if (CONFIG.autoPlay && totalSlides > 1) {
            startAutoPlay();
        }
        
        // Setup touch events
        if (CONFIG.enableTouch) {
            setupTouchEvents();
        }
        
        // Setup keyboard navigation
        if (CONFIG.enableKeyboard) {
            setupKeyboardNavigation();
        }
        
        // Pause on hover
        if (CONFIG.pauseOnHover) {
            setupPauseOnHover();
        }
    }
    
    /**
     * Show specific slide
     * @param {number} index - Slide index to show
     */
    function showSlide(index) {
        // Validate index
        if (index < 0) {
            index = totalSlides - 1;
        } else if (index >= totalSlides) {
            index = 0;
        }
        
        // Remove active class from all slides
        slides.forEach(slide => {
            slide.classList.remove('hero__slide--active');
        });
        
        // Add active class to current slide
        slides[index].classList.add('hero__slide--active');
        
        // Update dots
        updateDots(index);
        
        // Update current slide index
        currentSlide = index;
    }
    
    /**
     * Update navigation dots
     * @param {number} activeIndex - Currently active slide index
     */
    function updateDots(activeIndex) {
        dots.forEach((dot, index) => {
            if (index === activeIndex) {
                dot.classList.add('hero__slider-dot--active');
            } else {
                dot.classList.remove('hero__slider-dot--active');
            }
        });
    }
    
    /**
     * Go to next slide
     */
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    /**
     * Go to previous slide
     */
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    /**
     * Go to specific slide
     * @param {number} index - Slide index
     */
    function goToSlide(index) {
        showSlide(index);
        resetAutoPlay();
    }
    
    /**
     * Setup control buttons and dots
     */
    function setupControls() {
        // Next button
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoPlay();
            });
        }
        
        // Previous button
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoPlay();
            });
        }
        
        // Dots navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
            });
        });
    }
    
    /**
     * Start auto-play
     */
    function startAutoPlay() {
        if (autoPlayTimer) return;
        
        isPlaying = true;
        autoPlayTimer = setInterval(() => {
            nextSlide();
        }, CONFIG.autoPlayInterval);
    }
    
    /**
     * Stop auto-play
     */
    function stopAutoPlay() {
        if (autoPlayTimer) {
            clearInterval(autoPlayTimer);
            autoPlayTimer = null;
        }
        isPlaying = false;
    }
    
    /**
     * Reset auto-play timer
     */
    function resetAutoPlay() {
        if (CONFIG.autoPlay) {
            stopAutoPlay();
            startAutoPlay();
        }
    }
    
    /**
     * Setup pause on hover
     */
    function setupPauseOnHover() {
        const hero = document.querySelector('.hero');
        if (!hero) return;
        
        hero.addEventListener('mouseenter', () => {
            if (isPlaying) {
                stopAutoPlay();
            }
        });
        
        hero.addEventListener('mouseleave', () => {
            if (CONFIG.autoPlay && !isPlaying) {
                startAutoPlay();
            }
        });
    }
    
    /**
     * Setup touch/swipe events for mobile
     */
    function setupTouchEvents() {
        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }
    
    /**
     * Handle swipe gesture
     */
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next slide
                nextSlide();
            } else {
                // Swipe right - previous slide
                prevSlide();
            }
            resetAutoPlay();
        }
    }
    
    /**
     * Setup keyboard navigation
     */
    function setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // Only if hero is in viewport
            const hero = document.querySelector('.hero');
            if (!hero) return;
            
            const rect = hero.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (!isVisible) return;
            
            switch (e.key) {
                case 'ArrowLeft':
                    prevSlide();
                    resetAutoPlay();
                    break;
                case 'ArrowRight':
                    nextSlide();
                    resetAutoPlay();
                    break;
            }
        });
    }
    
    /**
     * Preload images for smooth transitions
     */
    function preloadImages() {
        slides.forEach(slide => {
            const img = slide.querySelector('img');
            if (img && img.dataset.src) {
                const preloadImg = new Image();
                preloadImg.src = img.dataset.src;
            }
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Expose methods globally
    window.VelvetVogueSlider = {
        next: nextSlide,
        prev: prevSlide,
        goTo: goToSlide,
        play: startAutoPlay,
        pause: stopAutoPlay
    };
    
})();