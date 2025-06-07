<?php
/**
 * Template Name: Directory Page
 * Page template for Baby-Hub service provider directory
 */

get_header(); ?>

<main id="main" class="site-main directory-page">
    <div class="container">
        
        <!-- Directory Hero -->
        <section class="directory-hero">
            <div class="hero-content">
                <h1 class="hero-title"><?php _e('מדריך ספקי שירותים', 'babyhub'); ?></h1>
                <p class="hero-description">
                    <?php _e('מצאי את הספקים הטובים ביותר לכל צרכי ההורות - מרופאים ועד מטפלים, הכל במקום אחד', 'babyhub'); ?>
                </p>
                
                <div class="directory-search">
                    <form class="directory-search-form" role="search">
                        <div class="search-row">
                            <div class="search-input-group">
                                <input 
                                    type="search" 
                                    class="search-field" 
                                    placeholder="<?php _e('חפש ספק שירות...', 'babyhub'); ?>" 
                                    name="s"
                                />
                                <button type="submit" class="search-submit">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                            
                            <select name="category" class="search-category">
                                <option value=""><?php _e('כל הקטגוריות', 'babyhub'); ?></option>
                                <option value="medical"><?php _e('רפואה', 'babyhub'); ?></option>
                                <option value="therapy"><?php _e('טיפול', 'babyhub'); ?></option>
                                <option value="education"><?php _e('חינוך', 'babyhub'); ?></option>
                                <option value="nutrition"><?php _e('תזונה', 'babyhub'); ?></option>
                                <option value="fitness"><?php _e('כושר', 'babyhub'); ?></option>
                                <option value="childcare"><?php _e('טיפוח', 'babyhub'); ?></option>
                            </select>
                            
                            <select name="location" class="search-location">
                                <option value=""><?php _e('כל האזורים', 'babyhub'); ?></option>
                                <option value="center"><?php _e('מרכז', 'babyhub'); ?></option>
                                <option value="north"><?php _e('צפון', 'babyhub'); ?></option>
                                <option value="south"><?php _e('דרום', 'babyhub'); ?></option>
                                <option value="jerusalem"><?php _e('ירושלים', 'babyhub'); ?></option>
                                <option value="online"><?php _e('אונליין', 'babyhub'); ?></option>
                            </select>
                        </div>
                        
                        <div class="advanced-filters" style="display: none;">
                            <div class="filter-row">
                                <div class="filter-group">
                                    <label><?php _e('טווח מחירים:', 'babyhub'); ?></label>
                                    <div class="price-range">
                                        <input type="number" name="min_price" placeholder="<?php _e('מינימום', 'babyhub'); ?>">
                                        <span>-</span>
                                        <input type="number" name="max_price" placeholder="<?php _e('מקסימום', 'babyhub'); ?>">
                                    </div>
                                </div>
                                
                                <div class="filter-group">
                                    <label><?php _e('דירוג מינימלי:', 'babyhub'); ?></label>
                                    <select name="min_rating">
                                        <option value=""><?php _e('כל הדירוגים', 'babyhub'); ?></option>
                                        <option value="4">4+ ⭐</option>
                                        <option value="4.5">4.5+ ⭐</option>
                                        <option value="4.8">4.8+ ⭐</option>
                                    </select>
                                </div>
                                
                                <div class="filter-group">
                                    <label><?php _e('זמינות:', 'babyhub'); ?></label>
                                    <select name="availability">
                                        <option value=""><?php _e('כל הזמנים', 'babyhub'); ?></option>
                                        <option value="immediate"><?php _e('זמין מיד', 'babyhub'); ?></option>
                                        <option value="week"><?php _e('השבוע', 'babyhub'); ?></option>
                                        <option value="month"><?php _e('החודש', 'babyhub'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="toggle-filters">
                            <i class="icon-filter"></i>
                            <?php _e('מסננים מתקדמים', 'babyhub'); ?>
                        </button>
                    </form>
                </div>
                
                <div class="directory-stats">
                    <div class="stat-item">
                        <span class="stat-number">456</span>
                        <span class="stat-label"><?php _e('ספקי שירות', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label"><?php _e('קטגוריות', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.7</span>
                        <span class="stat-label"><?php _e('דירוג ממוצע', 'babyhub'); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Categories -->
        <section class="quick-categories">
            <h2><?php _e('קטגוריות פופולריות', 'babyhub'); ?></h2>
            
            <div class="categories-grid">
                <div class="category-card" data-category="medical">
                    <div class="category-icon">👩‍⚕️</div>
                    <h3 class="category-name"><?php _e('רופאים', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('89 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('רופאי נשים, ילדים ומומחים', 'babyhub'); ?></p>
                </div>
                
                <div class="category-card" data-category="therapy">
                    <div class="category-icon">🤱</div>
                    <h3 class="category-name"><?php _e('יועצות הנקה', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('67 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('יועצות הנקה מוסמכות', 'babyhub'); ?></p>
                </div>
                
                <div class="category-card" data-category="education">
                    <div class="category-icon">🧘‍♀️</div>
                    <h3 class="category-name"><?php _e('מכינות ללידה', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('34 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('מדריכות הכנה ללידה', 'babyhub'); ?></p>
                </div>
                
                <div class="category-card" data-category="childcare">
                    <div class="category-icon">👶</div>
                    <h3 class="category-name"><?php _e('מטפלות', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('123 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('מטפלות לתינוקות וילדים', 'babyhub'); ?></p>
                </div>
                
                <div class="category-card" data-category="nutrition">
                    <div class="category-icon">🥗</div>
                    <h3 class="category-name"><?php _e('דיאטניות', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('45 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('דיאטניות מתמחות בהריון', 'babyhub'); ?></p>
                </div>
                
                <div class="category-card" data-category="fitness">
                    <div class="category-icon">🏃‍♀️</div>
                    <h3 class="category-name"><?php _e('מדריכות כושר', 'babyhub'); ?></h3>
                    <p class="category-count"><?php _e('56 ספקים', 'babyhub'); ?></p>
                    <p class="category-desc"><?php _e('כושר להריון ואחרי לידה', 'babyhub'); ?></p>
                </div>
            </div>
        </section>

        <!-- Featured Providers -->
        <section class="featured-providers">
            <div class="section-header">
                <h2><?php _e('ספקים מומלצים', 'babyhub'); ?></h2>
                <p><?php _e('ספקי השירות עם הדירוג הגבוה ביותר מהקהילה שלנו', 'babyhub'); ?></p>
            </div>
            
            <div class="providers-grid">
                <?php
                // Demo providers - in real implementation this would pull from custom post type
                $demo_providers = array(
                    array(
                        'name' => 'ד"ר רחל לוי',
                        'profession' => 'רופאת נשים ויולדות',
                        'location' => 'תל אביב',
                        'rating' => 4.9,
                        'reviews' => 156,
                        'experience' => '15 שנות ניסיון',
                        'specialties' => array('הריון בסיכון', 'לידות טבעיות', 'מעקב הריון'),
                        'price_range' => '₪200-350',
                        'availability' => 'זמינה השבוע',
                        'verified' => true,
                        'category' => 'medical',
                        'avatar' => '👩‍⚕️',
                        'badges' => array('מומלצת', 'מומחית')
                    ),
                    array(
                        'name' => 'אורלי כהן',
                        'profession' => 'יועצת הנקה מוסמכת',
                        'location' => 'רמת גן',
                        'rating' => 4.8,
                        'reviews' => 203,
                        'experience' => '10 שנות ניסיון',
                        'specialties' => array('הנקה', 'שינת תינוקות', 'גמילה'),
                        'price_range' => '₪150-250',
                        'availability' => 'זמינה מיד',
                        'verified' => true,
                        'category' => 'therapy',
                        'avatar' => '🤱',
                        'badges' => array('חדשה')
                    ),
                    array(
                        'name' => 'מיכל דוד',
                        'profession' => 'מדריכת הכנה ללידה',
                        'location' => 'ירושלים',
                        'rating' => 4.7,
                        'reviews' => 89,
                        'experience' => '8 שנות ניסיון',
                        'specialties' => array('לידה טבעית', 'טכניקות נשימה', 'עמדות לידה'),
                        'price_range' => '₪180-300',
                        'availability' => 'זמינה בשבוע הבא',
                        'verified' => false,
                        'category' => 'education',
                        'avatar' => '🧘‍♀️',
                        'badges' => array()
                    ),
                    array(
                        'name' => 'שרה אברהם',
                        'profession' => 'דיאטנית קלינית',
                        'location' => 'חיפה',
                        'rating' => 4.6,
                        'reviews' => 67,
                        'experience' => '12 שנות ניסיון',
                        'specialties' => array('תזונה בהריון', 'תזונה להנקה', 'אלרגיות מזון'),
                        'price_range' => '₪120-200',
                        'availability' => 'זמינה השבוע',
                        'verified' => true,
                        'category' => 'nutrition',
                        'avatar' => '🥗',
                        'badges' => array('מומחית')
                    )
                );
                
                foreach ($demo_providers as $provider) : ?>
                    <div class="provider-card" data-category="<?php echo $provider['category']; ?>">
                        <?php if (!empty($provider['badges'])) : ?>
                            <div class="provider-badges">
                                <?php foreach ($provider['badges'] as $badge) : ?>
                                    <span class="provider-badge"><?php echo $badge; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="provider-header">
                            <div class="provider-avatar">
                                <span class="provider-emoji"><?php echo $provider['avatar']; ?></span>
                                <?php if ($provider['verified']) : ?>
                                    <span class="verified-badge" title="<?php _e('ספק מאומת', 'babyhub'); ?>">✓</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="provider-basic-info">
                                <h3 class="provider-name"><?php echo $provider['name']; ?></h3>
                                <p class="provider-profession"><?php echo $provider['profession']; ?></p>
                                <div class="provider-location">
                                    <i class="icon-location"></i>
                                    <?php echo $provider['location']; ?>
                                </div>
                            </div>
                            
                            <div class="provider-quick-actions">
                                <button class="action-btn favorite" title="<?php _e('הוסף למועדפים', 'babyhub'); ?>">
                                    <i class="icon-heart"></i>
                                </button>
                                <button class="action-btn share" title="<?php _e('שתף', 'babyhub'); ?>">
                                    <i class="icon-share"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="provider-details">
                            <div class="provider-rating">
                                <div class="stars">
                                    <?php
                                    $full_stars = floor($provider['rating']);
                                    $half_star = $provider['rating'] - $full_stars >= 0.5;
                                    
                                    for ($i = 0; $i < $full_stars; $i++) {
                                        echo '⭐';
                                    }
                                    if ($half_star) {
                                        echo '✨';
                                    }
                                    ?>
                                </div>
                                <span class="rating-text">
                                    <?php echo $provider['rating']; ?> (<?php echo $provider['reviews']; ?> <?php _e('ביקורות', 'babyhub'); ?>)
                                </span>
                            </div>
                            
                            <div class="provider-experience">
                                <i class="icon-time"></i>
                                <?php echo $provider['experience']; ?>
                            </div>
                            
                            <div class="provider-specialties">
                                <strong><?php _e('התמחויות:', 'babyhub'); ?></strong>
                                <div class="specialties-list">
                                    <?php foreach ($provider['specialties'] as $specialty) : ?>
                                        <span class="specialty-tag"><?php echo $specialty; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="provider-pricing">
                                <div class="price-info">
                                    <i class="icon-money"></i>
                                    <span class="price-range"><?php echo $provider['price_range']; ?></span>
                                </div>
                                <div class="availability-info">
                                    <i class="icon-calendar"></i>
                                    <span class="availability"><?php echo $provider['availability']; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="provider-actions">
                            <button class="btn btn-primary contact-provider">
                                <i class="icon-phone"></i>
                                <?php _e('צרי קשר', 'babyhub'); ?>
                            </button>
                            <button class="btn btn-secondary book-appointment">
                                <i class="icon-calendar"></i>
                                <?php _e('הזמני פגישה', 'babyhub'); ?>
                            </button>
                            <a href="#" class="btn btn-outline view-profile">
                                <?php _e('צפי בפרופיל', 'babyhub'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="section-footer">
                <button class="btn btn-outline load-more">
                    <?php _e('טען עוד ספקים', 'babyhub'); ?>
                </button>
            </div>
        </section>

        <!-- Directory Features -->
        <section class="directory-features">
            <h2><?php _e('למה לבחור במדריך שלנו?', 'babyhub'); ?></h2>
            
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">✅</div>
                    <h3><?php _e('ספקים מאומתים', 'babyhub'); ?></h3>
                    <p><?php _e('כל ספקי השירות עוברים תהליך אימות מקיף לפני ההצטרפות', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">⭐</div>
                    <h3><?php _e('ביקורות אמיתיות', 'babyhub'); ?></h3>
                    <p><?php _e('ביקורות מאמהות אמיתיות מהקהילה שלנו', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">📱</div>
                    <h3><?php _e('הזמנה נוחה', 'babyhub'); ?></h3>
                    <p><?php _e('הזמני פגישות ישירות דרך האתר או האפליקציה', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">💬</div>
                    <h3><?php _e('תמיכה מלאה', 'babyhub'); ?></h3>
                    <p><?php _e('צוות התמיכה שלנו כאן לעזור לך למצוא את הספק המתאים', 'babyhub'); ?></p>
                </div>
            </div>
        </section>

        <!-- Add Your Business -->
        <section class="add-business">
            <div class="business-cta-content">
                <div class="cta-text">
                    <h2><?php _e('ספקת שירותים?', 'babyhub'); ?></h2>
                    <p><?php _e('הצטרפי למדריך שלנו וחשפי את השירותים שלך לאלפי אמהות מחפשות', 'babyhub'); ?></p>
                    <ul class="business-benefits">
                        <li><?php _e('חשיפה לאלפי לקוחות פוטנציאליות', 'babyhub'); ?></li>
                        <li><?php _e('ניהול פגישות ולקוחות במקום אחד', 'babyhub'); ?></li>
                        <li><?php _e('דף פרופיל מקצועי ומותאם אישית', 'babyhub'); ?></li>
                        <li><?php _e('מערכת ביקורות ודירוגים', 'babyhub'); ?></li>
                    </ul>
                </div>
                <div class="cta-actions">
                    <button class="btn btn-primary btn-large add-business-btn">
                        <i class="icon-plus"></i>
                        <?php _e('הוסף את העסק שלך', 'babyhub'); ?>
                    </button>
                    <a href="#" class="btn btn-secondary"><?php _e('למד עוד', 'babyhub'); ?></a>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Advanced filters toggle
    $('.toggle-filters').on('click', function() {
        const $filters = $('.advanced-filters');
        const $icon = $(this).find('i');
        
        $filters.slideToggle();
        $icon.toggleClass('icon-filter icon-filter-off');
    });
    
    // Category filter
    $('.category-card').on('click', function() {
        const category = $(this).data('category');
        filterProvidersByCategory(category);
        
        // Update search form
        $('.search-category').val(category);
        
        // Scroll to results
        $('html, body').animate({
            scrollTop: $('.featured-providers').offset().top - 100
        }, 800);
    });
    
    function filterProvidersByCategory(category) {
        const $providers = $('.provider-card');
        
        if (!category || category === 'all') {
            $providers.show();
        } else {
            $providers.hide();
            $providers.filter('[data-category="' + category + '"]').show();
        }
        
        // Animate the filtering
        $providers.css('opacity', 0);
        setTimeout(() => {
            $providers.filter(':visible').animate({ opacity: 1 }, 300);
        }, 100);
    }
    
    // Provider actions
    $('.contact-provider').on('click', function() {
        const providerName = $(this).closest('.provider-card').find('.provider-name').text();
        
        // Show contact modal or redirect to contact form
        showContactModal(providerName);
    });
    
    $('.book-appointment').on('click', function() {
        const providerName = $(this).closest('.provider-card').find('.provider-name').text();
        
        // Show booking modal or redirect to booking system
        showBookingModal(providerName);
    });
    
    function showContactModal(providerName) {
        const $modal = $('<div class="contact-modal-overlay">' +
            '<div class="contact-modal">' +
                '<div class="modal-header">' +
                    '<h3><?php _e("צור קשר עם", "babyhub"); ?> ' + providerName + '</h3>' +
                    '<button class="modal-close">×</button>' +
                '</div>' +
                '<div class="modal-body">' +
                    '<form class="contact-form">' +
                        '<div class="form-group">' +
                            '<label><?php _e("השם שלך", "babyhub"); ?></label>' +
                            '<input type="text" class="form-control" required>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label><?php _e("אימייל", "babyhub"); ?></label>' +
                            '<input type="email" class="form-control" required>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label><?php _e("טלפון", "babyhub"); ?></label>' +
                            '<input type="tel" class="form-control">' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label><?php _e("הודעה", "babyhub"); ?></label>' +
                            '<textarea class="form-control" rows="4" required></textarea>' +
                        '</div>' +
                        '<div class="form-actions">' +
                            '<button type="submit" class="btn btn-primary"><?php _e("שלח הודעה", "babyhub"); ?></button>' +
                            '<button type="button" class="btn btn-secondary modal-close"><?php _e("ביטול", "babyhub"); ?></button>' +
                        '</div>' +
                    '</form>' +
                '</div>' +
            '</div>' +
        '</div>');
        
        $('body').append($modal);
        $modal.fadeIn();
        
        // Close modal handlers
        $modal.on('click', '.modal-close, .contact-modal-overlay', function(e) {
            if (e.target === this) {
                $modal.fadeOut(function() {
                    $modal.remove();
                });
            }
        });
        
        // Form submission
        $modal.on('submit', '.contact-form', function(e) {
            e.preventDefault();
            alert('<?php _e("ההודעה נשלחה בהצלחה!", "babyhub"); ?>');
            $modal.fadeOut(function() {
                $modal.remove();
            });
        });
    }
    
    function showBookingModal(providerName) {
        alert('<?php _e("מערכת הזמנת פגישות תהיה זמינה בקרוב", "babyhub"); ?>');
    }
    
    // Favorite functionality
    $('.favorite').on('click', function() {
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
    
    // Share functionality
    $('.share').on('click', function() {
        const providerName = $(this).closest('.provider-card').find('.provider-name').text();
        
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("ספק שירות ב-Baby-Hub", "babyhub"); ?>',
                text: '<?php _e("מצאתי ספק שירות מעולה:", "babyhub"); ?> ' + providerName,
                url: window.location.href
            });
        } else {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('<?php _e("הקישור הועתק ללוח", "babyhub"); ?>');
            });
        }
    });
    
    // Load more providers
    $('.load-more').on('click', function() {
        const $btn = $(this);
        $btn.html('<i class="icon-loading"></i> <?php _e("טוען...", "babyhub"); ?>').prop('disabled', true);
        
        // Simulate loading more providers
        setTimeout(function() {
            $btn.html('<?php _e("טען עוד ספקים", "babyhub"); ?>').prop('disabled', false);
            alert('<?php _e("אין עוד ספקים להציג", "babyhub"); ?>');
        }, 1500);
    });
    
    // Add business functionality
    $('.add-business-btn').on('click', function() {
        // Would redirect to business registration form
        alert('<?php _e("טופס הוספת עסק יהיה זמין בקרוב", "babyhub"); ?>');
    });
    
    // Directory search
    $('.directory-search-form').on('submit', function(e) {
        e.preventDefault();
        
        const searchTerm = $('.search-field').val();
        const category = $('.search-category').val();
        const location = $('.search-location').val();
        
        // Simulate search functionality
        console.log('Searching for:', { searchTerm, category, location });
        
        // In real implementation, this would trigger AJAX search
        if (category) {
            filterProvidersByCategory(category);
        }
    });
});
</script>

<style>
/* Contact Modal Styles */
.contact-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
}

.contact-modal {
    background: white;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
}

.contact-modal .modal-header {
    padding: 2rem 2rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
}

.contact-modal .modal-body {
    padding: 2rem;
}

.contact-modal .modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #999;
}

.contact-modal .modal-close:hover {
    color: #FF6B9D;
}

.contact-form .form-group {
    margin-bottom: 1.5rem;
}

.contact-form .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
}

/* Provider card animations */
@keyframes providerCardHover {
    from {
        transform: translateY(0);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    to {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
}

.provider-card:hover {
    animation: providerCardHover 0.3s ease forwards;
}

/* Responsive adjustments for directory */
@media (max-width: 768px) {
    .directory-search .search-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .provider-actions {
        flex-direction: column;
    }
    
    .provider-actions .btn {
        width: 100%;
    }
    
    .categories-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .providers-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>