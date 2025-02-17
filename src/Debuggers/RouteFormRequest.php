<?php

namespace Lukasss93\Laravel\RouteDebug\Debuggers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugInterface;
use Throwable;

class RouteFormRequest implements RouteDebugInterface
{
    public function handle(Request $request): string
    {
        try {
            $route = $request->route();

            if ($route === null) {
                throw new \RuntimeException('Route not found');
            }

            [$controller, $method] = explode('@', $route->getAction('uses'));

            $reflection = new \ReflectionMethod($controller, $method);

            foreach ($reflection->getParameters() as $parameter) {
                $parameterType = $parameter->getType()?->getName();

                if (is_subclass_of($parameterType, FormRequest::class)) {
                    return $parameterType;
                }
            }

            throw new \RuntimeException('No request found');
        } catch (Throwable) {
            return '-';
        }
    }
}
