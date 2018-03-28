<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class SliceAndSubstrBench
{
    public function bench_slice_Str() {
        (new Str(' hello world '))->slice(2);
    }

    public function bench_slice_Stringy() {
        (new Stringy(' hello world '))->slice(2);
    }

    public function bench_substr_Str() {
        (new Str(' hello world '))->substr(2);
    }

    public function bench_substr_Stringy() {
        (new Stringy(' hello world '))->substr(2);
    }
}
