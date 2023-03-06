<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return CommissionResource::collection($commissions);
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
            'amount_dollars' => 'required|numeric',
            'amount_colones' => 'required|numeric',
            'payment_status_id' => 'required|integer|exists:payment_status,id',
            'reservation_id' => 'required|integer|unique:commissions|exists:reservations,id',
        ]);

        $commission = Commission::create($request->all());

        return CommissionResource::make($commission);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commission = Commission::include()->findOrFail($id);
        return CommissionResource::make($commission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'amount_dollars' => 'required|numeric',
            'amount_colones' => 'required|numeric',
            'payment_status_id' => 'required|integer|exists:payment_status,id',
            'reservation_id' => 'required|integer|unique:commissions,reservation_id|exists:reservations,id'. $commission->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        $commission->softDeleted( $commission->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
