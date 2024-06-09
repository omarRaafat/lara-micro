<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountriesResource extends JsonResource
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
                'name_translations' => $this->getTranslations('name'),
                'is_active' => $this->is_active == 1 ? 'active' : 'inactive',
                'flag' => $this->flag,
                'code' => $this->code,
                'cities' => $this->whenLoaded('cities') ? CitiesResource::collection($this->cities) : null
             
            
       ];
    }
}
