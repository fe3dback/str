<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class ToAsciiBench
{
    public function bench_to_ascii_Str() {
        (new Str(' hello world '))->toAscii();
    }

    public function bench_to_ascii_Stringy() {
        (new Stringy(' hello world '))->toAscii();
    }
}
