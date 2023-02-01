<?php

namespace Lukasss93\Laravel\RouteDebug\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RouteDebugMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        // skip binary responses
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        try {
            $response->header('Laravel-Route-Name', $this->getRouteName($request));
            $response->header('Laravel-Route-Action', $this->getRouteAction($request));
        } finally {
            return $response;
        }
    }

    protected function getRouteName(Request $request): string
    {
        return $request->route()?->getName() ?: '[Route name not set]';
    }

    protected function getRouteAction(Request $request): string
    {
        $actionValueIsClosure = $request->route()?->getAction('uses') instanceof Closure;
        $actionNameIsClosure = $request->route()?->getActionName() === 'Closure';

        if($actionNameIsClosure) {
            if ($actionValueIsClosure) {
                return 'Closure';
            }

            return $request->route()?->getAction('uses') .'::__invoke';
        }

        return str_replace('@','::', $request->route()?->getActionName()) ?: '[Route action not set]';
    }
}