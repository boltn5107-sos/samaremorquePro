<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Middleware\TrustHosts as MiddlewareTrustHosts;

class TrustProxies extends Middleware
{
    protected $proxies;

    protected $headers = 0;
}
