<?php

namespace Lukasss93\Laravel\RouteDebug\Tests\Fixtures;

use Illuminate\Foundation\Http\FormRequest;

class DummyRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
