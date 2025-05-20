<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ServiceRecord;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('serviceRecord.car', 'serviceRecord.service')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $serviceRecords = ServiceRecord::whereDoesntHave('payment')
            ->with(['car', 'service'])
            ->get();
        return view('payments.create', compact('serviceRecords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_number' => 'required|unique:payments',
            'service_record_id' => 'required|exists:service_records,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable'
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load('serviceRecord.car', 'serviceRecord.service');
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $serviceRecords = ServiceRecord::whereDoesntHave('payment')
            ->orWhere('id', $payment->service_record_id)
            ->with(['car', 'service'])
            ->get();
        return view('payments.edit', compact('payment', 'serviceRecords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_number' => 'required|unique:payments,payment_number,' . $payment->id,
            'service_record_id' => 'required|exists:service_records,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable'
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment record deleted successfully.');
    }
}
