<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsBlankBench
{
    public function bench_is_blank_Str() {
        (new Str(' hello world '))->isBlank();
    }

    public function bench_is_blank_Stringy() {
        (new Stringy(' hello world '))->isBlank();
    }
}
