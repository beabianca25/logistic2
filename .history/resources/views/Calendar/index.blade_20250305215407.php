<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>
</head>
<body>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.error("Calendar container #calendar not found!");
                return;
            }

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: function (fetchInfo, successCallback, failureCallback) {
                    fetch("{{ route('calendar.events') }}")
                        .then(response => response.json())
                        .then(events => {
                            console.log("Loaded events:", events); // Debugging
                            successCallback(events);
                        })
                        .catch(error => {
                            console.error("Error fetching events:", error);
                            failureCallback(error);
                        });
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
