<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToUpperCaseBench
{
    public function bench_Str() {
        (new Str('hello'))->toUpperCase();
    }

    public function bench_Stringy() {
        (new Stringy('hello'))->toUpperCase();
    }
}