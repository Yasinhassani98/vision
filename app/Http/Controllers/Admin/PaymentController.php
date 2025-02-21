<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $query = Payment::query();
        if ($parent = request('parent_name')) {
            $query->whereHas('parent', function ($query) use ($parent) {
                $query->where('name', 'like', '%' . $parent . '%');
            });
        }
        if ($amount = request('amount')) {
            $query->where('amount', $amount);
        }
        if ($status = request('status')) {
            $query->where('status', $status);
        }
        if ($payment_date = request('payment_date')) {
            $query->where('payment_date','like', '%'.$payment_date.'%');
        }

        $payments = $query->with('parent')
                         ->orderBy('payment_date', 'desc')
                         ->paginate();

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $parents = User::where('role', 'parent')->get();
        return view('admin.payments.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'parent_id' => 'required|exists:users,id,role,parent',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date_format:Y-m-d\TH:i|before_or_equal:' . now()->format('Y-m-d\TH:i'),
            'status' => 'required|in:confirmed,partly,failed,pending',
        ]);

        Payment::create($request->all());

        return redirect()->route('admin.payments.index')
                         ->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $parents = User::where('role', 'parent')->get();
        return view('admin.payments.edit', compact('payment', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'parent_id' => 'required|exists:users,id,role,parent',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date_format:Y-m-d\TH:i|before_or_equal:' . now()->format('Y-m-d\TH:i'),
            'status' => 'required|in:confirmed,partly,failed,pending',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.payments.index')
                         ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $payment->delete();

        return redirect()->route('admin.payments.index')
                         ->with('success', 'Payment deleted successfully.');
    }
}
