<?php
/**
 * Comments Template
 * Baby-Hub Hebrew RTL Theme
 */

// If comments are closed and there are no comments, return early
if (!comments_open() && get_comments_number() === 0) {
    return;
}
?>

<section id="comments" class="comments-section">
    <div class="comments-container">
        
        <!-- Comments Header -->
        <header class="comments-header">
            <h3 class="comments-title">
                <?php
                $comments_number = get_comments_number();
                if ($comments_number == 0) {
                    _e('היה הראשון להגיב', 'babyhub');
                } elseif ($comments_number == 1) {
                    _e('תגובה אחת', 'babyhub');
                } else {
                    printf(_n('%s תגובה', '%s תגובות', $comments_number, 'babyhub'), number_format_i18n($comments_number));
                }
                ?>
            </h3>
            
            <?php if (get_comments_number() > 0) : ?>
                <div class="comments-meta">
                    <span class="comments-count">
                        <?php printf(__('על "%s"', 'babyhub'), get_the_title()); ?>
                    </span>
                </div>
            <?php endif; ?>
        </header>

        <!-- Comments List -->
        <?php if (have_comments()) : ?>
            <div class="comments-list">
                <ol class="comment-list">
                    <?php
                    wp_list_comments(array(
                        'style'       => 'ol',
                        'short_ping'  => true,
                        'avatar_size' => 60,
                        'callback'    => 'babyhub_comment_callback',
                    ));
                    ?>
                </ol>

                <!-- Comments Pagination -->
                <?php
                $prev_link = get_previous_comments_link(__('← תגובות קודמות', 'babyhub'));
                $next_link = get_next_comments_link(__('תגובות חדשות יותר →', 'babyhub'));
                
                if ($prev_link || $next_link) : ?>
                    <nav class="comments-navigation">
                        <div class="nav-links">
                            <?php if ($prev_link) : ?>
                                <div class="nav-previous"><?php echo $prev_link; ?></div>
                            <?php endif; ?>
                            <?php if ($next_link) : ?>
                                <div class="nav-next"><?php echo $next_link; ?></div>
                            <?php endif; ?>
                        </div>
                    </nav>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Comment Form -->
        <?php if (comments_open()) : ?>
            <div class="comment-respond-section">
                <div id="respond" class="comment-respond">
                    <h3 id="reply-title" class="comment-reply-title">
                        <?php
                        comment_form_title(
                            __('הוסף תגובה', 'babyhub'),
                            __('השב ל%s', 'babyhub')
                        );
                        ?>
                        <small><?php cancel_comment_reply_link(__('ביטול', 'babyhub')); ?></small>
                    </h3>

                    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                        <div class="comment-login-required">
                            <p class="login-message">
                                <?php
                                printf(
                                    __('עליך <a href="%s">להתחבר</a> כדי להגיב.', 'babyhub'),
                                    wp_login_url(apply_filters('the_permalink', get_permalink()))
                                );
                                ?>
                            </p>
                        </div>
                    <?php else : ?>
                        
                        <!-- Comment Form -->
                        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate>
                            
                            <!-- Comment Textarea -->
                            <div class="comment-form-comment">
                                <label for="comment" class="form-label">
                                    <?php _e('תגובה', 'babyhub'); ?>
                                    <span class="required" aria-label="<?php _e('שדה חובה', 'babyhub'); ?>">*</span>
                                </label>
                                <textarea 
                                    id="comment" 
                                    name="comment" 
                                    class="form-control" 
                                    rows="6" 
                                    required
                                    placeholder="<?php _e('כתוב את התגובה שלך כאן...', 'babyhub'); ?>"
                                    aria-describedby="comment-help"
                                ></textarea>
                                <small id="comment-help" class="form-help">
                                    <?php _e('נשמח לשמוע את דעתך! אנא כתוב תגובה מכבדת ורלוונטית.', 'babyhub'); ?>
                                </small>
                            </div>

                            <?php if (!is_user_logged_in()) : ?>
                                
                                <!-- Author Name -->
                                <div class="comment-form-author">
                                    <label for="author" class="form-label">
                                        <?php _e('שם', 'babyhub'); ?>
                                        <?php if (get_option('require_name_email')) : ?>
                                            <span class="required" aria-label="<?php _e('שדה חובה', 'babyhub'); ?>">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input 
                                        id="author" 
                                        name="author" 
                                        type="text" 
                                        class="form-control" 
                                        value="<?php echo esc_attr($comment_author); ?>"
                                        <?php echo get_option('require_name_email') ? 'required' : ''; ?>
                                        placeholder="<?php _e('השם שלך', 'babyhub'); ?>"
                                    />
                                </div>

                                <!-- Author Email -->
                                <div class="comment-form-email">
                                    <label for="email" class="form-label">
                                        <?php _e('אימייל', 'babyhub'); ?>
                                        <?php if (get_option('require_name_email')) : ?>
                                            <span class="required" aria-label="<?php _e('שדה חובה', 'babyhub'); ?>">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        class="form-control" 
                                        value="<?php echo esc_attr($comment_author_email); ?>"
                                        <?php echo get_option('require_name_email') ? 'required' : ''; ?>
                                        placeholder="<?php _e('כתובת האימייל שלך', 'babyhub'); ?>"
                                        aria-describedby="email-help"
                                    />
                                    <small id="email-help" class="form-help">
                                        <?php _e('כתובת האימייל שלך לא תפורסם', 'babyhub'); ?>
                                    </small>
                                </div>

                                <!-- Author URL -->
                                <div class="comment-form-url">
                                    <label for="url" class="form-label">
                                        <?php _e('אתר (אופציונלי)', 'babyhub'); ?>
                                    </label>
                                    <input 
                                        id="url" 
                                        name="url" 
                                        type="url" 
                                        class="form-control" 
                                        value="<?php echo esc_attr($comment_author_url); ?>"
                                        placeholder="<?php _e('https://example.com', 'babyhub'); ?>"
                                    />
                                </div>

                            <?php else : ?>
                                
                                <!-- Logged in user info -->
                                <div class="comment-form-logged-in">
                                    <p class="logged-in-as">
                                        <?php
                                        $current_user = wp_get_current_user();
                                        printf(
                                            __('מחובר בתור <a href="%1$s" aria-label="%2$s">%3$s</a>.', 'babyhub'),
                                            get_edit_user_link(),
                                            /* translators: %s: user name */
                                            esc_attr(sprintf(__('ערוך את הפרופיל שלך, %s', 'babyhub'), $current_user->display_name)),
                                            $current_user->display_name
                                        );
                                        ?>
                                        <a href="<?php echo wp_logout_url(apply_filters('the_permalink', get_permalink())); ?>">
                                            <?php _e('התנתק?', 'babyhub'); ?>
                                        </a>
                                    </p>
                                </div>

                            <?php endif; ?>

                            <!-- Cookie Consent -->
                            <?php if (get_option('show_comments_cookies_opt_in')) : ?>
                                <div class="comment-form-cookies-consent">
                                    <input 
                                        id="wp-comment-cookies-consent" 
                                        name="wp-comment-cookies-consent" 
                                        type="checkbox" 
                                        value="yes"
                                    />
                                    <label for="wp-comment-cookies-consent" class="checkbox-label">
                                        <?php _e('שמור את השם, האימייל והאתר שלי בדפדפן זה עבור התגובה הבאה', 'babyhub'); ?>
                                    </label>
                                </div>
                            <?php endif; ?>

                            <!-- Comment Guidelines -->
                            <div class="comment-guidelines">
                                <details>
                                    <summary><?php _e('כללי תגובות', 'babyhub'); ?></summary>
                                    <div class="guidelines-content">
                                        <ul>
                                            <li><?php _e('כתבו תגובות מכבדות ורלוונטיות לנושא', 'babyhub'); ?></li>
                                            <li><?php _e('הימנעו מלשון הרע, קללות או תוכן פוגעני', 'babyhub'); ?></li>
                                            <li><?php _e('אל תשתפו מידע אישי כמו מספרי טלפון או כתובות', 'babyhub'); ?></li>
                                            <li><?php _e('תגובות בספאם או פרסומות יימחקו', 'babyhub'); ?></li>
                                            <li><?php _e('אנחנו שומרים את הזכות למחוק תגובות שלא מתאימות', 'babyhub'); ?></li>
                                        </ul>
                                    </div>
                                </details>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-submit">
                                <input 
                                    name="submit" 
                                    type="submit" 
                                    id="submit" 
                                    class="btn btn-primary submit" 
                                    value="<?php _e('פרסם תגובה', 'babyhub'); ?>" 
                                />
                                <input type='hidden' name='comment_post_ID' value='<?php echo get_the_ID(); ?>' id='comment_post_ID' />
                                <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                            </div>

                            <!-- Required Fields Notice -->
                            <?php if (get_option('require_name_email')) : ?>
                                <p class="form-allowed-tags">
                                    <small>
                                        <?php _e('שדות החובה מסומנים ב-*', 'babyhub'); ?>
                                    </small>
                                </p>
                            <?php endif; ?>

                            <!-- Allowed HTML Tags -->
                            <?php
                            $allowed_tags = apply_filters('comment_form_allowed_tags', 
                                '<a href="" title=""> <abbr title=""> <acronym title=""> <b> <blockquote cite=""> <cite> <code> <del datetime=""> <em> <i> <q cite=""> <s> <strike> <strong>'
                            );
                            if (!empty($allowed_tags)) : ?>
                                <p class="form-allowed-tags">
                                    <small>
                                        <?php printf(__('ניתן להשתמש בתגי HTML אלה: %s', 'babyhub'), '<code>' . $allowed_tags . '</code>'); ?>
                                    </small>
                                </p>
                            <?php endif; ?>

                        </form>

                    <?php endif; ?>
                </div>
            </div>
            
        <?php elseif (is_singular() && pings_open() && post_type_supports(get_post_type(), 'trackbacks')) : ?>
            
            <!-- Trackbacks/Pingbacks -->
            <div class="no-comments">
                <p class="trackbacks-message">
                    <?php _e('התגובות סגורות, אך ניתן לשלוח trackbacks ו-pingbacks.', 'babyhub'); ?>
                </p>
            </div>
            
        <?php else : ?>
            
            <!-- Comments Closed -->
            <div class="no-comments">
                <p class="comments-closed-message">
                    <?php _e('התגובות סגורות.', 'babyhub'); ?>
                </p>
            </div>
            
        <?php endif; ?>

    </div>
</section>

<?php
/**
 * Custom comment callback function
 */
if (!function_exists('babyhub_comment_callback')) :
function babyhub_comment_callback($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">
        
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        
        <!-- Comment Content -->
        <article class="comment-content">
            
            <!-- Comment Header -->
            <header class="comment-header">
                
                <!-- Comment Avatar -->
                <div class="comment-avatar">
                    <?php
                    if ($args['avatar_size'] != 0) {
                        echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'avatar-img'));
                    }
                    ?>
                </div>

                <!-- Comment Meta -->
                <div class="comment-meta">
                    <div class="comment-author">
                        <?php
                        $comment_author = get_comment_author_link();
                        if (!empty($comment_author)) {
                            echo '<cite class="fn">' . $comment_author . '</cite>';
                        }
                        ?>
                        
                        <?php if (get_comment_author_email() === get_the_author_meta('user_email')) : ?>
                            <span class="author-badge"><?php _e('כותב הפוסט', 'babyhub'); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="comment-metadata">
                        <time datetime="<?php comment_time('c'); ?>" class="comment-date">
                            <?php echo babyhub_get_hebrew_date(get_comment_date('Y-m-d')); ?>
                            <?php _e('בשעה', 'babyhub'); ?> <?php comment_time(); ?>
                        </time>
                        
                        <?php edit_comment_link(__('ערוך', 'babyhub'), '<span class="edit-link">', '</span>'); ?>
                    </div>
                </div>

                <!-- Comment Actions -->
                <div class="comment-actions">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'reply_text' => __('השב', 'babyhub'),
                        'before'    => '<div class="reply-link">',
                        'after'     => '</div>'
                    )));
                    ?>
                </div>
            </header>

            <!-- Comment Text -->
            <div class="comment-text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="comment-awaiting-moderation">
                        <?php _e('התגובה שלך ממתינה לאישור המנהל.', 'babyhub'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="comment-content-text">
                    <?php comment_text(); ?>
                </div>
            </div>
        </article>

        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif; ?>
        
    <?php
}
endif;
?>