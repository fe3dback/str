<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class GetCharsBench
{
    public function bench_Str() {
        (new Str('Hello world'))->chars();
    }

    public function bench_Stringy() {
        (new Stringy('Hello world'))->chars();
    }
}