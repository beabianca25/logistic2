@extends('base') {{-- Extend your main layout --}}

@section('content')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Calendar</title>
</head>

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
        events: "{{ route('calendar.events') }}",
        selectable: true,
        editable: true,

        select: function (info) {
            let title = prompt("Enter event title:");
            if (title) {
                $.ajax({
                    url: "{{ route('calendar.store') }}",
                    method: "POST",  // Ensure it's POST
                    data: {
                        _token: "{{ csrf_token() }}",
                        title: title,
                        start: info.startStr,
                        end: info.endStr
                    },
                    success: function (response) {
                        alert("Event added!");
                        calendar.refetchEvents();
                    },
                    error: function (xhr) {
                        console.error("Error adding event:", xhr.responseText);
                    }
                });
            }
        }
    });

    calendar.render();
});


    </script>
@endsection
