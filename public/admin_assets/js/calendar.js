import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        events: '/rooms/availability', // The route to fetch the availability events for rooms
        dateClick: function(info) {
            // Handle date click event
            console.log('Clicked on: ' + info.dateStr);
        },
        eventClick: function(info) {
            // Handle event click event
            console.log('Event: ' + info.event.title);
        }
    });

    calendar.render();
});
