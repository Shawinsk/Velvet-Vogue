<?php
/**
 * VelvetVogue - Sri Lankan Localization Settings
 * Currency, Districts, Shipping Zones, Contact Info
 */

// Prevent direct access
if (!defined('VELVETVOGUE')) {
    die('Direct access not permitted');
}

// =====================================================
// CURRENCY SETTINGS
// =====================================================
define('CURRENCY_CODE', 'LKR');
define('CURRENCY_SYMBOL', 'LKR');
define('CURRENCY_NAME', 'Sri Lankan Rupee');
define('CURRENCY_DECIMALS', 2);
define('CURRENCY_DECIMAL_SEPARATOR', '.');
define('CURRENCY_THOUSAND_SEPARATOR', ',');
define('CURRENCY_POSITION', 'before'); // 'before' or 'after'

// =====================================================
// CONTACT INFORMATION
// =====================================================
define('CONTACT_EMAIL', 'info@velvetvogue.lk');
define('CONTACT_EMAIL_SALES', 'sales@velvetvogue.lk');
define('CONTACT_PHONE', '+94 (0)31 XXX XXXX');
define('CONTACT_PHONE_MOBILE', '+94 7X XXX XXXX');
define('CONTACT_ADDRESS', '123 Galle Road');
define('CONTACT_CITY', 'Negombo');
define('CONTACT_PROVINCE', 'Western Province');
define('CONTACT_COUNTRY', 'Sri Lanka');
define('CONTACT_POSTAL_CODE', '11500');
define('CONTACT_FULL_ADDRESS', CONTACT_ADDRESS . ', ' . CONTACT_CITY . ', ' . CONTACT_PROVINCE . ', ' . CONTACT_COUNTRY);

// Business Hours
define('BUSINESS_HOURS_WEEKDAY', '9:00 AM - 8:00 PM');
define('BUSINESS_HOURS_SUNDAY', '10:00 AM - 6:00 PM');
define('BUSINESS_HOURS_HOLIDAY', 'Closed');

// =====================================================
// SHIPPING SETTINGS
// =====================================================
define('FREE_SHIPPING_THRESHOLD', 25000.00); // LKR
define('COD_FEE', 200.00); // Cash on Delivery fee
define('COD_AVAILABLE', true);

// Shipping Zones and Rates
$GLOBALS['SHIPPING_ZONES'] = [
    'colombo_district' => [
        'name' => 'Colombo District',
        'districts' => ['Colombo'],
        'cost' => 500.00,
        'estimated_days' => '1-2 business days',
        'free_shipping' => true
    ],
    'western_province' => [
        'name' => 'Western Province',
        'districts' => ['Colombo', 'Gampaha', 'Kalutara'],
        'cost' => 750.00,
        'estimated_days' => '2-3 business days',
        'free_shipping' => true
    ],
    'island_wide' => [
        'name' => 'Island Wide Delivery',
        'districts' => 'all',
        'cost' => 1000.00,
        'estimated_days' => '3-5 business days',
        'free_shipping' => true
    ]
];

// =====================================================
// SRI LANKAN PROVINCES
// =====================================================
$GLOBALS['SRI_LANKAN_PROVINCES'] = [
    'Western' => 'Western Province',
    'Central' => 'Central Province',
    'Southern' => 'Southern Province',
    'Northern' => 'Northern Province',
    'Eastern' => 'Eastern Province',
    'North Western' => 'North Western Province',
    'North Central' => 'North Central Province',
    'Uva' => 'Uva Province',
    'Sabaragamuwa' => 'Sabaragamuwa Province'
];

// =====================================================
// SRI LANKAN DISTRICTS BY PROVINCE
// =====================================================
$GLOBALS['SRI_LANKAN_DISTRICTS'] = [
    'Western' => [
        'Colombo' => 'Colombo',
        'Gampaha' => 'Gampaha',
        'Kalutara' => 'Kalutara'
    ],
    'Central' => [
        'Kandy' => 'Kandy',
        'Matale' => 'Matale',
        'Nuwara Eliya' => 'Nuwara Eliya'
    ],
    'Southern' => [
        'Galle' => 'Galle',
        'Matara' => 'Matara',
        'Hambantota' => 'Hambantota'
    ],
    'Northern' => [
        'Jaffna' => 'Jaffna',
        'Kilinochchi' => 'Kilinochchi',
        'Mannar' => 'Mannar',
        'Vavuniya' => 'Vavuniya',
        'Mullaitivu' => 'Mullaitivu'
    ],
    'Eastern' => [
        'Batticaloa' => 'Batticaloa',
        'Ampara' => 'Ampara',
        'Trincomalee' => 'Trincomalee'
    ],
    'North Western' => [
        'Kurunegala' => 'Kurunegala',
        'Puttalam' => 'Puttalam'
    ],
    'North Central' => [
        'Anuradhapura' => 'Anuradhapura',
        'Polonnaruwa' => 'Polonnaruwa'
    ],
    'Uva' => [
        'Badulla' => 'Badulla',
        'Monaragala' => 'Monaragala'
    ],
    'Sabaragamuwa' => [
        'Ratnapura' => 'Ratnapura',
        'Kegalle' => 'Kegalle'
    ]
];

// Flat list of all districts
$GLOBALS['ALL_DISTRICTS'] = [
    'Colombo', 'Gampaha', 'Kalutara',
    'Kandy', 'Matale', 'Nuwara Eliya',
    'Galle', 'Matara', 'Hambantota',
    'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu',
    'Batticaloa', 'Ampara', 'Trincomalee',
    'Kurunegala', 'Puttalam',
    'Anuradhapura', 'Polonnaruwa',
    'Badulla', 'Monaragala',
    'Ratnapura', 'Kegalle'
];

// =====================================================
// HELPER FUNCTIONS
// =====================================================

/**
 * Format price in LKR
 * @param float $amount
 * @param bool $showSymbol
 * @return string
 */
function format_price($amount, $showSymbol = true) {
    $formatted = number_format(
        (float)$amount,
        CURRENCY_DECIMALS,
        CURRENCY_DECIMAL_SEPARATOR,
        CURRENCY_THOUSAND_SEPARATOR
    );
    
    if ($showSymbol) {
        if (CURRENCY_POSITION === 'before') {
            return CURRENCY_SYMBOL . ' ' . $formatted;
        } else {
            return $formatted . ' ' . CURRENCY_SYMBOL;
        }
    }
    
    return $formatted;
}

/**
 * Get shipping cost based on district
 * @param string $district
 * @param float $orderTotal
 * @return float
 */
function get_shipping_cost($district, $orderTotal = 0) {
    // Check for free shipping
    if ($orderTotal >= FREE_SHIPPING_THRESHOLD) {
        return 0.00;
    }
    
    // Check Colombo District
    if ($district === 'Colombo') {
        return $GLOBALS['SHIPPING_ZONES']['colombo_district']['cost'];
    }
    
    // Check Western Province
    $westernDistricts = $GLOBALS['SHIPPING_ZONES']['western_province']['districts'];
    if (in_array($district, $westernDistricts)) {
        return $GLOBALS['SHIPPING_ZONES']['western_province']['cost'];
    }
    
    // Island Wide
    return $GLOBALS['SHIPPING_ZONES']['island_wide']['cost'];
}

/**
 * Get estimated delivery time
 * @param string $district
 * @return string
 */
function get_delivery_estimate($district) {
    if ($district === 'Colombo') {
        return $GLOBALS['SHIPPING_ZONES']['colombo_district']['estimated_days'];
    }
    
    $westernDistricts = $GLOBALS['SHIPPING_ZONES']['western_province']['districts'];
    if (in_array($district, $westernDistricts)) {
        return $GLOBALS['SHIPPING_ZONES']['western_province']['estimated_days'];
    }
    
    return $GLOBALS['SHIPPING_ZONES']['island_wide']['estimated_days'];
}

/**
 * Get province by district
 * @param string $district
 * @return string|null
 */
function get_province_by_district($district) {
    foreach ($GLOBALS['SRI_LANKAN_DISTRICTS'] as $province => $districts) {
        if (array_key_exists($district, $districts)) {
            return $province;
        }
    }
    return null;
}

/**
 * Validate Sri Lankan phone number
 * @param string $phone
 * @return bool
 */
function validate_lk_phone($phone) {
    // Remove spaces and dashes
    $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
    
    // Check for valid Sri Lankan formats
    // +94XXXXXXXXX or 0XXXXXXXXX
    if (preg_match('/^(\+94|0)[0-9]{9}$/', $phone)) {
        return true;
    }
    
    return false;
}

/**
 * Format Sri Lankan phone number
 * @param string $phone
 * @return string
 */
function format_lk_phone($phone) {
    $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
    
    // Convert to +94 format
    if (substr($phone, 0, 1) === '0') {
        $phone = '+94' . substr($phone, 1);
    }
    
    // Format as +94 (0)XX XXX XXXX
    if (strlen($phone) === 12 && substr($phone, 0, 3) === '+94') {
        $area = substr($phone, 3, 2);
        $first = substr($phone, 5, 3);
        $second = substr($phone, 8, 4);
        return "+94 (0){$area} {$first} {$second}";
    }
    
    return $phone;
}

/**
 * Get all districts as flat array for dropdowns
 * @return array
 */
function get_all_districts() {
    return $GLOBALS['ALL_DISTRICTS'];
}

/**
 * Get districts grouped by province
 * @return array
 */
function get_districts_by_province() {
    return $GLOBALS['SRI_LANKAN_DISTRICTS'];
}

/**
 * Check if COD is available for district
 * @param string $district
 * @return bool
 */
function is_cod_available($district) {
    // COD available for all districts
    return COD_AVAILABLE;
}

/**
 * Get COD fee
 * @return float
 */
function get_cod_fee() {
    return COD_FEE;
}

/**
 * Calculate order total with shipping and COD
 * @param float $subtotal
 * @param string $district
 * @param bool $isCOD
 * @return array
 */
function calculate_order_total($subtotal, $district, $isCOD = false) {
    $shipping = get_shipping_cost($district, $subtotal);
    $codFee = $isCOD ? get_cod_fee() : 0;
    $total = $subtotal + $shipping + $codFee;
    
    return [
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'cod_fee' => $codFee,
        'total' => $total,
        'free_shipping' => $shipping === 0,
        'delivery_estimate' => get_delivery_estimate($district)
    ];
}