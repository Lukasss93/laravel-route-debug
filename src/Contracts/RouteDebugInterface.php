<?php

namespace Lukasss93\Laravel\RouteDebug\Contracts;

use Illuminate\Http\Request;

interface RouteDebugInterface
{
    public function handle(Request $request): string;
}
