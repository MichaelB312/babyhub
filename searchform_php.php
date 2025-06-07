<?php
/**
 * Search Form Template
 * Baby-Hub Hebrew RTL Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-form-container">
        <div class="search-input-group">
            <label for="search-field-<?php echo uniqid(); ?>" class="screen-reader-text">
                <?php _e('חפש:', 'babyhub'); ?>
            </label>
            <input 
                type="search" 
                id="search-field-<?php echo uniqid(); ?>"
                class="search-field form-control" 
                placeholder="<?php _e('חפש באתר...', 'babyhub'); ?>" 
                value="<?php echo get_search_query(); ?>" 
                name="s" 
                autocomplete="off"
                aria-label="<?php _e('חפש באתר Baby-Hub', 'babyhub'); ?>"
            />
            <button type="submit" class="search-submit btn btn-primary" aria-label="<?php _e('שלח חיפוש', 'babyhub'); ?>">
                <i class="icon-search" aria-hidden="true"></i>
                <span class="search-text"><?php _e('חפש', 'babyhub'); ?></span>
            </button>
        </div>
        
        <!-- Search Suggestions -->
        <div class="search-suggestions" style="display: none;">
            <div class="suggestions-header">
                <span class="suggestions-title"><?php _e('חיפושים פופולריים:', 'babyhub'); ?></span>
            </div>
            <div class="suggestions-list">
                <button type="button" class="suggestion-item" data-term="הריון">
                    <i class="icon-trend"></i> <?php _e('הריון', 'babyhub'); ?>
                </button>
                <button type="button" class="suggestion-item" data-term="לידה">
                    <i class="icon-trend"></i> <?php _e('לידה', 'babyhub'); ?>
                </button>
                <button type="button" class="suggestion-item" data-term="תינוק">
                    <i class="icon-trend"></i> <?php _e('תינוק', 'babyhub'); ?>
                </button>
                <button type="button" class="suggestion-item" data-term="הנקה">
                    <i class="icon-trend"></i> <?php _e('הנקה', 'babyhub'); ?>
                </button>
                <button type="button" class="suggestion-item" data-term="חיתולים">
                    <i class="icon-trend"></i> <?php _e('חיתולים', 'babyhub'); ?>
                </button>
                <button type="button" class="suggestion-item" data-term="ביוץ">
                    <i class="icon-trend"></i> <?php _e('ביוץ', 'babyhub'); ?>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Advanced Search Options (Hidden by default) -->
    <div class="advanced-search" style="display: none;">
        <div class="advanced-search-header">
            <span class="advanced-title"><?php _e('חיפוש מתקדם', 'babyhub'); ?></span>
            <button type="button" class="close-advanced" aria-label="<?php _e('סגור חיפוש מתקדם', 'babyhub'); ?>">×</button>
        </div>
        
        <div class="advanced-search-options">
            <div class="search-option">
                <label for="search-category" class="option-label"><?php _e('חפש בקטגוריה:', 'babyhub'); ?></label>
                <select id="search-category" name="cat" class="form-control">
                    <option value=""><?php _e('כל הקטגוריות', 'babyhub'); ?></option>
                    <?php
                    $categories = get_categories(array('hide_empty' => true));
                    foreach ($categories as $category) {
                        echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="search-option">
                <label for="search-post-type" class="option-label"><?php _e('סוג תוכן:', 'babyhub'); ?></label>
                <select id="search-post-type" name="post_type" class="form-control">
                    <option value=""><?php _e('הכל', 'babyhub'); ?></option>
                    <option value="post"><?php _e('פוסטים', 'babyhub'); ?></option>
                    <option value="page"><?php _e('עמודים', 'babyhub'); ?></option>
                    <option value="babyhub_tool"><?php _e('כלים', 'babyhub'); ?></option>
                    <option value="pregnancy_week"><?php _e('שבועות הריון', 'babyhub'); ?></option>
                    <option value="directory_listing"><?php _e('ספקים', 'babyhub'); ?></option>
                </select>
            </div>
            
            <div class="search-option">
                <label for="search-date" class="option-label"><?php _e('תאריך פרסום:', 'babyhub'); ?></label>
                <select id="search-date" name="date_range" class="form-control">
                    <option value=""><?php _e('כל התאריכים', 'babyhub'); ?></option>
                    <option value="today"><?php _e('היום', 'babyhub'); ?></option>
                    <option value="week"><?php _e('השבוע האחרון', 'babyhub'); ?></option>
                    <option value="month"><?php _e('החודש האחרון', 'babyhub'); ?></option>
                    <option value="year"><?php _e('השנה האחרונה', 'babyhub'); ?></option>
                </select>
            </div>
        </div>
        
        <div class="advanced-search-actions">
            <button type="submit" class="btn btn-primary">
                <i class="icon-search"></i> <?php _e('חפש', 'babyhub'); ?>
            </button>
            <button type="button" class="btn btn-secondary reset-search">
                <i class="icon-refresh"></i> <?php _e('איפוס', 'babyhub'); ?>
            </button>
        </div>
    </div>
    
    <!-- Quick Tools Access -->
    <div class="quick-tools" style="display: none;">
        <div class="quick-tools-header">
            <span class="quick-title"><?php _e('כלים מהירים:', 'babyhub'); ?></span>
        </div>
        <div class="quick-tools-list">
            <a href="<?php echo home_url('/tools/#ovulation-calculator'); ?>" class="quick-tool">
                <span class="tool-icon">🥚</span>
                <span class="tool-name"><?php _e('חישוב ביוץ', 'babyhub'); ?></span>
            </a>
            <a href="<?php echo home_url('/tools/#due-date-calculator'); ?>" class="quick-tool">
                <span class="tool-icon">📅</span>
                <span class="tool-name"><?php _e('תאריך לידה', 'babyhub'); ?></span>
            </a>
            <a href="<?php echo home_url('/tools/#gender-predictor'); ?>" class="quick-tool">
                <span class="tool-icon">👶</span>
                <span class="tool-name"><?php _e('מין תינוק', 'babyhub'); ?></span>
            </a>
            <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="quick-tool">
                <span class="tool-icon">🤱</span>
                <span class="tool-name"><?php _e('מעקב הריון', 'babyhub'); ?></span>
            </a>
        </div>
    </div>
    
    <!-- Search Toggle Buttons -->
    <div class="search-toggles">
        <button type="button" class="toggle-advanced btn btn-link">
            <i class="icon-settings"></i> <?php _e('חיפוש מתקדם', 'babyhub'); ?>
        </button>
        <button type="button" class="toggle-tools btn btn-link">
            <i class="icon-tool"></i> <?php _e('כלים מהירים', 'babyhub'); ?>
        </button>
    </div>
</form>

<script>
jQuery(document).ready(function($) {
    // Search form functionality
    const $searchForm = $('.search-form');
    const $searchField = $searchForm.find('.search-field');
    const $suggestions = $searchForm.find('.search-suggestions');
    const $advancedSearch = $searchForm.find('.advanced-search');
    const $quickTools = $searchForm.find('.quick-tools');
    
    // Show suggestions on focus
    $searchField.on('focus', function() {
        $suggestions.show();
        $advancedSearch.hide();
        $quickTools.hide();
    });
    
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$searchForm.is(e.target) && $searchForm.has(e.target).length === 0) {
            $suggestions.hide();
            $advancedSearch.hide();
            $quickTools.hide();
        }
    });
    
    // Suggestion click handler
    $('.suggestion-item').on('click', function() {
        const term = $(this).data('term');
        $searchField.val(term);
        $searchForm.submit();
    });
    
    // Advanced search toggle
    $('.toggle-advanced').on('click', function(e) {
        e.preventDefault();
        $advancedSearch.toggle();
        $suggestions.hide();
        $quickTools.hide();
    });
    
    // Quick tools toggle
    $('.toggle-tools').on('click', function(e) {
        e.preventDefault();
        $quickTools.toggle();
        $suggestions.hide();
        $advancedSearch.hide();
    });
    
    // Close advanced search
    $('.close-advanced').on('click', function() {
        $advancedSearch.hide();
    });
    
    // Reset search form
    $('.reset-search').on('click', function() {
        $searchForm[0].reset();
        $searchField.focus();
    });
    
    // Search autocomplete (simple implementation)
    let searchTimeout;
    $searchField.on('input', function() {
        const query = $(this).val();
        
        clearTimeout(searchTimeout);
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(function() {
                // Here you could implement AJAX autocomplete
                // For now, we'll just show suggestions
                $suggestions.show();
            }, 300);
        } else {
            $suggestions.hide();
        }
    });
    
    // Keyboard navigation for suggestions
    $searchField.on('keydown', function(e) {
        const $visibleSuggestions = $suggestions.find('.suggestion-item:visible');
        const $activeSuggestion = $visibleSuggestions.filter('.active');
        
        if (e.keyCode === 40) { // Down arrow
            e.preventDefault();
            if ($activeSuggestion.length === 0) {
                $visibleSuggestions.first().addClass('active');
            } else {
                const nextIndex = $visibleSuggestions.index($activeSuggestion) + 1;
                $activeSuggestion.removeClass('active');
                if (nextIndex < $visibleSuggestions.length) {
                    $visibleSuggestions.eq(nextIndex).addClass('active');
                } else {
                    $visibleSuggestions.first().addClass('active');
                }
            }
        } else if (e.keyCode === 38) { // Up arrow
            e.preventDefault();
            if ($activeSuggestion.length === 0) {
                $visibleSuggestions.last().addClass('active');
            } else {
                const prevIndex = $visibleSuggestions.index($activeSuggestion) - 1;
                $activeSuggestion.removeClass('active');
                if (prevIndex >= 0) {
                    $visibleSuggestions.eq(prevIndex).addClass('active');
                } else {
                    $visibleSuggestions.last().addClass('active');
                }
            }
        } else if (e.keyCode === 13 && $activeSuggestion.length > 0) { // Enter
            e.preventDefault();
            $activeSuggestion.click();
        } else if (e.keyCode === 27) { // Escape
            $suggestions.hide();
            $advancedSearch.hide();
            $quickTools.hide();
        }
    });
    
    // Add hover effects to suggestions
    $('.suggestion-item').on('mouseenter', function() {
        $('.suggestion-item').removeClass('active');
        $(this).addClass('active');
    });
});
</script>

<style>
/* Search Form Styles */
.search-form {
    position: relative;
    max-width: 500px;
}

.search-form-container {
    position: relative;
}

.search-input-group {
    display: flex;
    align-items: center;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 50px;
    overflow: hidden;
    transition: border-color 0.3s ease;
}

.search-input-group:focus-within {
    border-color: #FF6B9D;
    box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
}

.search-field {
    flex: 1;
    border: none;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    background: transparent;
    outline: none;
    font-family: inherit;
}

.search-field::placeholder {
    color: #999;
}

.search-submit {
    border: none;
    background: linear-gradient(135deg, #FF6B9D, #4ECDC4);
    color: white;
    padding: 0.75rem 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 0;
}

.search-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(255, 107, 157, 0.3);
}

.search-submit .icon-search {
    margin-left: 0.5rem;
}

.search-text {
    font-weight: 600;
}

/* Search Suggestions */
.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    z-index: 1000;
    margin-top: 0.5rem;
}

.suggestions-header {
    padding: 0.75rem 1rem 0.5rem;
    border-bottom: 1px solid #eee;
}

.suggestions-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #666;
}

.suggestions-list {
    padding: 0.5rem;
}

.suggestion-item {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 0.5rem 1rem;
    border: none;
    background: none;
    text-align: right;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.2s ease;
    font-family: inherit;
    color: #333;
}

.suggestion-item:hover,
.suggestion-item.active {
    background: #f8f9fa;
    color: #FF6B9D;
}

.suggestion-item .icon-trend {
    margin-left: 0.5rem;
    color: #999;
    font-size: 0.8rem;
}

/* Advanced Search */
.advanced-search {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    z-index: 1000;
    margin-top: 0.5rem;
    padding: 1rem;
}

.advanced-search-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
}

.advanced-title {
    font-weight: 600;
    color: #2c3e50;
}

.close-advanced {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #999;
    cursor: pointer;
    line-height: 1;
}

.close-advanced:hover {
    color: #FF6B9D;
}

.advanced-search-options {
    display: grid;
    gap: 1rem;
    margin-bottom: 1rem;
}

.search-option {
    display: flex;
    flex-direction: column;
}

.option-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.advanced-search-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

/* Quick Tools */
.quick-tools {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    z-index: 1000;
    margin-top: 0.5rem;
    padding: 1rem;
}

.quick-tools-header {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
}

.quick-title {
    font-weight: 600;
    color: #2c3e50;
}

.quick-tools-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.quick-tool {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
}

.quick-tool:hover {
    background: #FF6B9D;
    color: white;
    transform: translateY(-2px);
}

.quick-tool .tool-icon {
    margin-left: 0.5rem;
    font-size: 1.1rem;
}

.quick-tool .tool-name {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Search Toggles */
.search-toggles {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 0.75rem;
}

.toggle-advanced,
.toggle-tools {
    font-size: 0.85rem;
    color: #666;
    text-decoration: none;
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    border: none;
    background: none;
    cursor: pointer;
}

.toggle-advanced:hover,
.toggle-tools:hover {
    color: #FF6B9D;
    background: rgba(255, 107, 157, 0.1);
}

.toggle-advanced i,
.toggle-tools i {
    margin-left: 0.25rem;
    font-size: 0.8rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-form {
        max-width: 100%;
    }
    
    .search-submit .search-text {
        display: none;
    }
    
    .search-submit {
        padding: 0.75rem 1rem;
    }
    
    .quick-tools-list {
        grid-template-columns: 1fr;
    }
    
    .advanced-search-options {
        gap: 0.75rem;
    }
    
    .advanced-search-actions {
        flex-direction: column;
    }
    
    .search-toggles {
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .search-field {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .search-submit {
        padding: 0.5rem 0.75rem;
    }
    
    .advanced-search,
    .search-suggestions,
    .quick-tools {
        left: -1rem;
        right: -1rem;
    }
}

/* Screen Reader Only */
.screen-reader-text {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
</style>