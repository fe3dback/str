<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToLowerCaseBench
{
    public function bench_lower_case_first_Str() {
        (new Str('HELLO'))->lowerCaseFirst();
    }

    public function bench_lower_case_first_Stringy() {
        (new Stringy('HELLO'))->lowerCaseFirst();
    }

    public function bench_to_lower_case_Str() {
        (new Str('HELLO'))->toLowerCase();
    }

    public function bench_to_lower_case_Stringy() {
        (new Stringy('HELLO'))->toLowerCase();
    }
}
