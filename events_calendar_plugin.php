<?php
/**
 * Plugin Name: Baby-Hub Events Calendar
 * Plugin URI: https://baby-hub.co.il
 * Description: מערכת ניהול אירועים והרשמות עבור הורים וקהילת Baby-Hub
 * Version: 1.0.0
 * Author: Baby-Hub Team
 * Text Domain: babyhub-events-calendar
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
define('BABYHUB_EVENTS_VERSION', '1.0.0');
define('BABYHUB_EVENTS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BABYHUB_EVENTS_PLUGIN_URL', plugin_dir_url(__FILE__));

class BabyHubEventsCalendar {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Activation/Deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Custom post type and taxonomy hooks
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        
        // REST API hooks
        add_action('rest_api_init', array($this, 'register_rest_routes'));
        
        // AJAX hooks
        add_action('wp_ajax_babyhub_rsvp_event', array($this, 'handle_rsvp'));
        add_action('wp_ajax_nopriv_babyhub_rsvp_event', array($this, 'handle_rsvp'));
        
        // Shortcode
        add_shortcode('babyhub-calendar', array($this, 'calendar_shortcode'));
        
        // ACF integration
        add_action('acf/init', array($this, 'register_acf_fields'));
        
        // Admin hooks
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_filter('manage_event_posts_columns', array($this, 'event_columns'));
        add_action('manage_event_posts_custom_column', array($this, 'event_column_content'), 10, 2);
    }
    
    public function init() {
        // Load textdomain
        load_plugin_textdomain('babyhub-events-calendar', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    public function enqueue_scripts() {
        // FullCalendar CSS
        wp_enqueue_style(
            'fullcalendar',
            'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css',
            array(),
            '6.1.8'
        );
        
        // Plugin styles
        wp_enqueue_style(
            'babyhub-events',
            BABYHUB_EVENTS_PLUGIN_URL . 'assets/css/events-calendar.css',
            array(),
            BABYHUB_EVENTS_VERSION
        );
        
        // FullCalendar JS
        wp_enqueue_script(
            'fullcalendar',
            'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js',
            array(),
            '6.1.8',
            true
        );
        
        // Plugin scripts
        wp_enqueue_script(
            'babyhub-events',
            BABYHUB_EVENTS_PLUGIN_URL . 'assets/js/events-calendar.js',
            array('jquery', 'fullcalendar'),
            BABYHUB_EVENTS_VERSION,
            true
        );
        
        wp_localize_script('babyhub-events', 'babyhubEvents', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'rest_url' => rest_url('babyhub/v1/events'),
            'nonce' => wp_create_nonce('babyhub_events_nonce'),
            'strings' => array(
                'loading' => __('טוען...', 'babyhub-events-calendar'),
                'error' => __('שגיאה בטעינת האירועים', 'babyhub-events-calendar'),
                'rsvp_success' => __('נרשמת בהצלחה לאירוע', 'babyhub-events-calendar'),
                'rsvp_error' => __('שגיאה בהרשמה לאירוע', 'babyhub-events-calendar'),
                'event_full' => __('האירוע מלא', 'babyhub-events-calendar'),
                'already_registered' => __('כבר נרשמת לאירוע זה', 'babyhub-events-calendar'),
                'login_required' => __('נדרשת התחברות להרשמה', 'babyhub-events-calendar'),
                'confirm_cancel' => __('האם את בטוחה שברצונך לבטל את ההרשמה?', 'babyhub-events-calendar'),
            )
        ));
    }
    
    public function activate() {
        // Create database tables
        $this->create_tables();
        
        // Register post types and taxonomies first
        $this->register_post_types();
        $this->register_taxonomies();
        
        // Create default taxonomy terms
        $this->create_default_terms();
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    private function create_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // Events RSVP table
        $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            event_id bigint(20) NOT NULL,
            user_id bigint(20) NOT NULL,
            rsvp_status enum('attending', 'cancelled') NOT NULL DEFAULT 'attending',
            rsvp_date datetime DEFAULT CURRENT_TIMESTAMP,
            notes text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY unique_rsvp (event_id, user_id),
            KEY event_id (event_id),
            KEY user_id (user_id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    private function create_default_terms() {
        // Event Categories
        $categories = array(
            array('name' => 'סדנאות', 'slug' => 'workshop', 'description' => 'סדנאות הורות ופיתוח'),
            array('name' => 'מפגשי משחק', 'slug' => 'playdate', 'description' => 'מפגשים חברתיים לילדים והורים'),
            array('name' => 'קבוצות תמיכה', 'slug' => 'support-group', 'description' => 'קבוצות תמיכה והכוונה להורים'),
            array('name' => 'שיעורים', 'slug' => 'class', 'description' => 'שיעורים וקורסים מקצועיים'),
            array('name' => 'אירועים חברתיים', 'slug' => 'social', 'description' => 'מפגשים ואירועים חברתיים'),
            array('name' => 'בריאות ורפואה', 'slug' => 'health', 'description' => 'הרצאות, בדיקות ויעוץ רפואי'),
        );
        
        foreach ($categories as $category) {
            if (!term_exists($category['slug'], 'event_category')) {
                wp_insert_term(
                    $category['name'],
                    'event_category',
                    array(
                        'slug' => $category['slug'],
                        'description' => $category['description']
                    )
                );
            }
        }
        
        // Age Ranges
        $age_ranges = array(
            array('name' => '0-6 חודשים', 'slug' => '0-6-months'),
            array('name' => '6-12 חודשים', 'slug' => '6-12-months'),
            array('name' => '1-2 שנים', 'slug' => '1-2-years'),
            array('name' => '2-3 שנים', 'slug' => '2-3-years'),
            array('name' => '3+ שנים', 'slug' => '3-plus-years'),
            array('name' => 'כל הגילאים', 'slug' => 'all-ages'),
            array('name' => 'מבוגרים בלבד', 'slug' => 'adults-only'),
        );
        
        foreach ($age_ranges as $age_range) {
            if (!term_exists($age_range['slug'], 'event_age_range')) {
                wp_insert_term(
                    $age_range['name'],
                    'event_age_range',
                    array('slug' => $age_range['slug'])
                );
            }
        }
        
        // Parent Status
        $parent_statuses = array(
            array('name' => 'הורים טריים', 'slug' => 'new-parents'),
            array('name' => 'הורים מנוסים', 'slug' => 'experienced-parents'),
            array('name' => 'מצפים', 'slug' => 'expecting'),
            array('name' => 'כל הקהילה', 'slug' => 'all-community'),
            array('name' => 'הורים יחידניים', 'slug' => 'single-parents'),
            array('name' => 'אבות', 'slug' => 'fathers'),
            array('name' => 'אמהות', 'slug' => 'mothers'),
        );
        
        foreach ($parent_statuses as $status) {
            if (!term_exists($status['slug'], 'event_parent_status')) {
                wp_insert_term(
                    $status['name'],
                    'event_parent_status',
                    array('slug' => $status['slug'])
                );
            }
        }
    }
    
    public function register_post_types() {
        register_post_type('event', array(
            'labels' => array(
                'name' => __('אירועים', 'babyhub-events-calendar'),
                'singular_name' => __('אירוע', 'babyhub-events-calendar'),
                'add_new' => __('הוסף אירוע', 'babyhub-events-calendar'),
                'add_new_item' => __('הוסף אירוע חדש', 'babyhub-events-calendar'),
                'edit_item' => __('ערוך אירוע', 'babyhub-events-calendar'),
                'new_item' => __('אירוע חדש', 'babyhub-events-calendar'),
                'view_item' => __('צפה באירוע', 'babyhub-events-calendar'),
                'search_items' => __('חפש אירועים', 'babyhub-events-calendar'),
                'not_found' => __('לא נמצאו אירועים', 'babyhub-events-calendar'),
                'not_found_in_trash' => __('לא נמצאו אירועים בפח', 'babyhub-events-calendar'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-calendar-alt',
            'menu_position' => 25,
            'rewrite' => array('slug' => 'events'),
            'show_in_rest' => true,
            'rest_base' => 'events',
        ));
    }
    
    public function register_taxonomies() {
        // Event categories
        register_taxonomy('event_category', 'event', array(
            'labels' => array(
                'name' => __('קטגוריות אירועים', 'babyhub-events-calendar'),
                'singular_name' => __('קטגורית אירוע', 'babyhub-events-calendar'),
                'add_new_item' => __('הוסף קטגורית אירוע', 'babyhub-events-calendar'),
                'edit_item' => __('ערוך קטגורית אירוע', 'babyhub-events-calendar'),
            ),
            'hierarchical' => true,
            'public' => true,
            'show_in_rest' => true,
        ));
        
        // Age ranges
        register_taxonomy('event_age_range', 'event', array(
            'labels' => array(
                'name' => __('קבוצות גיל', 'babyhub-events-calendar'),
                'singular_name' => __('קבוצת גיל', 'babyhub-events-calendar'),
                'add_new_item' => __('הוסף קבוצת גיל', 'babyhub-events-calendar'),
                'edit_item' => __('ערוך קבוצת גיל', 'babyhub-events-calendar'),
            ),
            'hierarchical' => false,
            'public' => true,
            'show_in_rest' => true,
        ));
        
        // Parent status
        register_taxonomy('event_parent_status', 'event', array(
            'labels' => array(
                'name' => __('סטטוס הורות', 'babyhub-events-calendar'),
                'singular_name' => __('סטטוס הורות', 'babyhub-events-calendar'),
                'add_new_item' => __('הוסף סטטוס הורות', 'babyhub-events-calendar'),
                'edit_item' => __('ערוך סטטוס הורות', 'babyhub-events-calendar'),
            ),
            'hierarchical' => false,
            'public' => true,
            'show_in_rest' => true,
        ));
    }
    
    public function register_rest_routes() {
        register_rest_route('babyhub/v1', '/events', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_events_rest'),
            'permission_callback' => '__return_true',
            'args' => array(
                'start' => array(
                    'required' => false,
                    'type' => 'string',
                    'description' => __('תאריך התחלה', 'babyhub-events-calendar'),
                ),
                'end' => array(
                    'required' => false,
                    'type' => 'string',
                    'description' => __('תאריך סיום', 'babyhub-events-calendar'),
                ),
                'category' => array(
                    'required' => false,
                    'type' => 'string',
                    'description' => __('קטגורית אירוע', 'babyhub-events-calendar'),
                ),
            ),
        ));
    }
    
    public function get_events_rest($request) {
        $start = $request->get_param('start');
        $end = $request->get_param('end');
        $category = $request->get_param('category');
        
        $args = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(),
        );
        
        // Date range filter
        if ($start && $end) {
            $args['meta_query'][] = array(
                'relation' => 'OR',
                array(
                    'key' => 'event_start_date',
                    'value' => array($start, $end),
                    'compare' => 'BETWEEN',
                    'type' => 'DATE',
                ),
                array(
                    'key' => 'event_end_date',
                    'value' => array($start, $end),
                    'compare' => 'BETWEEN',
                    'type' => 'DATE',
                ),
            );
        }
        
        // Category filter
        if ($category) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'event_category',
                    'field' => 'slug',
                    'terms' => $category,
                ),
            );
        }
        
        $events = get_posts($args);
        $formatted_events = array();
        
        foreach ($events as $event) {
            $start_date = get_field('event_start_date', $event->ID);
            $end_date = get_field('event_end_date', $event->ID);
            $start_time = get_field('event_start_time', $event->ID);
            $end_time = get_field('event_end_time', $event->ID);
            $location = get_field('event_location', $event->ID);
            $seats = get_field('event_seats', $event->ID);
            $fee = get_field('event_fee', $event->ID);
            
            // Count RSVPs
            global $wpdb;
            $rsvp_count = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}babyhub_event_rsvps 
                WHERE event_id = %d AND rsvp_status = 'attending'",
                $event->ID
            ));
            
            $available_seats = $seats ? ($seats - $rsvp_count) : null;
            
            $formatted_events[] = array(
                'id' => $event->ID,
                'title' => $event->post_title,
                'description' => $event->post_excerpt,
                'start' => $start_date . ($start_time ? 'T' . $start_time : ''),
                'end' => $end_date . ($end_time ? 'T' . $end_time : ''),
                'location' => $location,
                'url' => get_permalink($event->ID),
                'seats' => $seats,
                'available_seats' => $available_seats,
                'fee' => $fee,
                'backgroundColor' => $this->get_event_color($event->ID),
                'borderColor' => $this->get_event_color($event->ID),
                'extendedProps' => array(
                    'rsvp_count' => $rsvp_count,
                    'age_ranges' => wp_get_post_terms($event->ID, 'event_age_range', array('fields' => 'names')),
                    'parent_status' => wp_get_post_terms($event->ID, 'event_parent_status', array('fields' => 'names')),
                    'categories' => wp_get_post_terms($event->ID, 'event_category', array('fields' => 'names')),
                ),
            );
        }
        
        return rest_ensure_response($formatted_events);
    }
    
    private function get_event_color($event_id) {
        $categories = wp_get_post_terms($event_id, 'event_category');
        
        $color_map = array(
            'workshop' => '#FF6B9D',
            'playdate' => '#4ECDC4',
            'support-group' => '#45B7D1',
            'class' => '#96CEB4',
            'social' => '#FFEAA7',
            'health' => '#DDA0DD',
        );
        
        if (!empty($categories)) {
            $slug = $categories[0]->slug;
            return isset($color_map[$slug]) ? $color_map[$slug] : '#FF6B9D';
        }
        
        return '#FF6B9D';
    }
    
    public function handle_rsvp() {
        check_ajax_referer('babyhub_events_nonce', 'nonce');
        
        if (!is_user_logged_in()) {
            wp_send_json_error(__('נדרשת התחברות להרשמה', 'babyhub-events-calendar'));
        }
        
        $event_id = intval($_POST['event_id']);
        $action = sanitize_text_field($_POST['rsvp_action']); // 'register' or 'cancel'
        $user_id = get_current_user_id();
        
        if (!$event_id || !in_array($action, array('register', 'cancel'))) {
            wp_send_json_error(__('נתונים לא תקינים', 'babyhub-events-calendar'));
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
        
        // Check if user already registered
        $existing_rsvp = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE event_id = %d AND user_id = %d",
            $event_id, $user_id
        ));
        
        if ($action === 'register') {
            // Check available seats
            $total_seats = get_field('event_seats', $event_id);
            if ($total_seats) {
                $current_rsvps = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM $table_name 
                    WHERE event_id = %d AND rsvp_status = 'attending'",
                    $event_id
                ));
                
                if ($current_rsvps >= $total_seats) {
                    wp_send_json_error(__('האירוע מלא', 'babyhub-events-calendar'));
                }
            }
            
            if ($existing_rsvp) {
                if ($existing_rsvp->rsvp_status === 'attending') {
                    wp_send_json_error(__('כבר נרשמת לאירוע זה', 'babyhub-events-calendar'));
                } else {
                    // Update cancelled RSVP to attending
                    $wpdb->update(
                        $table_name,
                        array(
                            'rsvp_status' => 'attending',
                            'updated_at' => current_time('mysql')
                        ),
                        array('id' => $existing_rsvp->id)
                    );
                }
            } else {
                // Create new RSVP
                $wpdb->insert(
                    $table_name,
                    array(
                        'event_id' => $event_id,
                        'user_id' => $user_id,
                        'rsvp_status' => 'attending',
                        'rsvp_date' => current_time('mysql')
                    )
                );
            }
            
            // Update user meta
            $user_events = get_user_meta($user_id, 'babyhub_registered_events', true);
            if (!is_array($user_events)) {
                $user_events = array();
            }
            if (!in_array($event_id, $user_events)) {
                $user_events[] = $event_id;
                update_user_meta($user_id, 'babyhub_registered_events', $user_events);
            }
            
            wp_send_json_success(array(
                'message' => __('נרשמת בהצלחה לאירוע', 'babyhub-events-calendar'),
                'action' => 'registered'
            ));
            
        } elseif ($action === 'cancel') {
            if (!$existing_rsvp || $existing_rsvp->rsvp_status !== 'attending') {
                wp_send_json_error(__('לא נרשמת לאירוע זה', 'babyhub-events-calendar'));
            }
            
            // Update RSVP to cancelled
            $wpdb->update(
                $table_name,
                array(
                    'rsvp_status' => 'cancelled',
                    'updated_at' => current_time('mysql')
                ),
                array('id' => $existing_rsvp->id)
            );
            
            // Update user meta
            $user_events = get_user_meta($user_id, 'babyhub_registered_events', true);
            if (is_array($user_events)) {
                $user_events = array_diff($user_events, array($event_id));
                update_user_meta($user_id, 'babyhub_registered_events', $user_events);
            }
            
            wp_send_json_success(array(
                'message' => __('ההרשמה בוטלה בהצלחה', 'babyhub-events-calendar'),
                'action' => 'cancelled'
            ));
        }
    }
    
    public function calendar_shortcode($atts) {
        $atts = shortcode_atts(array(
            'view' => 'dayGridMonth',
            'height' => 'auto',
            'category' => '',
            'show_filters' => 'true',
        ), $atts);
        
        ob_start();
        ?>
        <div class="babyhub-events-calendar" data-view="<?php echo esc_attr($atts['view']); ?>" data-height="<?php echo esc_attr($atts['height']); ?>" data-category="<?php echo esc_attr($atts['category']); ?>">
            
            <?php if ($atts['show_filters'] === 'true'): ?>
            <div class="calendar-filters">
                <div class="filter-group">
                    <label for="category-filter"><?php _e('קטגוריה:', 'babyhub-events-calendar'); ?></label>
                    <select id="category-filter" class="form-control">
                        <option value=""><?php _e('כל הקטגוריות', 'babyhub-events-calendar'); ?></option>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'event_category',
                            'hide_empty' => false,
                        ));
                        foreach ($categories as $category) {
                            echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="age-filter"><?php _e('קבוצת גיל:', 'babyhub-events-calendar'); ?></label>
                    <select id="age-filter" class="form-control">
                        <option value=""><?php _e('כל הגילאים', 'babyhub-events-calendar'); ?></option>
                        <?php
                        $age_ranges = get_terms(array(
                            'taxonomy' => 'event_age_range',
                            'hide_empty' => false,
                        ));
                        foreach ($age_ranges as $age_range) {
                            echo '<option value="' . esc_attr($age_range->slug) . '">' . esc_html($age_range->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <button type="button" id="today-btn" class="btn btn-secondary"><?php _e('היום', 'babyhub-events-calendar'); ?></button>
                </div>
            </div>
            <?php endif; ?>
            
            <div id="babyhub-calendar"></div>
            
            <div class="calendar-legend">
                <h4><?php _e('מקרא:', 'babyhub-events-calendar'); ?></h4>
                <div class="legend-items">
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: #FF6B9D;"></span>
                        <span><?php _e('סדנאות', 'babyhub-events-calendar'); ?></span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: #4ECDC4;"></span>
                        <span><?php _e('מפגשי משחק', 'babyhub-events-calendar'); ?></span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: #45B7D1;"></span>
                        <span><?php _e('קבוצות תמיכה', 'babyhub-events-calendar'); ?></span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background-color: #96CEB4;"></span>
                        <span><?php _e('שיעורים', 'babyhub-events-calendar'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Modal -->
        <div id="event-modal" class="event-modal" style="display: none;">
            <div class="modal-backdrop" onclick="closeEventModal()"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="modal-close" onclick="closeEventModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="event-details"></div>
                </div>
                <div class="modal-footer">
                    <div class="event-actions"></div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function register_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }
        
        acf_add_local_field_group(array(
            'key' => 'group_event_details',
            'title' => __('פרטי האירוע', 'babyhub-events-calendar'),
            'fields' => array(
                array(
                    'key' => 'field_event_start_date',
                    'label' => __('תאריך התחלה', 'babyhub-events-calendar'),
                    'name' => 'event_start_date',
                    'type' => 'date_picker',
                    'required' => 1,
                    'display_format' => 'd/m/Y',
                    'return_format' => 'Y-m-d',
                ),
                array(
                    'key' => 'field_event_start_time',
                    'label' => __('שעת התחלה', 'babyhub-events-calendar'),
                    'name' => 'event_start_time',
                    'type' => 'time_picker',
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                ),
                array(
                    'key' => 'field_event_end_date',
                    'label' => __('תאריך סיום', 'babyhub-events-calendar'),
                    'name' => 'event_end_date',
                    'type' => 'date_picker',
                    'required' => 1,
                    'display_format' => 'd/m/Y',
                    'return_format' => 'Y-m-d',
                ),
                array(
                    'key' => 'field_event_end_time',
                    'label' => __('שעת סיום', 'babyhub-events-calendar'),
                    'name' => 'event_end_time',
                    'type' => 'time_picker',
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                ),
                array(
                    'key' => 'field_event_location',
                    'label' => __('מיקום', 'babyhub-events-calendar'),
                    'name' => 'event_location',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_event_address',
                    'label' => __('כתובת מדויקת', 'babyhub-events-calendar'),
                    'name' => 'event_address',
                    'type' => 'textarea',
                    'rows' => 3,
                ),
                array(
                    'key' => 'field_event_seats',
                    'label' => __('מספר מקומות', 'babyhub-events-calendar'),
                    'name' => 'event_seats',
                    'type' => 'number',
                    'min' => 1,
                    'instructions' => __('השאר ריק עבור אירועים ללא הגבלת מקומות', 'babyhub-events-calendar'),
                ),
                array(
                    'key' => 'field_event_fee',
                    'label' => __('עלות (₪)', 'babyhub-events-calendar'),
                    'name' => 'event_fee',
                    'type' => 'number',
                    'min' => 0,
                    'step' => 0.01,
                    'instructions' => __('השאר ריק או 0 עבור אירועים חינמיים', 'babyhub-events-calendar'),
                ),
                array(
                    'key' => 'field_event_organizer',
                    'label' => __('מארגן', 'babyhub-events-calendar'),
                    'name' => 'event_organizer',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_event_contact_phone',
                    'label' => __('טלפון ליצירת קשר', 'babyhub-events-calendar'),
                    'name' => 'event_contact_phone',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_event_contact_email',
                    'label' => __('אימייל ליצירת קשר', 'babyhub-events-calendar'),
                    'name' => 'event_contact_email',
                    'type' => 'email',
                ),
                array(
                    'key' => 'field_event_requirements',
                    'label' => __('דרישות מיוחדות', 'babyhub-events-calendar'),
                    'name' => 'event_requirements',
                    'type' => 'textarea',
                    'rows' => 3,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'event',
                    ),
                ),
            ),
        ));
    }
    
    public function add_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=event',
            __('דוחות RSVP', 'babyhub-events-calendar'),
            __('דוחות RSVP', 'babyhub-events-calendar'),
            'manage_options',
            'babyhub-event-reports',
            array($this, 'admin_reports_page')
        );
    }
    
    public function admin_reports_page() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
        
        // Get events with RSVP counts
        $events_query = "
            SELECT e.ID, e.post_title, 
                   COUNT(r.id) as rsvp_count,
                   SUM(CASE WHEN r.rsvp_status = 'attending' THEN 1 ELSE 0 END) as attending_count,
                   SUM(CASE WHEN r.rsvp_status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_count
            FROM {$wpdb->posts} e
            LEFT JOIN $table_name r ON e.ID = r.event_id
            WHERE e.post_type = 'event' AND e.post_status = 'publish'
            GROUP BY e.ID
            ORDER BY e.post_date DESC
        ";
        
        $events = $wpdb->get_results($events_query);
        
        ?>
        <div class="wrap">
            <h1><?php _e('דוחות RSVP לאירועים', 'babyhub-events-calendar'); ?></h1>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('אירוע', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('מקומות', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('נרשמו', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('ביטלו', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('זמינים', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('תאריך', 'babyhub-events-calendar'); ?></th>
                        <th><?php _e('פעולות', 'babyhub-events-calendar'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): 
                        $total_seats = get_field('event_seats', $event->ID);
                        $start_date = get_field('event_start_date', $event->ID);
                        $available = $total_seats ? ($total_seats - $event->attending_count) : __('ללא הגבלה', 'babyhub-events-calendar');
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo esc_html($event->post_title); ?></strong>
                                <div class="row-actions">
                                    <span class="edit">
                                        <a href="<?php echo get_edit_post_link($event->ID); ?>"><?php _e('ערוך', 'babyhub-events-calendar'); ?></a>
                                    </span>
                                </div>
                            </td>
                            <td><?php echo $total_seats ? $total_seats : __('ללא הגבלה', 'babyhub-events-calendar'); ?></td>
                            <td><?php echo $event->attending_count; ?></td>
                            <td><?php echo $event->cancelled_count; ?></td>
                            <td><?php echo $available; ?></td>
                            <td><?php echo $start_date ? date_i18n('d/m/Y', strtotime($start_date)) : '-'; ?></td>
                            <td>
                                <a href="<?php echo admin_url('edit.php?post_type=event&page=babyhub-event-reports&event_id=' . $event->ID); ?>" class="button">
                                    <?php _e('פרטים', 'babyhub-events-calendar'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    public function event_columns($columns) {
        $new_columns = array();
        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;
            if ($key === 'title') {
                $new_columns['event_date'] = __('תאריך', 'babyhub-events-calendar');
                $new_columns['event_rsvps'] = __('נרשמו', 'babyhub-events-calendar');
                $new_columns['event_seats'] = __('מקומות', 'babyhub-events-calendar');
            }
        }
        return $new_columns;
    }
    
    public function event_column_content($column, $post_id) {
        global $wpdb;
        
        switch ($column) {
            case 'event_date':
                $start_date = get_field('event_start_date', $post_id);
                $start_time = get_field('event_start_time', $post_id);
                if ($start_date) {
                    echo date_i18n('d/m/Y', strtotime($start_date));
                    if ($start_time) {
                        echo '<br>' . $start_time;
                    }
                }
                break;
                
            case 'event_rsvps':
                $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
                $count = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM $table_name WHERE event_id = %d AND rsvp_status = 'attending'",
                    $post_id
                ));
                echo $count;
                break;
                
            case 'event_seats':
                $seats = get_field('event_seats', $post_id);
                echo $seats ? $seats : __('ללא הגבלה', 'babyhub-events-calendar');
                break;
        }
    }
}

// Initialize the plugin
new BabyHubEventsCalendar();

?>