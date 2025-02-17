<?php

namespace Lukasss93\Laravel\RouteDebug\Tests\Fixtures;

use Illuminate\Routing\Controller;

class CommonController extends Controller
{
    public function index(DummyRequest $request)
    {
        return response('ok');
    }
}
