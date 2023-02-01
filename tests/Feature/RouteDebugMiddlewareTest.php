<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Lukasss93\Laravel\RouteDebug\Middlewares\RouteDebugMiddleware;

it('returns debug headers', function ($actionValue, $actionExpected) {
    $actionValue = $actionValue[0];

    // simulate a request to a dummy route
    $request = new Request();
    $request->setRouteResolver(function () use ($actionValue, $request) {
        return (new Route('GET', 'testing/{info}', $actionValue))
            ->name('testing')
            ->bind($request);
    });

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn($req) => response('ok'));

    // check the response headers
    expect($response->headers)
        ->get('Laravel-Route-Name')->toBe('testing')
        ->get('Laravel-Route-Action')->toBe($actionExpected);
})->with('callables');