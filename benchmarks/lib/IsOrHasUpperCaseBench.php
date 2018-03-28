<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsOrHasUpperCaseBench
{
    public function bench_is_upper_case_Str() {
        (new Str(' hello world '))->isUpperCase();
    }

    public function bench_is_upper_case_Stringy() {
        (new Stringy(' hello world '))->isUpperCase();
    }

    public function bench_has_upper_case_Str() {
        (new Str(' hello world '))->hasUpperCase();
    }

    public function bench_has_upper_case_Stringy() {
        (new Stringy(' hello world '))->hasUpperCase();
    }
}
