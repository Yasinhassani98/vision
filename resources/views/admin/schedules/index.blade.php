@extends('layout.main')
@section('title', 'Schedule List')
@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Schedules Calendar</h5>
                            <div class="d-flex justify-content-center mb-3">
                                <span class="badge" style="background-color: #ff9f89;"> <span class="text-dark">Exam
                                    </span></span>
                                <span class="badge ms-2" style="background-color: #f9f871;"> <span
                                        class="text-dark">Activity</span></span>
                                <span class="badge ms-2" style="background-color: #a3e4d7;"> <span
                                        class="text-dark">Daily</span></span>
                            </div>
                            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Add New Schedule
                            </a>
                        </div>
                        <form method="GET" action="{{ route('admin.schedules.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-front.select label="Filter by Level" name="level_id" :options="$levels->sortBy('grade_level')->pluck('grade_level', 'id')->prepend('Select Level', '')->toArray()" selected="{{ request('level_id') }}" />
                                </div>
                                <div class="col-md-4">
                                    <x-front.select label="Type " name="type" :options="['exam' => 'Exam', 'activity' => 'Activity', 'daily' => 'Daily']" selected="{{ request('type') }}" />
                                </div>
                                <div class="col-md-3">
                                    <x-front.input label="Start Date" name="start_date" type="date" value="{{ request('start_date') }}" />
                                </div>
                                <div class="col-md-3">
                                    <x-front.input label="End Date" name="end_date" type="date" value="{{ request('end_date') }}" />
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-secondary">Filter</button>
                                    <a href="{{ route('admin.schedules.index') }}" class="text-blue m-2">Clear </a>
                                </div>
                            </div>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($schedules->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No schedules found.
                            </div>
                        @else
                            <div id='calendar'></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @foreach ($schedules as $schedule)
                        {
                            title: '{{ $schedule->title }}',
                            start: '{{ $schedule->start_time }}',
                            end: '{{ $schedule->end_time }}',
                            type: '{{ $schedule->type }}',
                            description: '{{ $schedule->description }}',
                            backgroundColor: '{{ $schedule->type == 'exam' ? '#ff9f89' : ($schedule->type == 'activity' ? '#f9f871' : '#a3e4d7') }}',
                            url: '{{ route('admin.schedules.show', $schedule->id) }}'
                        },
                    @endforeach
                ],
                dateClick: function(info) {
                    calendar.changeView('timeGridDay', info.dateStr);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    var eventObj = info.event;

                    if (eventObj.url) {
                        window.open(eventObj.url,'_self');
                    } else {
                        alert('Title: ' + eventObj.title +
                            '\nDescription: ' + eventObj.extendedProps.description +
                            '\nType: ' + eventObj.extendedProps.type +
                            '\nStart Time: ' + eventObj.start +
                            '\nEnd Time: ' + eventObj.end);
                    }
                },
                eventMouseEnter: function(info) {
                    $(info.el).tooltip({
                        title: info.event.title + ': ' + info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                    $(info.el).tooltip('show');
                },
                eventMouseLeave: function(info) {
                    $(info.el).tooltip('hide');
                }
            });

            calendar.render();
        });
    </script>
@endpush

@push('styles')
@endpush
