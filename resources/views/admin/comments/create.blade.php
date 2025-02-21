@extends('layout.main')
@section('title', 'Add New Comment')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Add New Comment</h5>
                                <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Comment List
                                </a>
                            </div>
                            <form action="{{ route('admin.comments.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="student_id" class="form-label">Select Student</label>
                                        <select name="student_id" id="student_id" class="form-control">
                                            @foreach ($students->sortBy('first_name') as $student)
                                                <option value="{{ $student->id }}">{{ $student->first_name }}
                                                    {{ $student->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <x-front.textarea name="comment" id="comment" value="{{ old('comment') }}" />
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
