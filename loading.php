<?php
/**
 * VelvetVogue - Loading Screen
 * Sophisticated loading experience with brand identity
 * Premium Fashion E-Commerce - Sri Lanka
 */

// Define constant
define('VELVETVOGUE', true);

// Include configuration
require_once __DIR__ . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title><?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?></title>
    <meta name="description" content="VelvetVogue - Premium luxury fashion e-commerce in Sri Lanka. Discover timeless elegance and modern sophistication.">
    <meta name="keywords" content="luxury fashion, premium clothing, Sri Lanka, designer wear, VelvetVogue">
    <meta name="author" content="VelvetVogue (Pvt) Ltd">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    <meta property="og:title" content="<?php echo SITE_NAME; ?> - <?php echo SITE_TAGLINE; ?>">
    <meta property="og:description" content="Premium luxury fashion e-commerce in Sri Lanka">
    <meta property="og:image" content="<?php echo IMAGES_URL; ?>og-image.jpg">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo SITE_NAME; ?>">
    <meta name="twitter:description" content="Premium luxury fashion e-commerce in Sri Lanka">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_URL; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMAGES_URL; ?>favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo IMAGES_URL; ?>apple-touch-icon.png">
    
    <!-- Preload Critical Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>reset.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>variables.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>loading.css">
    
    <!-- Prefetch Home Page -->
    <link rel="prefetch" href="home.php">
    
    <!-- Theme Color for Mobile -->
    <meta name="theme-color" content="#0A0A0A">
    
    <!-- No Index for Loading Page -->
    <meta name="robots" content="noindex, nofollow">
    
    <style>
        /* Critical inline styles for instant render */
        body {
            margin: 0;
            padding: 0;
            background-color: #0A0A0A;
            overflow: hidden;
        }
        
        /* Prevent FOUC */
        .loading-screen {
            opacity: 1;
        }
        
        /* Backup centering styles in case CSS doesn't load */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0A0A0A;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-content {
            text-align: center;
            padding: 32px;
        }
        
        .loading-logo {
            font-family: 'Allura', cursive;
            font-size: 5rem;
            color: #B76E79;
            margin-bottom: 24px;
            text-shadow: 0 2px 10px rgba(183, 110, 121, 0.3);
        }
        
        .loading-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            color: #C4C4C4;
            letter-spacing: 0.05em;
            margin-bottom: 48px;
        }
        
        .loading-progress-container {
            width: 300px;
            max-width: 80vw;
            margin: 0 auto;
        }
        
        .loading-progress-bar {
            width: 100%;
            height: 2px;
            background: #2A2A2A;
            border-radius: 9999px;
            overflow: hidden;
        }
        
        .loading-progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #8B4A56, #B76E79, #D4939F);
            border-radius: 9999px;
            transition: width 0.1s linear;
        }
        
        .loading-progress-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.875rem;
            color: #808080;
            margin-top: 16px;
            letter-spacing: 0.05em;
        }
        
        .loading-badge {
            position: absolute;
            bottom: 48px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            color: #808080;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        
        @media (max-width: 768px) {
            .loading-logo {
                font-size: 4rem;
            }
            .loading-tagline {
                font-size: 1.25rem;
            }
        }
        
        @media (max-width: 480px) {
            .loading-logo {
                font-size: 3rem;
            }
            .loading-tagline {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loadingScreen" class="loading-screen" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" aria-label="Loading VelvetVogue">
        
        <!-- Main Content -->
        <div class="loading-content">
            <!-- Script Logo -->
            <h1 class="loading-logo">
                VelvetVogue
            </h1>
            
            <!-- Tagline -->
            <p class="loading-tagline">
                Crafting the Language of Luxury
            </p>
            
            <!-- Progress Bar -->
            <div class="loading-progress-container">
                <div class="loading-progress-bar">
                    <div id="progressFill" class="loading-progress-fill"></div>
                </div>
                <div id="progressText" class="loading-progress-text">0%</div>
            </div>
        </div>
        
        <!-- Sri Lankan Pride Badge -->
        <div class="loading-badge">
            Proudly Sri Lankan
        </div>
        
    </div>
    
    <!-- Loading Screen Script -->
    <script src="<?php echo JS_URL; ?>loading.js"></script>
    
    <!-- No JavaScript Fallback -->
    <noscript>
        <meta http-equiv="refresh" content="0;url=home.php">
        <style>
            .loading-screen { display: none; }
        </style>
        <div style="background: #0A0A0A; color: #C4C4C4; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; text-align: center; padding: 20px;">
            <div>
                <h1 style="color: #B76E79; font-size: 2rem; margin-bottom: 1rem;">VelvetVogue</h1>
                <p>JavaScript is required for the best experience.</p>
                <p><a href="home.php" style="color: #B76E79;">Click here to continue</a></p>
            </div>
        </div>
    </noscript>
    
    <!-- Accessibility Skip Link (Hidden) -->
    <a href="home.php" class="sr-only" style="position: absolute; left: -9999px;">
        Skip to main content
    </a>
</body>
</html>