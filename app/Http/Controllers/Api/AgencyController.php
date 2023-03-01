<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();
        return $agencies;
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
            'commission_dollars' => 'required|numeric',
            'commission_percent' => 'required|numeric',
            'color' => 'required|string|max:255|unique:agencies',
        ]);

        $agency = Agency::create([
            'name' => $request->name,
            'email' => $request->email,
            'commission_dollars' => $request->commission_dollars,
            'commission_percent' => $request->commission_percent,
            'color' => $request->color,
        ]);

        return $agency;
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

        return $agency;
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
            'commission_dollars' => 'required|numeric',
            'commission_percent' => 'required|numeric',
            'color' => 'required|string|max:255|unique:agencies,color,'.$agency->id,
        ]);

        $agency->update($request->all());

        return $agency;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();
        return response()->json([
            'message' => 'Agency deleted successfully'
        ]);
    }
}
