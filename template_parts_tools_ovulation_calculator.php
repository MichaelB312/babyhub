<?php
/**
 * Ovulation Calculator Tool Template Part
 * Baby-Hub Hebrew RTL Theme
 */
?>

<div class="tool-form ovulation-calculator-form">
    <form id="ovulation-form" class="calculator-form" novalidate>
        <div class="form-header">
            <h3><?php _e('חישוב ביוץ ותקופת פוריות', 'babyhub'); ?></h3>
            <p class="form-description">
                <?php _e('הזיני את הפרטים הבאים כדי לחשב את ימי הפוריות שלך ותאריך הביוץ המשוער', 'babyhub'); ?>
            </p>
        </div>

        <div class="form-body">
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="last-period" class="form-label required">
                        <?php _e('תאריך הווסת האחרונה', 'babyhub'); ?>
                        <span class="required-indicator">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="last-period" 
                        name="last_period" 
                        class="form-control" 
                        required
                        max="<?php echo date('Y-m-d'); ?>"
                        aria-describedby="last-period-help"
                    />
                    <small id="last-period-help" class="form-help">
                        <?php _e('היום הראשון של הווסת האחרונה שלך', 'babyhub'); ?>
                    </small>
                </div>

                <div class="form-group col-6">
                    <label for="cycle-length" class="form-label required">
                        <?php _e('אורך המחזור החודשי', 'babyhub'); ?>
                        <span class="required-indicator">*</span>
                    </label>
                    <select id="cycle-length" name="cycle_length" class="form-control" required aria-describedby="cycle-help">
                        <option value=""><?php _e('בחרי אורך מחזור', 'babyhub'); ?></option>
                        <?php for ($i = 21; $i <= 35; $i++) : ?>
                            <option value="<?php echo $i; ?>" <?php selected($i, 28); ?>>
                                <?php printf(__('%d ימים', 'babyhub'), $i); ?>
                            </option>
                        <?php endfor; ?>
                        <option value="custom"><?php _e('אורך מחזור אחר', 'babyhub'); ?></option>
                    </select>
                    <small id="cycle-help" class="form-help">
                        <?php _e('המחזור הממוצע הוא 28 ימים, אך יכול להיות בין 21-35 ימים', 'babyhub'); ?>
                    </small>
                </div>
            </div>

            <!-- Custom Cycle Length Input -->
            <div class="form-group custom-cycle-group" style="display: none;">
                <label for="custom-cycle" class="form-label">
                    <?php _e('אורך מחזור מותאם (בימים)', 'babyhub'); ?>
                </label>
                <input 
                    type="number" 
                    id="custom-cycle" 
                    name="custom_cycle" 
                    class="form-control" 
                    min="15" 
                    max="45"
                    placeholder="<?php _e('הזיני מספר ימים', 'babyhub'); ?>"
                />
            </div>

            <!-- Advanced Options -->
            <div class="advanced-options">
                <button type="button" class="toggle-advanced" data-target="ovulation-advanced">
                    <i class="icon-settings"></i>
                    <?php _e('אפשרויות מתקדמות', 'babyhub'); ?>
                    <i class="icon-chevron-down"></i>
                </button>
                
                <div id="ovulation-advanced" class="advanced-content" style="display: none;">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="luteal-phase" class="form-label">
                                <?php _e('אורך השלב הלוטאלי', 'babyhub'); ?>
                            </label>
                            <select id="luteal-phase" name="luteal_phase" class="form-control">
                                <option value="14"><?php _e('14 ימים (ברירת מחדל)', 'babyhub'); ?></option>
                                <?php for ($i = 10; $i <= 16; $i++) : ?>
                                    <?php if ($i != 14) : ?>
                                        <option value="<?php echo $i; ?>">
                                            <?php printf(__('%d ימים', 'babyhub'), $i); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                            <small class="form-help">
                                <?php _e('השלב מהביוץ עד הווסת הבאה', 'babyhub'); ?>
                            </small>
                        </div>

                        <div class="form-group col-6">
                            <label for="tracking-method" class="form-label">
                                <?php _e('שיטת מעקב', 'babyhub'); ?>
                            </label>
                            <select id="tracking-method" name="tracking_method" class="form-control">
                                <option value="calendar"><?php _e('מעקב לוח שנה', 'babyhub'); ?></option>
                                <option value="temperature"><?php _e('מדידת טמפרטורה', 'babyhub'); ?></option>
                                <option value="cervical"><?php _e('בדיקת ריר צוואר הרחם', 'babyhub'); ?></option>
                                <option value="combined"><?php _e('שיטה משולבת', 'babyhub'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">
                <i class="icon-calculator"></i>
                <?php _e('חשב ביוץ ופוריות', 'babyhub'); ?>
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="icon-refresh"></i>
                <?php _e('איפוס', 'babyhub'); ?>
            </button>
        </div>
    </form>

    <!-- Results Container -->
    <div id="ovulation-results" class="results-container" style="display: none;">
        <!-- Results will be populated here -->
    </div>
</div>

<!-- Information Section -->
<div class="tool-info-section">
    <div class="info-tabs">
        <button class="info-tab active" data-tab="about">
            <?php _e('מידע כללי', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="tips">
            <?php _e('טיפים', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="faq">
            <?php _e('שאלות נפוצות', 'babyhub'); ?>
        </button>
    </div>

    <div class="info-content">
        <div id="about" class="tab-content active">
            <h4><?php _e('מה זה ביוץ?', 'babyhub'); ?></h4>
            <p><?php _e('ביוץ הוא התהליך בו שחלה משחררת ביצית בשלה אל החצוצרה. זה קורה בדרך כלל באמצע המחזור החודשי, כ-14 ימים לפני הווסת הבאה.', 'babyhub'); ?></p>
            
            <h4><?php _e('מתי אני הכי פורייה?', 'babyhub'); ?></h4>
            <p><?php _e('תקופת הפוריות כוללת 6 ימים: 5 ימים לפני הביוץ ויום הביוץ עצמו. זה בגלל שזרע יכול לשרוד ברחם עד 5 ימים, והביצית חיה כ-24 שעות.', 'babyhub'); ?></p>
        </div>

        <div id="tips" class="tab-content">
            <h4><?php _e('טיפים להגברת הסיכויים להריון', 'babyhub'); ?></h4>
            <ul>
                <li><?php _e('נסו לקיים יחסים כל יומיים במהלך תקופת הפוריות', 'babyhub'); ?></li>
                <li><?php _e('שמרו על תזונה בריאה ועשירה בחומצה פולית', 'babyhub'); ?></li>
                <li><?php _e('הימנעו מעישון ומשתיית אלכוהול', 'babyhub'); ?></li>
                <li><?php _e('נהלו מעקב יומי אחר המחזור שלכן', 'babyhub'); ?></li>
                <li><?php _e('התייעצו עם רופא אם אין הריון אחרי שנה של ניסיונות', 'babyhub'); ?></li>
            </ul>
        </div>

        <div id="faq" class="tab-content">
            <h4><?php _e('האם החישוב מדויק ב-100%?', 'babyhub'); ?></h4>
            <p><?php _e('החישוב מבוסס על הממוצע, אך כל אישה שונה. המחזור יכול להשתנות מחודש לחודש, ולכן מומלץ להשתמש בשיטות מעקב נוספות.', 'babyhub'); ?></p>
            
            <h4><?php _e('מה אם המחזור שלי לא סדיר?', 'babyhub'); ?></h4>
            <p><?php _e('אם המחזור שלך לא סדיר, חישוב זה עשוי להיות פחות מדויק. מומלץ להתייעץ עם רופא נשים לקבלת הנחיות מותאמות אישית.', 'babyhub'); ?></p>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Custom cycle length toggle
    $('#cycle-length').on('change', function() {
        const $customGroup = $('.custom-cycle-group');
        if ($(this).val() === 'custom') {
            $customGroup.show();
            $('#custom-cycle').prop('required', true);
        } else {
            $customGroup.hide();
            $('#custom-cycle').prop('required', false);
        }
    });

    // Advanced options toggle
    $('.toggle-advanced').on('click', function() {
        const target = $(this).data('target');
        const $content = $('#' + target);
        const $icon = $(this).find('.icon-chevron-down');
        
        $content.slideToggle();
        $icon.toggleClass('rotated');
    });

    // Info tabs
    $('.info-tab').on('click', function() {
        const tab = $(this).data('tab');
        
        $('.info-tab').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-content').removeClass('active');
        $('#' + tab).addClass('active');
    });

    // Form submission
    $('#ovulation-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Get cycle length (custom or selected)
        let cycleLength = $('#cycle-length').val();
        if (cycleLength === 'custom') {
            cycleLength = $('#custom-cycle').val();
        }
        
        if (!cycleLength) {
            alert('<?php _e("אנא הזיני את אורך המחזור", "babyhub"); ?>');
            return;
        }
        
        formData.set('cycle_length', cycleLength);
        formData.append('action', 'calculate_ovulation');
        formData.append('nonce', babyhub_ajax.nonce);

        // Show loading
        $(this).addClass('loading');
        $('.btn[type="submit"]').prop('disabled', true);

        $.ajax({
            url: babyhub_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $(this).removeClass('loading');
                $('.btn[type="submit"]').prop('disabled', false);
                
                if (response.success) {
                    displayOvulationResults(response.data);
                } else {
                    showError(response.data || babyhub_ajax.strings.error);
                }
            }.bind(this),
            error: function() {
                $(this).removeClass('loading');
                $('.btn[type="submit"]').prop('disabled', false);
                showError(babyhub_ajax.strings.error);
            }.bind(this)
        });
    });

    function displayOvulationResults(data) {
        const resultHTML = `
            <div class="calculation-result success">
                <div class="result-header">
                    <h3><?php _e("תוצאות חישוב הביוץ", "babyhub"); ?></h3>
                    <div class="result-icon">🥚</div>
                </div>
                
                <div class="ovulation-calendar">
                    <div class="calendar-header">
                        <h4><?php _e("התאריכים החשובים שלך", "babyhub"); ?></h4>
                    </div>
                    
                    <div class="dates-grid">
                        <div class="date-card ovulation">
                            <div class="date-icon">🎯</div>
                            <div class="date-info">
                                <h5><?php _e("תאריך ביוץ משוער", "babyhub"); ?></h5>
                                <div class="date-value">${formatHebrewDate(data.ovulation_date)}</div>
                            </div>
                        </div>
                        
                        <div class="date-card fertile-start">
                            <div class="date-icon">🌱</div>
                            <div class="date-info">
                                <h5><?php _e("תחילת תקופת פוריות", "babyhub"); ?></h5>
                                <div class="date-value">${formatHebrewDate(data.fertile_start)}</div>
                            </div>
                        </div>
                        
                        <div class="date-card fertile-end">
                            <div class="date-icon">🌸</div>
                            <div class="date-info">
                                <h5><?php _e("סוף תקופת פוריות", "babyhub"); ?></h5>
                                <div class="date-value">${formatHebrewDate(data.fertile_end)}</div>
                            </div>
                        </div>
                        
                        <div class="date-card next-period">
                            <div class="date-icon">📅</div>
                            <div class="date-info">
                                <h5><?php _e("הווסת הבאה (משוערת)", "babyhub"); ?></h5>
                                <div class="date-value">${formatHebrewDate(data.next_period || data.ovulation_date)}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="fertility-tips">
                    <h4><?php _e("המלצות לתקופה זו", "babyhub"); ?></h4>
                    <div class="tips-list">
                        <div class="tip-item">
                            <i class="icon-heart"></i>
                            <span><?php _e("זה הזמן האידיאלי לקיים יחסים לצורך הריון", "babyhub"); ?></span>
                        </div>
                        <div class="tip-item">
                            <i class="icon-calendar"></i>
                            <span><?php _e("סמני את התאריכים בלוח השנה שלך", "babyhub"); ?></span>
                        </div>
                        <div class="tip-item">
                            <i class="icon-water"></i>
                            <span><?php _e("שתי הרבה מים ושמרי על תזונה בריאה", "babyhub"); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="result-actions">
                    <button type="button" class="btn btn-primary" onclick="saveToCalendar()">
                        <i class="icon-calendar-plus"></i>
                        <?php _e("שמור ביומן", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="shareResults()">
                        <i class="icon-share"></i>
                        <?php _e("שתף תוצאות", "babyhub"); ?>
                    </button>
                </div>
            </div>
        `;
        
        $('#ovulation-results').html(resultHTML).slideDown();
    }

    function showError(message) {
        const errorHTML = `
            <div class="calculation-result error">
                <div class="result-header">
                    <h3><?php _e("שגיאה בחישוב", "babyhub"); ?></h3>
                    <div class="result-icon">⚠️</div>
                </div>
                <p>${message}</p>
            </div>
        `;
        
        $('#ovulation-results').html(errorHTML).slideDown();
    }

    function formatHebrewDate(dateString) {
        const date = new Date(dateString);
        const hebrewMonths = [
            'ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני',
            'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'
        ];
        
        const day = date.getDate();
        const month = hebrewMonths[date.getMonth()];
        const year = date.getFullYear();
        
        return `${day} ב${month} ${year}`;
    }

    // Global functions for result actions
    window.saveToCalendar = function() {
        alert('<?php _e("תכונה זו תהיה זמינה בקרוב", "babyhub"); ?>');
    };

    window.shareResults = function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("תוצאות חישוב הביוץ שלי", "babyhub"); ?>',
                text: '<?php _e("חישבתי את ימי הפוריות שלי באתר Baby-Hub", "babyhub"); ?>',
                url: window.location.href
            });
        } else {
            // Fallback - copy to clipboard
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('<?php _e("הקישור הועתק ללוח", "babyhub"); ?>');
            });
        }
    };
});
</script>

<style>
/* Ovulation Calculator Specific Styles */
.ovulation-calculator-form {
    max-width: 800px;
    margin: 0 auto;
}

.advanced-options {
    margin: 2rem 0;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.toggle-advanced {
    width: 100%;
    padding: 1rem;
    background: #f8f9fa;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 500;
    color: #2c3e50;
    transition: background-color 0.3s ease;
}

.toggle-advanced:hover {
    background: #e9ecef;
}

.toggle-advanced .icon-chevron-down {
    transition: transform 0.3s ease;
}

.toggle-advanced .icon-chevron-down.rotated {
    transform: rotate(180deg);
}

.advanced-content {
    padding: 1rem;
    background: white;
}

.custom-cycle-group {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
    }
    to {
        opacity: 1;
        max-height: 100px;
    }
}

/* Results Styles */
.ovulation-calendar {
    background: linear-gradient(135deg, #FF6B9D, #4ECDC4);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin: 2rem 0;
}

.calendar-header h4 {
    text-align: center;
    margin-bottom: 2rem;
    color: white;
}

.dates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.date-card {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 1.5rem;
    text-align: center;
    backdrop-filter: blur(10px);
}

.date-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.date-info h5 {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    color: rgba(255, 255, 255, 0.9);
}

.date-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
}

.fertility-tips {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.fertility-tips h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.tips-list {
    display: grid;
    gap: 0.75rem;
}

.tip-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.tip-item i {
    margin-left: 1rem;
    color: #FF6B9D;
    font-size: 1.2rem;
}

/* Info Section */
.tool-info-section {
    margin-top: 3rem;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    overflow: hidden;
}

.info-tabs {
    display: flex;
    background: #f8f9fa;
}

.info-tab {
    flex: 1;
    padding: 1rem;
    border: none;
    background: transparent;
    cursor: pointer;
    font-weight: 500;
    color: #666;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}

.info-tab.active {
    color: #FF6B9D;
    border-bottom-color: #FF6B9D;
    background: white;
}

.info-tab:hover {
    background: rgba(255, 107, 157, 0.1);
}

.info-content {
    padding: 2rem;
    background: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.tab-content h4 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.tab-content ul {
    list-style: none;
    padding: 0;
}

.tab-content li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-right: 1.5rem;
}

.tab-content li:before {
    content: "✓";
    position: absolute;
    right: 0;
    color: #28a745;
    font-weight: bold;
}

.tab-content li:last-child {
    border-bottom: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dates-grid {
        grid-template-columns: 1fr;
    }
    
    .info-tabs {
        flex-direction: column;
    }
    
    .info-tab {
        text-align: center;
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
    }
    
    .tip-item i {
        margin: 0 0 0.5rem 0;
    }
}

@media (max-width: 480px) {
    .ovulation-calendar {
        padding: 1rem;
    }
    
    .date-card {
        padding: 1rem;
    }
    
    .fertility-tips {
        padding: 1rem;
    }
    
    .info-content {
        padding: 1rem;
    }
}
</style>