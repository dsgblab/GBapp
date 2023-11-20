<?php

namespace App\Http\Middleware;

use App\Traits\PowerBITrait;
use Carbon\Carbon;
use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PowerBIAccessToken
{
    use PowerBITrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     * @throws GuzzleException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Session::get('power_access_token') === null) {
                Session::push('power_access_token', $this->getUserAccessToken());
            } elseif (Carbon::now() > Carbon::createFromTimestamp(Session::get('power_access_token')[0]->expires_on)) {
                Session::remove('power_access_token');
                Session::push('power_access_token', $this->getUserAccessToken());
            }
        }

        return $next($request);
    }
}
