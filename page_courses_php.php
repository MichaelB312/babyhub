<?php
/**
 * Template Name: Courses Page
 * Page template for Baby-Hub courses with LearnDash integration
 */

get_header(); ?>

<main id="main" class="site-main courses-page">
    <div class="container">
        
        <!-- Courses Hero -->
        <section class="courses-hero">
            <div class="hero-content">
                <h1 class="hero-title"><?php _e('קורסי הורות מקצועיים', 'babyhub'); ?></h1>
                <p class="hero-description">
                    <?php _e('למדי מהמומחים הטובים ביותר והתכונני למסע ההורות עם קורסים מקצועיים ומעשיים', 'babyhub'); ?>
                </p>
                
                <div class="courses-stats">
                    <div class="stat-item">
                        <span class="stat-number">24</span>
                        <span class="stat-label"><?php _e('קורסים פעילים', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">3,456</span>
                        <span class="stat-label"><?php _e('תלמידות', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.8</span>
                        <span class="stat-label"><?php _e('דירוג ממוצע', 'babyhub'); ?></span>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <a href="#featured-courses" class="btn btn-primary btn-large">
                        <i class="icon-play"></i>
                        <?php _e('התחילי ללמוד', 'babyhub'); ?>
                    </a>
                    <a href="#course-catalog" class="btn btn-secondary">
                        <i class="icon-search"></i>
                        <?php _e('עיוני בקורסים', 'babyhub'); ?>
                    </a>
                </div>
            </div>
            
            <div class="hero-image">
                <div class="courses-illustration">
                    <div class="course-preview">
                        <div class="video-placeholder">
                            <i class="icon-play-large"></i>
                        </div>
                        <div class="course-info-preview">
                            <span class="course-title"><?php _e('הכנה ללידה טבעית', 'babyhub'); ?></span>
                            <span class="course-instructor"><?php _e('ד"ר רחל לוי', 'babyhub'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Categories -->
        <nav class="course-categories">
            <div class="categories-container">
                <button class="category-tab active" data-category="all">
                    <i class="icon-grid"></i>
                    <span><?php _e('כל הקורסים', 'babyhub'); ?></span>
                </button>
                <button class="category-tab" data-category="pregnancy">
                    <i class="icon-pregnant"></i>
                    <span><?php _e('הריון', 'babyhub'); ?></span>
                </button>
                <button class="category-tab" data-category="birth">
                    <i class="icon-baby"></i>
                    <span><?php _e('לידה', 'babyhub'); ?></span>
                </button>
                <button class="category-tab" data-category="newborn">
                    <i class="icon-baby-bottle"></i>
                    <span><?php _e('תינוק חדש', 'babyhub'); ?></span>
                </button>
                <button class="category-tab" data-category="parenting">
                    <i class="icon-family"></i>
                    <span><?php _e('הורות', 'babyhub'); ?></span>
                </button>
                <button class="category-tab" data-category="health">
                    <i class="icon-health"></i>
                    <span><?php _e('בריאות', 'babyhub'); ?></span>
                </button>
            </div>
        </nav>

        <!-- Featured Courses -->
        <section id="featured-courses" class="featured-courses">
            <div class="section-header">
                <h2><?php _e('קורסים מומלצים', 'babyhub'); ?></h2>
                <p><?php _e('הקורסים הפופולריים והמומלצים ביותר ממומחי ההורות שלנו', 'babyhub'); ?></p>
            </div>
            
            <div class="courses-grid">
                <?php
                // Demo courses - in real implementation this would pull from LearnDash
                $demo_courses = array(
                    array(
                        'title' => 'הכנה מקצועית ללידה טבעית',
                        'instructor' => 'ד"ר רחל לוי',
                        'rating' => 4.9,
                        'students' => 1256,
                        'lessons' => 12,
                        'duration' => '8 שעות',
                        'price' => '₪299',
                        'original_price' => '₪399',
                        'level' => 'מתחילות',
                        'category' => 'birth',
                        'badge' => 'בסט סלר',
                        'preview_image' => '🤱'
                    ),
                    array(
                        'title' => 'הנקה מוצלחת - מההתחלה עד הגמילה',
                        'instructor' => 'אורלי כהן',
                        'rating' => 4.8,
                        'students' => 892,
                        'lessons' => 8,
                        'duration' => '5 שעות',
                        'price' => '₪199',
                        'original_price' => null,
                        'level' => 'כל הרמות',
                        'category' => 'newborn',
                        'badge' => 'חדש',
                        'preview_image' => '🍼'
                    ),
                    array(
                        'title' => 'הריון בריא - תזונה ופעילות גופנית',
                        'instructor' => 'שרה אברהם',
                        'rating' => 4.7,
                        'students' => 634,
                        'lessons' => 10,
                        'duration' => '6 שעות',
                        'price' => '₪249',
                        'original_price' => '₪349',
                        'level' => 'מתחילות',
                        'category' => 'pregnancy',
                        'badge' => 'מומלץ',
                        'preview_image' => '🥗'
                    ),
                    array(
                        'title' => 'שינת תינוקות - טכניקות מוכחות',
                        'instructor' => 'מיכל דוד',
                        'rating' => 4.6,
                        'students' => 445,
                        'lessons' => 6,
                        'duration' => '4 שעות',
                        'price' => '₪149',
                        'original_price' => null,
                        'level' => 'כל הרמות',
                        'category' => 'parenting',
                        'badge' => null,
                        'preview_image' => '😴'
                    ),
                    array(
                        'title' => 'טיפוח וטיפול בתינוק',
                        'instructor' => 'ד"ר יעל רוזן',
                        'rating' => 4.8,
                        'students' => 567,
                        'lessons' => 9,
                        'duration' => '5.5 שעות',
                        'price' => '₪179',
                        'original_price' => null,
                        'level' => 'מתחילות',
                        'category' => 'newborn',
                        'badge' => null,
                        'preview_image' => '🧴'
                    ),
                    array(
                        'title' => 'בטיחות תינוקות וילדים',
                        'instructor' => 'אבי לוי',
                        'rating' => 4.9,
                        'students' => 723,
                        'lessons' => 7,
                        'duration' => '4.5 שעות',
                        'price' => '₪129',
                        'original_price' => '₪199',
                        'level' => 'כל הרמות',
                        'category' => 'health',
                        'badge' => 'חיוני',
                        'preview_image' => '🚨'
                    )
                );
                
                foreach ($demo_courses as $course) : ?>
                    <div class="course-card" data-category="<?php echo $course['category']; ?>">
                        <?php if ($course['badge']) : ?>
                            <span class="course-badge <?php echo sanitize_html_class(strtolower($course['badge'])); ?>">
                                <?php echo $course['badge']; ?>
                            </span>
                        <?php endif; ?>
                        
                        <div class="course-thumbnail">
                            <div class="course-image">
                                <span class="course-emoji"><?php echo $course['preview_image']; ?></span>
                                <div class="course-overlay">
                                    <button class="play-preview" title="<?php _e('נגני תצוגה מקדימה', 'babyhub'); ?>">
                                        <i class="icon-play"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="course-duration">
                                <i class="icon-clock"></i>
                                <?php echo $course['duration']; ?>
                            </div>
                        </div>
                        
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-level"><?php echo $course['level']; ?></span>
                                <span class="course-lessons">
                                    <?php printf(__('%d שיעורים', 'babyhub'), $course['lessons']); ?>
                                </span>
                            </div>
                            
                            <h3 class="course-title">
                                <a href="#"><?php echo $course['title']; ?></a>
                            </h3>
                            
                            <div class="course-instructor">
                                <i class="icon-user"></i>
                                <?php echo $course['instructor']; ?>
                            </div>
                            
                            <div class="course-rating">
                                <div class="stars">
                                    <?php
                                    $full_stars = floor($course['rating']);
                                    $half_star = $course['rating'] - $full_stars >= 0.5;
                                    
                                    for ($i = 0; $i < $full_stars; $i++) {
                                        echo '⭐';
                                    }
                                    if ($half_star) {
                                        echo '✨';
                                    }
                                    ?>
                                </div>
                                <span class="rating-text">
                                    <?php echo $course['rating']; ?> (<?php echo $course['students']; ?> <?php _e('תלמידות', 'babyhub'); ?>)
                                </span>
                            </div>
                            
                            <div class="course-price">
                                <span class="current-price"><?php echo $course['price']; ?></span>
                                <?php if ($course['original_price']) : ?>
                                    <span class="original-price"><?php echo $course['original_price']; ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="course-actions">
                                <button class="btn btn-primary enroll-course">
                                    <i class="icon-play"></i>
                                    <?php _e('הרשמי לקורס', 'babyhub'); ?>
                                </button>
                                <button class="btn btn-secondary wishlist-course" title="<?php _e('הוסף למועדפים', 'babyhub'); ?>">
                                    <i class="icon-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Learning Paths -->
        <section class="learning-paths">
            <div class="section-header">
                <h2><?php _e('מסלולי למידה מובנים', 'babyhub'); ?></h2>
                <p><?php _e('מסלולים מקיפים שיקחו אותך צעד אחר צעד דרך המסע של ההורות', 'babyhub'); ?></p>
            </div>
            
            <div class="paths-grid">
                <div class="learning-path">
                    <div class="path-header">
                        <div class="path-icon">👶</div>
                        <h3 class="path-title"><?php _e('מההריון ללידה', 'babyhub'); ?></h3>
                        <p class="path-description"><?php _e('מסלול מקיף מתחילת ההריון ועד הלידה', 'babyhub'); ?></p>
                    </div>
                    
                    <div class="path-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%"></div>
                        </div>
                        <span class="progress-text"><?php _e('טרם התחלת', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-courses">
                        <span class="courses-count"><?php _e('5 קורסים', 'babyhub'); ?></span>
                        <span class="total-duration"><?php _e('24 שעות', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-actions">
                        <button class="btn btn-primary start-path">
                            <i class="icon-play"></i>
                            <?php _e('התחל מסלול', 'babyhub'); ?>
                        </button>
                        <button class="btn btn-secondary view-curriculum">
                            <?php _e('צפה בתכנית', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
                
                <div class="learning-path">
                    <div class="path-header">
                        <div class="path-icon">🍼</div>
                        <h3 class="path-title"><?php _e('הורות לתינוק', 'babyhub'); ?></h3>
                        <p class="path-description"><?php _e('כל מה שצריך לדעת על טיפול בתינוק', 'babyhub'); ?></p>
                    </div>
                    
                    <div class="path-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%"></div>
                        </div>
                        <span class="progress-text"><?php _e('טרם התחלת', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-courses">
                        <span class="courses-count"><?php _e('4 קורסים', 'babyhub'); ?></span>
                        <span class="total-duration"><?php _e('18 שעות', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-actions">
                        <button class="btn btn-primary start-path">
                            <i class="icon-play"></i>
                            <?php _e('התחל מסלול', 'babyhub'); ?>
                        </button>
                        <button class="btn btn-secondary view-curriculum">
                            <?php _e('צפה בתכנית', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
                
                <div class="learning-path">
                    <div class="path-header">
                        <div class="path-icon">👨‍👩‍👶</div>
                        <h3 class="path-title"><?php _e('הורות מתקדמת', 'babyhub'); ?></h3>
                        <p class="path-description"><?php _e('טיפים והנחיות להורות מוצלחת', 'babyhub'); ?></p>
                    </div>
                    
                    <div class="path-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%"></div>
                        </div>
                        <span class="progress-text"><?php _e('טרם התחלת', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-courses">
                        <span class="courses-count"><?php _e('6 קורסים', 'babyhub'); ?></span>
                        <span class="total-duration"><?php _e('30 שעות', 'babyhub'); ?></span>
                    </div>
                    
                    <div class="path-actions">
                        <button class="btn btn-primary start-path">
                            <i class="icon-play"></i>
                            <?php _e('התחל מסלול', 'babyhub'); ?>
                        </button>
                        <button class="btn btn-secondary view-curriculum">
                            <?php _e('צפה בתכנית', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Instructors -->
        <section class="instructors">
            <div class="section-header">
                <h2><?php _e('המדריכים שלנו', 'babyhub'); ?></h2>
                <p><?php _e('מומחים מובילים בתחום ההורות והילדים', 'babyhub'); ?></p>
            </div>
            
            <div class="instructors-grid">
                <div class="instructor-card">
                    <div class="instructor-avatar">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0i100iIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNTAiIGN5PSI1MCIgcj0iNTAiIGZpbGw9IiNGRjZCOUQiLz4KPHN2ZyB4PSIyNSIgeT0iMjUiIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJ3aGl0ZSI+CjxwYXRoIGQ9Ik0xMiAyQzEzLjEgMiAxNCAyLjkgMTQgNEMxNCA1LjEgMTMuMSA2IDEyIDZDMTAuOSA2IDEwIDUuMSAxMCA0QzEwIDIuOSAxMC45IDIgMTIgMlpNMjEgOVYyMkgxOVYxNkgxM1YyMkgxMVY5QzExIDguNDUgMTEuNDUgOCAxMiA4SDIwQzIwLjU1IDggMjEgOC40NSAyMSA5WiIvPgo8L3N2Zz4KPC9zdmc+" alt="<?php _e('ד"ר רחל לוי', 'babyhub'); ?>" />
                    </div>
                    <div class="instructor-info">
                        <h3 class="instructor-name"><?php _e('ד"ר רחל לוי', 'babyhub'); ?></h3>
                        <p class="instructor-title"><?php _e('רופאת נשים ויולדות', 'babyhub'); ?></p>
                        <div class="instructor-stats">
                            <span class="stat-item">
                                <i class="icon-users"></i>
                                <?php _e('2,340 תלמידות', 'babyhub'); ?>
                            </span>
                            <span class="stat-item">
                                <i class="icon-star"></i>
                                <?php _e('4.9 דירוג', 'babyhub'); ?>
                            </span>
                        </div>
                        <p class="instructor-bio">
                            <?php _e('מומחית בלידות טבעיות עם ניסיון של מעל 15 שנה. מחברת הספר "לידה בטבעיות".', 'babyhub'); ?>
                        </p>
                    </div>
                </div>
                
                <div class="instructor-card">
                    <div class="instructor-avatar">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgY3g9IjUwIiBjeT0iNTAiIHI9IjUwIiBmaWxsPSIjNEVDREFDNCIvPgo8c3ZnIHg9IjI1IiB5PSIyNSIgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiB2aWV3Qm94PSIwIDAgMjQgMjQiIGZpbGw9IndoaXRlIj4KPHBhdGggZD0iTTEyIDJDMTMuMSAyIDE0IDIuOSAxNCA0QzE0IDUuMSAxMy4xIDYgMTIgNkMxMC45IDYgMTAgNS4xIDEwIDRDMTAgMi45IDEwLjkgMiAxMiAyWk0yMSA5VjIySDE5VjE2SDEzVjIySDE1VjlDMTEgOC40NSAxMS40NSA4IDEyIDhIMjBDMjAuNTUgOCAyMSA4LjQ1IDIxIDlaIi8+Cjwvc3ZnPgo8L3N2Zz4=" alt="<?php _e('אורלי כהן', 'babyhub'); ?>" />
                    </div>
                    <div class="instructor-info">
                        <h3 class="instructor-name"><?php _e('אורלי כהן', 'babyhub'); ?></h3>
                        <p class="instructor-title"><?php _e('יועצת הנקה מוסמכת', 'babyhub'); ?></p>
                        <div class="instructor-stats">
                            <span class="stat-item">
                                <i class="icon-users"></i>
                                <?php _e('1,890 תלמידות', 'babyhub'); ?>
                            </span>
                            <span class="stat-item">
                                <i class="icon-star"></i>
                                <?php _e('4.8 דירוג', 'babyhub'); ?>
                            </span>
                        </div>
                        <p class="instructor-bio">
                            <?php _e('יועצת הנקה מוסמכת עם התמחות בהנקה וטיפול בתינוקות. עוזרת לאמהות כבר 10 שנים.', 'babyhub'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- LearnDash Integration -->
        <section class="learndash-integration">
            <div class="section-header">
                <h2><?php _e('פלטפורמת הלמידה המלאה', 'babyhub'); ?></h2>
                <p><?php _e('כל הקורסים והכלים שלנו מופעלים על פלטפורמת LearnDash המתקדמת', 'babyhub'); ?></p>
            </div>
            
            <div class="integration-content">
                <?php
                // Check if LearnDash is active
                if (defined('LEARNDASH_VERSION')) {
                    echo '<div class="learndash-content">';
                    
                    // Display LearnDash course grid
                    if (function_exists('learndash_course_grid')) {
                        echo do_shortcode('[learndash_course_grid]');
                    } else {
                        echo '<p>' . __('תוכן LearnDash יוצג כאן', 'babyhub') . '</p>';
                    }
                    
                    echo '</div>';
                } else {
                    echo '<div class="plugin-notice">';
                    echo '<h3>' . __('LearnDash נדרש', 'babyhub') . '</h3>';
                    echo '<p>' . __('התקן ופעל את תוסף LearnDash כדי להציג את כל הקורסים', 'babyhub') . '</p>';
                    echo '<a href="' . admin_url('plugin-install.php?s=learndash&tab=search&type=term') . '" class="btn btn-primary">';
                    echo __('התקן LearnDash', 'babyhub');
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Course Benefits -->
        <section class="course-benefits">
            <h2><?php _e('למה לבחור בקורסים שלנו?', 'babyhub'); ?></h2>
            
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">🎓</div>
                    <h3><?php _e('מומחים מוסמכים', 'babyhub'); ?></h3>
                    <p><?php _e('כל המדריכים שלנו הם מומחים מוסמכים עם ניסיון עשיר בתחום', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">🎬</div>
                    <h3><?php _e('תוכן איכותי', 'babyhub'); ?></h3>
                    <p><?php _e('סרטונים באיכות גבוהה, חומרי עזר ומשימות מעשיות', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">📱</div>
                    <h3><?php _e('גישה בכל מקום', 'babyhub'); ?></h3>
                    <p><?php _e('למדי מהטלפון, מהמחשב או מהטאבלט - בכל זמן ובכל מקום', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">💬</div>
                    <h3><?php _e('תמיכה מלאה', 'babyhub'); ?></h3>
                    <p><?php _e('פורום תלמידות, שאלות ותשובות, ותמיכה ישירה מהמדריכים', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">🏆</div>
                    <h3><?php _e('תעודות מוכרות', 'babyhub'); ?></h3>
                    <p><?php _e('קבלי תעודת סיום מוכרת לכל קורס שתסיימי בהצלחה', 'babyhub'); ?></p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">🔄</div>
                    <h3><?php _e('עדכונים שוטפים', 'babyhub'); ?></h3>
                    <p><?php _e('התוכן מתעדכן כל הזמן עם המחקרים והטכניקות החדישות', 'babyhub'); ?></p>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Course categories filter
    $('.course-categories .category-tab').on('click', function() {
        const category = $(this).data('category');
        
        // Update nav appearance
        $('.category-tab').removeClass('active');
        $(this).addClass('active');
        
        // Filter courses
        filterCoursesByCategory(category);
    });
    
    function filterCoursesByCategory(category) {
        const $courses = $('.course-card');
        
        if (category === 'all') {
            $courses.show();
        } else {
            $courses.hide();
            $courses.filter('[data-category="' + category + '"]').show();
        }
        
        // Animate the filtering
        $courses.css('opacity', 0);
        setTimeout(() => {
            $courses.filter(':visible').animate({ opacity: 1 }, 300);
        }, 100);
    }
    
    // Course enrollment
    $('.enroll-course').on('click', function() {
        const $btn = $(this);
        const originalText = $btn.html();
        
        $btn.html('<i class="icon-loading"></i> <?php _e("נרשמת...", "babyhub"); ?>').prop('disabled', true);
        
        // Simulate enrollment process
        setTimeout(function() {
            $btn.html('<i class="icon-check"></i> <?php _e("נרשמת בהצלחה!", "babyhub"); ?>')
                .removeClass('btn-primary').addClass('btn-success');
            
            // Show success message
            showEnrollmentSuccess();
        }, 2000);
    });
    
    function showEnrollmentSuccess() {
        const $modal = $('<div class="enrollment-modal-overlay">' +
            '<div class="enrollment-modal">' +
                '<div class="modal-header">' +
                    '<h3><?php _e("הרשמה בוצעה בהצלחה!", "babyhub"); ?></h3>' +
                    '<button class="modal-close">×</button>' +
                '</div>' +
                '<div class="modal-body">' +
                    '<p><?php _e("ברוכה הבאה לקורס! תוכלי להתחיל ללמוד מיד.", "babyhub"); ?></p>' +
                    '<div class="modal-actions">' +
                        '<button class="btn btn-primary start-learning"><?php _e("התחל ללמוד", "babyhub"); ?></button>' +
                        '<button class="btn btn-secondary modal-close"><?php _e("סגור", "babyhub"); ?></button>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>');
        
        $('body').append($modal);
        $modal.fadeIn();
        
        // Close modal handlers
        $modal.on('click', '.modal-close, .enrollment-modal-overlay', function(e) {
            if (e.target === this) {
                $modal.fadeOut(function() {
                    $modal.remove();
                });
            }
        });
    }
    
    // Wishlist functionality
    $('.wishlist-course').on('click', function() {
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
    
    // Learning path functionality
    $('.start-path').on('click', function() {
        alert('<?php _e("מסלולי הלמידה יהיו זמינים בקרוב", "babyhub"); ?>');
    });
    
    $('.view-curriculum').on('click', function() {
        alert('<?php _e("תכנית הלימודים תוצג בקרוב", "babyhub"); ?>');
    });
    
    // Course preview
    $('.play-preview').on('click', function() {
        alert('<?php _e("תצוגה מקדימה תהיה זמינה בקרוב", "babyhub"); ?>');
    });
    
    // Smooth scroll to sections
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
});
</script>

<style>
/* Course-specific animations */
@keyframes courseCardHover {
    from {
        transform: translateY(0);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    to {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
}

.course-card:hover {
    animation: courseCardHover 0.3s ease forwards;
}

/* Enrollment modal styles */
.enrollment-modal-overlay {
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

.enrollment-modal {
    background: white;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
}

.enrollment-modal .modal-header {
    padding: 2rem 2rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
}

.enrollment-modal .modal-body {
    padding: 2rem;
    text-align: center;
}

.enrollment-modal .modal-actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.enrollment-modal .modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #999;
}

.enrollment-modal .modal-close:hover {
    color: #FF6B9D;
}
</style>

<?php get_footer(); ?>