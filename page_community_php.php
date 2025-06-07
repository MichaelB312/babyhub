<?php
/**
 * Template Name: Community Page
 * Page template for Baby-Hub community features
 */

get_header(); ?>

<main id="main" class="site-main community-page">
    <div class="container">
        
        <!-- Community Hero -->
        <section class="community-hero">
            <div class="hero-content">
                <h1 class="hero-title"><?php _e('קהילת בייבי-האב', 'babyhub'); ?></h1>
                <p class="hero-description">
                    <?php _e('הצטרפי לאלפי אמהות ואבות שמשתפים חוויות, מקבלים תמיכה ולומדים יחד על המסע המופלא של הורות', 'babyhub'); ?>
                </p>
                
                <div class="community-stats">
                    <div class="stat-item">
                        <span class="stat-number">15,234</span>
                        <span class="stat-label"><?php _e('חברים פעילים', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">2,486</span>
                        <span class="stat-label"><?php _e('דיונים פעילים', 'babyhub'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">8,742</span>
                        <span class="stat-label"><?php _e('תגובות השבוע', 'babyhub'); ?></span>
                    </div>
                </div>
                
                <?php if (!is_user_logged_in()) : ?>
                    <div class="hero-actions">
                        <a href="<?php echo wp_registration_url(); ?>" class="btn btn-primary btn-large">
                            <i class="icon-user-plus"></i>
                            <?php _e('הצטרפי לקהילה', 'babyhub'); ?>
                        </a>
                        <a href="<?php echo wp_login_url(); ?>" class="btn btn-secondary">
                            <i class="icon-login"></i>
                            <?php _e('התחברי', 'babyhub'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="hero-image">
                <div class="community-illustration">
                    <div class="user-avatars">
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <div class="avatar-circle">
                                <span class="avatar-emoji">👩‍👶</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Community Navigation -->
        <nav class="community-nav">
            <div class="nav-container">
                <button class="nav-item active" data-section="groups">
                    <i class="icon-users"></i>
                    <span><?php _e('קבוצות לידה', 'babyhub'); ?></span>
                </button>
                <button class="nav-item" data-section="forums">
                    <i class="icon-chat"></i>
                    <span><?php _e('פורומים', 'babyhub'); ?></span>
                </button>
                <button class="nav-item" data-section="experts">
                    <i class="icon-medical"></i>
                    <span><?php _e('גישה למומחים', 'babyhub'); ?></span>
                </button>
                <button class="nav-item" data-section="events">
                    <i class="icon-calendar"></i>
                    <span><?php _e('אירועים', 'babyhub'); ?></span>
                </button>
            </div>
        </nav>

        <!-- Community Content Sections -->
        <div class="community-content">
            
            <!-- Birth Groups Section -->
            <section id="groups" class="community-section active">
                <div class="section-header">
                    <h2><?php _e('קבוצות לידה לפי חודש', 'babyhub'); ?></h2>
                    <p><?php _e('הצטרפי לקבוצה של אמהות שצפויות ללדת באותו חודש כמוך', 'babyhub'); ?></p>
                </div>
                
                <div class="birth-groups-grid">
                    <?php
                    $months = array(
                        'ינואר 2025' => 156,
                        'פברואר 2025' => 189,
                        'מרץ 2025' => 234,
                        'אפריל 2025' => 198,
                        'מאי 2025' => 167,
                        'יוני 2025' => 145,
                        'יולי 2025' => 178,
                        'אוגוסט 2025' => 203,
                        'ספטמבר 2025' => 167,
                        'אוקטובר 2025' => 134,
                        'נובמבר 2025' => 112,
                        'דצמבר 2025' => 89
                    );
                    
                    foreach ($months as $month => $count) : ?>
                        <div class="birth-group-card">
                            <div class="group-header">
                                <h3 class="group-title"><?php printf(__('יולדות %s', 'babyhub'), $month); ?></h3>
                                <span class="group-count"><?php printf(__('%d חברות', 'babyhub'), $count); ?></span>
                            </div>
                            
                            <div class="group-preview">
                                <div class="recent-messages">
                                    <div class="message-preview">
                                        <span class="message-author">שרה ל.</span>
                                        <span class="message-text"><?php _e('מישהי יודעת איך להתמודד עם בחילות?', 'babyhub'); ?></span>
                                        <span class="message-time"><?php _e('לפני 2 שעות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group-actions">
                                <button class="btn btn-primary join-group" data-group="<?php echo $month; ?>">
                                    <i class="icon-user-plus"></i>
                                    <?php _e('הצטרפי', 'babyhub'); ?>
                                </button>
                                <button class="btn btn-secondary view-group">
                                    <i class="icon-eye"></i>
                                    <?php _e('צפי', 'babyhub'); ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- BuddyBoss Groups Integration -->
                <div class="buddyboss-integration">
                    <h3><?php _e('קבוצות נוספות', 'babyhub'); ?></h3>
                    <div class="integration-placeholder">
                        <?php
                        // This would integrate with BuddyBoss Groups
                        if (function_exists('bp_is_active') && bp_is_active('groups')) {
                            // BuddyBoss groups would be displayed here
                            echo '<div class="buddyboss-groups-container">';
                            echo '<p>' . __('קבוצות BuddyBoss יוצגו כאן', 'babyhub') . '</p>';
                            echo '</div>';
                        } else {
                            echo '<div class="plugin-notice">';
                            echo '<p>' . __('התקן את תוסף BuddyBoss כדי לראות קבוצות נוספות', 'babyhub') . '</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!-- Forums Section -->
            <section id="forums" class="community-section">
                <div class="section-header">
                    <h2><?php _e('פורומי דיון', 'babyhub'); ?></h2>
                    <p><?php _e('שאלי, שתפי ותקבלי עצות מהקהילה', 'babyhub'); ?></p>
                </div>
                
                <div class="forums-grid">
                    <div class="forum-category">
                        <div class="category-header">
                            <h3><?php _e('הריון וטרום לידה', 'babyhub'); ?></h3>
                            <span class="topics-count"><?php _e('1,245 נושאים', 'babyhub'); ?></span>
                        </div>
                        
                        <div class="forum-topics">
                            <div class="topic-item">
                                <div class="topic-info">
                                    <h4 class="topic-title"><?php _e('בחילות בוקר - איך להתמודד?', 'babyhub'); ?></h4>
                                    <div class="topic-meta">
                                        <span class="topic-author"><?php _e('מאת: דנה כ.', 'babyhub'); ?></span>
                                        <span class="topic-time"><?php _e('לפני 3 שעות', 'babyhub'); ?></span>
                                        <span class="topic-replies"><?php _e('12 תגובות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                                <div class="topic-activity">
                                    <div class="last-reply">
                                        <span class="reply-author"><?php _e('מיכל ר.', 'babyhub'); ?></span>
                                        <span class="reply-time"><?php _e('לפני 20 דקות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="topic-item">
                                <div class="topic-info">
                                    <h4 class="topic-title"><?php _e('בדיקות חשובות בטרימסטר השני', 'babyhub'); ?></h4>
                                    <div class="topic-meta">
                                        <span class="topic-author"><?php _e('מאת: ד"ר רחל לוי', 'babyhub'); ?></span>
                                        <span class="topic-time"><?php _e('לפני יום', 'babyhub'); ?></span>
                                        <span class="topic-replies"><?php _e('8 תגובות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                                <div class="topic-activity">
                                    <div class="last-reply">
                                        <span class="reply-author"><?php _e('יעל ש.', 'babyhub'); ?></span>
                                        <span class="reply-time"><?php _e('לפני 2 שעות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="category-actions">
                            <button class="btn btn-primary">
                                <i class="icon-plus"></i>
                                <?php _e('הוסף נושא חדש', 'babyhub'); ?>
                            </button>
                            <a href="#" class="btn btn-secondary"><?php _e('צפה בכל הנושאים', 'babyhub'); ?></a>
                        </div>
                    </div>
                    
                    <div class="forum-category">
                        <div class="category-header">
                            <h3><?php _e('תינוקות וילדים', 'babyhub'); ?></h3>
                            <span class="topics-count"><?php _e('2,156 נושאים', 'babyhub'); ?></span>
                        </div>
                        
                        <div class="forum-topics">
                            <div class="topic-item">
                                <div class="topic-info">
                                    <h4 class="topic-title"><?php _e('הנקה - טיפים לתחילת הדרך', 'babyhub'); ?></h4>
                                    <div class="topic-meta">
                                        <span class="topic-author"><?php _e('מאת: שרה מ.', 'babyhub'); ?></span>
                                        <span class="topic-time"><?php _e('לפני 5 שעות', 'babyhub'); ?></span>
                                        <span class="topic-replies"><?php _e('24 תגובות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                                <div class="topic-activity">
                                    <div class="last-reply">
                                        <span class="reply-author"><?php _e('לינה ח.', 'babyhub'); ?></span>
                                        <span class="reply-time"><?php _e('לפני 10 דקות', 'babyhub'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="category-actions">
                            <button class="btn btn-primary">
                                <i class="icon-plus"></i>
                                <?php _e('הוסף נושא חדש', 'babyhub'); ?>
                            </button>
                            <a href="#" class="btn btn-secondary"><?php _e('צפה בכל הנושאים', 'babyhub'); ?></a>
                        </div>
                    </div>
                </div>
                
                <!-- BuddyBoss Activity Integration -->
                <div class="buddyboss-activity">
                    <h3><?php _e('פעילות אחרונה', 'babyhub'); ?></h3>
                    <div class="integration-placeholder">
                        <?php
                        if (function_exists('bp_is_active') && bp_is_active('activity')) {
                            echo '<div class="buddyboss-activity-container">';
                            echo '<p>' . __('פיד הפעילות של BuddyBoss יוצג כאן', 'babyhub') . '</p>';
                            echo '</div>';
                        } else {
                            echo '<div class="plugin-notice">';
                            echo '<p>' . __('התקן את תוסף BuddyBoss כדי לראות פעילות חברים', 'babyhub') . '</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!-- Experts Section -->
            <section id="experts" class="community-section">
                <div class="section-header">
                    <h2><?php _e('גישה למומחים', 'babyhub'); ?></h2>
                    <p><?php _e('הזמני ייעוץ אישי עם מומחים בתחום ההורות והילדים', 'babyhub'); ?></p>
                </div>
                
                <div class="experts-grid">
                    <div class="expert-card">
                        <div class="expert-avatar">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNDAiIGN5PSI0MCIgcj0iNDAiIGZpbGw9IiNGRjZCOUQiLz4KPHN2ZyB4PSIyMCIgeT0iMjAiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJ3aGl0ZSI+CjxwYXRoIGQ9Ik0xMiAyQzEzLjEgMiAxNCAyLjkgMTQgNEMxNCA1LjEgMTMuMSA2IDEyIDZDMTAuOSA2IDEwIDUuMSAxMCA0QzEwIDIuOSAxMC45IDIgMTIgMlpNMjEgOVYyMkgxOVYxNkgxM1YyMkgxMVY5QzExIDguNDUgMTEuNDUgOCAxMiA4SDIwQzIwLjU1IDggMjEgOC40NSAyMSA5WiIvPgo8L3N2Zz4KPC9zdmc+" alt="<?php _e('ד"ר רחל לוי', 'babyhub'); ?>" />
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name"><?php _e('ד"ר רחל לוי', 'babyhub'); ?></h3>
                            <p class="expert-title"><?php _e('רופאת נשים ויולדות', 'babyhub'); ?></p>
                            <div class="expert-rating">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-text"><?php _e('4.9 (156 ביקורות)', 'babyhub'); ?></span>
                            </div>
                            <p class="expert-specialties"><?php _e('התמחות: הריון בסיכון, לידות טבעיות', 'babyhub'); ?></p>
                        </div>
                        <div class="expert-actions">
                            <button class="btn btn-primary">
                                <i class="icon-calendar"></i>
                                <?php _e('הזמן פגישה', 'babyhub'); ?>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="icon-chat"></i>
                                <?php _e('שלח הודעה', 'babyhub'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="expert-card">
                        <div class="expert-avatar">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNDAiIGN5PSI0MCIgcj0iNDAiIGZpbGw9IiM0RUNEQUM0Ii8+CjxzdmcgeD0iMjAiIHk9IjIwIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0id2hpdGUiPgo8cGF0aCBkPSJNMTIgMkMxMy4xIDIgMTQgMi45IDE0IDRDMTQgNS4xIDEzLjEgNiAxMiA2QzEwLjkgNiAxMCA1LjEgMTAgNEMxMCAyLjkgMTAuOSAyIDEyIDJaTTIxIDlWMjJIMTlWMTZIMTNWMjJIMTFWOUMxMSA4LjQ1IDExLjQ1IDggMTIgOEgyMEMyMC41NSA4IDIxIDguNDUgMjEgOVoiLz4KPC9zdmc+Cjwvc3ZnPg==" alt="<?php _e('אורלי כהן', 'babyhub'); ?>" />
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name"><?php _e('אורלי כהן', 'babyhub'); ?></h3>
                            <p class="expert-title"><?php _e('יועצת הנקה מוסמכת', 'babyhub'); ?></p>
                            <div class="expert-rating">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-text"><?php _e('4.8 (203 ביקורות)', 'babyhub'); ?></span>
                            </div>
                            <p class="expert-specialties"><?php _e('התמחות: הנקה, שינה תינוקות', 'babyhub'); ?></p>
                        </div>
                        <div class="expert-actions">
                            <button class="btn btn-primary">
                                <i class="icon-calendar"></i>
                                <?php _e('הזמן פגישה', 'babyhub'); ?>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="icon-chat"></i>
                                <?php _e('שלח הודעה', 'babyhub'); ?>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="expert-categories">
                    <h3><?php _e('קטגוריות מומחים', 'babyhub'); ?></h3>
                    <div class="categories-grid">
                        <div class="category-item">
                            <i class="category-icon">👩‍⚕️</i>
                            <span class="category-name"><?php _e('רופאי נשים', 'babyhub'); ?></span>
                            <span class="category-count"><?php _e('12 מומחים', 'babyhub'); ?></span>
                        </div>
                        <div class="category-item">
                            <i class="category-icon">🤱</i>
                            <span class="category-name"><?php _e('יועצי הנקה', 'babyhub'); ?></span>
                            <span class="category-count"><?php _e('8 מומחים', 'babyhub'); ?></span>
                        </div>
                        <div class="category-item">
                            <i class="category-icon">👶</i>
                            <span class="category-name"><?php _e('רופאי ילדים', 'babyhub'); ?></span>
                            <span class="category-count"><?php _e('15 מומחים', 'babyhub'); ?></span>
                        </div>
                        <div class="category-item">
                            <i class="category-icon">🧘‍♀️</i>
                            <span class="category-name"><?php _e('מכינים ללידה', 'babyhub'); ?></span>
                            <span class="category-count"><?php _e('6 מומחים', 'babyhub'); ?></span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Events Section -->
            <section id="events" class="community-section">
                <div class="section-header">
                    <h2><?php _e('אירועים וסדנאות', 'babyhub'); ?></h2>
                    <p><?php _e('השתתפי בסדנאות, הרצאות ואירועי הכרות עם הקהילה', 'babyhub'); ?></p>
                </div>
                
                <div class="events-grid">
                    <div class="event-card upcoming">
                        <div class="event-date">
                            <span class="event-day">15</span>
                            <span class="event-month"><?php _e('יוני', 'babyhub'); ?></span>
                        </div>
                        <div class="event-info">
                            <h3 class="event-title"><?php _e('סדנת הכנה ללידה טבעית', 'babyhub'); ?></h3>
                            <div class="event-meta">
                                <span class="event-time">
                                    <i class="icon-clock"></i>
                                    <?php _e('19:00-21:00', 'babyhub'); ?>
                                </span>
                                <span class="event-location">
                                    <i class="icon-location"></i>
                                    <?php _e('אונליין', 'babyhub'); ?>
                                </span>
                                <span class="event-attendees">
                                    <i class="icon-users"></i>
                                    <?php _e('45 משתתפות', 'babyhub'); ?>
                                </span>
                            </div>
                            <p class="event-description">
                                <?php _e('סדנה מקיפה על הכנה ללידה טבעית עם ד"ר רחל לוי. נלמד טכניקות נשימה, עמדות לידה ועוד.', 'babyhub'); ?>
                            </p>
                        </div>
                        <div class="event-actions">
                            <button class="btn btn-primary">
                                <i class="icon-calendar-plus"></i>
                                <?php _e('הרשמי', 'babyhub'); ?>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="icon-share"></i>
                                <?php _e('שתפי', 'babyhub'); ?>
                            </button>
                        </div>
                    </div>
                    
                    <div class="event-card">
                        <div class="event-date">
                            <span class="event-day">22</span>
                            <span class="event-month"><?php _e('יוני', 'babyhub'); ?></span>
                        </div>
                        <div class="event-info">
                            <h3 class="event-title"><?php _e('מפגש אמהות חדשות', 'babyhub'); ?></h3>
                            <div class="event-meta">
                                <span class="event-time">
                                    <i class="icon-clock"></i>
                                    <?php _e('10:00-12:00', 'babyhub'); ?>
                                </span>
                                <span class="event-location">
                                    <i class="icon-location"></i>
                                    <?php _e('תל אביב', 'babyhub'); ?>
                                </span>
                                <span class="event-attendees">
                                    <i class="icon-users"></i>
                                    <?php _e('12 משתתפות', 'babyhub'); ?>
                                </span>
                            </div>
                            <p class="event-description">
                                <?php _e('מפגש חברתי לאמהות שילדו בחודשים האחרונים. נשתף חוויות ונקבל תמיכה.', 'babyhub'); ?>
                            </p>
                        </div>
                        <div class="event-actions">
                            <button class="btn btn-primary">
                                <i class="icon-calendar-plus"></i>
                                <?php _e('הרשמי', 'babyhub'); ?>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="icon-share"></i>
                                <?php _e('שתפי', 'babyhub'); ?>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="events-calendar">
                    <h3><?php _e('לוח אירועים', 'babyhub'); ?></h3>
                    <div class="calendar-placeholder">
                        <p><?php _e('כאן יוצג לוח שנה מלא עם כל האירועים הקרובים', 'babyhub'); ?></p>
                        <button class="btn btn-primary">
                            <i class="icon-calendar"></i>
                            <?php _e('צפה בלוח השנה המלא', 'babyhub'); ?>
                        </button>
                    </div>
                </div>
            </section>

        </div>
        
        <!-- Community Features -->
        <section class="community-features">
            <h2><?php _e('למה לבחור בקהילת בייבי-האב?', 'babyhub'); ?></h2>
            
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🔒</div>
                    <h3><?php _e('סביבה בטוחה ומוגנת', 'babyhub'); ?></h3>
                    <p><?php _e('הקהילה שלנו מונחת ומוגנת כדי להבטיח סביבה תומכת ובטוחה לכל החברות', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">👩‍⚕️</div>
                    <h3><?php _e('מומחים מוסמכים', 'babyhub'); ?></h3>
                    <p><?php _e('גישה ישירה לרופאים, יועצי הנקה ומומחים אחרים בתחום ההורות', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">🤝</div>
                    <h3><?php _e('תמיכה 24/7', 'babyhub'); ?></h3>
                    <p><?php _e('הקהילה פעילה כל היום, תמיד תמצאי מישהי שיכולה לעזור ולתמוך', 'babyhub'); ?></p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">📚</div>
                    <h3><?php _e('תוכן איכותי', 'babyhub'); ?></h3>
                    <p><?php _e('מאמרים, סדנאות וכלים שנבדקו על ידי מומחים בתחום', 'babyhub'); ?></p>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Community navigation
    $('.community-nav .nav-item').on('click', function() {
        const section = $(this).data('section');
        
        // Update nav appearance
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
        
        // Show relevant section
        $('.community-section').removeClass('active');
        $('#' + section).addClass('active');
        
        // Smooth scroll to content
        $('html, body').animate({
            scrollTop: $('.community-content').offset().top - 100
        }, 500);
    });
    
    // Join group functionality
    $('.join-group').on('click', function() {
        const group = $(this).data('group');
        
        if (!<?php echo is_user_logged_in() ? 'true' : 'false'; ?>) {
            alert('<?php _e("עליך להתחבר כדי להצטרף לקבוצה", "babyhub"); ?>');
            window.location.href = '<?php echo wp_login_url(); ?>';
            return;
        }
        
        // Here would be AJAX call to join group
        $(this).html('<i class="icon-check"></i> <?php _e("הצטרפת!", "babyhub"); ?>').prop('disabled', true);
    });
    
    // Expert consultation booking
    $('.expert-actions .btn-primary').on('click', function() {
        if (!<?php echo is_user_logged_in() ? 'true' : 'false'; ?>) {
            alert('<?php _e("עליך להתחבר כדי להזמין פגישה", "babyhub"); ?>');
            window.location.href = '<?php echo wp_login_url(); ?>';
            return;
        }
        
        alert('<?php _e("פונקציונליות הזמנת פגישות תהיה זמינה בקרוב", "babyhub"); ?>');
    });
    
    // Event registration
    $('.event-actions .btn-primary').on('click', function() {
        if (!<?php echo is_user_logged_in() ? 'true' : 'false'; ?>) {
            alert('<?php _e("עליך להתחבר כדי להירשם לאירוע", "babyhub"); ?>');
            window.location.href = '<?php echo wp_login_url(); ?>';
            return;
        }
        
        const $btn = $(this);
        const originalText = $btn.html();
        
        $btn.html('<i class="icon-loading"></i> <?php _e("נרשמת...", "babyhub"); ?>').prop('disabled', true);
        
        setTimeout(function() {
            $btn.html('<i class="icon-check"></i> <?php _e("נרשמת!", "babyhub"); ?>');
        }, 1500);
    });
    
    // Share event
    $('.event-actions .btn-secondary').on('click', function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("אירוע בקהילת Baby-Hub", "babyhub"); ?>',
                text: '<?php _e("הצטרפי אלי לאירוע המעניין הזה", "babyhub"); ?>',
                url: window.location.href
            });
        } else {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('<?php _e("הקישור הועתק ללוח", "babyhub"); ?>');
            });
        }
    });
});
</script>

<?php get_footer(); ?>