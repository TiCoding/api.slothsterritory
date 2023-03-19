<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomScheduleResource;
use App\Models\CustomSchedule;
use Illuminate\Http\Request;

class CustomScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customSchedules = CustomSchedule::include()
            ->filter()
            ->sort()
            ->getOrPaginate();
        return CustomScheduleResource::collection($customSchedules);
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
            'schedule' => 'required',
            'capacity' => 'required|integer',
            'hours_before' => 'required|integer',
            'custom_date_id' => 'required|integer|exists:custom_dates,id|unique:custom_schedules',
        ]);

        $customSchedule = CustomSchedule::create($request->all());

        return CustomScheduleResource::make($customSchedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomSchedule  $customSchedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customSchedule = CustomSchedule::include()->findOrFail($id);
        return CustomScheduleResource::make($customSchedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomSchedule  $customSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomSchedule $customSchedule)
    {
        $request->validate([
            'schedule' => 'required',
            'capacity' => 'required|integer',
            'hours_before' => 'required|integer',
            'custom_date_id' => 'required|integer|exists:custom_dates,id',
        ]);

        $customSchedule->update($request->all());

        return CustomScheduleResource::make($customSchedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomSchedule  $customSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomSchedule $customSchedule)
    {
        $customSchedule->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
