@extends('layout.main')
@section('title', 'Grade List')
@section('content')
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Grades Information</h5>
                                <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New Grade
                                </a>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Query Filter Form -->
                            <form method="GET" action="{{ route('admin.grades.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-front.input name="first_name" placeholder="First Name" value="{{ request('first_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="last_name" placeholder="Last Name" value="{{ request('last_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="subject" placeholder="Subject" value="{{ request('subject') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="start_date" type="date" placeholder="Start Date" value="{{ request('start_date') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <x-front.input name="end_date" type="date" placeholder="End Date" value="{{ request('end_date') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <button type="submit" class="btn btn-secondary">Filter</button>
                                        <a href="{{ route('admin.grades.index') }}" class="text-blue m-2">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Table Striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>STUDENT NAME</th>
                                        <th>SUBJECT</th>
                                        <th>SCORE</th>
                                        <th>COMMENT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($grades as $grade)
                                        <tr>
                                            <td class="text-bold-500">{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
                                            <td>{{ $grade->subject }}</td>
                                            <td>{{ $grade->score }}</td>
                                            <td>{{ $grade->comment ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('admin.grades.edit', $grade->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                <form action="{{ route('admin.grades.destroy', $grade->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No grades found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <nav>
                                <ul class="pagination pagination-primary mt-3">
                                    {{ $grades->withQueryString()->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Grades Table End -->
@endsection
