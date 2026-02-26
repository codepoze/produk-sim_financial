<?php

namespace App\Http;

use App\Http\Middleware\AuthenticateSessionMiddleware;
use App\Http\Middleware\RedirectIfAuthenticatedMiddleware;
use App\Http\Middleware\PreventBackHistoryMiddleware;
use App\Http\Middleware\SetLocaleMiddleware;
use App\Http\Middleware\VisitorMiddleware;
use Illuminate\Foundation\Configuration\Middleware;

class AppMiddleware
{
    public function __invoke(Middleware $middleware)
    {
        $middleware->alias([
            'guest'                => RedirectIfAuthenticatedMiddleware::class,
            'auth.session'         => AuthenticateSessionMiddleware::class,
            'prevent.back.history' => PreventBackHistoryMiddleware::class,
            'visitor'              => VisitorMiddleware::class,
            'set.locale'           => SetLocaleMiddleware::class,
        ]);

        $middleware->append([
            \Fahlisaputra\Minify\Middleware\MinifyHtml::class,
            \Fahlisaputra\Minify\Middleware\MinifyCss::class,
            \Fahlisaputra\Minify\Middleware\MinifyJavascript::class,
        ]);
    }
}
