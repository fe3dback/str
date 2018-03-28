<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class TidyBench
{
    public function bench_tidy_Str() {
        (new Str(' hello world '))->tidy();
    }

    public function bench_tidy_Stringy() {
        (new Stringy(' hello world '))->tidy();
    }
}
