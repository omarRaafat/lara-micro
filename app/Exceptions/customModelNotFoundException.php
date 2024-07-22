<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Traits\HandleResponse;
use Sentry\State\HubInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class customModelNotFoundException extends Exception
{
    use HandleResponse;
    protected $sentry;
    public function __construct(string $message = "", int $code = 0, Exception $previous = null ){
        parent::__construct($message , $code , $previous);
        
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
