@extends('layout.main')
@section('title', 'Level List')
@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Level Information</h5>
                                <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New Level
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Grade Level</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($levels as $level)
                                    <tr>
                                        <td class="text-bold-500">{{ $level->grade_level }}</td>
                                        <td>
                                            <a href="{{ route('admin.levels.edit', $level->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('admin.levels.destroy', $level->id) }}" method="POST" style="display:inline;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Striped rows end -->
@endsection

@stack('scripts')

@stack('styles')