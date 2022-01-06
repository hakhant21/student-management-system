@extends('layouts.admin')

@section('title', 'ပွဲများ')

@section('content')
    <div class="row">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            စာရင်း

                            <a class="btn btn-sm btn-success" href="{{ route('admin.events.create') }}">
                                <i class="fa fa-plus"></i> အသစ်ဖန်တီးပါ
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        @if ($eventsPaginated->count() > 0)
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ပွဲ</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventsPaginated as $key => $event)
                                        <tr>
                                            <td>{{ $eventsPaginated->firstItem() + $key }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.events.edit', $event->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger delete-btn"
                                                    data-form-id="delete-form-{{ $event->id }}" href="#">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $event->id }}"
                                                    action="{{ route('admin.events.destroy', $event->id) }}"
                                                    method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{ $eventsPaginated->appends(request()->except('page'))->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@push('scripts')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins') }}/moment/moment.min.js"></script>
    <script src="{{ asset('plugins') }}/fullcalendar/main.js"></script>
    <script type="text/javascript">
        $(function() {

            var eventsObj = <?php echo json_encode($eventsArr); ?>;
            console.log(eventsObj);

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                locale: 'my',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: eventsObj,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
            });
            calendar.render();
        })
    </script>
@endpush

@push('styles')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/fullcalendar/main.css">
@endpush
