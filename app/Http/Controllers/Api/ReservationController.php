<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Mail\ReservationMail;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::include()
            ->filter()
            ->filterByDate()
            ->sort()
            ->getOrPaginate();
        return ReservationResource::collection($reservations);
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
            'amount_adults' => 'required|integer',
            'amount_children' => 'required|integer',
            'amount_children_free' => 'required|integer',
            'total_price_dollars' => 'required|numeric',
            'total_price_colones' => 'required|numeric',
            'discount_dollars' => 'required|numeric',
            'discount_colones' => 'required|numeric',
            'taxes_dollars' => 'required|numeric',
            'taxes_colones' => 'required|numeric',
            'net_price_dollars' => 'required|numeric',
            'net_price_colones' => 'required|numeric',
            'invoice' => 'string',
            'comments' => 'string',
            'date' => 'required|date',
            'adult_price_dollars' => 'required|numeric',
            'adult_price_colones' => 'required|numeric',
            'child_price_dollars' => 'required|numeric',
            'child_price_colones' => 'required|numeric',
            'schedule' => 'required',
            'agency_id' => 'required|integer|exists:agencies,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_status_id' => 'required|integer|exists:payment_statuses,id',
            'reservation_status_id' => 'required|integer|exists:reservation_statuses,id',
            'tour_id' => 'required|integer|exists:tours,id',
            'tour_group_id' => 'required|integer|exists:tour_groups,id',
            'attachment' => [
                'sometimes',
                'file',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->payment_status_id == 2 && !$value) {
                        $fail("The $attribute field is required when payment status is payed.");
                    }
                },
            ]
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $reservation = Reservation::create($data);

        if ($request->hasFile('file')) {
            $url = Storage::disk('local')->put('payments', $request->file('file'));
            $date = Carbon::createFromFormat('Y-m-d', '2022-12-03');

            $paymentMethod = PaymentMethod::where('name', 'Tarjeta')->first();
            $paymentType = PaymentType::where('name', 'Reserva')->first();

            $payment = [
                'dollar_amount' => $request->net_price_dollars,
                'colones_amount' => $request->total_price_colones,
                'payment_date' => $date->format('Y-m-d'),
                'path_file' => $url,
                'comments' => $request->comments,
                'paymentable_id' => $reservation->id,
                'payment_method_id' => $paymentMethod->id,
                'payment_type_id' => $paymentType->id,
            ];
            Payment::create($payment);
        }

        return ReservationResource::make($reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::include()->findOrFail($id);
        return ReservationResource::make($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'amount_adults' => 'required|integer',
            'amount_children' => 'required|integer',
            'amount_children_free' => 'required|integer',
            'total_price_dollars' => 'required|numeric',
            'total_price_colones' => 'required|numeric',
            'discount_dollars' => 'required|numeric',
            'discount_colones' => 'required|numeric',
            'taxes_dollars' => 'required|numeric',
            'taxes_colones' => 'required|numeric',
            'net_price_dollars' => 'required|numeric',
            'net_price_colones' => 'required|numeric',
            'invoice' => 'string',
            'comments' => 'string',
            'date' => 'required|date',
            'adult_price_dollars' => 'required|numeric',
            'adult_price_colones' => 'required|numeric',
            'child_price_dollars' => 'required|numeric',
            'child_price_colones' => 'required|numeric',
            'schedule' => 'required',
            'agency_id' => 'required|integer|exists:agencies,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_status_id' => 'required|integer|exists:payment_statuses,id',
            'reservation_status_id' => 'required|integer|exists:reservation_statuses,id',
            'tour_id' => 'required|integer|exists:tours,id',
            'tour_group_id' => 'required|integer|exists:tour_groups,id',
        ]);

        // check if update payment status and if this reservation has a payment
        if ($request->payment_status_id != $reservation->payment_status_id && $reservation->payment == null) { // TODO: pendiente validar que el nuevo estado es pagado
            return response()->json([
                'message' => 'No se puede cambiar el estado de pago de esta reservación porque no tiene un pago asociado'
            ], 400);
        }

        $reservation->update($request->all());

        return ReservationResource::make($reservation);
    }

    /**
     * send the specified resource to mail.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function sendMail($id)
    {
        try {
            //code...
            $reservation = Reservation::with('tour', 'customer', 'agency')->findOrFail($id);

            // Log::info($reservation['tour']['name']);
            // Log::info($reservation['customer']['name']);
            // Log::info($reservation['agency']['name']);
            // Log::info($reservation['schedule']);
            // Log::info($reservation['invoice']);
            // Log::info($reservation['date']);
            // Log::info($reservation['amount_adults']);
            // Log::info($reservation['amount_children']);
            // Log::info($reservation['amount_children_free']);
            // Log::info($reservation['total_price_dollars']);
            // Log::info($reservation->customer->email);

            if ($reservation->customer->email) {
                Mail::to($reservation->customer->email)->send(new ReservationMail($reservation));

                return response(['mensaje' => 'correo enviado']);
            }

            return response(['mensaje' => 'correo de cliente no encontrado']);
        } catch (\Throwable $th) {
            Log::error($th);
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
