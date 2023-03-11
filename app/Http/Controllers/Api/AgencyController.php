<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return AgencyResource::collection($agencies);
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
            'name' => 'required|string|max:255|unique:agencies',
            'email' => 'required|string|email|max:255|unique:agencies',
            'commission_percent' => 'required|numeric',
            'color' => 'required|string|max:255|unique:agencies',
        ]);

        $agency = Agency::create([
            'name' => $request->name,
            'email' => $request->email,
            'commission_percent' => $request->commission_percent,
            'color' => $request->color,
        ]);

        return AgencyResource::make($agency);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = Agency::include()->findOrFail($id);

        return AgencyResource::make($agency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:agencies,name,'.$agency->id,
            'email' => 'required|string|email|max:255|unique:agencies,email,'.$agency->id,
            'commission_percent' => 'required|numeric',
            'color' => 'required|string|max:255|unique:agencies,color,'.$agency->id,
        ]);

        $agency->update($request->all());

        return AgencyResource::make($agency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->softDeleted($agency->id);

        return response()->json([
            'message' => 'Deleted successfully'
        ]);


    }
}
