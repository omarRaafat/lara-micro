<?php

namespace App\Traits;
trait HandleResponse {


    public function handelResponse($reponse_code = null ,$response_data = null, $reponse_message = null ){
        return response()->json([
            'data' => [
                'response_code' => $reponse_code,
                'response_message' => $reponse_message,
                "response_data" => $response_data
            ]
        
        ],$reponse_code??200);
    } 

}


?>