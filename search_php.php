<?php
/**
 * Search Results Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main search-results">
    <div class="container">
        
        <!-- Search Header -->
        <header class="search-header">
            <h1 class="search-title">
                <?php if (have_posts()) : ?>
                    <span class="search-label"><?php _e('תוצאות חיפוש עבור:', 'babyhub'); ?></span>
                    <span class="search-term">"<?php echo get_search_query(); ?>"</span>
                <?php else : ?>
                    <?php _e('לא נמצאו תוצאות', 'babyhub'); ?>
                <?php endif; ?>
            </h1>
            
            <?php if (have_posts()) : ?>
                <div class="search-meta">
                    <span class="results-count">
                        <?php
                        global $wp_query;
                        $total = $wp_query->found_posts;
                        printf(_n('%s תוצאה נמצאה', '%s תוצאות נמצאו', $total, 'babyhub'), number_format_i18n($total));
                        ?>
                    </span>
                </div>
            <?php endif; ?>
        </header>

        <!-- Search Form -->
        <div class="search-form-section">
            <div class="search-again">
                <h3><?php _e('חפש שוב', 'babyhub'); ?></h3>
                <?php get_search_form(); ?>
            </div>
        </div>

        <?php if (have_posts()) : ?>
            
            <!-- Search Filters -->
            <div class="search-filters">
                <div class="filter-row">
                    <!-- Content Type Filter -->
                    <div class="filter-group">
                        <label for="content-type"><?php _e('סוג תוכן:', 'babyhub'); ?></label>
                        <select id="content-type" class="form-control">
                            <option value=""><?php _e('הכל', 'babyhub'); ?></option>
                            <option value="post"><?php _e('פוסטים', 'babyhub'); ?></option>
                            <option value="page"><?php _e('עמודים', 'babyhub'); ?></option>
                            <option value="babyhub_tool"><?php _e('כלים', 'babyhub'); ?></option>
                            <option value="pregnancy_week"><?php _e('שבועות הריון', 'babyhub'); ?></option>
                            <option value="directory_listing"><?php _e('ספקים', 'babyhub'); ?></option>
                        </select>
                    </div>
                    
                    <!-- Sort Options -->
                    <div class="filter-group">
                        <label for="sort-results"><?php _e('מיין לפי:', 'babyhub'); ?></label>
                        <select id="sort-results" class="form-control">
                            <option value="relevance"><?php _e('רלוונטיות', 'babyhub'); ?></option>
                            <option value="date"><?php _e('תאריך', 'babyhub'); ?></option>
                            <option value="title"><?php _e('כותרת', 'babyhub'); ?></option>
                        </select>
                    </div>
                    
                    <!-- View Options -->
                    <div class="filter-group">
                        <label><?php _e('תצוגה:', 'babyhub'); ?></label>
                        <button type="button" class="view-btn active" data-view="list">
                            <i class="icon-list"></i> <?php _e('רשימה', 'babyhub'); ?>
                        </button>
                        <button type="button" class="view-btn" data-view="grid">
                            <i class="icon-grid"></i> <?php _e('רשת', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search Results -->
            <div class="search-results-container">
                <div class="results-list view-list">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                            
                            <!-- Result Header -->
                            <header class="result-header">
                                
                                <!-- Post Type Badge -->
                                <span class="post-type-badge">
                                    <?php
                                    $post_type = get_post_type();
                                    switch ($post_type) {
                                        case 'post':
                                            echo '<i class="icon-post"></i> ' . __('פוסט', 'babyhub');
                                            break;
                                        case 'page':
                                            echo '<i class="icon-page"></i> ' . __('עמוד', 'babyhub');
                                            break;
                                        case 'babyhub_tool':
                                            echo '<i class="icon-tool"></i> ' . __('כלי', 'babyhub');
                                            break;
                                        case 'pregnancy_week':
                                            echo '<i class="icon-calendar"></i> ' . __('שבוע הריון', 'babyhub');
                                            break;
                                        case 'directory_listing':
                                            echo '<i class="icon-location"></i> ' . __('ספק', 'babyhub');
                                            break;
                                        default:
                                            echo '<i class="icon-file"></i> ' . get_post_type_object($post_type)->labels->singular_name;
                                    }
                                    ?>
                                </span>
                                
                                <!-- Result Title -->
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <!-- Result Meta -->
                                <div class="result-meta">
                                    <span class="result-date">
                                        <i class="icon-calendar"></i>
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d')); ?>
                                        </time>
                                    </span>
                                    
                                    <?php if (get_post_type() === 'post' && get_the_category()) : ?>
                                        <span class="result-category">
                                            <i class="icon-folder"></i>
                                            <?php
                                            $categories = get_the_category();
                                            echo '<a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a>';
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <span class="result-author">
                                        <i class="icon-user"></i>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                </div>
                            </header>

                            <!-- Result Content -->
                            <div class="result-content">
                                
                                <!-- Thumbnail -->
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="result-thumbnail">
                                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Excerpt -->
                                <div class="result-excerpt">
                                    <?php
                                    $search_query = get_search_query();
                                    $excerpt = '';
                                    
                                    if (has_excerpt()) {
                                        $excerpt = get_the_excerpt();
                                    } else {
                                        $excerpt = wp_trim_words(get_the_content(), 30, '...');
                                    }
                                    
                                    // Highlight search terms
                                    if ($search_query) {
                                        $excerpt = preg_replace(
                                            '/(' . preg_quote($search_query, '/') . ')/iu',
                                            '<mark>$1</mark>',
                                            $excerpt
                                        );
                                    }
                                    
                                    echo $excerpt;
                                    ?>
                                </div>

                                <!-- Result Actions -->
                                <div class="result-actions">
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php _e('קרא עוד', 'babyhub'); ?>
                                        <i class="icon-arrow-left"></i>
                                    </a>
                                    
                                    <!-- Additional actions based on post type -->
                                    <?php if (get_post_type() === 'babyhub_tool') : ?>
                                        <span class="tool-action">
                                            <i class="icon-tool"></i>
                                            <?php _e('השתמש בכלי', 'babyhub'); ?>
                                        </span>
                                    <?php elseif (get_post_type() === 'pregnancy_week') : ?>
                                        <span class="week-info">
                                            <i class="icon-info"></i>
                                            <?php
                                            $week_number = get_post_meta(get_the_ID(), '_week_number', true);
                                            if ($week_number) {
                                                printf(__('שבוע %s', 'babyhub'), $week_number);
                                            }
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="search-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← קודם', 'babyhub'),
                    'next_text' => __('הבא →', 'babyhub'),
                    'before_page_number' => '<span class="screen-reader-text">' . __('עמוד', 'babyhub') . ' </span>',
                ));
                ?>
            </nav>

        <?php else : ?>
            
            <!-- No Results Found -->
            <div class="no-results">
                <div class="no-results-content">
                    
                    <!-- No Results Message -->
                    <div class="no-results-message">
                        <div class="search-icon">🔍</div>
                        <h2><?php _e('לא נמצאו תוצאות', 'babyhub'); ?></h2>
                        <p>
                            <?php
                            printf(__('מצטערים, לא נמצאו תוצאות עבור "%s". נסה טיפים אלה:', 'babyhub'), '<strong>' . get_search_query() . '</strong>');
                            ?>
                        </p>
                    </div>

                    <!-- Search Tips -->
                    <div class="search-tips">
                        <h3><?php _e('טיפים לחיפוש טוב יותר:', 'babyhub'); ?></h3>
                        <ul class="tips-list">
                            <li><?php _e('בדוק שהמילים כתובות נכון', 'babyhub'); ?></li>
                            <li><?php _e('נסה מילים קשורות או מילות מפתח אחרות', 'babyhub'); ?></li>
                            <li><?php _e('השתמש במילים כלליות יותר', 'babyhub'); ?></li>
                            <li><?php _e('נסה לחפש מונח אחד במקום כמה מונחים', 'babyhub'); ?></li>
                        </ul>
                    </div>

                    <!-- Popular Searches -->
                    <div class="popular-searches">
                        <h3><?php _e('חיפושים פופולריים:', 'babyhub'); ?></h3>
                        <div class="popular-terms">
                            <a href="<?php echo home_url('?s=הריון'); ?>" class="search-term-link">הריון</a>
                            <a href="<?php echo home_url('?s=לידה'); ?>" class="search-term-link">לידה</a>
                            <a href="<?php echo home_url('?s=תינוק'); ?>" class="search-term-link">תינוק</a>
                            <a href="<?php echo home_url('?s=הנקה'); ?>" class="search-term-link">הנקה</a>
                            <a href="<?php echo home_url('?s=חיתולים'); ?>" class="search-term-link">חיתולים</a>
                            <a href="<?php echo home_url('?s=שינה'); ?>" class="search-term-link">שינה</a>
                            <a href="<?php echo home_url('?s=הזנה'); ?>" class="search-term-link">הזנה</a>
                            <a href="<?php echo home_url('?s=ביוץ'); ?>" class="search-term-link">ביוץ</a>
                        </div>
                    </div>

                    <!-- Browse by Category -->
                    <div class="browse-categories">
                        <h3><?php _e('או עיין לפי קטגוריות:', 'babyhub'); ?></h3>
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 8,
                            'hide_empty' => true
                        ));
                        
                        if ($categories) : ?>
                            <div class="categories-grid">
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo get_category_link($category->term_id); ?>" class="category-card">
                                        <span class="category-name"><?php echo $category->name; ?></span>
                                        <span class="category-count"><?php echo $category->count; ?> פוסטים</span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tools Section -->
                    <div class="tools-section">
                        <h3><?php _e('או השתמש בכלים שלנו:', 'babyhub'); ?></h3>
                        <div class="tools-grid">
                            <a href="<?php echo home_url('/tools/#ovulation-calculator'); ?>" class="tool-card">
                                <span class="tool-icon">🥚</span>
                                <span class="tool-name"><?php _e('חישוב ביוץ', 'babyhub'); ?></span>
                            </a>
                            <a href="<?php echo home_url('/tools/#due-date-calculator'); ?>" class="tool-card">
                                <span class="tool-icon">📅</span>
                                <span class="tool-name"><?php _e('חישוב תאריך לידה', 'babyhub'); ?></span>
                            </a>
                            <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="tool-card">
                                <span class="tool-icon">🤱</span>
                                <span class="tool-name"><?php _e('מעקב הריון', 'babyhub'); ?></span>
                            </a>
                            <a href="<?php echo home_url('/tools/#baby-names'); ?>" class="tool-card">
                                <span class="tool-icon">📝</span>
                                <span class="tool-name"><?php _e('מאגר שמות', 'babyhub'); ?></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        <?php endif; ?>
    </div>
</main>

<!-- Search Scripts -->
<script>
jQuery(document).ready(function($) {
    // View toggle
    $('.view-btn').on('click', function() {
        const view = $(this).data('view');
        
        $('.view-btn').removeClass('active');
        $(this).addClass('active');
        
        $('.results-list').removeClass('view-list view-grid').addClass('view-' + view);
    });
    
    // Filter functionality
    $('#content-type, #sort-results').on('change', function() {
        const contentType = $('#content-type').val();
        const sortBy = $('#sort-results').val();
        const searchQuery = '<?php echo get_search_query(); ?>';
        
        const url = new URL(window.location.origin + '/');
        url.searchParams.set('s', searchQuery);
        
        if (contentType) {
            url.searchParams.set('post_type', contentType);
        }
        
        if (sortBy && sortBy !== 'relevance') {
            url.searchParams.set('orderby', sortBy);
        }
        
        window.location.href = url.href;
    });
});
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>