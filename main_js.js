/**
 * Baby-Hub Main JavaScript
 * Hebrew RTL WordPress Theme
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initMobileMenu();
        initToolCalculators();
        initFormValidation();
        initSmoothScrolling();
        initAccessibility();
        initLazyLoading();
    });

    // Mobile Menu Functionality
    function initMobileMenu() {
        const $mobileToggle = $('.mobile-menu-toggle');
        const $mobileNav = $('.mobile-nav');
        const $mobileClose = $('.mobile-nav-close');
        const $body = $('body');

        $mobileToggle.on('click', function(e) {
            e.preventDefault();
            $mobileNav.addClass('active');
            $body.addClass('mobile-menu-open');
            
            // Focus management
            $mobileClose.focus();
        });

        $mobileClose.on('click', function(e) {
            e.preventDefault();
            closeMobileMenu();
        });

        // Close on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $mobileNav.hasClass('active')) {
                closeMobileMenu();
            }
        });

        // Close on outside click
        $mobileNav.on('click', function(e) {
            if (e.target === this) {
                closeMobileMenu();
            }
        });

        function closeMobileMenu() {
            $mobileNav.removeClass('active');
            $body.removeClass('mobile-menu-open');
            $mobileToggle.focus();
        }
    }

    // Tool Calculators
    function initToolCalculators() {
        // Ovulation Calculator
        $('#ovulation-form').on('submit', function(e) {
            e.preventDefault();
            calculateOvulation($(this));
        });

        // Due Date Calculator
        $('#due-date-form').on('submit', function(e) {
            e.preventDefault();
            calculateDueDate($(this));
        });

        // Chinese Gender Predictor
        $('#gender-form').on('submit', function(e) {
            e.preventDefault();
            predictGender($(this));
        });

        // Weight Gain Calculator
        $('#weight-gain-form').on('submit', function(e) {
            e.preventDefault();
            calculateWeightGain($(this));
        });

        // Baby Names Finder
        $('#baby-names-form').on('submit', function(e) {
            e.preventDefault();
            findBabyNames($(this));
        });

        // Birth Plan Worksheet
        $('#birth-plan-form').on('submit', function(e) {
            e.preventDefault();
            generateBirthPlan($(this));
        });

        // Registry Manager
        $('#registry-form').on('submit', function(e) {
            e.preventDefault();
            manageRegistry($(this));
        });

        // Baby Costs Calculator
        $('#baby-costs-form').on('submit', function(e) {
            e.preventDefault();
            calculateBabyCosts($(this));
        });

        // Zodiac Calculator
        $('#zodiac-form').on('submit', function(e) {
            e.preventDefault();
            calculateZodiac($(this));
        });

        // Height Predictor
        $('#height-form').on('submit', function(e) {
            e.preventDefault();
            predictHeight($(this));
        });
    }

    // Ovulation Calculator Function
    function calculateOvulation($form) {
        const formData = new FormData($form[0]);
        formData.append('action', 'calculate_ovulation');
        formData.append('nonce', babyhub_ajax.nonce);

        showLoading($form);

        $.ajax({
            url: babyhub_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                hideLoading($form);
                if (response.success) {
                    displayOvulationResults(response.data);
                } else {
                    showError($form, response.data || babyhub_ajax.strings.error);
                }
            },
            error: function() {
                hideLoading($form);
                showError($form, babyhub_ajax.strings.error);
            }
        });
    }

    // Due Date Calculator Function
    function calculateDueDate($form) {
        const formData = new FormData($form[0]);
        formData.append('action', 'calculate_due_date');
        formData.append('nonce', babyhub_ajax.nonce);

        showLoading($form);

        $.ajax({
            url: babyhub_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                hideLoading($form);
                if (response.success) {
                    displayDueDateResults(response.data);
                } else {
                    showError($form, response.data || babyhub_ajax.strings.error);
                }
            },
            error: function() {
                hideLoading($form);
                showError($form, babyhub_ajax.strings.error);
            }
        });
    }

    // Gender Prediction Function
    function predictGender($form) {
        const motherAge = parseInt($form.find('#mother-age').val());
        const conceptionMonth = parseInt($form.find('#conception-month').val());

        if (!motherAge || !conceptionMonth) {
            showError($form, 'אנא מלא את כל השדות');
            return;
        }

        const prediction = ((motherAge + conceptionMonth) % 2 === 0) ? 'בת' : 'בן';
        const confidence = Math.floor(Math.random() * 20) + 70; // 70-90% confidence

        const resultHTML = `
            <div class="calculation-result success">
                <h3>תחזית מין התינוק</h3>
                <div class="result-card">
                    <div class="prediction-result">
                        <span class="prediction-icon">${prediction === 'בן' ? '👶🏻' : '👶🏻'}</span>
                        <h4>התחזית: ${prediction}</h4>
                        <p>רמת ביטחון: ${confidence}%</p>
                    </div>
                    <div class="disclaimer">
                        <p><small>* זוהי תחזית מסורתית בלבד ואינה מבוססת על בסיס מדעי</small></p>
                    </div>
                </div>
            </div>
        `;

        $('#gender-results').html(resultHTML);
    }

    // Weight Gain Calculator Function
    function calculateWeightGain($form) {
        const preWeight = parseFloat($form.find('#pre-weight').val());
        const currentWeight = parseFloat($form.find('#current-weight').val());
        const height = parseFloat($form.find('#height').val());
        const weeks = parseInt($form.find('#weeks').val());

        if (!preWeight || !currentWeight || !height || !weeks) {
            showError($form, 'אנא מלא את כל השדות');
            return;
        }

        const bmi = preWeight / ((height / 100) ** 2);
        let recommendedGain;
        let category;

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

        const currentGain = currentWeight - preWeight;
        const weeklyRecommended = recommendedGain[1] / 40;
        const expectedGain = weeklyRecommended * weeks;

        let status = '';
        if (currentGain < expectedGain - 2) {
            status = 'מתחת לטווח המומלץ';
        } else if (currentGain > expectedGain + 2) {
            status = 'מעל הטווח המומלץ';
        } else {
            status = 'בטווח המומלץ';
        }

        const resultHTML = `
            <div class="calculation-result success">
                <h3>תוצאות חישוב עלייה במשקל</h3>
                <div class="weight-results">
                    <div class="result-item">
                        <strong>BMI לפני הריון:</strong> ${bmi.toFixed(1)} (${category})
                    </div>
                    <div class="result-item">
                        <strong>עלייה נוכחית:</strong> ${currentGain.toFixed(1)} ק"ג
                    </div>
                    <div class="result-item">
                        <strong>טווח מומלץ לכל ההריון:</strong> ${recommendedGain[0]}-${recommendedGain[1]} ק"ג
                    </div>
                    <div class="result-item">
                        <strong>סטטוס:</strong> <span class="status-${status.includes('בטווח') ? 'good' : 'warning'}">${status}</span>
                    </div>
                </div>
            </div>
        `;

        $('#weight-gain-results').html(resultHTML);
    }

    // Baby Names Finder Function
    function findBabyNames($form) {
        const gender = $form.find('#name-gender').val();
        const origin = $form.find('#name-origin').val();
        const style = $form.find('#name-style').val();

        const namesDB = {
            boy: {
                hebrew: ['אוריאל', 'יונתן', 'דניאל', 'מיכאל', 'גבריאל', 'רפאל', 'עמנואל'],
                international: ['דוד', 'אלכסנדר', 'מקס', 'ליאו', 'ארתור', 'אדם', 'נועם'],
                modern: ['רוי', 'גיא', 'יובל', 'איתי', 'עומרי', 'אורי', 'תומר'],
                traditional: ['אברהם', 'יצחק', 'יעקב', 'משה', 'אהרן', 'שלמה', 'דוד']
            },
            girl: {
                hebrew: ['מיכל', 'דינה', 'רחל', 'לאה', 'שרה', 'רבקה', 'אסתר'],
                international: ['אמה', 'סופיה', 'אמילי', 'מיה', 'זואי', 'קלואי', 'גרייס'],
                modern: ['נועה', 'מאיה', 'טליה', 'אריאל', 'יעל', 'רוני', 'שירי'],
                traditional: ['מרים', 'רות', 'אביגיל', 'חנה', 'יהודית', 'שושנה', 'דבורה']
            }
        };

        const selectedNames = namesDB[gender] && namesDB[gender][style] 
            ? namesDB[gender][style] 
            : ['לא נמצאו שמות מתאימים'];

        const resultHTML = `
            <div class="calculation-result success">
                <h3>הצעות שמות עבור ${gender === 'boy' ? 'בן' : 'בת'}</h3>
                <div class="names-list">
                    ${selectedNames.map(name => `
                        <div class="name-suggestion">
                            <span class="name">${name}</span>
                        </div>
                    `).join('')}
                </div>
                <p class="names-note">אלו הן הצעות בלבד. בחרו שם שמדבר אליכם!</p>
            </div>
        `;

        $('#baby-names-results').html(resultHTML);
    }

    // Birth Plan Generator Function
    function generateBirthPlan($form) {
        const preferences = [];
        $form.find('input[type="checkbox"]:checked').each(function() {
            preferences.push($(this).next('label').text().trim());
        });

        const additionalRequests = $form.find('#additional-requests').val().trim();

        let planHTML = `
            <div class="calculation-result success">
                <h3>תוכנית הלידה שלך</h3>
                <div class="birth-plan-content">
        `;

        if (preferences.length > 0) {
            planHTML += `
                <div class="preferences-section">
                    <h4>העדפות שנבחרו:</h4>
                    <ul class="preferences-list">
                        ${preferences.map(pref => `<li>${pref}</li>`).join('')}
                    </ul>
                </div>
            `;
        }

        if (additionalRequests) {
            planHTML += `
                <div class="additional-section">
                    <h4>בקשות נוספות:</h4>
                    <p>${additionalRequests}</p>
                </div>
            `;
        }

        planHTML += `
                <div class="plan-actions">
                    <button type="button" class="btn btn-primary" onclick="printBirthPlan()">הדפס תוכנית</button>
                    <button type="button" class="btn btn-secondary" onclick="saveBirthPlan()">שמור כ-PDF</button>
                </div>
            </div>
        </div>
        `;

        $('#birth-plan-results').html(planHTML);
    }

    // Baby Costs Calculator Function
    function calculateBabyCosts($form) {
        const costs = {
            feeding: parseFloat($form.find('#feeding-costs').val()) || 0,
            diapers: parseFloat($form.find('#diapers-costs').val()) || 0,
            clothing: parseFloat($form.find('#clothing-costs').val()) || 0,
            gear: parseFloat($form.find('#gear-costs').val()) || 0,
            healthcare: parseFloat($form.find('#healthcare-costs').val()) || 0,
            childcare: parseFloat($form.find('#childcare-costs').val()) || 0
        };

        const monthlyTotal = Object.values(costs).reduce((sum, cost) => sum + cost, 0);
        const yearlyTotal = monthlyTotal * 12;
        const firstThreeYears = yearlyTotal * 3;

        const resultHTML = `
            <div class="calculation-result success">
                <h3>חישוב עלויות תינוק</h3>
                <div class="costs-breakdown">
                    <div class="cost-item">
                        <span class="cost-label">הזנה:</span>
                        <span class="cost-amount">₪${costs.feeding.toLocaleString()}</span>
                    </div>
                    <div class="cost-item">
                        <span class="cost-label">חיתולים:</span>
                        <span class="cost-amount">₪${costs.diapers.toLocaleString()}</span>
                    </div>
                    <div class="cost-item">
                        <span class="cost-label">ביגוד:</span>
                        <span class="cost-amount">₪${costs.clothing.toLocaleString()}</span>
                    </div>
                    <div class="cost-item">
                        <span class="cost-label">ציוד:</span>
                        <span class="cost-amount">₪${costs.gear.toLocaleString()}</span>
                    </div>
                    <div class="cost-item">
                        <span class="cost-label">בריאות:</span>
                        <span class="cost-amount">₪${costs.healthcare.toLocaleString()}</span>
                    </div>
                    <div class="cost-item">
                        <span class="cost-label">טיפוח:</span>
                        <span class="cost-amount">₪${costs.childcare.toLocaleString()}</span>
                    </div>
                </div>
                <div class="totals-section">
                    <div class="total-item monthly">
                        <span class="total-label">סך הכל חודשי:</span>
                        <span class="total-amount">₪${monthlyTotal.toLocaleString()}</span>
                    </div>
                    <div class="total-item yearly">
                        <span class="total-label">סך הכל שנתי:</span>
                        <span class="total-amount">₪${yearlyTotal.toLocaleString()}</span>
                    </div>
                    <div class="total-item three-years">
                        <span class="total-label">צפי ל-3 שנים:</span>
                        <span class="total-amount">₪${firstThreeYears.toLocaleString()}</span>
                    </div>
                </div>
            </div>
        `;

        $('#baby-costs-results').html(resultHTML);
    }

    // Zodiac Calculator Function
    function calculateZodiac($form) {
        const birthDate = $form.find('#birth-date').val();
        
        if (!birthDate) {
            showError($form, 'אנא הזן תאריך לידה');
            return;
        }

        const date = new Date(birthDate);
        const month = date.getMonth() + 1;
        const day = date.getDate();

        const zodiacSigns = {
            'מזל טלה': { start: [3, 21], end: [4, 19], emoji: '♈', description: 'אנרגטי, נחוש ומוביל טבעי' },
            'מזל שור': { start: [4, 20], end: [5, 20], emoji: '♉', description: 'יציב, מעשי ואמין' },
            'מזל תאומים': { start: [5, 21], end: [6, 20], emoji: '♊', description: 'חברותי, סקרן ומתאים' },
            'מזל סרטן': { start: [6, 21], end: [7, 22], emoji: '♋', description: 'רגשי, מטפח ומגן' },
            'מזל אריה': { start: [7, 23], end: [8, 22], emoji: '♌', description: 'בטוח, יצירתי ונדיב' },
            'מזל בתולה': { start: [8, 23], end: [9, 22], emoji: '♍', description: 'מדויק, מסוגן ועובד קשה' },
            'מזל מאזניים': { start: [9, 23], end: [10, 22], emoji: '♎', description: 'מאוזן, חברותי ומחפש הרמוניה' },
            'מזל עקרב': { start: [10, 23], end: [11, 21], emoji: '♏', description: 'נחוש, אינטנסיבי ומסתורי' },
            'מזל קשת': { start: [11, 22], end: [12, 21], emoji: '♐', description: 'הרפתקן, אופטימי וחופשי' },
            'מזל גדי': { start: [12, 22], end: [1, 19], emoji: '♑', description: 'אחראי, שאפתן ומעשי' },
            'מזל דלי': { start: [1, 20], end: [2, 18], emoji: '♒', description: 'מקורי, עצמאי וחדשני' },
            'מזל דגים': { start: [2, 19], end: [3, 20], emoji: '♓', description: 'רגיש, אמפטי ויצירתי' }
        };

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
                <h3>מזל התינוק שלך</h3>
                <div class="zodiac-result">
                    <div class="zodiac-main">
                        <span class="zodiac-emoji">${signData.emoji}</span>
                        <h4>${userSign}</h4>
                        <p class="zodiac-description">${signData.description}</p>
                    </div>
                    <div class="zodiac-traits">
                        <h5>תכונות אופי מובהקות:</h5>
                        <p>התינוק שלך נולד תחת ${userSign}, מה שעשוי לתת לו תכונות מיוחדות שיתפתחו עם הזמן.</p>
                    </div>
                </div>
            </div>
        `;

        $('#zodiac-results').html(resultHTML);
    }

    // Height Predictor Function
    function predictHeight($form) {
        const fatherHeight = parseFloat($form.find('#father-height').val());
        const motherHeight = parseFloat($form.find('#mother-height').val());
        const babyGender = $form.find('#baby-gender').val();

        if (!fatherHeight || !motherHeight || !babyGender) {
            showError($form, 'אנא מלא את כל השדות');
            return;
        }

        let predictedHeight;
        if (babyGender === 'boy') {
            predictedHeight = ((fatherHeight + motherHeight + 13) / 2);
        } else {
            predictedHeight = ((fatherHeight + motherHeight - 13) / 2);
        }

        const minHeight = predictedHeight - 8;
        const maxHeight = predictedHeight + 8;

        const resultHTML = `
            <div class="calculation-result success">
                <h3>חיזוי גובה התינוק</h3>
                <div class="height-prediction">
                    <div class="prediction-main">
                        <h4>גובה צפוי: ${predictedHeight.toFixed(0)} ס"מ</h4>
                        <p>טווח: ${minHeight.toFixed(0)}-${maxHeight.toFixed(0)} ס"מ</p>
                    </div>
                    <div class="prediction-note">
                        <p><small>* זהו חישוב משוער בלבד המבוסס על גובה ההורים. גורמים רבים משפיעים על הגובה הסופי.</small></p>
                    </div>
                </div>
            </div>
        `;

        $('#height-results').html(resultHTML);
    }

    // Display Functions
    function displayOvulationResults(data) {
        const resultHTML = `
            <div class="calculation-result success">
                <h3>תוצאות חישוב ביוץ</h3>
                <div class="ovulation-results">
                    <div class="result-item">
                        <strong>תאריך ביוץ משוער:</strong> ${formatHebrewDate(data.ovulation_date)}
                    </div>
                    <div class="result-item">
                        <strong>תחילת תקופת פוריות:</strong> ${formatHebrewDate(data.fertile_start)}
                    </div>
                    <div class="result-item">
                        <strong>סוף תקופת פוריות:</strong> ${formatHebrewDate(data.fertile_end)}
                    </div>
                </div>
                <div class="result-note">
                    <p><strong>זכרי:</strong> תקופת הפוריות היא 6 ימים - 5 ימים לפני הביוץ ויום הביוץ עצמו.</p>
                </div>
            </div>
        `;
        $('#ovulation-results').html(resultHTML);
    }

    function displayDueDateResults(data) {
        const resultHTML = `
            <div class="calculation-result success">
                <h3>תוצאות חישוב תאריך לידה</h3>
                <div class="due-date-results">
                    <div class="result-item main-result">
                        <strong>תאריך לידה משוער:</strong> ${formatHebrewDate(data.due_date)}
                    </div>
                    <div class="result-item">
                        <strong>שבועות הריון נוכחיים:</strong> ${data.weeks_pregnant} שבועות
                    </div>
                </div>
                <div class="result-note">
                    <p><strong>זכרי:</strong> זהו תאריך משוער בלבד. רק 5% מהתינוקות נולדים בתאריך המדויק.</p>
                </div>
            </div>
        `;
        $('#due-date-results').html(resultHTML);
    }

    // Form Validation
    function initFormValidation() {
        $('form').on('submit', function(e) {
            const $form = $(this);
            const isValid = validateForm($form);
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Real-time validation
        $('input[required], select[required], textarea[required]').on('blur', function() {
            validateField($(this));
        });
    }

    function validateForm($form) {
        let isValid = true;
        
        $form.find('input[required], select[required], textarea[required]').each(function() {
            if (!validateField($(this))) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    function validateField($field) {
        const value = $field.val().trim();
        const fieldType = $field.attr('type');
        let isValid = true;
        let errorMessage = '';

        // Required field validation
        if ($field.prop('required') && !value) {
            isValid = false;
            errorMessage = 'שדה זה הוא חובה';
        }

        // Email validation
        else if (fieldType === 'email' && value && !isValidEmail(value)) {
            isValid = false;
            errorMessage = 'כתובת אימייל לא תקינה';
        }

        // Date validation
        else if (fieldType === 'date' && value && !isValidDate(value)) {
            isValid = false;
            errorMessage = 'תאריך לא תקין';
        }

        // Number validation
        else if (fieldType === 'number' && value && isNaN(value)) {
            isValid = false;
            errorMessage = 'ערך מספרי לא תקין';
        }

        // Update field appearance
        if (isValid) {
            $field.removeClass('error');
            $field.siblings('.form-error').remove();
        } else {
            $field.addClass('error');
            $field.siblings('.form-error').remove();
            $field.after(`<div class="form-error">${errorMessage}</div>`);
        }

        return isValid;
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidDate(dateString) {
        const date = new Date(dateString);
        return date instanceof Date && !isNaN(date);
    }

    // Utility Functions
    function showLoading($form) {
        $form.addClass('loading');
        $form.find('.btn').append('<span class="spinner"></span>');
    }

    function hideLoading($form) {
        $form.removeClass('loading');
        $form.find('.spinner').remove();
    }

    function showError($form, message) {
        const $errorDiv = $('<div class="calculation-result error"><p>' + message + '</p></div>');
        $form.find('.results-container').html($errorDiv);
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

    // Smooth Scrolling
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });
    }

    // Accessibility Features
    function initAccessibility() {
        // Skip link functionality
        $('.skip-link').on('click', function(e) {
            e.preventDefault();
            const target = $($(this).attr('href'));
            if (target.length) {
                target.attr('tabindex', '-1').focus();
            }
        });

        // Keyboard navigation for tool cards
        $('.tool-card').on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) { // Enter or Space
                e.preventDefault();
                $(this).find('a')[0].click();
            }
        });
    }

    // Lazy Loading
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Global Functions (accessible from HTML)
    window.printBirthPlan = function() {
        const printWindow = window.open('', '_blank');
        const content = $('#birth-plan-results').html();
        printWindow.document.write(`
            <html dir="rtl">
            <head>
                <title>תוכנית לידה</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; direction: rtl; }
                    h3 { color: #FF6B9D; }
                    ul { padding-right: 20px; }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    };

    window.saveBirthPlan = function() {
        alert('פונקציונליות שמירה כ-PDF תהיה זמינה בקרוב');
    };

})(jQuery);