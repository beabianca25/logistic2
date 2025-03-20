@extends('base') {{-- Extend your main layout --}}

@section('content')
    <div class="container">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <div id="calendar"></div>
    </div>
@endsection

@section('styles')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
            padding: 10px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('scripts')
    <!-- jQuery (Load before FullCalendar) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>

    <script>
     document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: "{{ route('calendar.events') }}", // Load events dynamically

        select: function (info) {
            let title = prompt("Enter event title:");
            if (title) {
                fetch("{{ route('calendar.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token
                    },
                    body: JSON.stringify({
                        title: title,
                        start: info.startStr,
                        end: info.endStr
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Event added successfully!");
                        calendar.refetchEvents(); // Reload calendar
                    } else {
                        alert("Error saving event.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
            calendar.unselect();
        }
    });

    calendar.render();
});

    </script>
@endsection
