/**
 * VelvetVogue - Loading Screen Controller
 * Manages loading animation, progress simulation, and transition to home page
 */

(function() {
    'use strict';
    
    // Configuration
    const CONFIG = {
        minLoadTime: 2800,           // Minimum loading time in ms
        progressUpdateInterval: 50,   // Progress update frequency in ms
        redirectUrl: 'home.php',     // Page to load after loading screen
        storageKey: 'vv_loaded',     // Session storage key
        skipOnRevisit: false         // Skip loading on revisit (within session)
    };
    
    // DOM Elements
    let progressFill = null;
    let progressText = null;
    let loadingScreen = null;
    
    // State
    let currentProgress = 0;
    let targetProgress = 0;
    let progressInterval = null;
    let startTime = Date.now();
    
    /**
     * Initialize the loading screen
     */
    function init() {
        // Get DOM elements
        progressFill = document.getElementById('progressFill');
        progressText = document.getElementById('progressText');
        loadingScreen = document.getElementById('loadingScreen');
        
        if (!loadingScreen) {
            console.error('Loading screen element not found');
            return;
        }
        
        // Check if we should skip loading (revisit)
        if (CONFIG.skipOnRevisit && sessionStorage.getItem(CONFIG.storageKey)) {
            redirectToHome();
            return;
        }
        
        // Start the loading sequence
        startLoadingSequence();
    }
    
    /**
     * Start the main loading sequence
     */
    function startLoadingSequence() {
        // Simulate resource loading
        simulateResourceLoading();
        
        // Start progress animation
        startProgressAnimation();
        
        // Set minimum load time
        setTimeout(completeLoading, CONFIG.minLoadTime);
    }
    
    /**
     * Simulate resource loading with realistic progress
     */
    function simulateResourceLoading() {
        // Simulate different loading phases
        const phases = [
            { progress: 15, delay: 300, label: 'Initializing...' },
            { progress: 30, delay: 600, label: 'Loading assets...' },
            { progress: 50, delay: 1000, label: 'Preparing styles...' },
            { progress: 70, delay: 1400, label: 'Loading fonts...' },
            { progress: 85, delay: 1800, label: 'Finalizing...' },
            { progress: 95, delay: 2200, label: 'Almost ready...' },
            { progress: 100, delay: 2600, label: 'Complete' }
        ];
        
        phases.forEach(phase => {
            setTimeout(() => {
                targetProgress = phase.progress;
            }, phase.delay);
        });
    }
    
    /**
     * Animate the progress bar smoothly
     */
    function startProgressAnimation() {
        progressInterval = setInterval(() => {
            if (currentProgress < targetProgress) {
                // Smooth easing towards target
                const diff = targetProgress - currentProgress;
                const increment = Math.max(0.5, diff * 0.1);
                currentProgress = Math.min(targetProgress, currentProgress + increment);
                
                updateProgressUI(currentProgress);
            }
        }, CONFIG.progressUpdateInterval);
    }
    
    /**
     * Update the progress bar UI
     * @param {number} progress - Current progress percentage
     */
    function updateProgressUI(progress) {
        const roundedProgress = Math.round(progress);
        
        if (progressFill) {
            progressFill.style.width = `${roundedProgress}%`;
        }
        
        if (progressText) {
            progressText.textContent = `${roundedProgress}%`;
        }
    }
    
    /**
     * Complete the loading process
     */
    function completeLoading() {
        // Ensure progress reaches 100%
        targetProgress = 100;
        
        // Wait for progress to complete, then fade out
        const checkComplete = setInterval(() => {
            if (currentProgress >= 99) {
                clearInterval(checkComplete);
                clearInterval(progressInterval);
                
                // Update to 100%
                updateProgressUI(100);
                
                // Start fade out after small delay
                setTimeout(() => {
                    fadeOutAndRedirect();
                }, 200);
            }
        }, 50);
    }
    
    /**
     * Fade out the loading screen and redirect
     */
    function fadeOutAndRedirect() {
        if (loadingScreen) {
            // Add fade-out class for animation
            loadingScreen.classList.add('fade-out');
            
            // Mark as loaded in session storage
            if (CONFIG.skipOnRevisit) {
                sessionStorage.setItem(CONFIG.storageKey, 'true');
            }
            
            // Redirect after animation completes
            setTimeout(() => {
                redirectToHome();
            }, 800);
        }
    }
    
    /**
     * Redirect to home page
     */
    function redirectToHome() {
        window.location.href = CONFIG.redirectUrl;
    }
    
    /**
     * Preload critical resources
     */
    function preloadResources() {
        // Preload fonts
        const fonts = [
            'https://fonts.googleapis.com/css2?family=Allura&display=swap',
            'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap',
            'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap',
            'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&display=swap'
        ];
        
        fonts.forEach(font => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'style';
            link.href = font;
            document.head.appendChild(link);
        });
        
        // Preload next page
        const preloadPage = document.createElement('link');
        preloadPage.rel = 'prefetch';
        preloadPage.href = CONFIG.redirectUrl;
        document.head.appendChild(preloadPage);
    }
    
    /**
     * Handle visibility change (user switches tabs)
     */
    function handleVisibilityChange() {
        if (document.hidden) {
            // Pause progress animation when tab is hidden
            clearInterval(progressInterval);
        } else {
            // Resume when tab is visible
            startProgressAnimation();
        }
    }
    
    /**
     * Setup event listeners
     */
    function setupEventListeners() {
        // Handle page visibility changes
        document.addEventListener('visibilitychange', handleVisibilityChange);
        
        // Handle escape key to skip loading (optional)
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && currentProgress > 50) {
                completeLoading();
            }
        });
        
        // Click to skip (optional - for development)
        if (loadingScreen) {
            loadingScreen.addEventListener('click', () => {
                if (currentProgress > 70) {
                    completeLoading();
                }
            });
        }
    }
    
    /**
     * Clean up resources
     */
    function cleanup() {
        clearInterval(progressInterval);
        document.removeEventListener('visibilitychange', handleVisibilityChange);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            preloadResources();
            setupEventListeners();
            init();
        });
    } else {
        // DOM already loaded
        preloadResources();
        setupEventListeners();
        init();
    }
    
    // Clean up on page unload
    window.addEventListener('beforeunload', cleanup);
    
})();