<?php

namespace Lukasss93\Laravel\RouteDebug\Tests;

use Lukasss93\Laravel\RouteDebug\RouteDebugServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            RouteDebugServiceProvider::class,
        ];
    }
}