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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
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
                        `<span class="delete-event" style="cursor: pointer; color:red; font-weight:bold;">❌</span> ${info.event.title}`;

                    eventElement.querySelector('.delete-event').addEventListener('click', function() {
                        confirmDeleteEvent(info.event.id);
                    });

                    return { domNodes: [eventElement] };
                },

                eventDrop: function(info) {
                    confirmUpdateEvent(info.event.id, info.event.start, info.event.end);
                },

                eventResize: function(info) {
                    confirmResizeEvent(info.event.id, info.event.end);
                },
            });

            calendar.render();

            async function confirmDeleteEvent(eventId) {
                const result = await Swal.fire({
                    title: "Are you sure?",
                    text: "This event will be permanently deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/calendar/delete/${eventId}`, {
                            method: "DELETE",
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                        });

                        const data = await response.json();
                        if (response.ok) {
                            Swal.fire("Deleted!", data.message, "success");
                            calendar.refetchEvents();
                        } else {
                            throw new Error(data.message || "Failed to delete event");
                        }
                    } catch (error) {
                        Swal.fire("Error!", error.message, "error");
                    }
                }
            }

            async function confirmUpdateEvent(eventId, start, end) {
                const result = await Swal.fire({
                    title: "Move Event?",
                    text: "Do you want to update this event's new date?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, update",
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/calendar/${eventId}/update`, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ start: start.toISOString(), end: end ? end.toISOString() : null })
                        });

                        const data = await response.json();
                        if (response.ok) {
                            Swal.fire("Updated!", "Event moved successfully.", "success");
                        } else {
                            throw new Error(data.message || "Failed to move event");
                        }
                    } catch (error) {
                        Swal.fire("Error!", error.message, "error");
                    }
                } else {
                    calendar.refetchEvents();
                }
            }

            async function confirmResizeEvent(eventId, end) {
                const result = await Swal.fire({
                    title: "Resize Event?",
                    text: "Do you want to update the event duration?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, update",
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/calendar/${eventId}/resize`, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ end: end.toISOString() })
                        });

                        const data = await response.json();
                        if (response.ok) {
                            Swal.fire("Updated!", "Event duration updated successfully.", "success");
                        } else {
                            throw new Error(data.message || "Failed to update event duration");
                        }
                    } catch (error) {
                        Swal.fire("Error!", error.message, "error");
                    }
                } else {
                    calendar.refetchEvents();
                }
            }
        });
    </script>
@endsection
