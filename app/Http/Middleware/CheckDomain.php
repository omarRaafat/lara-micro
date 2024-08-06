<?php
    namespace App\Http\Middleware;

    use App\Models\Domain;
    use App\Traits\HandleResponse;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\URL;
    use Symfony\Component\HttpFoundation\Response;

    class CheckDomain
    {
        use HandleResponse;

        /**
         * Handle an incoming request.
         *
         * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\HandleResponse)  $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            $domain = Domain::where('domain', $request->header('domain'))->first();
            if(!$domain)
            {
                return $this->send_response(FALSE, 500, __("auth.site_not_active", [], $request->header('lang')), NULL, 200);
            }
            if($domain->store->status != 'approved')
            {
                return $this->send_response(FALSE, 500, __("auth.site_not_active", [], $request->header('lang')), NULL, 200);
            }
            if($domain->store->active == 0)
            {
                return $this->send_response(FALSE, 503, __("auth.site_in_maintenance", [], $request->header('lang')), NULL, 200);
            }
            return $next($request);
        }
    }
