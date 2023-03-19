<?php

namespace App\Http\Resources;

use App\Models\CustomSchedule;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomDateResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'agency_tour_id' => $this->agency_tour_id,
            'agencyTour' => AgencyTourResource::make($this->whenLoaded('agencyTour')),
            'customPrice' => CustomPriceResource::make($this->whenLoaded('customPrice')),

            // 'customSchedules' => CustomScheduleResource::collection($this->whenLoaded('customSchedules')),
            'customSchedules' => CustomScheduleResource::collection($this->whenLoaded('customSchedules', function () {
                return $this->customSchedules->sortBy('schedule');
            })),

            'agencyTour.tour' => TourResource::make($this->whenLoaded('agencyTour.tour')),
            'agencyTour.agency' => AgencyResource::make($this->whenLoaded('agencyTour.agency')),
            'agencyTour.agency.reservations' => ReservationResource::collection($this->whenLoaded('agencyTour.agency.reservations')),
        ];
    }
}
