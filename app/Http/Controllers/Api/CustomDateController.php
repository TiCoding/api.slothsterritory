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
        $existCustomDate = CustomDate::where( function ($query) use ($request) {
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
                                        ->first();

        if ($existCustomDate) {

            // TODO: que pasa cuando cae encima de 2 o mas custom dates

            // Switch
            switch ($existCustomDate) {
                // Case 1
                case $existCustomDate->start_date < $request->start_date && $existCustomDate->end_date > $request->end_date:

                    // chage range of exist custom date
                    $existCustomDateRange_1 = CustomDate::create([
                        'start_date' => $existCustomDate->start_date,
                        'end_date' => Carbon::parse($request->start_date)->subDay(),
                        'agency_tour_id' => $existCustomDate->agency_tour_id,
                    ]);

                    $existCustomDateRange_2 = CustomDate::create([
                        'start_date' => Carbon::parse($request->end_date)->addDay(),
                        'end_date' => $existCustomDate->end_date,
                        'agency_tour_id' => $existCustomDate->agency_tour_id,
                    ]);

                    // delete old custom date
                    $existCustomDate->delete();

                    break;

                // Case 2
                case $existCustomDate->start_date < $request->start_date && $existCustomDate->end_date < $request->end_date:

                    // chage range of exist custom date
                    $existCustomDateRange_1 = CustomDate::create([
                        'start_date' => $existCustomDate->start_date,
                        'end_date' => Carbon::parse($request->start_date)->subDay(),
                        'agency_tour_id' => $existCustomDate->agency_tour_id,
                    ]);

                    // delete old custom date
                    $existCustomDate->delete();

                    break;
                // Case 3
                case $existCustomDate->start_date > $request->start_date && $existCustomDate->end_date > $request->end_date:

                    // chage range of exist custom date
                    $existCustomDateRange_1 = CustomDate::create([
                        'start_date' => Carbon::parse($request->end_date)->addDay(),
                        'end_date' => $existCustomDate->end_date,
                        'agency_tour_id' => $existCustomDate->agency_tour_id,
                    ]);

                    // delete old custom date
                    // $this->destroy($existCustomDate);
                    $existCustomDate->delete();

                    break;

                // Case 4
                case $existCustomDate->start_date >= $request->start_date && $existCustomDate->end_date <= $request->end_date:

                    // delete old custom date
                    $existCustomDate->delete();

                    break;

                default:
                    # code...
                    break;
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
        $customDate->softDeleted( $customDate->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
