<?php

namespace Lukasss93\Laravel\RouteDebug\Tests\Fixtures;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvokableController extends Controller
{
    public function __invoke(Request $request)
    {
        return response('ok');
    }
}
