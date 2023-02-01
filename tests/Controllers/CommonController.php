<?php

namespace Lukasss93\Laravel\RouteDebug\Tests\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommonController extends Controller
{
    public function index(Request $request)
    {
        return response('ok');
    }
}