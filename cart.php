<?php
/**
 * VelvetVogue - Shopping Cart Page
 * Cart items, quantity controls, order summary
 */
define('VELVETVOGUE', true);
require_once __DIR__ . '/config/config.php';

$pageTitle = 'Shopping Cart';
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
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>cart.css">
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
                    <span class="header__cart-badge">3</span>
                </button>
            </div>
        </div>
    </header>

    <!-- CART PAGE -->
    <main class="cart-page">
        <div class="cart-page__container">
            <h1 class="cart-page__title">Shopping Cart <span class="cart-page__count">(3 Items)</span></h1>
            
            <div class="cart-page__layout">
                <!-- Cart Items -->
                <div class="cart-items">
                    <!-- Item 1 -->
                    <div class="cart-item">
                        <div class="cart-item__image">
                            <div class="cart-item__img"></div>
                        </div>
                        <div class="cart-item__details">
                            <div class="cart-item__info">
                                <h3 class="cart-item__name">Elegant Velvet Evening Gown</h3>
                                <p class="cart-item__meta">Size: M | Color: Black</p>
                                <p class="cart-item__price"><?php echo format_price(45000); ?></p>
                            </div>
                            <div class="cart-item__actions">
                                <div class="cart-item__quantity">
                                    <button class="quantity-btn" onclick="updateQuantity(1, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10">
                                    <button class="quantity-btn" onclick="updateQuantity(1, 1)">+</button>
                                </div>
                                <button class="cart-item__remove" onclick="removeItem(1)">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                        <div class="cart-item__total"><?php echo format_price(45000); ?></div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="cart-item">
                        <div class="cart-item__image">
                            <div class="cart-item__img"></div>
                        </div>
                        <div class="cart-item__details">
                            <div class="cart-item__info">
                                <h3 class="cart-item__name">Premium Leather Handbag</h3>
                                <p class="cart-item__meta">Size: One Size | Color: Brown</p>
                                <p class="cart-item__price"><?php echo format_price(32000); ?></p>
                            </div>
                            <div class="cart-item__actions">
                                <div class="cart-item__quantity">
                                    <button class="quantity-btn" onclick="updateQuantity(2, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10">
                                    <button class="quantity-btn" onclick="updateQuantity(2, 1)">+</button>
                                </div>
                                <button class="cart-item__remove" onclick="removeItem(2)">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                        <div class="cart-item__total"><?php echo format_price(32000); ?></div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="cart-item">
                        <div class="cart-item__image">
                            <div class="cart-item__img"></div>
                        </div>
                        <div class="cart-item__details">
                            <div class="cart-item__info">
                                <h3 class="cart-item__name">Stiletto Heels - Rose Gold</h3>
                                <p class="cart-item__meta">Size: 38 | Color: Rose Gold</p>
                                <p class="cart-item__price"><?php echo format_price(18500); ?></p>
                            </div>
                            <div class="cart-item__actions">
                                <div class="cart-item__quantity">
                                    <button class="quantity-btn" onclick="updateQuantity(3, -1)">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10">
                                    <button class="quantity-btn" onclick="updateQuantity(3, 1)">+</button>
                                </div>
                                <button class="cart-item__remove" onclick="removeItem(3)">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                        <div class="cart-item__total"><?php echo format_price(18500); ?></div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="cart-summary">
                    <h3 class="cart-summary__title">Order Summary</h3>
                    
                    <div class="cart-summary__row">
                        <span>Subtotal</span>
                        <span><?php echo format_price(95500); ?></span>
                    </div>
                    
                    <div class="cart-summary__row">
                        <span>Delivery</span>
                        <span class="cart-summary__free">FREE</span>
                    </div>
                    
                    <div class="cart-summary__row">
                        <span>Tax (0%)</span>
                        <span><?php echo format_price(0); ?></span>
                    </div>
                    
                    <!-- Promo Code -->
                    <div class="cart-summary__promo">
                        <input type="text" class="cart-summary__promo-input" placeholder="Promo Code">
                        <button class="cart-summary__promo-btn">Apply</button>
                    </div>
                    
                    <div class="cart-summary__total">
                        <span>Total</span>
                        <span><?php echo format_price(95500); ?></span>
                    </div>
                    
                    <button class="cart-summary__checkout" onclick="window.location.href='checkout.php'">
                        Proceed to Checkout
                    </button>
                    
                    <div class="cart-summary__badges">
                        <div class="cart-summary__badge">✓ Secure Checkout</div>
                        <div class="cart-summary__badge">✓ Free Returns</div>
                        <div class="cart-summary__badge">✓ COD Available</div>
                    </div>
                    
                    <a href="shop.php" class="cart-summary__continue">← Continue Shopping</a>
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
                        <p class="footer__description">Crafting the language of luxury since 2020. Premium fashion for the modern Sri Lankan.</p>
                        <div class="footer__social">
                            <a href="#" class="footer__social-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg></a>
                            <a href="#" class="footer__social-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                            <a href="#" class="footer__social-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg></a>
                            <a href="#" class="footer__social-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12a4 4 0 1 1 8 0c0 3-2 6-4 8"/></svg></a>
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
                            <div class="footer__contact-text"><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a></div>
                        </div>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">📞</span>
                            <div class="footer__contact-text"><?php echo CONTACT_PHONE; ?></div>
                        </div>
                        <div class="footer__contact-item">
                            <span class="footer__contact-icon">📍</span>
                            <div class="footer__contact-text"><?php echo CONTACT_CITY; ?>, <?php echo CONTACT_PROVINCE; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-content">
                    <div class="footer__copyright">© <?php echo date('Y'); ?> <?php echo SITE_NAME; ?> (Pvt) Ltd • Sri Lanka 🇱🇰</div>
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

    <script src="<?php echo JS_URL; ?>navigation.js"></script>
    <script src="<?php echo JS_URL; ?>main.js"></script>
    <script>
        function updateQuantity(itemId, delta) {
            console.log('Update quantity:', itemId, delta);
        }
        function removeItem(itemId) {
            if (confirm('Remove this item from cart?')) {
                console.log('Remove item:', itemId);
            }
        }
    </script>
</body>
</html>