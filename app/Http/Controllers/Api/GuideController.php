<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuideResource;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides = Guide::include()
                        ->filter()
                        ->sort()
                        ->getOrPaginate();
        return GuideResource::collection($guides);
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
            'guide_status_id' =>    'required|integer|exists:guide_status,id',
        ]);

        $guide = Guide::create($request->all());

        return GuideResource::make($guide);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guide = Guide::include()->findOrFail($id);
        return GuideResource::make($guide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guide $guide)
    {
        $request->validate([
            'name' => 'required|string',
            'guide_status_id' => 'required|integer|exists:guide_status,id',
        ]);

        $guide->update($request->all());

        return GuideResource::make($guide);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guide $guide)
    {
        $guide->softDeleted( $guide->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
