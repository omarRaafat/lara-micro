<?php 


namespace App\Http\Collections;

use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class postCommentsCollection extends ResourceCollection{



    public function toArray($request){
        return 
        [
            "comments" => CommentsResource::collection($this->collection),
            "pagination" => [
               
                "per_page" => $this->perPage(),
                "total" => $this->total(),
              
            ]
            
        ];
    }


}



?>