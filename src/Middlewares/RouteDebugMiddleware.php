<?php

namespace Lukasss93\Laravel\RouteDebug\Middlewares;

use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class RouteDebugMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // skip responses without header method
        if (!method_exists($response, 'header')) {
            return $response;
        }

        // apply debug headers
        $debuggers = config('route-debug.debuggers');

        foreach ($debuggers as $header => $debugger) {
            try {
                if (!is_subclass_of($debugger, RouteDebugInterface::class)) {
                    throw new InvalidArgumentException('Debugger must implement RouteDebugInterface');
                }

                $response->header($header, call_user_func([new $debugger, 'handle'], $request));
            } catch (Throwable $e) {
                $response->header($header, $e->getMessage());
            }
        }

        return $response;
    }
}
