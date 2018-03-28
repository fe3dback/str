<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IsOrHasLowerCaseBench
{
    public function bench_is_lower_case_Str() {
        (new Str(' hello world '))->isLowerCase();
    }

    public function bench_is_lower_case_Stringy() {
        (new Stringy(' hello world '))->isLowerCase();
    }

    public function bench_has_lower_case_Str() {
        (new Str(' hello world '))->hasLowerCase();
    }

    public function bench_has_lower_case_Stringy() {
        (new Stringy(' hello world '))->hasLowerCase();
    }
}
