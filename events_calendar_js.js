/**
 * Baby-Hub Events Calendar JavaScript
 * Hebrew RTL Support with FullCalendar Integration
 */

(function($) {
    'use strict';

    let calendar;
    let currentEvent = null;

    // DOM Ready
    $(document).ready(function() {
        initializeCalendar();
        initializeFilters();
        initializeModal();
    });

    // Initialize FullCalendar
    function initializeCalendar() {
        const calendarEl = document.getElementById('babyhub-calendar');
        if (!calendarEl) return;

        const container = $(calendarEl).closest('.babyhub-events-calendar');
        const initialView = container.data('view') || 'dayGridMonth';
        const height = container.data('height') || 'auto';
        const initialCategory = container.data('category') || '';

        calendar = new FullCalendar.Calendar(calendarEl, {
            // Basic Configuration
            initialView: initialView,
            height: height,
            direction: 'rtl',
            locale: 'he',
            firstDay: 0, // Sunday
            
            // Header Configuration
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            
            buttonText: {
                today: 'היום',
                month: 'חודש',
                week: 'שבוע',
                day: 'יום',
                list: 'רשימה'
            },
            
            // Hebrew Day Names
            dayHeaderFormat: { weekday: 'short' },
            dayHeaders: true,
            
            // Event Sources
            eventSources: [
                {
                    url: babyhubEvents.rest_url,
                    method: 'GET',
                    extraParams: function() {
                        return {
                            category: getCurrentFilter('category'),
                            age_range: getCurrentFilter('age_range')
                        };
                    },
                    failure: function() {
                        showError(babyhubEvents.strings.error);
                    }
                }
            ],
            
            // Event Rendering
            eventDisplay: 'block',
            displayEventTime: true,
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            
            // Event Interaction
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                showEventModal(info.event);
            },
            
            eventMouseEnter: function(info) {
                $(info.el).attr('title', info.event.title + '\n' + 
                    (info.event.extendedProps.location || ''));
            },
            
            // Date Click
            dateClick: function(info) {
                // Could be used for adding events in the future
                console.log('Date clicked:', info.dateStr);
            },
            
            // Loading
            loading: function(isLoading) {
                if (isLoading) {
                    showLoading();
                } else {
                    hideLoading();
                }
            },
            
            // Event Content
            eventContent: function(arg) {
                const event = arg.event;
                const time = event.allDay ? '' : 
                    `<div class="fc-event-time">${arg.timeText}</div>`;
                const title = `<div class="fc-event-title">${event.title}</div>`;
                
                let status = '';
                const seats = event.extendedProps.seats;
                const availableSeats = event.extendedProps.available_seats;
                
                if (seats && availableSeats !== null) {
                    if (availableSeats === 0) {
                        status = '<div class="fc-event-status full">מלא</div>';
                    } else if (availableSeats <= 3) {
                        status = '<div class="fc-event-status limited">מקומות אחרונים</div>';
                    }
                }
                
                return {
                    html: `<div class="fc-event-content-custom">
                        ${time}
                        ${title}
                        ${status}
                    </div>`
                };
            }
        });

        calendar.render();
        
        // Handle responsive view changes
        handleResponsiveViews();
        $(window).on('resize', handleResponsiveViews);
    }

    // Initialize Filters
    function initializeFilters() {
        // Category Filter
        $('#category-filter').on('change', function() {
            refreshCalendar();
        });
        
        // Age Filter
        $('#age-filter').on('change', function() {
            refreshCalendar();
        });
        
        // Today Button
        $('#today-btn').on('click', function() {
            if (calendar) {
                calendar.today();
            }
        });
    }

    // Initialize Modal
    function initializeModal() {
        // Close modal on backdrop click
        $(document).on('click', '.modal-backdrop', function() {
            closeEventModal();
        });
        
        // Close modal on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $('#event-modal').is(':visible')) {
                closeEventModal();
            }
        });
        
        // RSVP Button Click
        $(document).on('click', '.rsvp-btn', function(e) {
            e.preventDefault();
            handleRSVP($(this));
        });
    }

    // Show Event Modal
    function showEventModal(event) {
        currentEvent = event;
        const modal = $('#event-modal');
        
        // Set title
        modal.find('.modal-title').text(event.title);
        
        // Build event details
        const details = buildEventDetails(event);
        modal.find('.event-details').html(details);
        
        // Build actions
        const actions = buildEventActions(event);
        modal.find('.event-actions').html(actions);
        
        // Show modal
        modal.show();
        modal.attr('aria-hidden', 'false');
        modal.find('.modal-close').focus();
        
        // Prevent body scroll
        $('body').addClass('modal-open');
    }

    // Close Event Modal
    window.closeEventModal = function() {
        const modal = $('#event-modal');
        modal.hide();
        modal.attr('aria-hidden', 'true');
        $('body').removeClass('modal-open');
        currentEvent = null;
    };

    // Build Event Details HTML
    function buildEventDetails(event) {
        const props = event.extendedProps;
        let html = '';
        
        // Date and Time
        const startDate = new Date(event.start);
        const endDate = event.end ? new Date(event.end) : null;
        
        html += `
            <div class="event-detail-item">
                <div class="event-detail-icon">📅</div>
                <div class="event-detail-content">
                    <div class="event-detail-label">תאריך ושעה:</div>
                    <div class="event-detail-value">
                        ${formatEventDate(startDate, endDate)}
                    </div>
                </div>
            </div>
        `;
        
        // Location
        if (props.location) {
            html += `
                <div class="event-detail-item">
                    <div class="event-detail-icon">📍</div>
                    <div class="event-detail-content">
                        <div class="event-detail-label">מיקום:</div>
                        <div class="event-detail-value">${props.location}</div>
                    </div>
                </div>
            `;
        }
        
        // Description
        if (event.extendedProps.description) {
            html += `
                <div class="event-detail-item">
                    <div class="event-detail-icon">📝</div>
                    <div class="event-detail-content">
                        <div class="event-detail-label">תיאור:</div>
                        <div class="event-detail-value">${event.extendedProps.description}</div>
                    </div>
                </div>
            `;
        }
        
        // Fee
        if (props.fee && props.fee > 0) {
            html += `
                <div class="event-detail-item">
                    <div class="event-detail-icon">💰</div>
                    <div class="event-detail-content">
                        <div class="event-detail-label">עלות:</div>
                        <div class="event-detail-value">₪${props.fee}</div>
                    </div>
                </div>
            `;
        } else {
            html += `
                <div class="event-detail-item">
                    <div class="event-detail-icon">🆓</div>
                    <div class="event-detail-content">
                        <div class="event-detail-label">עלות:</div>
                        <div class="event-detail-value">חינם</div>
                    </div>
                </div>
            `;
        }
        
        // Seats Information
        if (props.seats) {
            const availableSeats = props.available_seats;
            const rsvpCount = props.rsvp_count || 0;
            const percentage = (rsvpCount / props.seats) * 100;
            
            html += `
                <div class="event-detail-item">
                    <div class="event-detail-icon">👥</div>
                    <div class="event-detail-content">
                        <div class="event-detail-label">מקומות:</div>
                        <div class="seats-info">
                            <div class="seats-bar">
                                <div class="seats-filled" style="width: ${percentage}%"></div>
                            </div>
                            <div class="seats-text">${rsvpCount}/${props.seats}</div>
                        </div>
                        <div class="event-detail-value">
                            ${availableSeats > 0 ? `${availableSeats} מקומות זמינים` : 'האירוע מלא'}
                        </div>
                    </div>
                </div>
            `;
        }
        
        // Tags
        const tags = [];
        if (props.categories && props.categories.length) {
            tags.push(...props.categories);
        }
        if (props.age_ranges && props.age_ranges.length) {
            tags.push(...props.age_ranges);
        }
        if (props.parent_status && props.parent_status.length) {
            tags.push(...props.parent_status);
        }
        
        if (tags.length > 0) {
            html += `
                <div class="event-tags">
                    ${tags.map(tag => `<span class="event-tag">${tag}</span>`).join('')}
                </div>
            `;
        }
        
        return html;
    }

    // Build Event Actions HTML
    function buildEventActions(event) {
        const props = event.extendedProps;
        let html = '';
        
        // Check if user is logged in
        if (!babyhubEvents.user_logged_in && typeof babyhubEvents.user_logged_in !== 'undefined') {
            html += `
                <div class="event-status">
                    ${babyhubEvents.strings.login_required}
                </div>
                <a href="/wp-login.php" class="rsvp-btn">
                    התחבר להרשמה
                </a>
            `;
            return html;
        }
        
        // Check if event is full
        if (props.seats && props.available_seats === 0) {
            html += `
                <div class="event-status full">
                    ${babyhubEvents.strings.event_full}
                </div>
                <button type="button" class="rsvp-btn full" disabled>
                    האירוע מלא
                </button>
            `;
            return html;
        }
        
        // Check if user is already registered
        const isRegistered = checkUserRegistration(event.id);
        
        if (isRegistered) {
            html += `
                <div class="event-status registered">
                    נרשמת לאירוע זה
                </div>
                <button type="button" class="rsvp-btn cancel" data-event-id="${event.id}" data-action="cancel">
                    בטל הרשמה
                </button>
            `;
        } else {
            // Show available seats warning if limited
            if (props.seats && props.available_seats <= 3) {
                html += `
                    <div class="event-status limited">
                        נותרו ${props.available_seats} מקומות בלבד
                    </div>
                `;
            } else if (!props.seats) {
                html += `
                    <div class="event-status available">
                        הרשמה פתוחה
                    </div>
                `;
            } else {
                html += `
                    <div class="event-status available">
                        ${props.available_seats} מקומות זמינים
                    </div>
                `;
            }
            
            html += `
                <button type="button" class="rsvp-btn" data-event-id="${event.id}" data-action="register">
                    הירשם לאירוע
                </button>
            `;
        }
        
        // View Details Link
        html += `
            <a href="${event.url}" class="btn btn-secondary" target="_blank">
                צפה בפרטים המלאים
            </a>
        `;
        
        return html;
    }

    // Handle RSVP
    function handleRSVP($button) {
        const eventId = $button.data('event-id');
        const action = $button.data('action');
        
        if (action === 'cancel') {
            if (!confirm(babyhubEvents.strings.confirm_cancel)) {
                return;
            }
        }
        
        // Show loading
        $button.prop('disabled', true);
        $button.text('טוען...');
        
        $.ajax({
            url: babyhubEvents.ajax_url,
            type: 'POST',
            data: {
                action: 'babyhub_rsvp_event',
                event_id: eventId,
                rsvp_action: action,
                nonce: babyhubEvents.nonce
            },
            success: function(response) {
                if (response.success) {
                    showSuccess(response.data.message);
                    
                    // Update calendar
                    refreshCalendar();
                    
                    // Update modal
                    setTimeout(function() {
                        if (currentEvent) {
                            // Refresh event data and update modal
                            refreshEventModal(currentEvent);
                        }
                    }, 500);
                    
                } else {
                    showError(response.data || babyhubEvents.strings.rsvp_error);
                }
            },
            error: function() {
                showError(babyhubEvents.strings.rsvp_error);
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
    }

    // Check User Registration
    function checkUserRegistration(eventId) {
        // This would typically come from server-side data
        // For now, we'll implement a simple client-side check
        if (typeof babyhubEvents.user_events !== 'undefined') {
            return babyhubEvents.user_events.includes(eventId);
        }
        return false;
    }

    // Refresh Event Modal
    function refreshEventModal(event) {
        // Re-fetch event data and update modal
        // This would typically make an AJAX call to get updated event data
        showEventModal(event);
    }

    // Format Event Date
    function formatEventDate(startDate, endDate) {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        };
        
        let formatted = startDate.toLocaleDateString('he-IL', options);
        
        if (!isNaN(startDate.getHours())) {
            formatted += ' בשעה ' + startDate.toLocaleTimeString('he-IL', timeOptions);
        }
        
        if (endDate && endDate.getDate() !== startDate.getDate()) {
            formatted += ' עד ' + endDate.toLocaleDateString('he-IL', options);
        } else if (endDate && !isNaN(endDate.getHours())) {
            formatted += ' - ' + endDate.toLocaleTimeString('he-IL', timeOptions);
        }
        
        return formatted;
    }

    // Get Current Filter Value
    function getCurrentFilter(type) {
        switch (type) {
            case 'category':
                return $('#category-filter').val();
            case 'age_range':
                return $('#age-filter').val();
            default:
                return '';
        }
    }

    // Refresh Calendar
    function refreshCalendar() {
        if (calendar) {
            calendar.refetchEvents();
        }
    }

    // Handle Responsive Views
    function handleResponsiveViews() {
        if (!calendar) return;
        
        const width = $(window).width();
        
        if (width < 768) {
            // Mobile view
            calendar.changeView('listWeek');
        } else if (width < 1024) {
            // Tablet view
            calendar.changeView('timeGridWeek');
        } else {
            // Desktop view
            calendar.changeView('dayGridMonth');
        }
    }

    // Utility Functions
    function showLoading() {
        if ($('.loading-overlay').length === 0) {
            $('#babyhub-calendar').append(`
                <div class="loading-overlay">
                    <div class="loading-spinner"></div>
                </div>
            `);
        }
    }

    function hideLoading() {
        $('.loading-overlay').remove();
    }

    function showError(message) {
        // Create toast notification
        const toast = $(`
            <div class="event-toast error">
                <div class="toast-content">
                    <span class="toast-icon">❌</span>
                    <span class="toast-message">${message}</span>
                    <button class="toast-close">&times;</button>
                </div>
            </div>
        `);
        
        $('body').append(toast);
        
        setTimeout(function() {
            toast.addClass('show');
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            hideToast(toast);
        }, 5000);
        
        // Manual close
        toast.find('.toast-close').on('click', function() {
            hideToast(toast);
        });
    }

    function showSuccess(message) {
        const toast = $(`
            <div class="event-toast success">
                <div class="toast-content">
                    <span class="toast-icon">✅</span>
                    <span class="toast-message">${message}</span>
                    <button class="toast-close">&times;</button>
                </div>
            </div>
        `);
        
        $('body').append(toast);
        
        setTimeout(function() {
            toast.addClass('show');
        }, 100);
        
        setTimeout(function() {
            hideToast(toast);
        }, 3000);
        
        toast.find('.toast-close').on('click', function() {
            hideToast(toast);
        });
    }

    function hideToast($toast) {
        $toast.removeClass('show');
        setTimeout(function() {
            $toast.remove();
        }, 300);
    }

    // Export functions for global access
    window.babyhubCalendar = {
        refresh: refreshCalendar,
        showEvent: showEventModal,
        closeModal: closeEventModal
    };

})(jQuery);

// Toast Styles (added dynamically)
$(document).ready(function() {
    if ($('#babyhub-toast-styles').length === 0) {
        $('head').append(`
            <style id="babyhub-toast-styles">
                .event-toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 10002;
                    max-width: 400px;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    transform: translateX(100%);
                    transition: transform 0.3s ease;
                    direction: rtl;
                }
                
                .event-toast.show {
                    transform: translateX(0);
                }
                
                .event-toast.success {
                    border-right: 4px solid #28a745;
                }
                
                .event-toast.error {
                    border-right: 4px solid #dc3545;
                }
                
                .toast-content {
                    display: flex;
                    align-items: center;
                    padding: 1rem;
                    gap: 0.75rem;
                }
                
                .toast-icon {
                    font-size: 1.25rem;
                }
                
                .toast-message {
                    flex: 1;
                    font-size: 0.9rem;
                    font-weight: 500;
                }
                
                .toast-close {
                    background: none;
                    border: none;
                    font-size: 1.25rem;
                    cursor: pointer;
                    opacity: 0.7;
                }
                
                .toast-close:hover {
                    opacity: 1;
                }
                
                @media (max-width: 480px) {
                    .event-toast {
                        right: 10px;
                        left: 10px;
                        max-width: none;
                        transform: translateY(-100%);
                    }
                    
                    .event-toast.show {
                        transform: translateY(0);
                    }
                }
            </style>
        `);
    }
});