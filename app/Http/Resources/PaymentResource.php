<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'dollar_amount' => $this->dollar_amount,
            'colones_amount' => $this->colones_amount,
            'payment_date' => $this->payment_date,
            'path_file' => $this->path_file,
            'comments' => $this->comments,
            'payment_type_id' => $this->payment_type_id,
            'payment_method_id' => $this->payment_method_id,
            'paymentable_id' => $this->paymentable_id,
            'paymentable_type' => $this->paymentable_type,
            'paymentType' => PaymentTypeResource::make($this->whenLoaded('paymentType')),
            'paymentMethod' => PaymentMethodResource::make($this->whenLoaded('paymentMethod')),
            'paymentable' => $this->paymentable,
        ];
    }
}
