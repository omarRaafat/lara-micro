<?php

namespace App\Exceptions;

use App\Traits\HandleResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class customModelNotFoundException extends ModelNotFoundException
{
    use HandleResponse;
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null){
        parent::__construct($message , $code);
    }

    public function render($request){
        if($request->wantsJson()){
          
           return $this->handelResponse(
                $this->getCode(),
                [],
                $this->getMessage(),     
            );

        }
    }
}
