<?php
/**
 * VelvetVogue - Main Entry Point
 * Redirects to loading screen on first visit
 * Premium Fashion E-Commerce - Sri Lanka
 */

// Define constant to prevent direct access to config files
define('VELVETVOGUE', true);

// Include configuration
require_once __DIR__ . '/config/config.php';

// Check if loading screen should be shown
if (SHOW_LOADING_SCREEN) {
    // Check if user has already seen loading screen in this session
    if (!isset($_SESSION['vv_loading_shown'])) {
        // Mark as shown
        $_SESSION['vv_loading_shown'] = true;
        
        // Redirect to loading screen
        redirect('loading.php');
    }
}

// If loading screen already shown or disabled, go to home
redirect('home.php');