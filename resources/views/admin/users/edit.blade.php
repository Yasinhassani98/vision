@extends('layout.main')
@section('title', 'Edit User')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit User</h5>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to User List
                                </a>
                            </div>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="image" type="file" placeholder="Image" label="Image"
                                            value="{{ old('image', $user->image) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="name" placeholder="Enter full name" label="Full Name"
                                            value="{{ old('name', $user->name) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="email" type="email" placeholder="Enter email"
                                            label="Email" value="{{ old('email', $user->email) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="password" type="password" placeholder="Enter password"
                                            label="Password" value="{{ old('password') }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="password.confirmation" type="password"
                                            placeholder="Enter password confirmation" label="Password Confirmation"
                                            value="{{ old('password.confirmation') }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="phone" placeholder="Enter phone number" label="Phone"
                                            value="{{ old('phone', $user->phone) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="address" placeholder="Enter Street" label="Street"
                                            value="{{ old('address', $user->address) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.select name="status" label="Status" :options="[
                                            '' => 'Select Status',
                                            'active' => 'Active',
                                            'inactive' => 'Inactive',
                                        ]"
                                            selected="{{ old('status', $user->status) }}" />
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.select name="role" label="Role" :options="[
                                            '' => 'Select Role',
                                            'admin' => 'Admin',
                                            'parent' => 'Parent',
                                            'transport manager' => 'Transport Manager',
                                            'teacher' => 'Teacher',
                                            'supervisor' => 'Supervisor',
                                        ]"
                                            selected="{{ old('role', $user->role) }}" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="level_ids_container" style="display: none;">
                                        <label for="level_ids">Levels</label>
                                        <input name="level_ids" id="level_ids"
                                            class="form-control @error('level_ids') is-invalid @enderror"
                                            value="{{ old('level_ids', json_encode($user->levels->map(function($level) {
                                                return [
                                                    'value' => $level->id,
                                                    'label' => 'Level ' . $level->grade_level ,
                                                ]; 
                                            })->toArray())) }}">
                                        @error('level_ids')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.select name="gender" label="Gender" :options="['' => 'Select Gender', 'male' => 'Male', 'female' => 'Female']"
                                            selected="{{ old('gender', $user->gender) }}" />
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <x-front.input name="DOB" type="date" placeholder="Enter Date of Birth"
                                            label="Date of Birth" value="{{ old('DOB', $user->DOB) }}" />
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Update User</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name=level_ids]');
            const roleSelect = document.querySelector('select[name=role]');
            const levelIdsContainer = document.getElementById('level_ids_container');

            if (!input || !roleSelect || !levelIdsContainer) {
                console.error('Required elements not found');
                return;
            }

            roleSelect.addEventListener('change', function() {
                if (this.value === 'teacher') {
                    levelIdsContainer.style.display = 'block';
                } else {
                    levelIdsContainer.style.display = 'none';
                }
            });

            if (roleSelect.value === 'teacher') {
                levelIdsContainer.style.display = 'block';
            }

            const levels = {!! json_encode(
                $levels->map(function ($level) {
                    return [
                        'value' => $level->id,
                        'label' => 'Level ' . $level->grade_level,
                        'searchBy' => 'Level ' . $level->grade_level,
                    ];
                }),
            ) !!};

            const tagify = new Tagify(input, {
                whitelist: levels,
                dropdown: {
                    maxItems: 50,
                    enabled: 1,
                    closeOnSelect: false,
                    searchKeys: ['label', 'searchBy'],
                    highlightFirst: true,
                    placeAbove: false,
                    appendTarget: document.body
                },
                enforceWhitelist: true,
                maxTags: 10,
                placeholder: 'Search and select levels...',
                editTags: false,
                delimiters: null,
                templates: {
                    tag: function(tagData) {
                        return `
                            <tag title="${tagData.label}"
                                 contenteditable='false'
                                 spellcheck='false'
                                 class="tagify__tag ${tagData.class ? tagData.class : ''}"
                                 ${this.getAttributes(tagData)}>
                                <x title="Remove" class="tagify__tag__removeBtn"></x>
                                <div class="tagify__tag-text">${tagData.label}</div>
                            </tag>
                        `;
                    },
                    dropdownItem: function(tagData) {
                        return `
                            <div ${this.getAttributes(tagData)}
                                 class='tagify__dropdown__item ${tagData.class ? tagData.class : ''}'
                                 tabindex="0"
                                 role="option">
                                <strong>${tagData.label.split(' - ')[0]}</strong>
                                <span>${tagData.label.split(' - ')[1]}</span>
                            </div>
                        `;
                    }
                },
                transformTag: function(tagData) {
                    tagData.label = tagData.label || tagData.value;
                    tagData.class = 'level-tag';
                },
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value)
            });

            tagify.on('add', function(e) {
                const { data: tagData } = e.detail;
                console.log('Level added:', tagData);
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });

            tagify.on('remove', function(e) {
                const { data: tagData } = e.detail;
                console.log('Level removed:', tagData);
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });

            tagify.on('invalid', function(e) {
                console.warn('Invalid level selection:', e.detail);
            });

            input.addEventListener('focus', function() {
                tagify.dropdown.show();
            });
        });
    </script>
@endpush
