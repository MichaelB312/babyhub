<?php
/**
 * Single Post Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="icon-calendar"></i>
                            <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d')); ?>
                        </span>
                        
                        <?php if (get_the_category()) : ?>
                            <span class="post-categories">
                                <i class="icon-folder"></i>
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if (get_the_tags()) : ?>
                            <span class="post-tags">
                                <i class="icon-tag"></i>
                                <?php the_tags('', ', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Post Content -->
                <div class="post-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('עמודים:', 'babyhub'),
                        'after'  => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ));
                    ?>
                </div>

                <!-- Post Footer -->
                <footer class="post-footer">
                    <?php if (get_the_tags()) : ?>
                        <div class="post-tags-section">
                            <h4><?php _e('תגיות:', 'babyhub'); ?></h4>
                            <div class="tags-list">
                                <?php the_tags('<span class="tag-item">', '</span><span class="tag-item">', '</span>'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <h4><?php _e('שתף את הפוסט:', 'babyhub'); ?></h4>
                        <div class="share-list">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               class="share-btn facebook" target="_blank" rel="noopener">
                                <i class="icon-facebook"></i> פייסבוק
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               class="share-btn twitter" target="_blank" rel="noopener">
                                <i class="icon-twitter"></i> טוויטר
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                               class="share-btn whatsapp" target="_blank" rel="noopener">
                                <i class="icon-whatsapp"></i> וואטסאפ
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" 
                               class="share-btn email">
                                <i class="icon-email"></i> אימייל
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <!-- Author Bio -->
            <?php if (get_the_author_meta('description')) : ?>
                <div class="author-bio">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-info">
                        <h4 class="author-name"><?php the_author(); ?></h4>
                        <p class="author-description"><?php echo get_the_author_meta('description'); ?></p>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author-link">
                            <?php _e('צפה בכל הפוסטים של', 'babyhub'); ?> <?php the_author(); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Related Posts -->
            <?php
            $related_posts = get_posts(array(
                'category__in' => wp_get_post_categories($post->ID),
                'numberposts'  => 3,
                'post__not_in' => array($post->ID),
                'orderby'      => 'rand'
            ));
            
            if ($related_posts) : ?>
                <section class="related-posts">
                    <h3><?php _e('פוסטים קשורים', 'babyhub'); ?></h3>
                    <div class="related-posts-grid">
                        <?php foreach ($related_posts as $related_post) : setup_postdata($related_post); ?>
                            <article class="related-post-card">
                                <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                    <div class="related-post-thumbnail">
                                        <a href="<?php echo get_permalink($related_post->ID); ?>">
                                            <?php echo get_the_post_thumbnail($related_post->ID, 'medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="related-post-content">
                                    <h4 class="related-post-title">
                                        <a href="<?php echo get_permalink($related_post->ID); ?>">
                                            <?php echo get_the_title($related_post->ID); ?>
                                        </a>
                                    </h4>
                                    <p class="related-post-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt($related_post->ID), 15); ?>
                                    </p>
                                    <div class="related-post-meta">
                                        <span class="related-post-date">
                                            <?php echo babyhub_get_hebrew_date(get_the_date('Y-m-d', $related_post->ID)); ?>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Post Navigation -->
            <nav class="post-navigation">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post) : ?>
                        <div class="nav-previous">
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link">
                                <span class="nav-direction"><?php _e('הפוסט הקודם', 'babyhub'); ?></span>
                                <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                            </a>
                        </div>
                    <?php endif;
                    
                    if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link">
                                <span class="nav-direction"><?php _e('הפוסט הבא', 'babyhub'); ?></span>
                                <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>