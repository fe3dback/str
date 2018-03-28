<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsHexadecimalBench
{
    public function bench_is_hexadecimal_Str() {
        (new Str(' hello world '))->isHexadecimal();
    }

    public function bench_is_hexadecimal_Stringy() {
        (new Stringy(' hello world '))->isHexadecimal();
    }
}
