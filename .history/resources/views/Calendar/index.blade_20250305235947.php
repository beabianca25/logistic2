@extends('base')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Tracker</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                    <div class="input-group-append">
                        <button id="searchButton" class="btn btn-primary">{{ __('Search') }}</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="btn-group mb-3" role="group">
                    <button id="exportButton" class="btn btn-success">{{ __('Export Events') }}</button>
                    <a href="{{ route('calendar.create') }}" class="btn btn-success">{{ __('Add Event') }}</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="calendar" style="width: 100%; height:100vh"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: '/events',
            editable: true,

            eventContent: function(info) {
                var eventElement = document.createElement('div');
                eventElement.innerHTML =
                    '<span style="cursor: pointer; color:red; font-weight:bold;">❌</span> ' + info.event.title;

                eventElement.querySelector('span').addEventListener('click', function() {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                method: 'DELETE',
                                url: '/event/delete/' + info.event.id,
                                data: {
                                    '_token': "{{ csrf_token() }}", // ✅ Required for DELETE requests
                                },
                                success: function(response) {
                                    Swal.fire("Deleted!", response.message,
                                        "success");
                                    calendar.refetchEvents();
                                },
                                error: function(error) {
                                    Swal.fire("Error!", "Failed to delete event.",
                                        "error");
                                    console.error('Error:', error);
                                }
                            });

                        }
                    });
                });


                return {
                    domNodes: [eventElement]
                };
            },

            eventDrop: function(info) {
                Swal.fire({
                    title: "Move Event?",
                    text: "Do you want to update this event's new date?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: `/event/${info.event.id}`,
                            data: {
                                '_token': "{{ csrf_token() }}",
                                start: info.event.start.toISOString(),
                                end: info.event.end ? info.event.end.toISOString() : null,
                            },
                            success: function() {
                                Swal.fire("Updated!", "Event moved successfully.",
                                    "success");
                            },
                            error: function(error) {
                                Swal.fire("Error!", "Failed to move event.", "error");
                            }
                        });
                    } else {
                        info.revert();
                    }
                });
            },

            eventResize: function(info) {
                Swal.fire({
                    title: "Resize Event?",
                    text: "Do you want to update the event duration?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, update",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: `/event/${info.event.id}/resize`,
                            data: {
                                '_token': "{{ csrf_token() }}",
                                end: info.event.end.toISOString(),
                            },
                            success: function() {
                                Swal.fire("Updated!",
                                    "Event duration updated successfully.", "success");
                            },
                            error: function(error) {
                                Swal.fire("Error!", "Failed to update event duration.",
                                    "error");
                            }
                        });
                    } else {
                        info.revert();
                    }
                });
            },
        });

        calendar.render();

        document.getElementById('searchButton').addEventListener('click', function() {
            var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
            $.ajax({
                method: 'GET',
                url: `/events/search?title=${searchKeywords}`,
                success: function(response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                    Swal.fire("Search Completed", `${response.length} event(s) found.`, "info");
                },
                error: function(error) {
                    Swal.fire("Error!", "Failed to search events.", "error");
                }
            });
        });

        document.getElementById('exportButton').addEventListener('click', function() {
            var events = calendar.getEvents().map(event => ({
                title: event.title,
                start: event.start ? event.start.toISOString() : null,
                end: event.end ? event.end.toISOString() : null,
                color: event.backgroundColor,
            }));

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.json_to_sheet(events);
            XLSX.utils.book_append_sheet(wb, ws, "Events");
            XLSX.writeFile(wb, "events.xlsx");

            Swal.fire("Exported!", "Events exported successfully!", "success");
        });
    </script>
@endsection
