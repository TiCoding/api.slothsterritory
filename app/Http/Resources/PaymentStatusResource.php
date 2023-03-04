<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentStatusResource extends JsonResource
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
            'name' => $this->name,
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
            'fees' => FeeResource::collection($this->whenLoaded('fees')),
            'commission' => CommissionResource::collection($this->whenLoaded('commission')),
        ];
    }
}
