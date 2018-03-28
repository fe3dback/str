<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SplitBench
{
    public function bench_split_Str() {
        (new Str('Hello world'))->split(' ');
    }

    public function bench_split_Stringy() {
        (new Stringy('Hello world'))->split(' ');
    }
}
