<?php
/**
 * General Page Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="page-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
                
                <!-- Page Header -->
                <header class="page-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-thumbnail">
                            <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    
                    <?php if (get_the_excerpt()) : ?>
                        <div class="page-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Page Content -->
                <div class="page-content">
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

                <!-- Page Footer -->
                <footer class="page-footer">
                    <?php if (get_edit_post_link()) : ?>
                        <div class="edit-link">
                            <?php edit_post_link(__('ערוך עמוד זה', 'babyhub')); ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>

            <!-- Child Pages -->
            <?php
            $child_pages = get_children(array(
                'post_parent' => get_the_ID(),
                'post_type'   => 'page',
                'post_status' => 'publish',
                'orderby'     => 'menu_order',
                'order'       => 'ASC'
            ));
            
            if ($child_pages) : ?>
                <section class="child-pages">
                    <h3><?php _e('עמודים קשורים', 'babyhub'); ?></h3>
                    <div class="child-pages-grid">
                        <?php foreach ($child_pages as $child_page) : ?>
                            <article class="child-page-card">
                                <?php if (has_post_thumbnail($child_page->ID)) : ?>
                                    <div class="child-page-thumbnail">
                                        <a href="<?php echo get_permalink($child_page->ID); ?>">
                                            <?php echo get_the_post_thumbnail($child_page->ID, 'medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="child-page-content">
                                    <h4 class="child-page-title">
                                        <a href="<?php echo get_permalink($child_page->ID); ?>">
                                            <?php echo get_the_title($child_page->ID); ?>
                                        </a>
                                    </h4>
                                    
                                    <?php if ($child_page->post_excerpt) : ?>
                                        <p class="child-page-excerpt">
                                            <?php echo $child_page->post_excerpt; ?>
                                        </p>
                                    <?php else : ?>
                                        <p class="child-page-excerpt">
                                            <?php echo wp_trim_words($child_page->post_content, 20); ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo get_permalink($child_page->ID); ?>" class="child-page-link">
                                        <?php _e('קרא עוד', 'babyhub'); ?>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

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