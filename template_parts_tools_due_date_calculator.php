<?php
/**
 * Due Date Calculator Tool Template Part
 * Baby-Hub Hebrew RTL Theme
 */
?>

<div class="tool-form due-date-calculator-form">
    <form id="due-date-form" class="calculator-form" novalidate>
        <div class="form-header">
            <h3><?php _e('חישוב תאריך לידה משוער', 'babyhub'); ?></h3>
            <p class="form-description">
                <?php _e('הזיני את הפרטים הבאים כדי לחשב את תאריך הלידה המשוער ולדעת באיזה שבוע הריון את נמצאת', 'babyhub'); ?>
            </p>
        </div>

        <div class="form-body">
            <!-- Calculation Method Tabs -->
            <div class="calculation-methods">
                <button type="button" class="method-tab active" data-method="lmp">
                    <i class="icon-calendar"></i>
                    <?php _e('לפי תאריך הווסת האחרונה', 'babyhub'); ?>
                </button>
                <button type="button" class="method-tab" data-method="conception">
                    <i class="icon-heart"></i>
                    <?php _e('לפי תאריך ההריון', 'babyhub'); ?>
                </button>
                <button type="button" class="method-tab" data-method="ultrasound">
                    <i class="icon-medical"></i>
                    <?php _e('לפי אולטרסאונד', 'babyhub'); ?>
                </button>
            </div>

            <!-- LMP Method -->
            <div id="lmp-method" class="calculation-method active">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="lmp-date" class="form-label required">
                            <?php _e('תאריך הווסת האחרונה', 'babyhub'); ?>
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="lmp-date" 
                            name="lmp_date" 
                            class="form-control" 
                            required
                            max="<?php echo date('Y-m-d'); ?>"
                            aria-describedby="lmp-help"
                        />
                        <small id="lmp-help" class="form-help">
                            <?php _e('היום הראשון של הווסת האחרונה שלך', 'babyhub'); ?>
                        </small>
                    </div>

                    <div class="form-group col-6">
                        <label for="cycle-length-due" class="form-label">
                            <?php _e('אורך המחזור החודשי', 'babyhub'); ?>
                        </label>
                        <select id="cycle-length-due" name="cycle_length" class="form-control">
                            <option value="28"><?php _e('28 ימים (ברירת מחדל)', 'babyhub'); ?></option>
                            <?php for ($i = 21; $i <= 35; $i++) : ?>
                                <?php if ($i != 28) : ?>
                                    <option value="<?php echo $i; ?>">
                                        <?php printf(__('%d ימים', 'babyhub'), $i); ?>
                                    </option>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </select>
                        <small class="form-help">
                            <?php _e('אם המחזור שלך לא 28 ימים, בחרי את האורך הנכון', 'babyhub'); ?>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Conception Method -->
            <div id="conception-method" class="calculation-method">
                <div class="form-group">
                    <label for="conception-date" class="form-label required">
                        <?php _e('תאריך ההריון המשוער', 'babyhub'); ?>
                        <span class="required-indicator">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="conception-date" 
                        name="conception_date" 
                        class="form-control" 
                        max="<?php echo date('Y-m-d'); ?>"
                        aria-describedby="conception-help"
                    />
                    <small id="conception-help" class="form-help">
                        <?php _e('התאריך המשוער של ההריון (בדרך כלל יום הביוץ)', 'babyhub'); ?>
                    </small>
                </div>
            </div>

            <!-- Ultrasound Method -->
            <div id="ultrasound-method" class="calculation-method">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="ultrasound-date" class="form-label required">
                            <?php _e('תאריך האולטרסאונד', 'babyhub'); ?>
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="ultrasound-date" 
                            name="ultrasound_date" 
                            class="form-control" 
                            max="<?php echo date('Y-m-d'); ?>"
                        />
                    </div>

                    <div class="form-group col-6">
                        <label for="gestational-age" class="form-label required">
                            <?php _e('גיל ההריון באולטרסאונד', 'babyhub'); ?>
                            <span class="required-indicator">*</span>
                        </label>
                        <div class="gestational-age-inputs">
                            <input 
                                type="number" 
                                id="gestational-weeks" 
                                name="gestational_weeks" 
                                class="form-control" 
                                min="4" 
                                max="42"
                                placeholder="שבועות"
                            />
                            <span class="separator">+</span>
                            <input 
                                type="number" 
                                id="gestational-days" 
                                name="gestational_days" 
                                class="form-control" 
                                min="0" 
                                max="6"
                                placeholder="ימים"
                            />
                        </div>
                        <small class="form-help">
                            <?php _e('הגיל כפי שנמדד באולטרסאונד (למשל: 12 שבועות ו-3 ימים)', 'babyhub'); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">
                <i class="icon-calculator"></i>
                <?php _e('חשב תאריך לידה', 'babyhub'); ?>
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="icon-refresh"></i>
                <?php _e('איפוס', 'babyhub'); ?>
            </button>
        </div>
    </form>

    <!-- Results Container -->
    <div id="due-date-results" class="results-container" style="display: none;">
        <!-- Results will be populated here -->
    </div>
</div>

<!-- Information Section -->
<div class="tool-info-section">
    <div class="info-tabs">
        <button class="info-tab active" data-tab="about">
            <?php _e('איך זה עובד?', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="accuracy">
            <?php _e('דיוק החישוב', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="timeline">
            <?php _e('ציר זמן ההריון', 'babyhub'); ?>
        </button>
    </div>

    <div class="info-content">
        <div id="about" class="tab-content active">
            <h4><?php _e('איך מחשבים תאריך לידה?', 'babyhub'); ?></h4>
            <p><?php _e('תאריך הלידה המשוער מחושב בהוספת 280 ימים (40 שבועות) לתאריך הווסת האחרונה. זוהי השיטה הסטנדרטית בכל העולם.', 'babyhub'); ?></p>
            
            <h4><?php _e('למה 40 שבועות?', 'babyhub'); ?></h4>
            <p><?php _e('הריון תקין נמשך בממוצע 40 שבועות מתחילת הווסת האחרונה, או 38 שבועות מההריון בפועל. זהו הסטנדרט הרפואי המקובל.', 'babyhub'); ?></p>
        </div>

        <div id="accuracy" class="tab-content">
            <h4><?php _e('עד כמה מדויק התאריך?', 'babyhub'); ?></h4>
            <p><?php _e('רק כ-5% מהתינוקות נולדים בתאריך המדויק. רוב התינוקות נולדים בין השבוע ה-37 לשבוע ה-42.', 'babyhub'); ?></p>
            
            <h4><?php _e('מה משפיע על הדיוק?', 'babyhub'); ?></h4>
            <ul>
                <li><?php _e('סדירות המחזור החודשי', 'babyhub'); ?></li>
                <li><?php _e('זכירה מדויקת של תאריך הווסת', 'babyhub'); ?></li>
                <li><?php _e('גורמים תורשתיים ואישיים', 'babyhub'); ?></li>
                <li><?php _e('האם זה הריון ראשון או לא', 'babyhub'); ?></li>
            </ul>
        </div>

        <div id="timeline" class="tab-content">
            <h4><?php _e('שלבי ההריון', 'babyhub'); ?></h4>
            <div class="timeline-info">
                <div class="timeline-item">
                    <strong><?php _e('טרימסטר ראשון:', 'babyhub'); ?></strong>
                    <?php _e('שבועות 1-12 - התפתחות איברים בסיסיים', 'babyhub'); ?>
                </div>
                <div class="timeline-item">
                    <strong><?php _e('טרימסטר שני:', 'babyhub'); ?></strong>
                    <?php _e('שבועות 13-26 - גדילה מהירה ותנועות ראשונות', 'babyhub'); ?>
                </div>
                <div class="timeline-item">
                    <strong><?php _e('טרימסטר שלישי:', 'babyhub'); ?></strong>
                    <?php _e('שבועות 27-40 - בשלות והכנה ללידה', 'babyhub'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    let currentMethod = 'lmp';

    // Method tabs functionality
    $('.method-tab').on('click', function() {
        const method = $(this).data('method');
        currentMethod = method;
        
        // Update tab appearance
        $('.method-tab').removeClass('active');
        $(this).addClass('active');
        
        // Show relevant form section
        $('.calculation-method').removeClass('active');
        $('#' + method + '-method').addClass('active');
        
        // Clear previous results
        $('#due-date-results').hide();
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
    $('#due-date-form').on('submit', function(e) {
        e.preventDefault();
        
        let calculationData = {
            method: currentMethod,
            action: 'calculate_due_date',
            nonce: babyhub_ajax.nonce
        };

        // Collect data based on method
        switch (currentMethod) {
            case 'lmp':
                const lmpDate = $('#lmp-date').val();
                const cycleLength = $('#cycle-length-due').val();
                
                if (!lmpDate) {
                    alert('<?php _e("אנא הזיני את תאריך הווסת האחרונה", "babyhub"); ?>');
                    return;
                }
                
                calculationData.lmp_date = lmpDate;
                calculationData.cycle_length = cycleLength;
                break;
                
            case 'conception':
                const conceptionDate = $('#conception-date').val();
                
                if (!conceptionDate) {
                    alert('<?php _e("אנא הזיני את תאריך ההריון", "babyhub"); ?>');
                    return;
                }
                
                calculationData.conception_date = conceptionDate;
                break;
                
            case 'ultrasound':
                const ultrasoundDate = $('#ultrasound-date').val();
                const weeks = $('#gestational-weeks').val();
                const days = $('#gestational-days').val() || 0;
                
                if (!ultrasoundDate || !weeks) {
                    alert('<?php _e("אנא הזיני את תאריך האולטרסאונד והגיל", "babyhub"); ?>');
                    return;
                }
                
                calculationData.ultrasound_date = ultrasoundDate;
                calculationData.gestational_weeks = weeks;
                calculationData.gestational_days = days;
                break;
        }

        // Show loading
        $(this).addClass('loading');
        $('.btn[type="submit"]').prop('disabled', true);

        // Calculate due date (client-side for demo)
        setTimeout(() => {
            const results = calculateDueDate(calculationData);
            displayDueDateResults(results);
            
            $(this).removeClass('loading');
            $('.btn[type="submit"]').prop('disabled', false);
        }, 1000);
    });

    function calculateDueDate(data) {
        let dueDate, currentWeeks, currentDays, conceptionDate;
        
        switch (data.method) {
            case 'lmp':
                const lmp = new Date(data.lmp_date);
                const adjustment = (parseInt(data.cycle_length) - 28) || 0;
                dueDate = new Date(lmp.getTime() + (280 + adjustment) * 24 * 60 * 60 * 1000);
                conceptionDate = new Date(lmp.getTime() + (adjustment + 14) * 24 * 60 * 60 * 1000);
                break;
                
            case 'conception':
                conceptionDate = new Date(data.conception_date);
                dueDate = new Date(conceptionDate.getTime() + 266 * 24 * 60 * 60 * 1000);
                break;
                
            case 'ultrasound':
                const ultrasound = new Date(data.ultrasound_date);
                const totalDays = parseInt(data.gestational_weeks) * 7 + parseInt(data.gestational_days);
                const daysSinceConception = totalDays - 14;
                conceptionDate = new Date(ultrasound.getTime() - daysSinceConception * 24 * 60 * 60 * 1000);
                dueDate = new Date(conceptionDate.getTime() + 266 * 24 * 60 * 60 * 1000);
                break;
        }
        
        // Calculate current pregnancy week
        const today = new Date();
        const daysSinceConception = Math.floor((today - conceptionDate) / (24 * 60 * 60 * 1000));
        currentWeeks = Math.floor(daysSinceConception / 7) + 2; // +2 for gestational age
        currentDays = (daysSinceConception % 7);
        
        // Calculate days remaining
        const daysRemaining = Math.ceil((dueDate - today) / (24 * 60 * 60 * 1000));
        
        return {
            due_date: dueDate.toISOString().split('T')[0],
            conception_date: conceptionDate.toISOString().split('T')[0],
            current_weeks: Math.max(0, currentWeeks),
            current_days: Math.max(0, currentDays),
            days_remaining: Math.max(0, daysRemaining),
            trimester: currentWeeks <= 12 ? 1 : (currentWeeks <= 26 ? 2 : 3)
        };
    }

    function displayDueDateResults(data) {
        const resultHTML = `
            <div class="calculation-result success">
                <div class="result-header">
                    <h3><?php _e("תוצאות חישוב תאריך הלידה", "babyhub"); ?></h3>
                    <div class="result-icon">👶</div>
                </div>
                
                <div class="due-date-summary">
                    <div class="main-due-date">
                        <h4><?php _e("תאריך הלידה המשוער", "babyhub"); ?></h4>
                        <div class="due-date-value">${formatHebrewDate(data.due_date)}</div>
                        <div class="days-countdown">${data.days_remaining} <?php _e("ימים נותרו", "babyhub"); ?></div>
                    </div>
                </div>
                
                <div class="pregnancy-stats">
                    <div class="stat-card current-week">
                        <div class="stat-icon">📅</div>
                        <div class="stat-content">
                            <h5><?php _e("השבוע הנוכחי", "babyhub"); ?></h5>
                            <div class="stat-value">${data.current_weeks}+${data.current_days}</div>
                            <div class="stat-label"><?php _e("שבועות + ימים", "babyhub"); ?></div>
                        </div>
                    </div>
                    
                    <div class="stat-card trimester">
                        <div class="stat-icon">🤰</div>
                        <div class="stat-content">
                            <h5><?php _e("טרימסטר", "babyhub"); ?></h5>
                            <div class="stat-value">${data.trimester}</div>
                            <div class="stat-label"><?php _e("מתוך 3", "babyhub"); ?></div>
                        </div>
                    </div>
                    
                    <div class="stat-card conception">
                        <div class="stat-icon">💕</div>
                        <div class="stat-content">
                            <h5><?php _e("תאריך הריון משוער", "babyhub"); ?></h5>
                            <div class="stat-value">${formatHebrewDate(data.conception_date)}</div>
                        </div>
                    </div>
                </div>
                
                <div class="pregnancy-timeline">
                    <h4><?php _e("התקדמות ההריון", "babyhub"); ?></h4>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${(data.current_weeks / 40) * 100}%"></div>
                    </div>
                    <div class="progress-text">
                        ${data.current_weeks} <?php _e("מתוך 40 שבועות", "babyhub"); ?> (${Math.round((data.current_weeks / 40) * 100)}%)
                    </div>
                </div>
                
                <div class="important-dates">
                    <h4><?php _e("תאריכים חשובים", "babyhub"); ?></h4>
                    <div class="dates-list">
                        <div class="date-item">
                            <span class="date-label"><?php _e("ליחה בטוחה מ:", "babyhub"); ?></span>
                            <span class="date-value">${formatHebrewDate(addDaysToDate(data.due_date, -21))}</span>
                        </div>
                        <div class="date-item">
                            <span class="date-label"><?php _e("לידה מוקדמת מ:", "babyhub"); ?></span>
                            <span class="date-value">${formatHebrewDate(addDaysToDate(data.due_date, -14))}</span>
                        </div>
                        <div class="date-item">
                            <span class="date-label"><?php _e("לידה מאוחרת עד:", "babyhub"); ?></span>
                            <span class="date-value">${formatHebrewDate(addDaysToDate(data.due_date, 14))}</span>
                        </div>
                    </div>
                </div>
                
                <div class="result-actions">
                    <button type="button" class="btn btn-primary" onclick="saveToCalendar()">
                        <i class="icon-calendar-plus"></i>
                        <?php _e("שמור ביומן", "babyhub"); ?>
                    </button>
                    <a href="<?php echo home_url('/pregnancy-tracker/'); ?>" class="btn btn-secondary">
                        <i class="icon-baby"></i>
                        <?php _e("מעקב שבועי", "babyhub"); ?>
                    </a>
                    <button type="button" class="btn btn-outline" onclick="shareResults()">
                        <i class="icon-share"></i>
                        <?php _e("שתף", "babyhub"); ?>
                    </button>
                </div>
            </div>
        `;
        
        $('#due-date-results').html(resultHTML).slideDown();
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

    function addDaysToDate(dateString, days) {
        const date = new Date(dateString);
        date.setDate(date.getDate() + days);
        return date.toISOString().split('T')[0];
    }

    // Global functions
    window.saveToCalendar = function() {
        alert('<?php _e("תכונה זו תהיה זמינה בקרוב", "babyhub"); ?>');
    };

    window.shareResults = function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("תאריך הלידה המשוער שלי", "babyhub"); ?>',
                text: '<?php _e("חישבתי את תאריך הלידה שלי באתר Baby-Hub", "babyhub"); ?>',
                url: window.location.href
            });
        } else {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('<?php _e("הקישור הועתק ללוח", "babyhub"); ?>');
            });
        }
    };
});
</script>

<style>
/* Due Date Calculator Specific Styles */
.due-date-calculator-form {
    max-width: 800px;
    margin: 0 auto;
}

/* Method Tabs */
.calculation-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.method-tab {
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    font-weight: 500;
    color: #666;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.method-tab:hover {
    border-color: #FF6B9D;
    background: rgba(255, 107, 157, 0.05);
}

.method-tab.active {
    border-color: #FF6B9D;
    background: #FF6B9D;
    color: white;
}

.method-tab i {
    font-size: 1.5rem;
}

.calculation-method {
    display: none;
}

.calculation-method.active {
    display: block;
}

/* Gestational Age Inputs */
.gestational-age-inputs {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.gestational-age-inputs input {
    flex: 1;
}

.separator {
    font-weight: bold;
    color: #666;
    padding: 0 0.5rem;
}

/* Results Styles */
.due-date-summary {
    background: linear-gradient(135deg, #FF6B9D, #4ECDC4);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin: 2rem 0;
    text-align: center;
}

.main-due-date h4 {
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
}

.due-date-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: white;
}

.days-countdown {
    font-size: 1.2rem;
    opacity: 0.9;
}

.pregnancy-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}

.stat-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.stat-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.stat-content h5 {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #999;
}

/* Timeline */
.pregnancy-timeline {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.pregnancy-timeline h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
    text-align: center;
}

.progress-bar {
    height: 20px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(135deg, #FF6B9D, #4ECDC4);
    transition: width 0.8s ease;
    border-radius: 10px;
}

.progress-text {
    text-align: center;
    font-weight: 500;
    color: #2c3e50;
}

/* Important Dates */
.important-dates {
    margin: 2rem 0;
}

.important-dates h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.dates-list {
    display: grid;
    gap: 0.75rem;
}

.date-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-right: 4px solid #FF6B9D;
}

.date-label {
    font-weight: 500;
    color: #2c3e50;
}

.date-value {
    font-weight: 600;
    color: #FF6B9D;
}

/* Timeline Info */
.timeline-info {
    margin-top: 1rem;
}

.timeline-item {
    padding: 1rem;
    margin-bottom: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-right: 4px solid #4ECDC4;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .calculation-methods {
        grid-template-columns: 1fr;
    }
    
    .method-tab {
        flex-direction: row;
        text-align: right;
    }
    
    .pregnancy-stats {
        grid-template-columns: 1fr;
    }
    
    .due-date-value {
        font-size: 1.5rem;
    }
    
    .date-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .due-date-summary {
        padding: 1.5rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .gestational-age-inputs {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .separator {
        display: none;
    }
}
</style>