<?php
/**
 * Baby-Hub Theme Functions
 * Hebrew RTL WordPress Theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function babyhub_theme_setup() {
    // Theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Navigation menus
    register_nav_menus(array(
        'primary' => __('התפריט הראשי', 'babyhub'),
        'footer' => __('תפריט תחתון', 'babyhub'),
    ));
    
    // RTL support
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'babyhub_theme_setup');

// Enqueue scripts and styles
function babyhub_scripts() {
    // Main stylesheet
    wp_enqueue_style('babyhub-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // RTL stylesheet
    if (is_rtl()) {
        wp_enqueue_style('babyhub-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array('babyhub-style'), '1.0.0');
    }
    
    // Main JavaScript
    wp_enqueue_script('babyhub-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('babyhub-main', 'babyhub_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('babyhub_nonce'),
        'strings' => array(
            'loading' => __('טוען...', 'babyhub'),
            'error' => __('שגיאה בטעינת הנתונים', 'babyhub'),
            'success' => __('הפעולה בוצעה בהצלחה', 'babyhub'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'babyhub_scripts');

// Widget areas
function babyhub_widgets_init() {
    register_sidebar(array(
        'name' => __('סרגל צד ראשי', 'babyhub'),
        'id' => 'sidebar-main',
        'description' => __('סרגל הצד הראשי של האתר', 'babyhub'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('תחתית האתר', 'babyhub'),
        'id' => 'footer-widgets',
        'description' => __('אזור הווידג\'טים בתחתית האתר', 'babyhub'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'babyhub_widgets_init');

// Custom post types
function babyhub_custom_post_types() {
    // Pregnancy Tracker
    register_post_type('pregnancy_week', array(
        'labels' => array(
            'name' => __('שבועות הריון', 'babyhub'),
            'singular_name' => __('שבוע הריון', 'babyhub'),
            'add_new_item' => __('הוסף שבוע הריון חדש', 'babyhub'),
            'edit_item' => __('ערוך שבוע הריון', 'babyhub'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-calendar-alt',
    ));
    
    // Tools
    register_post_type('babyhub_tool', array(
        'labels' => array(
            'name' => __('כלים', 'babyhub'),
            'singular_name' => __('כלי', 'babyhub'),
            'add_new_item' => __('הוסף כלי חדש', 'babyhub'),
            'edit_item' => __('ערוך כלי', 'babyhub'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-admin-tools',
    ));
    
    // Directory Listings
    register_post_type('directory_listing', array(
        'labels' => array(
            'name' => __('רשימות ספקים', 'babyhub'),
            'singular_name' => __('רשימת ספק', 'babyhub'),
            'add_new_item' => __('הוסף ספק חדש', 'babyhub'),
            'edit_item' => __('ערוך ספק', 'babyhub'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-location',
    ));
}
add_action('init', 'babyhub_custom_post_types');

// Custom taxonomies
function babyhub_custom_taxonomies() {
    // Pregnancy stages
    register_taxonomy('pregnancy_stage', 'pregnancy_week', array(
        'labels' => array(
            'name' => __('שלבי הריון', 'babyhub'),
            'singular_name' => __('שלב הריון', 'babyhub'),
        ),
        'hierarchical' => true,
        'public' => true,
    ));
    
    // Tool categories
    register_taxonomy('tool_category', 'babyhub_tool', array(
        'labels' => array(
            'name' => __('קטגוריות כלים', 'babyhub'),
            'singular_name' => __('קטגורית כלי', 'babyhub'),
        ),
        'hierarchical' => true,
        'public' => true,
    ));
    
    // Directory categories
    register_taxonomy('directory_category', 'directory_listing', array(
        'labels' => array(
            'name' => __('קטגוריות ספקים', 'babyhub'),
            'singular_name' => __('קטגורית ספק', 'babyhub'),
        ),
        'hierarchical' => true,
        'public' => true,
    ));
}
add_action('init', 'babyhub_custom_taxonomies');

// AJAX handlers for tools
function babyhub_calculate_ovulation() {
    check_ajax_referer('babyhub_nonce', 'nonce');
    
    $last_period = sanitize_text_field($_POST['last_period']);
    $cycle_length = intval($_POST['cycle_length']);
    
    if ($last_period && $cycle_length) {
        $ovulation_date = date('Y-m-d', strtotime($last_period . ' + ' . ($cycle_length - 14) . ' days'));
        $fertile_start = date('Y-m-d', strtotime($ovulation_date . ' - 5 days'));
        $fertile_end = date('Y-m-d', strtotime($ovulation_date . ' + 1 day'));
        
        wp_send_json_success(array(
            'ovulation_date' => $ovulation_date,
            'fertile_start' => $fertile_start,
            'fertile_end' => $fertile_end,
            'message' => __('החישוב הושלם בהצלחה', 'babyhub')
        ));
    } else {
        wp_send_json_error(__('נתונים לא תקינים', 'babyhub'));
    }
}
add_action('wp_ajax_calculate_ovulation', 'babyhub_calculate_ovulation');
add_action('wp_ajax_nopriv_calculate_ovulation', 'babyhub_calculate_ovulation');

function babyhub_calculate_due_date() {
    check_ajax_referer('babyhub_nonce', 'nonce');
    
    $last_period = sanitize_text_field($_POST['last_period']);
    
    if ($last_period) {
        $due_date = date('Y-m-d', strtotime($last_period . ' + 280 days'));
        $weeks_pregnant = floor((time() - strtotime($last_period)) / (7 * 24 * 60 * 60));
        
        wp_send_json_success(array(
            'due_date' => $due_date,
            'weeks_pregnant' => $weeks_pregnant,
            'message' => __('תאריך הלידה המשוער חושב בהצלחה', 'babyhub')
        ));
    } else {
        wp_send_json_error(__('נתונים לא תקינים', 'babyhub'));
    }
}
add_action('wp_ajax_calculate_due_date', 'babyhub_calculate_due_date');
add_action('wp_ajax_nopriv_calculate_due_date', 'babyhub_calculate_due_date');

// Custom fields for pregnancy tracking
function babyhub_pregnancy_meta_boxes() {
    add_meta_box(
        'pregnancy_details',
        __('פרטי השבוע', 'babyhub'),
        'babyhub_pregnancy_details_callback',
        'pregnancy_week'
    );
}
add_action('add_meta_boxes', 'babyhub_pregnancy_meta_boxes');

function babyhub_pregnancy_details_callback($post) {
    wp_nonce_field('babyhub_pregnancy_details', 'babyhub_pregnancy_details_nonce');
    
    $week_number = get_post_meta($post->ID, '_week_number', true);
    $baby_size = get_post_meta($post->ID, '_baby_size', true);
    $baby_weight = get_post_meta($post->ID, '_baby_weight', true);
    $symptoms = get_post_meta($post->ID, '_symptoms', true);
    $tips = get_post_meta($post->ID, '_tips', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="week_number">' . __('מספר השבוע', 'babyhub') . '</label></th>';
    echo '<td><input type="number" id="week_number" name="week_number" value="' . esc_attr($week_number) . '" /></td></tr>';
    echo '<tr><th><label for="baby_size">' . __('גודל התינוק', 'babyhub') . '</label></th>';
    echo '<td><input type="text" id="baby_size" name="baby_size" value="' . esc_attr($baby_size) . '" /></td></tr>';
    echo '<tr><th><label for="baby_weight">' . __('משקל התינוק', 'babyhub') . '</label></th>';
    echo '<td><input type="text" id="baby_weight" name="baby_weight" value="' . esc_attr($baby_weight) . '" /></td></tr>';
    echo '<tr><th><label for="symptoms">' . __('תסמינים', 'babyhub') . '</label></th>';
    echo '<td><textarea id="symptoms" name="symptoms" rows="3" cols="50">' . esc_textarea($symptoms) . '</textarea></td></tr>';
    echo '<tr><th><label for="tips">' . __('טיפים', 'babyhub') . '</label></th>';
    echo '<td><textarea id="tips" name="tips" rows="3" cols="50">' . esc_textarea($tips) . '</textarea></td></tr>';
    echo '</table>';
}

function babyhub_save_pregnancy_details($post_id) {
    if (!isset($_POST['babyhub_pregnancy_details_nonce']) || 
        !wp_verify_nonce($_POST['babyhub_pregnancy_details_nonce'], 'babyhub_pregnancy_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['week_number'])) {
        update_post_meta($post_id, '_week_number', sanitize_text_field($_POST['week_number']));
    }
    if (isset($_POST['baby_size'])) {
        update_post_meta($post_id, '_baby_size', sanitize_text_field($_POST['baby_size']));
    }
    if (isset($_POST['baby_weight'])) {
        update_post_meta($post_id, '_baby_weight', sanitize_text_field($_POST['baby_weight']));
    }
    if (isset($_POST['symptoms'])) {
        update_post_meta($post_id, '_symptoms', sanitize_textarea_field($_POST['symptoms']));
    }
    if (isset($_POST['tips'])) {
        update_post_meta($post_id, '_tips', sanitize_textarea_field($_POST['tips']));
    }
}
add_action('save_post', 'babyhub_save_pregnancy_details');

// Theme customizer
function babyhub_customize_register($wp_customize) {
    // Site identity section
    $wp_customize->add_setting('babyhub_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'babyhub_logo', array(
        'label' => __('לוגו האתר', 'babyhub'),
        'section' => 'title_tagline',
        'settings' => 'babyhub_logo',
    )));
    
    // Colors section
    $wp_customize->add_section('babyhub_colors', array(
        'title' => __('צבעי הערכה', 'babyhub'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('babyhub_primary_color', array(
        'default' => '#FF6B9D',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'babyhub_primary_color', array(
        'label' => __('צבע ראשי', 'babyhub'),
        'section' => 'babyhub_colors',
        'settings' => 'babyhub_primary_color',
    )));
    
    $wp_customize->add_setting('babyhub_secondary_color', array(
        'default' => '#4ECDC4',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'babyhub_secondary_color', array(
        'label' => __('צבע משני', 'babyhub'),
        'section' => 'babyhub_colors',
        'settings' => 'babyhub_secondary_color',
    )));
}
add_action('customize_register', 'babyhub_customize_register');

// Security enhancements
function babyhub_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'babyhub_security_headers');

// Load textdomain for translations
function babyhub_load_textdomain() {
    load_theme_textdomain('babyhub', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'babyhub_load_textdomain');

// Custom helper functions
function babyhub_get_hebrew_date($date) {
    $hebrew_months = array(
        1 => 'ינואר', 2 => 'פברואר', 3 => 'מרץ', 4 => 'אפריל',
        5 => 'מאי', 6 => 'יוני', 7 => 'יולי', 8 => 'אוגוסט',
        9 => 'ספטמבר', 10 => 'אוקטובר', 11 => 'נובמבר', 12 => 'דצמבר'
    );
    
    $day = date('d', strtotime($date));
    $month = $hebrew_months[date('n', strtotime($date))];
    $year = date('Y', strtotime($date));
    
    return $day . ' ב' . $month . ' ' . $year;
}

function babyhub_get_zodiac_sign($month, $day) {
    $signs = array(
        'מזל טלה' => array(array(3, 21), array(4, 19)),
        'מזל שור' => array(array(4, 20), array(5, 20)),
        'מזל תאומים' => array(array(5, 21), array(6, 20)),
        'מזל סרטן' => array(array(6, 21), array(7, 22)),
        'מזל אריה' => array(array(7, 23), array(8, 22)),
        'מזל בתולה' => array(array(8, 23), array(9, 22)),
        'מזל מאזניים' => array(array(9, 23), array(10, 22)),
        'מזל עקרב' => array(array(10, 23), array(11, 21)),
        'מזל קשת' => array(array(11, 22), array(12, 21)),
        'מזל גדי' => array(array(12, 22), array(1, 19)),
        'מזל דלי' => array(array(1, 20), array(2, 18)),
        'מזל דגים' => array(array(2, 19), array(3, 20))
    );
    
    foreach ($signs as $sign => $dates) {
        if (($month == $dates[0][0] && $day >= $dates[0][1]) || 
            ($month == $dates[1][0] && $day <= $dates[1][1])) {
            return $sign;
        }
    }
    
    return 'מזל גדי'; // Default fallback
}
?>