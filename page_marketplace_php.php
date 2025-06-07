<?php
/**
 * Template Name: Marketplace Page
 * Page template for Baby-Hub marketplace with WooCommerce + Dokan integration
 */

get_header(); ?>

<main id="main" class="site-main marketplace-page">
    <div class="container">
        
        <!-- Marketplace Hero -->
        <section class="marketplace-hero">
            <div class="hero-content">
                <h1 class="hero-title"><?php _e('השוק של בייבי-האב', 'babyhub'); ?></h1>
                <p class="hero-description">
                    <?php _e('מצאי את כל מה שאת צריכה לתינוק ולהריון ממוכרים מהימנים בקהילה שלנו', 'babyhub'); ?>
                </p>
                
                <div class="marketplace-stats">
                    <div class="stat-item">
                        <span class="stat-number">2,450</span>
                        <span class="stat-label"><?php _e('מוצרים פעילים', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">156</span>
                        <span class="stat-label"><?php _e('מוכרים', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label"><?php _e('שביעות רצון', 'babyhub'); ?></span>
                    </div>
                </div>
                
                <div class="hero-search">
                    <form class="marketplace-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/shop/')); ?>">
                        <div class="search-input-group">
                            <input 
                                type="search" 
                                class="search-field" 
                                placeholder="<?php _e('חפשי מוצרים...', 'babyhub'); ?>" 
                                name="s"
                                autocomplete="off"
                            />
                            <select name="product_cat" class="search-category">
                                <option value=""><?php _e('כל הקטגוריות', 'babyhub'); ?></option>
                                <option value="baby-gear"><?php _e('ציוד תינוקות', 'babyhub'); ?></option>
                                <option value="maternity"><?php _e('בגדי הריון', 'babyhub'); ?></option>
                                <option value="feeding"><?php _e('הזנה', 'babyhub'); ?></option>
                                <option value="toys"><?php _e('צעצועים', 'babyhub'); ?></option>
                                <option value="books"><?php _e('ספרים', 'babyhub'); ?></option>
                            </select>
                            <button type="submit" class="search-submit">
                                <i class="icon-search"></i>
                                <?php _e('חפש', 'babyhub'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="hero-image">
                <div class="marketplace-illustration">
                    <div class="product-cards">
                        <div class="product-card-demo">
                            <div class="product-image">🍼</div>
                            <div class="product-info">
                                <span class="product-name"><?php _e('בקבוק תינוק', 'babyhub'); ?></span>
                                <span class="product-price">₪45</span>
                            </div>
                        </div>
                        <div class="product-card-demo">
                            <div class="product-image">👶</div>
                            <div class="product-info">
                                <span class="product-name"><?php _e('בגדי תינוק', 'babyhub'); ?></span>
                                <span class="product-price">₪89</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Navigation -->
        <nav class="category-nav">
            <div class="category-container">
                <button class="category-item active" data-category="all">
                    <i class="icon-grid"></i>
                    <span><?php _e('הכל', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="baby-gear">
                    <i class="icon-baby-carriage"></i>
                    <span><?php _e('ציוד תינוקות', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="maternity">
                    <i class="icon-maternity"></i>
                    <span><?php _e('בגדי הריון', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="feeding">
                    <i class="icon-bottle"></i>
                    <span><?php _e('הזנה', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="toys">
                    <i class="icon-toy"></i>
                    <span><?php _e('צעצועים', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="books">
                    <i class="icon-book"></i>
                    <span><?php _e('ספרים', 'babyhub'); ?></span>
                </button>
                <button class="category-item" data-category="safety">
                    <i class="icon-shield"></i>
                    <span><?php _e('בטיחות', 'babyhub'); ?></span>
                </button>
            </div>
        </nav>

        <!-- Featured Products -->
        <section class="featured-products">
            <div class="section-header">
                <h2><?php _e('מוצרים מומלצים', 'babyhub'); ?></h2>
                <p><?php _e('המוצרים הכי פופולריים והמומלצים מהקהילה שלנו', 'babyhub'); ?></p>
            </div>
            
            <div class="products-grid">
                <?php
                // Demo products - in real implementation this would pull from WooCommerce
                $demo_products = array(
                    array(
                        'name' => 'עגלת תינוק מודולרית',
                        'price' => '₪1,250',
                        'original_price' => '₪1,450',
                        'rating' => 4.8,
                        'reviews' => 156,
                        'vendor' => 'חנות הבייבי',
                        'image' => '🚼',
                        'badge' => 'מומלץ'
                    ),
                    array(
                        'name' => 'כיסא אוכל גבוה',
                        'price' => '₪320',
                        'original_price' => null,
                        'rating' => 4.9,
                        'reviews' => 89,
                        'vendor' => 'מוצרי תינוקות',
                        'image' => '🪑',
                        'badge' => 'חדש'
                    ),
                    array(
                        'name' => 'מיטת תינוק עם מזרן',
                        'price' => '₪890',
                        'original_price' => '₪1,200',
                        'rating' => 4.7,
                        'reviews' => 203,
                        'vendor' => 'רהיטי ילדים',
                        'image' => '🛏️',
                        'badge' => 'מבצע'
                    ),
                    array(
                        'name' => 'מוניטור לתינוק',
                        'price' => '₪450',
                        'original_price' => null,
                        'rating' => 4.6,
                        'reviews' => 78,
                        'vendor' => 'טכנולוגיה לתינוקות',
                        'image' => '📹',
                        'badge' => null
                    )
                );
                
                foreach ($demo_products as $product) : ?>
                    <div class="product-card">
                        <?php if ($product['badge']) : ?>
                            <span class="product-badge <?php echo sanitize_html_class(strtolower($product['badge'])); ?>">
                                <?php echo $product['badge']; ?>
                            </span>
                        <?php endif; ?>
                        
                        <div class="product-image">
                            <span class="product-emoji"><?php echo $product['image']; ?></span>
                            <div class="product-actions">
                                <button class="action-btn wishlist" title="<?php _e('הוסף למועדפים', 'babyhub'); ?>">
                                    <i class="icon-heart"></i>
                                </button>
                                <button class="action-btn quick-view" title="<?php _e('צפייה מהירה', 'babyhub'); ?>">
                                    <i class="icon-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <div class="product-vendor">
                                <i class="icon-store"></i>
                                <?php echo $product['vendor']; ?>
                            </div>
                            
                            <h3 class="product-name">
                                <a href="#"><?php echo $product['name']; ?></a>
                            </h3>
                            
                            <div class="product-rating">
                                <div class="stars">
                                    <?php
                                    $full_stars = floor($product['rating']);
                                    $half_star = $product['rating'] - $full_stars >= 0.5;
                                    
                                    for ($i = 0; $i < $full_stars; $i++) {
                                        echo '⭐';
                                    }
                                    if ($half_star) {
                                        echo '✨';
                                    }
                                    ?>
                                </div>
                                <span class="rating-text">
                                    (<?php echo $product['reviews']; ?> <?php _e('ביקורות', 'babyhub'); ?>)
                                </span>
                            </div>
                            
                            <div class="product-price">
                                <span class="current-price"><?php echo $product['price']; ?></span>
                                <?php if ($product['original_price']) : ?>
                                    <span class="original-price"><?php echo $product['original_price']; ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="product-actions-bottom">
                                <button class="btn btn-primary add-to-cart">
                                    <i class="icon-cart"></i>
                                    <?php _e('הוסף לעגלה', 'babyhub'); ?>
                                </button>
                                <button class="btn btn-secondary buy-now">
                                    <?php _e('קנה עכשיו', 'babyhub'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="section-footer">
                <a href="<?php echo home_url('/shop/'); ?>" class="btn btn-outline">
                    <?php _e('צפה בכל המוצרים', 'babyhub'); ?>
                </a>
            </div>
        </section>

        <!-- Top Vendors -->
        <section class="top-vendors">
            <div class="section-header">
                <h2><?php _e('מוכרים מובילים', 'babyhub'); ?></h2>
                <p><?php _e('המוכרים עם הדירוג הגבוה ביותר בקהילה', 'babyhub'); ?></p>
            </div>
            
            <div class="vendors-grid">
                <?php
                $demo_vendors = array(
                    array(
                        'name' => 'חנות הבייבי',
                        'rating' => 4.9,
                        'products' => 156,
                        'sales' => '2.5K',
                        'avatar' => '🏪',
                        'verified' => true
                    ),
                    array(
                        'name' => 'מוצרי תינוקות פרימיום',
                        'rating' => 4.8,
                        'products' => 89,
                        'sales' => '1.8K',
                        'avatar' => '👶',
                        'verified' => true
                    ),
                    array(
                        'name' => 'רהיטי ילדים',
                        'rating' => 4.7,
                        'products' => 203,
                        'sales' => '3.2K',
                        'avatar' => '🛏️',
                        'verified' => false
                    ),
                    array(
                        'name' => 'צעצועים חכמים',
                        'rating' => 4.6,
                        'products' => 78,
                        'sales' => '956',
                        'avatar' => '🧸',
                        'verified' => true
                    )
                );
                
                foreach ($demo_vendors as $vendor) : ?>
                    <div class="vendor-card">
                        <div class="vendor-header">
                            <div class="vendor-avatar">
                                <span class="vendor-emoji"><?php echo $vendor['avatar']; ?></span>
                                <?php if ($vendor['verified']) : ?>
                                    <span class="verified-badge" title="<?php _e('מוכר מאומת', 'babyhub'); ?>">✓</span>
                                <?php endif; ?>
                            </div>
                            <div class="vendor-info">
                                <h3 class="vendor-name"><?php echo $vendor['name']; ?></h3>
                                <div class="vendor-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="rating-value"><?php echo $vendor['rating']; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="vendor-stats">
                            <div class="stat-item">
                                <span class="stat-value"><?php echo $vendor['products']; ?></span>
                                <span class="stat-label"><?php _e('מוצרים', 'babyhub'); ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo $vendor['sales']; ?></span>
                                <span class="stat-label"><?php _e('מכירות', 'babyhub'); ?></span>
                            </div>
                        </div>
                        
                        <div class="vendor-actions">
                            <a href="#" class="btn btn-primary">
                                <i class="icon-store"></i>
                                <?php _e('בקרי בחנות', 'babyhub'); ?>
                            </a>
                            <button class="btn btn-secondary follow-vendor">
                                <i class="icon-plus"></i>
                                <?php _e('עקבי', 'babyhub'); ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- WooCommerce + Dokan Integration -->
        <section class="woocommerce-integration">
            <div class="section-header">
                <h2><?php _e('השוק המלא', 'babyhub'); ?></h2>
                <p><?php _e('דפדפי בכל המוצרים והחנויות שלנו', 'babyhub'); ?></p>
            </div>
            
            <div class="integration-content">
                <?php
                // Check if WooCommerce is active
                if (class_exists('WooCommerce')) {
                    echo '<div class="woocommerce-content">';
                    
                    // Display WooCommerce shop page content
                    if (function_exists('woocommerce_content')) {
                        woocommerce_content();
                    } else {
                        echo '<p>' . __('תוכן WooCommerce יוצג כאן', 'babyhub') . '</p>';
                    }
                    
                    echo '</div>';
                } else {
                    echo '<div class="plugin-notice">';
                    echo '<h3>' . __('WooCommerce נדרש', 'babyhub') . '</h3>';
                    echo '<p>' . __('התקן ופעל את תוסף WooCommerce כדי להציג את השוק המלא', 'babyhub') . '</p>';
                    echo '<a href="' . admin_url('plugin-install.php?s=woocommerce&tab=search&type=term') . '" class="btn btn-primary">';
                    echo __('התקן WooCommerce', 'babyhub');
                    echo '</a>';
                    echo '</div>';
                }
                
                // Check if Dokan is active
                if (class_exists('WeDevs_Dokan')) {
                    echo '<div class="dokan-content">';
                    echo '<h3>' . __('חנויות Dokan', 'babyhub') . '</h3>';
                    
                    // Display Dokan store list
                    if (function_exists('dokan_store_list_content')) {
                        dokan_store_list_content();
                    } else {
                        echo '<p>' . __('רשימת חנויות Dokan תוצג כאן', 'babyhub') . '</p>';
                    }
                    
                    echo '</div>';
                } else {
                    echo '<div class="plugin-notice">';
                    echo '<h3>' . __('Dokan מומלץ', 'babyhub') . '</h3>';
                    echo '<p>' . __('התקן את תוסף Dokan כדי לאפשר למשתמשים לפתוח חנויות משלהם', 'babyhub') . '</p>';
                    echo '<a href="' . admin_url('plugin-install.php?s=dokan&tab=search&type=term') . '" class="btn btn-secondary">';
                    echo __('התקן Dokan', 'babyhub');
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Marketplace Benefits -->
        <section class="marketplace-benefits">
            <h2><?php _e('למה לקנות אצלנו?', 'babyhub'); ?></h2>
            
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">🛡️</div>
                    <h3><?php _e('קנייה בטוחה', 'babyhub'); ?></h3>
                    <p><?php _e('כל המוכרים עוברים אימות והמוצרים מוגנים בביטוח', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">🚚</div>
                    <h3><?php _e('משלוח מהיר', 'babyhub'); ?></h3>
                    <p><?php _e('משלוח עד הבית תוך 24-48 שעות לכל הארץ', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">↩️</div>
                    <h3><?php _e('החזרות חינם', 'babyhub'); ?></h3>
                    <p><?php _e('החזרה בחינם תוך 14 ימים ללא שאלות', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">💬</div>
                    <h3><?php _e('תמיכה מהקהילה', 'babyhub'); ?></h3>
                    <p><?php _e('ביקורות וחוות דעת מאמהות אמיתיות מהקהילה', 'babyhub'); ?></p>
                </div>
            </div>
        </section>

        <!-- Become a Vendor -->
        <section class="become-vendor">
            <div class="vendor-cta-content">
                <div class="cta-text">
                    <h2><?php _e('רוצה להפוך למוכרת?', 'babyhub'); ?></h2>
                    <p><?php _e('הצטרפי לאלפי המוכרות המצליחות שלנו ופתחי חנות משלך עוד היום', 'babyhub'); ?></p>
                    <ul class="vendor-benefits">
                        <li><?php _e('עמלות נמוכות - רק 3% לעסקה', 'babyhub'); ?></li>
                        <li><?php _e('ממשק ניהול פשוט וידידותי', 'babyhub'); ?></li>
                        <li><?php _e('חשיפה לאלפי קונות פוטנציאליות', 'babyhub'); ?></li>
                        <li><?php _e('תמיכה טכנית מלאה', 'babyhub'); ?></li>
                    </ul>
                </div>
                <div class="cta-actions">
                    <?php if (class_exists('WeDevs_Dokan')) : ?>
                        <a href="<?php echo dokan_get_registration_url(); ?>" class="btn btn-primary btn-large">
                            <i class="icon-store"></i>
                            <?php _e('פתחי חנות עכשיו', 'babyhub'); ?>
                        </a>
                    <?php else : ?>
                        <button class="btn btn-primary btn-large" onclick="alert('<?php _e("תוסף Dokan נדרש כדי לפתוח חנות", "babyhub"); ?>')">
                            <i class="icon-store"></i>
                            <?php _e('פתחי חנות עכשיו', 'babyhub'); ?>
                        </button>
                    <?php endif; ?>
                    <a href="#" class="btn btn-secondary"><?php _e('למד עוד', 'babyhub'); ?></a>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Category navigation
    $('.category-nav .category-item').on('click', function() {
        const category = $(this).data('category');
        
        // Update nav appearance
        $('.category-item').removeClass('active');
        $(this).addClass('active');
        
        // Filter products (would integrate with actual WooCommerce filtering)
        filterProductsByCategory(category);
    });
    
    function filterProductsByCategory(category) {
        if (category === 'all') {
            $('.product-card').show();
        } else {
            // This would integrate with WooCommerce AJAX filtering
            console.log('Filtering by category:', category);
        }
    }
    
    // Wishlist functionality
    $('.wishlist').on('click', function() {
        const $btn = $(this);
        const $icon = $btn.find('i');
        
        if ($icon.hasClass('icon-heart')) {
            $icon.removeClass('icon-heart').addClass('icon-heart-filled');
            $btn.addClass('active');
        } else {
            $icon.removeClass('icon-heart-filled').addClass('icon-heart');
            $btn.removeClass('active');
        }
    });
    
    // Add to cart functionality
    $('.add-to-cart').on('click', function() {
        const $btn = $(this);
        const originalText = $btn.html();
        
        $btn.html('<i class="icon-loading"></i> <?php _e("מוסיף...", "babyhub"); ?>').prop('disabled', true);
        
        // Simulate AJAX call
        setTimeout(function() {
            $btn.html('<i class="icon-check"></i> <?php _e("נוסף לעגלה", "babyhub"); ?>').removeClass('btn-primary').addClass('btn-success');
            
            setTimeout(function() {
                $btn.html(originalText).removeClass('btn-success').addClass('btn-primary').prop('disabled', false);
            }, 2000);
        }, 1000);
    });
    
    // Follow vendor functionality
    $('.follow-vendor').on('click', function() {
        const $btn = $(this);
        
        if ($btn.hasClass('following')) {
            $btn.html('<i class="icon-plus"></i> <?php _e("עקבי", "babyhub"); ?>').removeClass('following');
        } else {
            $btn.html('<i class="icon-check"></i> <?php _e("עוקבת", "babyhub"); ?>').addClass('following');
        }
    });
    
    // Quick view functionality
    $('.quick-view').on('click', function() {
        // This would open a modal with product details
        alert('<?php _e("צפייה מהירה תהיה זמינה בקרוב", "babyhub"); ?>');
    });
    
    // Marketplace search
    $('.marketplace-search-form').on('submit', function(e) {
        const searchTerm = $(this).find('.search-field').val();
        const category = $(this).find('.search-category').val();
        
        if (!searchTerm.trim()) {
            e.preventDefault();
            alert('<?php _e("אנא הזיני מונח חיפוש", "babyhub"); ?>');
        }
    });
});
</script>

<?php get_footer(); ?>