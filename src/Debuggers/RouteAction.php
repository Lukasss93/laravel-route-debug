<?php

namespace Lukasss93\Laravel\RouteDebug\Debuggers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;

class RouteAction implements RouteDebugInterface
{
    public function handle(Request $request): string
    {
        if (!($request->route() instanceof Route)) {
            return '-';
        }

        $actionValueIsClosure = $request->route()->getAction('uses') instanceof Closure;
        $actionNameIsClosure = $request->route()->getActionName() === 'Closure';

        if ($actionNameIsClosure) {
            if ($actionValueIsClosure) {
                return 'Closure';
            }

            return $request->route()->getAction('uses').'::__invoke';
        }

        return str_replace('@', '::', $request->route()->getActionName()) ?: '-';
    }
}
