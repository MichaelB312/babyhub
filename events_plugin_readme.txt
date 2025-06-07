# Baby-Hub Events Calendar Plugin

מערכת ניהול אירועים והרשמות מתקדמת עבור אתר Baby-Hub, הכוללת לוח שנה אינטראקטיבי, מערכת RSVP ומעקב מקומות.

## תכונות עיקריות

### 🗓️ לוח שנה אינטראקטיבי
- תצוגות מרובות: חודש, שבוע, יום ורשימה
- תמיכה מלאה ב-RTL ועברית
- צבעים מותאמים לקטגוריות שונות
- פילטרים לפי קטגוריה וקבוצת גיל
- תצוגה רספונסיבית לכל המכשירים

### 📝 ניהול אירועים
- רישום אירועים עם כל הפרטים הנדרשים
- קטגוריות: סדנאות, מפגשי משחק, קבוצות תמיכה, שיעורים ועוד
- קבוצות גיל: תינוקות, פעוטות, ילדים וכלל המשפחה
- סטטוס הורות: הורים חדשים, מנוסים וכלל הקהילה
- ניהול מקומות והגבלת משתתפים

### 👥 מערכת RSVP
- הרשמה מקוונת לאירועים
- מעקב אוטומטי של מספר המשתתפים
- התראות על מקומות אחרונים
- אפשרות ביטול הרשמה
- דוחות RSVP למנהלים

### 🎯 תכונות מתקדמות
- REST API לשליפת אירועים
- שירות AJAX לפעולות מהירות
- מודאל אינטראקטיבי לצפייה באירועים
- שיתוף ברשתות חברתיות
- תמיכה בהנגשה (ARIA)

## דרישות מערכת

- WordPress 5.0+
- PHP 7.4+
- תוסף Advanced Custom Fields (ACF)
- jQuery

## התקנה

1. העלה את התיקייה `babyhub-events-calendar` לתיקיית התוספים
2. הפעל את התוסף דרך לוח הבקרה
3. וודא שתוסף ACF מותקן ופעיל
4. הוסף את הקטגוריות והטקסונומיות הרצויות

## שימוש

### קוד קצר לוח השנה
```php
[babyhub-calendar]
```

### אפשרויות נוספות
```php
[babyhub-calendar view="timeGridWeek" height="600" category="workshop" show_filters="false"]
```

### REST API
```
GET /wp-json/babyhub/v1/events
GET /wp-json/babyhub/v1/events?start=2024-01-01&end=2024-01-31&category=workshop
```

## מבנה הנתונים

### שדות אירוע (ACF)
- `event_start_date` - תאריך התחלה
- `event_start_time` - שעת התחלה
- `event_end_date` - תאריך סיום
- `event_end_time` - שעת סיום
- `event_location` - מיקום
- `event_address` - כתובת מפורטת
- `event_seats` - מספר מקומות
- `event_fee` - עלות
- `event_organizer` - מארגן
- `event_contact_phone` - טלפון
- `event_contact_email` - אימייל
- `event_requirements` - דרישות מיוחדות

### טקסונומיות
- `event_category` - קטגוריות אירועים
- `event_age_range` - קבוצות גיל
- `event_parent_status` - סטטוס הורות

### טבלת RSVP
```sql
wp_babyhub_event_rsvps (
    id, event_id, user_id, rsvp_status, 
    rsvp_date, notes, created_at, updated_at
)
```

## קטגוריות ברירת מחדל

### קטגוריות אירועים
- **סדנאות** (`workshop`) - סדנאות הורות ופיתוח
- **מפגשי משחק** (`playdate`) - מפגשים חברתיים לילדים
- **קבוצות תמיכה** (`support-group`) - קבוצות תמיכה להורים
- **שיעורים** (`class`) - שיעורים וקורסים
- **אירועים חברתיים** (`social`) - מפגשים חברתיים
- **בריאות** (`health`) - הרצאות ובדיקות בריאות

### קבוצות גיל
- **0-6 חודשים** (`0-6-months`)
- **6-12 חודשים** (`6-12-months`)
- **1-2 שנים** (`1-2-years`)
- **2-3 שנים** (`2-3-years`)
- **3+ שנים** (`3-plus-years`)
- **כל הגילאים** (`all-ages`)

### סטטוס הורות
- **הורים טריים** (`new-parents`)
- **הורים מנוסים** (`experienced-parents`)
- **מצפים** (`expecting`)
- **כל הקהילה** (`all-community`)

## התאמה אישית

### עיצוב מותאם
יצור קובץ `babyhub-events-calendar/single-event.php` בתיקיית התמה לעיצוב מותאם אישית של עמודי אירועים.

### וו פעילות (Hooks)

#### Actions
- `babyhub_event_rsvp_success` - לאחר הרשמה מוצלחת
- `babyhub_event_rsvp_cancelled` - לאחר ביטול הרשמה

#### Filters
- `babyhub_event_colors` - התאמת צבעי קטגוריות
- `babyhub_calendar_settings` - הגדרות לוח השנה

## דוגמת קוד

### הוספת אירוע פרוגרמטית
```php
$event_id = wp_insert_post(array(
    'post_title' => 'סדנת הורות חדשה',
    'post_content' => 'תיאור הסדנה...',
    'post_type' => 'event',
    'post_status' => 'publish'
));

// הוספת שדות מותאמים
update_field('event_start_date', '2024-12-15', $event_id);
update_field('event_start_time', '19:00', $event_id);
update_field('event_location', 'מרכז הקהילה', $event_id);
update_field('event_seats', 20, $event_id);

// הוספת קטגוריה
wp_set_object_terms($event_id, 'workshop', 'event_category');
```

### בדיקת הרשמת משתמש
```php
function check_user_event_registration($event_id, $user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'babyhub_event_rsvps';
    
    return $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name 
         WHERE event_id = %d AND user_id = %d AND rsvp_status = 'attending'",
        $event_id, $user_id
    )) > 0;
}
```

## אבטחה

- כל בקשות AJAX מאובטחות עם Nonce
- בדיקת הרשאות משתמשים
- תיקוף נתונים מקיף
- הגנה מפני SQL Injection

## תמיכה וציטוטים

- **תמיכה מלאה ב-RTL** - מותאם לעברית
- **נגישות** - תואם WCAG 2.1 AA
- **רספונסיבי** - עובד על כל המכשירים
- **מהירות** - קוד מוטב לביצועים

## רישיון

GPL v2 או גרסה מאוחרת יותר

## קרדיטים

פותח על ידי צוות Baby-Hub עבור קהילת ההורים בישראל.

---

**גרסה:** 1.0.0  
**עדכון אחרון:** דצמבר 2024