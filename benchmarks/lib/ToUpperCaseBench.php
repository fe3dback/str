<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToUpperCaseBench
{
    public function bench_upper_case_first_Str() {
        (new Str('hello'))->upperCaseFirst();
    }

    public function bench_upper_case_first_Stringy() {
        (new Stringy('hello'))->upperCaseFirst();
    }

    public function bench_to_upper_case_Str() {
        (new Str('hello'))->toUpperCase();
    }

    public function bench_to_upper_case_Stringy() {
        (new Stringy('hello'))->toUpperCase();
    }
}
