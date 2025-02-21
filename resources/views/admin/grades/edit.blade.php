@extends('layout.main')
@section('title', 'Edit Grade')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Grade</h5>
                                <a href="{{ route('admin.grades.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Grades List
                                </a>
                            </div>
                            <form action="{{ route('admin.grades.update', $grade) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="student_id" class="form-label">Select Student</label>
                                        <select name="student_id" id="student_id" class="form-control">
                                            @foreach ($students->sortBy('first_name') as $student)
                                                <option value="{{ $student->id }}">{{ $student->first_name }}
                                                    {{ $student->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="subject" placeholder="Subject" label="Subject" value="{{ old('subject', $grade->subject) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="score" type="number" step="0.01" placeholder="Score" label="Score" value="{{ old('score', $grade->score) }}" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <x-front.textarea name="comment" label="Comment" value="{{ old('comment', $grade->comment) }}" />
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary shadow mt-4">Update Grade</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
