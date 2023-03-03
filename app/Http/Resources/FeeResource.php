<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeeResource extends JsonResource
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
            'amount_dollars' => $this->amount_dollars,
            'amount_colones' => $this->amount_colones,
            'reservation_id' => $this->reservation_id,
            'payment_status_id' => $this->payment_status_id,
            'reservation' => ReservationResource::make($this->whenLoaded('reservation')),
            'paymentStatus' => PaymentStatusResource::make($this->whenLoaded('paymentStatus')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'payments.paymentMethod' => PaymentMethodResource::collection($this->whenLoaded('payments.paymentMethod')),
            'payments.paymentType' => PaymentTypeResource::collection($this->whenLoaded('payments.paymentType')),
        ];
    }
}
