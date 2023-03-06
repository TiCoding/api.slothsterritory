<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyTourResource;
use App\Models\AgencyTour;
use Illuminate\Http\Request;

class AgencyTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencyTours = AgencyTour::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return AgencyTourResource::collection($agencyTours);
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
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'tour_id' => 'required|integer|exists:tour,id',
            'agency_id' => 'required|integer|exists:agency,id',
        ]);

        $agencyTour = AgencyTour::create($request->all());

        return AgencyTourResource::make($agencyTour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AgencyTour  $agencyTour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agencyTour = AgencyTour::include()->findOrFail($id);
        return AgencyTourResource::make($agencyTour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AgencyTour  $agencyTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgencyTour $agencyTour)
    {
        $request->validate([
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'tour_id' => 'required|integer|exists:tour,id',
            'agency_id' => 'required|integer|exists:agency,id',
        ]);

        $agencyTour->update($request->all());

        return AgencyTourResource::make($agencyTour);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgencyTour  $agencyTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgencyTour $agencyTour)
    {
        $agencyTour->softDelete($agencyTour->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
