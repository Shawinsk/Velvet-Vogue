<?php
/**
 * VelvetVogue - Main Configuration File
 * Premium Fashion E-Commerce Website
 * Sri Lankan Edition
 */

// Prevent direct access
if (!defined('VELVETVOGUE')) {
    define('VELVETVOGUE', true);
}

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Site Information
define('SITE_NAME', 'VelvetVogue');
define('SITE_TAGLINE', 'Crafting the Language of Luxury');

// Dynamic Site URL Detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim($scriptPath, '/');
define('SITE_URL', $protocol . '://' . $host . $basePath);

define('SITE_VERSION', '1.0.0');

// File Paths
define('ROOT_PATH', dirname(__DIR__) . '/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('ASSETS_PATH', ROOT_PATH . 'assets/');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
define('UPLOADS_PATH', ROOT_PATH . 'uploads/');
define('API_PATH', ROOT_PATH . 'api/');

// Asset URLs
define('ASSETS_URL', SITE_URL . '/assets/');
define('CSS_URL', ASSETS_URL . 'css/');
define('JS_URL', ASSETS_URL . 'js/');
define('IMAGES_URL', ASSETS_URL . 'images/');
define('FONTS_URL', ASSETS_URL . 'fonts/');

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 in production with HTTPS
session_start();

// Timezone (Sri Lanka)
date_default_timezone_set('Asia/Colombo');

// Security Configuration
define('CSRF_TOKEN_NAME', 'vv_csrf_token');
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 minutes

// Password Requirements
define('MIN_PASSWORD_LENGTH', 8);
define('REQUIRE_UPPERCASE', true);
define('REQUIRE_LOWERCASE', true);
define('REQUIRE_NUMBER', true);
define('REQUIRE_SPECIAL', false);

// File Upload Settings
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_IMAGE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Pagination
define('PRODUCTS_PER_PAGE', 12);
define('REVIEWS_PER_PAGE', 10);
define('ORDERS_PER_PAGE', 20);

// Cart Settings
define('CART_SESSION_KEY', 'vv_cart');
define('MAX_CART_ITEMS', 50);
define('MAX_QUANTITY_PER_ITEM', 10);

// Email Configuration
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'info@velvetvogue.lk');
define('MAIL_PASSWORD', 'your_password_here');
define('MAIL_FROM_EMAIL', 'info@velvetvogue.lk');
define('MAIL_FROM_NAME', 'VelvetVogue Sri Lanka');
define('MAIL_ENCRYPTION', 'tls');

// Google Maps API
define('GOOGLE_MAPS_API_KEY', 'your_google_maps_api_key_here');

// Social Media URLs
define('FACEBOOK_URL', 'https://facebook.com/velvetvogue');
define('INSTAGRAM_URL', 'https://instagram.com/velvetvogue');
define('TWITTER_URL', 'https://twitter.com/velvetvogue');
define('PINTEREST_URL', 'https://pinterest.com/velvetvogue');

// Analytics
define('GA_TRACKING_ID', 'UA-XXXXXXXXX-X');

// Loading Screen Settings
define('LOADING_DURATION', 2800); // milliseconds
define('SHOW_LOADING_SCREEN', true);
define('LOADING_REDIRECT_URL', 'home.php');

// Cache Settings
define('ENABLE_CACHE', false);
define('CACHE_DURATION', 3600);

// Debug Mode
define('DEBUG_MODE', true);

// Include localization settings
require_once CONFIG_PATH . 'localization.php';

// Generate CSRF Token if not exists
if (empty($_SESSION[CSRF_TOKEN_NAME])) {
    $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
}

/**
 * Get CSRF Token
 */
function get_csrf_token() {
    return $_SESSION[CSRF_TOKEN_NAME] ?? '';
}

/**
 * Verify CSRF Token
 */
function verify_csrf_token($token) {
    return hash_equals($_SESSION[CSRF_TOKEN_NAME] ?? '', $token);
}

/**
 * Clean input data
 */
function clean_input($data) {
    if (is_array($data)) {
        return array_map('clean_input', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Redirect to URL
 */
function redirect($url, $status = 302) {
    header("Location: $url", true, $status);
    exit;
}

/**
 * Check if request is AJAX
 */
function is_ajax_request() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Generate random string
 */
function generate_random_string($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Format date for display
 */
function format_date($date, $format = 'd M Y') {
    return date($format, strtotime($date));
}