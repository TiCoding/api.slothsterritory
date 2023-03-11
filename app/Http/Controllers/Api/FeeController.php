<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeResource;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fee::include()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();
        return FeeResource::collection($fees);
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
            'amount_dollars' => 'required|numeric',
            'amount_colones' => 'required|numeric',
            'payment_status_id' => 'required|integer|exists:payment_status,id',
            'reservation_id' => 'required|integer|unique:fees|exists:reservations,id',
        ]);

        $fee = Fee::create($request->all());

        return FeeResource::make($fee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fee = Fee::include()->findOrFail($id);
        return FeeResource::make($fee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'amount_dollars' => 'required|numeric',
            'amount_colones' => 'required|numeric',
            'payment_status_id' => 'required|integer|exists:payment_status,id',
            'reservation_id' => 'required|integer|unique:fees,reservation_id|exists:reservations,id'.$fee->id,
        ]);

        if(!$fee->payment){ // TODO: pendiente validar que el nuevo estado es pagado
            return response()->json([
                'message' => 'No se puede editar, porque no tiene un pago asociado'
            ], 400);
        }

        $fee->update($request->all());

        return FeeResource::make($fee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        $fee->softDeleted( $fee->id);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
