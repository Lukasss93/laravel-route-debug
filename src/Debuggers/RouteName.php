<?php

namespace Lukasss93\Laravel\RouteDebug\Debuggers;

use Illuminate\Http\Request;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;

class RouteName implements RouteDebugInterface
{
    public function handle(Request $request): string
    {
        return $request->route()?->getName() ?? '-';
    }
}
