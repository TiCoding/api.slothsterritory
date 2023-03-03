<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationStatusResource;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;

class ReservationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservationStatuses = ReservationStatus::include()
                                                ->filter()
                                                ->sort()
                                                ->getOrPaginate();
        return ReservationStatusResource::collection($reservationStatuses);
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
            'name' => 'required|unique:reservation_statuses'
        ]);

        $reservationStatus = ReservationStatus::create($request->all());

        return ReservationStatusResource::make($reservationStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservationStatus = ReservationStatus::include()->findOrFail($id);
        return ReservationStatusResource::make($reservationStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservationStatus $reservationStatus)
    {
        $request->validate([
            'name' => 'required|unique:reservation_statuses,name,' . $reservationStatus->id
        ]);

        $reservationStatus->update($request->all());

        return ReservationStatusResource::make($reservationStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservationStatus $reservationStatus)
    {
        $reservationStatus->update(['deleted_at' => now()]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
