<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class LengthBench
{
    public function bench_Str() {
        (new Str('Hello world'))->length();
    }

    public function bench_Stringy() {
        (new Stringy('Hello world'))->length();
    }
}