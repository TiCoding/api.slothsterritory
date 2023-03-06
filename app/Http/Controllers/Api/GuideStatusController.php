<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuideStatusResource;
use App\Models\GuideStatus;
use Illuminate\Http\Request;

class GuideStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guideStatuses = GuideStatus::include()
                                    ->filter()
                                    ->sort()
                                    ->getOrPaginate();
        return GuideStatusResource::collection($guideStatuses);
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
            'name' => 'required|string|unique:guide_statuses'
        ]);

        $guideStatus = GuideStatus::create($request->all());

        return GuideStatusResource::make($guideStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuideStatus  $guideStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guideStatus = GuideStatus::include()->findOrFail($id);
        return GuideStatusResource::make($guideStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GuideStatus  $guideStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuideStatus $guideStatus)
    {
        $request->validate([
            'name' => 'required|string|unique:guide_statuses,name,' . $guideStatus->id,
        ]);

        $guideStatus->update($request->all());

        return GuideStatusResource::make($guideStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuideStatus  $guideStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuideStatus $guideStatus)
    {
        $guideStatus->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
