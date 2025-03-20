<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <!-- jQuery (Load before FullCalendar) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>

</head>

<body>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div id="calendar"></div>

    <form id="eventForm" action="{{ route('calendar.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="title" id="title">
        <input type="hidden" name="start" id="start">
        <input type="hidden" name="end" id="end">
    </form>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          let calendarEl = document.getElementById('calendar');
  
          // Fetch events dynamically from Laravel
          fetch("{{ route('calendar.index') }}")
              .then(response => response.json())
              .then(events => {
                  let calendar = new FullCalendar.Calendar(calendarEl, {
                      initialView: 'dayGridMonth',
                      events: events, // Use dynamically fetched events
                      selectable: true,
                      select: function (info) {
                          let title = prompt('Enter Event Title:');
                          if (title) {
                              document.getElementById('title').value = title;
                              document.getElementById('start').value = info.startStr;
                              document.getElementById('end').value = info.endStr;
                              document.getElementById('eventForm').submit();
                          }
                      }
                  });
  
                  calendar.render();
              })
              .catch(error => console.error('Error fetching events:', error));
      });
  </script>
  

</body>

</html>
