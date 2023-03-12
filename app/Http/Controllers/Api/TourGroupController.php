<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourGroupResource;
use App\Models\TourGroup;
use Illuminate\Http\Request;

class TourGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourGroups = TourGroup::include()
                                ->filter()
                                ->sort()
                                ->getOrPaginate();
        return TourGroupResource::collection($tourGroups);
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
            'name' => 'required|string',
            'date' => 'required|date',
            'schedule' => 'required|time',
            'guide_id' => 'required|integer|exists:guides,id',
        ]);

        $tourGroup = TourGroup::create($request->all());

        return TourGroupResource::make($tourGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourGroup  $tourGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourGroup = TourGroup::include()->findOrFail($id);
        return TourGroupResource::make($tourGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TourGroup  $tourGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourGroup $tourGroup)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'schedule' => 'required|time',
            'guide_id' => 'required|integer|exists:guides,id' . $tourGroup->id,
        ]);

        $tourGroup->update($request->all());

        return TourGroupResource::make($tourGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourGroup  $tourGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourGroup $tourGroup)
    {
        $tourGroup->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
