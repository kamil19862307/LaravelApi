<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postal_code,

            // by using this "whenLoaded" method, we are able to conditionally include the related information for our resource
            // Используя метод `whenLoaded`, мы можем условно включать связанную информацию для нашего ресурса.
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}
