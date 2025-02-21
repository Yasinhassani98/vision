@extends('layout.main')
@section('title', 'User List')
@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">User Information</h5>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New User
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!-- Query Filter Form -->
                            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-front.input name="name" placeholder="Name" value="{{ request('name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="role" :options="['' => 'Select Role', 'admin' => 'Admin', 'parent' => 'Parent', 'transport manager' => 'Transport Manager', 'teacher' => 'Teacher', 'supervisor' => 'Supervisor']" selected="{{ request('role') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="gender" :options="['' => 'Select Gender', 'male' => 'Male', 'female' => 'Female']" selected="{{ request('gender') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="status" :options="['' => 'Select Status', 'active' => 'Active', 'inactive' => 'Inactive']" selected="{{ request('status') }}" />
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <button type="submit" class="btn btn-secondary">Filter</button>
                                        <a href="{{ route('admin.users.index') }}" class="text-blue m-2">Clear</a>
                                    </div>
                                </div>
                            </form>
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>ROLE</th>
                                            <th>GENDER</th>
                                            <th>EMAIL</th>
                                            <th>STATUS</th>
                                            <th>DOB</th>
                                            <th>PHONE</th>
                                            <th>ADDRESS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <td class="text-bold-500">{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ $user->DOB }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-success">Show</a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endsection
