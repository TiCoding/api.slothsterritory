<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'schedule' => $this->schedule,
            'capacity' => $this->capacity,
            'deadline_hour' => $this->deadline_hour,
            'tour_id' => $this->tour_id,
            'tour' => TourResource::make($this->whenLoaded('tour')),
        ];
    }
}
