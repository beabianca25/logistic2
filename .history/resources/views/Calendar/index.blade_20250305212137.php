<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events',
                selectable: true,
                select: function(info) {
                    let title = prompt('Enter Event Title:');
                    if (title) {
                        $.ajax({
                            url: '/events',
                            type: 'POST',
                            data: {
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                calendar.refetchEvents();
                                alert('Event added successfully!');
                            }
                        });
                    }
                }
            });
            calendar.render();
        });
    </script>

</body>
</html>
