<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsAlphaBench
{
    public function bench_is_alpha_numeric_Str() {
        (new Str(' hello world '))->isAlphanumeric();
    }

    public function bench_is_alpha_numeric_Stringy() {
        (new Stringy(' hello world '))->isAlphanumeric();
    }

    public function bench_is_alpha_Str() {
        (new Str(' hello world '))->isAlpha();
    }

    public function bench_is_alpha_Stringy() {
        (new Stringy(' hello world '))->isAlpha();
    }
}
