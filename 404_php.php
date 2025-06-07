<?php
/**
 * 404 Error Page Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main error-404">
    <div class="container">
        <div class="error-content">
            
            <!-- Error Header -->
            <header class="error-header">
                <div class="error-number">404</div>
                <h1 class="error-title"><?php _e('אופס! העמוד לא נמצא', 'babyhub'); ?></h1>
                <p class="error-description">
                    <?php _e('מצטערים, העמוד שחיפשת לא קיים או הועבר למקום אחר.', 'babyhub'); ?>
                </p>
            </header>

            <!-- Error Illustration -->
            <div class="error-illustration">
                <div class="baby-icon">👶</div>
                <div class="error-message">
                    <?php _e('התינוק שלנו חיפש בכל מקום ולא מצא את העמוד...', 'babyhub'); ?>
                </div>
            </div>

            <!-- Search Section -->
            <section class="error-search">
                <h2><?php _e('בואו ננסה לחפש משהו אחר', 'babyhub'); ?></h2>
                <div class="search-form-container">
                    <?php get_search_form(); ?>
                </div>
            </section>

            <!-- Popular Content -->
            <section class="popular-content">
                <h2><?php _e('תוכן פופולרי', 'babyhub'); ?></h2>
                
                <div class="popular-grid">
                    
                    <!-- Popular Posts -->
                    <div class="popular-section">
                        <h3><?php _e('פוסטים פופולריים', 'babyhub'); ?></h3>
                        <?php
                        $popular_posts = get_posts(array(
                            'numberposts' => 4,
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC'
                        ));
                        
                        if (!$popular_posts) {
                            // Fallback to recent posts if no view counts
                            $popular_posts = get_posts(array(
                                'numberposts' => 4,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));
                        }
                        
                        if ($popular_posts) : ?>
                            <ul class="popular-posts-list">
                                <?php foreach ($popular_posts as $post) : setup_postdata($post); ?>
                                    <li class="popular-post-item">
                                        <a href="<?php the_permalink(); ?>" class="popular-post-link">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="popular-post-thumb">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="popular-post-content">
                                                <h4 class="popular-post-title"><?php the_title(); ?></h4>
                                                <span class="popular-post-date">
                                                    <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d')); ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Popular Tools -->
                    <div class="popular-section">
                        <h3><?php _e('כלים פופולריים', 'babyhub'); ?></h3>
                        <ul class="popular-tools-list">
                            <li class="popular-tool-item">
                                <a href="<?php echo home_url('/tools/#ovulation-calculator'); ?>" class="popular-tool-link">
                                    <span class="tool-icon">🥚</span>
                                    <span class="tool-name"><?php _e('חישוב ביוץ', 'babyhub'); ?></span>
                                </a>
                            </li>
                            <li class="popular-tool-item">
                                <a href="<?php echo home_url('/tools/#due-date-calculator'); ?>" class="popular-tool-link">
                                    <span class="tool-icon">📅</span>
                                    <span class="tool-name"><?php _e('חישוב תאריך לידה', 'babyhub'); ?></span>
                                </a>
                            </li>
                            <li class="popular-tool-item">
                                <a href="<?php echo home_url('/tools/#gender-predictor'); ?>" class="popular-tool-link">
                                    <span class="tool-icon">👶</span>
                                    <span class="tool-name"><?php _e('ניחוש מין תינוק', 'babyhub'); ?></span>
                                </a>
                            </li>
                            <li class="popular-tool-item">
                                <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="popular-tool-link">
                                    <span class="tool-icon">🤱</span>
                                    <span class="tool-name"><?php _e('מעקב הריון', 'babyhub'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="popular-section">
                        <h3><?php _e('קטגוריות', 'babyhub'); ?></h3>
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 6,
                            'hide_empty' => true
                        ));
                        
                        if ($categories) : ?>
                            <ul class="categories-list">
                                <?php foreach ($categories as $category) : ?>
                                    <li class="category-item">
                                        <a href="<?php echo get_category_link($category->term_id); ?>" class="category-link">
                                            <span class="category-name"><?php echo $category->name; ?></span>
                                            <span class="category-count">(<?php echo $category->count; ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Contact Info -->
                    <div class="popular-section">
                        <h3><?php _e('זקוקים לעזרה?', 'babyhub'); ?></h3>
                        <div class="help-options">
                            <p><?php _e('אם אתם לא מוצאים מה שחיפשתם, נשמח לעזור:', 'babyhub'); ?></p>
                            <ul class="help-list">
                                <li class="help-item">
                                    <a href="<?php echo home_url('/contact/'); ?>" class="help-link">
                                        <i class="icon-mail"></i>
                                        <?php _e('צרו קשר', 'babyhub'); ?>
                                    </a>
                                </li>
                                <li class="help-item">
                                    <a href="<?php echo home_url('/community/'); ?>" class="help-link">
                                        <i class="icon-users"></i>
                                        <?php _e('קהילת בייבי-האב', 'babyhub'); ?>
                                    </a>
                                </li>
                                <li class="help-item">
                                    <a href="<?php echo home_url('/faq/'); ?>" class="help-link">
                                        <i class="icon-help"></i>
                                        <?php _e('שאלות נפוצות', 'babyhub'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Back to Home -->
            <section class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-large">
                    <i class="icon-home"></i>
                    <?php _e('חזור לעמוד הבית', 'babyhub'); ?>
                </a>
                
                <button type="button" class="btn btn-secondary" onclick="history.back()">
                    <i class="icon-arrow-right"></i>
                    <?php _e('חזור לעמוד הקודם', 'babyhub'); ?>
                </button>
            </section>

        </div>
    </div>
</main>

<style>
/* 404 Page Specific Styles */
.error-404 {
    padding: 4rem 0;
    text-align: center;
}

.error-content {
    max-width: 800px;
    margin: 0 auto;
}

.error-header {
    margin-bottom: 3rem;
}

.error-number {
    font-size: 8rem;
    font-weight: 700;
    color: #FF6B9D;
    line-height: 1;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.error-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.error-description {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
}

.error-illustration {
    margin: 3rem 0;
}

.baby-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

.error-message {
    font-style: italic;
    color: #666;
    margin-bottom: 2rem;
}

.error-search {
    margin: 3rem 0;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.error-search h2 {
    margin-bottom: 1.5rem;
    color: #2c3e50;
}

.search-form-container {
    max-width: 400px;
    margin: 0 auto;
}

.popular-content {
    margin: 4rem 0;
    text-align: right;
}

.popular-content h2 {
    text-align: center;
    margin-bottom: 3rem;
    color: #2c3e50;
}

.popular-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.popular-section {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.popular-section h3 {
    margin-bottom: 1rem;
    color: #FF6B9D;
    font-size: 1.2rem;
    border-bottom: 2px solid #FF6B9D;
    padding-bottom: 0.5rem;
}

.popular-posts-list,
.popular-tools-list,
.categories-list,
.help-list {
    list-style: none;
    padding: 0;
}

.popular-post-item,
.popular-tool-item,
.category-item,
.help-item {
    margin-bottom: 0.75rem;
    border-bottom: 1px solid #eee;
    padding-bottom: 0.75rem;
}

.popular-post-item:last-child,
.popular-tool-item:last-child,
.category-item:last-child,
.help-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.popular-post-link,
.popular-tool-link,
.category-link,
.help-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    transition: color 0.3s ease;
}

.popular-post-link:hover,
.popular-tool-link:hover,
.category-link:hover,
.help-link:hover {
    color: #FF6B9D;
}

.popular-post-thumb {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    overflow: hidden;
    margin-left: 1rem;
    flex-shrink: 0;
}

.popular-post-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popular-post-content {
    flex: 1;
}

.popular-post-title {
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.popular-post-date {
    font-size: 0.8rem;
    color: #666;
}

.tool-icon {
    margin-left: 0.5rem;
    font-size: 1.2rem;
}

.tool-name {
    font-weight: 500;
}

.category-count {
    color: #666;
    font-size: 0.9rem;
    margin-right: 0.5rem;
}

.help-options p {
    margin-bottom: 1rem;
    color: #666;
}

.help-link i {
    margin-left: 0.5rem;
    color: #FF6B9D;
}

.error-actions {
    margin-top: 3rem;
}

.error-actions .btn {
    margin: 0 0.5rem 1rem;
}

.btn-large {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .error-number {
        font-size: 6rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .popular-grid {
        grid-template-columns: 1fr;
    }
    
    .error-actions .btn {
        display: block;
        width: 100%;
        margin: 0 0 1rem;
    }
}

@media (max-width: 480px) {
    .error-404 {
        padding: 2rem 0;
    }
    
    .error-number {
        font-size: 4rem;
    }
    
    .error-title {
        font-size: 1.5rem;
    }
    
    .popular-section {
        padding: 1rem;
    }
}
</style>

<?php get_footer(); ?>