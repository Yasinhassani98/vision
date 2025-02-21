@extends('layout.main')
@section('title', 'Edit Schedule')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Schedule</h5>
                                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Schedule List
                                </a>
                            </div>
                            <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <x-front.input label="Title" name="title" type="text" required value="{{ old('title', $schedule->title) }}" />
                                </div>
                                <div class="mb-3">
                                    <x-front.select label="Select Level" name="level_id" :options="$levels->sortBy('grade_level')->pluck('grade_level', 'id')" selected="{{ old('level_id', $schedule->level_id) }}" />
                                </div>
                                <div class="mb-3">
                                    <x-front.select label="Type" name="type" :options="['exam' => 'Exam', 'activity' => 'Activity', 'daily' => 'Daily']" selected="{{ old('type', $schedule->type) }}" />
                                </div>
                                <div class="mb-3">
                                    <x-front.textarea label="Description" name="description" required value="{{ old('description', $schedule->description) }}" />
                                </div>
                                <div class="mb-3">
                                    <x-front.input label="Start Time" name="start_time" type="datetime-local" required value="{{ old('start_time', $schedule->start_time) }}" />
                                </div>
                                <div class="mb-3">
                                    <x-front.input label="End Time" name="end_time" type="datetime-local" required value="{{ old('end_time', $schedule->end_time) }}" />
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
