<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
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
            'guide_status_id' => $this->guide_status_id,
            'guideStatus' => GuideStatusResource::make($this->whenLoaded('guideStatus')),
            'tourGroups' => TourGroupResource::collection($this->whenLoaded('tourGroups')),
            'tourGroups.reservations' => ReservationResource::collection($this->whenLoaded('tourGroups.reservations')),
        ];
    }
}
