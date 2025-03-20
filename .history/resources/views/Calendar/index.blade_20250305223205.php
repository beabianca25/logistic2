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
      $(document).ready(function () {
          let calendarEl = document.getElementById('calendar');

          let calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              editable: true, 
              selectable: true, 
              eventTimeFormat: {
                  hour: '2-digit',
                  minute: '2-digit',
                  meridiem: false
              },
              events: function (fetchInfo, successCallback, failureCallback) {
                  $.ajax({
                      url: "{{ route('calendar.events') }}",
                      type: "GET",
                      dataType: "json",
                      success: function (response) {
                          console.log("Loaded events:", response); // Debugging
                          successCallback(response);
                      },
                      error: function (xhr, status, error) {
                          console.error("Error fetching events:", error);
                          failureCallback(error);
                      }
                  });
              },
              select: function (info) {
                  let title = prompt("Enter event title:");
                  if (title) {
                      $.ajax({
                          url: "{{ route('calendar.store') }}",
                          type: "POST",
                          data: {
                              _token: "{{ csrf_token() }}",
                              title: title,
                              start: info.startStr,
                              end: info.endStr
                          },
                          success: function (response) {
                              alert("Event added successfully!");
                              calendar.refetchEvents(); // Refresh events
                          },
                          error: function (xhr, status, error) {
                              alert("Error adding event.");
                              console.error(error);
                          }
                      });
                  }
              }
          });

          calendar.render();
      });
    </script>
@endsection
