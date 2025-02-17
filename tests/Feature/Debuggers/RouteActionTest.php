<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Lukasss93\Laravel\RouteDebug\Middlewares\RouteDebugMiddleware;
use Lukasss93\Laravel\RouteDebug\Tests\Fixtures\CommonController;
use Lukasss93\Laravel\RouteDebug\Tests\Fixtures\InvokableController;

it('returns debug header', function ($actionValue, $actionExpected) {
    // simulate a request to a dummy route
    $request = new Request();
    $request->setRouteResolver(function () use ($actionValue, $request) {
        return (new Route('GET', 'testing/{info}', $actionValue[0]))->bind($request);
    });

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn ($req) => response('ok'));

    // check the response headers
    expect($response->headers->get('Laravel-Route-Action'))->toBe($actionExpected);
})->with([
    'closure' => [[fn (Request $request) => response('ok')], 'Closure'],
    'invokable' => [[InvokableController::class], InvokableController::class.'::__invoke'],
    'array' => [[[CommonController::class, 'index']], CommonController::class.'::index'],
]);

it('returns unknown debug header', function () {
    // simulate a request to a dummy route
    $request = new Request();

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn ($req) => response('ok'));

    // check the response headers
    expect($response->headers->get('Laravel-Route-Action'))->toBe('-');
});
