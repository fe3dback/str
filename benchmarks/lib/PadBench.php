<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class PadBench
{
    public function bench_pad_Str() {
        (new Str(' hello world '))->pad(3);
    }

    public function bench_pad_Stringy() {
        (new Stringy(' hello world '))->pad(3);
    }

    public function bench_pad_both_Str() {
        (new Str(' hello world '))->padBoth(3);
    }

    public function bench_pad_both_Stringy() {
        (new Stringy(' hello world '))->padBoth(3);
    }

    public function bench_pad_left_Str() {
        (new Str('  hello world '))->padLeft(3);
    }

    public function bench_pad_left_Stringy() {
        (new Stringy('  hello world '))->padLeft(3);
    }

    public function bench_pad_right_Str() {
        (new Str(' hello world  '))->padRight(3);
    }

    public function bench_pad_right_Stringy() {
        (new Stringy(' hello world  '))->padRight(3);
    }
}
