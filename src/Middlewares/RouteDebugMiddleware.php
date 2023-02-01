<?php

namespace Lukasss93\Laravel\RouteDebug\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RouteDebugMiddleware
{
    public function handle(Request $request, Closure $next)
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
        if (!($request->route() instanceof Route)) {
            return '[Route name not set]';
        }

        return $request->route()->getName() ?: '[Route name not set]';
    }

    protected function getRouteAction(Request $request): string
    {
        if (!($request->route() instanceof Route)) {
            return '[Route action not set]';
        }

        $actionValueIsClosure = $request->route()->getAction('uses') instanceof Closure;
        $actionNameIsClosure = $request->route()->getActionName() === 'Closure';

        if ($actionNameIsClosure) {
            if ($actionValueIsClosure) {
                return 'Closure';
            }

            return $request->route()->getAction('uses').'::__invoke';
        }

        return str_replace('@', '::', $request->route()->getActionName()) ?: '[Route action not set]';
    }
}
