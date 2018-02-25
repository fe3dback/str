<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class TrimBench
{
    public function bench_both_Str() {
        (new Str(' hello world '))->trim();
    }

    public function bench_both_Stringy() {
        (new Stringy(' hello world '))->trim();
    }

    public function bench_left_Str() {
        (new Str('  hello world '))->trimLeft();
    }

    public function bench_left_Stringy() {
        (new Stringy('  hello world '))->trimLeft();
    }

    public function bench_right_Str() {
        (new Str(' hello world  '))->trimRight();
    }

    public function bench_right_Stringy() {
        (new Stringy(' hello world  '))->trimRight();
    }
}