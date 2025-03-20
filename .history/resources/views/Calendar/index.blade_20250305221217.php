@extends('base') {{-- Extend your main layout --}}

@section('content')
    <div class="container">
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
                },
                editable: true, // Allow dragging events
                selectable: true, // Allow selecting dates
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', meridiem: false }, // 24-hour format
            });

            calendar.render();
        });
    </script>
@endsection
