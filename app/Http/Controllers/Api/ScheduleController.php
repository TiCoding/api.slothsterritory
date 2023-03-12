<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return ScheduleResource::collection($schedules);
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
            'schedule' => 'required|unique:schedules',
            'capacity' => 'required|integer',
            'deadline_hour' => 'required',
            'tour_id' => 'required|integer|exists:tour,id',
        ]);

        $schedule = Schedule::create($request->all());

        return ScheduleResource::make($schedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::include()->findOrFail($id);
        return ScheduleResource::make($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'schedule' => 'required|unique:schedules,schedule,' . $schedule->id,
            'capacity' => 'required|integer',
            'deadline_hour' => 'required',
            'tour_id' => 'required|integer|exists:tour,id',
        ]);

        $schedule->update($request->all());

        return ScheduleResource::make($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
