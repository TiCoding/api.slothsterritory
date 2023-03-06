<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount_adults' => $this->amount_adults,
            'amount_children' => $this->amount_children,
            'amount_children_free' => $this->amount_children_free,
            'total_price_dollars' => $this->total_price_dollars,
            'total_price_colones' => $this->total_price_colones,
            'discount_dollars' => $this->discount_dollars,
            'discount_colones' => $this->discount_colones,
            'taxes_dollars' => $this->taxes_dollars,
            'taxes_colones' => $this->taxes_colones,
            'net_price_dollars' => $this->net_price_dollars,
            'net_price_colones' => $this->net_price_colones,
            'invoice' => $this->invoice,
            'comments' => $this->comments,
            'date' => $this->date,
            'adult_price_dollars' => $this->adult_price_dollars,
            'adult_price_colones' => $this->adult_price_colones,
            'child_price_dollars' => $this->child_price_dollars,
            'child_price_colones' => $this->child_price_colones,
            'schedule' => $this->schedule,
            'agency_id' => $this->agency_id,
            'customer_id' => $this->customer_id,
            'payment_status_id' => $this->payment_status_id,
            'reservation_status_id' => $this->reservation_status_id,
            'tour_id' => $this->tour_id,
            'tour_group_id' => $this->tour_group_id,
            'user_id' => $this->user_id,
            'agency' => AgencyResource::make($this->whenLoaded('agency')),
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
            'paymentStatus' => PaymentStatusResource::make($this->whenLoaded('paymentStatus')),
            'reservationStatus' => ReservationStatusResource::make($this->whenLoaded('reservationStatus')),
            'tour' => TourResource::make($this->whenLoaded('tour')),
            'tourGroup' => TourGroupResource::make($this->whenLoaded('tourGroup')),
            'tourGroup.guide' => GuideResource::make($this->whenLoaded('tourGroup.guide')),
            'tour.schedules' => ScheduleResource::collection($this->whenLoaded('tour.schedules')),
            'agency.tours' => TourResource::collection($this->whenLoaded('agency.tours')),
            'agency.agencyTours' => AgencyTourResource::collection($this->whenLoaded('agency.agencyTours')),
            'agency.agencyTours.customDates' => CustomDateResource::collection($this->whenLoaded('agency.agencyTours.customDates')),
            'agency.agencyTours.customDates.customPrice' => CustomPriceResource::make($this->whenLoaded('agency.agencyTours.customDates.customPrice')),
            'agency.agencyTours.customDates.customSchedules' => CustomScheduleResource::collection($this->whenLoaded('agency.agencyTours.customDates.customSchedules')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'payments.paymentMethod' => PaymentMethodResource::collection($this->whenLoaded('payments.paymentMethod')),
            'payments.paymentType' => PaymentTypeResource::collection($this->whenLoaded('payments.paymentType')),
            'agencyData' => AgencyDataResource::make($this->whenLoaded('agencyData')),
            'fee' => FeeResource::make($this->whenLoaded('fee')),
            'fee.paymentStatus' => PaymentStatusResource::make($this->whenLoaded('fee.paymentStatus')),
            'fee.payments' => PaymentResource::collection($this->whenLoaded('fee.payments')),
            'commission' => CommissionResource::make($this->whenLoaded('commission')),
            'commission.paymentStatus' => PaymentStatusResource::make($this->whenLoaded('commission.paymentStatus')),
            'commission.payments' => PaymentResource::collection($this->whenLoaded('commission.payments')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
