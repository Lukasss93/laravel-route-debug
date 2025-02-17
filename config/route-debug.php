<?php

use Lukasss93\Laravel\RouteDebug\Debuggers;

return [

    'enabled' => env('APP_DEBUG', false),

    'debuggers' => [
        'Laravel-Route-Name' => Debuggers\RouteName::class,
        'Laravel-Route-Action' => Debuggers\RouteAction::class,
        'Laravel-Route-Can' => Debuggers\RouteCan::class,
        'Laravel-Route-FormRequest' => Debuggers\RouteFormRequest::class,
    ],

];
