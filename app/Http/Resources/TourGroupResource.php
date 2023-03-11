<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourGroupResource extends JsonResource
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
            'guide_id' => $this->guide_id,
            'date' => $this->date,
            'schedule' => $this->schedule,
            'guide' => GuideResource::make($this->whenLoaded('guide')),
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
        ];
    }
}
