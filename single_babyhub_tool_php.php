<?php
/**
 * Single Tool Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main single-tool">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="tool-<?php the_ID(); ?>" <?php post_class('tool-page'); ?>>
                
                <!-- Tool Header -->
                <header class="tool-header">
                    <div class="tool-breadcrumb">
                        <nav aria-label="<?php _e('נתיב ניווט', 'babyhub'); ?>">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo home_url(); ?>"><?php _e('בית', 'babyhub'); ?></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo home_url('/tools/'); ?>"><?php _e('כלים', 'babyhub'); ?></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php the_title(); ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    
                    <div class="tool-meta">
                        <?php
                        $tool_categories = wp_get_post_terms(get_the_ID(), 'tool_category');
                        if ($tool_categories && !is_wp_error($tool_categories)) :
                            foreach ($tool_categories as $category) : ?>
                                <span class="tool-category">
                                    <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
                                </span>
                            <?php endforeach;
                        endif; ?>
                    </div>
                    
                    <h1 class="tool-title"><?php the_title(); ?></h1>
                    
                    <?php if (get_the_excerpt()) : ?>
                        <div class="tool-description">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Tool Icon -->
                    <?php
                    $tool_icon = get_post_meta(get_the_ID(), '_tool_icon', true);
                    if ($tool_icon) : ?>
                        <div class="tool-icon-large">
                            <?php echo $tool_icon; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Tool Content -->
                <div class="tool-content">
                    
                    <!-- Tool Instructions -->
                    <?php if (get_the_content()) : ?>
                        <section class="tool-instructions">
                            <h2><?php _e('הוראות שימוש', 'babyhub'); ?></h2>
                            <div class="instructions-content">
                                <?php the_content(); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Tool Interface -->
                    <section class="tool-interface">
                        <div class="tool-form-container">
                            <?php
                            // Get tool type to determine which form to show
                            $tool_slug = get_post_field('post_name', get_the_ID());
                            
                            switch ($tool_slug) {
                                case 'ovulation-calculator':
                                    include get_template_directory() . '/template-parts/tools/ovulation-calculator.php';
                                    break;
                                    
                                case 'due-date-calculator':
                                    include get_template_directory() . '/template-parts/tools/due-date-calculator.php';
                                    break;
                                    
                                case 'gender-predictor':
                                    include get_template_directory() . '/template-parts/tools/gender-predictor.php';
                                    break;
                                    
                                case 'baby-names-finder':
                                    include get_template_directory() . '/template-parts/tools/baby-names-finder.php';
                                    break;
                                    
                                case 'weight-gain-calculator':
                                    include get_template_directory() . '/template-parts/tools/weight-gain-calculator.php';
                                    break;
                                    
                                case 'birth-plan-worksheet':
                                    include get_template_directory() . '/template-parts/tools/birth-plan-worksheet.php';
                                    break;
                                    
                                case 'registry-manager':
                                    include get_template_directory() . '/template-parts/tools/registry-manager.php';
                                    break;
                                    
                                case 'baby-costs-calculator':
                                    include get_template_directory() . '/template-parts/tools/baby-costs-calculator.php';
                                    break;
                                    
                                case 'solid-feeding-guide':
                                    include get_template_directory() . '/template-parts/tools/solid-feeding-guide.php';
                                    break;
                                    
                                case 'growth-chart':
                                    include get_template_directory() . '/template-parts/tools/growth-chart.php';
                                    break;
                                    
                                case 'height-predictor':
                                    include get_template_directory() . '/template-parts/tools/height-predictor.php';
                                    break;
                                    
                                case 'zodiac-calculator':
                                    include get_template_directory() . '/template-parts/tools/zodiac-calculator.php';
                                    break;
                                    
                                default:
                                    echo '<div class="tool-placeholder">';
                                    echo '<p>' . __('כלי זה נמצא בפיתוח ויהיה זמין בקרוב.', 'babyhub') . '</p>';
                                    echo '</div>';
                            }
                            ?>
                        </div>
                        
                        <!-- Results Container -->
                        <div id="tool-results" class="tool-results-container">
                            <!-- Results will be displayed here -->
                        </div>
                    </section>

                    <!-- Tool Tips -->
                    <?php
                    $tool_tips = get_post_meta(get_the_ID(), '_tool_tips', true);
                    if ($tool_tips) : ?>
                        <section class="tool-tips">
                            <h2><?php _e('טיפים שימושיים', 'babyhub'); ?></h2>
                            <div class="tips-content">
                                <?php echo wpautop($tool_tips); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Tool Disclaimer -->
                    <section class="tool-disclaimer">
                        <div class="disclaimer-content">
                            <h3><?php _e('הבהרה חשובה', 'babyhub'); ?></h3>
                            <div class="disclaimer-text">
                                <p><?php _e('הכלים באתר מיועדים למטרות מידע והערכה בלבד ואינם מהווים תחליף לייעוץ רפואי מקצועי. במקרה של ספקות או שאלות רפואיות, הקפידו להתייעץ עם רופא או עם צוות רפואי מקצועי.', 'babyhub'); ?></p>
                                <p><?php _e('תוצאות הכלים הן הערכות משוערות בלבד ועשויות להשתנות בהתאם לגורמים אישיים שונים.', 'babyhub'); ?></p>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- Tool Footer -->
                <footer class="tool-footer">
                    
                    <!-- Tool Sharing -->
                    <div class="tool-sharing">
                        <h4><?php _e('שתף את הכלי:', 'babyhub'); ?></h4>
                        <div class="share-buttons">
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
                            <button type="button" class="share-btn copy-link" data-url="<?php echo get_permalink(); ?>">
                                <i class="icon-link"></i> העתק קישור
                            </button>
                        </div>
                    </div>

                    <!-- Tool Rating -->
                    <div class="tool-rating">
                        <h4><?php _e('הכלי עזר לך?', 'babyhub'); ?></h4>
                        <div class="rating-buttons">
                            <button type="button" class="rating-btn helpful" data-tool-id="<?php echo get_the_ID(); ?>" data-rating="helpful">
                                <i class="icon-thumbs-up"></i>
                                <span><?php _e('כן, עזר לי', 'babyhub'); ?></span>
                                <span class="rating-count">(<?php echo get_post_meta(get_the_ID(), '_helpful_count', true) ?: 0; ?>)</span>
                            </button>
                            <button type="button" class="rating-btn not-helpful" data-tool-id="<?php echo get_the_ID(); ?>" data-rating="not-helpful">
                                <i class="icon-thumbs-down"></i>
                                <span><?php _e('לא עזר לי', 'babyhub'); ?></span>
                                <span class="rating-count">(<?php echo get_post_meta(get_the_ID(), '_not_helpful_count', true) ?: 0; ?>)</span>
                            </button>
                        </div>
                    </div>

                </footer>
            </article>

            <!-- Related Tools -->
            <?php
            $related_tools = get_posts(array(
                'post_type' => 'babyhub_tool',
                'numberposts' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            ));
            
            if ($related_tools) : ?>
                <section class="related-tools">
                    <h3><?php _e('כלים נוספים שעשויים לעניין אותך', 'babyhub'); ?></h3>
                    <div class="related-tools-grid">
                        <?php foreach ($related_tools as $tool) : setup_postdata($tool); ?>
                            <article class="related-tool-card">
                                <div class="tool-card-content">
                                    <?php
                                    $icon = get_post_meta($tool->ID, '_tool_icon', true);
                                    if ($icon) : ?>
                                        <div class="tool-icon"><?php echo $icon; ?></div>
                                    <?php endif; ?>
                                    
                                    <h4 class="tool-card-title">
                                        <a href="<?php echo get_permalink($tool->ID); ?>">
                                            <?php echo get_the_title($tool->ID); ?>
                                        </a>
                                    </h4>
                                    
                                    <?php if ($tool->post_excerpt) : ?>
                                        <p class="tool-card-description">
                                            <?php echo $tool->post_excerpt; ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo get_permalink($tool->ID); ?>" class="tool-card-link">
                                        <?php _e('השתמש בכלי', 'babyhub'); ?>
                                        <i class="icon-arrow-left"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
</main>

<!-- Tool Scripts -->
<script>
jQuery(document).ready(function($) {
    // Copy link functionality
    $('.copy-link').on('click', function() {
        const url = $(this).data('url');
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(function() {
                showCopySuccess();
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showCopySuccess();
        }
    });
    
    function showCopySuccess() {
        const $btn = $('.copy-link');
        const originalText = $btn.html();
        $btn.html('<i class="icon-check"></i> ' + '<?php _e("הועתק!", "babyhub"); ?>');
        setTimeout(function() {
            $btn.html(originalText);
        }, 2000);
    }
    
    // Tool rating functionality
    $('.rating-btn').on('click', function() {
        const $btn = $(this);
        const toolId = $btn.data('tool-id');
        const rating = $btn.data('rating');
        
        // Disable buttons to prevent multiple clicks
        $('.rating-btn').prop('disabled', true);
        
        $.ajax({
            url: babyhub_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'rate_tool',
                tool_id: toolId,
                rating: rating,
                nonce: babyhub_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Update count
                    $btn.find('.rating-count').text('(' + response.data.count + ')');
                    
                    // Show thank you message
                    $('<div class="rating-thanks"><?php _e("תודה על המשוב!", "babyhub"); ?></div>')
                        .insertAfter('.rating-buttons')
                        .fadeIn();
                } else {
                    alert(response.data || '<?php _e("שגיאה בשמירת המשוב", "babyhub"); ?>');
                    $('.rating-btn').prop('disabled', false);
                }
            },
            error: function() {
                alert('<?php _e("שגיאה בחיבור לשרת", "babyhub"); ?>');
                $('.rating-btn').prop('disabled', false);
            }
        });
    });
    
    // Smooth scroll to results
    function scrollToResults() {
        const $results = $('#tool-results');
        if ($results.length && $results.children().length > 0) {
            $('html, body').animate({
                scrollTop: $results.offset().top - 100
            }, 800);
        }
    }
    
    // Add scroll trigger to form submissions
    $(document).on('submit', '.tool-form', function() {
        setTimeout(scrollToResults, 1000);
    });
});
</script>

<style>
/* Single Tool Styles */
.single-tool {
    padding: 2rem 0;
}

.tool-page {
    max-width: 800px;
    margin: 0 auto;
}

/* Tool Header */
.tool-header {
    text-align: center;
    margin-bottom: 3rem;
}

.tool-breadcrumb {
    margin-bottom: 1rem;
}

.breadcrumb {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0.9rem;
}

.breadcrumb-item {
    color: #666;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "←";
    margin: 0 0.5rem;
    color: #ccc;
}

.breadcrumb-item a {
    color: #FF6B9D;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #333;
    font-weight: 500;
}

.tool-meta {
    margin-bottom: 1rem;
}

.tool-category {
    display: inline-block;
    background: #FF6B9D;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    margin: 0 0.25rem;
}

.tool-category a {
    color: white;
    text-decoration: none;
}

.tool-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.tool-description {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.tool-icon-large {
    font-size: 4rem;
    margin-bottom: 2rem;
}

/* Tool Content */
.tool-content section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.tool-content h2 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #FF6B9D;
}

.tool-instructions {
    background: #f8f9fa;
}

.instructions-content {
    line-height: 1.7;
}

.tool-interface {
    background: white;
}

.tool-form-container {
    margin-bottom: 2rem;
}

.tool-results-container {
    min-height: 100px;
}

/* Tool Tips */
.tool-tips {
    background: #e8f4fd;
    border-right: 4px solid #4ECDC4;
}

.tips-content {
    color: #2c3e50;
}

/* Tool Disclaimer */
.tool-disclaimer {
    background: #fff3cd;
    border-right: 4px solid #ffc107;
}

.disclaimer-content h3 {
    color: #856404;
    margin-bottom: 1rem;
}

.disclaimer-text {
    color: #856404;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Tool Footer */
.tool-footer {
    margin-top: 3rem;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.tool-sharing,
.tool-rating {
    margin-bottom: 2rem;
}

.tool-sharing h4,
.tool-rating h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.share-buttons,
.rating-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.share-btn,
.rating-btn {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    font-family: inherit;
}

.share-btn i,
.rating-btn i {
    margin-left: 0.5rem;
}

.share-btn.facebook {
    background: #1877f2;
    color: white;
}

.share-btn.twitter {
    background: #1da1f2;
    color: white;
}

.share-btn.whatsapp {
    background: #25d366;
    color: white;
}

.share-btn.copy-link {
    background: #6c757d;
    color: white;
}

.rating-btn.helpful {
    background: #28a745;
    color: white;
}

.rating-btn.not-helpful {
    background: #dc3545;
    color: white;
}

.share-btn:hover,
.rating-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.rating-count {
    margin-right: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

.rating-thanks {
    margin-top: 1rem;
    padding: 1rem;
    background: #d4edda;
    color: #155724;
    border-radius: 8px;
    text-align: center;
    font-weight: 500;
    display: none;
}

/* Related Tools */
.related-tools {
    margin-top: 4rem;
}

.related-tools h3 {
    text-align: center;
    margin-bottom: 2rem;
    color: #2c3e50;
}

.related-tools-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.related-tool-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.related-tool-card:hover {
    transform: translateY(-5px);
}

.related-tool-card .tool-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.tool-card-title {
    margin-bottom: 1rem;
}

.tool-card-title a {
    color: #2c3e50;
    text-decoration: none;
}

.tool-card-title a:hover {
    color: #FF6B9D;
}

.tool-card-description {
    color: #666;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.tool-card-link {
    display: inline-flex;
    align-items: center;
    color: #FF6B9D;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.tool-card-link:hover {
    color: #e55a87;
}

.tool-card-link i {
    margin-right: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .tool-title {
        font-size: 2rem;
    }
    
    .tool-content section {
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .share-buttons,
    .rating-buttons {
        flex-direction: column;
    }
    
    .related-tools-grid {
        grid-template-columns: 1fr;
    }
    
    .breadcrumb {
        justify-content: flex-start;
    }
}

@media (max-width: 480px) {
    .single-tool {
        padding: 1rem 0;
    }
    
    .tool-title {
        font-size: 1.75rem;
    }
    
    .tool-content section {
        padding: 1rem;
    }
    
    .tool-footer {
        padding: 1.5rem;
    }
}
</style>

<?php get_footer(); ?>