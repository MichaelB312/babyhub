<?php
/**
 * Plugin Name: Baby-Hub Week Tracker
 * Plugin URI: https://baby-hub.co.il
 * Description: מערכת מעקב שבועי אחרי הריון עם תוכן דינמי ותזכורות אוטומטיות
 * Version: 1.0.0
 * Author: Baby-Hub Team
 * Text Domain: babyhub-week-tracker
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Requires PHP: 7.4
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('BABYHUB_WEEK_TRACKER_VERSION', '1.0.0');
define('BABYHUB_WEEK_TRACKER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BABYHUB_WEEK_TRACKER_PLUGIN_URL', plugin_dir_url(__FILE__));

class BabyHubWeekTracker {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Activation/Deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // AJAX hooks
        add_action('wp_ajax_save_due_date', array($this, 'save_due_date'));
        add_action('wp_ajax_get_week_progress', array($this, 'get_week_progress'));
        
        // Cron hooks
        add_action('babyhub_update_pregnancy_weeks', array($this, 'update_all_pregnancy_weeks'));
        add_action('babyhub_send_weekly_updates', array($this, 'send_weekly_updates'));
        
        // URL rewrite hooks
        add_action('init', array($this, 'add_rewrite_rules'));
        add_filter('query_vars', array($this, 'add_query_vars'));
        add_action('template_redirect', array($this, 'handle_week_pages'));
        
        // User profile hooks
        add_action('show_user_profile', array($this, 'add_pregnancy_fields'));
        add_action('edit_user_profile', array($this, 'add_pregnancy_fields'));
        add_action('personal_options_update', array($this, 'save_pregnancy_fields'));
        add_action('edit_user_profile_update', array($this, 'save_pregnancy_fields'));
        
        // Shortcode
        add_shortcode('babyhub-week-progress', array($this, 'week_progress_shortcode'));
        
        // Widget
        add_action('widgets_init', array($this, 'register_widgets'));
        
        // ACF integration
        add_action('acf/init', array($this, 'register_acf_fields'));
    }
    
    public function init() {
        // Load textdomain
        load_plugin_textdomain('babyhub-week-tracker', false, dirname(plugin_basename(__FILE__)) . '/languages');
        
        // Add custom user roles/capabilities if needed
        $this->add_capabilities();
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script(
            'babyhub-week-tracker',
            BABYHUB_WEEK_TRACKER_PLUGIN_URL . 'assets/js/week-tracker.js',
            array('jquery'),
            BABYHUB_WEEK_TRACKER_VERSION,
            true
        );
        
        wp_enqueue_style(
            'babyhub-week-tracker',
            BABYHUB_WEEK_TRACKER_PLUGIN_URL . 'assets/css/week-tracker.css',
            array(),
            BABYHUB_WEEK_TRACKER_VERSION
        );
        
        wp_localize_script('babyhub-week-tracker', 'babyhubWeekTracker', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('babyhub_week_tracker_nonce'),
            'strings' => array(
                'loading' => __('טוען...', 'babyhub-week-tracker'),
                'error' => __('שגיאה בטעינת הנתונים', 'babyhub-week-tracker'),
                'success' => __('נשמר בהצלחה', 'babyhub-week-tracker'),
            )
        ));
    }
    
    public function activate() {
        // Create database tables if needed
        $this->create_tables();
        
        // Schedule cron jobs
        if (!wp_next_scheduled('babyhub_update_pregnancy_weeks')) {
            wp_schedule_event(time(), 'daily', 'babyhub_update_pregnancy_weeks');
        }
        
        if (!wp_next_scheduled('babyhub_send_weekly_updates')) {
            wp_schedule_event(time(), 'weekly', 'babyhub_send_weekly_updates');
        }
        
        // Add rewrite rules
        $this->add_rewrite_rules();
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        // Clear cron jobs
        wp_clear_scheduled_hook('babyhub_update_pregnancy_weeks');
        wp_clear_scheduled_hook('babyhub_send_weekly_updates');
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    private function create_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // Week content table for ACF data
        $table_name = $wpdb->prefix . 'babyhub_week_content';
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            week_number tinyint(2) NOT NULL,
            title varchar(255) NOT NULL,
            baby_development text,
            symptoms text,
            tips text,
            medical_tests text,
            nutrition text,
            exercise text,
            checklist text,
            baby_size varchar(100),
            baby_weight varchar(100),
            trimester tinyint(1),
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY week_number (week_number)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // Insert default week content
        $this->insert_default_week_content();
    }
    
    private function insert_default_week_content() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'babyhub_week_content';
        
        // Check if data already exists
        $existing = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
        if ($existing > 0) {
            return;
        }
        
        // Sample week content (in production this would be much more comprehensive)
        $week_data = array(
            array(
                'week_number' => 4,
                'title' => 'שבוע 4: ההתחלה הרשמית',
                'baby_development' => 'העובר בגודל של זרע פשתן. מתחיל להתפתח מערכת העצבים.',
                'baby_size' => 'זרע פשתן',
                'baby_weight' => 'פחות מגרם',
                'trimester' => 1,
                'symptoms' => 'עייפות, חגירות רגשיות, בחילות קלות',
                'tips' => 'התחילי ליטול חומצה פולית, שתי הרבה מים, נוחי מספיק'
            ),
            array(
                'week_number' => 8,
                'title' => 'שבוע 8: הפעימות הראשונות',
                'baby_development' => 'הלב מתחיל לפעום, גפיים מתחילות להתפתח',
                'baby_size' => 'פולת כידני',
                'baby_weight' => 'כגרם אחד',
                'trimester' => 1,
                'symptoms' => 'בחילות בוקר, רגישות לריחות, עייפות',
                'tips' => 'אכלי ארוחות קטנות ותכופות, הימנעי מריחות חזקים'
            ),
            array(
                'week_number' => 12,
                'title' => 'שבוע 12: סוף הטרימסטר הראשון',
                'baby_development' => 'כל האיברים הבסיסיים נוצרו, התינוק מתחיל לזוז',
                'baby_size' => 'שזיף',
                'baby_weight' => '14 גרם',
                'trimester' => 1,
                'symptoms' => 'בחילות מתחילות להיחלש, אנרגיה חוזרת',
                'tips' => 'זמן טוב להכריז על ההריון, עקבי אחרי בדיקות'
            ),
            array(
                'week_number' => 16,
                'title' => 'שבוע 16: נקודת המפנה',
                'baby_development' => 'ניתן לזהות את המין, התינוק שומע קולות',
                'baby_size' => 'אבוקדו',
                'baby_weight' => '100 גרם',
                'trimester' => 2,
                'symptoms' => 'אנרגיה גבוהה, תיאבון משתפר',
                'tips' => 'התחילי לדבר עם התינוק, שמעי מוזיקה רגועה'
            ),
            array(
                'week_number' => 20,
                'title' => 'שבוע 20: נקודת האמצע',
                'baby_development' => 'התינוק מפתח שגרת שינה, ניתן לחוש בבעיטות',
                'baby_size' => 'בננה',
                'baby_weight' => '300 גרם',
                'trimester' => 2,
                'symptoms' => 'בעיטות ראשונות, כאבי גב קלים',
                'tips' => 'זמן מושלם לאולטרסאונד מורפולוגי, התחילי יוגה להריון'
            ),
            array(
                'week_number' => 24,
                'title' => 'שבוע 24: נקודת הכדאיות',
                'baby_development' => 'התינוק עכשיו כדאי לחיים, הריאות מתפתחות',
                'baby_size' => 'תירס',
                'baby_weight' => '600 גרם',
                'trimester' => 2,
                'symptoms' => 'עלייה במשקל, כאבי גב',
                'tips' => 'בדיקת סוכרת הריון, שימי לב לתזונה מאוזנת'
            ),
            array(
                'week_number' => 28,
                'title' => 'שבוע 28: תחילת הטרימסטר השלישי',
                'baby_development' => 'העיניים נפתחות, מוח מתפתח במהירות',
                'baby_size' => 'חציל',
                'baby_weight' => '1 ק"ג',
                'trimester' => 3,
                'symptoms' => 'קוצר נשימה, צרבת, שינה לא איכותית',
                'tips' => 'התחילי לחשוב על הכנה ללידה, רכישת ציוד תינוק'
            ),
            array(
                'week_number' => 32,
                'title' => 'שבוע 32: התכוננות ללידה',
                'baby_development' => 'התינוק צובר שומן, העצמות מתחזקות',
                'baby_size' => 'קוקוס',
                'baby_weight' => '1.7 ק"ג',
                'trimester' => 3,
                'symptoms' => 'כבדות, בעיטות חזקות, עייפות',
                'tips' => 'הכיני תיק ללידה, למדי טכניקות נשימה'
            ),
            array(
                'week_number' => 36,
                'title' => 'שבוע 36: התינוק מוכן',
                'baby_development' => 'התינוק נחשב בשל, הגוף מתכונן ללידה',
                'baby_size' => 'חסה',
                'baby_weight' => '2.6 ק"ג',
                'trimester' => 3,
                'symptoms' => 'לחץ באגן, התכווצויות אימון',
                'tips' => 'בדיקות שבועיות, הכיני הכל ללידה'
            ),
            array(
                'week_number' => 40,
                'title' => 'שבוע 40: תאריך היעד',
                'baby_development' => 'התינוק מוכן לידה, כל המערכות בוגרות',
                'baby_size' => 'אבטיח קטן',
                'baby_weight' => '3.4 ק"ג',
                'trimester' => 3,
                'symptoms' => 'התכווצויות, ירידת התינוק לאגן',
                'tips' => 'היי מוכנה בכל רגע, שמרי על קשר עם הצוות הרפואי'
            )
        );
        
        foreach ($week_data as $week) {
            $wpdb->insert($table_name, $week);
        }
    }
    
    // Add rewrite rules for dynamic week pages
    public function add_rewrite_rules() {
        add_rewrite_rule(
            '^pregnancy/week-([0-9]+)/?$',
            'index.php?babyhub_week=$matches[1]',
            'top'
        );
        
        add_rewrite_rule(
            '^pregnancy/?$',
            'index.php?babyhub_pregnancy_home=1',
            'top'
        );
    }
    
    public function add_query_vars($vars) {
        $vars[] = 'babyhub_week';
        $vars[] = 'babyhub_pregnancy_home';
        return $vars;
    }
    
    public function handle_week_pages() {
        $week = get_query_var('babyhub_week');
        $pregnancy_home = get_query_var('babyhub_pregnancy_home');
        
        if ($week) {
            $this->display_week_page($week);
        } elseif ($pregnancy_home) {
            $this->display_pregnancy_home();
        }
    }
    
    private function display_week_page($week_number) {
        global $wpdb;
        
        // Validate week number
        if (!is_numeric($week_number) || $week_number < 1 || $week_number > 42) {
            wp_redirect(home_url('/pregnancy/'));
            exit;
        }
        
        // Get week content from database
        $table_name = $wpdb->prefix . 'babyhub_week_content';
        $week_data = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE week_number = %d",
            $week_number
        ));
        
        // If no specific data, create generic content
        if (!$week_data) {
            $week_data = (object) array(
                'week_number' => $week_number,
                'title' => sprintf(__('שבוע %d להריון', 'babyhub-week-tracker'), $week_number),
                'baby_development' => __('התינוק ממשיך להתפתח...', 'babyhub-week-tracker'),
                'baby_size' => __('לא צוין', 'babyhub-week-tracker'),
                'baby_weight' => __('לא צוין', 'babyhub-week-tracker'),
                'trimester' => $week_number <= 12 ? 1 : ($week_number <= 26 ? 2 : 3),
                'symptoms' => '',
                'tips' => '',
                'medical_tests' => '',
                'nutrition' => '',
                'exercise' => '',
                'checklist' => ''
            );
        }
        
        // Set up global post data for theme compatibility
        global $post;
        $post = (object) array(
            'ID' => 0,
            'post_title' => $week_data->title,
            'post_content' => $week_data->baby_development,
            'post_type' => 'pregnancy_week',
            'post_status' => 'publish'
        );
        
        // Include template
        include $this->get_template('single-pregnancy-week.php');
        exit;
    }
    
    private function display_pregnancy_home() {
        global $post;
        
        $post = (object) array(
            'ID' => 0,
            'post_title' => __('מעקב הריון שלי', 'babyhub-week-tracker'),
            'post_content' => __('עקבי אחרי ההריון שלך שבוע אחר שבוע', 'babyhub-week-tracker'),
            'post_type' => 'pregnancy_home',
            'post_status' => 'publish'
        );
        
        include $this->get_template('pregnancy-home.php');
        exit;
    }
    
    private function get_template($template_name) {
        // Check if theme has template override
        $theme_template = get_template_directory() . '/babyhub-week-tracker/' . $template_name;
        if (file_exists($theme_template)) {
            return $theme_template;
        }
        
        // Use plugin template
        $plugin_template = BABYHUB_WEEK_TRACKER_PLUGIN_DIR . 'templates/' . $template_name;
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
        
        // Fallback to default template
        return BABYHUB_WEEK_TRACKER_PLUGIN_DIR . 'templates/default-template.php';
    }
    
    // AJAX handler for saving due date
    public function save_due_date() {
        check_ajax_referer('babyhub_week_tracker_nonce', 'nonce');
        
        $user_id = get_current_user_id();
        if (!$user_id) {
            wp_send_json_error(__('משתמש לא מחובר', 'babyhub-week-tracker'));
        }
        
        $due_date = sanitize_text_field($_POST['due_date']);
        if (!$due_date || !strtotime($due_date)) {
            wp_send_json_error(__('תאריך לא תקין', 'babyhub-week-tracker'));
        }
        
        // Save due date
        update_user_meta($user_id, 'babyhub_due_date', $due_date);
        
        // Calculate and save current week
        $current_week = $this->calculate_pregnancy_week($due_date);
        update_user_meta($user_id, 'babyhub_current_week', $current_week);
        
        wp_send_json_success(array(
            'message' => __('תאריך הלידה נשמר בהצלחה', 'babyhub-week-tracker'),
            'current_week' => $current_week
        ));
    }
    
    // AJAX handler for getting week progress
    public function get_week_progress() {
        check_ajax_referer('babyhub_week_tracker_nonce', 'nonce');
        
        $user_id = get_current_user_id();
        if (!$user_id) {
            wp_send_json_error(__('משתמש לא מחובר', 'babyhub-week-tracker'));
        }
        
        $due_date = get_user_meta($user_id, 'babyhub_due_date', true);
        if (!$due_date) {
            wp_send_json_error(__('לא נמצא תאריך לידה צפוי', 'babyhub-week-tracker'));
        }
        
        $current_week = $this->calculate_pregnancy_week($due_date);
        $progress_percentage = ($current_week / 40) * 100;
        $days_remaining = $this->calculate_days_remaining($due_date);
        
        wp_send_json_success(array(
            'current_week' => $current_week,
            'progress_percentage' => min(100, $progress_percentage),
            'days_remaining' => $days_remaining,
            'due_date' => $due_date
        ));
    }
    
    // Calculate pregnancy week based on due date
    private function calculate_pregnancy_week($due_date) {
        $due_timestamp = strtotime($due_date);
        $lmp_timestamp = $due_timestamp - (40 * 7 * 24 * 60 * 60); // 40 weeks before due date
        $current_timestamp = current_time('timestamp');
        
        $weeks_pregnant = floor(($current_timestamp - $lmp_timestamp) / (7 * 24 * 60 * 60));
        
        return max(0, min(42, $weeks_pregnant));
    }
    
    // Calculate days remaining until due date
    private function calculate_days_remaining($due_date) {
        $due_timestamp = strtotime($due_date);
        $current_timestamp = current_time('timestamp');
        
        $days_remaining = ceil(($due_timestamp - $current_timestamp) / (24 * 60 * 60));
        
        return $days_remaining;
    }
    
    // Cron job to update all users' pregnancy weeks
    public function update_all_pregnancy_weeks() {
        $users_with_due_dates = get_users(array(
            'meta_key' => 'babyhub_due_date',
            'meta_compare' => 'EXISTS'
        ));
        
        foreach ($users_with_due_dates as $user) {
            $due_date = get_user_meta($user->ID, 'babyhub_due_date', true);
            if ($due_date) {
                $current_week = $this->calculate_pregnancy_week($due_date);
                update_user_meta($user->ID, 'babyhub_current_week', $current_week);
            }
        }
    }
    
    // Cron job to send weekly updates
    public function send_weekly_updates() {
        $users_with_due_dates = get_users(array(
            'meta_key' => 'babyhub_due_date',
            'meta_compare' => 'EXISTS'
        ));
        
        foreach ($users_with_due_dates as $user) {
            $due_date = get_user_meta($user->ID, 'babyhub_due_date', true);
            $email_updates = get_user_meta($user->ID, 'babyhub_email_updates', true);
            
            if ($due_date && $email_updates) {
                $current_week = $this->calculate_pregnancy_week($due_date);
                
                // Only send if pregnancy is active (1-42 weeks)
                if ($current_week >= 1 && $current_week <= 42) {
                    $this->send_weekly_email($user, $current_week);
                }
            }
        }
    }
    
    private function send_weekly_email($user, $week) {
        global $wpdb;
        
        // Get week content
        $table_name = $wpdb->prefix . 'babyhub_week_content';
        $week_data = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE week_number = %d",
            $week
        ));
        
        if (!$week_data) {
            return;
        }
        
        $subject = sprintf(__('שבוע %d להריון - עדכון שבועי', 'babyhub-week-tracker'), $week);
        
        $message = "
        <html dir='rtl'>
        <body style='font-family: Arial, sans-serif; direction: rtl; text-align: right;'>
            <h2>{$week_data->title}</h2>
            <p><strong>שלום {$user->display_name},</strong></p>
            <p>אתך בשבוע {$week} להריון!</p>
            
            <h3>התפתחות התינוק השבוע:</h3>
            <p>{$week_data->baby_development}</p>
            
            <h3>גודל התינוק:</h3>
            <p>{$week_data->baby_size} (משקל משוער: {$week_data->baby_weight})</p>
            
            " . ($week_data->tips ? "<h3>טיפים לשבוע זה:</h3><p>{$week_data->tips}</p>" : "") . "
            
            <p><a href='" . home_url("/pregnancy/week-{$week}/") . "'>קראי עוד על שבוע {$week}</a></p>
            
            <p>בהצלחה,<br>צוות Baby-Hub</p>
        </body>
        </html>
        ";
        
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Baby-Hub <noreply@baby-hub.co.il>'
        );
        
        wp_mail($user->user_email, $subject, $message, $headers);
    }
    
    // Add pregnancy fields to user profile
    public function add_pregnancy_fields($user) {
        $due_date = get_user_meta($user->ID, 'babyhub_due_date', true);
        $email_updates = get_user_meta($user->ID, 'babyhub_email_updates', true);
        $current_week = get_user_meta($user->ID, 'babyhub_current_week', true);
        ?>
        <h3><?php _e('מעקב הריון', 'babyhub-week-tracker'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="babyhub_due_date"><?php _e('תאריך לידה צפוי', 'babyhub-week-tracker'); ?></label></th>
                <td>
                    <input type="date" name="babyhub_due_date" id="babyhub_due_date" value="<?php echo esc_attr($due_date); ?>" class="regular-text" />
                    <p class="description"><?php _e('תאריך הלידה המשוער', 'babyhub-week-tracker'); ?></p>
                    <?php if ($current_week): ?>
                        <p><strong><?php printf(__('שבוע נוכחי: %d', 'babyhub-week-tracker'), $current_week); ?></strong></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><label for="babyhub_email_updates"><?php _e('עדכונים במייל', 'babyhub-week-tracker'); ?></label></th>
                <td>
                    <input type="checkbox" name="babyhub_email_updates" id="babyhub_email_updates" value="1" <?php checked($email_updates, 1); ?> />
                    <label for="babyhub_email_updates"><?php _e('קבלת עדכונים שבועיים במייל', 'babyhub-week-tracker'); ?></label>
                </td>
            </tr>
        </table>
        <?php
    }
    
    public function save_pregnancy_fields($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        
        $due_date = sanitize_text_field($_POST['babyhub_due_date']);
        $email_updates = isset($_POST['babyhub_email_updates']) ? 1 : 0;
        
        update_user_meta($user_id, 'babyhub_due_date', $due_date);
        update_user_meta($user_id, 'babyhub_email_updates', $email_updates);
        
        // Update current week if due date was changed
        if ($due_date) {
            $current_week = $this->calculate_pregnancy_week($due_date);
            update_user_meta($user_id, 'babyhub_current_week', $current_week);
        }
    }
    
    // Week progress shortcode
    public function week_progress_shortcode($atts) {
        $atts = shortcode_atts(array(
            'user_id' => get_current_user_id(),
            'style' => 'default'
        ), $atts);
        
        if (!$atts['user_id']) {
            return '<p>' . __('יש להתחבר כדי לראות מעקב הריון', 'babyhub-week-tracker') . '</p>';
        }
        
        $due_date = get_user_meta($atts['user_id'], 'babyhub_due_date', true);
        if (!$due_date) {
            return '<p>' . __('לא הוגדר תאריך לידה צפוי', 'babyhub-week-tracker') . '</p>';
        }
        
        $current_week = $this->calculate_pregnancy_week($due_date);
        $progress_percentage = min(100, ($current_week / 40) * 100);
        $days_remaining = $this->calculate_days_remaining($due_date);
        
        ob_start();
        ?>
        <div class="babyhub-week-progress" data-style="<?php echo esc_attr($atts['style']); ?>">
            <div class="week-display">
                <span class="week-number"><?php echo $current_week; ?></span>
                <span class="week-label"><?php _e('שבוע', 'babyhub-week-tracker'); ?></span>
            </div>
            
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $progress_percentage; ?>%"></div>
            </div>
            
            <div class="progress-info">
                <div class="info-item">
                    <span class="label"><?php _e('ימים עד הלידה:', 'babyhub-week-tracker'); ?></span>
                    <span class="value"><?php echo max(0, $days_remaining); ?></span>
                </div>
                <div class="info-item">
                    <span class="label"><?php _e('תאריך לידה צפוי:', 'babyhub-week-tracker'); ?></span>
                    <span class="value"><?php echo date_i18n('j.n.Y', strtotime($due_date)); ?></span>
                </div>
            </div>
            
            <div class="week-actions">
                <a href="<?php echo home_url("/pregnancy/week-{$current_week}/"); ?>" class="btn btn-primary">
                    <?php _e('צפה בשבוע הנוכחי', 'babyhub-week-tracker'); ?>
                </a>
                <a href="<?php echo home_url('/pregnancy/'); ?>" class="btn btn-secondary">
                    <?php _e('כל השבועות', 'babyhub-week-tracker'); ?>
                </a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    // Register widget
    public function register_widgets() {
        register_widget('BabyHub_Week_Progress_Widget');
    }
    
    // ACF Fields Registration
    public function register_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }
        
        acf_add_local_field_group(array(
            'key' => 'group_babyhub_week_content',
            'title' => __('תוכן שבועי הריון', 'babyhub-week-tracker'),
            'fields' => array(
                array(
                    'key' => 'field_week_number',
                    'label' => __('מספר שבוע', 'babyhub-week-tracker'),
                    'name' => 'week_number',
                    'type' => 'number',
                    'min' => 1,
                    'max' => 42,
                    'required' => 1,
                ),
                array(
                    'key' => 'field_baby_development',
                    'label' => __('התפתחות התינוק', 'babyhub-week-tracker'),
                    'name' => 'baby_development',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_baby_size',
                    'label' => __('גודל התינוק', 'babyhub-week-tracker'),
                    'name' => 'baby_size',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_baby_weight',
                    'label' => __('משקל התינוק', 'babyhub-week-tracker'),
                    'name' => 'baby_weight',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_symptoms',
                    'label' => __('תסמינים נפוצים', 'babyhub-week-tracker'),
                    'name' => 'symptoms',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_tips',
                    'label' => __('טיפים', 'babyhub-week-tracker'),
                    'name' => 'tips',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_medical_tests',
                    'label' => __('בדיקות רפואיות', 'babyhub-week-tracker'),
                    'name' => 'medical_tests',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_nutrition',
                    'label' => __('תזונה', 'babyhub-week-tracker'),
                    'name' => 'nutrition',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_exercise',
                    'label' => __('פעילות גופנית', 'babyhub-week-tracker'),
                    'name' => 'exercise',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_checklist',
                    'label' => __('רשימת משימות', 'babyhub-week-tracker'),
                    'name' => 'checklist',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_checklist_item',
                            'label' => __('משימה', 'babyhub-week-tracker'),
                            'name' => 'task',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_checklist_priority',
                            'label' => __('עדיפות', 'babyhub-week-tracker'),
                            'name' => 'priority',
                            'type' => 'select',
                            'choices' => array(
                                'high' => __('גבוהה', 'babyhub-week-tracker'),
                                'medium' => __('בינונית', 'babyhub-week-tracker'),
                                'low' => __('נמוכה', 'babyhub-week-tracker'),
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'babyhub-week-content',
                    ),
                ),
            ),
        ));
        
        // Add ACF Options page for week content management
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title' => __('ניהול תוכן שבועי', 'babyhub-week-tracker'),
                'menu_title' => __('תוכן הריון שבועי', 'babyhub-week-tracker'),
                'menu_slug' => 'babyhub-week-content',
                'capability' => 'edit_posts',
                'icon_url' => 'dashicons-calendar-alt',
            ));
        }
    }
    
    private function add_capabilities() {
        $role = get_role('administrator');
        if ($role) {
            $role->add_cap('manage_pregnancy_content');
        }
        
        $role = get_role('editor');
        if ($role) {
            $role->add_cap('manage_pregnancy_content');
        }
    }
}

// Week Progress Widget
class BabyHub_Week_Progress_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'babyhub_week_progress',
            __('מעקב שבוע הריון', 'babyhub-week-tracker'),
            array(
                'description' => __('הצגת מעקב השבוע הנוכחי להריון', 'babyhub-week-tracker'),
            )
        );
    }
    
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        // Display week progress for current user
        echo do_shortcode('[babyhub-week-progress]');
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('שבוע הריון שלי', 'babyhub-week-tracker');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('כותרת:', 'babyhub-week-tracker'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

// Initialize the plugin
new BabyHubWeekTracker();

?>