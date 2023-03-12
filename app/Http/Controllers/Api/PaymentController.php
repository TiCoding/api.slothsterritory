<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return PaymentResource::collection($payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dollar_amount' => 'required|numeric',
            'colones_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'path_file' => 'required|string',
            'paymentable_id' => 'required|integer',
            'paymentable_type' => 'required|string',
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'payment_type_id' => 'required|integer|exists:payment_types,id',
        ]);

        $payment = Payment::create($request->all());

        return PaymentResource::make($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::include()->findOrFail($id);
        return PaymentResource::make($payment);
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
        $request->validate([
            'dollar_amount' => 'required|numeric',
            'colones_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'path_file' => 'required|string',
            'paymentable_id' => 'required|integer',
            'paymentable_type' => 'required|string',
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'payment_type_id' => 'required|integer|exists:payment_types,id',
        ]);

        $payment->update($request->all());

        return PaymentResource::make($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
