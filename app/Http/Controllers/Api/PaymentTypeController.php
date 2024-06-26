<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentTypes = PaymentType::include()
                                        ->filter()
                                        ->sort()
                                        ->getOrPaginate();
        return PaymentTypeResource::collection($paymentTypes);
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
            'name' => 'required|unique:payment_types'
        ]);

        $paymentType = PaymentType::create($request->all());

        return PaymentTypeResource::make($paymentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentType = PaymentType::include()->findOrFail($id);
        return PaymentTypeResource::make($paymentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        info('LEGA');
        info($request->all());
        $request->validate([
            'name' => 'required|unique:payment_types,name,'.$paymentType->id
        ]);

        $paymentType->update($request->all());

        return PaymentTypeResource::make($paymentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
