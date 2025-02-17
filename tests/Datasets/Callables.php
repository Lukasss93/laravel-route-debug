<?php

use Illuminate\Http\Request;
use Lukasss93\Laravel\RouteDebug\Tests\Fixtures\CommonController;
use Lukasss93\Laravel\RouteDebug\Tests\Fixtures\InvokableController;

dataset('callables', [
    'closure' => [
        [fn (Request $request) => response('ok')],
        'Closure',
    ],
    'invokable' => [
        [InvokableController::class],
        InvokableController::class.'::__invoke',
    ],
    'array' => [
        [[CommonController::class, 'index']],
        CommonController::class.'::index',
    ],
]);
