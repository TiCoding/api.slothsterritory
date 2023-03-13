<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomDateResource;
use App\Models\CustomDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customDates = CustomDate::include()
                            ->filter()
                            ->sort()
                            ->getCustomDate()
                            ->getOrPaginate();
        return CustomDateResource::collection($customDates);
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'agency_tour_id' => 'required|integer|exists:agency_tours,id',
        ]);

        if ($request->start_date > $request->end_date) {
            return response()->json([
                'message' => 'La fecha de inicio no puede ser mayor a la fecha de fin'
            ], 422);
        }

        // if (now() > $request->start_date) {
        //     return response()->json([
        //         'message' => 'La fecha de inicio no puede ser menor a la fecha actual'
        //     ], 422);
        // }

        // this consult is for check if exist a custom date with the same start date or end date or between the start date and end date
        $existCustomDates = CustomDate::where( function ($query) use ($request) {
                                            $query
                                            ->where('start_date', '<=', $request->start_date)
                                            ->where('end_date', '>=', $request->start_date);
                                        })
                                        ->orWhere(function ($query) use ($request) {
                                            $query
                                            ->where('start_date', '<=', $request->end_date)
                                            ->where('end_date', '>=', $request->end_date);
                                        })
                                        ->orWhereBetween('start_date', [$request->start_date, $request->end_date])
                                        ->where('agency_tour_id', $request->agency_tour_id)
                                        ->get();

        // return $existCustomDates;
        if ($existCustomDates->count() > 0) {

            // for each custom date exist
            foreach ($existCustomDates as $currentExistCustomDate) {

                // Switch
                switch ($currentExistCustomDate) {
                    // Case 1
                    case $currentExistCustomDate->start_date < $request->start_date && $currentExistCustomDate->end_date > $request->end_date:

                        // chage range of exist custom date
                        $existCustomDateRange_1 = CustomDate::create([
                            'start_date' => $currentExistCustomDate->start_date,
                            'end_date' => Carbon::parse($request->start_date)->subDay(),
                            'agency_tour_id' => $currentExistCustomDate->agency_tour_id,
                        ]);

                        $existCustomDateRange_2 = CustomDate::create([
                            'start_date' => Carbon::parse($request->end_date)->addDay(),
                            'end_date' => $currentExistCustomDate->end_date,
                            'agency_tour_id' => $currentExistCustomDate->agency_tour_id,
                        ]);

                        break;

                    // Case 2
                    case $currentExistCustomDate->start_date < $request->start_date && $currentExistCustomDate->end_date < $request->end_date:

                        // chage range of exist custom date
                        $existCustomDateRange_1 = CustomDate::create([
                            'start_date' => $currentExistCustomDate->start_date,
                            'end_date' => Carbon::parse($request->start_date)->subDay(),
                            'agency_tour_id' => $currentExistCustomDate->agency_tour_id,
                        ]);

                        break;
                    // Case 3
                    case $currentExistCustomDate->start_date > $request->start_date && $currentExistCustomDate->end_date > $request->end_date:

                        // chage range of exist custom date
                        $existCustomDateRange_1 = CustomDate::create([
                            'start_date' => Carbon::parse($request->end_date)->addDay(),
                            'end_date' => $currentExistCustomDate->end_date,
                            'agency_tour_id' => $currentExistCustomDate->agency_tour_id,
                        ]);

                        break;

                    // Case 4
                    case $currentExistCustomDate->start_date >= $request->start_date && $currentExistCustomDate->end_date <= $request->end_date:

                        // delete old custom date
                        $currentExistCustomDate->delete();

                        break;

                    default:
                        # code...
                        break;
                }

                // delete old custom date
                $currentExistCustomDate->delete();

                // deletes first element of collection
                $existCustomDates->shift();

            }
        }

        $customDate = CustomDate::create($request->all());

        return CustomDateResource::make($customDate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customDate = CustomDate::include()->findOrFail($id);
        return CustomDateResource::make($customDate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomDate $customDate)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'agency_tour_id' => 'required|integer|exists:agency_tour,id',
        ]);

        $customDate->update($request->all());
        return CustomDateResource::make($customDate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomDate  $customDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomDate $customDate)
    {
        $customDate->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
