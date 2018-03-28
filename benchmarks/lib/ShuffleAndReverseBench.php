<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ShuffleAndReverseBench
{
    public function bench_reverse_Str() {
        (new Str(' hello world '))->reverse();
    }

    public function bench_reverse_Stringy() {
        (new Stringy(' hello world '))->reverse();
    }

    public function bench_shuffle_Str() {
        (new Str(' hello world '))->shuffle();
    }

    public function bench_shuffle_Stringy() {
        (new Stringy(' hello world '))->shuffle();
    }
}
