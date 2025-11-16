<?php
/**
 * VelvetVogue - About Us Page
 * Brand story, values, team
 */
define('VELVETVOGUE', true);
require_once __DIR__ . '/config/config.php';

$pageTitle = 'About Us';
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
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>about.css">
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
                    <li class="nav__item"><a href="about.php" class="nav__link nav__link--active">About</a></li>
                    <li class="nav__item"><a href="contact.php" class="nav__link">Contact</a></li>
                </ul>
            </nav>
            <div class="header__actions">
                <button class="header__action"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></button>
                <button class="header__action"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></button>
                <button class="header__action"><svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg></button>
            </div>
        </div>
    </header>

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header__content">
            <h1 class="page-header__title">Our Story</h1>
            <p class="page-header__subtitle">Crafting the Language of Luxury Since 2020</p>
        </div>
    </section>

    <!-- ABOUT CONTENT -->
    <main class="about">
        <div class="about__container">
            <!-- Brand Story -->
            <section class="about__section">
                <div class="about__content">
                    <h2 class="about__heading">The VelvetVogue Journey</h2>
                    <p class="about__text">
                        Founded in the heart of Sri Lanka, VelvetVogue emerged from a vision to redefine luxury fashion for the modern Sri Lankan. We believe that true elegance transcends borders, yet remains deeply rooted in cultural appreciation.
                    </p>
                    <p class="about__text">
                        Our journey began in 2020, when our founders recognized a gap in the Sri Lankan fashion market – a need for premium, contemporary fashion that speaks the language of global luxury while honoring local sensibilities.
                    </p>
                    <p class="about__text">
                        Today, VelvetVogue stands as a beacon of sophistication, offering carefully curated collections that blend international trends with timeless elegance. Every piece in our collection tells a story of craftsmanship, quality, and refined taste.
                    </p>
                </div>
                <div class="about__image">
                    <div class="about__img"></div>
                </div>
            </section>

            <!-- Values -->
            <section class="about__values">
                <h2 class="about__heading about__heading--center">Our Values</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-card__icon">✨</div>
                        <h3 class="value-card__title">Quality Excellence</h3>
                        <p class="value-card__text">We source only the finest materials and partner with skilled artisans to ensure every piece meets our exacting standards.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-card__icon">🌿</div>
                        <h3 class="value-card__title">Sustainable Fashion</h3>
                        <p class="value-card__text">Committed to ethical practices and environmental responsibility in every aspect of our business.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-card__icon">🇱🇰</div>
                        <h3 class="value-card__title">Proudly Sri Lankan</h3>
                        <p class="value-card__text">Celebrating our heritage while embracing global fashion trends that resonate with our diverse clientele.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-card__icon">💎</div>
                        <h3 class="value-card__title">Customer First</h3>
                        <p class="value-card__text">Your satisfaction is our priority. We provide personalized service and seamless shopping experiences.</p>
                    </div>
                </div>
            </section>

            <!-- Team -->
            <section class="about__team">
                <h2 class="about__heading about__heading--center">Meet Our Team</h2>
                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-card__image"><div class="team-card__img"></div></div>
                        <h3 class="team-card__name">Amaya Perera</h3>
                        <p class="team-card__role">Founder & Creative Director</p>
                    </div>
                    <div class="team-card">
                        <div class="team-card__image"><div class="team-card__img"></div></div>
                        <h3 class="team-card__name">Dinesh Fernando</h3>
                        <p class="team-card__role">Head of Operations</p>
                    </div>
                    <div class="team-card">
                        <div class="team-card__image"><div class="team-card__img"></div></div>
                        <h3 class="team-card__name">Rashmi Silva</h3>
                        <p class="team-card__role">Fashion Curator</p>
                    </div>
                    <div class="team-card">
                        <div class="team-card__image"><div class="team-card__img"></div></div>
                        <h3 class="team-card__name">Kasun Jayawardena</h3>
                        <p class="team-card__role">Customer Experience</p>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="about__cta">
                <h2 class="about__cta-title">Experience Luxury Fashion</h2>
                <p class="about__cta-text">Discover our latest collections and find your perfect style</p>
                <a href="shop.php" class="btn btn--primary">Shop Now</a>
            </section>
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
</body>
</html>