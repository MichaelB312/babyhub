<?php
/**
 * Single Pregnancy Week Template
 * Baby-Hub Hebrew RTL Theme
 */

get_header(); ?>

<main id="main" class="site-main single-pregnancy-week">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="week-<?php the_ID(); ?>" <?php post_class('pregnancy-week-page'); ?>>
                
                <!-- Week Navigation -->
                <nav class="week-navigation" aria-label="<?php _e('ניווט בין שבועות הריון', 'babyhub'); ?>">
                    <div class="week-nav-container">
                        <?php
                        $current_week = get_post_meta(get_the_ID(), '_week_number', true);
                        $prev_week = $current_week > 1 ? $current_week - 1 : null;
                        $next_week = $current_week < 42 ? $current_week + 1 : null;
                        
                        // Get previous week post
                        if ($prev_week) {
                            $prev_post = get_posts(array(
                                'post_type' => 'pregnancy_week',
                                'meta_key' => '_week_number',
                                'meta_value' => $prev_week,
                                'numberposts' => 1
                            ));
                        }
                        
                        // Get next week post
                        if ($next_week) {
                            $next_post = get_posts(array(
                                'post_type' => 'pregnancy_week',
                                'meta_key' => '_week_number',
                                'meta_value' => $next_week,
                                'numberposts' => 1
                            ));
                        }
                        ?>
                        
                        <div class="week-nav-links">
                            <?php if ($prev_week && !empty($prev_post)) : ?>
                                <a href="<?php echo get_permalink($prev_post[0]->ID); ?>" class="week-nav-link prev">
                                    <i class="icon-arrow-right"></i>
                                    <span class="nav-text">
                                        <span class="nav-label"><?php _e('שבוע קודם', 'babyhub'); ?></span>
                                        <span class="nav-week"><?php printf(__('שבוע %d', 'babyhub'), $prev_week); ?></span>
                                    </span>
                                </a>
                            <?php endif; ?>
                            
                            <div class="current-week-indicator">
                                <span class="current-week-label"><?php _e('שבוע נוכחי', 'babyhub'); ?></span>
                                <span class="current-week-number"><?php echo $current_week; ?></span>
                            </div>
                            
                            <?php if ($next_week && !empty($next_post)) : ?>
                                <a href="<?php echo get_permalink($next_post[0]->ID); ?>" class="week-nav-link next">
                                    <span class="nav-text">
                                        <span class="nav-label"><?php _e('שבוע הבא', 'babyhub'); ?></span>
                                        <span class="nav-week"><?php printf(__('שבוע %d', 'babyhub'), $next_week); ?></span>
                                    </span>
                                    <i class="icon-arrow-left"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Week Progress Bar -->
                        <div class="week-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo ($current_week / 40) * 100; ?>%"></div>
                            </div>
                            <div class="progress-text">
                                <?php printf(__('%d מתוך 40 שבועות', 'babyhub'), $current_week); ?>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Week Header -->
                <header class="week-header">
                    <div class="week-hero">
                        <div class="week-number-large">
                            <span class="week-number"><?php echo $current_week; ?></span>
                            <span class="week-label"><?php _e('שבוע', 'babyhub'); ?></span>
                        </div>
                        
                        <div class="week-title-section">
                            <h1 class="week-title"><?php the_title(); ?></h1>
                            
                            <?php if (get_the_excerpt()) : ?>
                                <div class="week-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Week Stats -->
                    <div class="week-stats">
                        <?php
                        $baby_size = get_post_meta(get_the_ID(), '_baby_size', true);
                        $baby_weight = get_post_meta(get_the_ID(), '_baby_weight', true);
                        $trimester = $current_week <= 12 ? 1 : ($current_week <= 26 ? 2 : 3);
                        ?>
                        
                        <div class="stat-card trimester">
                            <div class="stat-icon">🤰</div>
                            <div class="stat-content">
                                <span class="stat-label"><?php _e('טרימסטר', 'babyhub'); ?></span>
                                <span class="stat-value"><?php echo $trimester; ?></span>
                            </div>
                        </div>
                        
                        <?php if ($baby_size) : ?>
                            <div class="stat-card size">
                                <div class="stat-icon">📏</div>
                                <div class="stat-content">
                                    <span class="stat-label"><?php _e('גודל התינוק', 'babyhub'); ?></span>
                                    <span class="stat-value"><?php echo $baby_size; ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($baby_weight) : ?>
                            <div class="stat-card weight">
                                <div class="stat-icon">⚖️</div>
                                <div class="stat-content">
                                    <span class="stat-label"><?php _e('משקל משוער', 'babyhub'); ?></span>
                                    <span class="stat-value"><?php echo $baby_weight; ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="stat-card days">
                            <div class="stat-icon">📅</div>
                            <div class="stat-content">
                                <span class="stat-label"><?php _e('ימים עד הלידה', 'babyhub'); ?></span>
                                <span class="stat-value"><?php echo (40 - $current_week) * 7; ?></span>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Week Content -->
                <div class="week-content">
                    
                    <!-- Baby Development -->
                    <section class="baby-development">
                        <h2><?php _e('התפתחות התינוק', 'babyhub'); ?></h2>
                        <div class="development-content">
                            <?php the_content(); ?>
                        </div>
                    </section>

                    <!-- Symptoms -->
                    <?php
                    $symptoms = get_post_meta(get_the_ID(), '_symptoms', true);
                    if ($symptoms) : ?>
                        <section class="week-symptoms">
                            <h2><?php _e('תסמינים נפוצים השבוע', 'babyhub'); ?></h2>
                            <div class="symptoms-content">
                                <?php echo wpautop($symptoms); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Tips -->
                    <?php
                    $tips = get_post_meta(get_the_ID(), '_tips', true);
                    if ($tips) : ?>
                        <section class="week-tips">
                            <h2><?php _e('טיפים לשבוע זה', 'babyhub'); ?></h2>
                            <div class="tips-content">
                                <?php echo wpautop($tips); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Medical Tests -->
                    <?php
                    $medical_tests = get_post_meta(get_the_ID(), '_medical_tests', true);
                    if ($medical_tests) : ?>
                        <section class="medical-tests">
                            <h2><?php _e('בדיקות רפואיות מומלצות', 'babyhub'); ?></h2>
                            <div class="tests-content">
                                <?php echo wpautop($medical_tests); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Nutrition -->
                    <?php
                    $nutrition = get_post_meta(get_the_ID(), '_nutrition', true);
                    if ($nutrition) : ?>
                        <section class="week-nutrition">
                            <h2><?php _e('תזונה והמלצות', 'babyhub'); ?></h2>
                            <div class="nutrition-content">
                                <?php echo wpautop($nutrition); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Exercise -->
                    <?php
                    $exercise = get_post_meta(get_the_ID(), '_exercise', true);
                    if ($exercise) : ?>
                        <section class="week-exercise">
                            <h2><?php _e('פעילות גופנית', 'babyhub'); ?></h2>
                            <div class="exercise-content">
                                <?php echo wpautop($exercise); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Checklist -->
                    <?php
                    $checklist = get_post_meta(get_the_ID(), '_checklist', true);
                    if ($checklist) : ?>
                        <section class="week-checklist">
                            <h2><?php _e('רשימת משימות לשבוע זה', 'babyhub'); ?></h2>
                            <div class="checklist-content">
                                <div class="checklist-items">
                                    <?php
                                    $items = explode("\n", $checklist);
                                    foreach ($items as $item) {
                                        if (trim($item)) {
                                            echo '<div class="checklist-item">';
                                            echo '<input type="checkbox" id="item-' . md5($item) . '" class="checklist-checkbox">';
                                            echo '<label for="item-' . md5($item) . '">' . trim($item) . '</label>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>

                </div>

                <!-- Week Footer -->
                <footer class="week-footer">
                    
                    <!-- Related Tools -->
                    <div class="week-tools">
                        <h3><?php _e('כלים רלוונטיים לשבוע זה', 'babyhub'); ?></h3>
                        <div class="tools-grid">
                            <a href="<?php echo home_url('/tools/#due-date-calculator'); ?>" class="tool-link">
                                <span class="tool-icon">📅</span>
                                <span class="tool-name"><?php _e('חישוב תאריך לידה', 'babyhub'); ?></span>
                            </a>
                            <a href="<?php echo home_url('/tools/#weight-calculator'); ?>" class="tool-link">
                                <span class="tool-icon">⚖️</span>
                                <span class="tool-name"><?php _e('מעקב עלייה במשקל', 'babyhub'); ?></span>
                            </a>
                            <?php if ($current_week >= 18) : ?>
                                <a href="<?php echo home_url('/tools/#gender-predictor'); ?>" class="tool-link">
                                    <span class="tool-icon">👶</span>
                                    <span class="tool-name"><?php _e('ניחוש מין תינוק', 'babyhub'); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if ($current_week >= 30) : ?>
                                <a href="<?php echo home_url('/tools/#birth-plan'); ?>" class="tool-link">
                                    <span class="tool-icon">📋</span>
                                    <span class="tool-name"><?php _e('תוכנית לידה', 'babyhub'); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Week Sharing -->
                    <div class="week-sharing">
                        <h4><?php _e('שתפי את השבוע:', 'babyhub'); ?></h4>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               class="share-btn facebook" target="_blank" rel="noopener">
                                <i class="icon-facebook"></i> פייסבוק
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode('אני בשבוע ' . $current_week . ' להריון! ' . get_the_title() . ' - ' . get_permalink()); ?>" 
                               class="share-btn whatsapp" target="_blank" rel="noopener">
                                <i class="icon-whatsapp"></i> וואטסאפ
                            </a>
                            <button type="button" class="share-btn copy-link" data-url="<?php echo get_permalink(); ?>">
                                <i class="icon-link"></i> העתק קישור
                            </button>
                        </div>
                    </div>

                </footer>
            </article>

            <!-- Week Tracker Sidebar -->
            <aside class="week-tracker-sidebar">
                <div class="tracker-content">
                    <h3><?php _e('מעקב השבועות שלי', 'babyhub'); ?></h3>
                    
                    <!-- All Weeks Navigation -->
                    <div class="weeks-grid">
                        <?php
                        for ($week = 1; $week <= 40; $week++) {
                            $week_post = get_posts(array(
                                'post_type' => 'pregnancy_week',
                                'meta_key' => '_week_number',
                                'meta_value' => $week,
                                'numberposts' => 1
                            ));
                            
                            $class = 'week-item';
                            if ($week == $current_week) {
                                $class .= ' current';
                            } elseif ($week < $current_week) {
                                $class .= ' completed';
                            }
                            
                            if (!empty($week_post)) {
                                echo '<a href="' . get_permalink($week_post[0]->ID) . '" class="' . $class . '">';
                                echo '<span class="week-num">' . $week . '</span>';
                                echo '</a>';
                            } else {
                                echo '<span class="' . $class . ' disabled">';
                                echo '<span class="week-num">' . $week . '</span>';
                                echo '</span>';
                            }
                        }
                        ?>
                    </div>
                    
                    <!-- Quick Access -->
                    <div class="quick-access">
                        <h4><?php _e('גישה מהירה', 'babyhub'); ?></h4>
                        <div class="quick-links">
                            <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="quick-link">
                                <i class="icon-calendar"></i>
                                <?php _e('כל השבועות', 'babyhub'); ?>
                            </a>
                            <a href="<?php echo home_url('/tools/'); ?>" class="quick-link">
                                <i class="icon-tool"></i>
                                <?php _e('כלי חישוב', 'babyhub'); ?>
                            </a>
                            <a href="<?php echo home_url('/community/'); ?>" class="quick-link">
                                <i class="icon-users"></i>
                                <?php _e('קהילה', 'babyhub'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

        <?php endwhile; ?>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Checklist functionality
    $('.checklist-checkbox').on('change', function() {
        const $item = $(this).closest('.checklist-item');
        if ($(this).is(':checked')) {
            $item.addClass('completed');
        } else {
            $item.removeClass('completed');
        }
        
        // Save to localStorage
        const itemId = $(this).attr('id');
        const weekId = <?php echo get_the_ID(); ?>;
        const storageKey = 'pregnancy_checklist_' + weekId;
        
        let checkedItems = JSON.parse(localStorage.getItem(storageKey) || '[]');
        
        if ($(this).is(':checked')) {
            if (checkedItems.indexOf(itemId) === -1) {
                checkedItems.push(itemId);
            }
        } else {
            checkedItems = checkedItems.filter(id => id !== itemId);
        }
        
        localStorage.setItem(storageKey, JSON.stringify(checkedItems));
    });
    
    // Load saved checklist state
    const weekId = <?php echo get_the_ID(); ?>;
    const storageKey = 'pregnancy_checklist_' + weekId;
    const checkedItems = JSON.parse(localStorage.getItem(storageKey) || '[]');
    
    checkedItems.forEach(function(itemId) {
        $('#' + itemId).prop('checked', true).trigger('change');
    });
    
    // Copy link functionality
    $('.copy-link').on('click', function() {
        const url = $(this).data('url');
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(function() {
                showCopySuccess();
            });
        } else {
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
        $btn.html('<i class="icon-check"></i> הועתק!');
        setTimeout(function() {
            $btn.html(originalText);
        }, 2000);
    }
    
    // Smooth scroll for week navigation
    $('.week-nav-link').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        
        // Add transition effect
        $('body').addClass('page-transitioning');
        
        setTimeout(function() {
            window.location.href = href;
        }, 300);
    });
});
</script>

<?php get_footer(); ?>