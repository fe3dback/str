<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class AppendAndPrependBench
{
    public function bench_append_Str() {
        (new Str('2'))->append('1');
    }

    public function bench_append_Stringy() {
        (new Stringy('2'))->append('1');
    }

    public function bench_prepend_Str() {
        (new Str('2'))->prepend('1');
    }

    public function bench_prepend_Stringy() {
        (new Stringy('2'))->prepend('1');
    }
}
