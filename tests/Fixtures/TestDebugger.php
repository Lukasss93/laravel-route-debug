<?php

namespace Lukasss93\Laravel\RouteDebug\Tests\Fixtures;

use Illuminate\Http\Request;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;

class TestDebugger implements RouteDebugInterface
{
    public function handle(Request $request): string
    {
        return 'test';
    }
}
