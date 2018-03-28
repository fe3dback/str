<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class CamelCaseBench
{
    public function bench_upper_camelize_Str() {
        (new Str('some string hello'))->upperCamelize();
    }

    public function bench_upper_camelize_Stringy() {
        (new Stringy('some string hello'))->upperCamelize();
    }

    public function bench_camelize_Str() {
        (new Str('some string hello'))->camelize();
    }

    public function bench_camelize_Stringy() {
        (new Stringy('some string hello'))->camelize();
    }
}
