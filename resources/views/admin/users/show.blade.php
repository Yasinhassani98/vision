@extends('layout.main')
@section('title', 'User Details')
@section('content')
    <div class="container">
        @if($user->hasRole('parent'))
        <div class="row gutters">
            <!-- Top Cards -->
            <div class="col-md-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body d-flex align-items-center py-4 px-4">
                        <div class="me-3">
                            <i class="bi bi-cash-stack text-primary fs-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-2">Total Parent Fee</h5>
                            <p class="card-text mb-0 fs-6 fw-bold">${{ number_format($user->totalParentFee(), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body d-flex align-items-center py-4 px-4">
                        <div class="me-3">
                            <i class="bi bi-cash-stack text-success fs-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-2">Total Parent Payments</h5>
                            <p class="card-text mb-0 fs-6 fw-bold">${{ number_format($user->totalParentPayments(), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-danger shadow-sm">
                    <div class="card-body d-flex align-items-center py-4 px-4">
                        <div class="me-3">
                            <i class="bi bi-cash-stack text-danger fs-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-2">Delayed Fee</h5>
                            <p class="card-text mb-0 fs-6 fw-bold">${{ number_format($user->totalParentFee() - $user->totalParentPayments(), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h5 class="user-name text-center mt-4">{{ $user->name }}</h5>
                                <h6 class="user-email text-center">{{ $user->email }}</h6>
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
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to User List
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
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
                                    <x-front.input name="email" type="email" placeholder="Enter email ID" label="Email"
                                        value="{{ old('email', $user->email) }}" />
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <x-front.input name="password" type="password" placeholder="Enter password" label="Password"
                                        value="{{ old('password')}}" />
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <x-front.input name="password.confirmation" type="password" placeholder="Enter password confirmation" label="Password Confirmation"
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
                                    <x-front.select name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']"
                                        selected="{{ old('status', $user->status) }}" />
                                </div>
                            
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <x-front.select name="role" label="Role" :options="[
                                        'admin' => 'Admin',
                                        'parent' => 'Parent',
                                        'transport manager' => 'Transport Manager',
                                        'teacher' => 'Teacher',
                                        'supervisor' => 'Supervisor',
                                    ]"
                                        selected="{{ old('role', $user->role) }}" />
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <x-front.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']"
                                        selected="{{ old('gender', $user->gender) }}" />
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <x-front.input name="DOB" type="date" placeholder="Enter Date of Birth"
                                        label="Date of Birth" value="{{ old('DOB', $user->DOB) }}" />
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
