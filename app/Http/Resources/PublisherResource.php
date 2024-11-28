<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
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
            'description' => $this->description,
            'contact_name' => $this->contact_name,
            'contact_email' => $this->contact_email,
            'contact_phone_number' => $this->contact_phone_number,
            'address_street_1' => $this->address_street_1,
            'address_street_2' => $this->address_street_2,
            'address_city' => $this->address_city,
            'address_region' => $this->address_region,
            'address_country_id' => $this->address_country_id,
            'address_postal_zip' => $this->address_postal_zip,
        ];
    }
}
