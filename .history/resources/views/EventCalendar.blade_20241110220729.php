@extends('base')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            <div class="card-body">
                                <!-- the events -->
                                <div id="external-events">
                                    <div class="external-event bg-teal">Sagada Tour</div>
                                    <div class="external-event bg-pink">Baguio Tour</div>
                                    <div class="external-event bg-purple">Vehicle Maintenance</div>
                                    <div class="external-event bg-lightblue">Monitoring</div>
                                    <div class="external-event bg-danger">Review Documents</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove"> Remove after drop
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <form action="{{ route('event.store') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="title" class="form-control" placeholder="Event Title" required>
                                    <input type="text" name="start" class="form-control" placeholder="Start Date" required>
                                    <button type="submit" class="btn btn-primary">Create Event</button>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>

                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    $(function () {
        // Initialize external events
        function ini_events(ele) {
            ele.each(function () {
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                $(this).data('eventObject', eventObject);

                // make the event draggable
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its original position after drag
                    revertDuration: 0
                });
            });
        }
        ini_events($('#external-events div.external-event'));

        // Initialize the calendar
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#f56954', // red
                    borderColor: '#f56954', // red
                    allDay: true
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', // yellow
                    borderColor: '#f39c12' // yellow
                },
                // Additional events here
            ],
            editable: true,
            droppable: true, // Allow things to be dropped onto the calendar
            drop: function(info) {
                if ($('#drop-remove').is(':checked')) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });
        calendar.render();

        // Adding events
        var currColor = '#3c8dbc'; // Blue by default

        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault();
            currColor = $(this).css('color');
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            });
        });

        $('#add-new-event').click(function (e) {
            e.preventDefault();
            var val = $('#new-event').val();
            if (val.length == 0) return;

            // Create new event
            var event = $('<div />');
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event').text(val);
            $('#external-events').prepend(event);

            // Add draggable functionality to new event
            ini_events(event);

            // Clear the input field
            $('#new-event').val('');
        });
    });
</script>
@endsection
