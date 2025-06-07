<?php
/**
 * Baby-Hub Tools Suite - Remaining Calculators
 * Pregnancy Weight-Gain, Registry Manager, Baby Costs, etc.
 */

// Weight Gain Calculator
function babyhub_weight_gain_calculator() {
    ?>
    <div class="babyhub-tool-container" id="weight-gain-calculator">
        <div class="tool-header">
            <h3><?php _e('מעקב עלייה במשקל בהריון', 'babyhub-tools'); ?></h3>
            <p><?php _e('עקבי אחרי עלייה במשקל בהריון על פי המלצות רפואיות', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="weight-gain-form" class="tool-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="pre-pregnancy-weight"><?php _e('משקל לפני ההריון (ק"ג)', 'babyhub-tools'); ?></label>
                    <input type="number" id="pre-pregnancy-weight" name="pre_weight" step="0.1" min="35" max="150" required>
                </div>
                <div class="form-group">
                    <label for="current-weight"><?php _e('משקל נוכחי (ק"ג)', 'babyhub-tools'); ?></label>
                    <input type="number" id="current-weight" name="current_weight" step="0.1" min="35" max="200" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="height"><?php _e('גובה (ס"מ)', 'babyhub-tools'); ?></label>
                    <input type="number" id="height" name="height" min="140" max="200" required>
                </div>
                <div class="form-group">
                    <label for="pregnancy-weeks"><?php _e('שבוע הריון', 'babyhub-tools'); ?></label>
                    <select id="pregnancy-weeks" name="weeks" required>
                        <option value=""><?php _e('בחרי שבוע', 'babyhub-tools'); ?></option>
                        <?php for ($i = 1; $i <= 42; $i++) : ?>
                            <option value="<?php echo $i; ?>"><?php printf(__('שבוע %d', 'babyhub-tools'), $i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pregnancy-type"><?php _e('סוג הריון', 'babyhub-tools'); ?></label>
                <select id="pregnancy-type" name="pregnancy_type">
                    <option value="single"><?php _e('הריון יחיד', 'babyhub-tools'); ?></option>
                    <option value="twins"><?php _e('תאומים', 'babyhub-tools'); ?></option>
                    <option value="triplets"><?php _e('שלישיות', 'babyhub-tools'); ?></option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('חשב עלייה במשקל', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="weight-gain-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#weight-gain-form').on('submit', function(e) {
            e.preventDefault();
            
            const preWeight = parseFloat($('#pre-pregnancy-weight').val());
            const currentWeight = parseFloat($('#current-weight').val());
            const height = parseFloat($('#height').val());
            const weeks = parseInt($('#pregnancy-weeks').val());
            const pregnancyType = $('#pregnancy-type').val();
            
            // Calculate BMI
            const bmi = preWeight / ((height / 100) ** 2);
            
            // Determine BMI category and recommended weight gain
            let category, recommendedGain, weeklyGain;
            
            if (pregnancyType === 'twins') {
                if (bmi < 18.5) {
                    recommendedGain = [22.7, 28.1];
                    category = 'תת משקל';
                } else if (bmi < 25) {
                    recommendedGain = [16.8, 24.5];
                    category = 'משקל תקין';
                } else if (bmi < 30) {
                    recommendedGain = [14.1, 22.7];
                    category = 'עודף משקל';
                } else {
                    recommendedGain = [11.3, 19.1];
                    category = 'השמנה';
                }
            } else {
                if (bmi < 18.5) {
                    recommendedGain = [12.5, 18];
                    category = 'תת משקל';
                } else if (bmi < 25) {
                    recommendedGain = [11.5, 16];
                    category = 'משקל תקין';
                } else if (bmi < 30) {
                    recommendedGain = [7, 11.5];
                    category = 'עודף משקל';
                } else {
                    recommendedGain = [5, 9];
                    category = 'השמנה';
                }
            }
            
            const currentGain = currentWeight - preWeight;
            const expectedGainByWeek = (recommendedGain[1] / 40) * weeks;
            
            let status = '';
            let statusClass = '';
            if (currentGain < expectedGainByWeek - 2) {
                status = 'מתחת לטווח המומלץ';
                statusClass = 'warning';
            } else if (currentGain > expectedGainByWeek + 2) {
                status = 'מעל הטווח המומלץ';
                statusClass = 'warning';
            } else {
                status = 'בטווח המומלץ';
                statusClass = 'success';
            }
            
            const remainingWeeks = 40 - weeks;
            const remainingGain = recommendedGain[1] - currentGain;
            const weeklyRecommended = remainingGain / remainingWeeks;
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('תוצאות מעקב משקל', 'babyhub-tools'); ?></h4>
                    <div class="weight-results">
                        <div class="result-section">
                            <h5><?php _e('מצב נוכחי', 'babyhub-tools'); ?></h5>
                            <div class="result-item">
                                <strong><?php _e('BMI לפני הריון:', 'babyhub-tools'); ?></strong> ${bmi.toFixed(1)} (${category})
                            </div>
                            <div class="result-item">
                                <strong><?php _e('עלייה נוכחית:', 'babyhub-tools'); ?></strong> ${currentGain.toFixed(1)} ק"ג
                            </div>
                            <div class="result-item status-${statusClass}">
                                <strong><?php _e('סטטוס:', 'babyhub-tools'); ?></strong> ${status}
                            </div>
                        </div>
                        
                        <div class="result-section">
                            <h5><?php _e('המלצות', 'babyhub-tools'); ?></h5>
                            <div class="result-item">
                                <strong><?php _e('טווח מומלץ לכל ההריון:', 'babyhub-tools'); ?></strong> ${recommendedGain[0]}-${recommendedGain[1]} ק"ג
                            </div>
                            ${remainingWeeks > 0 ? `
                                <div class="result-item">
                                    <strong><?php _e('עלייה מומלצת בשבוע:', 'babyhub-tools'); ?></strong> ${weeklyRecommended.toFixed(1)} ק"ג
                                </div>
                            ` : ''}
                        </div>
                        
                        <div class="result-section tips">
                            <h5><?php _e('טיפים', 'babyhub-tools'); ?></h5>
                            <ul>
                                <li><?php _e('התייעצי עם הרופא שלך לגבי תזונה ופעילות גופנית', 'babyhub-tools'); ?></li>
                                <li><?php _e('שתי הרבה מים ואכלי מזון מזין', 'babyhub-tools'); ?></li>
                                <li><?php _e('שקלי את עצמך באותה שעה בכל שבוע', 'babyhub-tools'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;
            
            $('#weight-gain-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// Registry Manager
function babyhub_registry_manager() {
    ?>
    <div class="babyhub-tool-container" id="registry-manager">
        <div class="tool-header">
            <h3><?php _e('מנהל רשימת מתנות לתינוק', 'babyhub-tools'); ?></h3>
            <p><?php _e('צרי רשימת מתנות מותאמת אישית לתינוק הקטן שלך', 'babyhub-tools'); ?></p>
        </div>
        
        <div class="registry-sections">
            <div class="category-tabs">
                <button class="tab-btn active" data-category="essentials"><?php _e('חיוניים', 'babyhub-tools'); ?></button>
                <button class="tab-btn" data-category="feeding"><?php _e('הזנה', 'babyhub-tools'); ?></button>
                <button class="tab-btn" data-category="clothing"><?php _e('ביגוד', 'babyhub-tools'); ?></button>
                <button class="tab-btn" data-category="gear"><?php _e('ציוד', 'babyhub-tools'); ?></button>
                <button class="tab-btn" data-category="toys"><?php _e('צעצועים', 'babyhub-tools'); ?></button>
                <button class="tab-btn" data-category="custom"><?php _e('מותאם אישית', 'babyhub-tools'); ?></button>
            </div>
            
            <div class="category-content">
                <!-- Essentials -->
                <div class="category-panel active" id="essentials">
                    <h4><?php _e('מוצרים חיוניים', 'babyhub-tools'); ?></h4>
                    <div class="items-grid">
                        <div class="registry-item" data-item="car-seat">
                            <input type="checkbox" id="car-seat">
                            <label for="car-seat">
                                <span class="item-name"><?php _e('כסא בטיחות לרכב', 'babyhub-tools'); ?></span>
                                <span class="item-price">₪400-800</span>
                                <span class="priority high"><?php _e('חיוני', 'babyhub-tools'); ?></span>
                            </label>
                        </div>
                        
                        <div class="registry-item" data-item="crib">
                            <input type="checkbox" id="crib">
                            <label for="crib">
                                <span class="item-name"><?php _e('מיטת תינוק', 'babyhub-tools'); ?></span>
                                <span class="item-price">₪600-1200</span>
                                <span class="priority high"><?php _e('חיוני', 'babyhub-tools'); ?></span>
                            </label>
                        </div>
                        
                        <div class="registry-item" data-item="stroller">
                            <input type="checkbox" id="stroller">
                            <label for="stroller">
                                <span class="item-name"><?php _e('עגלת תינוק', 'babyhub-tools'); ?></span>
                                <span class="item-price">₪300-1500</span>
                                <span class="priority high"><?php _e('חיוני', 'babyhub-tools'); ?></span>
                            </label>
                        </div>
                        
                        <div class="registry-item" data-item="diapers">
                            <input type="checkbox" id="diapers">
                            <label for="diapers">
                                <span class="item-name"><?php _e('חיתולים (מידות שונות)', 'babyhub-tools'); ?></span>
                                <span class="item-price">₪150-300</span>
                                <span class="priority high"><?php _e('חיוני', 'babyhub-tools'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Add more categories... -->
            </div>
            
            <div class="custom-items">
                <h4><?php _e('הוסף פריט מותאם אישית', 'babyhub-tools'); ?></h4>
                <form id="custom-item-form">
                    <div class="form-row">
                        <input type="text" id="custom-item-name" placeholder="<?php _e('שם הפריט', 'babyhub-tools'); ?>" required>
                        <input type="text" id="custom-item-price" placeholder="<?php _e('מחיר משוער', 'babyhub-tools'); ?>">
                        <select id="custom-item-priority">
                            <option value="high"><?php _e('חיוני', 'babyhub-tools'); ?></option>
                            <option value="medium"><?php _e('רצוי', 'babyhub-tools'); ?></option>
                            <option value="low"><?php _e('נחמד להשיג', 'babyhub-tools'); ?></option>
                        </select>
                        <button type="submit"><?php _e('הוסף', 'babyhub-tools'); ?></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="registry-summary">
            <h4><?php _e('סיכום הרשימה', 'babyhub-tools'); ?></h4>
            <div id="selected-items"></div>
            <div class="registry-actions">
                <button id="export-registry" class="btn btn-primary"><?php _e('ייצא רשימה', 'babyhub-tools'); ?></button>
                <button id="share-registry" class="btn btn-secondary"><?php _e('שתף רשימה', 'babyhub-tools'); ?></button>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        let selectedItems = [];
        
        // Tab switching
        $('.tab-btn').on('click', function() {
            const category = $(this).data('category');
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
            $('.category-panel').removeClass('active');
            $('#' + category).addClass('active');
        });
        
        // Item selection
        $('.registry-item input[type="checkbox"]').on('change', function() {
            const item = $(this).closest('.registry-item');
            const itemData = {
                name: item.find('.item-name').text(),
                price: item.find('.item-price').text(),
                priority: item.find('.priority').text(),
                selected: $(this).is(':checked')
            };
            
            if (itemData.selected) {
                selectedItems.push(itemData);
            } else {
                selectedItems = selectedItems.filter(i => i.name !== itemData.name);
            }
            
            updateSummary();
        });
        
        // Custom item form
        $('#custom-item-form').on('submit', function(e) {
            e.preventDefault();
            
            const name = $('#custom-item-name').val();
            const price = $('#custom-item-price').val() || 'לא צוין';
            const priority = $('#custom-item-priority option:selected').text();
            
            selectedItems.push({
                name: name,
                price: price,
                priority: priority,
                selected: true,
                custom: true
            });
            
            // Reset form
            this.reset();
            updateSummary();
        });
        
        function updateSummary() {
            const summaryHTML = selectedItems.map(item => `
                <div class="selected-item">
                    <span class="item-name">${item.name}</span>
                    <span class="item-price">${item.price}</span>
                    <span class="priority ${item.priority === 'חיוני' ? 'high' : item.priority === 'רצוי' ? 'medium' : 'low'}">${item.priority}</span>
                    ${item.custom ? '<button class="remove-item" data-name="' + item.name + '">×</button>' : ''}
                </div>
            `).join('');
            
            $('#selected-items').html(summaryHTML);
        }
        
        // Remove custom item
        $(document).on('click', '.remove-item', function() {
            const name = $(this).data('name');
            selectedItems = selectedItems.filter(i => i.name !== name);
            updateSummary();
        });
        
        // Export registry
        $('#export-registry').on('click', function() {
            const registryText = selectedItems.map(item => 
                `${item.name} - ${item.price} (${item.priority})`
            ).join('\n');
            
            const blob = new Blob([registryText], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'baby-registry.txt';
            a.click();
            URL.revokeObjectURL(url);
        });
    });
    </script>
    <?php
}

// Baby Costs Calculator
function babyhub_baby_costs_calculator() {
    ?>
    <div class="babyhub-tool-container" id="baby-costs-calculator">
        <div class="tool-header">
            <h3><?php _e('מחשבון עלויות תינוק', 'babyhub-tools'); ?></h3>
            <p><?php _e('חשבי את העלויות החודשיות והשנתיות של גידול תינוק', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="baby-costs-form" class="tool-form">
            <div class="costs-categories">
                <div class="cost-category">
                    <h4><?php _e('הזנה', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('סוג הזנה', 'babyhub-tools'); ?></label>
                        <select id="feeding-type" name="feeding_type">
                            <option value="breastfeeding"><?php _e('הנקה בלבד', 'babyhub-tools'); ?></option>
                            <option value="formula"><?php _e('תרכובת בלבד', 'babyhub-tools'); ?></option>
                            <option value="mixed"><?php _e('מעורב', 'babyhub-tools'); ?></option>
                        </select>
                    </div>
                    <div class="form-group formula-costs" style="display: none;">
                        <label><?php _e('עלות תרכובת חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="formula-cost" min="0" max="1000" value="300">
                    </div>
                </div>
                
                <div class="cost-category">
                    <h4><?php _e('חיתולים', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('סוג חיתולים', 'babyhub-tools'); ?></label>
                        <select id="diaper-type">
                            <option value="disposable"><?php _e('חד פעמיים', 'babyhub-tools'); ?></option>
                            <option value="cloth"><?php _e('בד', 'babyhub-tools'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('עלות חיתולים חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="diaper-cost" min="0" max="500" value="200">
                    </div>
                </div>
                
                <div class="cost-category">
                    <h4><?php _e('ביגוד', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('עלות ביגוד חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="clothing-cost" min="0" max="1000" value="150">
                    </div>
                </div>
                
                <div class="cost-category">
                    <h4><?php _e('ציוד ואביזרים', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('עלות ציוד חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="gear-cost" min="0" max="2000" value="100">
                    </div>
                </div>
                
                <div class="cost-category">
                    <h4><?php _e('בריאות וטיפוח', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('עלות בריאות חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="healthcare-cost" min="0" max="2000" value="200">
                    </div>
                </div>
                
                <div class="cost-category">
                    <h4><?php _e('טיפול יומי (בייביסיטר/מעון)', 'babyhub-tools'); ?></h4>
                    <div class="form-group">
                        <label><?php _e('עלות טיפול חודשית (₪)', 'babyhub-tools'); ?></label>
                        <input type="number" id="childcare-cost" min="0" max="5000" value="0">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('חשב עלויות', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="baby-costs-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Show/hide formula costs based on feeding type
        $('#feeding-type').on('change', function() {
            const feedingType = $(this).val();
            if (feedingType === 'breastfeeding') {
                $('.formula-costs').hide();
                $('#formula-cost').val(0);
            } else {
                $('.formula-costs').show();
                if (feedingType === 'mixed') {
                    $('#formula-cost').val(150);
                } else {
                    $('#formula-cost').val(300);
                }
            }
        });
        
        $('#baby-costs-form').on('submit', function(e) {
            e.preventDefault();
            
            const costs = {
                feeding: parseFloat($('#formula-cost').val()) || 0,
                diapers: parseFloat($('#diaper-cost').val()) || 0,
                clothing: parseFloat($('#clothing-cost').val()) || 0,
                gear: parseFloat($('#gear-cost').val()) || 0,
                healthcare: parseFloat($('#healthcare-cost').val()) || 0,
                childcare: parseFloat($('#childcare-cost').val()) || 0
            };
            
            const monthlyTotal = Object.values(costs).reduce((sum, cost) => sum + cost, 0);
            const yearlyTotal = monthlyTotal * 12;
            const firstThreeYears = yearlyTotal * 3;
            
            // Calculate breakdown percentages
            const percentages = {};
            Object.keys(costs).forEach(key => {
                percentages[key] = monthlyTotal > 0 ? (costs[key] / monthlyTotal * 100).toFixed(1) : 0;
            });
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('חישוב עלויות תינוק', 'babyhub-tools'); ?></h4>
                    
                    <div class="costs-breakdown">
                        <h5><?php _e('פירוט עלויות חודשיות', 'babyhub-tools'); ?></h5>
                        <div class="cost-items">
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('הזנה:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.feeding.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.feeding}%)</span>
                            </div>
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('חיתולים:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.diapers.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.diapers}%)</span>
                            </div>
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('ביגוד:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.clothing.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.clothing}%)</span>
                            </div>
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('ציוד:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.gear.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.gear}%)</span>
                            </div>
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('בריאות:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.healthcare.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.healthcare}%)</span>
                            </div>
                            <div class="cost-item">
                                <span class="cost-label"><?php _e('טיפול יומי:', 'babyhub-tools'); ?></span>
                                <span class="cost-amount">₪${costs.childcare.toLocaleString()}</span>
                                <span class="cost-percentage">(${percentages.childcare}%)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="totals-section">
                        <div class="total-item monthly">
                            <span class="total-label"><?php _e('סך הכל חודשי:', 'babyhub-tools'); ?></span>
                            <span class="total-amount">₪${monthlyTotal.toLocaleString()}</span>
                        </div>
                        <div class="total-item yearly">
                            <span class="total-label"><?php _e('סך הכל שנתי:', 'babyhub-tools'); ?></span>
                            <span class="total-amount">₪${yearlyTotal.toLocaleString()}</span>
                        </div>
                        <div class="total-item three-years">
                            <span class="total-label"><?php _e('צפי ל-3 שנים הראשונות:', 'babyhub-tools'); ?></span>
                            <span class="total-amount">₪${firstThreeYears.toLocaleString()}</span>
                        </div>
                    </div>
                    
                    <div class="savings-tips">
                        <h5><?php _e('טיפים לחיסכון', 'babyhub-tools'); ?></h5>
                        <ul>
                            <li><?php _e('קני בכמויות גדולות (חיתולים, תרכובת)', 'babyhub-tools'); ?></li>
                            <li><?php _e('חפשי הנחות ומבצעים', 'babyhub-tools'); ?></li>
                            <li><?php _e('שתפי ציוד עם משפחה וחברים', 'babyhub-tools'); ?></li>
                            <li><?php _e('שקלי מוצרי יד שנייה באיכות טובה', 'babyhub-tools'); ?></li>
                        </ul>
                    </div>
                </div>
            `;
            
            $('#baby-costs-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// Solid Feeding Guide
function babyhub_solid_feeding_guide() {
    ?>
    <div class="babyhub-tool-container" id="solid-feeding-guide">
        <div class="tool-header">
            <h3><?php _e('מדריך מזון מוצק לתינוקות', 'babyhub-tools'); ?></h3>
            <p><?php _e('מתי ואיך להתחיל עם מזון מוצק - מדריך שלב אחר שלב', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="feeding-guide-form" class="tool-form">
            <div class="form-group">
                <label for="baby-age-months"><?php _e('גיל התינוק (חודשים)', 'babyhub-tools'); ?></label>
                <select id="baby-age-months" name="age_months" required>
                    <option value=""><?php _e('בחר גיל', 'babyhub-tools'); ?></option>
                    <?php for ($i = 4; $i <= 24; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php printf(__('%d חודשים', 'babyhub-tools'), $i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label><?php _e('סימני מוכנות שהתינוק מראה', 'babyhub-tools'); ?></label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="sits-supported" name="readiness_signs[]" value="sits_supported">
                        <label for="sits-supported"><?php _e('יושב בתמיכה', 'babyhub-tools'); ?></label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="head-control" name="readiness_signs[]" value="head_control">
                        <label for="head-control"><?php _e('שליטה טובה בראש', 'babyhub-tools'); ?></label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="interest-food" name="readiness_signs[]" value="interest_food">
                        <label for="interest-food"><?php _e('מעוניין במזון של מבוגרים', 'babyhub-tools'); ?></label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="tongue-reflex" name="readiness_signs[]" value="tongue_reflex">
                        <label for="tongue-reflex"><?php _e('רפלקס הלשון פחת', 'babyhub-tools'); ?></label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="allergies-family"><?php _e('יש אלרגיות מזון במשפחה?', 'babyhub-tools'); ?></label>
                <select id="allergies-family" name="family_allergies">
                    <option value="no"><?php _e('לא', 'babyhub-tools'); ?></option>
                    <option value="yes"><?php _e('כן', 'babyhub-tools'); ?></option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('קבל המלצות', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="feeding-guide-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#feeding-guide-form').on('submit', function(e) {
            e.preventDefault();
            
            const ageMonths = parseInt($('#baby-age-months').val());
            const readinessSigns = $('input[name="readiness_signs[]"]:checked').length;
            const familyAllergies = $('#allergies-family').val() === 'yes';
            
            let recommendations = '';
            let foods = [];
            let avoidFoods = [];
            let tips = [];
            
            if (ageMonths < 6) {
                recommendations = `
                    <div class="alert info">
                        <h4><?php _e('עדיין מוקדם', 'babyhub-tools'); ?></h4>
                        <p><?php _e('הגיל המומלץ להתחלת מזון מוצק הוא 6 חודשים. המתיני עוד קצת.', 'babyhub-tools'); ?></p>
                    </div>
                `;
            } else if (ageMonths >= 6 && ageMonths <= 8) {
                // First foods (6-8 months)
                foods = [
                    '<?php _e('דייסת אורז', 'babyhub-tools'); ?>',
                    '<?php _e('בטטה מרוסקת', 'babyhub-tools'); ?>',
                    '<?php _e('אבוקדו', 'babyhub-tools'); ?>',
                    '<?php _e('בננה מרוסקת', 'babyhub-tools'); ?>',
                    '<?php _e('גזר מבושל ומרוסק', 'babyhub-tools'); ?>',
                    '<?php _e('תפוח מבושל ומרוסק', 'babyhub-tools'); ?>'
                ];
                
                avoidFoods = [
                    '<?php _e('דבש', 'babyhub-tools'); ?>',
                    '<?php _e('חלב פרה', 'babyhub-tools'); ?>',
                    '<?php _e('אגוזים שלמים', 'babyhub-tools'); ?>',
                    '<?php _e('ביצים גולמיות', 'babyhub-tools'); ?>'
                ];
                
                tips = [
                    '<?php _e('התחילי עם כף אחת ביום', 'babyhub-tools'); ?>',
                    '<?php _e('הכיני מזון ללא תוספת מלח או סוכר', 'babyhub-tools'); ?>',
                    '<?php _e('המתיני 3-5 ימים בין מזון חדש', 'babyhub-tools'); ?>',
                    '<?php _e('תני לתינוק לגעת ולחקור את המזון', 'babyhub-tools'); ?>'
                ];
            } else if (ageMonths >= 9 && ageMonths <= 11) {
                // Finger foods (9-11 months)
                foods = [
                    '<?php _e('חתיכות בננה רכה', 'babyhub-tools'); ?>',
                    '<?php _e('פסטה מבושלת היטב', 'babyhub-tools'); ?>',
                    '<?php _e('גבינה רכה בחתיכות', 'babyhub-tools'); ?>',
                    '<?php _e('לחם רך', 'babyhub-tools'); ?>',
                    '<?php _e('ביצה מבושלת', 'babyhub-tools'); ?>',
                    '<?php _e('עוף מבושל ומרוסק', 'babyhub-tools'); ?>'
                ];
                
                tips = [
                    '<?php _e('עודדי אכילה עצמאית', 'babyhub-tools'); ?>',
                    '<?php _e('תני מזונות בגדלים מתאימים לאחיזה', 'babyhub-tools'); ?>',
                    '<?php _e('הציעי מגוון טעמים ומרקמים', 'babyhub-tools'); ?>'
                ];
            } else {
                // Toddler foods (12+ months)
                foods = [
                    '<?php _e('חלב פרה מלא', 'babyhub-tools'); ?>',
                    '<?php _e('מזונות משפחתיים מותאמים', 'babyhub-tools'); ?>',
                    '<?php _e('פירות וירקות חתוכים', 'babyhub-tools'); ?>',
                    '<?php _e('דגנים מלאים', 'babyhub-tools'); ?>'
                ];
                
                tips = [
                    '<?php _e('המשיכי הנקה או תרכובת', 'babyhub-tools'); ?>',
                    '<?php _e('הציעי ארוחות משפחתיות', 'babyhub-tools'); ?>',
                    '<?php _e('עודדי שימוש בכלי אכילה', 'babyhub-tools'); ?>'
                ];
            }
            
            if (familyAllergies) {
                tips.push('<?php _e('התייעצי עם רופא לפני הכנסת מזונות אלרגניים', 'babyhub-tools'); ?>');
            }
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('המלצות מזון לגיל', 'babyhub-tools'); ?> ${ageMonths} <?php _e('חודשים', 'babyhub-tools'); ?></h4>
                    
                    ${recommendations}
                    
                    ${foods.length > 0 ? `
                        <div class="foods-section">
                            <h5><?php _e('מזונות מומלצים', 'babyhub-tools'); ?></h5>
                            <ul class="foods-list recommended">
                                ${foods.map(food => `<li>${food}</li>`).join('')}
                            </ul>
                        </div>
                    ` : ''}
                    
                    ${avoidFoods.length > 0 ? `
                        <div class="foods-section">
                            <h5><?php _e('מזונות להימנע מהם', 'babyhub-tools'); ?></h5>
                            <ul class="foods-list avoid">
                                ${avoidFoods.map(food => `<li>${food}</li>`).join('')}
                            </ul>
                        </div>
                    ` : ''}
                    
                    <div class="tips-section">
                        <h5><?php _e('טיפים חשובים', 'babyhub-tools'); ?></h5>
                        <ul class="tips-list">
                            ${tips.map(tip => `<li>${tip}</li>`).join('')}
                        </ul>
                    </div>
                    
                    <div class="safety-note">
                        <h5><?php _e('בטיחות', 'babyhub-tools'); ?></h5>
                        <ul>
                            <li><?php _e('תמיד השגיחי על התינוק בזמן האכילה', 'babyhub-tools'); ?></li>
                            <li><?php _e('הימנעי ממזונות חנק כמו ענבים שלמים ואגוזים', 'babyhub-tools'); ?></li>
                            <li><?php _e('ודאי שהמזון בטמפרטורה מתאימה', 'babyhub-tools'); ?></li>
                        </ul>
                    </div>
                </div>
            `;
            
            $('#feeding-guide-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// WHO Growth Chart
function babyhub_growth_chart() {
    ?>
    <div class="babyhub-tool-container" id="growth-chart">
        <div class="tool-header">
            <h3><?php _e('טבלת גדילה לפי WHO', 'babyhub-tools'); ?></h3>
            <p><?php _e('עקבי אחרי גדילת התינוק שלך לפי תקני ארגון הבריאות העולמי', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="growth-chart-form" class="tool-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="baby-gender"><?php _e('מין התינוק', 'babyhub-tools'); ?></label>
                    <select id="baby-gender" name="gender" required>
                        <option value=""><?php _e('בחר מין', 'babyhub-tools'); ?></option>
                        <option value="boy"><?php _e('בן', 'babyhub-tools'); ?></option>
                        <option value="girl"><?php _e('בת', 'babyhub-tools'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="baby-age-growth"><?php _e('גיל התינוק (חודשים)', 'babyhub-tools'); ?></label>
                    <input type="number" id="baby-age-growth" name="age" min="0" max="60" step="0.5" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="baby-weight"><?php _e('משקל נוכחי (ק"ג)', 'babyhub-tools'); ?></label>
                    <input type="number" id="baby-weight" name="weight" min="1" max="50" step="0.1" required>
                </div>
                <div class="form-group">
                    <label for="baby-height"><?php _e('גובה נוכחי (ס"מ)', 'babyhub-tools'); ?></label>
                    <input type="number" id="baby-height" name="height" min="40" max="150" step="0.1" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="baby-head"><?php _e('היקף ראש (ס"מ) - אופציונלי', 'babyhub-tools'); ?></label>
                <input type="number" id="baby-head" name="head_circumference" min="30" max="60" step="0.1">
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('חשב פרצנטילים', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="growth-chart-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // WHO Growth Standards (simplified for demo - in production would use actual CSV data)
        const whoStandards = {
            boy: {
                weight: {
                    3: [14.5, 16.0, 17.7], // 25th, 50th, 75th percentiles at 3 months
                    6: [16.5, 18.0, 19.8],
                    12: [18.5, 20.3, 22.3],
                    24: [22.0, 24.0, 26.2]
                },
                height: {
                    3: [58.5, 61.5, 64.5],
                    6: [63.0, 66.5, 70.0],
                    12: [71.0, 75.0, 79.0],
                    24: [82.0, 86.5, 91.0]
                }
            },
            girl: {
                weight: {
                    3: [13.5, 15.0, 16.5],
                    6: [15.5, 17.0, 18.8],
                    12: [17.5, 19.0, 21.0],
                    24: [21.0, 23.0, 25.0]
                },
                height: {
                    3: [57.0, 60.0, 63.0],
                    6: [62.0, 65.0, 68.5],
                    12: [70.0, 73.5, 77.0],
                    24: [81.0, 85.0, 89.0]
                }
            }
        };
        
        $('#growth-chart-form').on('submit', function(e) {
            e.preventDefault();
            
            const gender = $('#baby-gender').val();
            const age = parseFloat($('#baby-age-growth').val());
            const weight = parseFloat($('#baby-weight').val());
            const height = parseFloat($('#baby-height').val());
            const headCirc = parseFloat($('#baby-head').val()) || null;
            
            // Calculate percentiles (simplified calculation)
            function calculatePercentile(value, standards) {
                if (value < standards[0]) return '< 25th';
                if (value < standards[1]) return '25-50th';
                if (value < standards[2]) return '50-75th';
                return '> 75th';
            }
            
            // Find closest age in standards
            const ages = Object.keys(whoStandards[gender].weight).map(Number);
            const closestAge = ages.reduce((prev, curr) => 
                Math.abs(curr - age) < Math.abs(prev - age) ? curr : prev
            );
            
            const weightPercentile = calculatePercentile(weight, whoStandards[gender].weight[closestAge]);
            const heightPercentile = calculatePercentile(height, whoStandards[gender].height[closestAge]);
            
            // Calculate BMI
            const bmi = weight / ((height / 100) ** 2);
            
            let growthStatus = '';
            let statusClass = '';
            
            if (weightPercentile.includes('<') || heightPercentile.includes('<')) {
                growthStatus = '<?php _e('מתחת לממוצע - התייעצי עם רופא', 'babyhub-tools'); ?>';
                statusClass = 'warning';
            } else if (weightPercentile.includes('>') && heightPercentile.includes('>')) {
                growthStatus = '<?php _e('מעל הממוצע - גדילה מצוינת', 'babyhub-tools'); ?>';
                statusClass = 'success';
            } else {
                growthStatus = '<?php _e('בטווח הנורמלי', 'babyhub-tools'); ?>';
                statusClass = 'success';
            }
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('תוצאות טבלת גדילה', 'babyhub-tools'); ?></h4>
                    
                    <div class="growth-results">
                        <div class="percentiles-section">
                            <h5><?php _e('פרצנטילים', 'babyhub-tools'); ?></h5>
                            <div class="percentile-item">
                                <span class="label"><?php _e('משקל:', 'babyhub-tools'); ?></span>
                                <span class="value">${weight} <?php _e('ק"ג', 'babyhub-tools'); ?></span>
                                <span class="percentile">${weightPercentile} <?php _e('פרצנטיל', 'babyhub-tools'); ?></span>
                            </div>
                            <div class="percentile-item">
                                <span class="label"><?php _e('גובה:', 'babyhub-tools'); ?></span>
                                <span class="value">${height} <?php _e('ס"מ', 'babyhub-tools'); ?></span>
                                <span class="percentile">${heightPercentile} <?php _e('פרצנטיל', 'babyhub-tools'); ?></span>
                            </div>
                            <div class="percentile-item">
                                <span class="label"><?php _e('BMI:', 'babyhub-tools'); ?></span>
                                <span class="value">${bmi.toFixed(1)}</span>
                                <span class="percentile"></span>
                            </div>
                        </div>
                        
                        <div class="status-section ${statusClass}">
                            <h5><?php _e('סטטוס גדילה', 'babyhub-tools'); ?></h5>
                            <p class="growth-status">${growthStatus}</p>
                        </div>
                        
                        <div class="recommendations-section">
                            <h5><?php _e('המלצות', 'babyhub-tools'); ?></h5>
                            <ul>
                                <li><?php _e('המשיכי למדוד ולשקול בקביעות', 'babyhub-tools'); ?></li>
                                <li><?php _e('שמרי על תזונה מאוזנת ומגוונת', 'babyhub-tools'); ?></li>
                                <li><?php _e('עודדי פעילות גופנית מתאימה לגיל', 'babyhub-tools'); ?></li>
                                <li><?php _e('התייעצי עם רופא הילדים במקרה של דאגות', 'babyhub-tools'); ?></li>
                            </ul>
                        </div>
                        
                        <div class="chart-info">
                            <p><small><?php _e('* הפרצנטילים מבוססים על תקני WHO לגדילת ילדים', 'babyhub-tools'); ?></small></p>
                        </div>
                    </div>
                </div>
            `;
            
            $('#growth-chart-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// Add shortcodes for all calculators
add_shortcode('babyhub_weight_gain_calculator', 'babyhub_weight_gain_calculator');
add_shortcode('babyhub_registry_manager', 'babyhub_registry_manager');
add_shortcode('babyhub_baby_costs_calculator', 'babyhub_baby_costs_calculator');
add_shortcode('babyhub_solid_feeding_guide', 'babyhub_solid_feeding_guide');
add_shortcode('babyhub_growth_chart', 'babyhub_growth_chart');

// Height Predictor (continuing from previous calculators)
function babyhub_height_predictor() {
    ?>
    <div class="babyhub-tool-container" id="height-predictor">
        <div class="tool-header">
            <h3><?php _e('חיזוי גובה התינוק', 'babyhub-tools'); ?></h3>
            <p><?php _e('חזי את הגובה הצפוי של התינוק על בסיס גובה ההורים', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="height-predictor-form" class="tool-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="father-height"><?php _e('גובה האב (ס"מ)', 'babyhub-tools'); ?></label>
                    <input type="number" id="father-height" name="father_height" min="150" max="220" required>
                </div>
                <div class="form-group">
                    <label for="mother-height"><?php _e('גובה האם (ס"מ)', 'babyhub-tools'); ?></label>
                    <input type="number" id="mother-height" name="mother_height" min="140" max="200" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="child-gender"><?php _e('מין התינוק', 'babyhub-tools'); ?></label>
                <select id="child-gender" name="child_gender" required>
                    <option value=""><?php _e('בחר מין', 'babyhub-tools'); ?></option>
                    <option value="boy"><?php _e('בן', 'babyhub-tools'); ?></option>
                    <option value="girl"><?php _e('בת', 'babyhub-tools'); ?></option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('חזה גובה', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="height-predictor-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#height-predictor-form').on('submit', function(e) {
            e.preventDefault();
            
            const fatherHeight = parseFloat($('#father-height').val());
            const motherHeight = parseFloat($('#mother-height').val());
            const childGender = $('#child-gender').val();
            
            let predictedHeight;
            
            // Calculate using the traditional method
            if (childGender === 'boy') {
                predictedHeight = ((fatherHeight + motherHeight + 13) / 2);
            } else {
                predictedHeight = ((fatherHeight + motherHeight - 13) / 2);
            }
            
            const minHeight = predictedHeight - 8;
            const maxHeight = predictedHeight + 8;
            
            // Additional genetic factors consideration
            const parentalAverage = (fatherHeight + motherHeight) / 2;
            let geneticFactor = '';
            
            if (parentalAverage > 175) {
                geneticFactor = '<?php _e('הורים גבוהים - סיכוי גבוה לגובה מעל הממוצע', 'babyhub-tools'); ?>';
            } else if (parentalAverage < 165) {
                geneticFactor = '<?php _e('הורים נמוכים יחסית - גובה צפוי סביב הממוצע או מעט מתחתיו', 'babyhub-tools'); ?>';
            } else {
                geneticFactor = '<?php _e('הורים בגובה ממוצע - גובה צפוי בטווח הממוצע', 'babyhub-tools'); ?>';
            }
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('חיזוי גובה התינוק', 'babyhub-tools'); ?></h4>
                    
                    <div class="height-prediction">
                        <div class="prediction-main">
                            <h5><?php _e('גובה צפוי:', 'babyhub-tools'); ?> ${predictedHeight.toFixed(0)} <?php _e('ס"מ', 'babyhub-tools'); ?></h5>
                            <p class="height-range"><?php _e('טווח:', 'babyhub-tools'); ?> ${minHeight.toFixed(0)}-${maxHeight.toFixed(0)} <?php _e('ס"מ', 'babyhub-tools'); ?></p>
                        </div>
                        
                        <div class="genetic-analysis">
                            <h5><?php _e('ניתוח גנטי', 'babyhub-tools'); ?></h5>
                            <p>${geneticFactor}</p>
                        </div>
                        
                        <div class="factors-affecting">
                            <h5><?php _e('גורמים משפיעים על גובה', 'babyhub-tools'); ?></h5>
                            <ul>
                                <li><?php _e('גנטיקה (60-70% מהגובה)', 'babyhub-tools'); ?></li>
                                <li><?php _e('תזונה מאוזנת ועשירה בחלבון וסידן', 'babyhub-tools'); ?></li>
                                <li><?php _e('שינה איכותית (הורמון גדילה נפרש בשינה)', 'babyhub-tools'); ?></li>
                                <li><?php _e('פעילות גופנית ויישור שדרה', 'babyhub-tools'); ?></li>
                                <li><?php _e('בריאות כללית ותפקוד הורמונלי', 'babyhub-tools'); ?></li>
                            </ul>
                        </div>
                        
                        <div class="growth-tips">
                            <h5><?php _e('טיפים לעידוד גדילה בריאה', 'babyhub-tools'); ?></h5>
                            <ul>
                                <li><?php _e('דאגי לתזונה עשירה בחלבון, סידן וויטמין D', 'babyhub-tools'); ?></li>
                                <li><?php _e('עודדי פעילות גופנית כמו שחייה, כדורסל או מתיחות', 'babyhub-tools'); ?></li>
                                <li><?php _e('שמרי על שעות שינה מספיקות', 'babyhub-tools'); ?></li>
                                <li><?php _e('עקבי אחרי גדילה אצל רופא הילדים', 'babyhub-tools'); ?></li>
                            </ul>
                        </div>
                        
                        <div class="prediction-note">
                            <p><small><?php _e('* זהו חישוב משוער בלבד. הגובה הסופי מושפע מגורמים רבים מעבר לגנטיקה.', 'babyhub-tools'); ?></small></p>
                        </div>
                    </div>
                </div>
            `;
            
            $('#height-predictor-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// Zodiac Calculator
function babyhub_zodiac_calculator() {
    ?>
    <div class="babyhub-tool-container" id="zodiac-calculator">
        <div class="tool-header">
            <h3><?php _e('מזל התינוק ותכונות אופי', 'babyhub-tools'); ?></h3>
            <p><?php _e('גלי את מזל התינוק שלך ותכונות האופי הצפויות', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="zodiac-form" class="tool-form">
            <div class="form-group">
                <label for="birth-date"><?php _e('תאריך לידה (או צפוי)', 'babyhub-tools'); ?></label>
                <input type="date" id="birth-date" name="birth_date" required>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('גלה את המזל', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="zodiac-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        const zodiacSigns = {
            'מזל טלה': { 
                start: [3, 21], 
                end: [4, 19], 
                emoji: '♈', 
                element: 'אש',
                traits: ['אנרגטי', 'נחוש', 'מוביל טבעי', 'אמיץ', 'עצמאי'],
                description: 'תינוקות במזל טלה הם לעתים קרובות אנרגטיים ונחושים. הם אוהבים להוביל ולחקור.',
                parenting_tips: [
                    'עודדו עצמאות מוקדמת',
                    'תנו הרבה פעילות גופנית', 
                    'הציבו גבולות ברורים',
                    'עודדו יצירתיות ומובילות'
                ]
            },
            'מזל שור': { 
                start: [4, 20], 
                end: [5, 20], 
                emoji: '♉', 
                element: 'אדמה',
                traits: ['יציב', 'מעשי', 'אמין', 'מתמיד', 'רגוע'],
                description: 'תינוקות במזל שור נוטים להיות רגועים ויציבים. הם אוהבים שגרה ונוחות.',
                parenting_tips: [
                    'שמרו על שגרה קבועה',
                    'תנו הרבה חיבוקים ומגע פיזי',
                    'עודדו חיבור לטבע',
                    'היו סבלניים עם שינויים'
                ]
            },
            'מזל תאומים': { 
                start: [5, 21], 
                end: [6, 20], 
                emoji: '♊', 
                element: 'אוויר',
                traits: ['חברותי', 'סקרן', 'מתאים', 'תקשורתי', 'חכם'],
                description: 'תינוקות במזל תאומים הם סקרנים ותקשורתיים. הם אוהבים לחקור ולמידה.',
                parenting_tips: [
                    'דברו הרבה עם התינוק',
                    'עודדו חקר וסקרנות',
                    'הציגו גירויים מגוונים',
                    'עודדו אינטראקציות חברתיות'
                ]
            },
            'מזל סרטן': { 
                start: [6, 21], 
                end: [7, 22], 
                emoji: '♋', 
                element: 'מים',
                traits: ['רגשי', 'מטפח', 'מגן', 'אינטואיטיבי', 'רגיש'],
                description: 'תינוקות במזל סרטן הם רגישים ורגשיים. הם זקוקים להרבה אהבה וביטחון.',
                parenting_tips: [
                    'תנו הרבה אהבה וחום',
                    'יצרו סביבה בטוחה ונוחה',
                    'היו רגישים לרגשותיהם',
                    'עודדו ביטוי רגשי בריא'
                ]
            },
            'מזל אריה': { 
                start: [7, 23], 
                end: [8, 22], 
                emoji: '♌', 
                element: 'אש',
                traits: ['בטוח', 'יצירתי', 'נדיב', 'מבריק', 'דרמטי'],
                description: 'תינוקות במזל אריה אוהבים להיות במרכז תשומת הלב. הם יצירתיים ומבריקים.',
                parenting_tips: [
                    'תנו להם הזדמנויות לזרוח',
                    'עודדו יצירתיות וביטוי עצמי',
                    'תנו הרבה שבחים והכרה',
                    'עודדו ביטחון עצמי בריא'
                ]
            },
            'מזל בתולה': { 
                start: [8, 23], 
                end: [9, 22], 
                emoji: '♍', 
                element: 'אדמה',
                traits: ['מדויק', 'מסודר', 'עובד קשה', 'מעשי', 'מתחשב'],
                description: 'תינוקות במזל בתולה נוטים להיות מסודרים ומדוקדקים. הם אוהבים שגרה וסדר.',
                parenting_tips: [
                    'שמרו על סביבה מסודרת',
                    'עודדו למידה ופרטים',
                    'תנו משימות קטנות להשגת הצלחה',
                    'עודדו עזרה לאחרים'
                ]
            },
            'מזל מאזניים': { 
                start: [9, 23], 
                end: [10, 22], 
                emoji: '♎', 
                element: 'אוויר',
                traits: ['מאוזן', 'חברותי', 'מחפש הרמוניה', 'יפה', 'דיפלומטי'],
                description: 'תינוקות במזל מאזניים אוהבים הרמוניה ויופי. הם חברותיים ואוהבים איזון.',
                parenting_tips: [
                    'יצרו סביבה הרמונית ויפה',
                    'עודדו אינטראקציות חברתיות',
                    'למדו אותם לפתור סכסוכים',
                    'עודדו חוש אסתטיקה'
                ]
            },
            'מזל עקרב': { 
                start: [10, 23], 
                end: [11, 21], 
                emoji: '♏', 
                element: 'מים',
                traits: ['נחוש', 'אינטנסיבי', 'מסתורי', 'עמוק', 'נאמן'],
                description: 'תינוקות במזל עקרב הם אינטנסיביים ובעלי רגשות עמוקים. הם נחושים ונאמנים.',
                parenting_tips: [
                    'תנו להם זמן לעיבוד רגשות',
                    'עודדו עומק וחקר',
                    'היו ישירים ואמינים',
                    'עודדו נאמנות וחברות עמוקות'
                ]
            },
            'מזל קשת': { 
                start: [11, 22], 
                end: [12, 21], 
                emoji: '♐', 
                element: 'אש',
                traits: ['הרפתקן', 'אופטימי', 'חופשי', 'פילוסופי', 'כנה'],
                description: 'תינוקות במזל קשת אוהבים הרפתקאות וחקר. הם אופטימיים וחופשיים ברוחם.',
                parenting_tips: [
                    'עודדו חקר והרפתקאות',
                    'תנו חופש תנועה',
                    'עודדו למידה על תרבויות שונות',
                    'פתחו אופקים חדשים'
                ]
            },
            'מזל גדי': { 
                start: [12, 22], 
                end: [1, 19], 
                emoji: '♑', 
                element: 'אדמה',
                traits: ['אחראי', 'שאפתן', 'מעשי', 'מתמיד', 'חכם'],
                description: 'תינוקות במזל גדי נוטים להיות רציניים ואחראיים. הם שאפתנים ומעשיים.',
                parenting_tips: [
                    'עודדו אחריות מוקדמת',
                    'תנו משימות מעשיות',
                    'עודדו התמדה ומטרות',
                    'דאגו לאיזון בין עבודה ומשחק'
                ]
            },
            'מזל דלי': { 
                start: [1, 20], 
                end: [2, 18], 
                emoji: '♒', 
                element: 'אוויר',
                traits: ['מקורי', 'עצמאי', 'חדשני', 'הומניטרי', 'ייחודי'],
                description: 'תינוקות במזל דלי הם ייחודיים ועצמאיים. הם חדשניים ואוהבים לעזור לאחרים.',
                parenting_tips: [
                    'עודדו יצירתיות וחדשנות',
                    'תנו חופש ביטוי',
                    'עודדו עזרה לקהילה',
                    'כבדו את הייחודיות שלהם'
                ]
            },
            'מזל דגים': { 
                start: [2, 19], 
                end: [3, 20], 
                emoji: '♓', 
                element: 'מים',
                traits: ['רגיש', 'אמפטי', 'יצירתי', 'אינטואיטיבי', 'חולמני'],
                description: 'תינוקות במזל דגים הם רגישים ואמפטיים. הם יצירתיים ובעלי דמיון עשיר.',
                parenting_tips: [
                    'תנו להם זמן חלומות ודמיון',
                    'עודדו יצירתיות ואמנות',
                    'היו רגישים לרגשותיהם',
                    'יצרו סביבה רגועה ומגוונת'
                ]
            }
        };
        
        $('#zodiac-form').on('submit', function(e) {
            e.preventDefault();
            
            const birthDate = new Date($('#birth-date').val());
            const month = birthDate.getMonth() + 1;
            const day = birthDate.getDate();
            
            let userSign = '';
            for (const [sign, data] of Object.entries(zodiacSigns)) {
                const startMonth = data.start[0];
                const startDay = data.start[1];
                const endMonth = data.end[0];
                const endDay = data.end[1];
                
                if ((month === startMonth && day >= startDay) || 
                    (month === endMonth && day <= endDay)) {
                    userSign = sign;
                    break;
                }
            }
            
            if (!userSign) {
                userSign = 'מזל גדי'; // Fallback
            }
            
            const signData = zodiacSigns[userSign];
            
            const resultHTML = `
                <div class="calculation-result success">
                    <h4><?php _e('מזל התינוק שלך', 'babyhub-tools'); ?></h4>
                    
                    <div class="zodiac-result">
                        <div class="zodiac-header">
                            <span class="zodiac-emoji">${signData.emoji}</span>
                            <h5>${userSign}</h5>
                            <span class="zodiac-element"><?php _e('יסוד:', 'babyhub-tools'); ?> ${signData.element}</span>
                        </div>
                        
                        <div class="zodiac-description">
                            <p>${signData.description}</p>
                        </div>
                        
                        <div class="zodiac-traits">
                            <h6><?php _e('תכונות אופי מובהקות:', 'babyhub-tools'); ?></h6>
                            <div class="traits-list">
                                ${signData.traits.map(trait => `<span class="trait-tag">${trait}</span>`).join('')}
                            </div>
                        </div>
                        
                        <div class="parenting-tips">
                            <h6><?php _e('טיפים להורות:', 'babyhub-tools'); ?></h6>
                            <ul>
                                ${signData.parenting_tips.map(tip => `<li>${tip}</li>`).join('')}
                            </ul>
                        </div>
                        
                        <div class="zodiac-disclaimer">
                            <p><small><?php _e('* מזלות הם למטרות בידור והשראה בלבד ואינם מחליפים הכרה אישית של התינוק', 'babyhub-tools'); ?></small></p>
                        </div>
                    </div>
                </div>
            `;
            
            $('#zodiac-results').html(resultHTML);
        });
    });
    </script>
    <?php
}

// Baby Names Finder
function babyhub_baby_names_finder() {
    ?>
    <div class="babyhub-tool-container" id="baby-names-finder">
        <div class="tool-header">
            <h3><?php _e('מאגר שמות תינוקות', 'babyhub-tools'); ?></h3>
            <p><?php _e('מצא את השם המושלם לתינוק שלך ממאגר עשיר של שמות עבריים וישראליים', 'babyhub-tools'); ?></p>
        </div>
        
        <form id="baby-names-form" class="tool-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="name-gender"><?php _e('מין התינוק', 'babyhub-tools'); ?></label>
                    <select id="name-gender" name="gender" required>
                        <option value=""><?php _e('בחר מין', 'babyhub-tools'); ?></option>
                        <option value="boy"><?php _e('בן', 'babyhub-tools'); ?></option>
                        <option value="girl"><?php _e('בת', 'babyhub-tools'); ?></option>
                        <option value="unisex"><?php _e('לשני המינים', 'babyhub-tools'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name-origin"><?php _e('מקור השם', 'babyhub-tools'); ?></label>
                    <select id="name-origin" name="origin">
                        <option value=""><?php _e('כל המקורות', 'babyhub-tools'); ?></option>
                        <option value="hebrew"><?php _e('עברי מקראי', 'babyhub-tools'); ?></option>
                        <option value="modern-hebrew"><?php _e('עברי מודרני', 'babyhub-tools'); ?></option>
                        <option value="international"><?php _e('בינלאומי', 'babyhub-tools'); ?></option>
                        <option value="traditional"><?php _e('מסורתי', 'babyhub-tools'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="name-length"><?php _e('אורך השם', 'babyhub-tools'); ?></label>
                    <select id="name-length" name="length">
                        <option value=""><?php _e('כל האורכים', 'babyhub-tools'); ?></option>
                        <option value="short"><?php _e('קצר (3-4 אותיות)', 'babyhub-tools'); ?></option>
                        <option value="medium"><?php _e('בינוני (5-6 אותיות)', 'babyhub-tools'); ?></option>
                        <option value="long"><?php _e('ארוך (7+ אותיות)', 'babyhub-tools'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name-popularity"><?php _e('פופולריות', 'babyhub-tools'); ?></label>
                    <select id="name-popularity" name="popularity">
                        <option value=""><?php _e('כל השמות', 'babyhub-tools'); ?></option>
                        <option value="popular"><?php _e('פופולריים', 'babyhub-tools'); ?></option>
                        <option value="unique"><?php _e('ייחודיים', 'babyhub-tools'); ?></option>
                        <option value="classic"><?php _e('קלאסיים', 'babyhub-tools'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="name-meaning"><?php _e('חפש לפי משמעות', 'babyhub-tools'); ?></label>
                <input type="text" id="name-meaning" name="meaning" placeholder="<?php _e('למשל: אור, אהבה, חכמה', 'babyhub-tools'); ?>">
            </div>
            
            <div class="form-group">
                <label for="starts-with"><?php _e('מתחיל באות', 'babyhub-tools'); ?></label>
                <select id="starts-with" name="starts_with">
                    <option value=""><?php _e('כל האותיות', 'babyhub-tools'); ?></option>
                    <?php 
                    $hebrew_letters = ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ז', 'ח', 'ט', 'י', 'כ', 'ל', 'מ', 'ן', 'נ', 'ס', 'ע', 'פ', 'צ', 'ק', 'ר', 'ש', 'ת'];
                    foreach ($hebrew_letters as $letter) {
                        echo "<option value='{$letter}'>{$letter}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <?php _e('חפש שמות', 'babyhub-tools'); ?>
            </button>
        </form>
        
        <div id="baby-names-results" class="tool-results"></div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Hebrew baby names database (in production this would load from JSON file)
        const namesDatabase = {
            boy: {
                hebrew: [
                    {name: 'אברהם', meaning: 'אב המון גויים', popularity: 'classic', length: 'medium'},
                    {name: 'יצחק', meaning: 'יצחק', popularity: 'classic', length: 'medium'},
                    {name: 'יעקב', meaning: 'עקב', popularity: 'classic', length: 'medium'},
                    {name: 'דוד', meaning: 'דוד', popularity: 'popular', length: 'short'},
                    {name: 'שלמה', meaning: 'שלום', popularity: 'classic', length: 'medium'},
                    {name: 'אליעזר', meaning: 'אל עזר', popularity: 'classic', length: 'long'},
                    {name: 'יהונתן', meaning: 'יה נתן', popularity: 'classic', length: 'long'},
                    {name: 'מיכאל', meaning: 'מי כאל', popularity: 'popular', length: 'medium'},
                    {name: 'גבריאל', meaning: 'גבר אל', popularity: 'popular', length: 'long'},
                    {name: 'רפאל', meaning: 'רפא אל', popularity: 'popular', length: 'medium'},
                    {name: 'אוריאל', meaning: 'אור אל', popularity: 'popular', length: 'medium'},
                    {name: 'עמנואל', meaning: 'עמנו אל', popularity: 'unique', length: 'long'}
                ],
                'modern-hebrew': [
                    {name: 'אור', meaning: 'אור', popularity: 'popular', length: 'short'},
                    {name: 'נועם', meaning: 'נעימות', popularity: 'popular', length: 'short'},
                    {name: 'יובל', meaning: 'נחל', popularity: 'popular', length: 'short'},
                    {name: 'איתן', meaning: 'חזק', popularity: 'popular', length: 'short'},
                    {name: 'עומר', meaning: 'עמר', popularity: 'popular', length: 'short'},
                    {name: 'רועי', meaning: 'רועה', popularity: 'popular', length: 'short'},
                    {name: 'תומר', meaning: 'תמר', popularity: 'popular', length: 'short'},
                    {name: 'אלעד', meaning: 'אל עד', popularity: 'unique', length: 'short'},
                    {name: 'יאיר', meaning: 'יאיר', popularity: 'popular', length: 'short'},
                    {name: 'ליאור', meaning: 'לי אור', popularity: 'popular', length: 'medium'}
                ]
            },
            girl: {
                hebrew: [
                    {name: 'שרה', meaning: 'שרה', popularity: 'classic', length: 'short'},
                    {name: 'רבקה', meaning: 'רבקה', popularity: 'classic', length: 'medium'},
                    {name: 'רחל', meaning: 'רחל', popularity: 'classic', length: 'short'},
                    {name: 'לאה', meaning: 'לאה', popularity: 'classic', length: 'short'},
                    {name: 'מרים', meaning: 'מרים', popularity: 'classic', length: 'medium'},
                    {name: 'אסתר', meaning: 'אסתר', popularity: 'classic', length: 'medium'},
                    {name: 'רות', meaning: 'רעות', popularity: 'classic', length: 'short'},
                    {name: 'נעמי', meaning: 'נעמי', popularity: 'classic', length: 'short'},
                    {name: 'חנה', meaning: 'חן', popularity: 'classic', length: 'short'},
                    {name: 'דינה', meaning: 'דין', popularity: 'classic', length: 'short'},
                    {name: 'יהודית', meaning: 'יהודית', popularity: 'classic', length: 'long'},
                    {name: 'מיכל', meaning: 'מי כאל', popularity: 'popular', length: 'medium'}
                ],
                'modern-hebrew': [
                    {name: 'נועה', meaning: 'תנועה', popularity: 'popular', length: 'short'},
                    {name: 'מאיה', meaning: 'מים', popularity: 'popular', length: 'short'},
                    {name: 'טליה', meaning: 'טל יה', popularity: 'popular', length: 'medium'},
                    {name: 'יעל', meaning: 'יעל', popularity: 'popular', length: 'short'},
                    {name: 'ליה', meaning: 'לי יה', popularity: 'popular', length: 'short'},
                    {name: 'שירה', meaning: 'שיר', popularity: 'popular', length: 'medium'},
                    {name: 'הילה', meaning: 'הילה', popularity: 'popular', length: 'medium'},
                    {name: 'אוריה', meaning: 'אור יה', popularity: 'unique', length: 'medium'},
                    {name: 'אריאל', meaning: 'אר אל', popularity: 'unique', length: 'medium'},
                    {name: 'דניאל', meaning: 'דן אל', popularity: 'unique', length: 'long'}
                ]
            }
        };
        
        $('#baby-names-form').on('submit', function(e) {
            e.preventDefault();
            
            const gender = $('#name-gender').val();
            const origin = $('#name-origin').val();
            const length = $('#name-length').val();
            const popularity = $('#name-popularity').val();
            const meaning = $('#name-meaning').val().toLowerCase();
            const startsWith = $('#starts-with').val();
            
            let filteredNames = [];
            
            // Get names based on gender
            if (gender === 'unisex') {
                // Combine boy and girl names for unisex search
                Object.keys(namesDatabase.boy).forEach(originKey => {
                    if (!origin || originKey === origin) {
                        filteredNames = [...filteredNames, ...namesDatabase.boy[originKey]];
                    }
                });
                Object.keys(namesDatabase.girl).forEach(originKey => {
                    if (!origin || originKey === origin) {
                        filteredNames = [...filteredNames, ...namesDatabase.girl[originKey]];
                    }
                });
            } else if (gender && namesDatabase[gender]) {
                Object.keys(namesDatabase[gender]).forEach(originKey => {
                    if (!origin || originKey === origin) {
                        filteredNames = [...filteredNames, ...namesDatabase[gender][originKey]];
                    }
                });
            }
            
            // Apply filters
            if (length) {
                filteredNames = filteredNames.filter(nameObj => nameObj.length === length);
            }
            
            if (popularity) {
                filteredNames = filteredNames.filter(nameObj => nameObj.popularity === popularity);
            }
            
            if (meaning) {
                filteredNames = filteredNames.filter(nameObj => 
                    nameObj.meaning.toLowerCase().includes(meaning)
                );
            }
            
            if (startsWith) {
                filteredNames = filteredNames.filter(nameObj => 
                    nameObj.name.startsWith(startsWith)
                );
            }
            
            // Remove duplicates
            filteredNames = filteredNames.filter((name, index, self) => 
                index === self.findIndex(n => n.name === name.name)
            );
            
            // Shuffle and limit results
            filteredNames = filteredNames.sort(() => Math.random() - 0.5).slice(0, 20);
            
            let resultHTML = '';
            
            if (filteredNames.length === 0) {
                resultHTML = `
                    <div class="calculation-result warning">
                        <h4><?php _e('לא נמצאו שמות', 'babyhub-tools'); ?></h4>
                        <p><?php _e('נסה לשנות את הקריטריונים או להוסיר חלק מהמסננים', 'babyhub-tools'); ?></p>
                    </div>
                `;
            } else {
                resultHTML = `
                    <div class="calculation-result success">
                        <h4><?php _e('שמות מתאימים', 'babyhub-tools'); ?> (${filteredNames.length})</h4>
                        
                        <div class="names-grid">
                            ${filteredNames.map(nameObj => `
                                <div class="name-card">
                                    <div class="name-header">
                                        <h5 class="name-title">${nameObj.name}</h5>
                                        <span class="popularity-badge ${nameObj.popularity}">${
                                            nameObj.popularity === 'popular' ? '<?php _e('פופולרי', 'babyhub-tools'); ?>' :
                                            nameObj.popularity === 'unique' ? '<?php _e('ייחודי', 'babyhub-tools'); ?>' :
                                            '<?php _e('קלאסי', 'babyhub-tools'); ?>'
                                        }</span>
                                    </div>
                                    <div class="name-meaning">
                                        <strong><?php _e('משמעות:', 'babyhub-tools'); ?></strong> ${nameObj.meaning}
                                    </div>
                                    <div class="name-actions">
                                        <button class="btn-small favorite-name" data-name="${nameObj.name}">
                                            ♡ <?php _e('מועדף', 'babyhub-tools'); ?>
                                        </button>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        
                        <div class="names-actions">
                            <button id="get-more-names" class="btn btn-secondary">
                                <?php _e('עוד שמות', 'babyhub-tools'); ?>
                            </button>
                            <button id="export-favorites" class="btn btn-primary">
                                <?php _e('ייצא מועדפים', 'babyhub-tools'); ?>
                            </button>
                        </div>
                    </div>
                `;
            }
            
            $('#baby-names-results').html(resultHTML);
        });
        
        // Favorite functionality
        $(document).on('click', '.favorite-name', function() {
            const $btn = $(this);
            const name = $btn.data('name');
            
            if ($btn.hasClass('favorited')) {
                $btn.removeClass('favorited').html('♡ <?php _e('מועדף', 'babyhub-tools'); ?>');
                // Remove from favorites
            } else {
                $btn.addClass('favorited').html('❤ <?php _e('נוסף למועדפים', 'babyhub-tools'); ?>');
                // Add to favorites
            }
        });
    });
    </script>
    <?php
}

// Week-by-Week Tracker Stub
function babyhub_week_tracker_stub() {
    ?>
    <div class="babyhub-tool-container" id="week-tracker-stub">
        <div class="tool-header">
            <h3><?php _e('מעקב שבועי אחרי הריון', 'babyhub-tools'); ?></h3>
            <p><?php _e('עקבי אחרי ההריון שלך שבוע אחר שבוע עם מידע מותאם אישית', 'babyhub-tools'); ?></p>
        </div>
        
        <div class="tracker-preview">
            <div class="preview-content">
                <h4><?php _e('בקרוב - מעקב הריון מתקדם!', 'babyhub-tools'); ?></h4>
                <p><?php _e('אנחנו מפתחים עבורך מערכת מעקב הריון מתקדמת שתכלול:', 'babyhub-tools'); ?></p>
                
                <ul class="features-list">
                    <li>✨ <?php _e('מעקב שבועי מותאם אישית', 'babyhub-tools'); ?></li>
                    <li>📊 <?php _e('גרפים של התפתחות התינוק', 'babyhub-tools'); ?></li>
                    <li>📝 <?php _e('יומן הריון אישי', 'babyhub-tools'); ?></li>
                    <li>🔔 <?php _e('תזכורות לבדיקות ומועדים חשובים', 'babyhub-tools'); ?></li>
                    <li>📱 <?php _e('עדכונים שבועיים למייל', 'babyhub-tools'); ?></li>
                    <li>🤱 <?php _e('קהילת אמהות באותו שלב', 'babyhub-tools'); ?></li>
                </ul>
                
                <div class="coming-soon-actions">
                    <button class="btn btn-primary notify-me">
                        <?php _e('עדכנו אותי כשיהיה מוכן', 'babyhub-tools'); ?>
                    </button>
                </div>
            </div>
            
            <div class="preview-mockup">
                <div class="mockup-phone">
                    <div class="mockup-screen">
                        <div class="mockup-content">
                            <div class="week-display">
                                <span class="week-number">20</span>
                                <span class="week-label"><?php _e('שבוע', 'babyhub-tools'); ?></span>
                            </div>
                            <div class="baby-size">
                                <span class="size-emoji">🍌</span>
                                <span class="size-text"><?php _e('גודל בננה', 'babyhub-tools'); ?></span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('.notify-me').on('click', function() {
            const email = prompt('<?php _e('הזיני את כתובת האימייל שלך לעדכונים:', 'babyhub-tools'); ?>');
            if (email && email.includes('@')) {
                alert('<?php _e('תודה! נעדכן אותך ברגע שהמעקב יהיה מוכן', 'babyhub-tools'); ?>');
                // In production, this would save the email to a mailing list
            }
        });
    });
    </script>
    <?php
}

// Add shortcodes for the remaining calculators
add_shortcode('babyhub_height_predictor', 'babyhub_height_predictor');
add_shortcode('babyhub_zodiac_calculator', 'babyhub_zodiac_calculator');
add_shortcode('babyhub_baby_names_finder', 'babyhub_baby_names_finder');
add_shortcode('babyhub_week_tracker_stub', 'babyhub_week_tracker_stub');

?>