@extends('layout.main')
@section('title', 'Comment List')
@section('content')
    <!-- Comments List start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Comments Informations</h5>
                                <a href="{{ route('admin.comments.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New Comment
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!-- Query Filter Form -->
                            <form method="GET" action="{{ route('admin.comments.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-front.input name="student_name" placeholder="Student Name" value="{{ request('student_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="teacher_name" placeholder="Teacher Name" value="{{ request('teacher_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="comment" placeholder="Comment" value="{{ request('comment') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-secondary">Filter</button>
                                        <a href="{{ route('admin.comments.index') }}" class="text-blue m-2">Clear </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>STUDENT</th>
                                        <th>TEACHER</th>
                                        <th>COMMENT</th>
                                        <th>CREATED AT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($comments as $comment)
                                    <tr>
                                        <td class="text-bold-500">{{ $comment->student->first_name }} {{ $comment->student->last_name }}</td>
                                        <td>{{ $comment->teacher ? $comment->teacher->name : 'N/A' }}</td>
                                        <td>{{ $comment->comment }}</td>
                                        <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination links -->
                            <nav>
                                <ul class="pagination pagination-primary mt-3">
                                    {{ $comments->withQueryString()->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
