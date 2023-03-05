<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::include()
                                    ->filter()
                                    ->sort()
                                    ->getOrPaginate();
        return ReservationResource::collection($reservations);
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
            'amount_adults' => 'required|integer',
            'amount_children' => 'required|integer',
            'amount_children_free' => 'required|integer',
            'total_price_dollars' => 'required|numeric',
            'total_price_colones' => 'required|numeric',
            'discount_dollars' => 'required|numeric',
            'discount_colones' => 'required|numeric',
            'taxes_dollars' => 'required|numeric',
            'taxes_colones' => 'required|numeric',
            'net_price_dollars' => 'required|numeric',
            'net_price_colones' => 'required|numeric',
            'invoice' => 'string',
            'comments' => 'string',
            'date' => 'required|date',
            'adult_price_dollars' => 'required|numeric',
            'adult_price_colones' => 'required|numeric',
            'child_price_dollars' => 'required|numeric',
            'child_price_colones' => 'required|numeric',
            'schedule' => 'required',
            'agency_id' => 'required|integer|exists:agencies,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_status_id' => 'required|integer|exists:payment_statuses,id',
            'reservation_status_id' => 'required|integer|exists:reservation_statuses,id',
            'tour_id' => 'required|integer|exists:tours,id',
            'tour_group_id' => 'required|integer|exists:tour_groups,id',
        ]);

        $reservation = Reservation::create($request->all());

        return ReservationResource::make($reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::include()->findOrFail($id);
        return ReservationResource::make($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'amount_adults' => 'required|integer',
            'amount_children' => 'required|integer',
            'amount_children_free' => 'required|integer',
            'total_price_dollars' => 'required|numeric',
            'total_price_colones' => 'required|numeric',
            'discount_dollars' => 'required|numeric',
            'discount_colones' => 'required|numeric',
            'taxes_dollars' => 'required|numeric',
            'taxes_colones' => 'required|numeric',
            'net_price_dollars' => 'required|numeric',
            'net_price_colones' => 'required|numeric',
            'invoice' => 'string',
            'comments' => 'string',
            'date' => 'required|date',
            'adult_price_dollars' => 'required|numeric',
            'adult_price_colones' => 'required|numeric',
            'child_price_dollars' => 'required|numeric',
            'child_price_colones' => 'required|numeric',
            'schedule' => 'required',
            'agency_id' => 'required|integer|exists:agencies,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_status_id' => 'required|integer|exists:payment_statuses,id',
            'reservation_status_id' => 'required|integer|exists:reservation_statuses,id',
            'tour_id' => 'required|integer|exists:tours,id',
            'tour_group_id' => 'required|integer|exists:tour_groups,id',
        ]);

        $reservation->update($request->all());

        return ReservationResource::make($reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
