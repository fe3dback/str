<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class LinesBench
{
    public function bench_lines_Str() {
        (new Str('Hello world'))->lines();
    }

    public function bench_lines_Stringy() {
        (new Stringy('Hello world'))->lines();
    }
}
