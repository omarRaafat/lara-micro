<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionException extends UnauthorizedException
{
   

    public function render ($request , Throwable $e){
        if ($e instanceof UnauthorizedException) {
            return response()->view('errors.index', ['exception' => $e], 403);
        }
    
        return parent::render($request, $e);
    }
   

   
    
}
