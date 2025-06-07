<?php
/**
 * Template Name: Tools Page
 * Page template for Baby-Hub tools overview
 */

get_header(); ?>

<main id="main" class="site-main tools-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php if (get_the_content()) : ?>
                    <div class="page-description">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </header>

            <!-- Tools Grid -->
            <section class="tools-section">
                <div class="tools-grid">
                    
                    <!-- Ovulation Calculator -->
                    <div class="tool-card" data-tool="ovulation">
                        <a href="#ovulation-calculator" class="tool-link">
                            <span class="tool-icon">🥚</span>
                            <h3 class="tool-title"><?php _e('חישוב ביוץ', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('חשבי את ימי הפוריות שלך', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Due Date Calculator -->
                    <div class="tool-card" data-tool="due-date">
                        <a href="#due-date-calculator" class="tool-link">
                            <span class="tool-icon">📅</span>
                            <h3 class="tool-title"><?php _e('חישוב תאריך לידה', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('מתי התינוק שלך אמור להגיע?', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Chinese Gender Predictor -->
                    <div class="tool-card" data-tool="gender">
                        <a href="#gender-predictor" class="tool-link">
                            <span class="tool-icon">👶</span>
                            <h3 class="tool-title"><?php _e('ניחוש מין תינוק', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('תחזית מין התינוק לפי השיטה הסינית', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Baby Names Finder -->
                    <div class="tool-card" data-tool="names">
                        <a href="#baby-names" class="tool-link">
                            <span class="tool-icon">📝</span>
                            <h3 class="tool-title"><?php _e('מאגר שמות תינוקות', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('מצאי את השם המושלם לתינוק שלך', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Weight Gain Calculator -->
                    <div class="tool-card" data-tool="weight">
                        <a href="#weight-calculator" class="tool-link">
                            <span class="tool-icon">⚖️</span>
                            <h3 class="tool-title"><?php _e('מעקב עלייה במשקל', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('עקבי אחרי עלייה במשקל בהריון', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Birth Plan Worksheet -->
                    <div class="tool-card" data-tool="birth-plan">
                        <a href="#birth-plan" class="tool-link">
                            <span class="tool-icon">📋</span>
                            <h3 class="tool-title"><?php _e('תוכנית לידה', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('צרי תוכנית לידה מותאמת אישית', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Registry Manager -->
                    <div class="tool-card" data-tool="registry">
                        <a href="#registry-manager" class="tool-link">
                            <span class="tool-icon">🎁</span>
                            <h3 class="tool-title"><?php _e('רשימת מתנות', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('נהלי רשימת מתנות לתינוק', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Baby Costs Calculator -->
                    <div class="tool-card" data-tool="costs">
                        <a href="#costs-calculator" class="tool-link">
                            <span class="tool-icon">💰</span>
                            <h3 class="tool-title"><?php _e('חישוב עלויות תינוק', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('חשבי כמה עולה לגדל תינוק', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Solid Feeding Guide -->
                    <div class="tool-card" data-tool="feeding">
                        <a href="#feeding-guide" class="tool-link">
                            <span class="tool-icon">🥄</span>
                            <h3 class="tool-title"><?php _e('מדריך מזון מוצק', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('מתי ואיך להתחיל מזון מוצק', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Growth Chart -->
                    <div class="tool-card" data-tool="growth">
                        <a href="#growth-chart" class="tool-link">
                            <span class="tool-icon">📊</span>
                            <h3 class="tool-title"><?php _e('טבלת גדילה', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('עקבי אחרי גדילת התינוק שלך', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Height Predictor -->
                    <div class="tool-card" data-tool="height">
                        <a href="#height-predictor" class="tool-link">
                            <span class="tool-icon">📏</span>
                            <h3 class="tool-title"><?php _e('חיזוי גובה תינוק', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('כמה גבוה יהיה התינוק שלך?', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Zodiac Calculator -->
                    <div class="tool-card" data-tool="zodiac">
                        <a href="#zodiac-calculator" class="tool-link">
                            <span class="tool-icon">⭐</span>
                            <h3 class="tool-title"><?php _e('מזל התינוק', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('גלי את מזל התינוק שלך', 'babyhub'); ?></p>
                        </a>
                    </div>

                    <!-- Pregnancy Tracker -->
                    <div class="tool-card" data-tool="tracker">
                        <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="tool-link">
                            <span class="tool-icon">🤱</span>
                            <h3 class="tool-title"><?php _e('מעקב הריון', 'babyhub'); ?></h3>
                            <p class="tool-description"><?php _e('מעקב שבועי אחרי ההריון', 'babyhub'); ?></p>
                        </a>
                    </div>

                </div>
            </section>

            <!-- Individual Tool Sections -->
            <div class="tools-content">
                
                <!-- Ovulation Calculator -->
                <section id="ovulation-calculator" class="tool-section" style="display: none;">
                    <div class="tool-header">
                        <h2><?php _e('חישוב ביוץ', 'babyhub'); ?></h2>
                        <p><?php _e('חשבי את ימי הפוריות שלך על בסיס מחזור החודשי', 'babyhub'); ?></p>
                    </div>
                    
                    <form id="ovulation-form" class="tool-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last-period" class="form-label"><?php _e('תאריך הווסת האחרונה', 'babyhub'); ?></label>
                                <input type="date" id="last-period" name="last_period" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cycle-length" class="form-label"><?php _e('אורך המחזור (בימים)', 'babyhub'); ?></label>
                                <select id="cycle-length" name="cycle_length" class="form-control" required>
                                    <option value="">בחרי אורך מחזור</option>
                                    <?php for ($i = 21; $i <= 35; $i++) : ?>
                                        <option value="<?php echo $i; ?>" <?php selected($i, 28); ?>>
                                            <?php echo $i; ?> ימים
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php _e('חשב ביוץ', 'babyhub'); ?></button>
                    </form>
                    
                    <div id="ovulation-results" class="results-container"></div>
                </section>

                <!-- Due Date Calculator -->
                <section id="due-date-calculator" class="tool-section" style="display: none;">
                    <div class="tool-header">
                        <h2><?php _e('חישוב תאריך לידה', 'babyhub'); ?></h2>
                        <p><?php _e('חשבי את תאריך הלידה המשוער על בסיס הווסת האחרונה', 'babyhub'); ?></p>
                    </div>
                    
                    <form id="due-date-form" class="tool-form">
                        <div class="form-group">
                            <label for="lmp-date" class="form-label"><?php _e('תאריך הווסת האחרונה', 'babyhub'); ?></label>
                            <input type="date" id="lmp-date" name="last_period" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php _e('חשב תאריך לידה', 'babyhub'); ?></button>
                    </form>
                    
                    <div id="due-date-results" class="results-container"></div>
                </section>

                <!-- Gender Predictor -->
                <section id="gender-predictor" class="tool-section" style="display: none;">
                    <div class="tool-header">
                        <h2><?php _e('ניחוש מין תינוק', 'babyhub'); ?></h2>
                        <p><?php _e('תחזית מין התינוק לפי השיטה הסינית העתיקה', 'babyhub'); ?></p>
                    </div>
                    
                    <form id="gender-form" class="tool-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="mother-age" class="form-label"><?php _e('גיל האמא בזמן ההריון', 'babyhub'); ?></label>
                                <input type="number" id="mother-age" name="mother_age" class="form-control" min="15" max="50" required>
                            </div>
                            <div class="form-group">
                                <label for="conception-month" class="form-label"><?php _e('חודש ההריון', 'babyhub'); ?></label>
                                <select id="conception-month" name="conception_month" class="form-control" required>
                                    <option value="">בחרי חודש</option>
                                    <option value="1">ינואר</option>
                                    <option value="2">פברואר</option>
                                    <option value="3">מרץ</option>
                                    <option value="4">אפריל</option>
                                    <option value="5">מאי</option>
                                    <option value="6">יוני</option>
                                    <option value="7">יולי</option>
                                    <option value="8">אוגוסט</option>
                                    <option value="9">ספטמבר</option>
                                    <option value="10">אוקטובר</option>
                                    <option value="11">נובמבר</option>
                                    <option value="12">דצמבר</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php _e('נחש מין', 'babyhub'); ?></button>
                    </form>
                    
                    <div id="gender-results" class="results-container"></div>
                </section>

                <!-- Additional tool sections would continue here -->
                <!-- For brevity, I'll include placeholders for the remaining tools -->
                
                <?php 
                // Additional tool sections can be included here
                // Each following the same pattern as above
                ?>

            </div>

        <?php endwhile; ?>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Tool card click handler
    $('.tool-card').on('click', function(e) {
        e.preventDefault();
        
        const toolName = $(this).data('tool');
        const targetSection = $(this).find('a').attr('href');
        
        // Hide all tool sections
        $('.tool-section').hide();
        
        // Show selected tool section
        if (targetSection.startsWith('#')) {
            $(targetSection).show();
            
            // Scroll to section
            $('html, body').animate({
                scrollTop: $(targetSection).offset().top - 100
            }, 500);
        } else {
            // External link - navigate normally
            window.location.href = targetSection;
        }
    });
    
    // Back to tools button
    $('<button class="btn btn-secondary back-to-tools" style="margin-bottom: 2rem;">← חזור לכלים</button>')
        .prependTo('.tool-section')
        .on('click', function() {
            $('.tool-section').hide();
            $('html, body').animate({
                scrollTop: $('.tools-section').offset().top - 100
            }, 500);
        });
});
</script>

<?php get_footer(); ?>