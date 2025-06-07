<?php
/**
 * Single Event Template
 * Can be overridden by theme: babyhub-events-calendar/single-event.php
 */

get_header(); ?>

<div class="container single-event-container">
    <?php while (have_posts()) : the_post(); 
        $event_id = get_the_ID();
        $start_date = get_field('event_start_date');
        $end_date = get_field('event_end_date');
        $start_time = get_field('event_start_time');
        $end_time = get_field('event_end_time');
        $location = get_field('event_location');
        $address = get_field('event_address');
        $seats = get_field('event_seats');
        $fee = get_field('event_fee');
        $organizer = get_field('event_organizer');
        $contact_phone = get_field('event_contact_phone');
        $contact_email = get_field('event_contact_email');
        $requirements = get_field('event_requirements');
        
        // Get RSVP count
        global $wpdb;
        $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
        $rsvp_count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE event_id = %d AND rsvp_status = 'attending'",
            $event_id
        ));
        
        $available_seats = $seats ? ($seats - $rsvp_count) : null;
        $user_registered = false;
        
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user_rsvp = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $table_name WHERE event_id = %d AND user_id = %d AND rsvp_status = 'attending'",
                $event_id, $user_id
            ));
            $user_registered = !empty($user_rsvp);
        }
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-event'); ?>>
            
            <!-- Event Header -->
            <header class="event-header">
                <div class="row">
                    <div class="col-8">
                        <h1 class="event-title"><?php the_title(); ?></h1>
                        
                        <div class="event-meta">
                            <div class="event-date-time">
                                <span class="meta-icon">📅</span>
                                <strong>
                                    <?php 
                                    if ($start_date) {
                                        echo date_i18n('l, j F Y', strtotime($start_date));
                                        if ($start_time) {
                                            echo ' בשעה ' . $start_time;
                                        }
                                        if ($end_date && $end_date !== $start_date) {
                                            echo ' עד ' . date_i18n('l, j F Y', strtotime($end_date));
                                        } elseif ($end_time && $end_time !== $start_time) {
                                            echo ' - ' . $end_time;
                                        }
                                    }
                                    ?>
                                </strong>
                            </div>
                            
                            <?php if ($location): ?>
                            <div class="event-location">
                                <span class="meta-icon">📍</span>
                                <strong><?php echo esc_html($location); ?></strong>
                            </div>
                            <?php endif; ?>
                            
                            <div class="event-cost">
                                <span class="meta-icon"><?php echo ($fee && $fee > 0) ? '💰' : '🆓'; ?></span>
                                <strong>
                                    <?php echo ($fee && $fee > 0) ? '₪' . number_format($fee, 2) : 'חינם'; ?>
                                </strong>
                            </div>
                        </div>
                        
                        <!-- Event Categories -->
                        <?php 
                        $categories = get_the_terms($event_id, 'event_category');
                        $age_ranges = get_the_terms($event_id, 'event_age_range');
                        $parent_status = get_the_terms($event_id, 'event_parent_status');
                        
                        if ($categories || $age_ranges || $parent_status): ?>
                        <div class="event-taxonomies">
                            <?php if ($categories): ?>
                                <div class="event-categories">
                                    <?php foreach ($categories as $category): ?>
                                        <span class="event-tag category"><?php echo esc_html($category->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($age_ranges): ?>
                                <div class="event-ages">
                                    <?php foreach ($age_ranges as $age): ?>
                                        <span class="event-tag age"><?php echo esc_html($age->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($parent_status): ?>
                                <div class="event-status-tags">
                                    <?php foreach ($parent_status as $status): ?>
                                        <span class="event-tag status"><?php echo esc_html($status->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-4">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="event-featured-image">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            
            <!-- Event Content -->
            <div class="event-content-wrapper">
                <div class="row">
                    <div class="col-8">
                        <div class="event-content">
                            <h2>תיאור האירוע</h2>
                            <?php the_content(); ?>
                            
                            <?php if ($requirements): ?>
                            <div class="event-requirements">
                                <h3>דרישות מיוחדות</h3>
                                <div class="requirements-content">
                                    <?php echo wpautop(esc_html($requirements)); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <!-- RSVP Card -->
                        <div class="rsvp-card card">
                            <div class="card-header">
                                <h3>הרשמה לאירוע</h3>
                            </div>
                            <div class="card-body">
                                
                                <!-- Seats Information -->
                                <?php if ($seats): ?>
                                <div class="seats-info">
                                    <div class="seats-display">
                                        <div class="seats-bar">
                                            <div class="seats-filled" style="width: <?php echo ($rsvp_count / $seats) * 100; ?>%"></div>
                                        </div>
                                        <div class="seats-text">
                                            <strong><?php echo $rsvp_count; ?> / <?php echo $seats; ?></strong>
                                            <span>נרשמו</span>
                                        </div>
                                    </div>
                                    
                                    <?php if ($available_seats > 0): ?>
                                        <p class="seats-available">
                                            נותרו <strong><?php echo $available_seats; ?></strong> מקומות
                                        </p>
                                    <?php else: ?>
                                        <p class="seats-full">
                                            <strong>האירוע מלא</strong>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="unlimited-seats">
                                    <p><strong><?php echo $rsvp_count; ?></strong> נרשמו</p>
                                    <p>הרשמה פתוחה</p>
                                </div>
                                <?php endif; ?>
                                
                                <!-- RSVP Button -->
                                <div class="rsvp-actions">
                                    <?php if (!is_user_logged_in()): ?>
                                        <p class="login-message">יש להתחבר כדי להירשם לאירוע</p>
                                        <a href="<?php echo wp_login_url(get_permalink()); ?>" class="btn btn-primary btn-block">
                                            התחבר להרשמה
                                        </a>
                                    <?php elseif ($seats && $available_seats <= 0): ?>
                                        <button type="button" class="btn btn-secondary btn-block" disabled>
                                            האירוע מלא
                                        </button>
                                    <?php elseif ($user_registered): ?>
                                        <div class="registered-status">
                                            <p class="text-success"><strong>✓ נרשמת לאירוע זה</strong></p>
                                            <button type="button" class="btn btn-outline rsvp-btn" 
                                                    data-event-id="<?php echo $event_id; ?>" 
                                                    data-action="cancel">
                                                בטל הרשמה
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <?php if ($seats && $available_seats <= 3): ?>
                                            <p class="text-warning">
                                                <strong>מקומות אחרונים!</strong>
                                            </p>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-primary btn-block rsvp-btn" 
                                                data-event-id="<?php echo $event_id; ?>" 
                                                data-action="register">
                                            הירשם לאירוע
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event Details Card -->
                        <div class="event-details-card card">
                            <div class="card-header">
                                <h3>פרטי האירוע</h3>
                            </div>
                            <div class="card-body">
                                
                                <?php if ($address): ?>
                                <div class="detail-item">
                                    <strong>כתובת:</strong>
                                    <div><?php echo wpautop(esc_html($address)); ?></div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($organizer): ?>
                                <div class="detail-item">
                                    <strong>מארגן:</strong>
                                    <div><?php echo esc_html($organizer); ?></div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($contact_phone): ?>
                                <div class="detail-item">
                                    <strong>טלפון:</strong>
                                    <div>
                                        <a href="tel:<?php echo esc_attr($contact_phone); ?>">
                                            <?php echo esc_html($contact_phone); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($contact_email): ?>
                                <div class="detail-item">
                                    <strong>אימייל:</strong>
                                    <div>
                                        <a href="mailto:<?php echo esc_attr($contact_email); ?>">
                                            <?php echo esc_html($contact_email); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        
                        <!-- Share Card -->
                        <div class="share-card card">
                            <div class="card-header">
                                <h3>שתף את האירוע</h3>
                            </div>
                            <div class="card-body">
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                       target="_blank" class="share-btn facebook">
                                        📘 פייסבוק
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                                       target="_blank" class="share-btn whatsapp">
                                        💬 וואטסאפ
                                    </a>
                                    <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" 
                                       class="share-btn email">
                                        📧 אימייל
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </article>
        
    <?php endwhile; ?>
</div>

<style>
/* Single Event Styles */
.single-event-container {
    padding: 2rem 0;
}

.event-header {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #e9ecef;
}

.event-title {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.event-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.event-meta > div {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
}

.meta-icon {
    font-size: 1.1rem;
}

.event-taxonomies {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.event-tag {
    background: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.event-tag.category {
    background: #FF6B9D;
    color: white;
}

.event-tag.age {
    background: #4ECDC4;
    color: white;
}

.event-tag.status {
    background: #45B7D1;
    color: white;
}

.event-featured-image img {
    border-radius: 10px;
    width: 100%;
    height: auto;
}

.event-content h2 {
    color: #2c3e50;
    margin-bottom: 1rem;
    border-bottom: 2px solid #FF6B9D;
    padding-bottom: 0.5rem;
}

.event-requirements {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    margin-top: 2rem;
}

.event-requirements h3 {
    color: #FF6B9D;
    margin-bottom: 1rem;
}

.rsvp-card,
.event-details-card,
.share-card {
    margin-bottom: 2rem;
    position: sticky;
    top: 20px;
}

.card-header h3 {
    margin: 0;
    color: white;
}

.seats-display {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.seats-bar {
    flex: 1;
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.seats-filled {
    height: 100%;
    background: linear-gradient(90deg, #28a745, #20c997);
    transition: width 0.3s ease;
}

.seats-text {
    text-align: center;
    min-width: 80px;
}

.seats-available {
    color: #28a745;
    font-weight: 600;
    margin: 0;
}

.seats-full {
    color: #dc3545;
    font-weight: 600;
    margin: 0;
}

.unlimited-seats {
    text-align: center;
    margin-bottom: 1rem;
}

.registered-status {
    text-align: center;
}

.btn-block {
    width: 100%;
    margin-top: 1rem;
}

.detail-item {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e9ecef;
}

.detail-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.share-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.share-btn {
    display: block;
    padding: 0.75rem;
    text-align: center;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: opacity 0.3s ease;
}

.share-btn:hover {
    opacity: 0.8;
}

.share-btn.facebook {
    background: #1877f2;
    color: white;
}

.share-btn.whatsapp {
    background: #25d366;
    color: white;
}

.share-btn.email {
    background: #6c757d;
    color: white;
}

@media (max-width: 768px) {
    .event-header .row,
    .event-content-wrapper .row {
        flex-direction: column;
    }
    
    .event-header .col-4 {
        order: -1;
        margin-bottom: 1rem;
    }
    
    .rsvp-card,
    .event-details-card,
    .share-card {
        position: static;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    // Handle RSVP button clicks
    $('.rsvp-btn').on('click', function(e) {
        e.preventDefault();
        
        const $button = $(this);
        const eventId = $button.data('event-id');
        const action = $button.data('action');
        
        if (action === 'cancel') {
            if (!confirm('האם את בטוחה שברצונך לבטל את ההרשמה?')) {
                return;
            }
        }
        
        $button.prop('disabled', true).text('טוען...');
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'babyhub_rsvp_event',
                event_id: eventId,
                rsvp_action: action,
                nonce: '<?php echo wp_create_nonce('babyhub_events_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    // Reload page to show updated status
                    location.reload();
                } else {
                    alert(response.data || 'שגיאה בהרשמה לאירוע');
                }
            },
            error: function() {
                alert('שגיאה בהרשמה לאירוע');
            },
            complete: function() {
                $button.prop('disabled', false);
                if (action === 'register') {
                    $button.text('הירשם לאירוע');
                } else {
                    $button.text('בטל הרשמה');
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>