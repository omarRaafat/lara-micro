<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreasResource extends JsonResource
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
            'name_translations' => $this->getTranslations('name')?? null,
            'is_active' => $this->is_active == 1 ? 'Active' : 'inActive',
            'latitude' => $this->lat,
            'longitude' => $this->long,
            'city' => $this->whenLoaded('city') ? CitiesResource::make($this->whenLoaded('city')?:null) : null, // load city,
            'warehouses' => $this->whenLoaded('warehouses') ? WarehouseAreasResource::collection($this->whenLoaded('warehouses')):NULL
        ];
    }
}
