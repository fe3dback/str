<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class GetBench
{
    public function bench_first_Str() {
        (new Str('Hello world'))->first(6);
        (new Str('Hello world'))->first(-6);
    }

    public function bench_first_Stringy() {
        (new Stringy('Hello world'))->first(6);
        (new Stringy('Hello world'))->first(-6);
    }

    public function bench_last_Str() {
        (new Str('Hello world'))->last(6);
        (new Str('Hello world'))->last(-6);
    }

    public function bench_last_Stringy() {
        (new Stringy('Hello world'))->last(6);
        (new Stringy('Hello world'))->last(-6);
    }
}
