<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomPriceResource extends JsonResource
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
            'adult_price' => $this->adult_price,
            'child_price' => $this->child_price,
            'custom_date_id' => $this->custom_date_id,
            'customDate' => CustomDateResource::make($this->whenLoaded('customDate')),
        ];
    }
}
