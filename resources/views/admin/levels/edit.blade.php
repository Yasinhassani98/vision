@extends('layout.main')
@section('title', 'Edit Level')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Level</h5>
                                <a href="{{ route('admin.levels.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Level List
                                </a>
                            </div>
                            <form action="{{ route('admin.levels.update', $level->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-front.input 
                                            name="grade_level" 
                                            placeholder="Grade Level" 
                                            label="Grade Level" 
                                            :value="$level->grade_level" 
                                        />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block shadow mt-4">Update Level</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
