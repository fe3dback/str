<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class RepeatBench
{
    public function bench_repeat_Str() {
        (new Str(' hello world '))->repeat(2);
    }

    public function bench_repeat_Stringy() {
        (new Stringy(' hello world '))->repeat(2);
    }
}
