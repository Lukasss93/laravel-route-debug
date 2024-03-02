<?php

namespace Lukasss93\Laravel\RouteDebug\Debuggers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;

class RouteCan implements RouteDebugInterface
{
    protected const MIDDLEWARE = 'can:';
    
    public function handle(Request $request): string
    {
        $canMiddleware = collect($request->route()?->middleware() ?? [])
            ->filter(fn($x) => Str::startsWith($x, self::MIDDLEWARE))
            ->first();
        
        if ($canMiddleware === null) {
            return '-';
        }
        
        return Str::after($canMiddleware, self::MIDDLEWARE);
    }
}
