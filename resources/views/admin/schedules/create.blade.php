@extends('layout.main')
@section('title', 'Add New Schedule')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Create New Schedule</h5>
                                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Schedule Calendar
                                </a>
                            </div>
                            <form action="{{ route('admin.schedules.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-front.input label="Title" name="title" type="text" required value="{{ old('title') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-front.select label="Select Level" name="level_id" :options="$levels->sortBy('grade_level')->pluck('grade_level', 'id')" selected="{{ old('level_id') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-front.select label="Type" name="type" :options="['exam' => 'Exam', 'activity' => 'Activity', 'daily' => 'Daily']" selected="{{ old('type') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-front.input label="Description" name="description" type="text" required value="{{ old('description') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-front.input label="Start Time" name="start_time" type="datetime-local" required value="{{ old('start_time') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-front.input label="End Time" name="end_time" type="datetime-local" required value="{{ old('end_time') }}" />
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Create Schedule</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
