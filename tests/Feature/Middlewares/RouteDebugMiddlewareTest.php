<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasss93\Laravel\RouteDebug\Middlewares\RouteDebugMiddleware;
use Lukasss93\Laravel\RouteDebug\Tests\Fixtures\TestDebugger;
use Symfony\Component\HttpFoundation\StreamedResponse;

it('sets the header', function (mixed $outResponse) {
    config([
        'route-debug.debuggers' => [
            'Test-Header' => TestDebugger::class,
        ],
    ]);

    // simulate a request to a dummy route
    $request = new Request();

    // execute the middleware
    $middleware = new RouteDebugMiddleware();
    $response = $middleware->handle($request, fn ($req) => $outResponse);

    expect($response->headers->get('Test-Header'))->toBe('test');
})->with([
    'LaravelResponse' => [new Response('ok')],
    'StreamedResponse' => [new StreamedResponse(fn () => print('ok'))],
    'JsonResponse' => [new JsonResponse(['foo' => 'bar'])],
]);
