@extends('layout.main')
@section('title', 'Student List')
@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Student Information</h5>
                                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New Student
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!-- Query Filter Form -->
                            <form method="GET" action="{{ route('admin.students.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-front.input name="first_name" placeholder="First Name" value="{{ request('first_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input name="last_name" placeholder="Last Name" value="{{ request('last_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="level_id" :options="['' => 'Select Level'] + $levels->sortBy('grade_level')->pluck('grade_level', 'id')->toArray()" selected="{{ request('level_id') }}" />                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="gender" :options="['' => 'Select Gender', 'male' => 'Male', 'female' => 'Female']" selected="{{ request('gender') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <x-front.input name="address" placeholder="Address" value="{{ request('address') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <x-front.input name="start_date" type="date" placeholder="Start Date" value="{{ request('start_date') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <x-front.input name="end_date" type="date" placeholder="End Date" value="{{ request('end_date') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <button type="submit" class="btn btn-secondary">Filter</button>
                                        <a href="{{ route('admin.students.index') }}" class="text-blue m-2">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>LEVEL</th>
                                        <th>PARENT</th>
                                        <th>SUPERVISOR</th>
                                        <th>GENDER</th>
                                        <th>DOB</th>
                                        <th>PHONE</th>
                                        <th>ADDRESS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $student)
                                    <tr>
                                        <td class="text-bold-500">{{ $student->first_name }}</td>
                                        <td class="text-bold-500">{{ $student->last_name }}</td>
                                        <td>{{ $student->level->grade_level }}</td>
                                        <td>{{ $student->parent->name }}</td>
                                        <td>{{ $student->supervisor->name }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->DOB }}</td>
                                        <td>{{ $student->phone ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($student->address,10) }}</td>
                                        <td>
                                            <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-outline-success">Show</a>
                                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination links -->
                            {{-- <div class="d-flex justify-content-center mt-3">
                                {{ $students->withQueryString()->links() }}
                            </div> --}}
                            <nav>
                                <ul class="pagination pagination-primary mt-3">
                                    {{ $students->withQueryString()->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endsection