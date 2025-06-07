<?php
/**
 * Birth Plan Worksheet Tool Template Part
 * Baby-Hub Hebrew RTL Theme
 */
?>

<div class="tool-form birth-plan-form">
    <form id="birth-plan-form" class="calculator-form" novalidate>
        <div class="form-header">
            <h3><?php _e('תוכנית לידה מותאמת אישית', 'babyhub'); ?></h3>
            <p class="form-description">
                <?php _e('צרי תוכנית לידה מפורטת שתעזור לך להעביר את רצונותיך לצוות הרפואי', 'babyhub'); ?>
            </p>
        </div>

        <div class="form-body">
            
            <!-- Personal Information -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-user"></i>
                    <?php _e('פרטים אישיים', 'babyhub'); ?>
                </h4>
                
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="mother-name" class="form-label"><?php _e('שם האמא', 'babyhub'); ?></label>
                        <input type="text" id="mother-name" name="mother_name" class="form-control" />
                    </div>
                    <div class="form-group col-6">
                        <label for="partner-name" class="form-label"><?php _e('שם הבן/בת הזוג', 'babyhub'); ?></label>
                        <input type="text" id="partner-name" name="partner_name" class="form-control" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="due-date" class="form-label"><?php _e('תאריך לידה משוער', 'babyhub'); ?></label>
                        <input type="date" id="due-date" name="due_date" class="form-control" />
                    </div>
                    <div class="form-group col-6">
                        <label for="birth-location" class="form-label"><?php _e('מקום הלידה', 'babyhub'); ?></label>
                        <input type="text" id="birth-location" name="birth_location" class="form-control" placeholder="<?php _e('שם בית החולים/בית הלידה', 'babyhub'); ?>" />
                    </div>
                </div>
            </div>

            <!-- Labor Preferences -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-heart"></i>
                    <?php _e('העדפות ציפים', 'babyhub'); ?>
                </h4>
                
                <div class="preferences-grid">
                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('סביבת הלידה', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="dim-lights">
                                <span class="checkmark"></span>
                                <?php _e('תאורה עמומה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="music">
                                <span class="checkmark"></span>
                                <?php _e('מוזיקה רגועה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="aromatherapy">
                                <span class="checkmark"></span>
                                <?php _e('ארומה טרפיה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="private-room">
                                <span class="checkmark"></span>
                                <?php _e('חדר פרטי', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('ניהול כאב', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="natural-pain-relief">
                                <span class="checkmark"></span>
                                <?php _e('הקלת כאב טבעית', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="epidural">
                                <span class="checkmark"></span>
                                <?php _e('חסר חושים אפידורלי', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="gas-air">
                                <span class="checkmark"></span>
                                <?php _e('גז וחמצן', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="water-birth">
                                <span class="checkmark"></span>
                                <?php _e('לידה במים', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('עמדות לידה', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="freedom-movement">
                                <span class="checkmark"></span>
                                <?php _e('חופש תנועה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="birth-ball">
                                <span class="checkmark"></span>
                                <?php _e('כדור לידה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="standing-birth">
                                <span class="checkmark"></span>
                                <?php _e('לידה בעמידה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="squatting-birth">
                                <span class="checkmark"></span>
                                <?php _e('לידה בכריעה', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('נוכחות בלידה', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="partner-present">
                                <span class="checkmark"></span>
                                <?php _e('בן/בת זוג נוכח/ת', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="doula-present">
                                <span class="checkmark"></span>
                                <?php _e('דולה נוכחת', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="family-present">
                                <span class="checkmark"></span>
                                <?php _e('בני משפחה נוכחים', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="photography">
                                <span class="checkmark"></span>
                                <?php _e('צילום הלידה', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Preferences -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-medical"></i>
                    <?php _e('העדפות רפואיות', 'babyhub'); ?>
                </h4>
                
                <div class="preferences-grid">
                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('התערבויות רפואיות', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="minimal-intervention">
                                <span class="checkmark"></span>
                                <?php _e('התערבות מינימלית', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="no-episiotomy">
                                <span class="checkmark"></span>
                                <?php _e('ללא אפיזיוטומיה', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="delayed-cord-clamping">
                                <span class="checkmark"></span>
                                <?php _e('דחיית חיתוך הטבור', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="skin-to-skin">
                                <span class="checkmark"></span>
                                <?php _e('מגע עור בעור מיידי', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('ניטור', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="intermittent-monitoring">
                                <span class="checkmark"></span>
                                <?php _e('ניטור לסירוגין', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="wireless-monitoring">
                                <span class="checkmark"></span>
                                <?php _e('ניטור אלחוטי', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="freedom-during-monitoring">
                                <span class="checkmark"></span>
                                <?php _e('חופש תנועה בזמן ניטור', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Preferences -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-warning"></i>
                    <?php _e('העדפות למצבי חירום', 'babyhub'); ?>
                </h4>
                
                <div class="preference-group">
                    <h5 class="group-title"><?php _e('אם יידרש ניתוח קיסרי', 'babyhub'); ?></h5>
                    <div class="checkbox-list">
                        <label class="checkbox-item">
                            <input type="checkbox" name="preferences[]" value="partner-in-cesarian">
                            <span class="checkmark"></span>
                            <?php _e('בן/בת הזוג נוכח/ת בחדר הניתוח', 'babyhub'); ?>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="preferences[]" value="clear-screen">
                            <span class="checkmark"></span>
                            <?php _e('מסך שקוף לראיית התינוק', 'babyhub'); ?>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="preferences[]" value="immediate-contact-cesarian">
                            <span class="checkmark"></span>
                            <?php _e('מגע מיידי עם התינוק אם אפשר', 'babyhub'); ?>
                        </label>
                    </div>
                </div>
            </div>

            <!-- After Birth -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-baby"></i>
                    <?php _e('אחרי הלידה', 'babyhub'); ?>
                </h4>
                
                <div class="preferences-grid">
                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('הנקה וטיפול בתינוק', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="immediate-breastfeeding">
                                <span class="checkmark"></span>
                                <?php _e('הנקה מיידית', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="no-formula">
                                <span class="checkmark"></span>
                                <?php _e('ללא תרכובת מלאכותית', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="rooming-in">
                                <span class="checkmark"></span>
                                <?php _e('התינוק נשאר בחדר', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="delayed-procedures">
                                <span class="checkmark"></span>
                                <?php _e('דחיית פעולות רוטיניות', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="preference-group">
                        <h5 class="group-title"><?php _e('בדיקות ותהליכים', 'babyhub'); ?></h5>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="vitamin-k">
                                <span class="checkmark"></span>
                                <?php _e('ויטמין K', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="eye-ointment">
                                <span class="checkmark"></span>
                                <?php _e('משחה לעיניים', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="newborn-bath">
                                <span class="checkmark"></span>
                                <?php _e('רחצה ראשונה בנוכחותי', 'babyhub'); ?>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="preferences[]" value="genetic-testing">
                                <span class="checkmark"></span>
                                <?php _e('בדיקות גנטיות', 'babyhub'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Requests -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="icon-note"></i>
                    <?php _e('בקשות נוספות', 'babyhub'); ?>
                </h4>
                
                <div class="form-group">
                    <label for="additional-requests" class="form-label"><?php _e('בקשות או הערות נוספות', 'babyhub'); ?></label>
                    <textarea 
                        id="additional-requests" 
                        name="additional_requests" 
                        class="form-control" 
                        rows="6"
                        placeholder="<?php _e('כאן תוכלי להוסיף כל בקשה או הערה נוספת שחשובה לך...', 'babyhub'); ?>"
                    ></textarea>
                    <small class="form-help">
                        <?php _e('למשל: העדפות תזונתיות, רגישויות, חשש מתרופות מסוימות, מסורות דתיות או תרבותיות', 'babyhub'); ?>
                    </small>
                </div>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">
                <i class="icon-document"></i>
                <?php _e('צרי תוכנית לידה', 'babyhub'); ?>
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="icon-refresh"></i>
                <?php _e('איפוס הטופס', 'babyhub'); ?>
            </button>
        </div>
    </form>

    <!-- Results Container -->
    <div id="birth-plan-results" class="results-container" style="display: none;">
        <!-- Results will be populated here -->
    </div>
</div>

<!-- Information Section -->
<div class="tool-info-section">
    <div class="info-tabs">
        <button class="info-tab active" data-tab="about">
            <?php _e('מה זה תוכנית לידה?', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="benefits">
            <?php _e('יתרונות', 'babyhub'); ?>
        </button>
        <button class="info-tab" data-tab="tips">
            <?php _e('טיפים', 'babyhub'); ?>
        </button>
    </div>

    <div class="info-content">
        <div id="about" class="tab-content active">
            <h4><?php _e('מה זו תוכנית לידה?', 'babyhub'); ?></h4>
            <p><?php _e('תוכנית לידה היא מסמך המפרט את העדפותיך והרצונות שלך לגבי הלידה. היא עוזרת לך לחשוב מראש על האפשרויות השונות ולהעביר את רצונותיך לצוות הרפואי.', 'babyhub'); ?></p>
            
            <h4><?php _e('למה חשוב לכתוב תוכנית לידה?', 'babyhub'); ?></h4>
            <p><?php _e('תוכנית לידה עוזרת לך להרגיש יותר מוכנה ובשליטה על הלידה שלך. היא גם מסייעת לצוות הרפואי להבין את העדפותיך ולתת לך את החוויה הטובה ביותר.', 'babyhub'); ?></p>
        </div>

        <div id="benefits" class="tab-content">
            <h4><?php _e('יתרונות של תוכנית לידה', 'babyhub'); ?></h4>
            <ul>
                <li><?php _e('עוזרת לך לחשוב מראש על כל האפשרויות', 'babyhub'); ?></li>
                <li><?php _e('מקלה על התקשורת עם הצוות הרפואי', 'babyhub'); ?></li>
                <li><?php _e('מעניקה תחושת שליטה וביטחון', 'babyhub'); ?></li>
                <li><?php _e('מסייעת לבן/בת הזוג להבין את רצונותיך', 'babyhub'); ?></li>
                <li><?php _e('מפחיתה חרדה וחוסר ודאות', 'babyhub'); ?></li>
            </ul>
        </div>

        <div id="tips" class="tab-content">
            <h4><?php _e('טיפים לכתיבת תוכנית לידה מוצלחת', 'babyhub'); ?></h4>
            <ul>
                <li><?php _e('דוני בתוכנית עם הרופא והמיילדת שלך', 'babyhub'); ?></li>
                <li><?php _e('היי גמישה - לפעמים דברים משתנים בלידה', 'babyhub'); ?></li>
                <li><?php _e('תני עותק לכל מי שיהיה נוכח בלידה', 'babyhub'); ?></li>
                <li><?php _e('כתבי בצורה חיובית - "אני מעדיפה" במקום "אני לא רוצה"', 'babyhub'); ?></li>
                <li><?php _e('הכיני גם תוכנית למקרה של ניתוח קיסרי', 'babyhub'); ?></li>
            </ul>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Info tabs
    $('.info-tab').on('click', function() {
        const tab = $(this).data('tab');
        
        $('.info-tab').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-content').removeClass('active');
        $('#' + tab).addClass('active');
    });

    // Form submission
    $('#birth-plan-form').on('submit', function(e) {
        e.preventDefault();
        
        // Collect form data
        const formData = new FormData(this);
        const preferences = [];
        
        // Collect all checked preferences
        $('input[name="preferences[]"]:checked').each(function() {
            preferences.push({
                value: $(this).val(),
                text: $(this).parent().text().trim()
            });
        });
        
        // Collect personal information
        const personalInfo = {
            motherName: formData.get('mother_name'),
            partnerName: formData.get('partner_name'),
            dueDate: formData.get('due_date'),
            birthLocation: formData.get('birth_location')
        };
        
        const additionalRequests = formData.get('additional_requests');
        
        // Show loading
        $(this).addClass('loading');
        $('.btn[type="submit"]').prop('disabled', true);

        // Generate birth plan
        setTimeout(() => {
            generateBirthPlan(personalInfo, preferences, additionalRequests);
            
            $(this).removeClass('loading');
            $('.btn[type="submit"]').prop('disabled', false);
        }, 1500);
    });

    function generateBirthPlan(personalInfo, preferences, additionalRequests) {
        const currentDate = new Date().toLocaleDateString('he-IL');
        const formattedDueDate = personalInfo.dueDate ? 
            new Date(personalInfo.dueDate).toLocaleDateString('he-IL') : 
            '<?php _e("לא צוין", "babyhub"); ?>';
        
        // Group preferences by category
        const groupedPreferences = groupPreferencesByCategory(preferences);
        
        const resultHTML = `
            <div class="calculation-result success">
                <div class="birth-plan-document">
                    <div class="document-header">
                        <h2><?php _e("תוכנית הלידה שלי", "babyhub"); ?></h2>
                        <div class="document-meta">
                            <div class="meta-item">
                                <strong><?php _e("תאריך יצירה:", "babyhub"); ?></strong> ${currentDate}
                            </div>
                            <div class="meta-item">
                                <strong><?php _e("תאריך לידה משוער:", "babyhub"); ?></strong> ${formattedDueDate}
                            </div>
                        </div>
                    </div>
                    
                    ${generatePersonalInfoSection(personalInfo)}
                    ${generatePreferencesSection(groupedPreferences)}
                    ${generateAdditionalRequestsSection(additionalRequests)}
                    ${generateClosingSection()}
                    
                    <div class="document-footer">
                        <p class="footer-note">
                            <?php _e("תוכנית זו נוצרה באתר Baby-Hub ומבטאת את העדפותיי האישיות ללידה", "babyhub"); ?>
                        </p>
                    </div>
                </div>
                
                <div class="plan-actions">
                    <button type="button" class="btn btn-primary" onclick="printBirthPlan()">
                        <i class="icon-print"></i>
                        <?php _e("הדפס תוכנית", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="downloadBirthPlan()">
                        <i class="icon-download"></i>
                        <?php _e("הורד כ-PDF", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-outline" onclick="shareBirthPlan()">
                        <i class="icon-share"></i>
                        <?php _e("שתף", "babyhub"); ?>
                    </button>
                    <button type="button" class="btn btn-outline" onclick="editBirthPlan()">
                        <i class="icon-edit"></i>
                        <?php _e("ערוך", "babyhub"); ?>
                    </button>
                </div>
            </div>
        `;
        
        $('#birth-plan-results').html(resultHTML).slideDown();
        
        // Scroll to results
        $('html, body').animate({
            scrollTop: $('#birth-plan-results').offset().top - 100
        }, 800);
    }

    function generatePersonalInfoSection(personalInfo) {
        if (!personalInfo.motherName && !personalInfo.partnerName && !personalInfo.birthLocation) {
            return '';
        }
        
        return `
            <div class="plan-section">
                <h3 class="section-title"><?php _e("פרטים אישיים", "babyhub"); ?></h3>
                <div class="section-content">
                    ${personalInfo.motherName ? `<p><strong><?php _e("שם האמא:", "babyhub"); ?></strong> ${personalInfo.motherName}</p>` : ''}
                    ${personalInfo.partnerName ? `<p><strong><?php _e("שם בן/בת הזוג:", "babyhub"); ?></strong> ${personalInfo.partnerName}</p>` : ''}
                    ${personalInfo.birthLocation ? `<p><strong><?php _e("מקום הלידה:", "babyhub"); ?></strong> ${personalInfo.birthLocation}</p>` : ''}
                </div>
            </div>
        `;
    }

    function generatePreferencesSection(groupedPreferences) {
        let html = '';
        
        if (Object.keys(groupedPreferences).length > 0) {
            html += '<div class="plan-section"><h3 class="section-title"><?php _e("העדפותיי ללידה", "babyhub"); ?></h3>';
            
            for (const [category, prefs] of Object.entries(groupedPreferences)) {
                if (prefs.length > 0) {
                    html += `<div class="preference-category">`;
                    html += `<h4 class="category-title">${getCategoryTitle(category)}</h4>`;
                    html += `<ul class="preferences-list">`;
                    
                    prefs.forEach(pref => {
                        html += `<li class="preference-item">✓ ${pref.text}</li>`;
                    });
                    
                    html += `</ul></div>`;
                }
            }
            
            html += '</div>';
        }
        
        return html;
    }

    function generateAdditionalRequestsSection(additionalRequests) {
        if (!additionalRequests || additionalRequests.trim() === '') {
            return '';
        }
        
        return `
            <div class="plan-section">
                <h3 class="section-title"><?php _e("בקשות נוספות", "babyhub"); ?></h3>
                <div class="section-content">
                    <p>${additionalRequests.replace(/\n/g, '<br>')}</p>
                </div>
            </div>
        `;
    }

    function generateClosingSection() {
        return `
            <div class="plan-section">
                <h3 class="section-title"><?php _e("הערה חשובה", "babyhub"); ?></h3>
                <div class="section-content">
                    <p><?php _e("אני מבינה שתוכנית לידה היא מדריך לעדפותיי ולא הוראות מחייבות. אני מעוניינת לעבוד יחד עם הצוות הרפואי כדי להבטיח את בטיחותי ובטיחות התינוק שלי, ואני פתוחה לשינויים אם הם נדרשים מבחינה רפואית.", "babyhub"); ?></p>
                    <br>
                    <p><strong><?php _e("תודה לכם על כבודכם לעדפותיי ועל הטיפול המסור.", "babyhub"); ?></strong></p>
                </div>
            </div>
        `;
    }

    function groupPreferencesByCategory(preferences) {
        const categories = {
            environment: [],
            pain: [],
            positions: [],
            presence: [],
            medical: [],
            monitoring: [],
            emergency: [],
            afterbirth: [],
            procedures: []
        };
        
        preferences.forEach(pref => {
            const value = pref.value;
            
            if (['dim-lights', 'music', 'aromatherapy', 'private-room'].includes(value)) {
                categories.environment.push(pref);
            } else if (['natural-pain-relief', 'epidural', 'gas-air', 'water-birth'].includes(value)) {
                categories.pain.push(pref);
            } else if (['freedom-movement', 'birth-ball', 'standing-birth', 'squatting-birth'].includes(value)) {
                categories.positions.push(pref);
            } else if (['partner-present', 'doula-present', 'family-present', 'photography'].includes(value)) {
                categories.presence.push(pref);
            } else if (['minimal-intervention', 'no-episiotomy', 'delayed-cord-clamping', 'skin-to-skin'].includes(value)) {
                categories.medical.push(pref);
            } else if (['intermittent-monitoring', 'wireless-monitoring', 'freedom-during-monitoring'].includes(value)) {
                categories.monitoring.push(pref);
            } else if (['partner-in-cesarian', 'clear-screen', 'immediate-contact-cesarian'].includes(value)) {
                categories.emergency.push(pref);
            } else if (['immediate-breastfeeding', 'no-formula', 'rooming-in', 'delayed-procedures'].includes(value)) {
                categories.afterbirth.push(pref);
            } else if (['vitamin-k', 'eye-ointment', 'newborn-bath', 'genetic-testing'].includes(value)) {
                categories.procedures.push(pref);
            }
        });
        
        // Remove empty categories
        Object.keys(categories).forEach(key => {
            if (categories[key].length === 0) {
                delete categories[key];
            }
        });
        
        return categories;
    }

    function getCategoryTitle(category) {
        const titles = {
            environment: '<?php _e("סביבת הלידה", "babyhub"); ?>',
            pain: '<?php _e("ניהול כאב", "babyhub"); ?>',
            positions: '<?php _e("עמדות לידה", "babyhub"); ?>',
            presence: '<?php _e("נוכחות בלידה", "babyhub"); ?>',
            medical: '<?php _e("התערבויות רפואיות", "babyhub"); ?>',
            monitoring: '<?php _e("ניטור", "babyhub"); ?>',
            emergency: '<?php _e("מצבי חירום", "babyhub"); ?>',
            afterbirth: '<?php _e("אחרי הלידה", "babyhub"); ?>',
            procedures: '<?php _e("בדיקות ותהליכים", "babyhub"); ?>'
        };
        
        return titles[category] || category;
    }

    // Global functions for result actions
    window.printBirthPlan = function() {
        const printWindow = window.open('', '_blank');
        const content = $('.birth-plan-document').html();
        
        printWindow.document.write(`
            <html dir="rtl">
            <head>
                <title><?php _e("תוכנית לידה", "babyhub"); ?></title>
                <meta charset="utf-8">
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        padding: 20px; 
                        direction: rtl; 
                        line-height: 1.6;
                    }
                    h2, h3, h4 { color: #FF6B9D; margin-top: 1.5em; }
                    .plan-section { margin-bottom: 2em; }
                    .preferences-list { list-style: none; padding-right: 20px; }
                    .preference-item { margin-bottom: 5px; }
                    .document-meta { margin-bottom: 2em; }
                    .footer-note { font-style: italic; color: #666; margin-top: 2em; }
                    @media print { 
                        body { padding: 0; }
                        .plan-actions { display: none; }
                    }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
        
        printWindow.document.close();
        printWindow.print();
    };

    window.downloadBirthPlan = function() {
        alert('<?php _e("תכונת הורדה כ-PDF תהיה זמינה בקרוב", "babyhub"); ?>');
    };

    window.shareBirthPlan = function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php _e("תוכנית הלידה שלי", "babyhub"); ?>',
                text: '<?php _e("יצרתי תוכנית לידה באתר Baby-Hub", "babyhub"); ?>',
                url: window.location.href
            });
        } else {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                alert('<?php _e("הקישור הועתק ללוח", "babyhub"); ?>');
            });
        }
    };

    window.editBirthPlan = function() {
        $('#birth-plan-results').slideUp();
        $('html, body').animate({
            scrollTop: $('#birth-plan-form').offset().top - 100
        }, 500);
    };
});
</script>

<style>
/* Birth Plan Specific Styles */
.birth-plan-form {
    max-width: 900px;
    margin: 0 auto;
}

/* Form Sections */
.form-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.section-title {
    display: flex;
    align-items: center;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #FF6B9D;
}

.section-title i {
    margin-left: 0.5rem;
    font-size: 1.2rem;
    color: #FF6B9D;
}

/* Preferences Grid */
.preferences-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.preference-group {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
}

.group-title {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.checkbox-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.checkbox-item:hover {
    background: rgba(255, 107, 157, 0.1);
}

.checkbox-item input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-left: 0.75rem;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.checkbox-item input[type="checkbox"]:checked + .checkmark {
    background: #FF6B9D;
    border-color: #FF6B9D;
}

.checkbox-item input[type="checkbox"]:checked + .checkmark::after {
    content: "✓";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-weight: bold;
    font-size: 0.8rem;
}

/* Birth Plan Document */
.birth-plan-document {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
}

.document-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #FF6B9D;
}

.document-header h2 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 2rem;
}

.document-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    color: #666;
}

.plan-section {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.plan-section:last-child {
    border-bottom: none;
}

.plan-section .section-title {
    color: #FF6B9D;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    border-bottom: 1px solid #FF6B9D;
}

.section-content {
    line-height: 1.7;
}

.preference-category {
    margin-bottom: 1.5rem;
}

.category-title {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.preferences-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.preference-item {
    margin-bottom: 0.5rem;
    padding: 0.25rem 0;
    color: #333;
}

.document-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    text-align: center;
}

.footer-note {
    font-style: italic;
    color: #666;
    font-size: 0.9rem;
}

/* Plan Actions */
.plan-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Responsive Design */
@media (max-width: 768px) {
    .preferences-grid {
        grid-template-columns: 1fr;
    }
    
    .birth-plan-document {
        padding: 2rem;
        max-height: 500px;
    }
    
    .document-meta {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    
    .plan-actions {
        flex-direction: column;
    }
    
    .plan-actions .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .form-section {
        padding: 1.5rem;
    }
    
    .preference-group {
        padding: 1rem;
    }
    
    .birth-plan-document {
        padding: 1.5rem;
        max-height: 400px;
    }
    
    .document-header h2 {
        font-size: 1.5rem;
    }
}

/* Print Styles */
@media print {
    .plan-actions {
        display: none;
    }
    
    .birth-plan-document {
        box-shadow: none;
        border: none;
        max-height: none;
        overflow: visible;
    }
}
</style>