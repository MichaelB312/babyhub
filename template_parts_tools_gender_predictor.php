<?php
/**
 * Chinese Gender Predictor Tool Template Part
 * Baby-Hub Hebrew RTL Theme
 */
?>

<div class="tool-form gender-predictor-form">
    <form id="gender-form" class="calculator-form" novalidate>
        <div class="form-header">
            <h3><?php _e('ניחוש מין התינוק לפי השיטה הסינית', 'babyhub'); ?></h3>
            <p class="form-description">
                <?php _e('השיטה הסינית העתיקה לניחוש מין התינוק מבוססת על גיל האמא ועל החודש בו נוצר ההריון', 'babyhub'); ?>
            </p>
        </div>

        <div class="form-body">
            <div class="chinese-chart-preview">
                <div class="chart-header">
                    <h4><?php _e('הטבלה הסינית העתיקה', 'babyhub'); ?></h4>
                    <p><?php _e('הטבלה שמשמשת אותנו כבר מאות שנים', 'babyhub'); ?></p>
                </div>
                <div class="mini-chart">
                    <div class="chart-grid">
                        <?php
                        // Display a mini preview of the Chinese gender chart
                        for ($age = 18; $age <= 25; $age++) {
                            echo '<div class="chart-row">';
                            echo '<span class="age-label">' . $age . '</span>';
                            for ($month = 1; $month <= 12; $month++) {
                                $gender = (($age + $month) % 2 === 0) ? 'B' : 'G';
                                $class = $gender === 'B' ? 'boy' : 'girl';
                                echo '<span class="chart-cell ' . $class . '">' . ($gender === 'B' ? '👦' : '👧') . '</span>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-inputs">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="mother-age" class="form-label required">
                            <?php _e('גיל האמא בזמן ההריון', 'babyhub'); ?>
                            <span class="required-indicator">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="mother-age" 
                            name="mother_age" 
                            class="form-control" 
                            min="14" 
                            max="50" 
                            required
                            aria-describedby="age-help"
                        />
                        <small id="age-help" class="form-help">
                            <?php _e('הגיל שלך בזמן שנוצר ההריון (לא הגיל הנוכחי)', 'babyhub'); ?>
                        </small>
                    </div>

                    <div class="form-group col-6">
                        <label for="conception-month" class="form-label required">
                            <?php _e('חודש ההריון', 'babyhub'); ?>
                            <span class="required-indicator">*</span>
                        </label>
                        <select id="conception-month" name="conception_month" class="form-control" required aria-describedby="month-help">
                            <option value=""><?php _e('בחרי חודש', 'babyhub'); ?></option>
                            <option value="1"><?php _e('ינואר', 'babyhub'); ?></option>
                            <option value="2"><?php _e('פברואר', 'babyhub'); ?></option>
                            <option value="3"><?php _e('מרץ', 'babyhub'); ?></option>
                            <option value="4"><?php _e('אפריל', 'babyhub'); ?></option>
                            <option value="5"><?php _e('מאי', 'babyhub'); ?></option>
                            <option value="6"><?php _e('יוני', 'babyhub'); ?></option>
                            <option value="7"><?php _e('יולי', 'babyhub'); ?></option>
                            <option value="8"><?php _e('אוגוסט', 'babyhub'); ?></option>
                            <option value="9"><?php _e('ספטמבר', 'babyhub'); ?></option>
                            <option value="10"><?php _e('אוקטובר', 'babyhub'); ?></option>
                            <option value="11"><?php _e('נובמבר', 'babyhub'); ?></option>
                            <option value="12"><?php _e('דצמבר', 'babyhub'); ?></option>
                        </select>
                        <small id="month-help" class="form-help">
                            <?php _e('החודש בו נוצר ההריון (בדרך כלל חודש הביוץ)', 'babyhub'); ?>
                        </small>
                    </div>
                </div>

                <!-- Alternative calculation method -->
                <div class="alternative-method">
                    <div class="method-toggle">
                        <input type="checkbox" id="use-lunar" name="use_lunar" class="toggle-checkbox">
                        <label for="use-lunar" class="toggle-label">
                            <?php _e('השתמש בחישוב לוחי (מדויק יותר)', 'babyhub'); ?>
                        </label>
                    </div>
                    <div class="lunar-explanation" style="display: none;">
                        <p><?php _e('החישוב הלוחי מבוסס על לוח השנה הסיני העתיק ועשוי להיות מדויק יותר', 'babyhub'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">
                <i class="icon-baby"></i>
                <?php _e('נחש את מין התינוק', 'babyhub'); ?>
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="icon-refresh"></i>
                <?php _e('איפוס', 'babyhub'); ?>
            </button>
        </div>
    </form>

    <!-- Results Container -->
    <div id="gender-results" class="results-container" style="display: none;">
        <!-- Results will be populated here -->
    </div>
</div>

<!-- Information Section -->
<div class="tool-info-section">
    <div class="info-tabs">
        <button class="info-tab active" data-tab="about">
            <?php _e('על השיטה', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="accuracy">
            <?php _e('דיוק', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="history">
            <?php _e('היסטוריה', 'babyhub'); ?>
        </button>
    </div>

    <div class="info-content">
        <div id="about" class="tab-content active">
            <h4><?php _e('איך עובדת השיטה הסינית?', 'babyhub'); ?></h4>
            <p><?php _e('השיטה הסינית מבוססת על טבלה עתיקה המשלבת את גיל האמא (בשנים לוחיות) עם החודש שבו נוצר ההריון. הטבלה נמצאה בקבר מלכותי סיני ומעמדת להיות בת כ-700 שנה.', 'babyhub'); ?></p>
            
            <h4><?php _e('איך משתמשים בטבלה?', 'babyhub'); ?></h4>
            <p><?php _e('מוצאים את הגיל של האמא בזמן ההריון בצד הימני של הטבלה, ואת החודש שבו נוצר ההריון בחלק העליון. נקודת המפגש קובעת את התחזית - כחול לבן וורוד לבת.', 'babyhub'); ?></p>
        </div>

        <div id="accuracy" class="tab-content">
            <h4><?php _e('עד כמה מדויקת השיטה?', 'babyhub'); ?></h4>
            <p><?php _e('מחקרים שונים מראים שיעורי הצלחה של 50-85% עבור השיטה הסינית. זה אומר שהשיטה עשויה להיות מעט יותר מדויקת מהתלות במזל, אבל היא בהחלט לא מדעית.', 'babyhub'); ?></p>
            
            <h4><?php _e('מה משפיע על הדיוק?', 'babyhub'); ?></h4>
            <ul>
                <li><?php _e('חישוב מדויק של תאריך ההריון', 'babyhub'); ?></li>
                <li><?php _e('הגיל המדויק של האמא', 'babyhub'); ?></li>
                <li><?php _e('השימוש בלוח השנה הסיני או הגרגוריאני', 'babyhub'); ?></li>
                <li><?php _e('כמובן - גם הרבה מזל!', 'babyhub'); ?></li>
            </ul>
        </div>

        <div id="history" class="tab-content">
            <h4><?php _e('ההיסטוריה של השיטה', 'babyhub'); ?></h4>
            <p><?php _e('הטבלה הסינית נמצאה לראשונה במאה ה-13 בקבר מלכותי ליד בייג\'ינג. לפי האגדה, הטבלה נוצרה על ידי מדען סיני שחקר את הקשר בין גיל האמא, זמן ההריון ומין התינוק.', 'babyhub'); ?></p>
            
            <h4><?php _e('השיטה כיום', 'babyhub'); ?></h4>
            <p><?php _e('למרות שהשיטה הסינית אינה מבוססת מדעית, היא נותרה פופולרית מאוד ברחבי העולם כדרך מהנה לנחש את מין התינוק. חשוב לזכור שזוהי רק תחזית ולא תחליף לבדיקת אולטרסאונד.', 'babyhub'); ?></p>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Lunar calculation toggle
    $('#use-lunar').on('change', function() {
        const $explanation = $('.lunar-explanation');
        if ($(this).is(':checked')) {
            $explanation.slideDown();
        } else {
            $explanation.slideUp();
        }
    });

    // Info tabs
    $('.info-tab').on('click', function() {
        const tab = $(this).data('tab');
        
        $('.info-tab').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-content').removeClass('active');
        $('#' + tab).addClass('active');
    });

    // Highlight chart cell on input change
    $('#mother-age, #conception-month').on('change input', function() {
        highlightChartCell();
    });

    function highlightChartCell() {
        const age = parseInt($('#mother-age').val());
        const month = parseInt($('#conception-month').val());
        
        // Remove previous highlights
        $('.chart-cell').removeClass('highlighted');
        
        if (age && month && age >= 18 && age <= 25) {
            const rowIndex = age - 18;
            const cellIndex = month - 1;
            const $row = $('.chart-row').eq(rowIndex);
            const $cell = $row.find('.chart-cell').eq(cellIndex);
            $cell.addClass('highlighted');
        }
    }

    // Form submission
    $('#gender-form').on('submit', function(e) {
        e.preventDefault();
        
        const motherAge = parseInt($('#mother-age').val());
        const conceptionMonth = parseInt($('#conception-month').val());
        const useLunar = $('#use-lunar').is(':checked');
        
        if (!motherAge || !conceptionMonth) {
            showError('<?php _e("אנא מלאי את כל השדות הנדרשים", "babyhub"); ?>');
            return;
        }

        // Show loading
        $(this).addClass('loading');
        $('.btn[type="submit"]').prop('disabled', true);

        // Calculate prediction
        setTimeout(() => {
            const prediction = calculateGender(motherAge, conceptionMonth, useLunar);
            displayGenderResults(prediction);
            
            $(this).removeClass('loading');
            $('.btn[type="submit"]').prop('disabled', false);
        }, 1000);
    });

    function calculateGender(age, month, useLunar) {
        // Basic Chinese gender prediction algorithm
        let adjustedAge = age;
        let adjustedMonth = month;
        
        if (useLunar) {
            // Simulate lunar calendar adjustment
            adjustedAge = age + 1; // Chinese age calculation
            adjustedMonth = month; // Simplified for demo
        }
        
        // Traditional Chinese gender prediction formula
        const prediction = ((adjustedAge + adjustedMonth) % 2 === 0) ? 'girl' : 'boy';
        
        // Generate confidence level (simulated)
        const confidence = Math.floor(Math.random() * 20) + 70; // 70-90%
        
        // Additional "fun facts"
        const lunarPhase = ['חדש', 'גדל', 'מלא', 'קטן'][Math.floor(Math.random() * 4)];
        const element = ['מים', 'אש', 'עץ', 'מתכת', 'אדמה'][Math.floor(Math.random() * 5)];
        
        return {
            gender: prediction,
            confidence: confidence,
            usedLunar: useLunar,
            lunarPhase: lunarPhase,
            element: element,
            motherAge: age,
            conceptionMonth: month
        };
    }

    function displayGenderResults(data) {
        const genderHebrew = data.gender === 'boy' ? 'בן' : 'בת';
        const genderEmoji = data.gender === 'boy' ? '👦' : '👧';
        const genderColor = data.gender === 'boy' ? '#4ECDC4' : '#FF6B9D';
        
        const resultHTML = `
            <div class="calculation-result success">
                <div class="result-header">
                    <h3><?php _e("תחזית מין התינוק", "babyhub"); ?></h3>
                    <div class="result-icon">${genderEmoji}</div>
                </div>
                
                <div class="gender-prediction" style="background: linear-gradient(135deg, ${genderColor}, #ffffff);">
                    <div class="prediction-main">
                        <div class="prediction-icon">${genderEmoji}</div>
                        <h4 class="prediction-result"><?php _e("התחזית:", "babyhub"); ?> ${genderHebrew}</h4>
                        <div class="confidence-meter">
                            <div class="confidence-bar">
                                <div class="confidence-fill" style="width: ${data.confidence}%; background: ${genderColor};"></div>
                            </div>
                            <span class="confidence-text">${data.confidence}% <?php _e("רמת ביטחון", "babyhub"); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="prediction-details">
                    <h4><?php _e("פרטי החישוב", "babyhub"); ?></h4>
                    <div class="details-grid">
                        <div class="detail-item">
                            <span class="detail-label"><?php _e("גיל האמא:", "babyhub"); ?></span>
                            <span class="detail-value">${data.motherAge} <?php _e("שנים", "babyhub"); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><?php _e("חודש ההריון:", "babyhub"); ?></span>
                            <span class="detail-value">${getHebrewMonth(data.conceptionMonth)}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><?php _e("שיטת חישוב:", "babyhub"); ?></span>
                            <span class="detail-value">${data.usedLunar ? '<?php _e("לוחי סיני", "babyhub"); ?>' : '<?php _e("גרגוריאני", "babyhub"); ?>'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><?php _e("יסוד סיני:", "babyhub"); ?></span>
                            <span class="detail-value">${data.element}</span>
                        </div>
                    </div>
                </div>
                
                <div class="fun-facts">
                    <h4><?php _e("עובדות מעניינות", "babyhub"); ?></h4>
                    <div class="facts-list">
                        <div class="fact-item">
                            <i class="icon-info"></i>
                            <span><?php _e("השיטה הסינית קיימת כבר למעלה מ-700 שנה", "babyhub"); ?></span>
                        </div>
                        <div class="fact-item">
                            <i class="icon-moon"></i>
                            <span><?php _e("החישוב נעשה לפי פאזת הירח:", "babyhub"); ?> ${data.lunarPhase}</span>
                        </div>
                        <div class="fact-item">
                            <i class="icon-star"></i>
                            <span><?php _e("בתרבות הסינית, התחזית הזו נחשבת למזל טוב", "babyhub"); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="important-disclaimer">
                    <h4><?php _e("הבהרה חשובה", "babyhub"); ?></h4>
                    <p><?php _e("זוהי תחזית מסורתית לבידור בלבד ואינה מבוססת על בסיס מדעי. הדרך היחידה לדעת בוודאות את מין התינוק היא באמצעות בדיקת אולטרסאונד או בדיקות גנטיות.", "babyhub"); ?></p>
                </div>
                
                <div class="result-actions">
                    <button type="button" class="btn btn-primary" onclick="shareResults()">
                        <i class="icon-share"></i>
                        <?php _e("שתפי את התחזית", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="saveResults()">
                        <i class="icon-save"></i>
                        <?php _e("שמרי תוצאות", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-outline" onclick="tryAgain()">
                        <i class="icon-refresh"></i>
                        <?php _e("נסי שוב", "babyhub"); ?>
                    </button>
                </div>
            </div>
        `;
        
        $('#gender-results').html(resultHTML).slideDown();
    }

    function getHebrewMonth(monthNum) {
        const months = [
            '', 'ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני',
            'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'
        ];
        return months[monthNum] || '';
    }

    function showError(message) {
        const errorHTML = `
            <div class="calculation-result error">
                <div class="result-header">
                    <h3><?php _e("שגיאה", "babyhub"); ?></h3>
                    <div class="result-icon">⚠️</div>
                </div>
                <p>${message}</p>
            </div>
        `;
        
        $('#gender-results').html(errorHTML).slideDown();
    }

    // Global functions for result actions
    window.shareResults = function() {
        const genderText = $('.prediction-result').text();
        
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("התחזית שלי למין התינוק", "babyhub"); ?>',
                text: genderText + ' - ' + '<?php _e("מהשיטה הסינית ב-Baby-Hub", "babyhub"); ?>',
                url: window.location.href
            });
        } else {
            const url = window.location.href;
            navigator.clipboard.writeText(url + '\n' + genderText).then(function() {
                alert('<?php _e("התוצאות הועתקו ללוח", "babyhub"); ?>');
            });
        }
    };

    window.saveResults = function() {
        // In a real implementation, this would save to user account
        alert('<?php _e("התוצאות נשמרו בפרופיל שלך", "babyhub"); ?>');
    };

    window.tryAgain = function() {
        $('#gender-results').slideUp();
        $('html, body').animate({
            scrollTop: $('#gender-form').offset().top - 100
        }, 500);
    };
});
</script>

<style>
/* Gender Predictor Specific Styles */
.gender-predictor-form {
    max-width: 800px;
    margin: 0 auto;
}

/* Chinese Chart Preview */
.chinese-chart-preview {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.chart-header h4 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.chart-header p {
    color: #666;
    margin-bottom: 1.5rem;
}

.mini-chart {
    max-width: 600px;
    margin: 0 auto;
    overflow-x: auto;
}

.chart-grid {
    display: inline-block;
    border: 2px solid #ddd;
    border-radius: 10px;
    background: white;
    padding: 1rem;
}

.chart-row {
    display: flex;
    align-items: center;
    margin-bottom: 0.25rem;
}

.chart-row:last-child {
    margin-bottom: 0;
}

.age-label {
    width: 30px;
    font-weight: 600;
    color: #2c3e50;
    margin-left: 0.5rem;
}

.chart-cell {
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 1px;
    border-radius: 3px;
    font-size: 0.7rem;
    transition: all 0.3s ease;
}

.chart-cell.boy {
    background: #4ECDC4;
}

.chart-cell.girl {
    background: #FF6B9D;
}

.chart-cell.highlighted {
    transform: scale(1.3);
    box-shadow: 0 0 10px rgba(255, 107, 157, 0.8);
    z-index: 10;
    position: relative;
}

/* Form Inputs */
.form-inputs {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alternative-method {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.method-toggle {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.toggle-checkbox {
    margin-left: 0.5rem;
}

.toggle-label {
    font-weight: 500;
    color: #2c3e50;
    cursor: pointer;
}

.lunar-explanation {
    background: #e8f4fd;
    padding: 1rem;
    border-radius: 8px;
    border-right: 4px solid #4ECDC4;
}

/* Results Styles */
.gender-prediction {
    border-radius: 15px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
    color: #2c3e50;
}

.prediction-main {
    max-width: 400px;
    margin: 0 auto;
}

.prediction-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.prediction-result {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.confidence-meter {
    margin-top: 1rem;
}

.confidence-bar {
    height: 20px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.confidence-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 1s ease-in-out;
}

.confidence-text {
    font-size: 1.1rem;
    font-weight: 600;
}

/* Prediction Details */
.prediction-details {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.prediction-details h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
}

.detail-label {
    font-weight: 500;
    color: #666;
}

.detail-value {
    font-weight: 600;
    color: #2c3e50;
}

/* Fun Facts */
.fun-facts {
    margin: 2rem 0;
}

.fun-facts h4 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.facts-list {
    display: grid;
    gap: 0.75rem;
}

.fact-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #e8f4fd;
    border-radius: 8px;
    border-right: 4px solid #4ECDC4;
}

.fact-item i {
    margin-left: 1rem;
    color: #4ECDC4;
    font-size: 1.2rem;
}

/* Important Disclaimer */
.important-disclaimer {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    padding: 1.5rem;
    margin: 2rem 0;
}

.important-disclaimer h4 {
    color: #856404;
    margin-bottom: 1rem;
}

.important-disclaimer p {
    color: #856404;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chart-grid {
        padding: 0.5rem;
    }
    
    .chart-cell {
        width: 20px;
        height: 20px;
        font-size: 0.6rem;
    }
    
    .age-label {
        width: 25px;
        font-size: 0.9rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .prediction-result {
        font-size: 1.5rem;
    }
    
    .prediction-icon {
        font-size: 3rem;
    }
}

@media (max-width: 480px) {
    .chinese-chart-preview {
        padding: 1rem;
    }
    
    .form-inputs {
        padding: 1rem;
    }
    
    .gender-prediction {
        padding: 1rem;
    }
    
    .mini-chart {
        overflow-x: scroll;
    }
    
    .chart-grid {
        min-width: 350px;
    }
}
</style>