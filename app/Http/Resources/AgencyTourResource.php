<?php

namespace App\Http\Resources;

use App\Models\Agency;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyTourResource extends JsonResource
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
            'agency_id' => $this->agency_id,
            'tour_id' => $this->tour_id,
            'agency' => AgencyResource::make($this->whenLoaded('agency')),
            'tour' => TourResource::make($this->whenLoaded('tour')),
            'customDates' => CustomDateResource::collection($this->whenLoaded('customDates')),
            'customDates.customPrice' => CustomPriceResource::collection($this->whenLoaded('customDates.customPrice')),
            'customDates.customSchedules' => CustomScheduleResource::collection($this->whenLoaded('customDates.customSchedules')),
        ];
    }
}
