<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class AtAndBetweenBench
{
    public function bench_between_Str() {
        (new Str(' hello world '))->between(2, 4);
    }

    public function bench_between_Stringy() {
        (new Stringy(' hello world '))->between(2, 4);
    }

    public function bench_at_Str() {
        (new Str(' hello world '))->at(2);
    }

    public function bench_at_Stringy() {
        (new Stringy(' hello world '))->at(2);
    }
}
