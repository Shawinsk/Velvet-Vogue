<?php
/**
 * VelvetVogue - Home Page
 * Premium Fashion E-Commerce - Sri Lanka
 * Complete landing page with all sections
 */

// Define constant
define('VELVETVOGUE', true);

// Include configuration
require_once __DIR__ . '/config/config.php';

// Page specific variables
$pageTitle = 'Premium Fashion Sri Lanka';
$pageDescription = 'Discover timeless luxury and modern elegance at VelvetVogue. Premium fashion e-commerce in Sri Lanka.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title><?php echo SITE_NAME; ?> - <?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="luxury fashion, premium clothing, Sri Lanka, designer wear, VelvetVogue, Negombo">
    <meta name="author" content="VelvetVogue (Pvt) Ltd">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    <meta property="og:title" content="<?php echo SITE_NAME; ?> - <?php echo $pageTitle; ?>">
    <meta property="og:description" content="<?php echo $pageDescription; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_URL; ?>favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo IMAGES_URL; ?>apple-touch-icon.png">
    
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>reset.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>variables.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>global.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>navigation.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>home.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>footer.css">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#0A0A0A">
    
    <!-- Additional Inline Styles for Components -->
    <style>
        /* Toast Notifications */
        .toast {
            position: fixed;
            top: var(--space-xl);
            right: var(--space-xl);
            padding: var(--space-md) var(--space-lg);
            background: var(--secondary-bg);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-xl);
            z-index: var(--z-toast);
            transform: translateX(120%);
            transition: transform var(--transition-base);
            border-left: 4px solid var(--accent-rose-gold);
        }
        .toast--show { transform: translateX(0); }
        .toast--success { border-left-color: var(--success); }
        .toast--error { border-left-color: var(--error); }
        .toast__content {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            color: var(--text-primary);
            font-size: var(--text-sm);
        }
        .toast__icon { font-size: var(--text-lg); }
        
        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: var(--z-modal);
            display: none;
        }
        .modal--open {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
        }
        .modal__content {
            position: relative;
            background: var(--secondary-bg);
            border-radius: var(--radius-lg);
            max-width: 900px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            padding: var(--space-2xl);
        }
        .modal__close {
            position: absolute;
            top: var(--space-md);
            right: var(--space-md);
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: var(--text-2xl);
            cursor: pointer;
        }
        .modal__close:hover { color: var(--accent-rose-gold); }
        .quick-view__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-xl);
        }
        .quick-view__img-placeholder {
            width: 100%;
            aspect-ratio: 3/4;
            background: var(--tertiary-bg);
            border-radius: var(--radius-md);
        }
        .quick-view__name {
            font-family: var(--font-heading);
            font-size: var(--text-2xl);
            margin-bottom: var(--space-md);
        }
        .quick-view__price {
            font-size: var(--text-xl);
            color: var(--accent-rose-gold);
            font-weight: 600;
            margin-bottom: var(--space-md);
        }
        .quick-view__description {
            color: var(--text-secondary);
            margin-bottom: var(--space-lg);
        }
        .size-options { display: flex; gap: var(--space-sm); }
        .size-btn {
            padding: var(--space-sm) var(--space-md);
            background: var(--tertiary-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all var(--transition-base);
        }
        .size-btn:hover, .size-btn--active {
            background: var(--accent-rose-gold);
            color: white;
            border-color: var(--accent-rose-gold);
        }
        .quick-view__loading {
            text-align: center;
            padding: var(--space-3xl);
            color: var(--text-muted);
        }
        @media (max-width: 768px) {
            .quick-view__grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- HEADER / NAVIGATION -->
    <header id="header" class="header">
        <div class="header__container">
            <a href="index.php" class="header__logo">VelvetVogue</a>
            
            <nav class="nav">
                <button id="navToggle" class="nav__toggle" aria-label="Toggle menu" aria-expanded="false">
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                </button>
                
                <ul id="navMenu" class="nav__menu">
                    <li class="nav__item"><a href="shop.php" class="nav__link">Shop</a></li>
                    <li class="nav__item nav__item--dropdown">
                        <a href="shop.php?category=collections" class="nav__link">Collections</a>
                        <div class="nav__dropdown">
                            <a href="shop.php?category=new" class="nav__dropdown-link">New Arrivals</a>
                            <a href="shop.php?category=bestsellers" class="nav__dropdown-link">Bestsellers</a>
                            <a href="shop.php?category=sale" class="nav__dropdown-link">Sale</a>
                        </div>
                    </li>
                    <li class="nav__item"><a href="shop.php?category=designers" class="nav__link">Designers</a></li>
                    <li class="nav__item"><a href="about.php" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="contact.php" class="nav__link">Contact</a></li>
                </ul>
            </nav>
            
            <div class="header__actions">
                <button class="header__action" aria-label="Search">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
                <button class="header__action" aria-label="Account">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </button>
                <button class="header__action" aria-label="Cart" onclick="window.location.href='cart.php'">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span class="header__cart-badge" style="display: none;">0</span>
                </button>
            </div>
        </div>
    </header>
    
    <!-- HERO SECTION -->
    <section class="hero">
        <!-- Background Image Slider -->
        <div id="heroSlider" class="hero__slider">
            <!-- Slide 1 - Fashion Model -->
            <div class="hero__slide hero__slide--active" style="background-image: url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920&q=80');">
            </div>
            
            <!-- Slide 2 - Luxury Store -->
            <div class="hero__slide" style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1920&q=80');">
            </div>
            
            <!-- Slide 3 - Fashion Accessories -->
            <div class="hero__slide" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1920&q=80');">
            </div>
            
            <!-- Slide 4 - Elegant Dress -->
            <div class="hero__slide" style="background-image: url('https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=1920&q=80');">
            </div>
            
            <!-- Slide 5 - Premium Fashion -->
            <div class="hero__slide" style="background-image: url('https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1920&q=80');">
            </div>
        </div>
        
        <!-- Slider Navigation Arrows -->
        <button id="heroSliderPrev" class="hero__slider-arrow hero__slider-arrow--prev" aria-label="Previous slide">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button id="heroSliderNext" class="hero__slider-arrow hero__slider-arrow--next" aria-label="Next slide">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
        
        <!-- Slider Dots -->
        <div id="heroSliderDots" class="hero__slider-dots">
            <button class="hero__slider-dot hero__slider-dot--active" aria-label="Go to slide 1"></button>
            <button class="hero__slider-dot" aria-label="Go to slide 2"></button>
            <button class="hero__slider-dot" aria-label="Go to slide 3"></button>
            <button class="hero__slider-dot" aria-label="Go to slide 4"></button>
            <button class="hero__slider-dot" aria-label="Go to slide 5"></button>
        </div>
        
        <div class="hero__background"></div>
        <div class="hero__content">
            <h1 class="hero__logo">VelvetVogue</h1>
            <h2 class="hero__title">Timeless Luxury, Modern Elegance</h2>
            <p class="hero__subtitle">
                Discover premium fashion crafted for the discerning Sri Lankan. 
                Where tradition meets contemporary sophistication.
            </p>
            <div class="hero__cta">
                <a href="shop.php" class="btn btn--primary btn--large">Explore Collections</a>
            </div>
        </div>
        <div class="hero__scroll">
            <div class="hero__scroll-icon"></div>
        </div>
    </section>
    
    <!-- FEATURED PRODUCTS -->
    <section class="featured">
        <div class="container">
            <div class="featured__header">
                <h2 class="featured__title">Featured Collection</h2>
                <p class="featured__subtitle">Handpicked pieces for the season</p>
            </div>
            
            <div class="featured__grid">
                <!-- Product 1 -->
                <div class="product-card">
                    <div class="product-card__image">
                        <div class="product-card__img" style="background: linear-gradient(135deg, #2A2A2A, #1A1A1A); width: 100%; height: 100%;"></div>
                        <span class="product-card__badge product-card__badge--new">New</span>
                        <div class="product-card__actions">
                            <button class="product-card__action-btn" onclick="VelvetVogue.addToWishlist(1)" title="Wishlist">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            </button>
                            <button class="product-card__action-btn" onclick="window.location.href='product.php?id=1'" title="Quick View">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="product-card__quick-view" onclick="window.location.href='product.php?id=1'">Quick View</div>
                    </div>
                    <div class="product-card__info">
                        <div class="product-card__category">Dresses</div>
                        <h3 class="product-card__name">Elegant Velvet Evening Gown</h3>
                        <div class="product-card__price">
                            <span class="product-card__current-price"><?php echo format_price(45000); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="product-card">
                    <div class="product-card__image">
                        <div class="product-card__img" style="background: linear-gradient(135deg, #2A2A2A, #1A1A1A); width: 100%; height: 100%;"></div>
                        <div class="product-card__actions">
                            <button class="product-card__action-btn" onclick="VelvetVogue.addToWishlist(2)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            </button>
                            <button class="product-card__action-btn" onclick="window.location.href='product.php?id=2'">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="product-card__quick-view" onclick="window.location.href='product.php?id=2'">Quick View</div>
                    </div>
                    <div class="product-card__info">
                        <div class="product-card__category">Bags</div>
                        <h3 class="product-card__name">Premium Leather Handbag</h3>
                        <div class="product-card__price">
                            <span class="product-card__current-price"><?php echo format_price(32000); ?></span>
                            <span class="product-card__original-price"><?php echo format_price(38000); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="product-card">
                    <div class="product-card__image">
                        <div class="product-card__img" style="background: linear-gradient(135deg, #2A2A2A, #1A1A1A); width: 100%; height: 100%;"></div>
                        <span class="product-card__badge product-card__badge--sale">Sale</span>
                        <div class="product-card__actions">
                            <button class="product-card__action-btn" onclick="VelvetVogue.addToWishlist(3)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            </button>
                            <button class="product-card__action-btn" onclick="window.location.href='product.php?id=3'">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="product-card__quick-view" onclick="window.location.href='product.php?id=3'">Quick View</div>
                    </div>
                    <div class="product-card__info">
                        <div class="product-card__category">Shoes</div>
                        <h3 class="product-card__name">Stiletto Heels - Rose Gold</h3>
                        <div class="product-card__price">
                            <span class="product-card__current-price"><?php echo format_price(18500); ?></span>
                            <span class="product-card__original-price"><?php echo format_price(24000); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="product-card">
                    <div class="product-card__image">
                        <div class="product-card__img" style="background: linear-gradient(135deg, #2A2A2A, #1A1A1A); width: 100%; height: 100%;"></div>
                        <div class="product-card__actions">
                            <button class="product-card__action-btn" onclick="VelvetVogue.addToWishlist(4)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            </button>
                            <button class="product-card__action-btn" onclick="window.location.href='product.php?id=4'">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="product-card__quick-view" onclick="window.location.href='product.php?id=4'">Quick View</div>
                    </div>
                    <div class="product-card__info">
                        <div class="product-card__category">Accessories</div>
                        <h3 class="product-card__name">Pearl Statement Necklace</h3>
                        <div class="product-card__price">
                            <span class="product-card__current-price"><?php echo format_price(15000); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="shop.php" class="btn btn--secondary">View All Products</a>
            </div>
        </div>
    </section>
    
    <!-- CATEGORIES -->
    <section class="categories">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Shop by Category</h2>
                <p class="section__subtitle">Explore our curated collections</p>
            </div>
            
            <div class="categories__grid">
                <a href="shop.php?category=clothing" class="category-card">
                    <div class="category-card__image">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3A3A3A, #1A1A1A);"></div>
                    </div>
                    <div class="category-card__overlay"></div>
                    <div class="category-card__content">
                        <h3 class="category-card__title">Clothing</h3>
                        <span class="category-card__count">120+ Products</span>
                    </div>
                </a>
                
                <a href="shop.php?category=shoes" class="category-card">
                    <div class="category-card__image">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3A3A3A, #1A1A1A);"></div>
                    </div>
                    <div class="category-card__overlay"></div>
                    <div class="category-card__content">
                        <h3 class="category-card__title">Shoes</h3>
                        <span class="category-card__count">85+ Products</span>
                    </div>
                </a>
                
                <a href="shop.php?category=accessories" class="category-card">
                    <div class="category-card__image">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3A3A3A, #1A1A1A);"></div>
                    </div>
                    <div class="category-card__overlay"></div>
                    <div class="category-card__content">
                        <h3 class="category-card__title">Accessories</h3>
                        <span class="category-card__count">200+ Products</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <!-- NEWSLETTER -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter__content">
                <h2 class="newsletter__title">Join the VelvetVogue Family</h2>
                <p class="newsletter__text">
                    Subscribe to receive exclusive offers, early access to new collections, 
                    and styling tips delivered to your inbox.
                </p>
                <form id="newsletterForm" class="newsletter__form">
                    <input type="email" class="newsletter__input" placeholder="Enter your email address" required>
                    <button type="submit" class="newsletter__btn">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer__main">
            <div class="container">
                <div class="footer__grid">
                    <div class="footer__brand">
                        <div class="footer__logo">VelvetVogue</div>
                        <p class="footer__description">
                            Crafting the language of luxury since 2020. Premium fashion for the modern Sri Lankan, 
                            where timeless elegance meets contemporary sophistication.
                        </p>
                        <div class="footer__social">
                            <a href="<?php echo INSTAGRAM_URL; ?>" class="footer__social-link" target="_blank" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </a>
                            <a href="<?php echo FACEBOOK_URL; ?>" class="footer__social-link" target="_blank" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                            <a href="<?php echo TWITTER_URL; ?>" class="footer__social-link" target="_blank" aria-label="Twitter">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                            </a>
                            <a href="<?php echo PINTEREST_URL; ?>" class="footer__social-link" target="_blank" aria-label="Pinterest">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12a4 4 0 1 1 8 0c0 2-2 3-2 3"/><line x1="12" y1="17" x2="12" y2="17.01"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="footer__column">
                        <h4 class="footer__title">Quick Links</h4>
                        <ul class="footer__links">
                            <li class="footer__link"><a href="shop.php">Shop All</a></li>
                            <li class="footer__link"><a href="shop.php?category=new">New Arrivals</a></li>
                            <li class="footer__link"><a href="shop.php?category=bestsellers">Bestsellers</a></li>
                            <li class="footer__link"><a href="shop.php?category=sale">Sale</a></li>
                            <li class="footer__link"><a href="about.php">About Us</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer__column">
                        <h4 class="footer__title">Customer Service</h4>
                        <ul class="footer__links">
                            <li class="footer__link"><a href="contact.php">Contact Us</a></li>
                            <li class="footer__link"><a href="shipping.php">Shipping Info</a></li>
                            <li class="footer__link"><a href="returns.php">Returns & Exchanges</a></li>
                            <li class="footer__link"><a href="faq.php">FAQ</a></li>
                            <li class="footer__link"><a href="size-guide.php">Size Guide</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer__column">
                        <h4 class="footer__title">Contact (Sri Lanka)</h4>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">📧</span>
                            <div class="footer__contact-text">
                                <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                            </div>
                        </div>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">📞</span>
                            <div class="footer__contact-text"><?php echo CONTACT_PHONE; ?></div>
                        </div>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">📍</span>
                            <div class="footer__contact-text">
                                <?php echo CONTACT_ADDRESS; ?><br>
                                <?php echo CONTACT_CITY; ?>, <?php echo CONTACT_PROVINCE; ?>
                            </div>
                        </div>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">🕐</span>
                            <div class="footer__contact-text">
                                Mon-Sat: <?php echo BUSINESS_HOURS_WEEKDAY; ?><br>
                                Sun: <?php echo BUSINESS_HOURS_SUNDAY; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-content">
                    <div class="footer__copyright">
                        © <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> (Pvt) Ltd • Sri Lanka 🇱🇰
                    </div>
                    <div class="footer__payments">
                        <div class="footer__payment-icon">VISA</div>
                        <div class="footer__payment-icon">MC</div>
                        <div class="footer__payment-icon">AMEX</div>
                        <div class="footer__payment-icon">COD</div>
                    </div>
                    <div class="footer__legal">
                        <a href="terms.php" class="footer__legal-link">Terms</a>
                        <a href="privacy.php" class="footer__legal-link">Privacy</a>
                        <a href="cookies.php" class="footer__legal-link">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
    
    <!-- JavaScript -->
    <script src="<?php echo JS_URL; ?>navigation.js"></script>
    <script src="<?php echo JS_URL; ?>hero-slider.js"></script>
    <script src="<?php echo JS_URL; ?>main.js"></script>
</body>
</html>