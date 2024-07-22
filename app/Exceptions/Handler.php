<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Sentry\State\HubInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    protected $sentry;

    public function __construct(HubInterface $sentry)
    {
        $this->sentry = $sentry;
        parent::__construct(app());
    }
    

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            return response()->json([
                'responseMessage' => $e->getMessage(),
                'responseStatus'  => 403,
            ]);
        });

      
    }

    public function report($exception)
{
    if (app()->bound('sentry') && $this->shouldReport($exception)){
        app('sentry')->captureException($exception);
    }

    parent::report($exception);
}



}
