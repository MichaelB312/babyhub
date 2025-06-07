<?php
/**
 * Archive Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main archive-page">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <?php if (is_category()) : ?>
                <h1 class="archive-title">
                    <span class="archive-type"><?php _e('קטגוריה:', 'babyhub'); ?></span>
                    <?php single_cat_title(); ?>
                </h1>
                <?php if (category_description()) : ?>
                    <div class="archive-description">
                        <?php echo category_description(); ?>
                    </div>
                <?php endif; ?>
                
            <?php elseif (is_tag()) : ?>
                <h1 class="archive-title">
                    <span class="archive-type"><?php _e('תגית:', 'babyhub'); ?></span>
                    <?php single_tag_title(); ?>
                </h1>
                <?php if (tag_description()) : ?>
                    <div class="archive-description">
                        <?php echo tag_description(); ?>
                    </div>
                <?php endif; ?>
                
            <?php elseif (is_author()) : ?>
                <h1 class="archive-title">
                    <span class="archive-type"><?php _e('כותב:', 'babyhub'); ?></span>
                    <?php echo get_the_author(); ?>
                </h1>
                <?php if (get_the_author_meta('description')) : ?>
                    <div class="archive-description">
                        <?php echo get_the_author_meta('description'); ?>
                    </div>
                <?php endif; ?>
                
            <?php elseif (is_date()) : ?>
                <h1 class="archive-title">
                    <span class="archive-type"><?php _e('ארכיון:', 'babyhub'); ?></span>
                    <?php
                    if (is_year()) {
                        echo get_the_date('Y');
                    } elseif (is_month()) {
                        echo get_the_date('F Y');
                    } elseif (is_day()) {
                        echo get_the_date();
                    }
                    ?>
                </h1>
                
            <?php elseif (is_post_type_archive()) : ?>
                <h1 class="archive-title">
                    <span class="archive-type"><?php _e('ארכיון:', 'babyhub'); ?></span>
                    <?php post_type_archive_title(); ?>
                </h1>
                <?php if (get_the_archive_description()) : ?>
                    <div class="archive-description">
                        <?php the_archive_description(); ?>
                    </div>
                <?php endif; ?>
                
            <?php else : ?>
                <h1 class="archive-title">
                    <?php _e('ארכיון', 'babyhub'); ?>
                </h1>
            <?php endif; ?>
            
            <!-- Archive Meta -->
            <div class="archive-meta">
                <span class="posts-count">
                    <?php
                    global $wp_query;
                    $total = $wp_query->found_posts;
                    printf(_n('%s פוסט נמצא', '%s פוסטים נמצאו', $total, 'babyhub'), number_format_i18n($total));
                    ?>
                </span>
            </div>
        </header>

        <!-- Archive Content -->
        <?php if (have_posts()) : ?>
            
            <!-- Archive Filters -->
            <div class="archive-filters">
                <div class="filter-row">
                    <!-- Sort Options -->
                    <div class="sort-options">
                        <label for="sort-posts"><?php _e('מיין לפי:', 'babyhub'); ?></label>
                        <select id="sort-posts" class="form-control">
                            <option value="date"><?php _e('תאריך פרסום', 'babyhub'); ?></option>
                            <option value="title"><?php _e('כותרת', 'babyhub'); ?></option>
                            <option value="comment_count"><?php _e('תגובות', 'babyhub'); ?></option>
                        </select>
                    </div>
                    
                    <!-- View Options -->
                    <div class="view-options">
                        <label><?php _e('תצוגה:', 'babyhub'); ?></label>
                        <button type="button" class="view-btn active" data-view="grid">
                            <i class="icon-grid"></i> <?php _e('רשת', 'babyhub'); ?>
                        </button>
                        <button type="button" class="view-btn" data-view="list">
                            <i class="icon-list"></i> <?php _e('רשימה', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Posts Container -->
            <div class="posts-container">
                <div class="posts-grid view-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            
                            <!-- Post Thumbnail -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                    </a>
                                    
                                    <!-- Post Format Icon -->
                                    <?php if (get_post_format()) : ?>
                                        <span class="post-format-icon">
                                            <?php
                                            $format = get_post_format();
                                            switch ($format) {
                                                case 'video':
                                                    echo '<i class="icon-video"></i>';
                                                    break;
                                                case 'audio':
                                                    echo '<i class="icon-audio"></i>';
                                                    break;
                                                case 'gallery':
                                                    echo '<i class="icon-gallery"></i>';
                                                    break;
                                                case 'quote':
                                                    echo '<i class="icon-quote"></i>';
                                                    break;
                                                default:
                                                    echo '<i class="icon-post"></i>';
                                            }
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Post Content -->
                            <div class="post-content">
                                
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="icon-calendar"></i>
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d')); ?>
                                        </time>
                                    </span>
                                    
                                    <?php if (get_the_category()) : ?>
                                        <span class="post-category">
                                            <i class="icon-folder"></i>
                                            <?php
                                            $categories = get_the_category();
                                            echo '<a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a>';
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <span class="post-comments">
                                        <i class="icon-comments"></i>
                                        <?php comments_number('0', '1', '%'); ?>
                                    </span>
                                </div>

                                <!-- Post Title -->
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <!-- Post Excerpt -->
                                <div class="post-excerpt">
                                    <?php
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo wp_trim_words(get_the_content(), 25, '...');
                                    }
                                    ?>
                                </div>

                                <!-- Post Footer -->
                                <div class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php _e('קרא עוד', 'babyhub'); ?>
                                        <i class="icon-arrow-left"></i>
                                    </a>
                                    
                                    <!-- Author -->
                                    <span class="post-author">
                                        <i class="icon-user"></i>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="archive-pagination">
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
            
            <!-- No Posts Found -->
            <div class="no-posts-found">
                <div class="no-posts-content">
                    <h2><?php _e('לא נמצאו פוסטים', 'babyhub'); ?></h2>
                    <p><?php _e('מצטערים, לא נמצאו פוסטים בארכיון זה.', 'babyhub'); ?></p>
                    
                    <!-- Search Form -->
                    <div class="search-suggestion">
                        <p><?php _e('נסה לחפש משהו אחר:', 'babyhub'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                    
                    <!-- Categories -->
                    <?php if (get_categories()) : ?>
                        <div class="categories-suggestion">
                            <h3><?php _e('קטגוריות פופולריות:', 'babyhub'); ?></h3>
                            <ul class="categories-list">
                                <?php
                                wp_list_categories(array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 6,
                                ));
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Back to Home -->
                    <div class="back-home">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            <?php _e('חזור לעמוד הבית', 'babyhub'); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</main>

<!-- Archive Scripts -->
<script>
jQuery(document).ready(function($) {
    // View toggle
    $('.view-btn').on('click', function() {
        const view = $(this).data('view');
        
        $('.view-btn').removeClass('active');
        $(this).addClass('active');
        
        $('.posts-grid').removeClass('view-grid view-list').addClass('view-' + view);
    });
    
    // Sort functionality
    $('#sort-posts').on('change', function() {
        const sortBy = $(this).val();
        const url = new URL(window.location);
        url.searchParams.set('orderby', sortBy);
        window.location.href = url.href;
    });
});
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>