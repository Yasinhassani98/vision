@extends('layout.main')
@section('title', 'Payment Details')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Payment Details</h5>
                                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Payment List
                                </a>
                            </div>
                            <div class="mb-3">
                                <h6>Parent Name:</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $payment->parent->name }}</p>
                                    <a href="{{ route('admin.users.show', $payment->parent->id) }}" class="btn btn-sm btn-outline-primary ms-3 d-inline-flex align-items-center">
                                        <i class="bi bi-eye me-1"></i>
                                        <span>View Profile</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6>Amount:</h6>
                                <p>${{ number_format($payment->amount, 2) }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Payment Date:</h6>
                                <p>{{ $payment->payment_date }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Status:</h6>
                                <p>{{ ucfirst($payment->status) }}</p>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-outline-warning">Edit</a>
                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
