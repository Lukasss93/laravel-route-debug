<?php

namespace Lukasss93\Laravel\RouteDebug\Middlewares;

use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;
use Throwable;

class RouteDebugMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!$this->canSendHeaders($response)) {
            return $response;
        }

        foreach (config('route-debug.debuggers') as $header => $debugger) {
            try {
                if (!is_subclass_of($debugger, RouteDebugInterface::class)) {
                    throw new InvalidArgumentException('Debugger must implement RouteDebugInterface');
                }

                $this->setHeader($response, $header, call_user_func([new $debugger, 'handle'], $request));
            } catch (Throwable $e) {
                $this->setHeader($response, $header, $e->getMessage());
            }
        }

        return $response;
    }

    protected function canSendHeaders($response): bool
    {
        if (method_exists($response, 'header')) {
            return true;
        }

        if (property_exists($response, 'headers') && method_exists($response->headers, 'set')) {
            return true;
        }

        return false;
    }

    protected function setHeader($response, string $name, string $value): void
    {
        if (method_exists($response, 'header')) {
            $response->header($name, $value);
        }

        if (property_exists($response, 'headers') && method_exists($response->headers, 'set')) {
            $response->headers->set($name, $value);
        }
    }
}
