<?php

namespace Lukasss93\Laravel\RouteDebug;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Lukasss93\Laravel\RouteDebug\Middlewares\RouteDebugMiddleware;

class RouteDebugServiceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel)
    {
        $this->publishes([
            __DIR__ . '/../config/route-debug.php' => config_path('route-debug.php'),
        ], 'route-debug-config');

        if (config('route-debug.enabled')) {
            $kernel->pushMiddleware(RouteDebugMiddleware::class);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/route-debug.php', 'route-debug');
    }
}