<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::include()
                        ->filter()
                        ->sort()
                        ->getOrPaginate();
        return TourResource::collection($tours);
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
            'name' => 'required|string|unique:tours',
            'description' => 'required|string',
            'path_image' => 'required|string',
        ]);

        $tour = Tour::create($request->all());

        return TourResource::make($tour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour::include()->findOrFail($id);
        return TourResource::make($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'name' => 'required|string|unique:tours,name,' . $tour->id,
            'description' => 'required|string',
            'path_image' => 'required|string',
        ]);

        $tour->update($request->all());

        return TourResource::make($tour);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $tour->update(['deleted_at' => now()]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
