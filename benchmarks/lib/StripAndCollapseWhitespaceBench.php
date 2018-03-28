<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class StripAndCollapseWhitespaceBench
{
    public function bench_strip_whitespace_Str() {
        (new Str(' hello world '))->stripWhitespace();
    }

    public function bench_strip_whitespace_Stringy() {
        (new Stringy(' hello world '))->stripWhitespace();
    }

    public function bench_collapse_whitespace_Str() {
        (new Str(' hello world '))->collapseWhitespace();
    }

    public function bench_collapse_whitespace_Stringy() {
        (new Stringy(' hello world '))->collapseWhitespace();
    }
}
