@extends('layout.main')
@section('title', 'Edit Payment')
@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Edit Payment</h5>
                                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Payment List
                                </a>
                            </div>
                            <form action="{{ route('admin.payments.update', $payment->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="parent_id" :options="$parents->sortBy('name')->pluck('name', 'id')" placeholder="Select Parent" label="Parent" selected="{{ old('parent_id', $payment->parent_id) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.input name="payment_date" type="datetime-local" placeholder="Payment Date" label="Payment Date" value="{{ old('payment_date', date('Y-m-d\TH:i', strtotime($payment->payment_date))) }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-front.select name="status" label="Status" :options="['pending' => 'Pending', 'confirmed' => 'Confirmed', 'partly' => 'Partly', 'failed' => 'Failed']" selected="{{ old('status', $payment->status) }}" />
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary shadow mt-4">Update Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
