<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
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
            'description' => $this->description,
            'path_image' => $this->path_image,
            'adult_price' => $this->adult_price,
            'child_price' => $this->child_price,

            // 'schedules' => ScheduleResource::collection($this->whenLoaded('schedules')), //->sortBy('schedule'),
            'schedules' => ScheduleResource::collection($this->whenLoaded('schedules', function () {
                return $this->schedules->sortBy('schedule');
            })),

            'agencies' => AgencyResource::collection($this->whenLoaded('agencies')),
            'agencyTours' => AgencyTourResource::collection($this->whenLoaded('agencyTours')),
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
        ];
    }
}
