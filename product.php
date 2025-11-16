<?php
/**
 * VelvetVogue - Product Details Page
 * Full product view with gallery, details, reviews
 */
define('VELVETVOGUE', true);
require_once __DIR__ . '/config/config.php';

// Get product ID from URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Sample product data (would come from database)
$products = [
    1 => [
        'id' => 1,
        'name' => 'Elegant Velvet Evening Gown',
        'category' => 'Dresses',
        'price' => 45000,
        'original_price' => null,
        'description' => 'Indulge in timeless elegance with our Elegant Velvet Evening Gown. Crafted from premium Italian velvet, this stunning piece features a flattering silhouette that gracefully drapes the body. Perfect for galas, formal dinners, and special occasions.',
        'materials' => '95% Italian Velvet, 5% Elastane. Dry clean only.',
        'shipping' => 'Free shipping on orders over LKR 25,000. Standard delivery: 3-5 business days within Sri Lanka.',
        'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
        'colors' => ['#000000', '#8B0000', '#1E3A5F'],
        'color_names' => ['Black', 'Burgundy', 'Navy'],
        'stock' => 12,
        'rating' => 4.8,
        'reviews_count' => 24
    ],
    2 => [
        'id' => 2,
        'name' => 'Premium Leather Handbag',
        'category' => 'Bags',
        'price' => 32000,
        'original_price' => 38000,
        'description' => 'A sophisticated leather handbag that combines functionality with luxury. Features multiple compartments, premium hardware, and timeless design.',
        'materials' => '100% Genuine Leather. Wipe with dry cloth.',
        'shipping' => 'Free shipping on orders over LKR 25,000. Standard delivery: 3-5 business days within Sri Lanka.',
        'sizes' => ['One Size'],
        'colors' => ['#8B4513', '#000000', '#B76E79'],
        'color_names' => ['Brown', 'Black', 'Rose Gold'],
        'stock' => 8,
        'rating' => 4.9,
        'reviews_count' => 31
    ]
];

$product = isset($products[$productId]) ? $products[$productId] : $products[1];
$pageTitle = $product['name'];

// Sample reviews
$reviews = [
    [
        'name' => 'Priya Fernando',
        'rating' => 5,
        'date' => '2 weeks ago',
        'verified' => true,
        'comment' => 'Excellent quality velvet! The fit is perfect and the color is exactly as shown. Highly recommend for special occasions.',
        'helpful' => 8
    ],
    [
        'name' => 'Amara Silva',
        'rating' => 5,
        'date' => '1 month ago',
        'verified' => true,
        'comment' => 'Absolutely stunning dress. Received so many compliments at the wedding I attended. The fabric quality is superb.',
        'helpful' => 12
    ],
    [
        'name' => 'Dilani Perera',
        'rating' => 4,
        'date' => '1 month ago',
        'verified' => true,
        'comment' => 'Beautiful dress, runs slightly large. Would recommend sizing down. Delivery was prompt.',
        'helpful' => 5
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo $pageTitle; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>reset.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>variables.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>global.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>navigation.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>product.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>footer.css">
</head>
<body>
    <!-- HEADER -->
    <header id="header" class="header" style="background: rgba(10, 10, 10, 0.98); backdrop-filter: blur(20px);">
        <div class="header__container">
            <a href="home.php" class="header__logo" style="color: var(--accent-rose-gold);">VelvetVogue</a>
            <nav class="nav">
                <ul id="navMenu" class="nav__menu">
                    <li class="nav__item"><a href="shop.php" class="nav__link">Shop</a></li>
                    <li class="nav__item"><a href="shop.php?category=collections" class="nav__link">Collections</a></li>
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
                <button class="header__action" aria-label="Cart">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span class="header__cart-badge" style="display: none;">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- PRODUCT PAGE -->
    <main class="product-page">
        <div class="product-page__container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
                <a href="home.php">Home</a> &nbsp;›&nbsp;
                <a href="shop.php">Shop</a> &nbsp;›&nbsp;
                <span class="breadcrumb__current"><?php echo $product['name']; ?></span>
            </nav>

            <!-- Main Product Section -->
            <div class="product-main">
                <!-- Gallery -->
                <div class="product-gallery">
                    <div class="product-gallery__main">
                        <div class="product-gallery__image">Product Image</div>
                        <div class="product-gallery__zoom">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                        </div>
                    </div>
                    <div class="product-gallery__thumbnails">
                        <div class="product-gallery__thumb product-gallery__thumb--active"><div class="product-gallery__thumb-img"></div></div>
                        <div class="product-gallery__thumb"><div class="product-gallery__thumb-img"></div></div>
                        <div class="product-gallery__thumb"><div class="product-gallery__thumb-img"></div></div>
                        <div class="product-gallery__thumb"><div class="product-gallery__thumb-img"></div></div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-info__category"><?php echo $product['category']; ?></div>
                    <h1 class="product-info__name"><?php echo $product['name']; ?></h1>
                    
                    <div class="product-info__rating">
                        <span class="product-info__stars">★★★★★</span>
                        <span class="product-info__rating-text"><?php echo $product['rating']; ?> (<?php echo $product['reviews_count']; ?> reviews)</span>
                    </div>
                    
                    <div class="product-info__price">
                        <span class="product-info__current-price"><?php echo format_price($product['price']); ?></span>
                        <?php if ($product['original_price']): ?>
                        <span class="product-info__original-price"><?php echo format_price($product['original_price']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <p class="product-info__description"><?php echo $product['description']; ?></p>
                    
                    <!-- Size Selection -->
                    <div class="product-option">
                        <label class="product-option__label">Size</label>
                        <div class="product-option__sizes">
                            <?php foreach ($product['sizes'] as $index => $size): ?>
                            <button class="product-option__size <?php echo $index === 2 ? 'product-option__size--active' : ''; ?>">
                                <?php echo $size; ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Color Selection -->
                    <div class="product-option">
                        <label class="product-option__label">Color: <span id="selectedColor"><?php echo $product['color_names'][0]; ?></span></label>
                        <div class="product-option__colors">
                            <?php foreach ($product['colors'] as $index => $color): ?>
                            <button class="product-option__color <?php echo $index === 0 ? 'product-option__color--active' : ''; ?>" 
                                    style="background: <?php echo $color; ?><?php echo $color === '#FFFFFF' ? '; border: 1px solid #ccc' : ''; ?>"
                                    data-color="<?php echo $product['color_names'][$index]; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="product-option">
                        <label class="product-option__label">Quantity</label>
                        <div class="product-option__quantity">
                            <button class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                            <input type="number" class="quantity-input" id="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
                            <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
                        </div>
                    </div>
                    
                    <!-- Stock -->
                    <div class="product-stock">
                        <?php echo $product['stock']; ?> items in stock
                    </div>
                    
                    <!-- Actions -->
                    <div class="product-actions">
                        <button class="product-actions__cart" onclick="addToCart(<?php echo $product['id']; ?>)">
                            Add to Cart
                        </button>
                        <button class="product-actions__wishlist" onclick="addToWishlist(<?php echo $product['id']; ?>)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs">
                <div class="product-tabs__nav">
                    <button class="product-tabs__btn product-tabs__btn--active" data-tab="description">Description</button>
                    <button class="product-tabs__btn" data-tab="materials">Materials & Care</button>
                    <button class="product-tabs__btn" data-tab="shipping">Shipping</button>
                    <button class="product-tabs__btn" data-tab="reviews">Reviews (<?php echo $product['reviews_count']; ?>)</button>
                </div>
                
                <div class="product-tabs__content product-tabs__content--active" id="tab-description">
                    <p><?php echo $product['description']; ?></p>
                </div>
                
                <div class="product-tabs__content" id="tab-materials">
                    <p><?php echo $product['materials']; ?></p>
                </div>
                
                <div class="product-tabs__content" id="tab-shipping">
                    <p><?php echo $product['shipping']; ?></p>
                </div>
                
                <div class="product-tabs__content" id="tab-reviews">
                    <div class="reviews">
                        <div class="reviews__summary">
                            <span class="reviews__average"><?php echo $product['rating']; ?></span>
                            <div>
                                <div class="reviews__stars">★★★★★</div>
                                <div class="reviews__count"><?php echo $product['reviews_count']; ?> reviews</div>
                            </div>
                        </div>
                        
                        <?php foreach ($reviews as $review): ?>
                        <div class="review-card">
                            <div class="review-card__header">
                                <div>
                                    <span class="review-card__author"><?php echo $review['name']; ?></span>
                                    <?php if ($review['verified']): ?>
                                    <span class="review-card__verified">✓ Verified Purchase</span>
                                    <?php endif; ?>
                                </div>
                                <span class="review-card__date"><?php echo $review['date']; ?></span>
                            </div>
                            <div class="review-card__stars"><?php echo str_repeat('★', $review['rating']); ?></div>
                            <p class="review-card__comment"><?php echo $review['comment']; ?></p>
                            <div class="review-card__helpful">
                                Helpful (<?php echo $review['helpful']; ?>)
                                <button>👍</button>
                                <button>👎</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer__main">
            <div class="container">
                <div class="footer__grid">
                    <div class="footer__brand">
                        <div class="footer__logo">VelvetVogue</div>
                        <p class="footer__description">
                            Crafting the language of luxury since 2020. Premium fashion for the modern Sri Lankan, where timeless elegance meets contemporary sophistication.
                        </p>
                        <div class="footer__social">
                            <a href="#" class="footer__social-link" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg>
                            </a>
                            <a href="#" class="footer__social-link" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                            <a href="#" class="footer__social-link" aria-label="Twitter">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                            </a>
                            <a href="#" class="footer__social-link" aria-label="Pinterest">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 12a4 4 0 1 1 8 0c0 3-2 6-4 8"/><line x1="12" y1="12" x2="12" y2="21"/><circle cx="12" cy="12" r="10"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="footer__column">
                        <h4 class="footer__title">Quick Links</h4>
                        <ul class="footer__links">
                            <li class="footer__link"><a href="shop.php">Shop All</a></li>
                            <li class="footer__link"><a href="shop.php?category=new">New Arrivals</a></li>
                            <li class="footer__link"><a href="shop.php?category=sale">Sale</a></li>
                            <li class="footer__link"><a href="about.php">About Us</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer__column">
                        <h4 class="footer__title">Customer Service</h4>
                        <ul class="footer__links">
                            <li class="footer__link"><a href="contact.php">Contact Us</a></li>
                            <li class="footer__link"><a href="#">Shipping Info</a></li>
                            <li class="footer__link"><a href="#">Returns</a></li>
                            <li class="footer__link"><a href="#">Size Guide</a></li>
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
                                <?php echo CONTACT_CITY; ?>, <?php echo CONTACT_PROVINCE; ?>
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

    <script src="<?php echo JS_URL; ?>navigation.js"></script>
    <script src="<?php echo JS_URL; ?>main.js"></script>
    <script src="<?php echo JS_URL; ?>product.js"></script>
</body>
</html>