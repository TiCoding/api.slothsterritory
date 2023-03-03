<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'commission_dollars' => $this->commission_dollars,
            'commission_percent' => $this->commission_percent,
            'color' => $this->color,
            'email' => $this->email,
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
            'tours' => TourResource::collection($this->whenLoaded('tours')),
            'tours.schedules' => ScheduleResource::collection($this->whenLoaded('tours.schedules')),
            'agencyTours' => AgencyTourResource::collection($this->whenLoaded('agencyTours')),
            'agencyTours.customDates' => CustomDateResource::collection($this->whenLoaded('agencyTours.customDates')),
            'agencyTours.tour' => TourResource::collection($this->whenLoaded('agencyTours.tour')),
            'agencyTours.customDates.customPrice' => CustomPriceResource::collection($this->whenLoaded('agencyTours.customDates.customPrice')),
            'agencyTours.customDates.customSchedules' => CustomScheduleResource::collection($this->whenLoaded('agencyTours.customDates.customSchedules')),
        ];
    }
}
