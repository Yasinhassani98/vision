@extends('layout.main')
@section('title', 'Edit Student')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Student</h5>
                                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Student List
                                </a>
                            </div>
                            <form action="{{ route('admin.students.update', $student->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="image" type="file" placeholder="Image" label="Image" value="{{ old('image', $student->image) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="first_name" placeholder="First Name" label="First Name" value="{{ old('first_name', $student->first_name) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="last_name" placeholder="Last Name" label="Last Name" value="{{ old('last_name', $student->last_name) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="level_id" :options="$levels->sortBy('grade_level')->pluck('grade_level', 'id')" placeholder="Level" label="Level" selected="{{ old('level_id', $student->level_id) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="parent_id" :options="$parents->pluck('name', 'id')" placeholder="Parent" label="Parent" selected="{{ old('parent_id', $student->parent_id) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="supervisor_id" :options="$supervisors->pluck('name', 'id')" placeholder="Supervisor" label="Supervisor" selected="{{ old('supervisor_id', $student->supervisor_id) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="gender" label="Gender" :options="['' => 'Select Gender', 'male' => 'Male', 'female' => 'Female']" selected="{{ old('gender', $student->gender) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="address" placeholder="Address" label="Address" value="{{ old('address', $student->address) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="phone" placeholder="Phone" label="Phone" value="{{ old('phone', $student->phone) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="DOB" type="date" placeholder="Date of Birth" label="Date of Birth" value="{{ old('DOB', $student->DOB) }}" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <x-front.textarea name="bio" label="Bio" value="{{ old('bio', $student->bio) }}"></x-front.textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary shadow mt-4">Update Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
