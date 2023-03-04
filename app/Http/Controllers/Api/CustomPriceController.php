<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomPriceResource;
use App\Models\CustomPrice;
use Illuminate\Http\Request;

class CustomPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customPrices = CustomPrice::include()
                            ->filter()
                            ->sort()
                            ->getOrPaginate();
        return CustomPriceResource::collection($customPrices);
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
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'custom_date_id' => 'required|integer|exists:custom_dates,id|unique:custom_prices',
        ]);

        $customPrice = CustomPrice::create($request->all());

        return CustomPriceResource::make($customPrice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomPrice  $customPrice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customPrice = CustomPrice::include()->findOrFail($id);
        return CustomPriceResource::make($customPrice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomPrice  $customPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomPrice $customPrice)
    {
        $request->validate([
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'custom_date_id' => 'required|integer|exists:custom_dates,id|unique:custom_prices,custom_date_id,'.$customPrice->id,
        ]);

        $customPrice->update($request->all());

        return CustomPriceResource::make($customPrice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomPrice  $customPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomPrice $customPrice)
    {
        $customPrice->update(['deleted_at' => now()]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
