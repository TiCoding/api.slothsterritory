<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyDataResource;
use App\Models\AgencyData;
use Illuminate\Http\Request;

class AgencyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencyData = AgencyData::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return AgencyDataResource::collection($agencyData);
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
            'agent_name' => 'required|string|max:255',
            'reservation_id' => 'required|integer|exists:reservations,id',
        ]);

        $agencyData = AgencyData::create($request->all());

        return AgencyDataResource::make($agencyData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AgencyData  $agencyData
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agencyData = AgencyData::include()->findOrFail($id);
        return AgencyDataResource::make($agencyData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AgencyData  $agencyData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgencyData $agencyData)
    {
        $request->validate([
            'agent_name' => 'required|string|max:255',
            'reservation_id' => 'required|integer|exists:reservations,id',
        ]);

        $agencyData->update($request->all());

        return AgencyDataResource::make($agencyData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgencyData  $agencyData
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgencyData $agencyData)
    {
        $agencyData->softDeleted($agencyData->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
