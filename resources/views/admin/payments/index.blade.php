@extends('layout.main')
@section('title', 'Payment List')
@section('content')
    <!-- Striped rows start -->
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Payment Information</h5>
                                <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add New Payment
                                </a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!-- Query Filter Form -->
                            <form method="GET" action="{{ route('admin.payments.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-front.input name="parent_name" placeholder="Parent Name" value="{{ request('parent_name') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.select name="status" :options="['' => 'Select Status', 'confirmed' => 'Confirmed', 'partly' => 'Partly', 'failed' => 'Failed', 'pending' => 'Pending']" selected="{{ request('status') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <x-front.input type="date" name="payment_date" placeholder="Payment Date" value="{{ request('payment_date') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-secondary">Filter</button>
                                        <a href="{{ route('admin.payments.index') }}" class="text-blue mx-">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>PARENT NAME</th>
                                        <th>AMOUNT</th>
                                        <th>PAYMENT DATE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $payment)
                                    <tr>
                                        <td class="text-bold-500">{{ $payment->parent->name ?? 'N/A' }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ ucfirst($payment->status) }}</td>
                                        <td>
                                            <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-outline-success">Show</a>
                                            <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination links -->
                            <nav>
                                <ul class="pagination pagination-primary mt-3">
                                    {{ $payments->withQueryString()->links() }}
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
