<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomDateResource;
use App\Models\CustomDate;
use Illuminate\Http\Request;

class CustomDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customDates = CustomDate::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return CustomDateResource::collection($customDates);
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
            'start_date' => 'required|date|unique:custom_dates',
            'end_date' => 'required|date|unique:custom_dates',
            'agency_tour_id' => 'required|integer|exists:agency_tour,id',
        ]);

        $customDate = CustomDate::create($request->all());

        return CustomDateResource::make($customDate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customDate = CustomDate::include()->findOrFail($id);
        return CustomDateResource::make($customDate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomDate $customDate)
    {
        $request->validate([
            'start_date' => 'required|date|unique:custom_dates,start_date' . $customDate->id,
            'end_date' => 'required|date|unique:custom_dates,end_date' . $customDate->id,
            'agency_tour_id' => 'required|integer|exists:agency_tour,id',
        ]);

        $customDate->update($request->all());
        return CustomDateResource::make($customDate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomDate $customDate)
    {
        $customDate->update(['deleted_at' => now()]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
