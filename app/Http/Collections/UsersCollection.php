<?php 

namespace App\Http\Collections;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection{


     /**
         * Transform the resource collection into an array.
         *
         * @return array<int|string, mixed>
         */
    

    public function toArray(Request $request){


        return [
            'data' => UserResource::collection($this->collection),
            'pagination' => [
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'total' => $this->total(),
                'from' => $this->count()
             
        ]

        ];
    }


}