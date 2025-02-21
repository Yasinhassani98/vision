@extends('layout.main')

@section('title', 'Student Profile')

@section('content')
    <div class="container">
        <div class="row gutters">
            <!-- Top Cards -->
            <div class="col-md-6">
                <div class="card border-primary shadow-sm">
                    <div class="card-body d-flex align-items-center py-4 px-5">
                        <div class="me-3">
                            <i class="bi bi-person-fill text-primary fs-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Supervisor</h5>
                            <p class="card-text mb-0">{{ $student->supervisor->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success shadow-sm">
                    <div class="card-body d-flex align-items-center py-4 px-5">
                        <div class="me-3">
                            <i class="bi bi-bar-chart-fill text-success fs-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Year Average Rate</h5>
                            <p class="card-text mb-0">{{ $student->year_average_rate ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile d-flex justify-content-center align-items-center flex-column">
                                <div class="user-avatar">
                                    <img src="{{ asset('images/faces/2.jpg') }}" alt="User Avatar"
                                        class="img-fluid rounded-circle">
                                </div>
                                <h5 class="user-name text-center mt-4">{{ $student->first_name }} {{ $student->last_name }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Student List
                                </a>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Parent</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->parent->name ?? 'N/A' }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Date of Birth</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->DOB }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Gender</h6>
                                <h6 class="font-extrabold mb-0">{{ ucfirst($student->gender) }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Phone</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->phone ?? 'N/A' }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Address</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->address }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Level</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->level->grade_level ?? 'N/A' }}</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h6 class="text-muted font-semibold">Bio</h6>
                                <h6 class="font-extrabold mb-0">{{ $student->bio }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row gutters">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <h5 class="card-title">Comments</h5>
                        <form action="{{ route('admin.comments.profileComment',$student->id) }}" method="POST">
                            @csrf
                            <textarea name="comment"
                                class="form-control @error('comment')
                                is-invalid
                            @enderror"></textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <div class="text-end mt-2">
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </div>
                        </form>
                        <div class="d-flex flex-wrap mt-4">
                            @forelse ($student->comments as $comment)
                                <div class="d-flex align-items-center me-4 mb-3">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('/images/faces/1.jpg') }}" alt="Teacher Avatar">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">{{ $comment->teacher->name ?? 'N/A' }}</h5>
                                        <h6 class="text-muted mb-0">{{ $comment->comment }}</h6>
                                    </div>
                                </div>
                            @empty
                                <h6 class="text-muted mb-0">No comments yet</h6>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
