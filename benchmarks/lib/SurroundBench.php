<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SurroundBench
{
    public function bench_surround_Str() {
        (new Str('2'))->surround('1');
    }

    public function bench_surround_Stringy() {
        (new Stringy('2'))->surround('1');
    }
}
