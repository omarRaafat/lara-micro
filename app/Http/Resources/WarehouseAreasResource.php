<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseAreasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->warehouse->id,
            'name' => $this->warehouse->name,
            'name_translations' => $this->warehouse->getTranslations('name')??null,
            'is_active' => $this->warehouse->is_active == 1 ? 'active' : 'inactive', // TODO: use enum
            'user' => $this->warehouse->user_id
        ];
    }
}
