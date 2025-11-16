<?php
/**
 * VelvetVogue - Shop/Collection Page
 * Product grid with filters, sorting, and pagination
 */
define('VELVETVOGUE', true);
require_once __DIR__ . '/config/config.php';

$pageTitle = 'Shop All Products';
$currentCategory = isset($_GET['category']) ? $_GET['category'] : 'all';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo $pageTitle; ?></title>
    <meta name="description" content="Shop premium fashion at VelvetVogue. Discover luxury clothing, shoes, bags and accessories in Sri Lanka.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>reset.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>variables.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>global.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>navigation.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>home.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>shop.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>footer.css">
    
    <style>
        /* Page Header Banner */
        .page-header {
            position: relative;
            height: 350px;
            background: linear-gradient(135deg, #1A1A1A 0%, #0A0A0A 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: var(--header-height);
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(ellipse at 30% 50%, rgba(183, 110, 121, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 50%, rgba(183, 110, 121, 0.08) 0%, transparent 50%);
        }
        
        .page-header__content {
            position: relative;
            z-index: 2;
        }
        
        .page-header__title {
            font-family: var(--font-heading);
            font-size: 3.5rem;
            color: var(--text-primary);
            margin-bottom: var(--space-md);
        }
        
        .page-header__breadcrumb {
            font-size: var(--text-sm);
            color: var(--text-muted);
        }
        
        .page-header__breadcrumb a {
            color: var(--text-muted);
            transition: color var(--transition-base);
        }
        
        .page-header__breadcrumb a:hover {
            color: var(--accent-rose-gold);
        }
        
        .page-header__breadcrumb span {
            color: var(--accent-rose-gold);
        }
        
        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 100px;
            right: var(--space-xl);
            padding: var(--space-md) var(--space-lg);
            background: var(--secondary-bg);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-xl);
            z-index: 9999;
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
    </style>
</head>
<body>
    <!-- HEADER -->
    <header id="header" class="header" style="background: rgba(10, 10, 10, 0.98); backdrop-filter: blur(20px);">
        <div class="header__container">
            <a href="home.php" class="header__logo" style="color: var(--accent-rose-gold);">VelvetVogue</a>
            <nav class="nav">
                <button id="navToggle" class="nav__toggle" aria-label="Toggle menu">
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                </button>
                <ul id="navMenu" class="nav__menu">
                    <li class="nav__item"><a href="shop.php" class="nav__link nav__link--active">Shop</a></li>
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
                <button class="header__action" aria-label="Cart" onclick="window.location.href='cart.php'">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span class="header__cart-badge" style="display: none;">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- PAGE HEADER BANNER -->
    <section class="page-header">
        <div class="page-header__content">
            <h1 class="page-header__title">Collections</h1>
            <div class="page-header__breadcrumb">
                <a href="home.php">Home</a> &nbsp;›&nbsp; <span>Collections</span>
            </div>
        </div>
    </section>

    <!-- SHOP CONTENT -->
    <main class="shop">
        <div class="shop__container">
            <!-- Shop Header with Sort -->
            <div class="shop__header">
                <div>
                    <p class="shop__count">Showing <strong>1-12</strong> of <strong>48</strong> products</p>
                </div>
                <div class="shop__controls">
                    <select class="shop__sort-select" id="sortSelect">
                        <option value="featured">Sort by: Featured</option>
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name">Name: A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Mobile Filter Toggle -->
            <button class="shop__filter-toggle" id="filterToggle">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/>
                    <line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/>
                    <line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/>
                </svg>
                Filter Products
            </button>

            <!-- Main Layout -->
            <div class="shop__main">
                <!-- Sidebar Filters -->
                <aside class="shop__sidebar" id="filterSidebar">
                    <!-- Categories -->
                    <div class="filter">
                        <h3 class="filter__title">Category</h3>
                        <div class="filter__options">
                            <label class="filter__option"><input type="checkbox" checked> All (48)</label>
                            <label class="filter__option"><input type="checkbox"> Clothing (24)</label>
                            <label class="filter__option"><input type="checkbox"> Shoes (12)</label>
                            <label class="filter__option"><input type="checkbox"> Bags (8)</label>
                            <label class="filter__option"><input type="checkbox"> Accessories (4)</label>
                        </div>
                    </div>

                    <!-- Size -->
                    <div class="filter">
                        <h3 class="filter__title">Size</h3>
                        <div class="filter__sizes">
                            <button class="filter__size">XS</button>
                            <button class="filter__size">S</button>
                            <button class="filter__size filter__size--active">M</button>
                            <button class="filter__size">L</button>
                            <button class="filter__size">XL</button>
                            <button class="filter__size">XXL</button>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="filter">
                        <h3 class="filter__title">Color</h3>
                        <div class="filter__colors">
                            <button class="filter__color filter__color--active" style="background: #000000;" title="Black"></button>
                            <button class="filter__color" style="background: #FFFFFF; border: 1px solid #ccc;" title="White"></button>
                            <button class="filter__color" style="background: #B76E79;" title="Rose Gold"></button>
                            <button class="filter__color" style="background: #8B4513;" title="Brown"></button>
                            <button class="filter__color" style="background: #1E3A5F;" title="Navy"></button>
                            <button class="filter__color" style="background: #8B0000;" title="Burgundy"></button>
                            <button class="filter__color" style="background: #F5F5DC;" title="Beige"></button>
                            <button class="filter__color" style="background: #808080;" title="Gray"></button>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="filter">
                        <h3 class="filter__title">Price Range (LKR)</h3>
                        <div class="filter__price-inputs">
                            <input type="number" class="filter__price-input" placeholder="Min" value="0">
                            <span class="filter__price-separator">-</span>
                            <input type="number" class="filter__price-input" placeholder="Max" value="100000">
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <button class="btn btn--secondary btn--full" style="margin-top: var(--space-md);">Clear All Filters</button>
                </aside>

                <!-- Product Grid -->
                <div class="shop__products">
                    <div class="shop__grid">
                        <?php
                        $products = [
                            ['id' => 1, 'name' => 'Elegant Velvet Evening Gown', 'category' => 'Dresses', 'price' => 45000, 'badge' => 'New'],
                            ['id' => 2, 'name' => 'Premium Leather Handbag', 'category' => 'Bags', 'price' => 32000, 'original' => 38000],
                            ['id' => 3, 'name' => 'Stiletto Heels - Rose Gold', 'category' => 'Shoes', 'price' => 18500, 'original' => 24000, 'badge' => 'Sale'],
                            ['id' => 4, 'name' => 'Pearl Statement Necklace', 'category' => 'Accessories', 'price' => 15000],
                            ['id' => 5, 'name' => 'Silk Blouse - Ivory', 'category' => 'Tops', 'price' => 22000, 'badge' => 'New'],
                            ['id' => 6, 'name' => 'Tailored Wool Blazer', 'category' => 'Outerwear', 'price' => 55000],
                            ['id' => 7, 'name' => 'Cashmere Wrap Scarf', 'category' => 'Accessories', 'price' => 28000],
                            ['id' => 8, 'name' => 'Leather Ankle Boots', 'category' => 'Shoes', 'price' => 35000],
                            ['id' => 9, 'name' => 'Embroidered Clutch Bag', 'category' => 'Bags', 'price' => 19500, 'original' => 25000, 'badge' => 'Sale'],
                            ['id' => 10, 'name' => 'Pleated Midi Skirt', 'category' => 'Bottoms', 'price' => 26000],
                            ['id' => 11, 'name' => 'Diamond Stud Earrings', 'category' => 'Jewelry', 'price' => 42000],
                            ['id' => 12, 'name' => 'Linen Summer Dress', 'category' => 'Dresses', 'price' => 31000, 'badge' => 'New'],
                        ];

                        foreach ($products as $product):
                        ?>
                        <div class="product-card">
                            <div class="product-card__image">
                                <div class="product-card__img" style="background: linear-gradient(135deg, #2A2A2A, #1A1A1A); width: 100%; height: 100%;"></div>
                                <?php if (isset($product['badge'])): ?>
                                <span class="product-card__badge <?php echo $product['badge'] === 'Sale' ? 'product-card__badge--sale' : 'product-card__badge--new'; ?>">
                                    <?php echo $product['badge']; ?>
                                </span>
                                <?php endif; ?>
                                <div class="product-card__actions">
                                    <button class="product-card__action-btn" onclick="VelvetVogue.addToWishlist(<?php echo $product['id']; ?>)" title="Add to Wishlist">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    </button>
                                    <button class="product-card__action-btn" onclick="VelvetVogue.openQuickView(<?php echo $product['id']; ?>)" title="Quick View">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <div class="product-card__quick-view" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">Quick View</div>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__category"><?php echo $product['category']; ?></div>
                                <h3 class="product-card__name"><?php echo $product['name']; ?></h3>
                                <div class="product-card__price">
                                    <span class="product-card__current-price"><?php echo format_price($product['price']); ?></span>
                                    <?php if (isset($product['original'])): ?>
                                    <span class="product-card__original-price"><?php echo format_price($product['original']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination__btn" disabled>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="pagination__btn pagination__btn--active">1</button>
                        <button class="pagination__btn">2</button>
                        <button class="pagination__btn">3</button>
                        <button class="pagination__btn">4</button>
                        <button class="pagination__btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
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
    <script>
        // Filter toggle for mobile
        const filterToggle = document.getElementById('filterToggle');
        const filterSidebar = document.getElementById('filterSidebar');
        
        if (filterToggle && filterSidebar) {
            filterToggle.addEventListener('click', () => {
                filterSidebar.style.display = filterSidebar.style.display === 'block' ? 'none' : 'block';
            });
        }
        
        // Size filter buttons
        document.querySelectorAll('.filter__size').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('filter__size--active');
            });
        });
        
        // Color filter buttons
        document.querySelectorAll('.filter__color').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('filter__color--active');
            });
        });
    </script>
</body>
</html>