<?php

namespace Benchmark;

use Str\Str;
use Stringy\Stringy;

class CharsBench
{
    public function bench_chars_Str() {
        (new Str('Hello world'))->chars();
    }

    public function bench_chars_Stringy() {
        (new Stringy('Hello world'))->chars();
    }
}
