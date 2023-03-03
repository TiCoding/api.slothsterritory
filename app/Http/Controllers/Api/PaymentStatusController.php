<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentStatusResource;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentStatuses = PaymentStatus::include()
                                        ->filter()
                                        ->sort()
                                        ->getOrPaginate();
        return PaymentStatusResource::collection($paymentStatuses);

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
            'name' => 'required|unique:payment_statuses'
        ]);

        $paymentStatus = PaymentStatus::create($request->all());

        return PaymentStatusResource::make($paymentStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentStatus = PaymentStatus::include()->findOrFail($id);
        return PaymentStatusResource::make($paymentStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentStatus $paymentStatus)
    {
        $request->validate([
            'name' => 'required|unique:payment_statuses,name,' . $paymentStatus->id
        ]);

        $paymentStatus->update($request->all());

        return PaymentStatusResource::make($paymentStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentStatus $paymentStatus)
    {
        $paymentStatus->update(['deleted_at' => now()]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
