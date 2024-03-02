<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Lukasss93\Laravel\RouteDebug\Middlewares\RouteDebugMiddleware;

it('returns debug header', function () {
    // simulate a request to a dummy route
    $request = new Request();
    $request->setRouteResolver(function () use ($request) {
        return (new Route('GET', 'testing/{info}', fn (Request $request) => response('ok')))
            ->can('foo')
            ->bind($request);
    });

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn ($req) => response('ok'));

    // check the response headers
    expect($response->headers->get('Laravel-Route-Can'))->toBe('foo');
});

it('returns unknown debug header', function () {
    // simulate a request to a dummy route
    $request = new Request();

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn ($req) => response('ok'));

    // check the response headers
    expect($response->headers->get('Laravel-Route-Can'))->toBe('-');
});
