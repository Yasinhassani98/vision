@extends('layout.main')
@section('title', 'Schedule Details')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Schedule Details</h5>
                                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Schedule List
                                </a>
                            </div>
                            <div class="mb-3">
                                <h6>Title:</h6>
                                <p>{{ $schedule->title }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Level:</h6>
                                <p>{{ $schedule->level->grade_level }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Type:</h6>
                                <p>{{ ucfirst($schedule->type) }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Description:</h6>
                                <p>{{ $schedule->description }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Start Time:</h6>
                                <p>{{ $schedule->start_time }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>End Time:</h6>
                                <p>{{ $schedule->end_time }}</p>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                    class="btn btn-outline-warning">Edit</a>
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
