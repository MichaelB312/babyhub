<?php
/**
 * Sidebar Template
 * Baby-Hub Hebrew RTL Theme
 */

// Skip sidebar on specific pages
if (is_page_template('page-tools.php') || is_page_template('page-community.php')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar" role="complementary">
    <div class="sidebar-content">
        
        <?php if (is_active_sidebar('sidebar-main')) : ?>
            <?php dynamic_sidebar('sidebar-main'); ?>
        <?php else : ?>
            
            <!-- Default Sidebar Content -->
            
            <!-- Search Widget -->
            <div class="widget widget-search">
                <h3 class="widget-title"><?php _e('חיפוש באתר', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <!-- Popular Tools Widget -->
            <div class="widget widget-tools">
                <h3 class="widget-title"><?php _e('כלים פופולריים', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <ul class="tools-list">
                        <li class="tool-item">
                            <a href="<?php echo home_url('/tools/#ovulation-calculator'); ?>" class="tool-link">
                                <span class="tool-icon">🥚</span>
                                <span class="tool-name"><?php _e('חישוב ביוץ', 'babyhub'); ?></span>
                            </a>
                        </li>
                        <li class="tool-item">
                            <a href="<?php echo home_url('/tools/#due-date-calculator'); ?>" class="tool-link">
                                <span class="tool-icon">📅</span>
                                <span class="tool-name"><?php _e('חישוב תאריך לידה', 'babyhub'); ?></span>
                            </a>
                        </li>
                        <li class="tool-item">
                            <a href="<?php echo home_url('/tools/#gender-predictor'); ?>" class="tool-link">
                                <span class="tool-icon">👶</span>
                                <span class="tool-name"><?php _e('ניחוש מין תינוק', 'babyhub'); ?></span>
                            </a>
                        </li>
                        <li class="tool-item">
                            <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="tool-link">
                                <span class="tool-icon">🤱</span>
                                <span class="tool-name"><?php _e('מעקב הריון', 'babyhub'); ?></span>
                            </a>
                        </li>
                        <li class="tool-item">
                            <a href="<?php echo home_url('/tools/#baby-names'); ?>" class="tool-link">
                                <span class="tool-icon">📝</span>
                                <span class="tool-name"><?php _e('מאגר שמות תינוקות', 'babyhub'); ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="tools-footer">
                        <a href="<?php echo home_url('/tools/'); ?>" class="btn btn-secondary btn-small">
                            <?php _e('צפה בכל הכלים', 'babyhub'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Posts Widget -->
            <div class="widget widget-recent-posts">
                <h3 class="widget-title"><?php _e('פוסטים אחרונים', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <?php
                    $recent_posts = get_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    
                    if ($recent_posts) : ?>
                        <ul class="recent-posts-list">
                            <?php foreach ($recent_posts as $post) : setup_postdata($post); ?>
                                <li class="recent-post-item">
                                    <article class="recent-post">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="recent-post-thumbnail">
                                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('thumbnail', array('loading' => 'lazy')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="recent-post-content">
                                            <h4 class="recent-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <div class="recent-post-meta">
                                                <time datetime="<?php echo get_the_date('c'); ?>" class="recent-post-date">
                                                    <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d')); ?>
                                                </time>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="widget widget-categories">
                <h3 class="widget-title"><?php _e('קטגוריות', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order' => 'DESC',
                        'number' => 8,
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
            </div>

            <!-- Pregnancy Week Widget -->
            <?php
            $current_week = get_posts(array(
                'post_type' => 'pregnancy_week',
                'numberposts' => 1,
                'orderby' => 'rand'
            ));
            
            if ($current_week) : ?>
                <div class="widget widget-pregnancy-week">
                    <h3 class="widget-title"><?php _e('שבוע הריון היום', 'babyhub'); ?></h3>
                    <div class="widget-content">
                        <?php foreach ($current_week as $post) : setup_postdata($post); ?>
                            <article class="pregnancy-week-card">
                                <div class="week-header">
                                    <span class="week-number">
                                        <?php
                                        $week_number = get_post_meta(get_the_ID(), '_week_number', true);
                                        echo $week_number ? $week_number : '20';
                                        ?>
                                    </span>
                                    <span class="week-label"><?php _e('שבוע', 'babyhub'); ?></span>
                                </div>
                                
                                <div class="week-content">
                                    <h4 class="week-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    
                                    <div class="week-info">
                                        <?php
                                        $baby_size = get_post_meta(get_the_ID(), '_baby_size', true);
                                        if ($baby_size) : ?>
                                            <div class="baby-size">
                                                <strong><?php _e('גודל התינוק:', 'babyhub'); ?></strong>
                                                <?php echo $baby_size; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="week-link">
                                        <?php _e('קרא עוד', 'babyhub'); ?>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Community Widget -->
            <div class="widget widget-community">
                <h3 class="widget-title"><?php _e('הצטרפי לקהילה', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <div class="community-info">
                        <p><?php _e('הצטרפי לאלפי אמהות ואבות שמשתפים חוויות ותומכים זה בזה', 'babyhub'); ?></p>
                        
                        <div class="community-stats">
                            <div class="stat-item">
                                <span class="stat-number">15,234</span>
                                <span class="stat-label"><?php _e('חברים', 'babyhub'); ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">2,486</span>
                                <span class="stat-label"><?php _e('דיונים פעילים', 'babyhub'); ?></span>
                            </div>
                        </div>
                        
                        <a href="<?php echo home_url('/community/'); ?>" class="btn btn-primary btn-small">
                            <?php _e('הצטרף עכשיו', 'babyhub'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Newsletter Widget -->
            <div class="widget widget-newsletter">
                <h3 class="widget-title"><?php _e('עדכונים שבועיים', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <div class="newsletter-info">
                        <p><?php _e('קבלי עדכונים שבועיים עם טיפים, מידע רפואי ותוכן מותאם לשלב ההריון שלך', 'babyhub'); ?></p>
                        
                        <form class="newsletter-form" action="#" method="post">
                            <div class="form-group">
                                <input 
                                    type="email" 
                                    name="newsletter_email" 
                                    class="form-control" 
                                    placeholder="<?php _e('כתובת האימייל שלך', 'babyhub'); ?>"
                                    required
                                />
                            </div>
                            <button type="submit" class="btn btn-secondary btn-small">
                                <?php _e('הרשמה', 'babyhub'); ?>
                            </button>
                        </form>
                        
                        <small class="newsletter-note">
                            <?php _e('ללא ספאם, ניתן לבטל בכל עת', 'babyhub'); ?>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Social Media Widget -->
            <div class="widget widget-social">
                <h3 class="widget-title"><?php _e('עקבו אחרינו', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <div class="social-links">
                        <a href="#" class="social-link facebook" target="_blank" rel="noopener">
                            <i class="icon-facebook"></i>
                            <span><?php _e('פייסבוק', 'babyhub'); ?></span>
                        </a>
                        <a href="#" class="social-link instagram" target="_blank" rel="noopener">
                            <i class="icon-instagram"></i>
                            <span><?php _e('אינסטגרם', 'babyhub'); ?></span>
                        </a>
                        <a href="#" class="social-link youtube" target="_blank" rel="noopener">
                            <i class="icon-youtube"></i>
                            <span><?php _e('יוטיוב', 'babyhub'); ?></span>
                        </a>
                        <a href="#" class="social-link telegram" target="_blank" rel="noopener">
                            <i class="icon-telegram"></i>
                            <span><?php _e('טלגרם', 'babyhub'); ?></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Emergency Contacts Widget -->
            <div class="widget widget-emergency">
                <h3 class="widget-title"><?php _e('מספרי חירום', 'babyhub'); ?></h3>
                <div class="widget-content">
                    <div class="emergency-info">
                        <ul class="emergency-list">
                            <li class="emergency-item">
                                <strong><?php _e('מד"א:', 'babyhub'); ?></strong>
                                <a href="tel:101" class="emergency-phone">101</a>
                            </li>
                            <li class="emergency-item">
                                <strong><?php _e('משטרה:', 'babyhub'); ?></strong>
                                <a href="tel:100" class="emergency-phone">100</a>
                            </li>
                            <li class="emergency-item">
                                <strong><?php _e('כבאות:', 'babyhub'); ?></strong>
                                <a href="tel:102" class="emergency-phone">102</a>
                            </li>
                            <li class="emergency-item">
                                <strong><?php _e('מרכז רעילות:', 'babyhub'); ?></strong>
                                <a href="tel:1201" class="emergency-phone">1201</a>
                            </li>
                        </ul>
                        
                        <div class="emergency-note">
                            <small>
                                <?php _e('במקרה חירום פנו מיד לחדר מיון או התקשרו למד"א', 'babyhub'); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        
    </div>
</aside>

<style>
/* Sidebar Styles */
.sidebar {
    background: #f8f9fa;
    padding: 2rem 1rem;
    border-radius: 10px;
}

.sidebar-content {
    max-width: 100%;
}

.widget {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.widget:last-child {
    margin-bottom: 0;
}

.widget-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #FF6B9D;
}

.widget-content {
    color: #666;
}

/* Tools Widget */
.tools-list {
    list-style: none;
    padding: 0;
}

.tool-item {
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #eee;
}

.tool-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.tool-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    transition: color 0.3s ease;
}

.tool-link:hover {
    color: #FF6B9D;
}

.tool-icon {
    margin-left: 0.5rem;
    font-size: 1.1rem;
}

.tool-name {
    font-weight: 500;
}

.tools-footer {
    margin-top: 1rem;
    text-align: center;
}

/* Recent Posts Widget */
.recent-posts-list {
    list-style: none;
    padding: 0;
}

.recent-post-item {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.recent-post-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.recent-post {
    display: flex;
    align-items: flex-start;
}

.recent-post-thumbnail {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    overflow: hidden;
    margin-left: 1rem;
    flex-shrink: 0;
}

.recent-post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.recent-post-content {
    flex: 1;
}

.recent-post-title {
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.recent-post-title a {
    color: #333;
    text-decoration: none;
}

.recent-post-title a:hover {
    color: #FF6B9D;
}

.recent-post-date {
    font-size: 0.8rem;
    color: #999;
}

/* Categories Widget */
.categories-list {
    list-style: none;
    padding: 0;
}

.category-item {
    margin-bottom: 0.5rem;
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    color: #333;
    padding: 0.25rem 0;
    transition: color 0.3s ease;
}

.category-link:hover {
    color: #FF6B9D;
}

.category-count {
    font-size: 0.8rem;
    color: #999;
}

/* Pregnancy Week Widget */
.pregnancy-week-card {
    text-align: center;
    padding: 1rem;
    background: linear-gradient(135deg, #FF6B9D, #4ECDC4);
    color: white;
    border-radius: 10px;
}

.week-header {
    margin-bottom: 1rem;
}

.week-number {
    font-size: 2rem;
    font-weight: 700;
    display: block;
}

.week-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

.week-title a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
}

.week-title a:hover {
    text-decoration: underline;
}

.week-info {
    margin: 0.75rem 0;
    font-size: 0.9rem;
}

.week-link {
    color: white;
    text-decoration: none;
    font-weight: 500;
}

.week-link:hover {
    text-decoration: underline;
}

/* Community Widget */
.community-stats {
    display: flex;
    justify-content: space-between;
    margin: 1rem 0;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.2rem;
    font-weight: 700;
    color: #FF6B9D;
}

.stat-label {
    font-size: 0.8rem;
    color: #999;
}

/* Newsletter Widget */
.newsletter-form {
    margin: 1rem 0;
}

.newsletter-form .form-group {
    margin-bottom: 0.75rem;
}

.newsletter-note {
    color: #999;
    font-size: 0.8rem;
    text-align: center;
    display: block;
    margin-top: 0.5rem;
}

/* Social Media Widget */
.social-links {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
}

.social-link {
    display: flex;
    align-items: center;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 5px;
    text-decoration: none;
    color: #666;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #FF6B9D;
    color: white;
}

.social-link i {
    margin-left: 0.5rem;
    font-size: 1.1rem;
}

.social-link span {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Emergency Widget */
.emergency-list {
    list-style: none;
    padding: 0;
}

.emergency-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
}

.emergency-item:last-child {
    border-bottom: none;
}

.emergency-phone {
    color: #e74c3c;
    font-weight: 700;
    text-decoration: none;
}

.emergency-phone:hover {
    text-decoration: underline;
}

.emergency-note {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        padding: 1rem;
    }
    
    .widget {
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .social-links {
        grid-template-columns: 1fr;
    }
    
    .community-stats {
        justify-content: center;
        gap: 2rem;
    }
}
</style>