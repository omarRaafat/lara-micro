<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehousesResource extends JsonResource
{
  
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_translations' => $this->getTranslations('name')??null,
            'is_active' => $this->is_active, // TODO: use enum
            'user' => $this->whenLoaded('user')? UserResource::make($this->whenLoaded('user')??NULL) : null,
            'area' => $this->relationLoaded('warehouseArea')?  AreasResource::make($this->warehouseArea?->area) : null,
            
        ];

       
    }
}
