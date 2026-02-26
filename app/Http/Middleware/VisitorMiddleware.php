<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (App::isProduction()) {
            $ip      = get_visitor_IP();
            $curl_ip = curl_init('https://ipinfo.io/' . $ip . '/json?token=' . env('IPINFO_KEY'));
            curl_setopt($curl_ip, CURLOPT_RETURNTRANSFER, TRUE);
            $res_ip  = curl_exec($curl_ip);
            $info_ip = json_decode($res_ip, true);

            $visitor = Visitor::whereIp($ip)->first();

            if ($visitor === null) {
                $visitor = new Visitor();
                $visitor->ip       = $ip;
                $visitor->city     = $info_ip['city'];
                $visitor->country  = $info_ip['country'];
                $visitor->region   = $info_ip['region'];
                $visitor->city     = $info_ip['city'];
                $visitor->loc      = $info_ip['loc'];
                $visitor->org      = $info_ip['org'];
                $visitor->timezone = $info_ip['timezone'];
                $visitor->save();
            }
        }

        return $next($request);
    }
}
