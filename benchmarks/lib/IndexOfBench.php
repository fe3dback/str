<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class IndexOfBench
{
    public function bench_indexOf_Str() {
        (new Str('Hello world'))->indexOf('l');
    }

    public function bench_indexOf_Stringy() {
        (new Stringy('Hello world'))->indexOf('l');
    }

    public function bench_indexOfLast_Str() {
        (new Str('Hello world'))->indexOfLast('l');
    }

    public function bench_indexOfLast_Stringy() {
        (new Stringy('Hello world'))->indexOfLast('l');
    }
}
